<?php if (!defined('THINK_PATH')) exit();?><script>
	$(document).ready(function() {
		$("[id^='message_title-']").click(function () {
			//post as read
			//todo
			$.post("markAsRead",
				{
					user_id:<?php echo ($user_info["user_id"]); ?>,
					message_id:$(this).children("input").val()
				}, function(data,status){
					//alert("Data: " + data + "\nStatus: " + status);

				});
			var title = $(this).html().replace("<strong>","").replace("</strong>","");
			$(this).html(title);
		});
		$('#page').change(function(){
			window.location.href = "msgbox?page="+$('#page').val();
		});
	});
</script>
<div class="container">
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
					收件箱
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
				<li class="active">
					<a href="#">收件箱</a>
				</li>
				<li>
					<a href="feedback">意见反馈</a>
				</li>
			</ul>
		</div>
		<div class="span10">
			<div class="accordion" id="message_list">
				<?php if(is_array($messages)): $i = 0; $__LIST__ = $messages;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-parent="#message_list" data-toggle="collapse" href="#message-<?php echo ($vo['message_id']); ?>" id="message_title-<?php echo ($vo['message_id']); ?>"><?php if($vo['is_read'] == 0): ?><strong><?php endif; echo ($vo['title']); if($vo['is_read'] == 0): ?></strong><?php endif; ?>
								<span class="label label-warning pull-right"><?php echo ($vo['nickname']); ?></span>
								<span class="label label-info pull-right"><?php echo ($vo['send_time']); ?></span>
								<input type="hidden" value="<?php echo ($vo['message_id']); ?>">
							</a>
						</div>
						<div class="accordion-body collapse" id="message-<?php echo ($vo['message_id']); ?>">
							<div class="accordion-inner">
								<?php echo ($vo['content']); ?>
							</div>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>

			</div>
			<div>
				<div class="col-md-6">
					<select id="page" name="page" class="input-small">
						<?php $__FOR_START_4707__=1;$__FOR_END_4707__=$num_pages+1;for($i=$__FOR_START_4707__;$i < $__FOR_END_4707__;$i+=1){ ?><option value="<?php echo ($i); ?>" <?php if($i == $page): ?>selected<?php endif; ?>>第<?php echo ($i); ?>页</option><?php } ?>
					</select>
				</div>
				<div class="col-md-6">
					<form action="markAllAsRead" method="post">
						<input id="user_id" name="user_id" value="<?php echo ($user_info["user_id"]); ?>" type="hidden">
						<button class="btn btn-primary" type="submit">全部标记为已读</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>