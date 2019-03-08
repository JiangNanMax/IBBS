<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/7
 * Time: 18:04
 */

//数据库连接
function connect($host=DB_HOST, $user=DB_USER, $password=DB_PASSWORD, $database=DB_DATABASE, $port=DB_PORT) {
    $conn = @mysqli_connect($host, $user, $password, $database, $port);
    if (mysqli_connect_error()) {
        exit(mysqli_connect_error());
    }
    mysqli_set_charset($conn, 'utf-8');
    return $conn;
}

//执行一条SQL语句，返回结果集对象或者布尔值
function execute($conn, $query) {
    $result = mysqli_query($conn, $query);
    if (mysqli_error($conn)) {
        exit(mysqli_error($conn));
    }
    return $result;
}

//执行一条SQL语句，返回布尔值
function execute_bool($conn, $query) {
    $bool = mysqli_query($conn, $query);
    if (mysqli_error($conn)) {
        exit(mysqli_error($conn));
    }
    return $bool;
}

//执行多条SQL语句
function execute_multi() {
}

//获取某个记录的数量
function get_num($conn, $query) {
    $result = execute($conn, $query);
    $num = mysqli_fetch_row($result);
    return num[0];
}

//断开数据库连接
function close($conn) {
    mysqli_close($conn);
}
?>