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
					意见反馈
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
				<li>
					<a href="password">密码修改</a>
				</li>
				<li>
					<a href="msgbox">收件箱</a>
				</li>
				<li class="active">
					<a href="#">意见反馈</a>
				</li>
			</ul>
		</div>
		<div class="span10">
			<form class="form-horizontal" method="post" action="addFeedback">
				<fieldset>
					<legend>您的意见是我们最大的动力，反馈内容不少于20字。</legend>
					
					<div class="control-group">
						<input class="input-large" id="user_id" name="user_id" value="<?php if($user_info != null): echo ($user_info['user_id']); else: ?>0<?php endif; ?>" type="hidden" />
					</div>
					
					<div class="control-group">
						<textarea rows="5" cols="60" id="feedback" name="feedback" style="width: 95%">
						</textarea>
					</div>
					
					<div class="control-group">
						 <button class="btn btn-success" id="submit" name="submit">提交</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>