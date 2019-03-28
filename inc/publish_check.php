<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/28
 * Time: 13:44
 */
if (empty($_POST['module_id']) || !is_numeric($_POST['module_id'])) {
    skip('publish.php', 'error', '所属版块id非法！');
}
if (empty($_POST['title'])) {
    skip('publish.php', 'error', '标题不得为空！');
}
if (mb_strlen($_POST['title']) > 255) {
    skip('publish.php', 'error', '标题字符长度不能超过255！');
}
if (empty($_POST['content'])) {
    skip('publish.php', 'error', '内容不得为空！');
}
$query = "select * from ibbs_son_module where id={$_POST['module_id']}";
$result = execute($conn, $query);
if (mysqli_num_rows($reuslt) != 1) {
    skip('publish.php', 'error', '所属版块不存在！');
}
?>