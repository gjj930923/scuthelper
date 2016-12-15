<?php if (!defined('THINK_PATH')) exit();?>
    <style>
        body{ font-size: 12px;}
        body,p,div{ padding: 0; margin: 0;}
        .wraper{ padding: 30px 0;}
        .btn-wraper{ text-align: center;}
        .btn-wraper input{ margin: 0 10px;}
        #file-list{ width: 350px; margin: 20px auto;}
        #file-list li{ margin-bottom: 10px;}
        .file-name{ line-height: 30px;}
        .progress{ height: 4px; font-size: 0; line-height: 4px; background: blue; width: 0;}
        .tip1{text-align: center; font-size:14px; padding-top:10px;}
        .tip2{text-align: center; font-size:12px; padding-top:10px; color:#b00}
        #drag-area{ border: 1px solid #ccc; height: 150px; line-height: 150px; text-align: center; color: #aaa; width: 600px; margin: 10px auto;}
        .catalogue{ position: fixed; _position:absolute; _width:200px; left: 0; top: 0; border: 1px solid #ccc;padding: 10px; background: #eee}
        .catalogue a{ line-height: 30px; color: #0c0}
        .catalogue li{ padding: 0; margin: 0; list-style: none;}
    </style>
<div class="wraper">
    <p id="drag-area">把要上传的图片拖放到这里(最多9张)</p>
    <div class="btn-wraper">
        <input type="button" value="选择文件..." id="browse" />
        <input type="button" value="开始上传" id="upload-btn" />
        <input type="button" value="删除第一张" id="delete" />
    </div>
    <ul id="file-list">

    </ul>
</div>

<script type="text/javascript">
    var pic_num = 0;
    var uploader = new plupload.Uploader({ //实例化一个plupload上传对象
        browse_button : 'browse',
        url : 'upload.html',
        flash_swf_url : 'js/Moxie.swf',
        silverlight_xap_url : 'js/Moxie.xap',
        drop_element : 'drag-area',
        max_retries : 5,
        filters: {
            mime_types : [ //只允许上传图片文件
                { title : "图片文件", extensions : "jpg,gif,png,jpeg" }
            ],
            prevent_duplicates : true //不允许选取重复文件
        }
    });
    uploader.init(); //初始化
    //绑定文件添加进队列事件
    uploader.bind('FilesAdded',function(uploader,files){
        //var length = files.length > 9 ? 9 : files.length;
        if(pic_num + files.length > 9) {
            for (var i = 0, len = length; i < len; i++) {
                var file_name = files[i].name; //文件名
                //构造html来更新UI
                var html = '<li id="file-' + files[i].id + '"><p class="progress"></p></li>';
                $(html).appendTo('#file-list');
                !function (i) {
                    previewImage(files[i], function (imgsrc) {
                        $('#file-' + files[i].id).append('<img src="' + imgsrc + '" />');
                    })
                }(i);
            }
        }
        else{
            alert('照片数量不得多于9张！');
        }
    });

    //绑定文件上传进度事件
    uploader.bind('UploadProgress',function(uploader,file){
        $('#file-'+file.id+' .progress').css('width',file.percent + '%');//控制进度条
    });


    uploader.bind('FilesRemoved',function(uploader,files){
        for(var i = 0, len = files.length; i<len; i++) {
            $('#file-' + files[i].id).remove();
        }
    });

    //上传按钮
    $('#upload-btn').click(function(){
        uploader.start(); //开始上传
    });

    //删除按钮
    $('#delete').click(function(){
        uploader.splice(0, 1);
        $('#file-'+files[0].id).remove();
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
                preloader.downsize( 300, 300 );//先压缩一下要预览的图片,宽300，高300
                var imgsrc = preloader.type=='image/jpeg' ? preloader.getAsDataURL('image/jpeg',80) : preloader.getAsDataURL(); //得到图片src,实质为一个base64编码的数据
                callback && callback(imgsrc); //callback传入的参数为预览图片的url
                preloader.destroy();
                preloader = null;
            };
            preloader.load( file.getSource() );
        }
    }


</script>