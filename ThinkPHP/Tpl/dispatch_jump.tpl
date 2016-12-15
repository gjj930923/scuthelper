<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf-8">
	<title>跳转提示</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="../css/bootstrap.min-4.css">
</head>
<body>
<div class="modal-fluid show">
	<div class="modal-header">
		<?php if(isset($message)) {?>
		<h3>操作成功</h3>
		<p class="success"><?php echo($message); ?></p>
		<?php }else{?>
		<h3>操作失败</h3>
		<p class="error"><?php echo($error); ?></p>
		<?php }?>
	</div>
	<div class="modal-body">
		<p class="detail"></p>
		<p class="jump">
			等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
		</p>
	</div>
	<div class="modal-footer">
		<a id="href" href="<?php echo($jumpUrl); ?>" class="btn btn-primary">点击直接跳转页面</a>
	</div>
</div>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
	(function(){
		var wait = document.getElementById('wait'),href = document.getElementById('href').href;
		var interval = setInterval(function(){
			var time = --wait.innerHTML;
			if(time <= 0) {
				location.href = href;
				clearInterval(interval);
			};
		}, 1000);
	})();
</script>
</body>
</html>
