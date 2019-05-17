<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/17
 * Time: 09:50
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$template['title'] = '添加动态';
$template['css'] = array('css/index.css');

if (isset($_POST['submit'])) {
    $conn = connect();

    $query = "insert into ibbs_moment (title, introduction, url, add_time) values ('{$_POST['title']}', '{$_POST['info']}', '{$_POST['url']}', now())";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('moments.php', 'ok', '动态添加成功！');
    }
    else {
        skip('moment_add.php', 'error', '动态添加失败，请重试！');
    }
}
?>
<?php include 'inc/header.inc.php' ?>
<div id="main">
    <div class="title" style="margin-bottom:20px;">添加动态</div>
    <form method="post">
        <table class="au">
            <tr>
                <td>动态名称</td>
                <td><input name="title" type="text" /></td>
                <td class="note">
                    动态名称不得为空，且最长不得超过50个字符
                </td>
            </tr>

            <tr>
                <td>动态简介</td>
                <td>
                    <textarea name="info"></textarea>
                </td>
                <td class="note">
                    建议添加有关该动态的简要介绍
                </td>
            </tr>

            <tr>
                <td>链接地址</td>
                <td><input name="url" type="text" /></td>
                <td class="note">
                    务必添加动态的链接地址
                </td>
            </tr>

        </table>
        <input style="margin-left:110px;margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="添加" />
    </form>
</div>
<?php include 'inc/footer.inc.php' ?>