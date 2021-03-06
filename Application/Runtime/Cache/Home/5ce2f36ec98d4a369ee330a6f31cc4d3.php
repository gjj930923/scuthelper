<?php if (!defined('THINK_PATH')) exit();?><style>
    body{ font-size: 12px;}
    body,p,div{ padding: 0; margin: 0;}
    .wraper{ padding: 30px 0;}
    .btn-wraper{ text-align: center;}
    .btn-wraper input{ margin: 0 10px;}
    #file-list{ width: 525px;}
    .file-name{ line-height: 30px;}
    .progress{ height: 4px; font-size: 0; line-height: 4px; background: blue; width: 0;}
    .tip1{text-align: center; font-size:14px; padding-top:10px;}
    .tip2{text-align: center; font-size:12px; padding-top:10px; color:#b00}
    #drag-area{ border: 1px solid #ccc; height: 150px; line-height: 150px; text-align: center; color: #aaa; width: 400px; margin: 10px auto;}
    .catalogue{ position: fixed; _position:absolute; _width:200px; left: 0; top: 0; border: 1px solid #ccc;padding: 10px; background: #eee}
    .catalogue a{ line-height: 30px; color: #0c0}
    .catalogue li{ padding: 0; margin: 0; list-style: none;}
</style>
<script>
    var pic_num = 0;
    var uploaded_num = 0;
    var uploader;
    var is_continue = false;//提交后是否继续发布商品
    $(document).ready(function(){
        $('#product_form').hide();
        $('#prev_step').hide();
        $('#alert_warning').hide();
        $('#upload_cancel').hide();
        <?php if($product != null): ?>$('#next_step').hide();
            $("#browse").hide();
            $(".btn-danger,#drag-area").hide();
            $('#upload_notice').hide();
            $('#product_form').show();
            $('#submit_continue').hide();<?php endif; ?>
        <?php if($product == null): ?>uploader = new Qiniu.uploader({ //实例化一个plupload上传对象
            runtimes: 'html5,flash,html4',
            browse_button : 'browse',
            url : 'http://up-z0.qiniu.com/',
            flash_swf_url : 'js/Moxie.swf',
            silverlight_xap_url : 'js/Moxie.xap',
            drop_element : 'drag-area',
            max_retries : 5,
            uptoken_url:"createQiniuToken?bucket=scuthelper",
            chunk_size: '4mb',
            domain: 'http://77l5lx.com1.z0.glb.clouddn.com/',
            unique_names: false ,
            save_key: false,
            container: 'button_group',
            max_file_size : '10mb',
            filters: {
                mime_types : [ //只允许上传图片文件
                    { title : "图片文件", extensions : "jpg,gif,png,jpeg" }
                ],
                prevent_duplicates : true //不允许选取重复文件
            },
            multipart: true,
            multipart_params: {
            },
            file_data_name: 'file',
            init: {
                'FilesAdded': function(uploader, files) {
                    if(pic_num + files.length <= 9) {
                        for (var i = 0, len = files.length; i < len; i++) {
                            var file_name = files[i].name; //文件名
                            //构造html来更新UI
                            var html = '<div class="span2" id="file-' + files[i].id + '"><div class="thumbnail">loading...</div></div>';
                            //$(html).appendTo('#file-list');
                            $('#file-list').append(html);
                            !function (i) {
                                previewImage(files[i], function (imgsrc) {
                                    $('#file-' + files[i].id+' .thumbnail').html('<img src="' + imgsrc + '" /><p class="progress"></p>');
                                    var html = '<button type="button" class="btn btn-danger btn-small" href="javascript:void(0);" onclick="deleteFile(\'file_id\')">删除</button>';
                                    $('#file-' + files[i].id+' .thumbnail').append(html.replace('file_id',files[i].id));
                                })
                            }(i);
                            //pic_num++;
                        }
                    }
                    else{
                        $('#notice_modal_body').html('照片数量不得多于9张！');
                        $('#notice_modal').modal('show');
                        uploader.splice(pic_num, files.length);
                    }
                    pic_num += files.length;
                },
                'BeforeUpload': function(uploader, file) {
                    // 每个文件上传前,处理相关的事情
                },
                'UploadProgress': function(uploader, file) {
                    // 每个文件上传时,处理相关的事情
                    $('#file-'+file.id+' .progress').css('width',file.percent + '%');//控制进度条
                    $('#notice_modal').modal('show');
                    $('#upload_cancel').show();
                    $('#modal_close').hide();
                    $('#notice_modal_body').html('图片已上传'+uploader.total.percent+'%');
                },
                'FileUploaded': function(up, file, info) {
                    // 每个文件上传成功后,处理相关的事情
                    // 其中 info 是文件上传成功后，服务端返回的json，形式如
                    // {
                    //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                    //    "key": "gogopher.jpg"
                    //  }
                    // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html
                    var domain = up.getOption('domain');
                    var res = $.parseJSON(info);
                    var sourceLink = domain + res.key; //获取上传成功后的文件的Url
                    $('#url'+(uploaded_num+1)).val(sourceLink);
                    uploaded_num++;
                },
                'Error': function(up, err, errTip) {
                    //上传出错时,处理相关的事情
                },
                'UploadComplete': function() {
                    //队列文件处理完毕后,处理相关的事情

                    releaseProduct();

                },
                'FilesRemoved': function(uploader,files) {
                    for(var i = 0, len = files.length; i<len; i++) {
                        $('#file-' + files[i].id).remove();
                        pic_num--;
                    }
                },
                'Key': function(uploader, file) {
                    // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                    // 该配置必须要在 unique_names: false , save_key: false 时才生效

                    var fileData = file.name.split(".");
                    var type = fileData[fileData.length-1];
                    var key = "scuthelper/market/upload_pic/"+"<?php echo date('YmdHis');?>"+Math.floor(10000 + 90000.0 * Math.random())+"."+type;
                    // do something with key here
                    return key;
                }
            }
        });

        function previewImage(file,callback){
            if(!file || !/image\//.test(file.type)) return; //确保文件是图片
            if(file.type=='image/gif'){
                var fr = new mOxie.FileReader();
                fr.onload = function(){
                    callback(fr.result);
                    fr.destroy();
                    fr = null;
                }
                fr.readAsDataURL(file.getSource());
            }else{
                var preloader = new mOxie.Image();
                preloader.onload = function() {
                    preloader.downsize( 120, 120 );//先压缩一下要预览的图片,宽120，高120
                    var imgsrc = preloader.type=='image/jpeg' ? preloader.getAsDataURL('image/jpeg',80) : preloader.getAsDataURL(); //得到图片src,实质为一个base64编码的数据
                    callback && callback(imgsrc); //callback传入的参数为预览图片的url
                    preloader.destroy();
                    preloader = null;
                };
                preloader.load( file.getSource() );
            }
        }
        //上传按钮
        $('#upload-btn').click(function(){
            uploader.start(); //开始上传
        });

        $('#upload_cancel').click(function(){
            uploader.stop();
        });

        //选完照片进入下一步
        $('#next_step').click(function(){
            if(uploader.files.length == 0){
                $('#notice_modal_body').html('请选择图片！');
                $('#notice_modal').modal('show');
            }
            else{
                $(this).hide();
                $("#browse").hide();
                $(".btn-danger,#drag-area").hide();
                $('#upload_notice').hide();
                $('#product_form').show();
                $('#prev_step').show();
            }
        });

        //回到选择照片步骤
        $('#prev_step').click(function(){
            $(this).hide();
            $("#browse").show();
            $(".btn-danger,#drag-area").show();
            $('#upload_notice').show();
            $('#next_step').show();
            $('#product_form').hide();
        });<?php endif; ?>
        $('#main_category').change(function(){
            $.get("getBranchType", {
                        type_id: $(this).val()
                    },
                    function(data){
                        $('#category').empty();
                        $('#category').html('<option value="" selected>全部子类别</option>');
                        for (var i in data){
                            $('#category').append('<option value="'+data[i]['category_id']+'">'+data[i]['name']+'</option>');
                        }
                    });
        });

        $('#submit,#submit_continue').click(function(){
            $('#notice_modal').modal('show');
            $('#notice_modal_body').html('请稍候。。');
            <?php if($product == null): ?>uploader.start(); //开始上传
            <?php else: ?>
            releaseProduct();<?php endif; ?>
            if($(this).attr('id') == 'submit_continue'){
                is_continue = true;
            }
        });


    });

    function deleteFile(id){
        uploader.removeFile(id);
    }

    function createUploadToken(file_name){
        var bucket = "scuthelper";
        $.post("createQiniuToken",{
                bucket:bucket,
                file_name:file_name
            },
            function(data){
                if(data != -1){
                    return data;
                }
                else return -1;
            }

        )

    }

    function check(){
        return false;
    }

    function releaseProduct(){
        $('#notice_modal').modal('show');
        $('#notice_modal_body').html('提交商品信息中。。');
        var category = 0;
        if($('#category').val() != 0){
            category = $('#category').val();
        }
        else{
            category = $('#main_category').val();
        }
        $.post("releaseProduct",
                {
                    user_id:'<?php echo ($user_info["user_id"]); ?>',
                    product_id:$('#product_id').val(),
                    product_name:$('#product_name').val(),
                    min_price:$('#min_price').val(),
                    max_price:$('#max_price').val(),
                    category:category,
                    quantity:$('#quantity').val(),
                    fineness:$('#fineness').val(),
                    description:$('#description').val(),
                    source:$('#source').val(),
                    url1:$('#url1').val(),
                    url2:$('#url2').val(),
                    url3:$('#url3').val(),
                    url4:$('#url4').val(),
                    url5:$('#url5').val(),
                    url6:$('#url6').val(),
                    url7:$('#url7').val(),
                    url8:$('#url8').val(),
                    url9:$('#url9').val()
                },function(data, status){
                    switch(parseInt(data)){
                        case -1:
                            $('#alert_warning strong').html("商品名称不得为空或超过60字");
                            $('#alert_warning').show();
                            break;
                        case -2:
                            $('#alert_warning strong').html("商品价格须填写数字");
                            $('#alert_warning').show();
                            break;
                        case -3:
                            $('#alert_warning strong').html("商品价格须填写数字，最高价格不得低于最低价格");
                            $('#alert_warning').show();
                            break;
                        case -4:
                            $('#alert_warning strong').html("分类不存在");
                            $('#alert_warning').show();
                            break;
                        case -5:
                            $('#alert_warning strong').html("商品数量无效");
                            $('#alert_warning').show();
                            break;
                        case -6:
                            $('#alert_warning strong').html("商品成色无效");
                            $('#alert_warning').show();
                            break;
                        case -7:
                            $('#alert_warning strong').html("商品描述不得为空或大于600字");
                            $('#alert_warning').show();
                            break;
                        case -8:
                            $('#alert_warning strong').html("商品来源无效");
                            $('#alert_warning').show();
                            break;
                        case -9:
                            $('#alert_warning strong').html("没有上传图片");
                            $('#alert_warning').show();
                            break;
                        case -10:
                            $('#alert_warning strong').html("商品添加或更新失败");
                            $('#alert_warning').show();
                            break;
                        case -11:
                            $('#alert_warning strong').html("商品图片上传失败");
                            $('#alert_warning').show();
                            break;
                        case 0:
                            if(is_continue){
                                $('#notice_modal_body').html('商品上传成功，准备开始发布下一件商品').delay(300);
                                window.location.href = "";
                            }
                            else{
                                $('#notice_modal_body').html('商品上传成功，即将跳转到个人中心').delay(1000);
                                window.location.href = "ordersAndProducts";
                            }
                            break;
                        default:
                            $('#alert_warning strong').html("Test");
                            $('#alert_warning').show();
                    }
                    $('#notice_modal').modal('hide');
                }
        )
    }


</script>
<div class="container">
    <div class="row">
        <div class="span12">
            <ul class="breadcrumb">
                <li>
                    <a href="../">主页</a> <span class="divider">/</span>
                </li>
                <li  class="active">
                    商品发布或编辑
                </li>
            </ul>
            <div class="alert alert-success" id="upload_notice">
                <h4>
                    先选图片，再填信息！
                </h4>
                <p><strong>至少1张，至多9张</strong>；</p>
                <p>第一张将作为商品列表页、微信微博推广的图片，因此必须是最有代表性的照片哦~；</p>
                <p>为了保证网页显示效果，在不同页面中，图片将被裁剪为<strong>4:3</strong>或<strong>1:1</strong>的比例，只保留中间部分，因此商品关键点应尽可能留在图片中心；</p>
                <p>图像像素宽度至少600px，文件大小控制在10M之内，大部分手机拍摄的照片都符合要求的~</p>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="span6">
            <button type="button" class="btn btn-primary" id="prev_step" style="margin: 10px;">重新编辑照片</button>
            <div class="container" id="file-list">
                <?php if(product != null): if(is_array($pic_url)): $i = 0; $__LIST__ = $pic_url;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="span2">
                            <div class="thumbnail">
                                <img src="<?php echo ($vo['url']); ?>/square.140" />
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </div>
        </div>
        <div class="span6">

            <div class="wraper">
                <p id="drag-area">把要上传的图片拖放到这里(最多9张)
                </p>
            </div>
            <div class="btn-group pull-right" id="button_group">
                <input type="button" value="选择文件..." id="browse" class="btn btn-info"/>
                <input type="button" value="图片选择完毕" id="next_step" class="btn btn-primary"/>
            </div>
        </div>
        <div class="span6" id="product_form">
            <div class="alert alert-warning" id="alert_warning" name="alert_warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4>
                    提示
                </h4><strong>提交成功！</strong>
            </div>
            <form class="form-horizontal">
                    <input id="product_id" type="hidden" value="<?php echo ($product['product_id']); ?>"/>
                    <input id="url1" type="hidden"/>
                    <input id="url2" type="hidden"/>
                    <input id="url3" type="hidden"/>
                    <input id="url4" type="hidden"/>
                    <input id="url5" type="hidden"/>
                    <input id="url6" type="hidden"/>
                    <input id="url7" type="hidden"/>
                    <input id="url8" type="hidden"/>
                    <input id="url9" type="hidden"/>
                    <div class="control-group">
                        <label class="control-label" for="product_name">商品名称</label>
                        <div class="controls">
                            <input id="product_name" name="product_name" class="input-xlarge" size="60" placeholder="不得超过60字" type="text" required value="<?php echo ($product['name']); ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="min_price">最低价格</label>
                        <div class="controls">
                            <input id="min_price" name="min_price" class="input-xlarge" type="text" required value="<?php echo ($product['min_price']); ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="max_price">最高价格</label>
                        <div class="controls">
                            <input id="max_price" name="max_price" class="input-xlarge" type="text" placeholder="选填" <?php if($product['min_price'] + 0.01 < $product['max_price']): ?>value="<?php echo ($product['max_price']); ?>"<?php endif; ?>/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="main_category">类别</label>
                        <div class="controls">
                            <select id="main_category" name="main_category" class="input-xlarge">
                                <option value="0">全部类别</option>
                                <?php if(is_array($main_category_list)): foreach($main_category_list as $key=>$vo): if($vo['category_id'] == $product['category']): ?><option value="<?php echo ($vo["category_id"]); ?>" selected="selected"><?php echo ($vo["name"]); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo ($vo["category_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="category">子类别</label>
                        <div class="controls">
                            <select id="category" name="category" class="input-xlarge">
                                <option value="0">全部子类别</option>
                                <?php if(is_array($branch_category_list)): foreach($branch_category_list as $key=>$vo): if($vo['category_id'] == $branch_category_id): ?><option value="<?php echo ($vo["category_id"]); ?>" selected="selected"><?php echo ($vo["name"]); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo ($vo["category_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="quantity">数量</label>
                        <div class="controls">
                            <input id="quantity" name="quantity" class="input-xlarge" type="number" required value="<?php echo ($product['quantity'] - $product['quantity_sold']); ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="fineness">成色</label>
                        <div class="controls">
                            <select id="fineness" name="fineness" class="input-xlarge">
                                <option value="5" <?php if($product['fineness'] == 5): ?>selected<?php endif; ?>>全新</option>
                                <option value="4" <?php if($product['fineness'] == 4): ?>selected<?php endif; ?>>九五成以上</option>
                                <option value="3" <?php if($product['fineness'] == 3): ?>selected<?php endif; ?>>九成以上</option>
                                <option value="2" <?php if($product['fineness'] == 2): ?>selected<?php endif; ?>>八成以上</option>
                                <option value="1" <?php if($product['fineness'] == 1): ?>selected<?php endif; ?>>七成以上</option>
                                <option value="0" <?php if($product['fineness'] == 0): ?>selected<?php endif; ?>>七成以下</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="source">商品来源</label>
                        <div class="controls">
                            <select id="source" name="source" class="input-xlarge">
                                <option value="0" <?php if($product['source'] == 0): ?>selected<?php endif; ?>>未知</option>
                                <option value="1" <?php if($product['source'] == 1): ?>selected<?php endif; ?>>网购</option>
                                <option value="2" <?php if($product['source'] == 2): ?>selected<?php endif; ?>>代购</option>
                                <option value="3" <?php if($product['source'] == 3): ?>selected<?php endif; ?>>海淘</option>
                                <option value="4" <?php if($product['source'] == 4): ?>selected<?php endif; ?>>线下商店</option>
                                <option value="5" <?php if($product['source'] == 5): ?>selected<?php endif; ?>>奖品或赠品</option>
                                <option value="6" <?php if($product['source'] == 6): ?>selected<?php endif; ?>>其他</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="description">商品描述（600字以内）</label>
                        <div class="controls">
							<textarea id="description" name="description" required><?php echo ($product['description']); ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="submit"></label>
                        <div class="controls">
                            <button id="submit_continue" name="submit_continue" href="javascript:void(0);" onclick="return check();" class="btn btn-primary">提交并继续添加商品</button> <button id="submit" name="submit"  href="javascript:void(0);" onclick="return check();" class="btn btn-success">完成提交</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="notice_modal" tabindex="-1" role="dialog"
     aria-labelledby="notice_modal_title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="notice_modal_title">
                    提示
                </h4>
            </div>
            <div class="modal-body">
                <h4 id="notice_modal_body">Text</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="modal_close"
                        data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-default" id="upload_cancel"
                        data-dismiss="modal">取消上传
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>