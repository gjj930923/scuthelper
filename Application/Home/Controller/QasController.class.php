<?php
namespace Home\Controller;
use Think\Controller;
class QasController extends Controller {
    public function addQuestion(){
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $content = $_POST['content'];
        //$is_public = $_POST['is_public'];
        $product = M('products')->where('product_id='.$product_id)->find();
        if(empty($product)){
        	echo "-2";
        }
        else if($product['is_deleted'] != 0){
        	echo "-1";
        }
        else{
        	if(empty($content)){
        		echo "-3";
        	}
        	/*else if(strcmp($product['user_id'], $user_id) == 0){
        		echo "-4";
        	}*/
        	else{
				$data['product_id'] = $product_id;
				$data['question'] = $content;
				$data['user_id'] = $user_id;
        		$result = M('q_and_a')->data($data)->add();
        		if($result != false){
        			echo "0";
        		}
        		else{
        			echo "-5";
        		}
        	}
        }
    }

    public function answerQuestion(){
        $user_id = $_POST['user_id'];
        $question_id = $_POST['question_id'];
        $answer = $_POST['answer'];
        $is_public = $_POST['is_public'];
        $question_content = $_POST['question'];

        $question = M('q_and_a')->where('QA_id='.$question_id)->find();
        if(!empty($question)){
        	$product = M('products')->where("product_id=".$question['product_id'])->find();
        	if(strcmp($user_id,$product['user_id']) != 0){
        		echo "-1";
        	}
        	else if(empty($answer)){
        		echo "-2";
        	}
        	else if($is_public != 0 && empty($question_content)){
        		echo "-3";
        	}
        	else if($question['status'] == 1){
        		echo "-4";
        	}
        	else{
        		$data['answer'] = $answer;
        		$data['is_public'] = $is_public;
        		$data['question'] = $question_content;
        		$data['modify_time'] = date("Y-m-d H:i:s");
        		$data['status'] = 2;
        		$result = M('q_and_a')->where('QA_id='.$question_id)->save($data);
        		if($result != false){
        			echo "0";
        		}
        		else{
        			echo "-5";
        		}
        	}
        }
        else{
        	echo "-4";
        }

    }

    public function getQAs(){
        session_start();
		if(!isset($_SESSION['userId'])){
			$this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
			//$this->redirect('market/login?original_url='.$_SERVER['REQUEST_URI']);
		}
        else{
        	//获取该user对应的所有未删除products
        	$product_list = M('products')->field('product_id')->where('user_id='.$_SESSION['userId'])->select();
        	//$product_num = "";
        	$QAs_unsolved = M('q_and_a')->join('products ON products.product_id=q_and_a.product_id')->where('status=0 and products.is_deleted=0 and products.user_id='.$_SESSION['userId'])->order('release_time desc')->select();
			$QAs_solved = M('q_and_a')->join('products ON products.product_id=q_and_a.product_id')->field('products.name,QA_id,question,answer,release_time,q_and_a.modify_time,is_public')->where('status=2 and products.is_deleted=0 and products.user_id='.$_SESSION['userId'])->order('modify_time desc')->select();
			$QAs_user = M('q_and_a')->join('products ON products.product_id=q_and_a.product_id')->field('products.name,QA_id,question,answer,release_time,q_and_a.modify_time,is_public,status')->where('status != 1 and q_and_a.user_id='.$_SESSION['userId'])->order('release_time desc')->select();
			//载入模板
			$user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
        	$array['user_info'] = $user_info;
			$array['QAs_solved'] = $QAs_solved;
			$array['QAs_unsolved'] = $QAs_unsolved;
			$array['QAs_user'] = $QAs_user;
			$array['title'] = "问答处理";
			$this->assign($array);
        	//判断是否为手机端
    		$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
			if($is_mobile == 0){
				$this->display('Navbar:head');
 				$this->display('getQAs');
 				$this->display('Navbar:tail');
			}
			else{ //跳转至wap分组
 				$this->display('wap_getQAs');
			}
        }
    }

    public function deleteQuestion(){
        $user_id = $_POST['user_id'];
        $question_id = $_POST['question_id'];
		if(!$user_id || !$question_id){
			echo "-1";
			return;
		}
        $question = M('q_and_a')->where('QA_id='.$question_id)->find();
        if(strcmp($question['user_id'], $user_id) != 0){
        	echo $question['user_id']."-".$user_id;
        }
        else{
        	$data['status'] = 1;
        	$data['modify_time'] = date("Y-m-d H:i:s");
        	$result = M('q_and_a')->where('QA_id='.$question_id)->save($data);
        	if($result != false){
        		echo "0";
        	}
        	else{
        		echo "-2";
        	}
        }
    }
}
