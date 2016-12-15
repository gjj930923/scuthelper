<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php $public_url = "http://3.scuthelper.sinaapp.com/Application/Home/View/Public/"; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="Application/Home/View/Image/logo.jpg">

    <title>华工网址导航</title>
    


    <!-- Bootstrap core CSS -->
    <link href="<?php echo $public_url ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $public_url ?>css/navbar.css" rel="stylesheet">
	
    <link href="http://www.bootcss.com/p/flat-ui/css/flat-ui.css" rel="stylesheet">
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
          <li class="active"><a href="#">网址导航</a></li>

            <li><a href="#about">敬请期待</a></li>
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
        <p><form action="http://www.baidu.com/baidu" target="_blank">
				<table bgcolor="#FFFFFF" >
                <tr><td align="center"><img src="<?php echo ($_SERVER['SCRIPT_NAME']); ?>/../Application/Home/View/Image/baidu.gif" alt="search_logo" width="117" height="38"></td><td>&nbsp;&nbsp;</td><td>
				<input name=tn type=hidden value=baidu>
                <div class="control-group success">
				<input type=text class="form-control" placeholder="" name=word size=80 AUTOCOMPLETE="off" required autofocus>
                </div>
				</td><td>&nbsp;&nbsp;</td><td><input name="submit" value="百度一下" type="submit" class="btn btn-primary"></td></tr></table>
				</form></p>
        <p></p>
      </div>
    </div>

    <div class="container">
    <div class="col-md-3">
    <div class="table-responsive">
        <table width="350" border="0">
			<tr>
            <button class="btn btn-large btn-block btn-info" data-toggle="modal" data-target="#jwxt">教务系统快速登录</button>
            </tr>
            <tr>&nbsp;</tr>
            
<!-- 模态框（Modal） -->
<div class="modal fade" id="jwxt" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               教务系统快速登录
            </h4>
         </div>
         <div class="modal-body">
		 <form id="form1" name="form1" method="post" action="http://222.201.132.113/(ank0nva2i2ebev55hyxano45)/default2.aspx" target="_blank">
			<input type="hidden" name="__VIEWSTATE" value="dDwtMTg3MTM5OTI5MTs7PgYZAdMp9Oqj+aX5YioRuVR2DoLJ" />
			<input name="hidPdrs" id="hidPdrs" type="hidden" size="5" /><input name="hidsc" id="hidsc" type="hidden" size="5" />
			<input name="lbLanguage" type="text" id="lbLanguage" style="DISPLAY: none" />
			<input type="hidden" name="RadioButtonList1" value="学生" />
学号：<input type="text" class="form-control" name="TextBox1" id="TextBox1"/><label for="txtUserName"></label>
密码：<input type="password" class="form-control" name="TextBox2" id="TextBox2"/><label for="TextBox2"></label>
验证码：<img src="http://222.201.132.113/(ank0nva2i2ebev55hyxano45)/CheckCode.aspx" width="72" height="27" />
<input type="text" class="form-control" name="TextBox3" id="TextBox3" AUTOCOMPLETE="off"/>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary btn-info" name="Button1" id="Button1">提交</button></form>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
  		
		
 			<tr>
			<button class="btn btn-large btn-block btn-info" data-toggle="modal" data-target="#library">图书馆书目查询</button>
  			</tr><tr>&nbsp;</tr>
            
<!-- 模态框（Modal） -->
<div class="modal fade" id="library" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               图书馆书目查询
            </h4>
         </div>
         <div class="modal-body">
			<form action="http://202.38.232.10/opac/servlet/opac.go" method="post" enctype="application/x-www-form-urlencoded" name="library_inquire" target="_blank">
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
            <input type=text id="VAL1" class="form-control" name="VAL1" AUTOCOMPLETE="off"/><br>
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
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary btn-info" name="Button1" id="Button1">提交</button></form>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
  			<tr>
            <button class="btn btn-large btn-block btn-info" data-toggle="modal" data-target="#ctrip_flight">机票火车票查询</button>
            </tr><tr>&nbsp;</tr>
            <!-- 模态框（Modal） -->
<div class="modal fade" id="ctrip_flight" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               机票火车票查询
            </h4>
         </div>
         <div class="modal-body">
<script type="text/javascript" id="ctrip_union_product_20121221" src="http://u.ctrip.com/union/Js/productUI.js?st=ticket&sm=all&smi=s|t&hp=isPic|isGrede|isPrice|isLevel|isYoupiao&tp=isBE|isType|isPrice|isRebate|isYoupiao&hop=isPic|isType|isPrice|isDescribe|isYoupiao&tn=isYoupiao|isTrainNo|fdDate|fdStation|useTime|price&hdt=2015-03-09&hat=2015-03-10&tdt=2015-03-09&fat=2015-03-10&tddd=0&hdc=%u4E0A%u6D77&hhd=2&tdb=%u5E7F%u5DDE%28CAN%29&thd=CAN&tde=%u5317%u4EAC&tha=BJS&hfc=%u4E0A%u6D77&hod=2&hac=%u5317%u4EAC&hoa=1&ddc=%u5E7F%u5DDE&hddc= guangzhou&dac=%u5317%u4EAC&hdac=beijing&si=15&ti=0&num=3&fv=0&hsp=0|1|2&tsp=0|1|2|3|4|5&hosp=0|1&trsp=0|1|2|3|4&pw=540&ph=390&cl=2&rw=5&had=ctrip&allid=40860&sid=481801&oid=&app=0104B00&opt=sd" charset="gb2312"></script>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">关闭
            </button>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
  			
            <tr>
            <button class="btn btn-large btn-block btn-info" data-toggle="modal" data-target="#north_telephone">五山校区常用电话</button>
            </tr><tr>&nbsp;</tr>
            <!-- 模态框（Modal） -->
<div class="modal fade" id="north_telephone" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               五山校区常用电话
            </h4>
         </div>
         <div class="modal-body">
    		<b>若有错误或补充，欢迎扫描主页二维码关注公众号回复！</b><br>
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
            

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">关闭
            </button>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->

			<tr>
            <button class="btn btn-large btn-block btn-info" data-toggle="modal" data-target="#south_telephone">大学城校区常用电话</button>
            </tr><tr>&nbsp;</tr>
            <!-- 模态框（Modal） -->
<div class="modal fade" id="south_telephone" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               大学城校区常用电话
            </h4>
         </div>
         <div class="modal-body">
    		<b>若有错误或补充，欢迎扫描主页二维码关注公众号回复！</b><br>
    		校医院 39380120<br>
			心理咨询中心 39381291 <br>
			学院学工办 39380293 <br>
			保卫处 39380110 <br>
			维修部 39381362 <br>
			大学城报警电话 34720110 <br>
			C12送水公司 39337362 <br>
			体育馆 39380060 <br>
			精通餐厅 39343935 <br>
            
			
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">关闭
            </button>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
  		    <tr>
            <select class="form-control select select-primary" data-toggle="select" onChange='goto_site(this)'><option value='' selected>学院首页快速跳转</option><option value=''>——————————</option><option value="http://www.scut.edu.cn/smae/" >机械与汽车工程学院</option><option value="http://www.scut.edu.cn/architecture/" >建筑学院</option><option value="http://www2.scut.edu.cn/jtxy/" >土木与交通学院</option><option value="http://www.scut.edu.cn/ee/" >电子与信息学院</option><option value="http://www2.scut.edu.cn/material/" >材料科学与工程学院</option><option value="http://www.scut.edu.cn/ce/" >化学与化工学院</option><option value="http://www.scut.edu.cn/qgysp/" >轻工与食品学院</option><option value="http://www.scut.edu.cn/science/" >理学院</option><option value="http://www.scut.edu.cn/am/" >数学系</option><option value="#" >物理系</option><option value="http://www.scut.edu.cn/economy/" >经济与贸易学院</option><option value="http://www.scut.edu.cn/automation/" >自动化科学与工程学院</option><option value="http://www.scut.edu.cn/cs/" >计算机科学与工程学院</option><option value="http://202.38.194.204/" >电力学院</option><option value="http://www.scut.edu.cn/biology/" >生物科学与工程学院</option><option value="http://www.scut.edu.cn/environment/" >环境科学与工程学院</option><option value="http://222.201.130.199:8080/SE/" >软件学院</option><option value="http://www.cnsba.com/" >工商管理学院</option><option value="http://www.scutsee.com/" >创业教育学院</option><option value="http://222.16.42.167/sppa/" >公共管理学院</option><option value="http://www.scut.edu.cn/politics/" >思想政治学院</option><option value="http://www.scut.edu.cn/sfl/" >外国语学院</option><option value="http://www.scut.edu.cn/law/" >法学院</option><option value="http://www.scut.edu.cn/iplaw/" >知识产权学院</option><option value="http://www.scut.edu.cn/communication/" >新闻与传播学院</option><option value="http://www.scut.edu.cn/arts/index.htm" >艺术学院</option><option value="http://www.scut.edu.cn/sport/" >体育学院</option><option value="http://www2.scut.edu.cn/sie/" >国际教育学院</option><option value="http://www.scutgfs.cn/" >国防生教育学院</option><option value="http://www2.scut.edu.cn/design/" >设计学院</option></select><script language=javascript>function goto_site(selectControl)/*友情链接的弹出窗口*/{var v = selectControl.value;if (v != ""){window.open(v);selectControl.blur();}selectControl.selectedIndex=0;}</script>
            </tr>	<tr><br></tr>
			<tr>
            <h4>新闻动态</h4>
            <h5><a href="<?php echo ($jwc_news_url); ?>" target='_blank'><?php echo ($jwc_news_title); ?></a>&nbsp;&nbsp;<br><?php echo ($jwc_news_time); ?>
            <br><a href="http://202.38.193.235/jiaowuchu/%E9%A6%96%E9%A1%B5/%E6%96%B0%E9%97%BB%E5%8A%A8%E6%80%81/more.aspx" target='_blank'>更多>></a>
            </h5></tr>
            <tr>
            <h4>教务通知</h4>
            <h5><a href="<?php echo ($jwc_inform_url_1); ?>" target='_blank'><?php echo ($jwc_inform_title_1); ?></a>&nbsp;&nbsp;<br><?php echo ($jwc_inform_time_1); ?><br>
            <a href="<?php echo ($jwc_inform_url_2); ?>" target='_blank'><?php echo ($jwc_inform_title_2); ?></a>&nbsp;&nbsp;<br><?php echo ($jwc_inform_time_2); ?>
            <br><a href="http://202.38.193.235/jiaowuchu/%E9%A6%96%E9%A1%B5/%E6%95%99%E5%8A%A1%E9%80%9A%E7%9F%A51/more.aspx" target='_blank'>更多>></a>
            </h5></tr>
            <tr>
            <h4>学院通知</h4>
            <h5><a href="<?php echo ($jwc_college_url_1); ?>" target='_blank'><?php echo ($jwc_college_title_1); ?></a>&nbsp;&nbsp;<br><?php echo ($jwc_college_time_1); ?><br>
            <a href="<?php echo ($jwc_college_url_2); ?>" target='_blank'><?php echo ($jwc_college_title_2); ?></a>&nbsp;&nbsp;<br><?php echo ($jwc_college_time_2); ?>
            <br><a href="http://202.38.193.235/jiaowuchu/%E9%A6%96%E9%A1%B5/%E5%AD%A6%E9%99%A2%E4%BF%A1%E6%81%AF/more.aspx" target='_blank'>更多>></a>
            </h5></tr>
    </table>
        
        </div>
        </div>
        
        <div class="col-md-7">
  <table width="60" border="0" class="table table-striped" style="table-layout:fixed;">
  <tr>
    <h3>华工校园导航</h3>
  </tr>
  <tr>
    <td><a href="http://www.scut.edu.cn" target='_blank'>华工官网</a></td>
    <td><a href="http://www.100steps.net/" target='_blank'>百步梯官网</a></td>
    <td><a href="http://www.scut.edu.cn/jw2005/" target='_blank'>教务系统</a></td>
    <td><a href="http://www.scut.edu.cn/academic/" target='_blank'>教务处</a></td>
    <td><a href="http://202.38.232.10/opac/servlet/opac.go?cmdACT=mylibrary.index" target='_blank'>图书馆</a></td>
    <td><a href="http://222.16.42.161/eol/homepage/common/" target='_blank'>教学在线</a></td>
  </tr>
  <tr>
    <td><a href="http://222.201.132.21:8090/Login.aspx?ReturnUrl=%2fbusiness%2fstudent%2fdefault.aspx" target='_blank'>项目管理系统</a></td>
    <td><a href="http://www.scut.edu.cn/studentbooking/" target='_blank'>成绩单预约</a></td>
    <td><a href="http://sslibbook1.sslibrary.com/?" target='_blank'>电子图书馆</a></td>
    <td><a href="http://bbs.scut.edu.cn/classic/" target='_blank'>木棉BBS</a></td>
    <td><a href="http://www.125cn.net/" target='_blank'>志愿时</a></td>
    <td><a href="https://www.gzekt.com/index.jsp" target='_blank'>大学城一卡通</a></td>
  </tr>
</table>

  <table width="60" border="0" class="table table-striped" style="table-layout:fixed;">
  <tr>
    <h3>常用网站</h3>
  </tr>
  <tr>
    <td><a href="http://www.sina.com.cn/" target='_blank'>新浪</a></td>
    <td><a href="http://weibo.com" target='_blank'>微博</a></td>
    <td><a href="http://www.163.com/" target='_blank'>网易</a></td>
    <td><a href="http://mail.qq.com" target='_blank'>QQ邮箱</a></td>
    <td><a href="http://www.qq.com/" target='_blank'>腾讯</a></td>
    <td><a href="http://qzone.qq.com/" target='_blank'>QQ空间</a></td>
  </tr>
  <tr>
    <td><a href="http://www.taobao.com/" target='_blank'>淘宝</a></td>
    <td><a href="http://www.jd.com" target='_blank'>京东</a></td>
    <td><a href="http://www.dajie.com/home" target='_blank'>大街网</a></td>
    <td><a href="http://www.zhaopin.com/" target='_blank'>智联招聘</a></td>
    <td><a href="http://www.yhd.com" target='_blank'>1号店</a></td>
    <td><a href="http://www.youku.com/" target='_blank'>优酷网</a></td>
  </tr>
</table>
  
<table width="60" border="0" class="table table-striped" style="table-layout:fixed;">
  <tr>
    <h3>分类导航</h3>
  </tr>
  <tr>
    <td><b>视频</b></td>
    <td><a href="http://www.iqiyi.com/" target='_blank'>爱奇艺</a></td>
    <td><a href="http://www.youku.com/" target='_blank'>优酷网</a></td>
    <td><a href="http://www.letv.com/" target='_blank'>乐视网</a></td>
    <td><a href="http://www.kankan.com" target='_blank'>迅雷看看</a></td>
    <td><a href="http://v.baidu.com/" target='_blank'>百度视频</a></td>
    <td><a href="http://www.meipai.com/" target='_blank'>美拍</a></td>
  </tr>
  <tr>
    <td><b>新闻</b></td>
    <td><a href="http://news.sina.com.cn/" target='_blank'>新浪新闻</a></td>
    <td><a href="http://news.sohu.com/" target='_blank'>搜狐</a></td>
    <td><a href="http://www.cntv.cn/" target='_blank'>CNTV</a></td>
    <td><a href="http://www.huanqiu.com/" target='_blank'>环球网</a></td>
    <td><a href="http://news.baidu.com/" target='_blank'>百度新闻</a></td>
    <td><a href="http://news.ifeng.com/" target='_blank'>凤凰网</a></td>
  </tr>
  <tr>
    <td><b>购物</b></td>
    <td><a href="http://www.taobao.com/" target='_blank'>淘宝网</a></td>
    <td><a href="http://www.jd.com" target='_blank'>京东</a></td>
    <td><a href="http://www.amazon.cn/ref=as_li_ss_tl?_encoding=UTF8&camp=536&creative=3132&linkCode=ur2&tag=gjj930923-23" target='_blank'>亚马逊</a></td>
    <td><a href="http://www.yhd.com" target='_blank'>1号店</a></td>
    <td><a href="http://www.tmall.com/" target='_blank'>天猫</a></td>
    <td><a href="http://www.dangdang.com/" target='_blank'>当当网</a></td>
  </tr>
  <tr>
    <td><b> </b></td>
    <td><a href="http://www.suning.com" target='_blank'>苏宁易购</a></td>
    <td><a href="http://www.gome.com.cn" target='_blank'>国美</a></td>
    <td><a href="http://www.yixun.com" target='_blank'>易迅</a></td>
    <td><a href="http://www.vip.com/" target='_blank'>唯品会</a></td>
    <td><a href="http://www.amazon.com/" target='_blank'>美国亚马逊</a></td>
    <td><a href="http://www.vancl.com/" target='_blank'>凡客诚品</a></td>
  </tr>
  <tr>
    <td><b>邮箱</b></td>
    <td><a href="http://mail.163.com/" target='_blank'>163邮箱</a></td>
    <td><a href="http://mail.qq.com" target='_blank'>QQ邮箱</a></td>
    <td><a href="http://mail.sina.com.cn" target='_blank'>新浪邮箱</a></td>
    <td><a href="https://mail.google.com/" target='_blank'>Gmail</a></td>
    <td><a href="http://www.126.com/" target='_blank'>126邮箱</a></td>
    <td><a href="http://mail.sohu.com/" target='_blank'>搜狐邮箱</a></td>
  </tr>
  <tr>
    <td><b>招聘</b></td>
    <td><a href="http://www.chinahr.com" target='_blank'>中华英才网</a></td>
    <td><a href="http://gz.58.com/job.shtml" target='_blank'>58同城招聘</a></td>
    <td><a href="http://www.yingjiesheng.com/" target='_blank'>应届生</a></td>
    <td><a href="http://www.liepin.com" target='_blank'>猎聘网</a></td>
    <td><a href="http://www.ganji.com/zhaopin/" target='_blank'>赶集招聘</a></td>
    <td><a href="http://www.51job.com/" target='_blank'>51job</a></td>
  </tr>
  <tr>
    <td><b>体育</b></td>
    <td><a href="http://sports.sina.com.cn/" target='_blank'>新浪体育</a></td>
    <td><a href="http://sports.sohu.com/" target='_blank'>搜狐体育</a></td>
    <td><a href="http://sports.cntv.cn/" target='_blank'>CCTV5</a></td>
    <td><a href="http://www.hupu.com/" target='_blank'>虎扑</a></td>
    <td><a href="http://www.zhibo8.cc/" target='_blank'>直播吧</a></td>
    <td><a href="http://china.nba.com/" target='_blank'>NBA</a></td>
  </tr>
  <tr>
    <td><b>出国</b></td>
    <td><a href="http://www.taisha.org.cn/" target='_blank'>太傻论坛</a></td>
    <td><a href="http://bbs.zhan.com/" target='_blank'>TPO小站</a></td>
    <td><a href="http://www.1point3acres.com" target='_blank'>一亩三分地</a></td>
    <td><a href="http://bbs.gter.net" target='_blank'>寄托论坛</a></td>
    <td><a href="https://gre.magoosh.com/" target='_blank'>Magoosh</a></td>
    <td><a href="http://www.etest.net.cn/" target='_blank'>考试中心</a></td>
  </tr>
  <tr>
    <td><b>银行</b></td>
    <td><a href="http://www.icbc.com.cn/icbc/" target='_blank'>工商银行</a></td>
    <td><a href="http://www.ccb.com/cn/home/index.html" target='_blank'>建设银行</a></td>
    <td><a href="http://www.abchina.com/cn/" target='_blank'>农业银行</a></td>
    <td><a href="http://www.boc.cn/" target='_blank'>中国银行</a></td>
    <td><a href="http://www.bankcomm.com/BankCommSite/default.shtml" target='_blank'>交通银行</a></td>
    <td><a href="https://www.alipay.com/" target='_blank'>支付宝</a></td>
  </tr>
  <tr>
    <td><b>电影下载</b></td>
    <td><a href="http://dianying.fm/" target='_blank'>电影FM</a></td>
    <td><a href="http://btmee.net/1080p/" target='_blank'>1080P</a></td>
    <td><a href="http://www.bttiantang.com/" target='_blank'>BT天堂</a></td>
    <td><a href="http://www.cnscg.org/" target='_blank'>圣城影视</a></td>
    <td><a href="http://www.xlpu.cc/" target='_blank'>迅雷铺</a></td>
    <td><a href="http://www.uc123.com/gaoqing.html?f=ntw" target='_blank'>更多</a></td>
  </tr>
</table>

     <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; echo ($data["category_name"]); endforeach; endif; else: echo "" ;endif; ?>
     </tr>
		</table>
        </div>
        
        <div class="col-md-2">
        <table width="100" border="0">
  			<tr>
    		<td><img src="<?php echo ($_SERVER['SCRIPT_NAME']); ?>/../Application/Home/View/Image/QR.jpg" width="200" height="200"><br><img src="<?php echo ($_SERVER['SCRIPT_NAME']); ?>/../Application/Home/View/Image/Intro.bmp" width="250" height="90"></td>
  			</tr>
  			<tr>
   			<td><a data-type="3" data-tmpl="200x250" data-tmplid="183" data-rd="2" data-style="2" data-border="1" href="#"></a>
</td>
  			</tr>
  			<tr>
    		<td><img src="<?php echo ($_SERVER['SCRIPT_NAME']); ?>/../Application/Home/View/Image/sample_poster.jpg" alt="poster" height="320" width="240"></td>
            
  			</tr>
        
          <tr>
            <td><img src="<?php echo ($_SERVER['SCRIPT_NAME']); ?>/../Application/Home/View/Image/sample_poster.jpg" alt="poster" height="320" width="240"></td>
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