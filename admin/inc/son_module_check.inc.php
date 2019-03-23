<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/23
 * Time: 14:53
 */
    if (!is_numeric($_POST['father_module_id'])) {
        skip('son_module_add.php', 'error', '所选的父版块不合法！');
    }
    if (empty($_POST['module_name'])) {
        skip('son_module_add.php', 'error', '子版块名称不能为空');
    }
    if (mb_strlen($_POST['module_name']) > 50) {
        skip('son_module_add.php', 'error', '子版块名称最长为50个字符！');
    }
    if (mb_strlen($_POST['info']) > 255) {
        skip('son_module_add.php', 'error', '子版块简介最长为255个字符！');
    }
    if (!is_numeric($_POST['sort'])) {
        skip('son_module_add.php', 'error', '请用数字来表示排序优先级！');
    }
    $query = "select * from ibbs_father_module where id={$_POST['father_module_id']}";
    $result = execute($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        skip('son_module_add.php', 'error', '所选的父版块不存在！');
    }
    $_POST = escape($conn, $_POST);
    switch ($check_type) {
        case 'add':
            //这里先限定所有的子版块不能重名，后续再改进为同一个父版块下的子版块不能重名
            $query = "select * from ibbs_son_module where module_name='{$_POST['module_name']}'";
            break;
        case 'update':
            break;
        default:
            skip('son_module_add.php', 'error', '内部参数发生错误！请联系上层管理员！');
    }
    $result = execute($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        skip('son_module_add.php', 'error', '该子版块已存在！');
    }
?>