<?php if (!defined('THINK_PATH')) exit();?>
<script>
	function check(){
		return false;
	}
	$(document).ready(function(){
		$("#form2").hide();
		$("#form3").hide();
		$("#alert").hide();
		$('#stu_id').focus();
		$('#address1').typeahead({
			source: function (query, process) {
				var parameter = {query: query};
				$.post('getAddresses', parameter, function (data) {
					process(data);
				});
			}
		});
		$('#turn_to_log_in').click(function(){
			$("#form1").hide();
			$("#form3").show();
			$('#form3 #student_id').val($('#stu_id').val()).focus();
		});
		$('#turn_to_sign_in').click(function(){
			$("#form3").hide();
			$("#form1").show();
			$('#stu_id').val($('#form3 #student_id').val()).focus();
		});
		$("#verify").click(function(){
			$('#stu_id').attr("disabled","disabled");
			$('#library_password').attr("disabled","disabled");
			$('#verify').attr("disabled","disabled");
			$.post("studentIdCertify",
					{
						student_id:$('#stu_id').val(),
						library_password:$('#library_password').val()
					}, function(data,status){
						//alert("Data: " + data + "\nStatus: " + status);
						if(data != "-1" && data != "-2" && data != "-3" && data != "-4") {
							$("#form1").hide(200);
							$("#form2").show();
							$("#student_id").val($('#stu_id').val());
							$("#name").val(data);
							$('#email').focus();
						}
						else{
							$('#stu_id').removeAttr("disabled");
							$('#library_password').removeAttr("disabled");
							$('#verify').removeAttr("disabled");
							$("#alert").show();
							if(data == "-1"){
								$("#alertText").text("图书馆学号或密码错误。");
						}
							else if(data == "-2"){
								$("#alertText").text("暂时无法登录图书馆网站。");
							}
							else if(data == "-3"){
								$("#alertText").text("该学号已被注册。");
							}
							else if(data == "-4"){
								$("#alertText").text("学号密码不得为空。");
							}
						}
					});
		});
		$("#submit").click(function(){
			$('#email').attr("disabled","disabled");
			$('#password').attr("disabled","disabled");
			$('#confirm_password').attr("disabled","disabled");
			$('#submit').attr("disabled","disabled");
			$.post("signinCertify",
					{
						student_id:$('#student_id').val(),
						name:$('#name').val(),
						email:$('#email').val(),
						password:$('#password').val(),
						confirm_password:$('#confirm_password').val(),
						nickname:$('#nickname').val(),
						qq:$('#qq').val(),
						address1:$('#address1').val(),
						campus:$('#campus').val(),
						school:$('#school').val(),
						phone:$('#phone').val()
					}, function(data,status){
						//alert("Data: " + data + "\nStatus: " + status);

						if(data < 0){
							$('#email').removeAttr("disabled");
							$('#password').removeAttr("disabled");
							$('#confirm_password').removeAttr("disabled");
							$('#submit').removeAttr("disabled");
							$("#alert").show();
						}
						else{
							window.location.href="./modifyPersonalInfo";
						}

						if(data == "-1"){
							$("#alertText").text("姓名不得为空。");
						}
						else if(data == "-2"){
							$("#alertText").text("邮箱为空或无效");
						}
						else if(data == "-3"){
							$("#alertText").text("密码不合要求");
						}
						else if(data == "-4"){
							$("#alertText").text("密码和确认密码不一致");
						}
						else if(data == "-5"){
							$("#alertText").text("该学号已被注册。");
						}
						else if(data == "-6"){
							$("#alertText").text("昵称不得为空。");
						}
						else if(data == "-7"){
							$("#alertText").text("qq号格式不正确。");
						}
						else if(data == "-8"){
							$("#alertText").text("手机号格式不正确。");
						}
					});
		});

		$('#forget_password').click(function(){
			$('#forget_password').attr('disabled','disabled');
			$.post("getBackPassword",{
				student_id:$('#form3 #student_id').val()
			},function(data){
				$("#alert").show();
				if(data < 0){
					$('#forget_password').removeAttr('disabled');
				}
				if(data == "-1"){
					$("#alertText").text("用户未注册。");
				}
				else if(data == "-2"){
					$("#alertText").text("重置密码链接生成失败");
				}
				else if(data == "-3"){
					$("#alertText").text("邮件发送失败");
				}
				else if(data == "-4"){
					$("#alertText").text("学号不得为空");
				}
				else if(data.email){
					$("#alertText").text("重置邮件已发送至您设定的邮箱 "+data.email+"。请注意查收，并设置邮箱 scuthelper3@sina.com 和 scuthelper@163.com 至您的邮箱白名单！");
				}
			});
		});
	});
</script>
<div class="container">

	<div class="row">
		<div class="span12">
			<?php if(!empty($alert)): ?><div class="alert alert-error" id="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>
					提示
				</h4>
				<strong><?php echo ($alert); ?></strong>
			</div><?php endif; ?>


			<div class="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>
					提示
				</h4>
				<strong>本网站不会以任何形式保存华南理工大学OPAC图书馆密码，仅用于验证学生身份。<a href="http://202.38.232.10/opac/servlet/opac.go?cmdACT=mylibrary.index" target="_blank">点击进入华南理工大学OPAC图书馆网站</a><br>若部分输入框无法输入，请按Ctrl+F5键强制刷新~</strong>
			</div>

		</div>
	</div>

	<div class="row">
		<div class="span3"></div>
		<div class="span6">
			<form id="form1" class="form-horizontal">
				<h3 class="text-success" align="center">
					注册
				</h3>
				<div class="control-group">
					<label class="control-label" for="stu_id">学号</label>
					<div class="controls">
						<input id="stu_id" name="stu_id" type="text" pattern="[0-9]{12}" required/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="library_password">OPAC图书馆密码</label>
					<div class="controls">
						<input id="library_password" name="library_password" type="password" required placeholder="默认为学号后6位"/>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button id="verify" type="submit" class="btn btn-primary" onclick="return check();">验证</button>
						<button id="turn_to_log_in" type="submit" class="btn btn-info" onclick="return check();">我已注册</button>
					</div>
				</div>
			</form>
			<form id="form2" class="form-horizontal" action="signinCertify" method="post">
				<div class="control-group">
					<label class="control-label" for="student_id">学号</label>
					<div class="controls">
						<input id="student_id" name="student_id" type="text" disabled/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="name">姓名</label>
					<div class="controls">
						<input id="name" name="name" type="text" disabled />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="email">邮箱</label>
					<div class="controls">
						<input id="email" type="text" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password">本站密码</label>
					<div class="controls">
						<input id="password" type="password" required pattern="[a-zA-Z0-9]{9}[a-zA-Z0-9]*"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="confirm_password">确认密码</label>
					<div class="controls">
						<input id="confirm_password" type="password" required pattern="[a-zA-Z0-9]{9}[a-zA-Z0-9]*" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="nickname">昵称</label>
					<div class="controls">
						<input id="nickname" name="nickname" class="input-large" size="42" type="text" required/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="qq">QQ</label>
					<div class="controls">
						<input id="qq" name="qq" class="input-large" size="13" type="text" required/>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="phone">手机号码</label>
					<div class="controls">
						<input id="phone" name="phone" class="input-large" size="11" type="text" pattern="1[34578][0-9]{9}" required/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="address1">楼栋</label>
					<div class="controls">
						<input id="address1" name="address1" class="input-large" size="50" type="text" required data-provide="typeahead" autocomplete="off"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="campus">校区</label>
					<div class="controls">
						<select id="campus" name="campus" class="input-large">
							<?php if(is_array($campus_list)): $i = 0; $__LIST__ = $campus_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["campus_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="school">学院</label>
					<div class="controls">
						<select id="school" name="school" class="input-large">
							<?php if(is_array($school_list)): $i = 0; $__LIST__ = $school_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["school_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button id="submit" type="submit" class="btn btn-primary" onclick="return check();" >注册</button>
					</div>
				</div>
			</form>
			<form id="form3" class="form-horizontal" action="loginCertify" method="post">
				<h3 class="text-success" align="center">
					登录
				</h3>
				<div class="control-group">
					<label class="control-label" for="student_id">学号</label>
					<div class="controls">
						<input id="student_id" name="student_id" type="text" required/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password">密码</label>
					<div class="controls">
						<input id="password" name="password" type="password" required pattern="[a-zA-Z0-9]{9}[a-zA-Z0-9]*"/>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary">登录</button>
						<button id="turn_to_sign_in" type="submit" class="btn btn-info" onclick="return check();">还没注册</button>
						<button type="button" href="javascript:void(0);" onclick="return check();" class="btn btn-warning" id="forget_password">忘记密码</button>
					</div>
				</div>
			</form>
			<div class="alert alert-error" id="alert">
				<strong id="alertText"></strong>
			</div>
		</div>
	</div>
</div>