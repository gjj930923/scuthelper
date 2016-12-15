<?php
namespace Home\Controller;
use Think\Controller;
class AdministratorController extends Controller {
    public function login(){
        $this->display('Navbar:admin_head');
        $this->display('login');
        $this->display('Navbar:tail');
    }

    public function loginCertify(){
        $admin = $_POST['admin'];
        $password = $_POST['password'];
        $md5 = md5($password.'ADMIN'.$admin);
        $admin_info = M('administrator')->where('admin_name LIKE "'.$admin.'" AND password LIKE "'.$md5.'"')->find();
        if(empty($admin_info)){
            $this->error("用户名或密码错误","",5);
        }
        else{
            session_start();
            $_SESSION['adminId'] = $admin_info['admin_id'];
            redirect('dashboard');
        }
    }

    public function getDashboard(){
        session_start();
        if(!isset($_SESSION['adminId'])){
            redirect('login');
        }
        else{
            //$countByDay[N]['release'] N代表第N天前，release等代表相关项目
            $countByDay = null;
            for($i = 0;$i < 8;$i++){
                $countByDay[$i]['date'] = date('Y-m-d', strtotime('-'.$i.' day'));
                $countByDay[$i]['release'] = count(M('products')->where('datediff( time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i))->select());
                //$countByDay[$i]['modify'] = count(M('products')->where('datediff( modify_time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i))->select());
                $countByDay[$i]['release_order'][0] = count(M('orders')->where('datediff( time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i))->select());
                $countByDay[$i]['deal_order'][0] = count(M('orders')->where('datediff( latest_time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i).' and status=1')->select());
                $countByDay[$i]['cancel_order'][0] = count(M('orders')->where('datediff( latest_time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i).' and status>2')->select());
                $countByDay[$i]['new_user'] = count(M('users')->where('datediff( create_time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i))->select());
                //$countByDay[$i]['login_user'] = count(M('users')->where('datediff( last_login_time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i))->select());
                $categories = M('categories')->where('parent_category=0')->select();
                $category_num = count($categories);
                for($j = 1;$j <= $category_num;$j++){
                    $sub_categories = M('categories')->where('parent_category='.$categories[$j-1]['category_id'])->select();
                    $in = '('.$categories[$j-1]['category_id'];
                    foreach($sub_categories as $sub_category){
                        $in .= ','.$sub_category['category_id'];
                    }
                    $in .= ')';
                    $products = M('products')->field('product_id')->where('category in '.$in)->select();
                    $product_in = '(';
                    foreach($products as $product){
                        $product_in .= $product['product_id'].',';
                    }
                    $product_in = trim($product_in,',');
                    $product_in .= ')';
                    if($product_in != "()"){
                        $countByDay[$i]['release_order'][$j] = count(M('orders')->where('datediff( time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i).' and status=0 and product_id in '.$product_in)->select());
                        $countByDay[$i]['deal_order'][$j] = count(M('orders')->where('datediff( latest_time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i).' and status=1 and product_id in '.$product_in)->select());
                        $countByDay[$i]['cancel_order'][$j] = count(M('orders')->where('datediff( latest_time,"'.date("Y-m-d H:i:s").'") = '.(0 - $i).' and status>2 and product_id in '.$product_in)->select());
                    }
                    else{
                        $countByDay[$i]['release_order'][$j] = $countByDay[$i]['deal_order'][$j] = $countByDay[$i]['cancel_order'][$j] = 0;
                    }
                }
            }
            $array['countByDay'] = $countByDay;
            $array['categories'] = $categories;
            $this->assign($array);
            $this->display('Navbar:admin_head');
            $this->display('getDashboard');
            $this->display('Navbar:tail');
        }
    }

    public function getLatestProducts(){
        session_start();
        if(!isset($_SESSION['adminId'])){
            redirect('login');
        }
        $date_array = getdate(time() - 24*60*60);//获取前一天日期
        $date_string = $date_array['year'].'-'.$date_array['mon'].'-'.$date_array['mday'];
        $title = $date_array['mon'].'月'.$date_array['mday'].'日二手商品目录：';
        $main_categories_id = M('products')->field('category, COUNT(*) AS count')->where('time BETWEEN "'.$date_string.' 00:00:00" AND "'.$date_string.' 23:59:59"'.' AND is_deleted=0 AND quantity > quantity_sold')->group('category')->order('count desc')->select();
        $main_categories = array();
        foreach($main_categories_id as $id) {
            $category = M('categories')->where('category_id=' . $id['category'])->find();
            $main_categories[] = $category['name'];
        }
        if(count($main_categories) >= 6){
            for($i = 0;$i < 4;$i++){
                $title .= $main_categories[$i].'、';
            }
            $title .= $main_categories[4].'……';
        }
        else{
            for($i = 0;$i < count($main_categories)-1;$i++){
                $title .= $main_categories[$i].'、';
            }
            $title .= $main_categories[count($main_categories)-1];
        }
        $abstract = "";
        $item_num = count($main_categories) >= 12 ? 12 : count($main_categories);
        for($i = 0;$i < $item_num;$i++){
            $abstract .= '#'.$main_categories[$i].'#';
        }
        $products = M('products')->where('time BETWEEN "'.$date_string.' 00:00:00" AND "'.$date_string.' 23:59:59"'.' AND is_deleted=0 AND quantity > quantity_sold')->select();
        $content = "昨日共有新增商品".count($products).'个，涉及'.count($main_categories).'个分类。<br>';
        $content .= "以下数据更新时间为".date("Y年m月d日 H:i").'<br>';
        $fineness = array('七成新以下', '七成新', '八成新', '九成新', '九五成新', '全新');
        $i = 0;
        foreach ($main_categories_id as $category_id) {
            $type_name = ($i + 1).'、'.$main_categories[$i].'类';
            $content .= '<strong>'.$type_name.'</strong><br>';
            foreach($products as $product){
                //寻找对应类别的商品
                if($product['category'] == $category_id['category']){
                    //获取商品的名称、价格、数量、详情等信息，存入$content变量
                    $product_name = $product['name'];
                    $content .= '<strong>'.$product_name.'</strong><br>';
                    $price = $product['min_price'].'元';
                    if($product['min_price'] + 0.01 < $product['max_price']){
                        $price .= ' - '.$product['max_price'].'元';
                    }
                    $remain = $product['quantity'] - $product['quantity_sold'];
                    $fineness_name = $fineness[(int)$product['fineness']];
                    $content .= '<strong>'.$price.' | 数量'.$remain.' | '.$fineness_name.'</strong><br>';
                    $description = mb_substr($product['description'], 0, 100, "utf-8");
                    if(mb_strlen($description, "utf-8") > 100){
                        $description .= "……";
                    }
                    $content .= '<p>'.$description.'</p><br>';
                }
            }
            $i++;
        }
        $content .= '<p>如需购买以上商品或查看更多二手商品信息请点击“<strong>阅读原文</strong>”</p><br>';
        $array['title'] = $title;
        $array['abstract'] = $abstract;
        $array['content'] = $content;
        $this->assign($array);
        $this->display('Navbar:admin_head');
        $this->display('getLatestProducts');
        $this->display('Navbar:tail');
    }

    public function sendMessage(){
        $id = $_GET['id'];
        $title = $_GET['title'];
        $content = $_GET['content'];
        session_start();
        if(!isset($_SESSION['adminId'])){
            redirect('login');
        }
        else{
            $array['id'] = $id;
            $array['title'] = $title;
            $array['content'] = $content;
            $this->assign($array);
            $this->display('Navbar:admin_head');
            $this->display('sendMessage');
            $this->display('Navbar:tail');
        }
    }

    public function messageSending(){
        $sender_id = $_POST['sender_id'];
        $receiver_id = $_POST['receiver_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $email_only = $_POST['email_only'];

        if(empty($sender_id) || (!is_numeric($sender_id))){
            echo "-1";
            //$this->error("发送人编号错误");
        }
        else if(empty($receiver_id) || (!is_numeric($receiver_id))){
            echo "-2";
            //$this->error("接收人编号错误");
        }
        else if(empty($title)){
            echo "-3";
            //$this->error("标题不得为空");
        }
        else if(empty($content)){
            echo "-4";
            //$this->error("内容不得为空");
        }
        else{
            if($sender_id != -1){
                $user = M('users')->where('user_id='.$sender_id.' or student_id='.$sender_id)->find();
                if(!$user){
                    echo "-5";
                    return;
                }
                $s_id = $user['user_id'];
            }
            else{
                $s_id = $sender_id;
            }
            if($receiver_id != -1){
                $user = M('users')->where('user_id='.$receiver_id.' or student_id='.$receiver_id)->find();
                if(!$user){
                    echo "-6";
                    return;
                }
                $r_id = $user['user_id'];
            }
            else{
                $r_id = $receiver_id;
            }
            $user = M('users')->where('user_id='.$receiver_id.' or student_id='.$receiver_id)->find();
            if(!isset($_POST['template'])){
                //未设置template时在SAE上发送邮件
                $mail = new \SaeMail();
                $to = $user['email'];
                $title = '【华工小助手】'.$title;
                $from = 'scuthelper@163.com';
                $password = '134649gjj';
                $content = str_replace('<br>','\n',$content);
                $ret = $mail->quickSend($to, $title, $content, $from, $password);
                if($ret == false){
                    $result = $mail->errno().' '.$mail->errmsg();
                    echo $result;
                    M('message_log')->data(array('content' => $result))->add();
                    //$this->error("邮件发送失败：".$mail->errmsg(),"", 60);
                }
            }
            else{
                //已设置的通过sendCloud发送
                $data['apiUser'] = 'scuthelper';
                $data['apiKey'] = 'Xl2qImt8cPGPMzJQ';
                $data['from'] = 'scuthelper@163.com';
                $data['subject'] = $title;
                $data['fromName'] = '华工小助手';
                $data['templateInvokeName'] = $_POST['template'];
                $xsmtpapi['to'][0] = $user['email'];
                if(!isset($_POST['template_data'])){
                    echo "-7";
                    return;
                }
                $template_data = json_decode($_POST['template_data']);
                foreach($template_data as $key => $value){
                    $xsmtpapi['sub']['%'.$key.'%'][0] = $value;
                }
                $data['xsmtpapi'] = json_encode($xsmtpapi);
                $url = "http://api.sendcloud.net/apiv2/mail/sendtemplate";
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
                if($result){
                    echo 'message error:'.$result;
                }
                else{
                    echo "0";
                }
            }
            if(empty($email_only)){
                $data['user_id'] = $r_id;
                $data['sender_id'] = $s_id;
                $data['content'] = $content;
                $data['title'] = $title;
                M('messages')->data($data)->add();
            }
            echo "0";
            //$this->success("发送成功！","javascript:history.back(-1);");
        }
    }

    public function getFeedbacks(){
        session_start();
        if(!isset($_SESSION['adminId'])){
            redirect('login');
            return;
        }
        else{
            $unreadFeedbacks = M('feedbacks')->where('is_read=0')->order('release_time desc')->select();
            $array['unreadFeedbacks'] = $unreadFeedbacks;
            $this->assign($array);
            $this->display('Navbar:admin_head');
            $this->display('getFeedbacks');
            $this->display('Navbar:tail');
        }
        
    }

    public function markFeedbackAsRead(){
        $feedback_id = $_POST['feedback_id'];
        $feedback = M('feedbacks')->where('feedback_id='.$feedback_id)->find();
        if($feedback['is_read'] > 0){
            M('feedbacks')->is_read = 0;
        }
        else{
            M('feedbacks')->is_read = 1;
        }
        M('feedbacks')->where('feedback_id='.$feedback_id)->save();
    }

    public function getWeiboAccessToken(){
        /*$data['client_id'] = '1371571336';
        $data['client_secret'] = 'e373b3184976cbf697ff12efcebecd2a';
        $data['grant_type'] = 'authorization_code';
        $data['redirect_uri'] = 'http://apps.weibo.com/scuttreehole';
        $data['code'] = '2814282507';
        $url = "https://api.weibo.com/oauth2/access_token";
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
        echo 'result: '.$result;*/
    }

    public function getSettings(){
        session_start();
        if(!isset($_SESSION['adminId'])){
            redirect('login');
            return;
        }
        else{
            $settings = M('administrator_settings')->order('setting_id desc')->find();
            $code = hash("sha256",mt_rand(1,50));//随机生成的操作密码，用于post操作选项的变更
            $array['settings'] = $settings;
            $array['code'] = $code;
            $this->assign($array);
            $this->display('Navbar:admin_head');
            $this->display('getSettings');
            $this->display('Navbar:tail');
        }

    }

    //ajax修改假期模式设置
    public function modifyHolidayMode(){
        $set = $_POST['set'];
        $code = $_POST['code'];
        if($set != 0 && $set != 1){
            $this->ajaxReturn(array('error' => 'holiday mode unchanged.'));
            return;
        }
        else{
            for($i = 1;$i < 51;$i++){
                if($code == hash("sha256",$i)){
                    $settings = M('administrator_settings')->order('setting_id desc')->find();
                    M('administrator_settings')->where('setting_id='.$settings['setting_id'])->save(array('holiday_mode' => $set));
                    $settings = M('administrator_settings')->order('setting_id desc')->find();
                    $this->ajaxReturn(array('holiday_mode' => $settings['holiday_mode']));
                    return;
                }
            }
            $this->ajaxReturn(array('error' => 'holiday mode unchanged.'));
        }
    }

    public function logout(){
        session_start();
        unset($_SESSION['adminId']);
        $this->success("成功退出登录");
    }
}
