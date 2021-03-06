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

$template['title'] = '注册';
$template['css'] = array('css/public.css', 'css/register.css');

$conn = connect();
$member_id = is_login($conn);
if ($member_id) {
    skip('index.php', 'error', '你已登录，请勿重复注册！');
}
if (isset($_POST['submit'])) {
    include 'inc/register_check.php';
    $query = "insert into ibbs_member(username,password,photo,register_time,last_login_time) values('{$_POST['username']}',md5('{$_POST['password']}'),'',now(),now())";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        //设置cookie，默认有效时间3个小时
        setcookie('username', $_POST['username'], time() + 10800);
        //setcookie('password', sha1(md5($_POST['password'])));
        skip('index.php', 'ok', '注册成功！');
    }
    else {
        skip('register.php', 'error', '注册失败，请重试！');
    }
}
?>
<?php include 'inc/header.inc.php';?>
<div id="register" class="auto">
    <h2>欢迎注册成为IBBS的用户!</h2>
    <form method="post">
        <label>用户名：<input type="text" name="username" id="user_name"><span class="note">&nbsp;- 用户名不得为空,不超过30个字符</span></label>
        <label>密码：<input type="password" name="password"><span class="note">&nbsp;- 为保障安全,密码不能少于6位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
        <label>确认密码：<input type="password" name="confirm_password"><span class="note">&nbsp;- 请重新输入密码，确认一致&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
        <label>验证码：<input type="text" name="vcode"><span class="note">&nbsp;- 请正确输入下图中的验证码&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
        <img src="show_vcode.php" class="vcode" alt="">
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
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
    $('#user_name').blur(function () {
        var username = $(this).val();
        if (username == '') {
            alert('用户名不能为空！');
        }
        else {
            $.ajax({
                type: "POST",
                url: 'confirm_username.php',
                data: {"user_name": username},
                success: function (data) {
                    var data_json = $.parseJSON(data);
                    if (data_json['flag'] == true) {
                        if (data_json['msg'] == 1) {
                            alert('该用户名已被使用！');
                            $('#user_name').val('');
                        }
                    }
                }
            });
        }
    });
</script>
</body>
</html>