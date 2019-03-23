<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/20
 * Time: 15:57
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title'] = '添加父版块';
$template['css'] = array('css/index.css');
if (isset($_POST['submit'])) {
    $conn = connect();
    $check_type = 'add';
    include 'inc/father_module_check.inc.php';
    $query = "insert into ibbs_father_module (module_name, sort) values ('{$_POST['module_name']}', '{$_POST['sort']}')";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('father_module.php', 'ok', '父版块添加成功！');
    }
    else {
        skip('father_module_add.php', 'error', '父版块添加失败，请重试！');
    }
}
?>
<?php include 'inc/header.inc.php' ?>
    <div id="main">
        <div class="title" style="margin-bottom:20px;">添加父版块</div>
        <form method="post">
            <table class="au">
                <tr>
                    <td>版块名称</td>
                    <td><input name="module_name" type="text" /></td>
                    <td class="note">
                        版块名称不得为空，且最长不得超过50个字符
                    </td>
                </tr>
                <tr>
                    <td>排序优先级</td>
                    <td><input name="sort" type="text" /></td>
                    <td class="note">
                        填写一个数字即可，越大则优先级越高
                    </td>
                </tr>
            </table>
            <input style="margin-left:110px;margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="添加" />
        </form>
    </div>
<?php include 'inc/footer.inc.php' ?>