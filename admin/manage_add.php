<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/19
 * Time: 14:45
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$conn = connect();
include_once 'inc/is_manage_login.inc.php';

$template['title'] = '管理员添加页';
$template['css'] = array('style/public.css');

if(isset($_POST['submit'])) {
    include 'inc/check_manage.inc.php';
    $query = "insert into ibbs_manage(name,pw,create_time,level) values('{$_POST['name']}',md5({$_POST['pw']}),now(),{$_POST['level']})";
    execute($conn,$query);
    if(mysqli_affected_rows($conn) == 1) {
        skip('manage.php','ok','添加成功！');
    } else {
        skip('manage.php','error','添加失败，请重试！');
    }
}
?>
<?php include 'inc/header.inc.php'?>
    <div id="main">
        <div class="title" style="margin-bottom:20px;">添加管理员</div>
        <form method="post">
            <table class="au">
                <tr>
                    <td>管理员名称</td>
                    <td><input name="name" type="text" /></td>
                    <td>
                        名称不得为空，不得超过30个字符
                    </td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td><input name="pw" type="text" /></td>
                    <td>
                        不能少于6位
                    </td>
                </tr>
                <tr>
                    <td>等级</td>
                    <td>
                        <select name="level">
                            <option value="1">普通管理员</option>
                            <option value="0">超级管理员</option>
                        </select>
                    </td>
                    <td>
                        默认为普通管理员（不具备后台管理员管理权限）
                    </td>
                </tr>
            </table>
            <input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="添加" />
        </form>
    </div>
<?php include 'inc/footer.inc.php'?>