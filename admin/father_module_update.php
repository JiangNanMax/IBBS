<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/21
 * Time: 16:03
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title'] = '修改父版块';
$template['css'] = array('css/index.css');
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('father_module.php', 'error', 'id参数错误！');
}
$conn = connect();
$query = "select * from ibbs_father_module where id={$_GET['id']}";
$result = execute($conn, $query);
if (!mysqli_num_rows($result)) {
    skip('father_module.php', 'error', '该板块不存在！');
}
if (isset($_POST['submit'])) {
    $check_type = 'update';
    include 'inc/father_module_check.inc.php';
    $query = "update ibbs_father_module set module_name='{$_POST['module_name']}',sort={$_POST['sort']} where id={$_GET['id']}";
    //echo $query;
    //exit();
    $result = execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('father_module.php', 'ok', '修改成功！');
    }
    else {
        skip('father_module.php', 'error', '修改失败，请重试！');
    }
}
$data = mysqli_fetch_assoc($result);
?>
<?php include './inc/header.inc.php'?>
    <div id="main">
        <div class="title" style="margin-bottom:20px;">修改父版块 - <?php echo $data['module_name']?></div>
        <form method="post">
            <table class="au">
                <tr>
                    <td>版块名称</td>
                    <td><input name="module_name" value="<?php echo $data['module_name']?>" type="text" /></td>
                    <td class="note">
                        版块名称不得为空，且最长不得超过50个字符
                    </td>
                </tr>
                <tr>
                    <td>排序优先级</td>
                    <td><input name="sort" value="<?php echo $data['sort']?>" type="text" /></td>
                    <td class="note">
                        填写一个数字即可，越大则优先级越高
                    </td>
                </tr>
            </table>
            <input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="修改" />
        </form>
    </div>
<?php include './inc/footer.inc.php'?>