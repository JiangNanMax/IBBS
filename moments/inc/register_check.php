<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/25
 * Time: 20:21
 */
if (strtolower($_POST['vcode']) != strtolower($_SESSION['vcode'])) {
    skip('register.php', 'error', '验证码输入错误！');
}
if (empty($_POST['username'])) {
    skip('register.php', 'error', '用户名不能为空！');
}
if (mb_strlen($_POST['username']) > 30) {
    skip('register.php', 'error', '用户名长度不能大于30！');
}
if (mb_strlen($_POST['password']) < 6) {
    skip('register.php', 'error', '密码长度不能小于6位！');
}
if ($_POST['password'] != $_POST['confirm_password']) {
    skip('register.php', 'error', '两次输入的密码不一致！');
}
$_POST = escape($conn, $_POST);
$query = "select * from ibbs_member where username='{$_POST['username']}'";
$result = execute($conn, $query);
if (mysqli_num_rows($result)) {
    skip('register.php', 'error', '该用户名已被使用！');
}
?>