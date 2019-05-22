<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/22
 * Time: 15:00
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/upload.inc.php';

$conn = connect();
if(!$member_id = is_login($conn)){
    skip('login.php', 'error', '请先登录!');
}
$query = "select * from ibbs_member where id={$member_id}";
$result_member = execute($conn,$query);
$data_member = mysqli_fetch_assoc($result_member);
if(isset($_POST['submit'])){
    include 'inc/register_check.php';
    $query = "update ibbs_member set password=md5('{$_POST['new_pw']}') where id={$member_id}";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('member.php?id='.$member_id, 'ok', '密码修改成功！');
    }
    else {
        skip('member_pw_update.php', 'error', '密码修改失败，请重试！');
    }
}
//SUB_URL.
?>
<?php include 'inc/header.inc.php';?>
<div id="register" class="auto">
    <h2>修改密码</h2>
    <form method="post">
        <label>旧密码：<input type="password" name="old_pw"><span class="note">&nbsp;- 为确认是本人操作,请输入原来的密码&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
        <label>新密码：<input type="password" name="new_pw"><span class="note">&nbsp;- 请输入你的新密码，不少于6位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
        <label>新密码：<input type="password" name="confirm_pw"><span class="note">&nbsp;- 请重新输入密码，确认一致&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
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
</body>
</html>