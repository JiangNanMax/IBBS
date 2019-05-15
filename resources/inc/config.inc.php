<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/7
 * Time: 16:02
 */
date_default_timezone_set('Asia/Shanghai');
session_start();
header('Content-type:text/html;charset=utf-8');
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ibbs');
define('SA_PATH',dirname(dirname(__FILE__)));
define('SUB_URL',str_replace($_SERVER['DOCUMENT_ROOT'],'',str_replace('\\','/',SA_PATH)).'/');
?>