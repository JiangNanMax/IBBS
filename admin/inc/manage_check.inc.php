<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/19
 * Time: 14:49
 */
if(empty($_POST['name'])){
    skip('manage_add.php','error','管理员名称不得为空！');
}
if(mb_strlen($_POST['name']) > 30){
    skip('manage_add.php','error','管理员名称不得多余30个字符！');
}
if(mb_strlen($_POST['pw'])<6){
    skip('manage_add.php','error','密码不得少于6位！');
}

$_POST = escape($conn,$_POST);
$query = "select * from ibbs_manage where name='{$_POST['name']}'";
$result=execute($conn,$query);
if(mysqli_num_rows($result)) {
    skip('manage_add.php','error','该名称已被使用！');
}

if(!isset($_POST['level'])) {
    $_POST['level'] = 1;
}elseif ($_POST['level'] == '0') {
    $_POST['level'] = 0;
}elseif ($_POST['level'] == '1') {
    $_POST['level'] = 1;
} else {
    $_POST['level'] = 1;
}
?>
