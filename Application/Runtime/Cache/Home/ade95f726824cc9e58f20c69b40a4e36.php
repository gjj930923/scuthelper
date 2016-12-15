<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <!--<?php $public_url = "http://3.scuthelper.applinzi.com/Application/Home/View/Public/"; ?>-->
    
    <!--<?php $public_url = $_SERVER['HTTP_HOST']."../Application/Home/View/Public/";?>-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="Application/Home/View/Image/logo.jpg">

    <title><?php echo ($title); ?> - 二手市场 - 华工小助手</title>
    
    <!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="../css/bootstrap.min-4.css">

	<!-- 可选的Bootstrap主题文件（一般不用引入）
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/2.3.2/css/bootstrap-theme.min.css">-->

    <link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">


	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
    <script src="../js/plupload.full.min.js"></script>
    <script src="../js/qiniu.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->


    </head>

    <body style="padding: 50px;">

    <font face="微软雅黑">
    <div class="navbar navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container-fluid">
              <a class="btn btn-navbar" data-target=".navbar-responsive-collapse" data-toggle="collapse"></a> <a class="brand" href="#">华工小助手</a>
              <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav">
                  <li>
                     <a href="/">网址导航</a>
                  </li>
                  <li class="active">
                     <a href="/market">二手市场</a>
                  </li>
                </ul>
                <ul class="nav pull-right">
                    <?php if(empty($user_info)): ?><li>
                     <a href="/market/login">注册</a>
                  </li>
                  <li>
                     <a href="/market/login">登录</a>
                  </li>
                        <?php else: ?>
                        <li>
                            <a href="">您好，<?php echo ($user_info['real_name']); ?></a>
                        </li>
                        <li>
                            <a href="/market/release">发布商品</a>
                        </li>
                  <li class="dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">个人中心</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/market/ordersAndProducts">我的商品与求购</a>
                        </li>
                        <li>
                            <a href="/market/favorite">我的收藏</a>
                        </li>
                        <li>
                            <a href="/market/QAs">问答处理</a>
                        </li>
                        <li>
                            <a href="/market/modifyPersonalInfo">个人信息修改</a>
                        </li>
                        <li>
                            <a href="/market/modifyPassword">密码修改</a>
                        </li>
                        <li>
                            <a href="/market/msgbox">收件箱</a>
                        </li>
                        <li>
                            <a href="/market/feedback">意见反馈</a>
                        </li>
                      <li class="divider">
                      </li>
                      <li>
                         <a href="/market/logout">退出登录</a>
                      </li>
                    </ul>
                  </li><?php endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>