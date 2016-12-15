<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>快速登录与查询</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Roboto -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700">

    <link rel="stylesheet" href="Application/Home/View/Public/css/ratchet.css">
    <link rel="stylesheet" href="Application/Home/View/Public/css/ratchet-theme-ios.min.css">
    <!-- <link rel="stylesheet" href="Application/Home/View/Public/css/ratchet-theme-android.min.css"> -->
    <script src="Application/Home/View/Public/js/ratchet.js"></script>
    <script src="Application/Home/View/Public/js/push.js"></script>
  </head>
  <body>

  <header class="bar bar-nav">
    <button class="btn btn-link btn-nav pull-left" >
    <span class="icon icon-left-nav"></span>
    返回
    </button>
    <h1 class="title">快速登录与查询</h1>
    
  </header>
  
  <nav class="bar bar-tab">           
  <a class="tab-item active" href="#">
    网址导航
  </a>
  <a class="tab-item" href="#">
    敬请期待
  </a>

</nav>
<div class="content">
<ul class="table-view">
  <li class="table-view-cell media">
    <a href="#jwxt">
      <span class="media-object pull-left icon icon-person"></span>
      <div class="media-body">
        教务系统快速登录
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a href="#library">
      <span class="media-object pull-left icon icon-search"></span>
      <div class="media-body">
        图书馆书目查询
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a href="#north_telephone">
      <span class="media-object pull-left icon icon-search"></span>
      <div class="media-body">
        五山校区常用电话
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a href="#south_telephone">
      <span class="media-object pull-left icon icon-search"></span>
      <div class="media-body">
        大学城校区常用电话
      </div>
    </a>
  </li>
</ul>

<!-- 模态框2 -->
<div id="jwcNews" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-close pull-right" href="#jwcNews"></a>
    <h1 class="title">教务处最新消息</h1>
  </header>

  <div class="content">

</div>
  </div>
</div>.

<!-- 模态框3 -->
<div id="websites" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-close pull-right" href="#websites"></a>
    <h1 class="title">常用网站</h1>
  </header>

  <div class="content">
    <p class="content-padded">The contents of my modal go here. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
  </div>
</div>

<!-- 模态框4 -->
<div id="activities" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-close pull-right" href="#activities"></a>
    <h1 class="title">校园活动</h1>
  </header>

  <div class="content">
    <p class="content-padded">The contents of my modal go here. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
  </div>
</div>

<!-- 模态框5 -->
<div id="wechat" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-close pull-right" href="#wechat"></a>
    <h1 class="title">关注微信</h1>
  </header>

  <div class="content">
    <p class="content-padded">The contents of my modal go here. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
  </div>
</div>

<!--<button class="btn btn-primary btn-block btn-outlined">教务系统快速登录</button>
<button class="btn btn-primary btn-block btn-outlined">图书馆书目查询</button>
<button class="btn btn-primary btn-block btn-outlined">五山校区常用电话</button>
<button class="btn btn-primary btn-block btn-outlined">大学城校区常用电话</button>
<select class="form-control select select-primary" data-toggle="select" onChange='goto_site(this)'><option value='' selected>学院首页快速跳转</option><option value=''>——————————</option><option value="http://www.scut.edu.cn/smae/" >机械与汽车工程学院</option><option value="http://www.scut.edu.cn/architecture/" >建筑学院</option><option value="http://www2.scut.edu.cn/jtxy/" >土木与交通学院</option><option value="http://www.scut.edu.cn/ee/" >电子与信息学院</option><option value="http://www2.scut.edu.cn/material/" >材料科学与工程学院</option><option value="http://www.scut.edu.cn/ce/" >化学与化工学院</option><option value="http://www.scut.edu.cn/qgysp/" >轻工与食品学院</option><option value="http://www.scut.edu.cn/science/" >理学院</option><option value="http://www.scut.edu.cn/am/" >数学系</option><option value="#" >物理系</option><option value="http://www.scut.edu.cn/economy/" >经济与贸易学院</option><option value="http://www.scut.edu.cn/automation/" >自动化科学与工程学院</option><option value="http://www.scut.edu.cn/cs/" >计算机科学与工程学院</option><option value="http://202.38.194.204/" >电力学院</option><option value="http://www.scut.edu.cn/biology/" >生物科学与工程学院</option><option value="http://www.scut.edu.cn/environment/" >环境科学与工程学院</option><option value="http://222.201.130.199:8080/SE/" >软件学院</option><option value="http://www.cnsba.com/" >工商管理学院</option><option value="http://www.scutsee.com/" >创业教育学院</option><option value="http://222.16.42.167/sppa/" >公共管理学院</option><option value="http://www.scut.edu.cn/politics/" >思想政治学院</option><option value="http://www.scut.edu.cn/sfl/" >外国语学院</option><option value="http://www.scut.edu.cn/law/" >法学院</option><option value="http://www.scut.edu.cn/iplaw/" >知识产权学院</option><option value="http://www.scut.edu.cn/communication/" >新闻与传播学院</option><option value="http://www.scut.edu.cn/arts/index.htm" >艺术学院</option><option value="http://www.scut.edu.cn/sport/" >体育学院</option><option value="http://www2.scut.edu.cn/sie/" >国际教育学院</option><option value="http://www.scutgfs.cn/" >国防生教育学院</option><option value="http://www2.scut.edu.cn/design/" >设计学院</option></select><script language=javascript>function goto_site(selectControl)/*友情链接的弹出窗口*/{var v = selectControl.value;if (v != ""){window.open(v);selectControl.blur();}selectControl.selectedIndex=0;}</script>
-->
</div>



  </body>
</html>