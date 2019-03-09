<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/8
 * Time: 12:56
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';

$conn = connect();
$query = 'select * from ibbs_father_module';
$result = execute($conn, $query);
exit($query);
close($conn);
?>