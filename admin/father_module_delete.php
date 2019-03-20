<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/19
 * Time: 22:47
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
?>
<?php
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        skip('father_module.php', 'error', 'id参数错误！');
    }
    $conn = connect();
    $query = "delete from ibbs_father_module where id={$_GET['id']}";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('father_module.php', 'ok', '删除成功！');
    }
    else {
        skip('father_module.php', 'error', '删除失败，请重试！');
    }
?>
