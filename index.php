<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/25
 * Time: 20:21
 */
echo '<pre>';
print_r(gd_info());
echo '</pre>';
echo '<br>';
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';

$conn = connect();
$query = "select * from ibbs_member";
$result = execute($conn, $query);

while($data = mysqli_fetch_assoc($result)) {
    echo $data['username'];
    echo sha1($data['password']);
}
?>