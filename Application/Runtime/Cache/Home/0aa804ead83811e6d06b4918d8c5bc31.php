<?php if (!defined('THINK_PATH')) exit();?><script>
    $(document).ready(function(){
        $('#receiver_id').focusout(function(){
            var id = $(this).val();
            $.post("../../isUser",{
                user_id_or_student_id: id
            },function(data){
                if(data == 0){
                    $('#check_result').html("该用户存在");
                }
                else if(data == -1){
                    $('#check_result').html("该用户不存在");
                }
                else{
                    $('#check_result').html("输入不规范或未知错误");
                }
            });
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="span12">

        </div>
    </div>
    <div class="row">
        <div class="span4">
        </div>
        <div class="span8">
            <h3>
                发送信息
            </h3>
            <form class="form-horizontal" action="../messageSending" method="post">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="sender_id"></label>
                        <div class="controls">
                            <input id="sender_id" name="sender_id" class="input-large" value="-1" type="hidden" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="receiver_id">用户id号或学号</label>
                        <div class="controls">
                            <input id="receiver_id" name="receiver_id" class="input-large" type="text" value="<?php echo ($id); ?>"/>
                            <p class="help-block" id="check_result" name="check_result">

                            </p>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="title">标题</label>
                        <div class="controls">
                            <input id="title" name="title" class="input-xlarge" type="text" value="<?php echo ($title); ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="content" >内容</label>
                        <div class="controls">
							<textarea id="content" name="content" style="width: 95%;" rows="5"><?php echo ($content); ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="submit"></label>
                        <div class="controls">
                            <button id="submit" name="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>