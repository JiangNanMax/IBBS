<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/19
 * Time: 14:31
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$conn = connect();
include_once 'inc/is_manage_login.inc.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('manage.php','error','参数错误！');
}

$query = "delete from ibbs_manage where id={$_GET['id']}";
execute($conn,$query);
if(mysqli_affected_rows($conn) == 1){
    skip('manage.php','ok','删除成功！');
}else{
    skip('manage.php','error','删除失败，请重试！');
}
?>