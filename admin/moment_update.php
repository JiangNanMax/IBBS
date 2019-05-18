<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/17
 * Time: 10:20
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$template['title'] = '修改动态';
$template['css'] = array('css/index.css');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('index.php', 'error', 'id参数错误！');
}
$conn = connect();
$query = "select * from ibbs_moment where id={$_GET['id']}";
$result = execute($conn, $query);
if (!mysqli_num_rows($result)) {
    skip('moments.php', 'error', '该动态不存在！');
}

if (isset($_POST['submit'])) {
    $query = "update ibbs_moment set title='{$_POST['title']}',introduction={$_POST['info']},url={$_POST['url']} where id={$_GET['id']}";
    $result = execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('moments.php', 'ok', '修改成功！');
    }
    else {
        skip('moments.php', 'error', '修改失败，请重试！');
    }
}

$data = mysqli_fetch_assoc($result);
?>
<?php include './inc/header.inc.php'?>
    <div id="main">
        <div class="title" style="margin-bottom:20px;">修改动态 - <?php echo $data['title']?></div>
        <form method="post">
            <table class="au">
                <tr>
                    <td>动态名称</td>
                    <td><input name="module_name" value="<?php echo $data['title']?>" type="text" /></td>
                    <td class="note">
                        动态名称不得为空，且最长不得超过50个字符
                    </td>
                </tr>

                <tr>
                    <td>动态简介</td>
                    <td>
                        <textarea name="info"><?php echo $data['introduction']?></textarea>
                    </td>
                    <td class="note">
                        建议添加有关该动态的简要介绍
                    </td>
                </tr>

                <tr>
                    <td>链接地址</td>
                    <td><input name="url" value="<?php echo $data['url']?>" type="text" /></td>
                    <td class="note">
                        务必添加动态的链接地址
                    </td>
                </tr>

            </table>
            <input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="修改" />
        </form>
    </div>
<?php include './inc/footer.inc.php'?>
