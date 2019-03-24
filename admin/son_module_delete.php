<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/23
 * Time: 22:37
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
?>
<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('son_module.php', 'error', 'id参数错误！');
}
$conn = connect();
$query = "delete from ibbs_son_module where id={$_GET['id']}";
execute($conn, $query);
if (mysqli_affected_rows($conn) == 1) {
    skip('son_module.php', 'ok', '删除成功！');
}
else {
    skip('son_module.php', 'error', '删除失败，请重试！');
}
?>
