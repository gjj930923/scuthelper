<?php
namespace Home\Controller;
use Think\Controller;
class OrdersController extends Controller {
    public function addOrder(){
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $payment_amount = $_POST['payment_amount'];
        $expect_exchange_time = $_POST['expect_exchange_time'];
        $buyer_note = $_POST['buyer_note'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];

        $product = M('products')->where('product_id='.$product_id)->find();
        if(empty($product) || $product['is_deleted'] != 0){
            echo "-1";
        }
        else if(!is_numeric($quantity) || $quantity <= 0){
            echo "-5";
        }
        else if($quantity < 0 || $quantity > $product['quantity'] - $product['quantity_sold']){
            echo "-2";
        }
        else if(strtotime($expect_exchange_time) < strtotime('now')){
            echo "-3";
        }
        else if(strcmp($user_id, $product['user_id']) == 0){
            echo "-4";
        }
        else{
            $data['user_id'] = $user_id;
            $data['product_id'] = $product_id;
            $data['quantity'] = $quantity;
            $data['payment_amount'] = $payment_amount;
            $data['expect_exchange_time'] = $expect_exchange_time;
            $data['buyer_note'] = $buyer_note;
            $data['address2'] = $address2;
            $address = M('addresses')->where('content="'.$address1.'"')->find();
            if(!empty($address)){
                $data['address1'] = $address['address_id'];;
            }
            else{
                $save['content'] = $address1;
                $data['address1'] = M('addresses')->data($save)->add();
            }
            M('orders')->data($data)->add();
            unset($data);
            $data['sender_id'] = -1;
            $data['receiver_id'] = $product['user_id'];
            $data['title'] = '您有待处理的求购请求！';
            $data['content'] = '商品名称：'.$product['name'].'<br>';
            $data['content'] .= '数量：'.$quantity.'<br>';
            $data['content'] .= '期望交易价格：'.$payment_amount.'<br>';
            $data['content'] .= '期望交易时间：'.$expect_exchange_time.'<br>';
            $data['content'] .= '买家备注：'.$buyer_note.'<br>';
            $data['content'] .= '期望交易地点：'.$address1.'-'.$address2.'<br>';
            $data['content'] .= '求购处理请访问：http://scuthelper.sinaapp.com/market/ordersAndProducts 并点击“求购信息待处理”';
            //模板相关设置
            $data['template'] = 'scuthelper_market_add_order';
            $template_data['product_name'] = $product['name'];
            $template_data['quantity'] = $quantity;
            $template_data['payment_amount'] = $payment_amount;
            $template_data['expect_exchange_time'] = $expect_exchange_time;
            $template_data['buyer_note'] = $buyer_note;
            $template_data['address1'] = $address1;
            $template_data['address2'] = $address2;
            $data['template_data'] = json_encode($template_data);
            $url = "http://scuthelper.sinaapp.com/market/messageSending";
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
        }
    }

    public function addAddress(){
        echo 'Hello, SCUT!';
    }

    public function getOrders(){
        session_start();
        if(!isset($_SESSION['userId'])){
            $this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
        }
        else{
            //获取该user对应的所有未删除products
            $orders = M('orders')->join('products ON orders.product_id=products.product_id')->join('addresses ON addresses.address_id=orders.address1')->field('products.name,orders.quantity,expect_exchange_time,addresses.content,orders.address2,orders.user_id,orders.status,order_id,payment_amount,real_exchange_time')->where('products.is_deleted=0 and orders.user_id='.$_SESSION['userId'])->order('orders.time desc')->select();
            //载入模板
            $user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
            //判断是否为手机端
            $is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
            $array['user_info'] = $user_info;
            $array['orders'] = $orders;
            $array['title'] = "求购信息处理";
            $this->assign($array);
            if($is_mobile == 0){
                $this->display('Navbar:head');
                $this->display('getOrders');
                $this->display('Navbar:tail');
            }
            else{ //跳转至wap分组
                $this->display('wap_getOrders');
            }
        }
    }

    public function deleteOrder(){
        $user_id = $_POST['user_id'];
        $order_id = $_POST['order_id'];
        $order = M('orders')->where("order_id=".$order_id)->find();
        if(empty($order)){
            echo "-2";
        }
        else if(strcmp($user_id, $order['user_id']) != 0){
            echo "-1";
        }
        else if($order['status'] > 1){
            echo "-3";
        }
        else{
            $data['status'] = 4;
            M('orders')->where('order_id='.$order_id)->save($data);
            $product = M('products')->where('product_id='.$order['product_id'])->find();
            //将订单数量恢复到原商品
            if($order['status'] == 1) {
                M('products')->quantity_sold = $product['quantity_sold'] - $order['quantity'];
                M('products')->where('product_id=' . $order['product_id'])->save();
            }
            echo "0";
        }
        
    }

    public function updateOrder(){
        $order_id = $_POST['order_id'];
        //$seller_id = $_POST['seller_id'];
        $real_exchange_time = $_POST['real_exchange_time'];
        $seller_note = $_POST['seller_note'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $isAccept = $_POST['is_accept'];
        $payment_amount = $_POST['payment_amount'];
        $order = M('orders')->where('order_id='.$order_id)->find();
        $product = M('products')->where('product_id='.$order['product_id'])->find();
        $user = M('users')->where('user_id='.$order['user_id'])->find();
        if(empty($order)){
            echo "-1";
            //$this->error("订单不存在");
        }
        else if($order['status'] > 1){
            echo "-2";
            //$this->error("订单已被取消");
        }
        else if(!empty($isAccept) && (empty($payment_amount) || empty($address1) || empty($real_exchange_time))){
            echo "-3";
            //$this->error("确认价格不得为空");
        }
        else{
            $data['order_id'] = $order_id;
            $data['seller_note'] = $seller_note;
            $data['latest_time'] = date('Y-m-d H:i:s');
            if(!empty($isAccept)){
                $data['status'] = 1;
                $data['payment_amount'] = $payment_amount;
            }
            else{
                $data['status'] = 3;
            }

            if(!empty($real_exchange_time)){
                $data['real_exchange_time'] = $real_exchange_time;
            }
            else{
                $data['real_exchange_time'] = $order['expect_exchange_time'];
            }
            if(!empty($address1)){
                $address = M('addresses')->where('content LIKE "'.$address1.'"')->find();
                if(!empty($address)){
                    $data['address1'] = $address['address_id'];;
                }
                else{
                    $save['content'] = $address1;
                    $data['address1'] = M('addresses')->data($save)->add();
                }
            }
            if(!empty($address2)){
                $data['address2'] = $address2;
            }
            $result = M('orders')->data($data)->save();
            if($result == false){
                echo "-4";
                //$this->error("更新订单失败");
            }
            else{
                //添加已售商品数
                $order = M('orders')->where('order_id='.$order_id)->find();
                M('products')->quantity_sold = $product['quantity_sold'] + $order['quantity'];
                M('products')->where('product_id='.$order['product_id'])->save();
                $address = M('addresses')->where('address_id='.$order['address1'])->find();

                //POST到market/messageSending路由
                $data['sender_id'] = -1;
                $data['receiver_id'] = $order['user_id'];
                if(!empty($isAccept)){
                    $data['title'] = '您的求购请求已同意';
                }
                else{
                    $data['title'] = '您的求购请求已被拒绝';
                }
                $content = "商品名称：".$product['name'].'<br>';
                if($isAccept){
                    $content .= "卖家姓名：".$user['real_name'].'<br>';
                    $content .= "卖家email：".$user['email'].'<br>';
                    $content .= "卖家QQ：".$user['qq'].'<br>';
                    $content .= "卖家手机号：".$user['phone'].'<br>';
                    if($user['short_phone']){
                        $content .= "卖家移动短号：".$user['short_phone'].'<br>';
                    }
                    $content .= "交易地点：".$address['content'].' '.$order['address2'].'<br>';
                    $content .= "交易时间：".$order['real_exchange_time'].'<br>';
                }
                $content .= "备注：".$order['seller_note'];

                $data['content'] = $content;
                //模板相关设置
                if($isAccept) {
                    $data['template'] = 'scuthelper_market_accept_order';
                    $template_data['real_name'] = $user['real_name'];
                    $template_data['email'] = $user['email'];
                    $template_data['qq'] = $user['qq'];
                    $template_data['phone'] = $user['phone'];
                    if(isset($user['short_phone'])){
                        $template_data['phone'] .= '('.$user['short_phone'].')';
                    }
                    $template_data['address1'] = $address['content'];
                    $template_data['address2'] = $order['address2'];
                    $template_data['real_exchange_time'] = $order['real_exchange_time'];
                }
                else{
                    $data['template'] = 'scuthelper_market_reject_order';
                }
                $template_data['product_name'] = $product['name'];
                $template_data['seller_note'] = $order['seller_note'];
                $data['template_data'] = json_encode($template_data);
                $url = "http://scuthelper.sinaapp.com/market/messageSending";
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
            }
        }
    }
}
