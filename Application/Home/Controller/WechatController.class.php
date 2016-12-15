<?php
/**
 * Created by PhpStorm.
 * User: Guo
 * Date: 2016/6/2
 * Time: 16:30
 */

namespace Home\Controller;
use Think\Controller;

class WechatController extends Controller {
    //生成随机字符串
    function getRandomString(){
        $len = $_GET['len'];
        if(!$len || !is_numeric($len) || $len <= 0){
            $len = 16;
        }
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;
        for($i = 0;$i < $len;$i++){
            $str .= $strPol[rand(0,$max)];
        }
        echo $str;
    }
}