<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/26
 * Time: 14:00
 */
session_start();
include_once 'inc/generate_vcode.inc.php';
$_SESSION['vcode'] = generate_vcode(100, 40, 30, 4);
?>
