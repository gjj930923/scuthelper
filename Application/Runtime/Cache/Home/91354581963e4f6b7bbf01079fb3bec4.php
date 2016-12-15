<?php if (!defined('THINK_PATH')) exit();?><div class="container">
	<div class="row">
		<div class="span12">
			<div class="hero-unit well">
				<p>
					新密码设置后请记住新密码，记住新密码，记住新密码，重要的事情说三遍！
				</p>
			</div>
			<form class="form-horizontal" method="post" action="modifyPassword">
				<fieldset>
					<legend>密码修改</legend>
					
					<div class="control-group">
						<div class="controls">
							<input class="input-large" id="token" name="token" type="hidden" value="<?php echo ($token); ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="new_password">新密码</label>
						<div class="controls">
							<input class="input-large" id="new_password" name="new_password" type="password" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="confirm_password">确认密码</label>
						<div class="controls">
							<input class="input-large" id="confirm_password" name="confirm_password" type="password" />
							<p></p>
						</div>
						
						<div class=" control-group">
							<div class="controls">
								<button class="btn btn-success" id="submit" name="submit">确认修改</button>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>