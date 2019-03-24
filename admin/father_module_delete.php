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
    $query = "select * from ibbs_son_module where father_module_id={$_GET['id']}";
    $result = execute($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        skip('father_module.php', 'error', '该父版块下存在子版块，请先删除对应的子版块！');
    }
    $query = "delete from ibbs_father_module where id={$_GET['id']}";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('father_module.php', 'ok', '删除成功！');
    }
    else {
        skip('father_module.php', 'error', '删除失败，请重试！');
    }
?>
