<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/19
 * Time: 15:44
 */
if(!is_manage_login($conn)){
    header('Location:login.php');
    exit();
}
if(basename($_SERVER['SCRIPT_NAME'])=='manage_delete.php' || basename($_SERVER['SCRIPT_NAME'])=='manage_add.php'){
    if($_SESSION['manage']['level'] != '0'){
        if(!isset($_SERVER['HTTP_REFERER'])) {
            $_SERVER['HTTP_REFERER'] = 'index.php';
        }
        skip($_SERVER['HTTP_REFERER'],'error','权限不足！');
    }
}
?>