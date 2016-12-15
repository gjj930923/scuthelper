<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>华工网址导航手机版</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Set a shorter title for iOS6 devices when saved to home screen -->
    <meta name="apple-mobile-web-app-title" content="Ratchet">
    <!-- Roboto -->
    <!--<link rel="stylesheet" href="//fonts.lug.ustc.edu.cn/css?family=Roboto:400,500,700">-->

    <link rel="stylesheet" href="Application/Home/View/Public/css/ratchet.min.css"> 
    <link rel="stylesheet" href="Application/Home/View/Public/css/ratchet-theme-ios.min.css">
    <script src="Application/Home/View/Public/js/ratchet.min.js"></script>
  </head>
  <body>

  <header class="bar bar-nav">
    <h1 class="title">华工网址导航</h1>
  </header>
  
  <nav class="bar bar-tab">           
  <a class="tab-item active" href="Javascript:location.reload()">
    网址导航
  </a>
  <a class="tab-item" href="#">
    敬请期待
  </a>

</nav>
<div class="content">
<ul class="table-view">
  <li class="table-view-cell media">
    <a class="navigate-right" href="#menu1">
      <span class="media-object pull-left icon icon-search"></span>
      <div class="media-body">
        快速登录与查询
      </div>
    </a>
  </li>
 
  <li class="table-view-cell media">
    <a class="navigate-right"  href="#jwcNews">
      <span class="media-object pull-left icon icon-info"></span>
      <div class="media-body">
        教务处最新消息
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#websites">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        常用网站
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#activities">
      <span class="media-object pull-left icon icon-compose"></span>
      <div class="media-body">
        校园活动
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#wechat">
      <span class="media-object pull-left icon icon-star-filled"></span>
      <div class="media-body">
        关注微信
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#traffic">
      <span class="media-object pull-left icon icon-forward"></span>
      <div class="media-body">
        交通查询
      </div>
    </a>
  </li>
</ul>


<!-- 模态框1 -->
<div id="menu1" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#menu1"></a>
    <h1 class="title">快速登录与查询</h1>
  </header>

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
  </div>
</div>

<!-- 模态框1-1 -->
<div id="jwxt" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#jwxt"></a>
    <h1 class="title">教务系统快速登录</h1>
  </header>

  <div class="content">
    <p class="content-padded">
    <form class="input-group" id="form1" name="form1" method="post" action="http://222.201.132.113/(ank0nva2i2ebev55hyxano45)/default2.aspx" target="_blank">
			<input type="hidden" name="__VIEWSTATE" value="dDwtMTg3MTM5OTI5MTs7PgYZAdMp9Oqj+aX5YioRuVR2DoLJ" />
			<input name="hidPdrs" id="hidPdrs" type="hidden" size="5" /><input name="hidsc" id="hidsc" type="hidden" size="5" />
			<input name="lbLanguage" type="text" id="lbLanguage" style="DISPLAY: none" />
			<input type="hidden" name="RadioButtonList1" value="学生" />
			<input placeholder="学号" type="text" class="form-control" name="TextBox1" id="TextBox1"/>
			<input placeholder="密码" type="password" class="form-control" name="TextBox2" id="TextBox2"/>
			<input placeholder="验证码" type="text" class="form-control" name="TextBox3" id="TextBox3" AUTOCOMPLETE="off"/>
            <img src="http://222.201.132.113/(ank0nva2i2ebev55hyxano45)/CheckCode.aspx" width="72" height="27" />
			<button type="submit" class="btn btn-primary btn-block" name="Button1" id="Button1">登录</button></form>
    </p>
  </div>
</div>

<!-- 模态框1-2 -->
<div id="library" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#library"></a>
    <h1 class="title">图书馆书目查询</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<form class="input-group" action="http://202.38.232.10/opac/servlet/opac.go" method="post" enctype="application/x-www-form-urlencoded" name="library_inquire" target="_blank">
            <input type="hidden" name="cmdACT" value="simple.list" />
			<!--<input name="hidPdrs" id="hidPdrs" type="hidden" size="5" />
            <input name="hidsc" id="hidsc" type="hidden" size="5" />
			<input name="lbLanguage" type="text" id="lbLanguage" style="DISPLAY: none" />-->
			<input type="hidden" name="TABLE" value="" />
            <input type="hidden" name="RDID" value="ANONYMOUS" />
            <input type="hidden" name="CODE" value="" />
            <input type="hidden" name="SCODE" value="" />
            <input type="hidden" name="CLANLINK" value="" />
            <input type="hidden" name="libcode" value="" />
            <input type="hidden" name="PAGE" value="" />
            <input type="hidden" name="MARCTYPE" value="" />
            <input type="hidden" name="ORGLIB" value="SCUT" />
            <input type="hidden" name="MODE" value="FRONT" />
            <input placeholder="请在此输入" type=text id="VAL1" class="form-control" name="VAL1" AUTOCOMPLETE="off"/><br>
            <select name="FIELD1">  
      					<option value="TITLE">标题</option>  
      					<option value="AUTHOR">责任者</option>  
     					<option value="ISBN">ISBN</option>  
      					<option value="ISBN.011$a">ISSN</option>
                        <option value="PUBLISHER">出版社</option>  
      					<option value="CLASSNO">分类号</option>
                        <option value="SUBJECT">主题词</option>  
      					<option value="UNIONNO">统一刊号</option>
                        <option value="BARCODE">馆藏条码</option>    
    		</select>
            <button type="submit" class="btn btn-primary btn-block" name="Button1" id="Button1">提交</button></form>
    </p>
  </div>
</div>

<!-- 模态框1-3 -->
<div id="north_telephone" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#north_telephone"></a>
    <h1 class="title">五山校区常用电话</h1>
  </header>

  <div class="content">
    <p class="content-padded">
		校内查号台：87113114，87110000<br>
		校内故障台 87113112 <br>
		总机房 87114996 <br>
		网络抢修 87110228 <br>
		保卫处总值班室 87112110 <br>
		电脑报警中心 87112119 <br>
		校警队东区值勤室 87111155 <br>
		校警队西区值勤室 87111514 <br>
		校警队北区值勤点 87113557 <br>
		水电中心总配电值班室 87112944 <br>
		校医院急诊室 87112375 <br>
		车队调度室 87111021 <br>
		五山派出所 87110430 <br>
		广州市公安局 83116688<br>
		电话服务 87110000，87113112 <br>
		网络中心  87110596，87114790 <br>
		学生工作处 87110452 <br>
		宿舍管理办公室 87114586 <br>
		团委办公室  87110458 <br>
		教务处  87110750 <br>
		图书馆  87111445 <br>
		招生办  87110737 <br>
		计算机中心  87114714 <br>
		电脑房（金龙卡） 87112499 <br>
		膳食科  87110238， 87113497 <br>
		校园价超市  87113939 <br>
		修建中心  87111448 <br>
		校园中心  87111447 <br>
		房产中心  87110322 <br>
		数码商务中心  87110368 <br>
		交通中心  87111021 <br>
		水电中心  87112998  <br>
    </p>
  </div>
</div>

<!-- 模态框1-4 -->
<div id="south_telephone" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#south_telephone"></a>
    <h1 class="title">大学城校区常用电话</h1>
  </header>

  <div class="content">
    <p class="content-padded">
		校医院 39380120<br>
		心理咨询中心 39381291 <br>
		学院学工办 39380293 <br>
		保卫处 39380110 <br>
		维修部 39381362 <br>
		大学城报警电话 34720110 <br>
		C12送水公司 39337362 <br>
		体育馆 39380060 <br>
		精通餐厅 39343935 <br>
    </p>
  </div>
</div>

<!-- 模态框2 -->
<div id="jwcNews" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#jwcNews"></a>
    <h1 class="title">教务处最新消息</h1>
  </header>

  <div class="content">
    <div class="card">
<ul class="table-view">
  <li class="table-view-divider">新闻动态</li>
  <li class="table-view-cell table-view-cell"><a href="<?php echo ($jwc_news_url); ?>" target='_blank'><?php echo ($jwc_news_title); ?></a>&nbsp;&nbsp;<?php echo ($jwc_news_time); ?></li>
  <li class="table-view-cell"><a href="http://202.38.193.235/jiaowuchu/%E9%A6%96%E9%A1%B5/%E6%96%B0%E9%97%BB%E5%8A%A8%E6%80%81/more.aspx" target='_blank'>更多>></a></li>
</ul>
<ul class="table-view">
  <li class="table-view-divider">教务通知</li>
  <li class="table-view-cell table-view-cell"><a href="<?php echo ($jwc_inform_url_1); ?>" target='_blank'><?php echo ($jwc_inform_title_1); ?></a>&nbsp;&nbsp;<?php echo ($jwc_inform_time_1); ?></li>
  <li class="table-view-cell table-view-cell"><a href="<?php echo ($jwc_inform_url_2); ?>" target='_blank'><?php echo ($jwc_inform_title_2); ?></a>&nbsp;&nbsp;<?php echo ($jwc_inform_time_2); ?></li>
  <li class="table-view-cell"><a href="http://202.38.193.235/jiaowuchu/%E9%A6%96%E9%A1%B5/%E6%95%99%E5%8A%A1%E9%80%9A%E7%9F%A51/more.aspx" target='_blank'>更多>></a></li>
</ul>
<ul class="table-view">
  <li class="table-view-divider">学院通知</li>
  <li class="table-view-cell table-view-cell"><a href="<?php echo ($jwc_college_url_1); ?>" target='_blank'><?php echo ($jwc_college_title_1); ?></a>&nbsp;&nbsp;<?php echo ($jwc_college_time_1); ?></li>
  <li class="table-view-cell table-view-cell"><a href="<?php echo ($jwc_college_url_2); ?>" target='_blank'><?php echo ($jwc_college_title_2); ?></a>&nbsp;&nbsp;<?php echo ($jwc_college_time_2); ?></li>
  <li class="table-view-cell"><a href="http://202.38.193.235/jiaowuchu/%E9%A6%96%E9%A1%B5/%E5%AD%A6%E9%99%A2%E4%BF%A1%E6%81%AF/more.aspx" target='_blank'>更多>></a></li>
</ul>
</div>
  </div>
</div>

<!-- 模态框3 -->
<div id="websites" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#websites"></a>
    <h1 class="title">网址导航</h1>
  </header>
  <div class="content">
  <ul class="table-view">
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website1">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        常用校园网站
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website2">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        常用校外网站
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website3">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        视频
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website4">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        新闻
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website5">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        购物
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website6">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        邮箱
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website7">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        招聘
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website8">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        体育
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website9">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        出国
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right" href="#website10">
      <span class="media-object pull-left icon icon-home"></span>
      <div class="media-body">
        银行
      </div>
    </a>
  </li>
  
</ul>

</div>
    </p>
  </div>
</div>

<!-- 模态框3-1 -->
<div id="website1" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website1"></a>
    <h1 class="title">常用校园网站</h1>
  </header>

  <div class="content">
  <p>部分网站不支持手机端浏览，可能给您带来不便，敬请谅解，也请尽量在wifi环境下打开网站！</p>
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.scut.edu.cn">
      华工官网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.100steps.net/">
      百步梯官网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.scut.edu.cn/jw2005/">
      教务系统
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.scut.edu.cn/academic/">
      教务处
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://202.38.232.10/opac/servlet/opac.go?cmdACT=mylibrary.index">
      图书馆
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://222.16.42.161/eol/homepage/common/">
      教学在线
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://222.201.132.21:8090/Login.aspx?ReturnUrl=%2fbusiness%2fstudent%2fdefault.aspx">
      项目管理系统
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.scut.edu.cn/studentbooking/">
      成绩单预约
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://sslibbook1.sslibrary.com/?">
      电子图书馆
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://bbs.scut.edu.cn/classic/">
      木棉BBS
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.125cn.net/">
      志愿时
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="https://www.gzekt.com/index.jsp">
      大学城一卡通
    </a>
  </li>
</ul>
    </p>
  </div>
</div>

<!-- 模态框3-2 -->
<div id="website2" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website2"></a>
    <h1 class="title">常用校外网站</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.sina.com.cn/">
      新浪
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://weibo.com">
      微博
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.163.com/">
      网易
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.youku.com/">
      优酷网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://mail.qq.com">
      QQ邮箱
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.qq.com/">
      腾讯
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://qzone.qq.com/">
      QQ空间
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.taobao.com/">
      淘宝
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.jd.com">
      京东
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.dajie.com/home">
      大街网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.zhaopin.com/">
      智联招聘
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.yhd.com">
      1号店
    </a>
  </li>
</ul>

    </p>
  </div>
</div>

<!-- 模态框3-3 -->
<div id="website3" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website3"></a>
    <h1 class="title">视频</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.iqiyi.com/">
      爱奇艺
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.youku.com/">
      优酷网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.letv.com/">
      乐视网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.kankan.com">
      迅雷看看
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://v.baidu.com/">
      百度视频
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.meipai.com/">
      美拍
    </a>
  </li>
</ul>
    </p>
  </div>
</div>

<!-- 模态框3-4 -->
<div id="website4" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website4"></a>
    <h1 class="title">新闻</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://3g.sina.com.cn/">
      新浪新闻
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.m.sohu.com/">
      搜狐
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.cntv.cn/">
      CNTV
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.huanqiu.com/">
      环球网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://news.baidu.com/">
      百度新闻
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://i.ifeng.com/">
      凤凰网
    </a>
  </li>
</ul>
    </p>
  </div>
</div>

<!-- 模态框3-5 -->
<div id="website5" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website5"></a>
    <h1 class="title">购物</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.taobao.com/">
      淘宝网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.jd.com">
      京东
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.amazon.cn/ref=as_li_ss_tl?_encoding=UTF8&camp=536&creative=3132&linkCode=ur2&tag=gjj930923-23">
      亚马逊
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.yhd.com">
      1号店
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.tmall.com/">
      天猫
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.dangdang.com/">
      当当网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.suning.com/">
      苏宁易购
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.gome.com.cn/">
      国美
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.yixun.com">
      易迅
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.vip.com/">
      唯品会
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.amazon.com/">
      美国亚马逊
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.vancl.com/">
      凡客诚品
    </a>
  </li>
</ul>

    </p>
  </div>
</div>

<!-- 模态框3-6 -->
<div id="website6" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website6"></a>
    <h1 class="title">邮箱</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://mail.163.com/">
      163邮箱
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://mail.qq.com">
      QQ邮箱
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://mail.sina.com.cn/">
      新浪邮箱
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="https://mail.google.com/">
      Gmail
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.126.com/">
      126邮箱
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://mail.sohu.com/">
      搜狐邮箱
    </a>
  </li>
</ul>
    </p>
  </div>
</div>

<!-- 模态框3-7 -->
<div id="website7" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website7"></a>
    <h1 class="title">招聘</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.chinahr.com">
      中华英才网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://gz.58.com/job.shtml">
      58同城招聘
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.yingjiesheng.com/">
      应届生
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.liepin.com">
      猎聘网
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.ganji.com/zhaopin/">
      赶集招聘
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.51job.com/">
      51job
    </a>
  </li>
</ul>
    </p>
  </div>
</div>

<!-- 模态框3-8 -->
<div id="website8" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website8"></a>
    <h1 class="title">体育</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://sports.sina.com.cn/">
      新浪体育
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://sports.sohu.com/">
      搜狐体育
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://mobile.hupu.com/">
      虎扑
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.zhibo8.cc/">
      直播吧
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://china.nba.com/">
      NBA
    </a>
  </li>
</ul>
    </p>
  </div>
</div>

<!-- 模态框3-9 -->
<div id="website9" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website9"></a>
    <h1 class="title">出国</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://bbs.taisha.org/forum.php">
      太傻论坛
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://bbs.zhan.com/">
      TPO小站
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.etest.net.cn/">
      考试中心
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.1point3acres.com">
      一亩三分地
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://bbs.gter.net">
      寄托论坛
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="https://gre.magoosh.com/">
      Magoosh
    </a>
  </li>
</ul>
    </p>
  </div>
</div>

<!-- 模态框3-10 -->
<div id="website10" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#website10"></a>
    <h1 class="title">银行</h1>
  </header>

  <div class="content">
    <p class="content-padded">
<ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://m.icbc.com.cn">
      工商银行
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://m.ccb.com/cn">
      建设银行
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.95599.cn/cn/EBanking/MoblieBanking/">
      农业银行
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://wap.boc.cn/">
      中国银行
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://www.bankcomm.com/BankCommSite/default.shtml">
      交通银行
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="https://www.alipay.com/">
      支付宝
    </a>
  </li>
</ul>
    </p>
  </div>
</div>

<!-- 模态框4 -->
<div id="activities" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#activities"></a>
    <h1 class="title">校园活动</h1>
  </header>

  <div class="content">
    <ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right">
      学院活动
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right">
      学校活动
    </a>
  </li>
</ul>
  </div>
</div>

<!-- 模态框5 -->
<div id="wechat" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#wechat"></a>
    <h1 class="title">关注微信</h1>
  </header>

  <div class="content">
    <p><img src="Application/Home/View/Image/QR.jpg" width="200" height="200"></p><br><p><img src="Application/Home/View/Image/Intro.bmp" width="200" height="120"></p>
  </div>
</div>

<!-- 模态框6 -->
<div id="traffic" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left" href="#traffic"></a>
    <h1 class="title">Modal</h1>
  </header>

  <div class="content">
    <ul class="table-view">
  <li class="table-view-cell">
    <a class="navigate-right" href="http://m.8684.cn/guangzhou_bus">
      公交查询（可查到站信息）
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://m.8684.cn/guangzhou_dt">
      地铁查询
    </a>
  </li>
  <li class="table-view-cell">
    <a class="navigate-right" href="http://m.8684.cn/hc">
      火车票查询
    </a>
  </li>
</ul>

  </div>
</div>
</div>



  </body>
</html>