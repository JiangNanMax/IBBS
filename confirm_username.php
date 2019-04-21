<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/4/21
 * Time: 14:48
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$username = isset($_POST['user_name']) ? $_POST['user_name'] : "";
if ($username == "") {
    exit(json_encode(array("flag"=>false, "msg"=>"查询参数错误！")));
} else {
    $conn = connect();
    $query = "select * from ibbs_member where username='{$username}'";
    $cnt = get_num($conn, $query);
    if ($cnt == 0) {
        exit(json_encode(array("flag"=>true, "msg"=>0)));
    } else {
        exit(json_encode(array("flag"=>true, "msg"=>1)));
    }
}
?>