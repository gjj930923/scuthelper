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

    <title>搜索结果</title>
    


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
	
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container" align="center">
        <h2>搜索结果</h2>
        <p></p>
      </div>
    </div>

    <!--<div class="container">-->
        <div class="col-md-2">
        <form action="" method="get">
    <p><input name="name" type="text"  class="form-control placeholder="商品名称""></p>
    <p><select class="form-control select select-primary" data-toggle="select" id="grade">
            <option value="0">成色</option>
          </select></p>
  <p><div class="input-group input-group-sm">
  <span class="input-group-addon" id="sizing-addon2">最低价</span>
  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon2">
</div></p>

    <p><div class="input-group input-group-sm">
  <span class="input-group-addon" id="sizing-addon2">最高价</span>
  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon2">
</div></p>

   <p><input name="bargain" type="checkbox" value=""> 接受议价</p>

    <p><button type="button" class="btn btn-success">提交</button></p>
</form>
        </div>
        <div class="col-md-10">
        <div class="col-lg-2">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 150px; height: 150px;">
          <h4>Heading</h4>
          <p>价格：888元</p></div><!-- /.col-lg-2 -->
          <div class="col-lg-2">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 150px; height: 150px;">
          <h4>Heading</h4>
          <p>价格：888元</p></div><!-- /.col-lg-2 -->
          <div class="col-lg-2">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 150px; height: 150px;">
          <h4>Heading</h4>
          <p>价格：888元</p></div><!-- /.col-lg-2 -->
          <div class="col-lg-2">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 150px; height: 150px;">
          <h4>Heading</h4>
          <p>价格：888元</p></div><!-- /.col-lg-2 -->
          <div class="col-lg-2">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 150px; height: 150px;">
          <h4>Heading</h4>
          <p>价格：888元</p></div><!-- /.col-lg-2 -->
          <div class="col-lg-2">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 150px; height: 150px;">
          <h4>Heading</h4>
          <p>价格：888元</p></div><!-- /.col-lg-2 -->
          <div class="col-lg-2">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 150px; height: 150px;">
          <h4>Heading</h4>
          <p>价格：888元</p></div><!-- /.col-lg-2 -->
        </div>
    <!--</div>--> <!-- /container -->
     
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