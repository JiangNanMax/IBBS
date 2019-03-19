<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/19
 * Time: 22:47
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
$conn = connect();
?>
<?php
    //exit($_GET['id']);
    $query = "delete from ibbs_father_module where id={$_GET['id']}";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        exit("删除成功！");
    }
?>
