<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/14
 * Time: 15:23
 */
if(mb_strlen($_POST['content']) < 3){
    skip($_SERVER['REQUEST_URI'], 'error', '回复内容不得少于3个字');
}
?>