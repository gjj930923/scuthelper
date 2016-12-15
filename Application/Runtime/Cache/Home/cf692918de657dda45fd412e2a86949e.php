<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php $public_url = "http://3.scuthelper.sinaapp.com/Application/Home/View/Public/"; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo ($_SERVER['SCRIPT_NAME']); ?>/../Application/Home/View/Image/logo.jpg">

    <title>用户中心</title>
    


    <!-- Bootstrap core CSS -->
    <link href="<?php echo $public_url ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $public_url ?>css/navbar.css" rel="stylesheet">
	
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
	<font face="微软雅黑">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          
          <a class="navbar-brand" href="#"><img src="<?php echo ($_SERVER['SCRIPT_NAME']); ?>/../Application/Home/View/Image/logo.jpg" alt="SCUTHelper" height="30" width="30"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          <li><a href="#">网址导航</a></li>

            <li class="active"><a href="#about">二手市场</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><script type="text/javascript" src="http://ext.weather.com.cn/92108.js"></script></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
    <div>
      <p>&nbsp;</p>
    </div>

    <div class="container">
      <div class="row">
    <div class="col-md-2">
    <div class="list-group">
            <a href="#" class="list-group-item active">
             个人管理
            </a>
            <a href="#" class="list-group-item">个人资料</a>
            <a href="#" class="list-group-item">修改密码</a>
            <a href="#" class="list-group-item">系统信息</a>
    </div>
    <div class="list-group">
            <a href="#" class="list-group-item active">
              商品管理
            </a>
            <a href="#" class="list-group-item">用户提问</a>
            <a href="#" class="list-group-item">收藏夹</a>
            <a href="#" class="list-group-item">发布商品</a>
            <a href="#" class="list-group-item">修改或删除商品</a>
    </div>
    </div>
    <div class="col-md-10">
    <div class="page-header">
        <h1>个人资料</h1>
    </div>
    <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#intro" aria-controls="home" role="tab" data-toggle="tab">个人信息</a></li>
    <li role="presentation"><a href="#comments" aria-controls="profile" role="tab" data-toggle="tab">编辑信息</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="intro">
    
    <table class="table">
  <tr>
    <th scope="col">昵称：</th>
    <th scope="col">真实姓名：</th>
    <th scope="col">QQ</th>
    <th scope="col">邮箱</th>
  </tr>
  <tr>
    <th scope="col">手机：</th>
    <th scope="col">移动短号：</th>
    <th scope="col">宿舍楼：</th>
    <th scope="col">房号：</th>
  </tr>
  <tr>
    <th scope="col">年级：</th>
    <th scope="col">学历：</th>
    <th scope="col">学院：</th>
    <th scope="col">专业与班级：</th>
  </tr>
</table>
<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 8em; width: 50%;">
    资料完整度：50%
  </div>
</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="comments">
    <div class="row">
    <div class="col-xs-3">
    <div class="input-group">
  <span class="input-group-addon">昵称</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
<div class="input-group">
  <span class="input-group-addon">手机</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
<div class="input-group">
  <span class="input-group-addon">年级</span>
  <input type="text" class="form-control" placeholder="输入年份如“2012级”" aria-describedby="basic-addon1">
</div>
<button type="button" class="btn btn-primary">
  <span class="glyphicon glyphicon-star" aria-hidden="true"></span> 保存
</button>
    </div>
    <div class="col-xs-3">
    <div class="input-group">
  <span class="input-group-addon">真实姓名</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
<div class="input-group">
  <span class="input-group-addon">移动短号</span>
  <input type="text" class="form-control" placeholder="可空白" aria-describedby="basic-addon1">
</div>
<div class="input-group">
  <span class="input-group-addon">学历</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col-xs-3">
    <div class="input-group">
  <span class="input-group-addon">QQ</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
<div class="input-group">
  <span class="input-group-addon">宿舍楼</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
<div class="input-group">
  <span class="input-group-addon">学院</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col-xs-3">
    <div class="input-group">
  <span class="input-group-addon">邮箱</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
<div class="input-group">
  <span class="input-group-addon">房号</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
<div class="input-group">
  <span class="input-group-addon">专业与班级</span>
  <input type="text" class="form-control" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    </div>
  </div>
  </div>
    
	
      </div>
      </div>
    </div>

	<div align="center"><iframe src="http://rcm-cn.amazon-adsystem.com/e/cm?t=gjj930923-23&o=28&p=285&l=ez&f=ifr&f=ifr" width="950" height="80" scrolling="no" marginwidth="0" marginheight="0" border="0" frameborder="0" style="border:none;"></iframe></div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo $public_url ?>js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
	</font>
  </body>
</html>