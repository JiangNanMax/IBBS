<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/19
 * Time: 20:36
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$conn = connect();

if(!is_manage_login($conn)){
    header('Location:login.php');
}

session_unset();
session_destroy();
setcookie(session_name(),'',time()-3600,'/');
header('Location:login.php');
?>