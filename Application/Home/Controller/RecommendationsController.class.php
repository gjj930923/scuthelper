<?php
namespace Home\Controller;
use Think\Controller;

class RecommendationsController extends Controller {
    public function autoRecommend(){
        $start_code = $_GET['start_code'];
        $settings = M('administrator_settings')->find();
        if(empty($settings) || strcmp($settings['start_code'], $start_code) != 0){
            echo "-1";
        }
        else if($settings['holiday_mode'] != 0){
            echo "-2";
        }
        else{
            //推荐算法相似度实现代码
            $products = M('products')->field('product_id')->where('is_deleted=0 and quantity<=quantity_sold')->select();
            $users = M('users')->field('user_id')->select();
            $num = count($products);
            $num_users = count($users);
            for($i = 0;$i < $num;$i++){
                for($j = $i + 1;$j < $num;$j++){
                    $num_1 = 0;
                    $num_2 = 0;
                    $num_3 = 0;
                    $product_1 = null;
                    $product_2 = null;
                    for($k = 0;$k < $num_users;$k++){
                        //计算商品1、2的各个user对应的权重值，暂定最大为7.
                        $product_1[$users[$k]['user_id']] = count(M('visit_records')->where('user_id='.$users[$k]['user_id'].' and product_id='.$products[$i]['product_id'])->select()) + 2 * count(M('favour')->field('favour_id')->where('user_id='.$users[$k]['user_id'].' and product_id='.$products[$i]['product_id'])->find());
                        $product_2[$users[$k]['user_id']] = count(M('visit_records')->where('user_id='.$users[$k]['user_id'].' and product_id='.$products[$j]['product_id'])->select()) + 2 * count(M('favour')->field('favour_id')->where('user_id='.$users[$k]['user_id'].' and product_id='.$products[$j]['product_id'])->find());
                        if($product_1[$users[$k]['user_id']] > 7){
                            $product_1[$users[$k]['user_id']] = 7;
                        } 
                        if($product_2[$users[$k]['user_id']] > 7){
                            $product_2[$users[$k]['user_id']] = 7;
                        } 
                        $num_1 += $product_1[$users[$k]['user_id']] * $product_2[$users[$k]['user_id']];
                        $num_2 += $product_1[$users[$k]['user_id']] * $product_1[$users[$k]['user_id']];
                        $num_3 += $product_2[$users[$k]['user_id']] * $product_2[$users[$k]['user_id']];
                    }
                    $similarity = 0.0;
                    if($num_1 > 0 && $num_2 > 0 && $num_3 > 0){
                        $similarity = (double)($num_1) / sqrt($num_2) / sqrt($num_3);
                    }
                    if($similarity > 0.0){
                        if(M('similarities')->where('product1='.$products[$i]['product_id'].' and product2='.$products[$j]['product_id'])->find()){
                            M('similarities')->similarity = $similarity;
                            M('similarities')->where('product1='.$products[$i]['product_id'].' and product2='.$products[$j]['product_id'])->save();
                        }
                        else{
                            $data['product1'] = $products[$i]['product_id'];
                            $data['product2'] = $products[$j]['product_id'];
                            $data['similarity'] = $similarity;
                            M('similarities')->data($data)->add();
                        }
                    }
                }
            }
            //相似度推荐商品生成
            for($i = 0;$i < $num;$i++){
                for($j = 0;$j < $num_users;$j++){
                    //阈值设定为0.3
                    $threshold = 0.3;
                    $product_records = M('products')->field('product_id')->where('user_id='.$users[$j]['user_id'])->order('time desc')->limit(5)->select();
                    $product_favours = M('favour')->field('product_id')->where('user_id='.$users[$j]['user_id'])->select();
                    foreach($product_records as $record){
                        $simi_products_1 = M('similarities')->field('product2')->where('product1='.$record['product_id'].' and similarity > '.$threshold)->select();
                        foreach($simi_products_1 as $product){
                            $p = M('products')->where('product_id='.$product['product2'])->find();
                            //确保商品数量大于0、未被删除、未被收藏、未被推荐
                            if($p['quantity'] <= $p['quantity_sold'] && $p['is_deleted'] == 0 && !M('favour')->where('user_id='.$users[$j]['user_id'].' and product_id='.$product['product2'])->find() && !M('recommendation_records')->where('user_id='.$users[$j]['user_id'].' and product_id='.$product['product2'])->find()){
                                $data['user_id'] = $users[$j]['user_id'];
                                $data['product_id'] = $product['product2'];
                                $data['reason'] = 1;
                                M('recommendation_records')->data($data)->add();
                            }
                        }

                        $simi_products_2 = M('similarities')->field('product1')->where('product2='.$record['product_id'].' and similarity > '.$threshold)->select();
                        foreach($simi_products_2 as $product){
                            $p = M('products')->where('product_id='.$product['product1'])->find();
                            //确保商品数量大于0、未被删除、未被收藏、未被推荐
                            if($p['quantity'] > $p['quantity_sold'] && $p['is_deleted'] == 0 && !M('favour')->where('user_id='.$users[$j]['user_id'].' and product_id='.$product['product1'])->find() && !M('recommendation_records')->where('user_id='.$users[$j]['user_id'].' and product_id='.$product['product1'])->find()){
                                $data['user_id'] = $users[$j]['user_id'];
                                $data['product_id'] = $product['product1'];
                                $data['reason'] = 1;
                                M('recommendation_records')->data($data)->add();
                            }
                        }
                    }
                }
            }
            //关键词相关商品生成
            foreach($users as $user){
                $keywords = M('search_records')->field('keyword,time')->where('user_id='.$user['user_id'])->order('time desc')->limit(5)->select();
                foreach($keywords as $keyword){
                    $where = "quantity>quantity_sold and is_deleted=0 and datediff( time, '".$keyword['time']."') >= 0 and LOCATE('".$keyword['keyword']."', name) > 0";
                    $results = M('products')->field('product_id')->where($where)->select();
                    foreach ($results as $result) {
                        if(!M('favour')->where('user_id='.$user['user_id'].' and product_id='.$result['product_id'])->find() && !M('recommendation_records')->where('user_id='.$user['user_id'].' and product_id='.$result['product_id'])->find()){
                            $data['user_id'] = $user['user_id'];
                            $data['product_id'] = $result['product_id'];
                            $data['reason'] = 2;
                            M('recommendation_records')->data($data)->add();
                        }
                    }
                }
            }
            echo "0";
        }
    }

    public function subscribeSending(){
        $start_code = $_GET['start_code'];
        $settings = M('administrator_settings')->find();
        if(empty($settings) || strcmp($settings['start_code'], $start_code) != 0){
            echo "-1";
        }
        else if($settings['holiday_mode'] != 0){
            echo "-2";
        }
        else{
            //获取该小时需要推荐的对象列表
            $weekday = date("w");
            $hour = date('H');
            $users = M('users')->field('user_id')->where('recommend_day='.$weekday.' and recommend_hour='.$hour)->select();
            foreach($users as $user){
                $subscribes = M('subscribe')->where('user_id='.$user['user_id'])->select();
                $products = null;
                foreach ($subscribes as $subscribe) {
                    $new_products = M('products')->where('is_deleted=0 and quantity>quantity_sold and datediff( time,"'.date("Y-m-d H:i:s").'") > -8')->select();
                    array_push($products, $new_products);
                }
                if($products != null){
                    //邮件发送操作，仅能在SAE上测试
                    $data['sender_id'] = -1;
                    $data['receiver_id'] = $user['user_id'];
                    $data['title'] = "您订阅的二手商品类别有新商品了";
                    $data['content'] = '开发中。。';
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
                    if($result == false){
                        echo "-3";
                    }
                    else{
                        echo "0";
                    }
                }
            }
        }
    }

        public function recommendationSending(){
        $start_code = $_GET['start_code'];
        $settings = M('administrator_settings')->find();
        if(empty($settings) || strcmp($settings['start_code'], $start_code) != 0){
            echo "-1";
        }
        else if($settings['holiday_mode'] != 0){
            echo "-2";
        }
        else{
            //获取该小时需要推荐的对象列表
            $weekday = date("w");
            $hour = date('H');
            $users = M('users')->field('user_id')->where('recommend_day='.$weekday.' and recommend_hour='.$hour)->select();
            foreach($users as $user){
                $recommendations = M('recommendation_records')->where('user_id='.$user['user_id'].' and datediff( time,"'.date("Y-m-d H:i:s").'") > -8')->select();
                $products = null;
                foreach ($recommendations as $recommendation) {
                    $new_products = M('products')->where('product_id='.$recommendation['product_id'].' and is_deleted=0 and quantity>quantity_sold')->select();
                    array_push($products, $new_products);
                }
                if($products != null){
                    //邮件发送操作，仅能在SAE上测试
                    $data['sender_id'] = -1;
                    $data['receiver_id'] = $user['user_id'];
                    $data['title'] = "为您量身打造的二手商品列表";
                    $data['content'] = '开发中。。';
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
                    if($result == false){
                        echo "-3";
                    }
                    else{
                        echo "0";
                    }
                }
            }
        }
    }

    public function calculateWeiboSendingTime(){
        $start_code = $_GET['start_code'];
        $settings = M('administrator_settings')->find();
        if(empty($settings) || strcmp($settings['start_code'], $start_code) != 0){
            echo "-1";
        }
        else if($settings['holiday_mode'] != 0){
            echo "-2";
        }
        else{
            $products = M('products')->where('datediff( time,"'.date("Y-m-d H:i:s").'") = -1 and is_deleted=0 and quantity>quantity_sold')->order('time asc')->select(); 
            $num = count($products);
            //发布时间间隔计算
            if($num > 1){
                $block = (23 - 8) * 60 * 60 / ($num - 1);
            }
            else{
                $block = 0;
            }
            $start_unix = strtotime(date("Y-m-d 08:00:00"));
            for($i = 0;$i < $num;$i++){
                $data['release_time'] = date("Y-m-d H:i:s", $start_unix + $block * $i);
                $data['product_id'] = $products[$i]['product_id'];
                M('weibos')->data($data)->add();
            }
            echo "0";
        }
    }

    public function releaseWeibo(){
        $weibo = M('weibos')->where('release_time between "'.date("Y-m-d H:i:00").'" and "'.date("Y-m-d H:i:59").'"')->find();
        $settings = M('administrator_settings')->find();
        if($settings['holiday_mode'] == 0){
            if(!empty($weibo)){
                $product = M('products')->where('product_id='.$weibo['product_id'].' AND is_deleted=0 AND quantity > quantity_sold')->find();
                if($product){
                    $pic = M('pictures')->where('subsequence=1 and product_id='.$product['product_id'])->find();
                    $content = '【新品推荐】'.$product['name'].'：'.substr($product['description'], 0, 100).'http://scuthelper.sinaapp.com/market/product?product_id='.$product['product_id'];
                    $result = file_get_contents("http://100.scuthelper.sinaapp.com/weibolist.php?text=".urlencode($content).'&url='.$pic['url'].'/original');
                    M('weibo_log')->data(array('content' => $result))->add();
                    echo $result;
                }
                else{
                    echo "-3";
                }
            }
            else{
                echo "-1";
            }
        }
        else{
            echo "-2";
        }
    }
}
