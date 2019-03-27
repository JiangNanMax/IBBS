<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/27
 * Time: 20:31
 */
if (empty($_POST['username'])) {
    skip('login.php', 'error', '用户名不能为空！');
}
if (mb_strlen($_POST['username']) > 30) {
    skip('login.php', 'error', '用户名不能超过30个字符！');
}
if (empty($_POST['password'])) {
    skip('login.php', 'error', '密码不能为空！');
}
if (strtolower($_POST['vcode']) != strtolower($_SESSION['vcode'])) {
    skip('login.php', 'error', '验证码输入错误！');
}
if (empty($_POST['status_time']) || !is_numeric($_POST['status_time']) || $_POST['status_time'] < 3600 || $_POST['status_time'] > 2592000) {
    $_POST['status_time'] = 10800;
}
?>