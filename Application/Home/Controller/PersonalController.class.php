<?php
namespace Home\Controller;
use Think\Controller;
class PersonalController extends Controller {
    public function loginCertify(){
        $student_id = $_POST['student_id'];
        $password = $_POST['password'];
        $redirect_url = $_POST['redirect_url'];
        $users = M('users');
		if(!$student_id || !$password){
			return;
		}
		if(!$redirect_url){
			$redirect_url = "/market";
		}
        $data = $users->where('student_id='.$student_id)->find();
        if(empty($data)){
        	//echo "-1";
        	//$this->redirect('market/login?alert=用户id不存在');//可以考虑自动完成注册部分的学号信息
			$this->error("用户不存在");
        }
        else if(strcmp($data['password'],hash('sha256',$password)) != 0){
        	//echo "-2";
        	//$this->redirect('market/login?alert=密码错误，请重新输入');
			$this->error("密码错误，请重新输入");
        }
        else{
        	//echo "0";
        	date_default_timezone_set("Asia/Shanghai");
        	$update['last_login_time'] = date("Y-m-d H:i:s");
        	$users->where('student_id='.$student_id)->save($update);
        	session_start();
        	$_SESSION['userId'] = $data['user_id'];
			M('login_records')->data(array(
				'user_id' => $_SESSION['userId'],
				'login_time' => date("Y-m-d H:i:s"),
				'login_ip' => $_SERVER['REMOTE_ADDR']
			))->add();
        	$this->success("登录成功",$redirect_url );
        }
    }

    public function studentIdCertify(){
        $data['studentId'] = $_POST['student_id'];
        $data['password'] = $_POST['library_password'];
        $url = "http://helperpython.applinzi.com/studentIdVerify";
		$users = M('users');
		if(empty($data['studentId']) || empty($data['password'])){
			echo "-4";
			return;
		}
		if($users->where('student_id='.$data['studentId'])->find()){
			echo "-3";
			return;
		}
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        if($data != ''){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $student_name = curl_exec($ch);
        curl_close($ch);


        if(strcmp($student_name,'Invalid') == 0) {
        	echo "-1";
        }
        else{
        	echo $student_name;
        }
    }

    public function signinCertify(){
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
		$nickname = $_POST['nickname'];
		$qq = $_POST['qq'];
		$phone = $_POST['phone'];
		$address1 = $_POST['address1'];
		$campus = $_POST['campus'];
		$school = $_POST['school'];
        
        $users = M('users');
        if(empty($student_id)){
        	echo "-1";
        	//$this->redirect('market/login?alert=姓名不能为空！');
        }
        else if(empty($email) || strpos($email,"@") == FALSE || strpos($email,".") == FALSE || strpos($email,"@") > strpos($email,".")){
        	echo "-2";
        	//$this->redirect('market/login?alert=邮箱无效！');
        }
        else if(strcmp($password,$confirm_password) != 0){
        	echo "-4";
        	//$this->redirect('market/login?alert=密码与确认密码不一致');
        }
        else if(strlen($password) < 8){
        	echo "-3";
        	//$this->redirect('market/login?alert=密码需要8位以上');
        }
        else if($users->where('student_id='.$student_id)->find()){
        	echo "-5";
        	//$this->redirect('market/login?alert=该学号已被注册！');
        }
		else if(empty($nickname)){
			echo "-6";
		}
		else if(!is_numeric($qq)){
			echo "-7";
		}
		else if(!is_numeric($phone)){
			echo "-8";
		}
        else {
        	$data['real_name'] = $name;
        	$data['email'] = $email;
        	$data['password'] = hash('sha256',$password);
        	$data['student_id'] = $student_id;
			$data['nickname'] = $nickname;
			$data['qq'] = $qq;
			$data['phone'] = $phone;
			$data['campus'] = $campus;
			$data['school'] = $school;
			$addr = M('addresses')->where("content LIKE '".$address1."'")->find();
			if($addr){
				$data['address1'] = $addr['address_id'];
			}
			else {
				$data['address1'] = M('addresses')->data(array('content' => $address1))->add();
			}
			$data['student_id'] = $student_id;
        	session_start();
        	$_SESSION['userId'] = $users->add($data);
			M('login_records')->data(array(
				'user_id' => $_SESSION['userId'],
				'login_time' => date("Y-m-d H:i:s"),
				'login_ip' => $_SERVER['REMOTE_ADDR']
			))->add();
			//$this->success('注册成功', '/Personal/modifyPersonalInfo');
        	//$this->redirect("Personal/modifyPersonalInfo");
        	//echo "0";
        }
    }

    public function loginAndSignin(){
		$redirect_url = $_GET['redirect_url'];
        $alert = $_GET['alert'];
        $array['redirect_url'] = $redirect_url;
        $array['alert'] = $alert;

        //载入模板
        //判断是否为手机端
    	$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
		$array['title'] = "注册与登录";
		$array['alert'] = $alert;
		$array['school_list'] = M('schools')->select();
		$array['campus_list'] = M('campuses')->select();
		$this->assign($array);
		if($is_mobile == 0){
			$this->display('Navbar:head');
 			$this->display('loginAndSignin');
 			$this->display('Navbar:tail');
		}
		else{ //跳转至wap分组
 			$this->display('wap_loginAndSignin');
		}
    }

    public function modifyInfo(){
        session_start();
        if(!isset($_SESSION['userId'])){
			$this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
        }
        else{
			$user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
			$address_name = "";
			if($user_info['address1']) {
				$address = M('addresses')->where('address_id=' . $user_info['address1'])->find();
				$address_name = $address['content'];
			}
			$major_name = "";
			if($user_info['major']) {
				$major = M('majors')->where('major_id=' . $user_info['major'])->find();
				$major_name = $major['name'];
			}
        	//载入模板（已获取用户信息）
        	//判断是否为手机端
    		$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
			$array['user_info'] = $user_info;
			$array['title'] = "修改用户信息";
			$array['address'] = $address_name;
			$array['major'] = $major_name;
			$array['school_list'] = M('schools')->select();
			$array['campus_list'] = M('campuses')->select();
			$this->assign($array);
			if($is_mobile == 0){  
				$this->display('Navbar:head');
 				$this->display('modifyInfo');
 				$this->display('Navbar:tail');
			}
			else{ //跳转至wap分组
 				$this->display('wap_modifyInfo');
			}
        }
    }

    public function updateInfo(){
    	$user_id = $_POST['user_id'];//不是学号id
        //$data['real_name'] = $_POST['real_name'];
        $data['nickname'] = $_POST['nickname'];
        $data['email'] = $_POST['email'];
        $data['qq'] = $_POST['qq'];
        $data['phone'] = $_POST['phone'];
        $data['short_phone'] = $_POST['short_phone'];
        $data['address1'] = $_POST['address1'];
        $data['address2'] = $_POST['address2'];
		$data['sex'] = $_POST['sex'];
        $data['campus'] = $_POST['campus'];
        $data['school'] = $_POST['school'];
        $data['major'] = $_POST['major'];
        $data['year'] = $_POST['year'];
        $data['education'] = $_POST['education'];
        $data['recommend_day'] = $_POST['recommend_day'];
        $data['recommend_hour'] = $_POST['recommend_hour'];

        $addresses = M('addresses');
        //$campuses = M('campuses');
        $schools = M('schools');
        $majors = M('majors');
        if(empty($data['nickname']) || empty($data['email']) || empty($data['qq']) || empty($data['phone']) || empty($data['address1']) || empty($data['address2']) || empty($data['campus']) || empty($data['school']) || empty($data['major']) || empty($data['year'])){
			$this->error($data['real_name']."部分必填信息不全。");
        }
        else if(strlen($data['real_name']) > 30 || strlen($data['nickname']) > 42 || strlen($data['email']) > 50 || strlen($data['qq']) > 13 || strlen($data['phone']) > 11 || strlen($data['short_phone']) > 6 || strlen($data['address2']) > 20){
			$this->error("部分信息长度超出要求。");
        }
        else if(strpos($data['email'],"@") == FALSE || strpos($data['email'],".") == FALSE){
			$this->error("邮箱格式不正确。");
        }
        else if(!is_numeric($data['qq'])){
			$this->error("QQ号非纯数字。");
        }
        else if(!is_numeric($data['phone'])){
			$this->error("手机号非纯数字。");
        }
        else if(!(empty($data['short_phone']) || is_numeric($data['short_phone']))){
			$this->error("短号非纯数字。");
        }
        /*else if(empty($addresses->where("address_id=".$data['address1'])->find())){
			$this->error("地址（楼栋）编号不存在。");
        }
        else if(empty($schools->where("school_id=".$data['school'])->find())){
			$this->error("学院编号不存在。");
        }
        else if(empty($majors->where("major_id=".$data['major'])->find())){
			$this->error("专业与班级编号不存在。");
        }*/
        else{
			//处理地址和学院、专业班级信息，若相应信息不存在则向地址或学院表中添加记录
			$addr = M('addresses')->where("content LIKE '".$data['address1']."'")->find();
			$major = M('majors')->where("name LIKE '".$data['major']."'")->find();
			if($addr){
				$data['address1'] = $addr['address_id'];
			}
			else {
				$data['address1'] = M('addresses')->data(array('content' => $data['address1']))->add();
			}
			if($major){
				$data['major'] = $major['major_id'];
			}
			else{
				$data['major'] = M('majors')->data(array('school_id' => $data['school'], 'name' => $data['major']))->add();
			}
        	$users = M('users');
        	$result = $users->where('user_id='.$user_id)->save($data);
        	$this->success("信息更新成功！","javascript:history.back(-1)");
        }
    }

    public function showOrdersAndProducts(){
        session_start();
		$orders_for_deal = $orders = $products = array();
		if(!isset($_SESSION['userId'])){
			$this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
		}
        else{
        	$orders = M("orders")
				->join('products ON products.product_id=orders.product_id')
				->join('addresses ON addresses.address_id = orders.address1')
				->field('order_id,products.name,orders.time,latest_time,orders.quantity,addresses.content,address2,status')
				->where("orders.user_id=".$_SESSION['userId'])
				->order('latest_time desc')->select();
        	$products = M("products")->where("is_deleted = 0 AND user_id=".$_SESSION['userId'])->order('time desc')->select();
			$orders_for_deal = M("orders")
				->join('products ON products.product_id=orders.product_id')
				->join('addresses ON addresses.address_id = orders.address1')
				->field('order_id,products.product_id,products.name,orders.time,orders.quantity,orders.address2,addresses.content,buyer_note,min_price,max_price,expect_exchange_time,status')
				->where("products.user_id=".$_SESSION['userId'])
				->order('time desc')->select();
    	}
    	//载入模板
        $user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
        //判断是否为手机端
    	$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
		$array['title'] = "我的商品与求购";
		$array['user_info'] = $user_info;
		$array['orders'] = $orders;
		$array['orders_for_deal'] = $orders_for_deal;
		$array['products'] = $products;
		$this->assign($array);
		if($is_mobile == 0){
			$this->display('Navbar:head');
 			$this->display('showOrdersAndProducts');
 			$this->display('Navbar:tail');
		}
		else{ //跳转至wap分组
 			$this->display('wap_showOrdersAndProducts');
		}
    }

    public function modifyPassword(){
        $user_id = $_POST['user_id'];//不是学号id
        $original_password = $_POST['original_password'];
        $token = $_POST['token'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        if(empty($token)){
        	$user = M("users")->where("user_id=".$user_id)->find();
        	if(empty($user)){
				$this->error("用户不存在或未登录");
        	}
        	else{
        		if(strcmp($user['password'],hash('sha256',$original_password))){
					$this->error("原密码不正确");
        		}
        		else if(strcmp($new_password,$confirm_password)){
					$this->error("新密码和确认密码不一致");
        		}
        		else if(strlen($new_password) < 8){ //判断密码是否符合要求
					$this->error("密码长度不合要求，至少八位");
        		}
        		else {
        			$data['password'] = hash('sha256',$new_password);
        			$result = M("users")->where("user_id=".$user_id)->save($data);
        			if($result == FALSE){
						$this->error("密码修改失败");
        			}
        			else{
						$this->success("密码修改成功","/market");
        			}
        		}
        	}
        }
        else if(empty($user_id) && empty($original_password)){
        	$t = M('token_for_new_password')->where('token="'.$token.'"')->find();
        	if(!empty($t)){
				if(strcmp($new_password,$confirm_password)){
					$this->error("新密码和确认密码不一致");
				}
        		else if(strtotime("-24 hours") > strtotime($t['time'])){
					$this->error("密码修改链接超时，请重新获取修改密码邮件！","/market/login");
        		}
        		else{
        			$data['password'] = hash('sha256',$new_password);
					$result = M("users")->where("user_id=".$t['user_id'])->save($data);
        			if($result == FALSE){
						$this->error("不得与原密码一致！");
        			}
        			else{
						M('token_for_new_password')->where('token="'.$token.'"')->delete();
						$this->success("密码修改成功，即将跳转到登录页。","/market/login");
        			}
        		}
        	}
        	else{
				$this->error("参数错误",1);
        	}
        }
        else{
			$this->error("参数错误",1);
        }
    }

    public function setPassword(){
        session_start();
		if(!isset($_SESSION['userId'])){
			$this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
			//$this->redirect('market/login?original_url='.$_SERVER['REQUEST_URI']);
		}
        else{
        	//载入模板
        	$user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
			$array['user_info'] = $user_info;
			$array['title'] = "修改密码";
			$this->assign($array);
        	//判断是否为手机端
    		$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
			if($is_mobile == 0){  
				$this->display('Navbar:head');
 				$this->display('setPassword');
 				$this->display('Navbar:tail');
			}
			else{ //跳转至wap分组
 				$this->display('wap_setPassword');
			}
        }
    }

    public function getBackPassword(){
    	$student_id = $_POST['student_id'];
		if(empty($student_id) || !is_numeric($student_id)){
			echo "-4";
			return;
		}
    	session_start();
		//随机数生成
		$str = null;
		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max = strlen($strPol)-1;
		for($i=0;$i<32;$i++){
			$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
		}
		$user = M('users')->where('student_id='.$student_id)->find();
		if(empty($user)){
			echo "-1";
			//$this->error("学号未注册");
		}
		else{
			$data['token'] = $str;
			$data['user_id'] = $user['user_id'];
			$result = false;
			$result = M('token_for_new_password')->data($data)->add();
			if($result == false){
				echo "-2";
				//$this->error("操作失败");
			}
			//邮件发送操作，仅能在SAE上测试
			$data['sender_id'] = -1;
			$data['receiver_id'] = $user['user_id'];
			$data['title'] = "密码找回";
			$data['content'] = "找回链接： http://scuthelper.applinzi.com/market/setPasswordFromEmail?token=".$str;
			$data['email_only'] = 1;
			$url = "http://scuthelper.applinzi.com/market/messageSending";
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_POST, 1);
			if($data != ''){
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			}
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_HEADER, false);
			$result = curl_exec($ch);
			curl_close($ch);
			if($result != "0"){
				echo "-3";
			}
			else{
				$this->ajaxReturn(array('email' => $user['email']));
			}
   		}
    }

    public function setPasswordFromEmail(){
    	$token = $_GET['token'];
    	$t = M('token_for_new_password')->where('token="'.$token.'"')->find();
    	$isValid = true;
    	if(empty($t) || strtotime("-24 hours") > strtotime($t['time'])){
    		$isValid = false;
    	}
		if($isValid == false){
			echo "无效token或已过期";
			return;
		}
		$array['token'] = $token;
		$this->assign($array);
   		//载入模板
        //判断是否为手机端
    	$is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
		if($is_mobile == 0){  
			//$user_info = null;
			$this->display('Navbar:setPasswordFromEmail_head');
 			$this->display('setPasswordFromEmail');
 			$this->display('Navbar:tail');
		}
		else{ //跳转至wap分组
 			$this->display('wap_setPasswordFromEmail');
		}
    }

    public function userCertify(){
    	$idOrStudentId = $_POST['user_id_or_student_id'];
    	if(empty($idOrStudentId) || !is_numeric($idOrStudentId)){
    		echo "-2";
    	}
    	else{
    		$result = M('users')->where('user_id='.$idOrStudentId.' or student_id='.$idOrStudentId)->find();
    		if(empty($result)){
    			echo "-1";
    		}
    		else{
    			echo "0";
    		}
    	}
    }

	public function logout(){
		session_start();
		unset($_SESSION['userId']);
		$this->success("成功退出登录");
	}

	//ajax返回地址列表
	public function getAddresses(){
		$list = M('addresses')->select();
		$tmp_list = array();
		foreach($list as $item){
			$tmp_list[] = $item['content'];
		}
		unset($list);
		$this->ajaxReturn($tmp_list);
	}

	//ajax返回专业班级列表
	public function getMajors(){
		$list = M('majors')->select();
		$tmp_list = array();
		foreach($list as $item){
			$tmp_list[] = $item['name'];
		}
		unset($list);
		$this->ajaxReturn($tmp_list);
	}

	//ajax返回用户待处理求购、待处理问答、未读信息数量
	public function getUnsolved(){
		$user_id = $_POST['user_id'];
		if(!$user_id || !is_numeric($user_id)){
			$this->ajaxReturn(array('error' => '-1'));
		}
		else{
			$user = M('users')->where('user_id='.$user_id)->find();
			if(!$user){
				$this->ajaxReturn(array('error' => '-2'));
			}
			else{
				$data['orders_for_deal'] = count(M("orders")->join('products ON products.product_id=orders.product_id')->where("status=0 AND products.user_id=".$user_id)->select());
				$data['QAs_unsolved'] = count(M('q_and_a')->join('products ON products.product_id=q_and_a.product_id')->where('status=0 and products.is_deleted=0 and products.user_id='.$user_id)->select());
				$data['unread_message'] = count(M('messages')->where('is_read=0 AND messages.user_id='.$user_id)->select());
				$data['all'] = $data['orders_for_deal'] + $data['QAs_unsolved'] + $data['unread_message'];
				$data['error'] = 0;
				$this->ajaxReturn($data);
			}
		}
	}
}
