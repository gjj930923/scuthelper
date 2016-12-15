<?php
namespace Home\Controller;
use Think\Controller;
class ProductsController extends Controller {
    public function showTypeList(){
        session_start();
        $category = $_GET['category'];
        $page = $_GET['page'];
        if(empty($category) || !is_numeric($category)){
            redirect('/market');
        }
        if(empty($page) || (!is_numeric($page))){
            $page = 1;
        }
        $category_info = M('categories')->where('category_id='.$category)->find();
        if(!$category_info){
            redirect('/market');
        }
        //获取该类所有的子类（如果该类为父类）
        $categories = $category;
        $branch_categories = M('categories')->where('parent_category='.$category)->select();
        foreach($branch_categories as $c){
            $categories .= ','.$c['category_id'];
        }
        $products = M('products')->join('pictures ON pictures.product_id=products.product_id')->where('category in ('.$categories.') and quantity>quantity_sold and is_deleted=0 and subsequence=1')->order('time desc')->limit((12*($page-1)).',12')->select();
        $num_pages = floor((count($products) - 1) / 12) + 1;
        //载入模板
        if(isset($_SESSION['userId'])){
            $user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
        }
        else{
            $user_info = null;
        }
        $main_categories = M('categories')->where('parent_category=0')->select();
        $branch_categories = $array = $branch_category_list = $category_list = array();
        foreach($main_categories as $item){
            $category_list[$item['category_id']]['name'] = $item['name'];
            $branch_categories = M('categories')->where('parent_category='.$item['category_id'])->select();
            if(empty($branch_categories)){
                $category_list[$item['category_id']]['html'] = '<div class="accordion-heading">
							<a onfocus="this.blur();" class="accordion-toggle collapsed" data-parent="#category_list" href="type?category='.$item['category_id'].'"><strong>'.$item['name'].'</strong></a>
						</div>';
            }
            else{
                $category_list[$item['category_id']]['html'] = '<div class="accordion-heading">
							<a onfocus="this.blur();" class="accordion-toggle collapsed" data-parent="#category_list" data-toggle="collapse" href="#category_'.$item['category_id'].'"><strong>'.$item['name'].'</strong></a>
						</div>';
                $category_list[$item['category_id']]['html'] .= '<div class="accordion-body collapse" id="category_'.$item['category_id'].'">';
                $category_list[$item['category_id']]['html'] .= '<div class="accordion-inner">&nbsp;&nbsp;&nbsp;&nbsp;<a href="type?category='.$item['category_id'].'">全部商品</a></div>';
                foreach($branch_categories as $branch){
                    $category_list[$item['category_id']]['html'] .= '<div class="accordion-inner">&nbsp;&nbsp;&nbsp;&nbsp;<a href="type?category='.$branch['category_id'].'">'.$branch['name'].'</a></div>';
                }
                $category_list[$item['category_id']]['html'] .= '</div>';
            }
        }

        unset($main_categories, $branch_categories);
        $array['user_info'] = $user_info;
        $array['products'] = $products;
        $array['title'] = $category_info['name'];
        $array['page'] = $page;
        $array['num_pages'] = $num_pages;
        $array['category_list'] = $category_list;
        $array['category_id'] = $category;

        if($category_info['parent_category'] == 0){
            $array['type_name'] = $category_info['name'];
        }
        else{
            $main_category = M('categories')->where('category_id='.$category_info['parent_category'])->find();
            $array['type_name'] = $main_category['name'];
            $array['branch_type_name'] = $category_info['name'];
        }
        $this->assign($array);
        //判断是否为手机端
        $is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
        if($is_mobile == 0){  
            $this->display('Navbar:head');
            $this->display('showTypeList');
            $this->display('Navbar:tail');
        }
        else{ //跳转至wap分组
            $this->display('wap_showTypeList');
        }

    }

    public function searchResult(){
        session_start();
        $category = $_GET['category'];
        if(!empty($_GET['branch_category'])){
            $category = $_GET['branch_category'];
        }
        $low_minPrice = $_GET['low_minPrice'];
        $high_maxPrice = $_GET['high_maxPrice'];
        $fineness = explode("-",$_GET['fineness']);
        $low_fineness = $fineness[0];
        $high_fineness = $fineness[1];
        $name = $_GET['name'];
        $page = $_GET['page'];
        if(empty($page) || !is_numeric($page)){
            $page = 1;
        }
        if(!empty($category) && is_numeric($category)){
            $category_find = M('categories')->where('category_id='.$category)->find();
            if(empty($category_find)){
                $category = null;
            }
        }
        else{
            $category = null;
        }
        if(empty($low_fineness) || (!is_numeric($low_fineness)) || $low_fineness > 5 || $low_fineness < 0){
            $low_fineness = 0;
        }
        if(empty($high_fineness) || (!is_numeric($high_fineness)) || $high_fineness > 5 || $high_fineness < 0){
            $high_fineness = 6;
        }

        $where = "";
        if(!empty($category)){
            $where.=" and category=".$category;
        }
        if(!empty($low_minPrice)){
            $where.=" and min_price>=".$low_minPrice;
        }
        if(!empty($high_maxPrice)){
            $where.=" and max_price<=".$high_maxPrice;
        }
        if(!empty($low_fineness)){
            $where.=" and fineness>=".$low_fineness;
        }
        if(!empty($high_fineness)){
            $where.=" and fineness<=".$high_fineness;
        }
        if(!empty($name)){
            $where.=" and name LIKE '%".$name."%'";
        }
        $products = null;
        if(strlen($where) > 5){
            $where = substr($where, 5);
            $where.= ' and quantity>quantity_sold and is_deleted=0';
        }
        else{
            $where = 'quantity>quantity_sold and is_deleted=0';
        }
        $products = M('products')->join('pictures ON pictures.product_id = products.product_id and subsequence=1')->where($where)->order('time desc')->limit((12*($page-1)).",12")->select();
        //载入模板
        if(isset($_SESSION['userId'])){
            $user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
            //记录用户的搜索信息
            if(!empty($name) || mb_strlen($name) < 10){
                $data['user_id'] = $_SESSION['userId'];
                $data['keyword'] = $name;
                M('search_records')->data($data)->add();
            }
        }
        else{
            $user_info = null;
        }
        $array['user_info'] = $user_info;
        $array['products'] = $products;
        $array['category'] = $_GET['category'];
        if(!empty($_GET['branch_category'])){
            $array['branch_category'] = $_GET['branch_category'];
        }
        $array['low_minPrice'] = $low_minPrice;
        $array['high_maxPrice'] = $high_maxPrice;
        $array['low_fineness'] = $low_fineness;
        $array['high_fineness'] = $high_fineness;
        $array['fineness'] = $_GET['fineness'];
        $array['name'] = $name;
        $array['page'] = $page;
        $array['num_pages'] = floor((count(M('products')->where($where)->select())-1) / 12) + 1;
        $array['title'] = '搜索结果';
        $array['main_category_list'] = M('categories')->where('parent_category=0')->select();
        $this->assign($array);
        //判断是否为手机端
        $is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
        if($is_mobile == 0){  
            $this->display('Navbar:head');
            $this->display('searchResult');
            $this->display('Navbar:tail');
        }
        else{ //跳转至wap分组
            $this->display('wap_searchResult');
        }
    }

    public function release(){
        session_start();
        //判断是否为手机端
        $is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
        if(!isset($_SESSION['userId'])){
            $this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
            //$this->redirect('market/login?original_url='.$_SERVER['REQUEST_URI']);
        }
        else{
            if(empty($_GET['product_id'])) {
                //载入模板（已获取用户信息）
                $user_info = M('users')->where("user_id=" . $_SESSION['userId'])->find();
                $array['user_info'] = $user_info;
                $array['title'] = '商品发布';
                $array['main_category_list'] = M('categories')->where('parent_category=0')->select();
                //针对手机端jssdk的操作
                $array['appId'] = file_get_contents("http://scuthelper.applinzi.com/wechatAppId");
                $array['timestamp'] = time();
                $array['nonceStr'] = file_get_contents("http://scuthelper.applinzi.com/randomString");
                $jsapi_ticket = file_get_contents("http://scuthelper.applinzi.com/wechatJsapi");
                $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
                $connection = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$array['nonceStr'].'&timestamp='.$array['timestamp'].'&url='.$url;
                $array['signature'] = sha1($connection);
                $this->assign($array);
                if ($is_mobile == 0) {
                    $this->display('Navbar:head');
                    $this->display('release');
                    $this->display('Navbar:tail');
                } else { //跳转至wap分组
                    $this->display('wap_release');
                }
            }
            else{
                $product_id = $_GET['product_id'];
                $product = M('products')->where('product_id='.$product_id)->find();
                if(empty($product_id) || strcmp($product['user_id'], $_SESSION['userId']) != 0){
                    $this->redirect('Scut/index');
                }
                else{
                    $pic_url = M('pictures')->field('url')->where('product_id='.$product_id)->order('subsequence asc')->select();
                    $category = M('categories')->where('category_id='.$product['category'])->find();
                    if($category['parent_category'] != 0){
                        $array['branch_category_id'] = $product['category'];
                        $product['category'] = $category['parent_category'];
                        $array['branch_category_list'] = M('categories')->where('parent_category='.$category['parent_category'])->select();
                    }
                    //载入模板（已获取用户信息）
                    $user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
                    $array['user_info'] = $user_info;
                    $array['product'] = $product;
                    $array['title'] = "修改商品属性";
                    $array['pic_url'] = $pic_url;
                    $array['main_category_list'] = M('categories')->where('parent_category=0')->select();
                    $this->assign($array);
                    if($is_mobile == 0){
                        $this->display('Navbar:head');
                        $this->display('release');
                        $this->display('Navbar:tail');
                    }
                    else{ //跳转至wap分组
                        $this->display('wap_release');
                    }
                }
            }
        }
    }

    public function test(){
        $this->display('Navbar:head');
        $this->display('test');
        $this->display('Navbar:tail');
    }

    public function addProduct(){
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $min_price = $_POST['min_price'];
        $max_price = $_POST['max_price'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $fineness = $_POST['fineness'];
        $description = $_POST['description'];
        $source = $_POST['source'];
        $url[0] = $_POST['url1'];
        $url[1] = $_POST['url2'];
        $url[2] = $_POST['url3'];
        $url[3] = $_POST['url4'];
        $url[4] = $_POST['url5'];
        $url[5] = $_POST['url6'];
        $url[6] = $_POST['url7'];
        $url[7] = $_POST['url8'];
        $url[8] = $_POST['url9'];
        $category_find = M('categories')->where('category_id='.$category)->find();
        if(empty($product_name) || mb_strlen($product_name,"utf-8") > 60){
            echo '-1';
        }
        else if(empty($min_price) || (!is_numeric($min_price))){
            echo "-2";
        }
        else if(!empty($max_price) && (!is_numeric($max_price) || ($max_price < $min_price))){
            echo "-3";
        }
        else if(empty($category_find)){
            echo "-4";
        }
        else if((!is_numeric($quantity)) || $quantity <= 0){
            echo "-5";
        }
        else if((!is_numeric($fineness)) || $fineness < 0 || $fineness > 5){
            echo "-6";
        }
        else if(empty($description) || mb_strlen($description) > 600){
            echo "-7";
        }
        else if((!is_numeric($source)) || $source < 0 || $source > 6){
            echo "-8";
        }
        //仅发布模式下判断是否有图片
        else if(empty($url[0]) && empty($product_id)){
            echo "-9";
        }
        else{
            $data['user_id'] = $user_id;
            $data['name'] = $product_name;
            $data['min_price'] = $min_price;
            if($min_price > $max_price){
                $data['max_price'] = $min_price;
            }
            else{
                $data['max_price'] = $max_price;
            }
            $data['category'] = $category;
            $data['quantity'] = $quantity;
            $data['fineness'] = $fineness;
            $data['description'] = $description;
            $data['source'] = $source;
            if(empty($product_id)){
                $result = M('products')->data($data)->add();
            }
            else{
                $data['modify_time'] = date('Y-m-d H:i:s');
                $result = M('products')->where('product_id='.$product_id)->save($data);
            }
            if($result == false){
                echo "-10";
            }
            else{
                $i = 0;
                $r = true;
                while(!empty($url[$i])){
                    $pic['product_id'] = $result;
                    $pic['subsequence'] = $i + 1;
                    $pic['url'] = $url[$i];
                    $r = M('pictures')->data($pic)->add();
                    if($r == false){
                        echo "-11";
                        break;
                    }
                    $i = $i + 1;
                }
                if($r != false){
                    echo "0";
                }
            }

        }
    }

    public function modify(){
        session_start();
        if(!isset($_SESSION['userId'])){
            $this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
            //$this->redirect('market/login?original_url='.$_SERVER['REQUEST_URI']);
        }
        else{
            $product_id = $_GET['product_id'];
            $product = M('products')->where('product_id='.$product_id)->find();
            if(empty($product_id) || strcmp($product['user_id'], $_SESSION['userId']) != 0){
                $this->redirect('Scut/index');
            }
            else{
                $url = M('pictures')->field('url')->where('product_id='.$product_id)->order('subsequence asc')->select();
                //载入模板（已获取用户信息）
                $user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
                //判断是否为手机端
                $is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
                $array['user_info'] = $user_info;
                $array['product'] = $product;
                $array['url'] = $url;
                if($is_mobile == 0){
                    $this->display('Navbar:head', $user_info);
                    $this->display('modify',$array);
                    $this->display('Navbar:tail');
                }
                else{ //跳转至wap分组
                    $this->display('wap_modify',$array);
                }
            }
        }
    }

    public function modifyProduct(){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $min_price = $_POST['min_price'];
        $max_price = $_POST['max_price'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $fineness = $_POST['fineness'];
        $description = $_POST['description'];
        $source = $_POST['source'];

        $product_find = M('products')->where('product_id='.$product_id)->find();
        $category_find = M('categories')->where('category_id='.$category)->find();
        if(empty($product_find)){
            echo "-1";
        }
        else if(empty($product_name) || strlen($product_name) > 60){
            echo "-2";
        }
        else if(empty($min_price) || (!is_numeric($min_price))){
            echo "-3";
        }
        else if((!is_numeric($max_price)) || ($max_price < $min_price)){
            echo "-4";
        }
        else if(empty($category_find)){
            echo "-5";
        }
        else if((!is_numeric($quantity)) || $quantity < 0){
            echo "-6";
        }
        else if((!is_numeric($fineness)) || $fineness < 0 || $fineness > 5){
            echo "-7";
        }
        else if(empty($description) || $description > 600){
            echo "-8";
        }
        else if((!is_numeric($source)) || $source < 0 || $source > 6){
            echo "-9";
        }
        else{
            $product = M('products');
            $product->name = $product_name;
            $product->min_price = $min_price;
            $product->max_price = $max_price;
            $product->category = $category;
            $product->quantity = $quantity;
            $product->fineness = $fineness;
            $product->description = $description;
            $product->source = $source;
            $product->modify_time = date("Y-m-d H:i:s");
            $result = $product->where('product_id='.$product_id)->save();
            if($result == false){
                echo "-10";
            }
            else{
                echo "0";
            }
        }
    }

    //快速修改商品属性操作（ajax返回）
    public function modifyProductOption(){
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $type = $_POST['type'];//1为打折、2为添加商品、3为删除
        $num = $_POST['num'];//当type为1时代表折扣、2时代表商品添加量、其他的忽略该参数
        $product = M('products')->where('product_id='.$product_id)->find();
        $return = array();
        if(empty($product)){
            $return['code']=-1;
        }
        else if($product['user_id'] != $user_id){
            $return['code']=-2;
        }
        else if($type != 3 && !is_numeric($num)){
            $return['code']=-3;
        }
        else if($type != 1 && $type != 2 && $type != 3){
            $return['code']=-4;
        }
        else{
            $return['type'] = (int)$type;
            $return['code'] = 0;
            $data['modify_time'] = date("Y-m-d H:i:s");
            switch($type){
                case 1:
                    $data['min_price'] = round($product['min_price'] * $num ,2);
                    $data['max_price'] = round($product['max_price'] * $num ,2);
                    M('products')->where('product_id='.$product_id)->data($data)->save();
                    $return['min_price'] = $data['min_price'];
                    if($data['min_price'] <= $data['max_price']) {
                        $return['max_price'] = $data['max_price'];
                    }
                    break;
                case 2:
                    if($product['quantity'] > $product['quantity_sold']) {
                        $data['quantity'] = $product['quantity'] + $num;
                    }
                    else{
                        $data['quantity'] = $product['quantity_sold'] + $num;
                    }
                    M('products')->where('product_id='.$product_id)->data($data)->save();
                    $return['quantity'] = $data['quantity'];
                    break;
                case 3:
                    $data['is_deleted'] = 1;
                    M('products')->where('product_id='.$product_id)->data($data)->save();
                    M('orders')->where('product_id='.$product_id.' AND status < 2')->save(array('status' => 2));
                    M('q_and_a')->where('product_id='.$product_id.' AND status = 0')->save(array('status' => 3));
                    break;
                default:
            }
        }
        $this->ajaxReturn($return);
    }

    //似乎没用上。。
    public function deleteProduct(){
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $product = M('products')->where('product_id='.$product_id)->find();
        if(strcmp($product['user_id'], $user_id) != 0){
            echo "-1";
        }
        else{
            $data['is_deleted'] = 1;
            $result = M('products')->where('product_id='.$product_id)->save($data);
            M('orders')->where('product_id='.$product_id.' AND status < 2')->save(array('status' => 2));
            M('q_and_a')->where('product_id='.$product_id.' AND status = 0')->save(array('status' => 3));
            if($result == 1){
                echo "0";
            }
            else{
                echo "-2";
            }
        }
    }

    //暂不实现
    public function getRecycleBin(){
        session_start();
        if(!isset($_SESSION['userId'])){
            $this->error('未登录','login?redirect_url='.$_SERVER['REQUEST_URI'],1);
            //$this->redirect('market/login?original_url='.$_SERVER['REQUEST_URI']);
        }
        else{
            $products = M('products')->where('user_id='.$_SESSION['userId'].' and is_deleted=1')->order('modify_time desc')->select();
            $user_info = M('users')->where("user_id=".$_SESSION['userId'])->find();
            //判断是否为手机端
            $is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
            if($is_mobile == 0){  
                $this->display('getRecycleBin',$user_info,$products);
            }
            else{ //跳转至wap分组
                $this->display('wap_getRecycleBin',$user_info,$products);
            }
        }
    }

    public function reviveProduct(){
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $product = M('products')->where('product_id='.$product_id)->find();
        if(strcmp($product['user_id'], $user_id) != 0){
            echo "-1";
        }
        else{
            $data['is_deleted'] = 0;
            $result = M('products')->where('product_id='.$product_id)->save($data);
            if($result == 1){
                echo "0";
            }
            else{
                echo "-2";
            }
        }

    }

    public function showProduct(){
        $product_id = $_GET['product_id'];
        $user_id = $_SESSION['userId'];
        $user_info = null;
        if(!$product_id || !is_numeric($product_id)){
            $this->error('商品不存在或已被删除');
        }
        $product = M('products')->where('product_id='.$product_id)->find();
        if(!$product || $product['is_deleted'] == 1){
            $this->error('商品不存在或已被删除');
        }
        $seller = M('users')->field('nickname,real_name,campuses.name as campus_name,schools.name as school_name,addresses.content as address_name,education,create_time,last_login_time,address1,address2,sex')
            ->join('addresses ON addresses.address_id=address1')
            ->join('campuses ON campuses.campus_id=users.campus')
            ->join('schools ON school_id=users.school')
            ->where('user_id='.$product['user_id'])->find();
        $q_and_a = M('q_and_a')->where('status=2 and is_public=1 and product_id='.$product['product_id'])->order('modify_time desc')->select();
        $pic_url = M('pictures')->where('product_id='.$product_id)->order('subsequence')->select();
        $seller['real_name'] = mb_substr($seller['real_name'],0,3).'某';
        $seller['create_time'] = substr($seller['create_time'],0,10);
        $seller['last_login_time'] = substr($seller['last_login_time'],0,10);
        $branch_category = M('categories')->where('category_id='.$product['category'])->find();
        $category_list = "";
        if($branch_category['parent_category'] != 0){
            $main_category = M('categories')->where('category_id='.$branch_category['parent_category'])->find();
            $category_list = $main_category['category_id'];
            $all_branch_categories = M('categories')->where('parent_category='.$main_category['category_id'])->select();
            foreach($all_branch_categories as $c){
                $category_list .= ','.$c['category_id'];
            }
        }
        else{
            $main_category = $branch_category;
            $branch_category = null;
            $category_list = $main_category['category_id'];
        }

        $same_category_product = M('products')->join('pictures ON pictures.product_id=products.product_id')->where('products.product_id!='.$product_id.' AND category in ('.$category_list.') AND subsequence=1 AND is_deleted=0 AND quantity > quantity_sold')->order('times_read desc')->limit(4)->select();
        $similar_products_array = M('similarities')->where('product1 = '.$product_id.' OR product2='.$product_id)->order('similarity desc')->limit(4)->select();
        $similar_products_string = "";
        foreach($similar_products_array as $item){
            if($item['product1'] != $product_id){
                $similar_products_string .= $item['product1'].',';
            }
            elseif($item['product2'] != $product_id){
                $similar_products_string .= $item['product2'].',';
            }
        }
        $similar_products_string = trim($similar_products_string,',');
        if(!empty($similar_products_string)){
            $similar_products = M('products')->join('pictures ON pictures.product_id=products.product_id')->where('subsequence=1 AND is_deleted=0 AND quantity > quantity_sold AND products.product_id IN ('.$similar_products_string.')')->select();
        }
        else{
            $similar_products = null;
        }
        if(!empty($user_id)){
            $user_info = M('users')->where('user_id='.$user_id)->find();
            //添加用户访问商品记录
            $data['user_id'] = $user_id;
            $data['product_id'] = $product_id;
            M('visit_records')->data($data)->add();
            $user_address1 = M('addresses')->where('address_id='.$user_info['address1'])->find();
            $array['user_address1'] = $user_address1['content'];
        }

        $seller_address1 = M('addresses')->where('address_id='.$seller['address1'])->find();
        //判断是否为手机端
        $is_mobile = file_get_contents("http://scuthelper.applinzi.com/isMobile?user_agent=".str_replace(" ","",$_SERVER['HTTP_USER_AGENT']));
        $array['user_info'] = $user_info;
        $array['product'] = $product;
        $array['title'] = $product['name'];
        $array['seller'] = $seller;
        $array['q_and_a'] = $q_and_a;
        $array['pictures'] = $pic_url;
        $array['main_category'] = $main_category;
        $array['same_category_product'] = $same_category_product;
        $array['similar_products'] = $similar_products;
        $array['seller_address1'] = $seller_address1['content'];
        if($branch_category){
            $array['branch_category'] = $branch_category;
        }
        $this->assign($array);
        if($is_mobile == 0){
            $this->display('Navbar:head');
            $this->display('showProduct');
            $this->display('Navbar:tail');
        }
        else{ //跳转至wap分组
            $this->display('wap_showProduct');
        }
    }

    public function addReadTime(){
        $start_code = $_GET['start_code'];
        $settings = M('administrator_settings')->find();
        if(empty($settings) || strcmp($settings['start_code'], $start_code) != 0){
            echo "-1";
        }
        else{
            $products = M('products')->where('is_deleted=0 AND quantity > quantity_sold')->select();
            foreach ($products as $product) {
                $data['product_id'] = $product['product_id'];
                $data['times_read'] = count(M('visit_records')->distinct(true)->field('user_id')->where('product_id='.$product['product_id'])->select());
                M('products')->where('product_id='.$product['product_id'])->save($data);
            }
        }
    }

    //ajax获取某类别编号对应的子类
    public function getBranchType(){
        if(empty($_GET['type_id'])){
            return;
        }
        $type_id = $_GET['type_id'];
        $result = M('categories')->field('category_id,name')->where('parent_category='.$type_id)->select();
        $this->ajaxReturn($result);
    }

    //生成七牛上传token
    public function createQiniuToken(){
        $SecretKey = 'v97mpHJzw0EB1f4cFOJIzIdxqsfVPULsgjc8_d94';
        $AccessKey = "MNjnqs5KTty5XDavEjuN9q-IAoVNayCaW0SJpt-a";
        import('Org.Qiniu.Auth');
        $auth = new \Org\Qiniu\Auth($AccessKey,$SecretKey);
        $bucket = $_REQUEST['bucket'];
        $file_name = $_REQUEST['file_name'];
        if(empty($bucket)){
            echo -1;
            return;
        }
        $policy = array();
        $policy['callbackBody'] = 'key=$(key)&hash=$(etag)&w=$(imageInfo.width)&h=$(imageInfo.height)';
        if(empty($file_name)){
            $token = $auth->uploadToken($bucket,null,3600,$policy);
        }
        else{
            $token = $auth->uploadToken($bucket,$file_name,3600,$policy);
        }
        $this->ajaxReturn(array('uptoken' => $token));
    }
}