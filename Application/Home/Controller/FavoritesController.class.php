<?php
namespace Home\Controller;
use Think\Controller;
class FavoritesController extends Controller {
    public function modifyFavorite(){
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];

        $product = M('products')->where("product_id=".$product_id)->find();
        if(empty($product)){
        	echo "-1";
        }
        else if($product['is_deleted'] > 0){
        	echo "-2";
        }
        else{
        	$find = M('favour')->where("user_id=".$user_id." and product_id=".$product_id)->find();
        	if(empty($find)){
        		$data['user_id'] = $user_id;
        		$data['product_id'] = $product_id;
        		$result = M('favour')->data($data)->add();
        		if($result > 0){
        			echo "0";
        		}
        		else{
        			echo "-3";
        		}
        	}
        	else{
        		$result = M('favour')->where("user_id=".$user_id." and product_id=".$product_id)->delete();
        		if($result == false){
        			echo "-3";
        		}
        		else{
        			echo "1";
        		}
        	}
        }
    }

	//ajax返回用户是否已经收藏某商品
	public function isFavorite(){
		$user_id = $_POST['user_id'];
		$product_id = $_POST['product_id'];
		if(empty($user_id) || empty($product_id) || !is_numeric($user_id) || !is_numeric($product_id)){
			$this->ajaxReturn("-1");
			return;
		}
		$find = M('favour')->where("user_id=".$user_id." and product_id=".$product_id)->find();
		if($find){
			$this->ajaxReturn("1");
		}
		else{
			$this->ajaxReturn("0");
		}
	}

    public function getFavorites(){
        session_start();
		if(!isset($_SESSION['userId'])){
			$this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
			//$this->redirect('market/login?original_url='.$_SERVER['REQUEST_URI']);
		}
        else{
			if(empty($_GET['page']) || !is_numeric($_GET['page'])){
				$page = 1;
			}
			else{
				$page = $_GET['page'];
			}
        	$where = "favour.user_id=".$_SESSION['userId'];
        	$products = M('favour')->join('products ON products.product_id = favour.product_id')->join('users ON users.user_id=products.user_id')->join('addresses ON addresses.address_id=users.address1')->field('products.product_id,favour_id,name,quantity,quantity_sold,min_price,max_price,content,address2,is_deleted')->where($where)->order('favour.add_time desc')->limit((($page-1)*20).',20')->select();
			//载入模板（已获取用户信息）
        	$user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
			//判断是否为手机端
    		$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
			$array['user_info'] = $user_info;
			$array['products'] = $products;
			$array['title'] = '我的收藏';
			$array['page'] = $page;
			$array['num_pages'] = floor((count(M('favour')->where($where)->select()) - 1) / 20) + 1;
			$this->assign($array);
			if($is_mobile == 0){
				$this->display("Navbar:head");
 				$this->display('getFavorites');
				$this->display("Navbar:tail");
			}
			else{ //跳转至wap分组
 				$this->display('wap_getFavorites');
			}
        }
    }
}
