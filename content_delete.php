<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/15
 * Time: 16:07
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$conn = connect();
$is_manage_login = is_manage_login($conn);
!$member_id = is_login($conn);
if(!$member_id && !$is_manage_login){
    skip('login.php', 'error', '请先登录!');
}
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('index.php', 'error', '参数错误!');
}

$query = "select member_id from ibbs_content where id={$_GET['id']}";
$result_content = execute($conn, $query);
if(mysqli_num_rows($result_content) == 1){
    $data_content = mysqli_fetch_assoc($result_content);
    if(check_user($member_id, $data_content['member_id'], $is_manage_login)){
        $query="delete from ibbs_content where id={$_GET['id']}";
        execute($conn, $query);
        if(isset($_GET['return_url'])){
            $return_url = $_GET['return_url'];
        }else{
            $return_url = "member.php?id={$member_id}";
        }
        if(mysqli_affected_rows($conn) == 1){
            skip($return_url, 'ok', '删除成功!');
        }else{
            skip($return_url, 'error', '删除失败!');
        }
    }else{
        skip('index.php', 'error', '这个帖子不属于你，你没有权限!');
    }
}else{
    skip('index.php', 'error', '帖子不存在!');
}
?>