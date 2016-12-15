<?php if (!defined('THINK_PATH')) exit();?><script>
    $(document).ready(function(){
        $('#page').change(function(){
            var array = window.location.href.split('?');
            window.location.href = array[0]+"?page="+$('#page').val();
        });
        $('#show_all_products').hide();
        $('#hide_deleted_products').click(function(){
            $('.others').hide();
            $('#show_all_products').show();
            $(this).hide();
        });
        $('#show_all_products').click(function(){
            $('.others').show();
            $('#hide_deleted_products').show();
            $(this).hide();
        });
        $('#delete_favorite_submit').click(function () {
            $.post("modifyFavorite",
                    {
                        user_id:'<?php echo ($user_info["user_id"]); ?>',
                        product_id:$('#delete_favorite_id').val()
                    },function (data,status){
                        if(data == 1 || data == 0){
                            $('#delete_favorite_modal').modal('hide');
                            window.location.href = "";
                        }
                    }
            );
        });
    });

    function check(){
        return false;
    }

    function deleteFavorite(product_id){
        $('#delete_favorite_id').val(product_id);
        $('#delete_favorite_modal').modal('show');
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
                    我的收藏
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="span2">
            <ul class="nav nav-list">
                <li>
                    <a href="orders">我的商品与求购</a>
                </li>
                <li class="active">
                    <a href="#">我的收藏</a>
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
            <button class="btn btn-info" type="button" id="show_all_products">显示全部商品</button>
            <button class="btn btn-info" type="button" id="hide_deleted_products">隐藏已删除商品</button>
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
                        价格（元）
                    </th>
                    <th>
                        卖方地址
                    </th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["is_deleted"] == 0) and ($vo['quantity_sold'] < $vo['quantity'])): ?><tr class="info" id="product-<?php echo ($vo["favour_id"]); ?>">
                            <?php else: ?>
                        <tr class="others" id="product-<?php echo ($vo["favour_id"]); ?>"><?php endif; ?>
                    <td>
                        <a target="_blank" href="product?product_id=<?php echo ($vo["product_id"]); ?>"><?php echo ($vo["name"]); ?></a>
                    </td>
                    <td>
                        <?php if($vo["is_deleted"] == 0): if($vo['quantity_sold'] < $vo['quantity']): echo ($vo['quantity']-$vo['quantity_sold']); ?>
                                <?php else: ?>已售罄<?php endif; ?>
                            <?php else: ?>商品已被删除<?php endif; ?>
                    </td>
                    <td>
                        <?php echo ($vo["min_price"]); ?>
                        <?php if($vo["min_price"] < $vo.max_price): ?>- <?php echo ($vo["max_price"]); endif; ?>
                    </td>
                    <td>
                        <?php echo ($vo["content"]); ?>-<?php echo ($vo["address2"]); ?>
                    </td>
                    <td>
                        <button id="delete" name="delete" class="btn btn-danger btn-small" href="javascript:void(0);" onclick="deleteFavorite(<?php echo ($vo["product_id"]); ?>)">删除</button>
                    </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
        <!--Modal模态框 -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal hide fade" id="delete_favorite_modal" role="dialog">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                <h3>
                    操作提示
                </h3>
            </div>
            <div class="modal-body">
                <h3>
                    确定要删除该收藏信息？删除后将无法恢复！
                </h3>
                <input type="hidden" id="delete_user_id" value="<?php echo ($user_info["user_id"]); ?>">
                <input type="hidden" id="delete_favorite_id">
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" onclick="return check();" id="delete_favorite_submit">删除</button>
                <button aria-hidden="true" class="btn" data-dismiss="modal">关闭</button>
            </div>
        </div><!--End Modal模态框 -->
        <div align="right">
            <select id="page" name="page" class="input-small">
                <?php $__FOR_START_3351__=1;$__FOR_END_3351__=$num_pages+1;for($i=$__FOR_START_3351__;$i < $__FOR_END_3351__;$i+=1){ ?><option value="<?php echo ($i); ?>" <?php if($i == $page): ?>selected<?php endif; ?>>第<?php echo ($i); ?>页</option><?php } ?>
            </select>
        </div>
    </div>
</div>