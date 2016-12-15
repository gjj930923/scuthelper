<?php if (!defined('THINK_PATH')) exit();?><script>
    $(document).ready(function () {
        $('[id^=mark_unread-]').hide();
        $('[id^=mark_read-],[id^=reply_feedback-]').click(function(){
            var feedback_id = $(this).attr("id").replace("mark_read-","").replace("reply_feedback-","");
            $.post("feedbacks/markread",{
                feedback_id:feedback_id
            },function(){
                $('#mark_read-'+feedback_id).hide();
                $('#mark_unread-'+feedback_id).show();
            });
        });
        $('[id^=mark_unread-]').click(function(){
            var feedback_id = $(this).attr("id").replace("mark_unread-","");
            $.post("feedbacks/markread",{
                feedback_id:feedback_id
            },function(){
                $('#mark_unread-'+feedback_id).hide();
                $('#mark_read-'+feedback_id).show();
            });
        });
    })
</script>
<div class="container">
    <div class="row">
        <div class="span12">

        </div>
    </div>
    <div class="row">
        <div class="span3">

        </div>
        <div class="span9">
            <h3>
                反馈处理
            </h3>
            <button class="btn btn-danger" type="button">全部标记为已读</button>
            <table class="table table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th>
                        反馈内容
                    </th>
                    <th>
                        反馈时间
                    </th>
                    <th>
                        操作
                    </th>
                </tr>
                </thead>
                <tbody>
                    <?php if(is_array($unreadFeedbacks)): $i = 0; $__LIST__ = $unreadFeedbacks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="success">
                            <td>
                                <?php echo ($vo["content"]); ?>
                            </td>
                            <td>
                                <?php echo ($vo["release_time"]); ?>
                            </td>
                            <td>
                                <a href="sendMessage?id=<?php echo ($vo["sender_id"]); ?>&title=RE:<?php echo ($vo["content"]); ?>" target="_blank">
                                    <button id="reply_feedback-<?php echo ($vo["feedback_id"]); ?>" class="btn btn-success" type="button">回复反馈</button>
                                </a>
                                    <button id="mark_read-<?php echo ($vo["feedback_id"]); ?>" class="btn btn-primary" type="button">标记为已读</button>
                                    <button id="mark_unread-<?php echo ($vo["feedback_id"]); ?>" class="btn" type="button">标记为未读</button>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>