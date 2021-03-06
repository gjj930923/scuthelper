<?php if (!defined('THINK_PATH')) exit();?><div class="container">
	<div class="row">
		<div class="span12">
			<ul class="breadcrumb">
				<li>
					<a href="/">主页</a> <span class="divider">/</span>
				</li>
				<li class="active">
					个人中心 <span class="divider">/</span>
				</li>
				<li class="active">
					密码修改
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
				<li>
					<a href="favorite">我的收藏</a>
				</li>
				<li>
					<a href="QAs">问答处理</a>
				</li>
				<li>
					<a href="modifyPersonalInfo">个人信息修改</a>
				</li>
				<li class="active">
					<a href="#">密码修改</a>
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
			<form class="form-horizontal" method="post" action="modifyPassword">
				<fieldset>
					<legend>密码修改</legend>
					<p>密码长度至少八位。</p>
					<div class="control-group">
						<label class="control-label" for="original_password">原密码</label>
						<div class="controls">
							<input id="user_id" name="user_id" type="hidden" value="<?php echo ($user_info["user_id"]); ?>" required/>
							<input id="original_password" name="original_password" class="input-large" type="password" pattern="[\w]{8,}" required/>
						</div>
					</div>
					
					<div class="control-group">
						 <label class="control-label" for="new_password">新密码</label>
						<div class="controls">
							<input id="new_password" name="new_password" class="input-large" type="password" pattern="[\w]{8,}" required/>
						</div>
					</div>
					
					<div class="control-group">
						 <label class="control-label" for="confirm_password">确认密码</label>
						<div class="controls">
							<input id="confirm_password" name="confirm_password" class="input-large" type="password" pattern="[\w]{8,}" required/>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="submit"></label>
						<div class="controls">
							 <button id="submit" name="submit" class="btn btn-success">确认修改</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>