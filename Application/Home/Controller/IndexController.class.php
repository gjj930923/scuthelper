<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        //$category = M("123_category")->select();
		//$website = M("123_website")->select();
		//echo dump($category);
		//$this->assign('index',$category);

		//有待完善，因此先跳转到二手市场首页
		redirect("/market");
		$info = file_get_contents('http://1.helperpython.sinaapp.com/jwc_news');
		$result = json_decode($info,true);
		$this->assign('jwc_news_title',$result[0]['title']);
		$this->assign('jwc_news_time',$result[0]['time']);
		$this->assign('jwc_news_url',"http://202.38.193.235/jiaowuchu/首页/新闻动态/".$result[0]['url']);
		$info = file_get_contents('http://1.helperpython.sinaapp.com/jwc_inform');
		$result = json_decode($info,true);
		$this->assign('jwc_inform_title_1',$result[0]['title']);
		$this->assign('jwc_inform_time_1',$result[0]['time']);
		$this->assign('jwc_inform_url_1',"http://202.38.193.235/jiaowuchu/首页/教务通知1/".$result[0]['url']);
		$this->assign('jwc_inform_title_2',$result[1]['title']);
		$this->assign('jwc_inform_time_2',$result[1]['time']);
		$this->assign('jwc_inform_url_2',"http://202.38.193.235/jiaowuchu/首页/教务通知1/".$result[1]['url']);
		$info = file_get_contents('http://1.helperpython.sinaapp.com/jwc_college');
		$result = json_decode($info,true);
		$this->assign('jwc_college_title_1',$result[0]['title']);
		$this->assign('jwc_college_time_1',$result[0]['time']);
		$this->assign('jwc_college_url_1',"http://202.38.193.235/jiaowuchu/首页/学院信息/".$result[0]['url']);
		$this->assign('jwc_college_title_2',$result[1]['title']);
		$this->assign('jwc_college_time_2',$result[1]['time']);
		$this->assign('jwc_college_url_2',"http://202.38.193.235/jiaowuchu/首页/学院信息/".$result[1]['url']);

		//判断是否为手机端
    	$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
		if($is_mobile == 0){  
 			 $this->display('index');
		}else{ //跳转至wap分组
 			 $this->display('wap_index');
		}  
        
    }

    public function post(){
    	$URL = "https://api.weibo.com/2/statuses/update.json";
    	$data['source'] = 2814282507;
    	$data['status'] = "123";
    	$optional_headers = null;
    	$URL_Info=parse_url($URL);
 		$referrer="";
		// Building referrer
		if($referrer=="") // if not given use this script as referrer
			$referrer="111";
 
		// making string from $data
		foreach($data as $key=>$value)
			$values[]="$key=".urlencode($value);
		$data_string=implode("&",$values);
 
		// Find out which port is needed – if not given use standard (=80)
		if(!isset($URL_Info["port"]))
			$URL_Info["port"]=80;
 
		// building POST-request:
		$request.="POST ".$URL_Info["path"]." HTTP/1.1\n";
		$request.="Host: ".$URL_Info["host"]."\n";
		$request.="Referer: $refererr"."\n";
		$request.="Content-type: application/x-www-form-urlencoded\n";
		$request.="Content-length: ".strlen($data_string)."\n";
		$request.="Connection: close\n";
 
		$request.="Cookie:  $cookie\n";
 
		$request.="\n";
		$request.=$data_string."\n";
 
		$fp = fsockopen($URL_Info["host"],$URL_Info["port"]);
		fputs($fp, $request);
		while(!feof($fp)) {
			$result .= fgets($fp, 1024);
		}
		fclose($fp);
		echo $result;
    	/*$postdata = http_build_query(
            $data
        );
        $opts = array('http' =>
                      array(
                          'method'  => 'POST',
                          'header'  => 'Content-type: application/x-www-form-urlencoded',
                          'content' => $postdata
                      )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        echo $result;*/
        /*$params = array('http' => array(
                  'method' => 'POST',
                  'content' => $data
               ));
     	if ($optional_headers !== null) {
        	$params['http']['header'] = $optional_headers;
     	}
     	$ctx = stream_context_create($params);
     	$fp = @fopen($url, 'r+', false, $ctx);
     	if (!$fp) {
        	throw new \Think\Exception("Problem with $url, $php_errormsg");
     	}
     	$response = @stream_get_contents($fp);
     	if ($response === false) {
        	throw new \Think\Exception("Problem reading data from $url, $php_errormsg");
     	}
     	echo $response;*/
    }

    public function isMobile(){
    	$user_agent = $_GET['user_agent']; 
    	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","Android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","iOS","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
    	$is_mobile = 0; 
    	foreach ($mobile_agents as $device) {//这里把值遍历一遍，用于查找是否有上述字符串出现过 
       		if (stristr($user_agent, $device)) { //stristr 查找访客端信息是否在上述数组中，不存在即为PC端。 
            	$is_mobile = 1; 
            	break; 
        	} 
    	}
    	echo $is_mobile;
    }
}