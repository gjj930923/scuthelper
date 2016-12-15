<?php if (!defined('THINK_PATH')) exit();?><script>
	$(document).ready(function(){
		$('#question').hide();
		$('#answer_question_alert').hide();
		$('#is_public').change(function(){
			if($(this).is(':checked')) {
				$("#question").show();
			}
			else{
				$("#question").hide();
			}
		});
		$('#answer_question_submit').click(function(){
			$(this).button("loading");
			var public = 0;
			if($('#is_public').is(':checked')) {
				public = 1;
			}
			$.post("answerQuestion",
					{
						user_id:$('#user_id').val(),
						question_id:$('#QA_id').val(),
						answer:$('#answer').val(),
						is_public:public,
						question:$('#question').val()
					},
					function (data,status){
						switch(data){
							case "-1":
								$('#answer_question_alert').show();
								$('#answer_question_alert').html('<strong>警告</strong> 参数错误');
								$('#answer_question_submit').button("reset");
								break;
							case "-2":
								$('#answer_question_alert').show();
								$('#answer_question_alert').html('<strong>警告</strong> 回答内容不得为空');
								$('#answer_question_submit').button("reset");
								break;
							case "-3":
								$('#answer_question_alert').show();
								$('#answer_question_alert').html('<strong>警告</strong> 问题文本不得为空');
								$('#answer_question_submit').button("reset");
								break;
							case "-4":
								$('#answer_question_alert').show();
								$('#answer_question_alert').html('<strong>警告</strong> 该问题已被提问者删除');
								$('#answer_question_submit').button("reset");
								break;
							case "-5":
								$('#answer_question_alert').show();
								$('#answer_question_alert').html('<strong>警告</strong> 内部服务器错误');
								$('#answer_question_submit').button("reset");
								break;
							case "0":
								$('#answer_question_modal').modal('hide');

						}
					}
			);
		});
		$('#delete_question_submit').click(function(){
			$(this).button("loading");
			$.post("deleteQuestion",
					{
						user_id:$('#delete_user_id').val(),
						question_id:$('#delete_question_id').val()
					},
					function (data,status){
						switch(data){
							case "0":
								$('#delete_question_modal').modal('hide');
								$('#delete_question_button-'+$('#delete_question_id').val()).remove();
								$('#QA_user-'+$('#delete_question_id').val()+" td:eq(3)").html('已被删除');
						}
					}
			);
			$(this).button("reset");
		});
	});

	function check(){
		return false;
	}

	function deleteQuestionModal(delete_question_id){
		$('#delete_question_id').val(delete_question_id);
		$('#delete_question_modal').modal('show');
	}

	function answerQuestionModal(QA_id,user_id,question_content){
		$('#QA_id').val(QA_id);
		$('#user_id').val(user_id);
		$('#question_content').html(question_content);
		$('#question').val(question_content);
		$('#answer_question_modal').modal('show');
	}

	function QAdetailModal(question_content,answer){
		$('#question_answer_modal .modal-body h3').html('Q:'+question_content);
		$('#question_answer_modal .modal-body h4').html('A:'+answer);
		$('#question_answer_modal').modal('show');
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
					问答处理
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
				<li class="active">
					<a href="#">问答处理</a>
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
			<ul class="nav nav-pills nav-bars">
				<li class="active">
					<a data-toggle="pill" href="#tab1">未解决</a>
				</li>
				<li>
					<a data-toggle="pill" href="#tab2">已解决</a>
				</li>
				<li>
					<a data-toggle="pill" href="#tab3">我的提问</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<table class="table table-condensed table-striped table-hover">
						<thead>
							<tr>
								<th>
									商品名称
								</th>
								<th>
									问题
								</th>
								<th>
									提问时间
								</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($QAs_unsolved)): $i = 0; $__LIST__ = $QAs_unsolved;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="QA_unsolved-<?php echo ($vo["qa_id"]); ?>">
									<td>
										<?php echo ($vo["name"]); ?>
									</td>
									<td>
										<a data-toggle="modal" href="javascript:void(0);" onclick="answerQuestionModal(<?php echo ($vo["qa_id"]); ?>,<?php echo ($vo["user_id"]); ?>,'<?php echo ($vo["question"]); ?>')"><?php echo ($vo["question"]); ?></a>
									</td>
									<td>
										<?php echo ($vo["release_time"]); ?>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane" id="tab2">
					<table class="table table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th>
									商品名称
								</th>
								<th>
									问题
								</th>
								<th>
									提问时间
								</th>
								<th>
									回答时间
								</th>
								<th>
									是否公开
								</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($QAs_solved)): $i = 0; $__LIST__ = $QAs_solved;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="QA_solved-<?php echo ($vo["qa_id"]); ?>">
									<td>
										<?php echo ($vo["name"]); ?>
									</td>
									<td>
										<a data-toggle="modal" href="javascript:void(0);" onclick="QAdetailModal('<?php echo ($vo["question"]); ?>','<?php echo ($vo["answer"]); ?>')"><?php echo ($vo["question"]); ?></a>
									</td>
									<td>
										<?php echo ($vo["release_time"]); ?>
									</td>
									<td>
										<?php echo ($vo["modify_time"]); ?>
									</td>
									<td>
										<?php if($vo["is_public"] == 1): ?>是
											<?php else: ?>否<?php endif; ?>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane" id="tab3">
					<table class="table table-condensed table-hover table-striped">
						<thead>
						<tr>
							<th>
								商品名称
							</th>
							<th>
								问题
							</th>
							<th>
								提问时间
							</th>
							<th>
								状态
							</th>
							<th>
								操作
							</th>
						</tr>
						</thead>
						<tbody>
						<?php if(is_array($QAs_user)): $i = 0; $__LIST__ = $QAs_user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="QA_user-<?php echo ($vo["qa_id"]); ?>">
								<td>
									<?php echo ($vo["name"]); ?>
								</td>
								<td>
									<a data-toggle="modal" href="javascript:void(0);" onclick="QAdetailModal('<?php echo ($vo["question"]); ?>','<?php echo ($vo["answer"]); ?>')"><?php echo ($vo["question"]); ?></a>
								</td>
								<td>
									<?php echo ($vo["release_time"]); ?>
								</td>
								<td>
									<?php if($vo["status"] == 0): ?>未回答
										<?php else: ?>已回答<?php endif; ?>
								</td>
								<td>
									<?php if($vo["status"] == 0): ?><button class="btn btn-warning" href="javascript:void(0);" onclick="deleteQuestionModal(<?php echo ($vo["qa_id"]); ?>)" data-loading-text="已删除" id="delete_question_button-<?php echo ($vo["qa_id"]); ?>">删除该提问</button><?php endif; ?>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
			</div>

			
			<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal hide fade" id="answer_question_modal" role="dialog">
				<div class="modal-header">
					<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
					<h3 id="myModalLabel">
						问题回答
					</h3>
				</div>
				<div class="modal-body">
					<div class="alert" id="answer_question_alert">

					</div>
					<form class="form-horizontal">
						<fieldset>
							<div class="form-group">
								<input class="input-large" id="user_id" name="user_id" type="hidden" />
								<input class="input-large" id="QA_id" name="QA_id" type="hidden" />
								<h4 id="question_content"></h4>
							</div>
							
							<div class="form-group">
								<input aria-hidden="true" class="input-large" id="question_id" name="question_id" type="hidden" />
							</div>
							
							<div class="form-group">
								<textarea id="answer" name="answer" style="width: 95%"></textarea>
							</div>
							
							<div class="form-group">
								<label class="checkbox" for="is_public"><input id="is_public" name="is_public" value="1" type="checkbox" /> 是否公开？若选择在商品详情页公开则可在下方修改问题内容</label>
							</div>
							
							<div class="form-group">
								<input class="input-xxlarge" id="question" name="question" type="text" />
							</div>
						</fieldset>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" onclick="return check();" id="answer_question_submit">提交</button>
					<button aria-hidden="true" class="btn" data-dismiss="modal">关闭</button>
				</div>
			</div>

			
			<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal hide fade" id="question_answer_modal" role="dialog">
				<div class="modal-header">
					<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
					<h3>
						问答详情
					</h3>
				</div>
				<div class="modal-body">
					<h3>
						Q:
					</h3>
					<h4>
						A:
					</h4>
				</div>
				<div class="modal-footer">
					<button aria-hidden="true" class="btn" data-dismiss="modal">关闭</button>
				</div>
			</div>

			<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal hide fade" id="delete_question_modal" role="dialog">
				<div class="modal-header">
					<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
					<h3>
						操作提示
					</h3>
				</div>
				<div class="modal-body">
					<h3>
						确定要删除该提问？删除后将无法恢复！
					</h3>
					<input type="hidden" id="delete_user_id" value="<?php echo ($user_info["user_id"]); ?>">
					<input type="hidden" id="delete_question_id">
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button" onclick="return check();" id="delete_question_submit">删除</button>
					<button aria-hidden="true" class="btn" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
</div>