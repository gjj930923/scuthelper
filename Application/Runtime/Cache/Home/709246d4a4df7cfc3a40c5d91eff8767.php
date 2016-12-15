<?php if (!defined('THINK_PATH')) exit();?><script>
    $(document).ready(function(){
        $("#show_all_orders").hide();
        $('#delete_order_submit').click(function(){
            $(this).button("loading");
            $.post("deleteOrder",
                    {
                        user_id:$('#delete_user_id').val(),
                        order_id:$('#delete_order_id').val()
                    },
                    function (data,status){
                        switch(data){
                            case "0":
                                $('#delete_order_modal').modal('hide');
                                $('#delete_order_button-'+$('#delete_order_id').val()).remove();
                                $('#order-'+$('#delete_order_id').val()+" td:eq(5)").html('已被您删除');
                        }
                    }
            );
            $(this).button("reset");
        });
        $("#hide_deleted_orders").click(function(){
            $("tbody .success").hide();
            $("tbody .others").hide();
            $("#show_all_orders").show();
            $(this).hide();
        });
        $("#show_all_orders").click(function(){
            $("tbody .success").show();
            $("tbody .others").show();
            $("#hide_deleted_orders").show();
            $(this).hide();
        });
    });

    function check(){
        return false;
    }

    function deleteOrderModal(delete_order_id){
        $('#delete_order_id').val(delete_order_id);
        $('#delete_order_modal').modal('show');
    }
</script>
<div class="container">
    <div class="row">
        <div class="span12">
            <ul class="breadcrumb">
                <li>
                    <a href="#">主页</a> <span class="divider">/</span>
                </li>
                <li class="active">
                    个人中心<span class="divider">/</span>
                </li>
                <li class="active">
                    求购信息处理
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="span2">
            <ul class="nav nav-list">
                <li class="active">
                    <a href="#">我的商品与求购</a>
                </li>
                <li>
                    <a href="favorite">我的收藏</a>
                </li>
                <li>
                    <a href="QAs">问答处理</a>
                </li>
                <li>
                    <a href="modifyPersonalInfo">个人信息修改</a>
                </li>
                <li>
                    <a href="password">密码修改</a>
                </li>
                <li>
                    <a href="msgbox">收件箱</a>
                </li>
                <li>
                    <a href="feedback">意见反馈</a>
                </li>
            </ul>
        </div>
        <div class="span10">
            <button id="hide_deleted_orders" name="hide_deleted_orders" class="btn btn-info">只显示待处理求购</button>
            <button id="show_all_orders" name="show_all_orders" class="btn btn-info">显示全部求购</button>
            <table class="table">
                <thead>
                <tr>
                    <th>
                        商品
                    </th>
                    <th>
                        数量
                    </th>
                    <th>
                        单价（元）
                    </th>
                    <th>
                        期望交易时间
                    </th>
                    <th>
                        实际交易时间
                    </th>
                    <th>
                        交易地址
                    </th>
                    <th>
                        操作
                    </th>
                </tr>
                </thead>
                <tbody>
                    <?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["status"] == 0): ?><tr class="warning" id="order-<?php echo ($vo["order_id"]); ?>">
                            <?php elseif($vo["status"] == 1): ?>
                            <tr class="success" id="order-<?php echo ($vo["order_id"]); ?>">
                            <?php else: ?>
                            <tr class="others" id="order-<?php echo ($vo["order_id"]); ?>"><?php endif; ?>
                            <td>
                                <?php echo ($vo["name"]); ?>
                            </td>
                            <td>
                                <?php echo ($vo["quantity"]); ?>
                            </td>
                            <td>
                                <?php if($vo["status"] == 0): echo ($vo["payment_amount"]); ?>（待确认）
                                    <?php elseif($vo["status"] == 1): ?>
                                    <strong><?php echo ($vo["payment_amount"]); ?>（已确认）</strong>
                                    <?php else: ?>
                                    <?php echo ($vo["payment_amount"]); endif; ?>
                            </td>
                            <td>
                                <?php echo ($vo["expect_exchange_time"]); ?>
                            </td>
                            <td>
                                <?php if($vo["status"] == 0): ?>待确定
                                    <?php elseif($vo["status"] == 1): ?>
                                    <strong><?php echo ($vo["real_exchange_time"]); ?></strong>
                                    <?php else: ?>
                                    N/A<?php endif; ?>
                            </td>
                            <td>
                                <?php if($vo["status"] == 0): echo ($vo["content"]); ?>-<?php echo ($vo["address2"]); ?>（待确认）
                                    <?php elseif($vo["status"] == 1): ?>
                                        <strong><?php echo ($vo["content"]); ?>-<?php echo ($vo["address2"]); ?>（已确认）</strong>
                                    <?php else: ?>
                                        <?php echo ($vo["content"]); ?>-<?php echo ($vo["address2"]); endif; ?>
                            </td>
                            <td>
                                <?php if($vo["status"] == 0): ?><button class="btn btn-danger btn-small" href="javascript:void(0);" onclick="deleteOrderModal(<?php echo ($vo["order_id"]); ?>)">撤销求购</button>
                                <?php elseif($vo["status"] == 1): ?>
                                    已同意
                                <?php elseif($vo["status"] == 2): ?>
                                    商品已被删除
                                <?php elseif($vo["status"] == 3): ?>
                                    已被卖家撤销
                                <?php elseif($vo["status"] == 4): ?>
                                    已被您撤销<?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
        <!--Modal模态框 -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal hide fade" id="delete_order_modal" role="dialog">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                <h3>
                    操作提示
                </h3>
            </div>
            <div class="modal-body">
                <h3>
                    确定要删除该求购信息？删除后将无法恢复！
                </h3>
                <input type="hidden" id="delete_user_id" value="<?php echo ($user_info["user_id"]); ?>">
                <input type="hidden" id="delete_order_id">
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" onclick="return check();" id="delete_order_submit">删除</button>
                <button aria-hidden="true" class="btn" data-dismiss="modal">关闭</button>
            </div>
        </div><!--End Modal模态框 -->
    </div>
</div>