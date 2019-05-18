<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/18
 * Time: 22:47
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$template['title'] = '修改资源';
$template['css'] = array('css/index.css');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('index.php', 'error', 'id参数错误！');
}
$conn = connect();
$query = "select * from ibbs_resource where id={$_GET['id']}";
$result = execute($conn, $query);
if (!mysqli_num_rows($result)) {
    skip('resources.php', 'error', '该资源不存在！');
}

if (isset($_POST['submit'])) {
    $query = "update ibbs_resource set title='{$_POST['title']}',introduction={$_POST['info']} where id={$_GET['id']}";
    $result = execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('resources.php', 'ok', '修改成功！');
    }
    else {
        skip('resources.php', 'error', '修改失败，请重试！');
    }
}

$data = mysqli_fetch_assoc($result);
?>
<?php include './inc/header.inc.php'?>
    <div id="main">
        <div class="title" style="margin-bottom:20px;">修改资源 - <?php echo $data['title']?></div>
        <form method="post">
            <table class="au">
                <tr>
                    <td>资源名称</td>
                    <td><input name="title" value="<?php echo $data['title']?>" type="text" /></td>
                    <td class="note">
                        资源名称不得为空，且最长不得超过50个字符
                    </td>
                </tr>

                <tr>
                    <td>资源简介</td>
                    <td>
                        <textarea name="info"><?php echo $data['introduction']?></textarea>
                    </td>
                    <td class="note">
                        建议添加有关该资源的简要介绍
                    </td>
                </tr>
            </table>
            <input style="margin-left:110px;margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="添加" />
        </form>
    </div>
<?php include './inc/footer.inc.php'?>