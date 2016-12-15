<?php if (!defined('THINK_PATH')) exit();?><script>
    $(document).ready(function(){
        $('table[id^=info-]').hide();
        $('#info-0').show();
        $('#type_select').change(function(){
            $('table[id^=info-]').hide();
            $('#info-'+$('#type_select').val()).show();
        });
    });
</script>
<div class="container">
    <div class="row">
    </div>
    <div class="row">
        <div class="span3">
        </div>
        <div class="span9">
            <h3>
                Dashboard
            </h3>
            <select id="type_select" name="type_select" class="form-control">
                <option value="0">全部信息</option>
                <?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($i); ?>"><?php echo ($item['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <table class="table" id="info-0">
                <thead>
                <tr>
                    <th>日期</th>
                    <th>发布商品数</th>
                    <th>提交求购数</th>
                    <th>达成交易数</th>
                    <th>取消求购数</th>
                    <th>新用户数</th>
                </tr>
                </thead>
                <?php if(is_array($countByDay)): $i = 0; $__LIST__ = $countByDay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tbody>
                    <tr class="success">
                        <td><?php echo ($vo['date']); ?></td>
                        <td><?php echo ($vo['release']); ?></td>
                        <td><?php echo ($vo['release_order'][0]); ?></td>
                        <td><?php echo ($vo['deal_order'][0]); ?></td>
                        <td><?php echo ($vo['cancel_order'][0]); ?></td>
                        <td><?php echo ($vo['new_user']); ?></td>
                    </tr>
                    </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><table class="table" id="info-<?php echo ($i); ?>">
                    <thead>
                    <tr>
                        <th>日期</th>
                        <th>提交求购数</th>
                        <th>达成交易数</th>
                        <th>取消求购数</th>
                    </tr>
                    </thead>
                    <?php if(is_array($countByDay)): $j = 0; $__LIST__ = $countByDay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($j % 2 );++$j;?><tbody>
                        <tr class="success">
                            <td><?php echo ($vo['date']); ?></td>
                            <td><?php echo ($vo['release_order'][$i]); ?></td>
                            <td><?php echo ($vo['deal_order'][$i]); ?></td>
                            <td><?php echo ($vo['cancel_order'][$i]); ?></td>
                        </tr>
                        </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
                </table><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>