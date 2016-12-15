<?php if (!defined('THINK_PATH')) exit();?><script>
    $(document).ready(function(){
        $('#carousel').carousel({
            interval: 2500
        });
        $('#carousel').carousel('cycle');
        $('#order_create_modal').hide();
        $('#delete_favorite').hide();
        $('#order_check_alert').hide();
        $('#order_success_alert').hide();
        $('#add_question_alert').hide();
        <?php if($user_info != null): ?>$.post("isFavorite",{
            user_id:'<?php echo ($user_info["user_id"]); ?>',
            product_id:'<?php echo ($product["product_id"]); ?>'
        },function(data,status){
            if(data == "1"){
                $('#add_favorite').hide();
                $('#delete_favorite').show();
            }
        });<?php endif; ?>
        
        $('#add_favorite,#delete_favorite').click(function(){
            <?php if($user_info != null): ?>$.post("modifyFavorite",{
                user_id:'<?php echo ($user_info["user_id"]); ?>',
                product_id:'<?php echo ($product["product_id"]); ?>'
            },function(data,status){
                if(data == "0"){
                    $('#add_favorite').hide();
                    $('#delete_favorite').show();
                }
                else if(data == "1"){
                    $('#add_favorite').show();
                    $('#delete_favorite').hide();
                }
            });
            <?php else: ?>
                window.location.href="login";<?php endif; ?>
        });

        $('#add_order').click(function(){
            <?php if($user_info != null): ?>$('#order_create_modal').show();
                $('#order_create_modal').modal('show');
            <?php else: ?>
                window.location.href="login";<?php endif; ?>
        });

        $('#address1').typeahead({
            source: function (query, process) {
                var parameter = {query: query};
                $.post('getAddresses', parameter, function (data) {
                    process(data);
                });
            },
            items: 3
        });

        var date = new Date();
        var date_string = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+' '+date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
        $('#expect_exchange_time').datetimepicker({
            startDate: date_string,
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true,
            startView: 'month',
            maxView: 'month',
            todayBtn: true,
            todayHighlight: true
        });

        $('#address_selection').change(function () {
            if($(this).val() == 1){
                $('#address1').val('<?php echo ($user_address1); ?>');
                $('#address2').val('<?php echo ($user_info["address2"]); ?>');
                $('#buyer_note').focus();
            }
            else if($(this).val() == 2){
                $('#address1').val('<?php echo ($seller_address1); ?>');
                $('#address2').val('<?php echo ($seller["address2"]); ?>');
                $('#buyer_note').focus();
            }
            else{
                $('#address1').val('').focus();
                $('#address2').val('');
            }
        });

        $('#order_submit_button').click(function(){
            $.post("addOrder",{
                user_id:'<?php echo ($user_info["user_id"]); ?>',
                product_id:'<?php echo ($product["product_id"]); ?>',
                quantity:$('#quantity').val(),
                payment_amount:$('#payment_amount').val(),
                expect_exchange_time:$('#expect_exchange_time').val(),
                buyer_note:$('#buyer_note').val(),
                address1:$('#address1').val(),
                address2:$('#address2').val()
            },function(data){
                switch(data){
                    case "-1":
                        $('#order_check_alert').show();
                        $('#order_check_alert').html("商品不存在");
                        break;
                    case "-2":
                        $('#order_check_alert').show();
                        $('#order_check_alert').html("商品库存不足");
                        break;
                    case "-3":
                        $('#order_check_alert').show();
                        $('#order_check_alert').html("交易时间不得早于当前时间");
                        break;
                    case "-4":
                        $('#order_check_alert').show();
                        $('#order_check_alert').html("该商品的卖家不得购买此商品");
                        break;
                    case "0":
                        $('#order_create_modal').modal('hide');
                        $('#order_success_alert').show();
                        break;
                    default:
                }
            })
        });

        $('#add_question').click(function(){
            $.post("addQuestion",{
                        user_id:'<?php echo ($user_info["user_id"]); ?>',
                        product_id:'<?php echo ($product["product_id"]); ?>',
                        content:$('#description').val()
                    },function(data){
                switch(data){
                    case "-1":
                        $('#add_question_alert').html('商品已被删除').show();
                        break;
                    case "-2":
                        $('#add_question_alert').html('商品不存在').show();
                        break;
                    case "-3":
                        $('#add_question_alert').html('问题内容不得为空').show();
                        break;
                    case "-5":
                        $('#add_question_alert').html('问题添加失败').show();
                        break;
                    case "0":
                        $('#add_question_alert').html('问题添加成功，请等待卖家回复').show();
                        $('#add_question,#description').hide();
                        $('#description').siblings("label").hide();
                        break;
                }
            });
        });

    });

    function check(){
        return false;
    }

</script>
<!-- 模态框（Modal） -->
<div class="modal fade" id="order_create_modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    完善求购信息
                </h4>
            </div>
        </div><!-- /.modal-content -->
        <div class="modal-body">
            <form class="form-horizontal">
                <fieldset>
                    <div class="control-group">
                        <div class="alert"  id="order_create_modal_alert">
                            请注意求购信息的内容，一经提交不可修改！<br><p class="help-block">卖家设定的价格为<strong><?php echo ($product["min_price"]); if($product['min_price'] + 0.01 < $product['max_price']): ?>-<?php echo ($product["max_price"]); endif; ?>元</strong></p>
                        </div>
                        <div class="alert"  id="order_check_alert">
                        </div>
                        <input id="order_id" type="hidden">
                        <input id="is_accept" type="hidden" value="1">
                        <label class="control-label" for="payment_amount">可接受的价格（元）&nbsp;&nbsp;</label>
                        <div class="controls" style="margin: 10px;">
                            <input id="payment_amount" name="payment_amount" class="input-large" type="text" required value="<?php echo ($product["min_price"]); ?>">
                        </div>
                        <label class="control-label" for="payment_amount">数量&nbsp;&nbsp;</label>
                        <div class="controls" style="margin: 10px;">
                            <input id="quantity" name="quantity" class="input-large" type="number" required value="1">
                        </div>
                        <label class="control-label" for="expect_exchange_time">交易时间&nbsp;&nbsp;</label>
                        <div class="controls" style="margin: 10px;">
                            <input id="expect_exchange_time" name="expect_exchange_time" class="input-large" type="text" required>
                        </div>
                        <label class="control-label" for="address_selection">交易地点&nbsp;&nbsp;</label>
                        <div class="controls" style="margin: 10px;">
                            <select id="address_selection" name="address_selection" class="form-control">
                                <option value="1">您的地址</option>
                                <option value="2">卖方地址</option>
                                <option value="0" selected>其他地址</option>
                            </select>
                        </div>
                        <label class="control-label" for="address1">具体地址&nbsp;&nbsp;</label>
                        <div class="controls" style="margin: 10px;">
                            <input id="address1" name="address1" placeholder="楼栋（地点）" class="input-medium" type="text"  required data-provide="typeahead" autocomplete="off">
                            <input id="address2" name="address2" placeholder="房间（选填）" class="input-medium" type="text">
                        </div>
                        <label class="control-label" for="buyer_note">备注信息&nbsp;&nbsp;</label>
                        <div class="controls" style="margin: 10px;">
                            <textarea id="buyer_note" name="buyer_note" style="width: 60%" placeholder="选填"></textarea>
                        </div>
                        <div class="controls">
                            <button id="order_submit_button" name="order_submit_button" class="btn btn-primary" href="javascript:void(0);" onclick="return check();">确认</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
<div class="container">
    <div class="row">
        <div class="span12">
            <ul class="breadcrumb">
                <li>
                    <a href="/market">主页</a> <span class="divider">/</span>
                </li>
                <li>
                    <a href="type?category=<?php echo ($main_category['category_id']); ?>" target="_blank"><?php echo ($main_category['name']); ?></a>
                </li>
                <?php if($branch_category != null): ?><li class="active">
                        <span class="divider">/</span><a href="type?category=<?php echo ($branch_category['category_id']); ?>" target="_blank"><?php echo ($branch_category['name']); ?></a>
                    </li><?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="span3">
            <h4>
                <?php echo ($seller["nickname"]); ?>
            </h4>
            <table class="table table-condensed table-striped">
                <tbody>
                <tr>
                    <td>
                        真实姓名
                    </td>
                    <td>
                        <?php echo ($seller["real_name"]); ?>
                    </td>
                </tr>
                <tr>
                    <td>性别
                    </td>
                    <td>
                        <?php switch($seller["sex"]): case "0": ?>未设置<?php break;?>
                            <?php case "1": ?>男<?php break;?>
                            <?php case "2": ?>女<?php break;?>
                            <?php case "3": ?>保密<?php break; endswitch;?>
                    </td>
                </tr>
                <tr>
                    <td>校区
                    </td>
                    <td><?php echo ($seller["campus_name"]); ?>
                    </td>
                </tr>
                <tr>
                    <td>学院
                    </td>
                    <td><?php echo ($seller["school_name"]); ?>
                    </td>
                </tr>
                <tr>
                    <td>宿舍地址
                    </td>
                    <td><?php echo ($seller["address_name"]); ?>
                    </td>
                </tr>
                <tr>
                    <td>学历或职位
                    </td>
                    <td><?php switch($seller["education"]): case "0": ?>本科<?php break;?>
                            <?php case "1": ?>硕士<?php break;?>
                            <?php case "2": ?>博士<?php break;?>
                            <?php case "3": ?>教职工<?php break;?>
                            <?php default: ?>其他<?php endswitch;?>
                    </td>
                </tr>
                <tr>
                    <td>邮箱
                    </td>
                    <td>仅发起求购后可见
                    </td>
                </tr>
                <tr>
                    <td>QQ
                    </td>
                    <td>仅发起求购后可见
                    </td>
                </tr>
                <tr>
                    <td>联系方式
                    </td>
                    <td>仅发起求购后可见
                    </td>
                </tr>
                <tr>
                    <td>注册日期
                    </td>
                    <td><?php echo ($seller["create_time"]); ?>
                    </td>
                </tr>
                <tr>
                    <td>上次登录日期
                    </td>
                    <td><?php echo ($seller["last_login_time"]); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="span6">
            <h3>
                <?php echo ($product["name"]); ?>
            </h3><br>
            <div class="carousel slide" id="carousel">
                <ol class="carousel-indicators">
                    <?php if(is_array($pictures)): $i = 0; $__LIST__ = $pictures;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($i == 1): ?><li data-slide-to="<?php echo ($i - 1); ?>" data-target="#carousel" class="active">
                            </li>
                        <?php else: ?>
                            <li data-slide-to="<?php echo ($i - 1); ?>" data-target="#carousel">
                            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ol>
                <div class="carousel-inner">
                    <?php if(is_array($pictures)): $i = 0; $__LIST__ = $pictures;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($i == 1): ?><div class="item active">
                                <img alt="" src="<?php echo ($vo['url']); ?>/carousal" style="width: 500px;height: 300px;"/>
                            </div>
                            <?php else: ?>
                            <div class="item">
                                <img alt="" src="<?php echo ($vo['url']); ?>/carousal" style="width: 500px;height: 300px;"/>
                            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <?php if(count($pictures) > 1): ?><a data-slide="prev" href="#carousel" class="left carousel-control">‹</a>
                    <a data-slide="next" href="#carousel" class="right carousel-control">›</a><?php endif; ?>
            </div>
            <h4><?php echo ($product["min_price"]); ?>元<?php if($product['min_price'] + 0.01 < $product['max_price']): ?>-<?php echo ($product["max_price"]); ?>元<?php endif; ?></h4>
            <blockquote>
                 <p><?php switch($product["fineness"]): case "0": ?>七成新以下<?php break;?>
                         <?php case "1": ?>七成新<?php break;?>
                         <?php case "2": ?>八成新<?php break;?>
                         <?php case "3": ?>九成新<?php break;?>
                         <?php case "4": ?>九五成新<?php break;?>
                         <?php case "5": ?>全新<?php break;?>
                         <?php default: ?>未知<?php endswitch;?>
                     <br> 余量<?php echo ($product['quantity'] - $product['quantity_sold']); ?>
                     <br> 来自<?php switch($product["fineness"]): case "1": ?>网购<?php break;?>
                         <?php case "2": ?>代购<?php break;?>
                         <?php case "3": ?>海淘<?php break;?>
                         <?php case "4": ?>线下商店<?php break;?>
                         <?php case "5": ?>奖赠活动<?php break;?>
                         <?php case "6": ?>其他渠道<?php break;?>
                         <?php default: ?>未知渠道<?php endswitch;?>
                     <br> <?php echo ($product["time"]); ?> 发布 <br> <?php echo ($product["modify_time"]); ?> 更新</p>
            </blockquote>
            <?php if($user_info['user_id'] != $product['user_id']): ?><div class="alert alert-success"  id="order_success_alert">
                    发起求购成功！
                </div>
                <div class="controls" align="right">
                    <button id="add_favorite" name="add_favorite" class="btn btn-primary">收藏</button>
                    <button id="delete_favorite" name="delete_favorite" class="btn btn-warning">取消收藏</button>
                    <button id="add_order" name="add_order" class="btn btn-success">求购</button>
                </div>
            <?php else: ?>
                <div class="alert alert-success">
                    商品拥有者不得收藏或求购
                </div><?php endif; ?>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">商品详情</a>
                </li>
                <li>
                    <a href="#tab2" data-toggle="tab">商品问答</a>
                </li>
                <li>
                    <a href="#tab3" data-toggle="tab">相关推荐</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <div class="media">
                        <div class="media-body">
                            <?php echo ($product["description"]); ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2">
                    <form role="form">
                        <div class="alert alert-success"  id="add_question_alert">

                        </div>
                        <div class="form-group">
                            <label for="description">问题</label>
                            <textarea id="description" name="description" class="form-control" type="text" style="width: 95%;" rows="1"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" id="add_question" name="add_question" href="javascript:void(0);" onclick="return check();">提问</button>
                    </form>
                    <div class="media">
                        <a href="#" class="pull-left"></a>
                        <?php if(is_array($q_and_a)): $i = 0; $__LIST__ = $q_and_a;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="media-body">
                                <h4 class="media-heading">
                                    <?php echo ($vo["question"]); ?>
                                </h4> <?php echo ($vo["answer"]); ?>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <div class="tab-pane" id="tab3">
                    <?php if(is_array($similar_products)): $i = 0; $__LIST__ = $similar_products;if( count($__LIST__)==0 ) : echo "以后会有的……" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="media">
                            <a class="pull-left" href="product?product_id=<?php echo ($vo['product_id']); ?>"><img src="<?php echo ($vo["url"]); ?>/square.140" class="media-object" alt='' /></a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a  href="product?product_id=<?php echo ($vo["product_id"]); ?>"><?php echo ($vo["name"]); ?></a>
                                </h4> <?php echo ($vo['min_price']); ?>元<?php if($vo['min_price'] < $vo['max_price']): ?>起<?php endif; ?> |
                                数量 <?php echo ($vo['quantity'] - $vo['quantity_sold']); ?> |
                                <?php switch($vo["fineness"]): case "0": ?>七成新以下<?php break;?>
                                    <?php case "1": ?>七成新<?php break;?>
                                    <?php case "2": ?>八成新<?php break;?>
                                    <?php case "3": ?>九成新<?php break;?>
                                    <?php case "4": ?>九五成新<?php break;?>
                                    <?php case "5": ?>全新<?php break;?>
                                    <?php default: ?>新旧未知<?php endswitch;?>
                            </div>
                        </div><?php endforeach; endif; else: echo "以后会有的……" ;endif; ?>
                </div>
            </div>
        </div>
        <div class="span3">
            <h4>
                看了又看
            </h4>
            <ul class="thumbnails">
                <?php if(is_array($same_category_product)): foreach($same_category_product as $i=>$vo): ?><li class="span3">
                        <div class="thumbnail">
                            <a target="_blank" href="product?product_id=<?php echo ($vo['product_id']); ?>"><img alt="300x225" src="<?php echo ($vo['url']); ?>/rectangle.300" style="width: 220px;height: 150px;"/></a>
                            <div class="caption">
                                <h4>
                                    <a target="_blank" href="product?product_id=<?php echo ($vo['product_id']); ?>"><?php echo ($vo["name"]); ?></a>
                                </h4>
                                <p>
                                    <?php echo ($vo['min_price']); ?>元<?php if($vo['min_price'] < $vo['max_price']): ?>起<?php endif; ?> |
                                    数量 <?php echo ($vo['quantity'] - $vo['quantity_sold']); ?> |
                                    <?php switch($vo["fineness"]): case "0": ?>七成新以下<?php break;?>
                                        <?php case "1": ?>七成新<?php break;?>
                                        <?php case "2": ?>八成新<?php break;?>
                                        <?php case "3": ?>九成新<?php break;?>
                                        <?php case "4": ?>九五成新<?php break;?>
                                        <?php case "5": ?>全新<?php break;?>
                                        <?php default: ?>新旧未知<?php endswitch;?>
                                </p>
                            </div>
                        </div>
                    </li><?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
</div>