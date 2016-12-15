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

    <title>华工网址导航</title>
    


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
      <h1>[交易状态]商品1</h1>
      <p>二手市场首页&nbsp;/&nbsp;大类1&nbsp;/&nbsp;小类1</p>
      <div class="row featurette">
        <div class="col-md-4">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="..." alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="..." alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        </div>
        <div class="col-md-5">
          <ul class="list-group">
            <li class="list-group-item  list-group-item-success">商品信息</li>
  			<li class="list-group-item">价格：</li>
  			<li class="list-group-item">成色：</li>
  			<li class="list-group-item">校区：</li>
  			<li class="list-group-item">发布时间：</li>
  			<li class="list-group-item">点击量：</li>
            <li class="list-group-item"><button type="button" class="btn btn-block btn-lg btn-info" >我想要！</button></li>
		</ul>
        </div>
        <div class="col-md-3">
          <ul class="list-group">
            <li class="list-group-item  list-group-item-success">卖家信息</li>
  			<li class="list-group-item">卖家昵称：</li>
  			<li class="list-group-item">所在宿舍：</li>
  			<li class="list-group-item">手机号：</li>
  			<li class="list-group-item">QQ：</li>
  			<li class="list-group-item">Email：</li>
		</ul>
        </div>
      </div>
    </div>
    <hr>
    <div class="container">
	<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#intro" aria-controls="home" role="tab" data-toggle="tab">商品描述</a></li>
    <li role="presentation"><a href="#comments" aria-controls="profile" role="tab" data-toggle="tab">评论<span class="badge">X</span></a></li>
    <li role="presentation"><a href="#wanting" aria-controls="messages" role="tab" data-toggle="tab">求购记录<span class="badge">X</span></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="intro">
    <p>Intros</p>
    <img class="media-object" data-src="holder.js/64x64" alt="Generic placeholder image">
    </div>
    <div role="tabpanel" class="tab-pane" id="comments">
    <ul class="media-list">
  <div class="media-body">
          <div class="media">
            <div class="media-body">
              <h4 class="media-heading">Media heading</h4>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
            </div>
          </div>
          <!-- Nested media object -->
          <div class="media">
            <div class="media-left">
                <img class="media-object" data-src="holder.js/64x64" alt="Generic placeholder image" height="64" width="64">
            </div>
            <div class="media-body">
              <h4 class="media-heading">Nested media heading</h4>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
            </div>
          </div>
          </div>
	</ul>
    </div>
    <div role="tabpanel" class="tab-pane" id="wanting">
    <ul class="list-group">
  <li class="list-group-item">
    <span class="label label-default">未确认</span>
    <span class="badge">2015-11-11 11:22:33</span>
    Nickname
  </li>
</ul>
    </div>
  </div>
  </div>
</div>
<hr>
<div class="container">
   <h2>看了又看</h2>
        <div class="col-md-6">
        <table width="200" border="0" class="table table-striped" style="table-layout:fixed;">
  <tr>
    <th scope="row">1</th>
    <td>1A</td>
    <td>1A</td>
    <td>1A</td>
    <td>1A</td>
    <td>1A</td>
  </tr>
  <tr>
    <th scope="row">2</th>
    <td>2A</td>
    <td>2A</td>
    <td>体育用品</td>
    <td>2A</td>
    <td>2A</td>
  </tr>
  <tr>
    <th scope="row">3</th>
    <td>3A</td>
    <td>3A</td>
    <td>3A</td>
    <td>3A</td>
    <td>3A</td>
  </tr>
  <tr>
    <th scope="row">4</th>
    <td>4A</td>
    <td>4A</td>
    <td>4A</td>
    <td>4A</td>
    <td>4A</td>
  </tr>
  <tr>
    <th scope="row">5</th>
    <td>5A</td>
    <td>5A</td>
    <td>5A</td>
    <td>5A</td>
    <td>5A</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

        </div>
        <div class="col-md-6">
        <table width="200" border="0" class="table table-striped" style="table-layout:fixed;">
  <tr>
    <th scope="row">1</th>
    <td>1A</td>
    <td>1A</td>
    <td>1A</td>
    <td>1A</td>
    <td>1A</td>
  </tr>
  <tr>
    <th scope="row">2</th>
    <td>2A</td>
    <td>2A</td>
    <td>体育用品</td>
    <td>2A</td>
    <td>2A</td>
  </tr>
  <tr>
    <th scope="row">3</th>
    <td>3A</td>
    <td>3A</td>
    <td>电脑DIY组件</td>
    <td>3A</td>
    <td>3A</td>
  </tr>
  <tr>
    <th scope="row">4</th>
    <td>4A</td>
    <td>4A</td>
    <td>4A</td>
    <td>4A</td>
    <td>4A</td>
  </tr>
  <tr>
    <th scope="row">5</th>
    <td>5A</td>
    <td>5A</td>
    <td>5A</td>
    <td>5A</td>
    <td>5A</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

        </div>
    </div> <!-- /container -->
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