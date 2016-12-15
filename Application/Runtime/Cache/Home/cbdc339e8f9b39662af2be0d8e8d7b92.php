<?php if (!defined('THINK_PATH')) exit();?><div class="container">
    <div class="row">
        <div class="span12">

        </div>
    </div>
    <div class="row">
        <div class="span4">

        </div>
        <div class="span4">
            <h3>
                前一日商品列表
            </h3>
            <form class="form-horizontal">
                <div class="control-group">
                    <label>标题</label><input type="text" value="<?php echo ($title); ?>"/>
                </div>
                <div class="control-group">
                    <label>摘要</label><input type="text" value="<?php echo ($abstract); ?>"/>
                </div>
                <div class="control-group">
                    <label>原文链接</label><input type="text" />
                </div>
            </form>
        </div>
        <div class="span4">
            <p><?php echo ($content); ?></p>
        </div>
    </div>
</div>