<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/19
 * Time: 16:20
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$conn = connect();
$query = "select * from ibbs_moment order by add_time desc limit 5";
$result = execute($conn, $query);
while($data = mysqli_fetch_assoc($result)) {
    echo $data['title'];
    echo '<br/>';
    echo '<br/>';
    echo $data['introduction'];
    echo '<br/>';
    echo '<br/>';
}

echo '<br/>';echo '<br/>';echo '<br/>';

$query = "select * from ibbs_moment order by add_time desc limit 5 offset 5";
$result = execute($conn, $query);
while($data = mysqli_fetch_assoc($result)) {
    echo $data['title'];
    echo '<br/>';
    echo '<br/>';
    echo $data['introduction'];
    echo '<br/>';
    echo '<br/>';
}

echo '<br/>';echo '<br/>';echo '<br/>';

$query = "select * from ibbs_moment order by add_time desc limit 5 offset 10";
$result = execute($conn, $query);
while($data = mysqli_fetch_assoc($result)) {
    echo $data['title'];
    echo '<br/>';
    echo '<br/>';
    echo $data['introduction'];
    echo '<br/>';
    echo '<br/>';
}

?>