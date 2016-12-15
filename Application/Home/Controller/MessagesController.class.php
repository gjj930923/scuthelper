<?php
namespace Home\Controller;
use Think\Controller;
class MessagesController extends Controller {
    public function getMessage(){
        session_start();
		if(!isset($_SESSION['userId'])){
			$this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
			//$this->redirect('market/login?original_url='.$_SERVER['REQUEST_URI']);
		}
        else{
			$page = $_GET['page'];
			if(empty($page) || !is_numeric($page)){
				$page = 1;
			}
        	$messages = M('messages')->join('users ON messages.sender_id=users.user_id')->where('messages.user_id='.$_SESSION['userId'])->order('send_time desc')->limit((($page - 1)*20).',20')->select();
        	//载入模板
        	if(isset($_SESSION['userId'])){
            	$user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
        	}
        	else{
            	$user_info = null;
        	}

			$array['user_info'] = $user_info;
			$array['messages'] = $messages;
			$array['page'] = $page;
			$array['num_pages'] = floor((count(M('messages')->join('users ON messages.sender_id=users.user_id')->where('messages.user_id='.$_SESSION['userId'])->select()) - 1) / 20) + 1;
			$array['title'] = "收件箱";
			$this->assign($array);
        	//判断是否为手机端
    		$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
			if($is_mobile == 0){  
                $this->display('Navbar:head');
 				$this->display('getMessage');
                $this->display('Navbar:tail');
			}
			else{ //跳转至wap分组
 				$this->display('wap_getMessage');
			}
        }
    }

    public function deleteMessage(){
        $user_id = $_POST['user_id'];
        $message_id = $_POST['message_id'];
        $message = M('messages')->where('message_id='.$message_id)->find();
        if(!M('users')->where('user_id='.$user_id)->find()){
        	echo "-1";
        }
        else if(empty($message)){
        	echo "-2";
        }
        else if(strcmp($user_id, $message['user_id']) != 0){
        	echo "-3";
        }
        else{
        	$result = M('messages')->delete($message_id);
        	if($result != 1){
        		echo "-4";
        	}
        	else{
        		echo "0";
        	}
        }
    }

	public function sendFeedback(){
        session_start();
		//载入模板
		if(isset($_SESSION['userId'])){
			$user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
		}
		else{
			$user_info = null;
		}
		$array['user_info'] = $user_info;
		$array['title'] = "意见反馈";
		$this->assign($array);
		//判断是否为手机端
		$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
		if($is_mobile == 0){
			$this->display('Navbar:head');
			$this->display('sendFeedback');
			$this->display('Navbar:tail');
		}
		else{ //跳转至wap分组
			$this->display('wap_sendFeedback');
		}
    }

    public function addFeedback(){
        $user_id = $_POST['user_id'];
        $feedback = $_POST['feedback'];
		if(empty($user_id) || !is_numeric($user_id)){
			$user_id = -2;
		}
        if(empty($feedback)){
			$this->error("反馈信息不宜为空");
        }
        else{
        	$data['content'] = $feedback;
        	$data['sender_id'] = $user_id;
        	$result = M('feedbacks')->data($data)->add();
        	if($result == false){
				$this->error("提交反馈信息失败，请稍后再试");
        	}
        	else{
				$this->success("提交成功","/market");
        	}
        }
    }

	//标记某信息已阅
	public function markAsRead(){
		$user_id = $_POST['user_id'];
		$message_id = $_POST['message_id'];
		if(!$user_id || !$message_id){
			echo '-2';
			return;
		}
		$message = M('messages')->where('message_id='.$message_id)->find();
		if($message['user_id'] != $user_id){
			echo "-1";
		}
		else{
			$data['is_read'] = 1;
			M('messages')->where('message_id='.$message_id)->save($data);
			echo "0";
		}
	}

	//标记某用户信息全部已阅
	public function markAllAsRead(){
		if(isset($_POST['user_id'])){
			$user_id = $_POST['user_id'];
			$data['is_read'] = 1;
			M('messages')->where('user_id='.$user_id)->save($data);
			redirect('/market/msgbox');
			//$this->success('标记成功');
		}
	}
}
