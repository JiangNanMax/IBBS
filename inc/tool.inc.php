<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/20
 * Time: 08:25
 */
?>
<?php
    function skip($url, $pic, $message) {
$html = <<<JN
        <!DOCTYPE html>
        <html lang="zh-CN">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="refresh" content="3;URL={$url}">
                <title>正在跳转...</title>
                <link rel="shortcut icon" href="css/bbs32.png">
                <link rel="stylesheet" type="text/css" href="css/warn.css">
            </head>
            <body>
                <div class="warn"><span class="pic {$pic}"></span>&nbsp;{$message} <a href="{$url}">3秒后自动跳转!</a></div>
            </body>
        </html>
JN;
        echo $html;
        exit();
    }

    function is_login($conn) {
        if (isset($_COOKIE['ibbs']['username']) && isset($_COOKIE['ibbs']['password'])) {
            $query = "select * from ibbs_member where name='{$_COOKIE['ibbs']['username']}' and sha1(password)='{$_COOKIE['ibbs']['password']}'";
            $result = execute($conn, $query);
            if (mysqli_num_rows($result) == 1) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
?>