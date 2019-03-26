<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/25
 * Time: 16:09
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
if (isset($_POST['submit'])) {
    $conn = connect();
    include 'inc/register_check.php';
    $query = "insert into ibbs_member(username,password,photo,register_time,last_login_time) values('{$_POST['username']}',md5('{$_POST['password']}'),'',now(),now())";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('index.php', 'ok', '注册成功！');
    }
    else {
        skip('register.php', 'error', '注册失败，请重试！');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <link rel="shortcut icon" href="css/bbs32.png">
    <link rel="stylesheet" href="css/public.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<div class="header_wrap">
    <div id="header" class="auto">
        <div class="logo">IBBS</div>
        <div class="nav">
            <a href="#" class="hover">首页</a>
            <a href="#">话题</a>
            <a href="#">热门</a>
        </div>
        <div class="search">
            <form action="">
                <input type="text" class="keyword" name="keyword" placeholder="输入你想搜索的内容">
                <input type="submit" class="submit" name="submit" value="">
            </form>
        </div>
        <div class="login">
            <a href="">登陆</a>
            &nbsp;
            <a href="register.php">注册</a>
        </div>
    </div>
</div>
<div class="place-holder"></div>
<div id="register" class="auto">
    <h2>欢迎注册成为IBBS的用户!</h2>
    <form method="post">
        <label>用户名：<input type="text" name="username"><span class="note">&nbsp;- 用户名不得为空,不超过30个字符</span></label>
        <label>密码：<input type="password" name="password"><span class="note">&nbsp;- 为保障安全,密码不能少于6位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
        <label>确认密码：<input type="password" name="confirm_password"><span class="note">&nbsp;- 请重新输入密码，确认一致&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
        <label>验证码：<input type="text" name="vcode"><span class="note">&nbsp;- 请正确输入下图中的验证码&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
        <img src="css/show_code.php.jpg" class="vcode" alt="">
        <div style="clear:both;"></div>
        <input type="submit" name="submit" class="btn" value="注册">
    </form>
</div>
<div id="footer" class="auto">
    <div class="bottom">
        <a href="#">IBBS</a>
    </div>
    <div class="copyright">Powered by JiangNanMax ©2019</div>
</div>
</body>
</html>