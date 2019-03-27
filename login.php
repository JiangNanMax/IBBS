<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/27
 * Time: 09:17
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$template['title'] = '登录';
$template['css'] = array('css/public.css', 'css/register.css');

$conn = connect();
if (is_login($conn)) {
    skip('index.php', 'error', '你已经登录，请勿重复登录！');
}
if (isset($_POST)) {
    $_POST = escape($conn, $_POST);
    $query = "select * from ibbs_member where username='{$_POST['username']}' and password=md5('{$_POST['password']}')";
    $result = execute($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        setcookie('username', $_POST['username'], time() + $_POST['status_time']);
        skip('index.php', 'ok', '登录成功！');
    }
    else {
        skip('login.php', 'error', '用户名或密码错误！');
    }
}
?>
<?php include 'inc/header.inc.php' ?>
<div id="register" class="auto">
    <h2>欢迎登录!</h2>
    <form>
        <label>用户名：<input type="text" name="username"><span class="note">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
        <label>密码：<input type="password" name="password">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <label class="free_login">
            <span>免登录：</span>
            <select name="status_time" style="width:236px;height:25px;">
                <option value="3600">1小时</option>
                <option value="10800" selected="selected">3小时</option>
                <option value="86400">一天</option>
                <option value="604800">一周</option>
                <option value="2592000">一个月</option>
            </select>
        </label>
        <label>验证码：<input type="text" name="vcode">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <img src="show_vcode.php" class="vcode" alt="">
        <div style="clear:both;"></div>
        <input type="submit" name="submit" class="btn" value="登录">
    </form>
</div>
<?php include 'inc/footer.inc.php' ?>
