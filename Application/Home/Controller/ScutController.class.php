<?php
namespace Home\Controller;
use Think\Controller;
class ScutController extends Controller {
    public function index(){
			$latest_products = M('products')->field('products.product_id,MID(name,1,13) as name,min_price,max_price,quantity,quantity_sold,fineness,pictures.url,description')->join('pictures ON pictures.product_id=products.product_id')->where('is_deleted=0 AND quantity > quantity_sold and pictures.subsequence=1')->order('time desc')->limit(8)->select();
			$hot_products = M('products')->field('products.product_id,MID(name,1,13) as name,min_price,max_price,quantity,quantity_sold,fineness,pictures.url,description')->join('pictures ON pictures.product_id=products.product_id')->where('is_deleted=0 AND quantity > quantity_sold and pictures.subsequence=1')->order('times_read desc')->limit(8)->select();
        	//判断是否为手机端
        	//载入模板（已获取用户信息）
    		$user_info = null;
    		if(isset($_SESSION['userId'])){
        		$user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
    		}
    		$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
			$array['user_info'] = $user_info;
			$array['title'] = "首页";
			$array['latest_products'] = $latest_products;
			$array['hot_products'] = $hot_products;
			$this->assign($array);
			if($is_mobile == 0){
				$this->display('Navbar:head');
 				$this->display('index');
 				$this->display('Navbar:tail');
			}
			else{ //跳转至wap分组
 				$this->display('wap_index');
			}
        
    }
}
