<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/22
 * Time: 15:13
 */
if (strtolower($_POST['vcode']) != strtolower($_SESSION['vcode'])) {
    skip('member_pw_update.php', 'error', '验证码输入错误！');
}
if (mb_strlen($_POST['new_pw']) < 6) {
    skip('member_pw_update.php', 'error', '密码长度不能小于6位！');
}
if ($_POST['new_pw'] != $_POST['confirm_pw']) {
    skip('member_pw_update.php', 'error', '两次输入的密码不一致！');
}
if ($data_member['password'] != md5($_POST['old_pw'])) {
    skip('member_pw_update.php', 'error', '旧密码输入错误！');
}
?>