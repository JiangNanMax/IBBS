<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/27
 * Time: 09:21
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo $template['title'] ?></title>
    <link rel="shortcut icon" href="css/bbs32.png">
    <?php
        foreach ($template['css']  as $val) {
            echo "<link rel='stylesheet' type='text/css' href='{$val}'/>";
        }
    ?>
</head>
<body>
<div class="header_wrap">
    <div id="header" class="auto">
        <div class="logo">IBBS</div>
        <div class="nav">
            <a href="#" class="hover">首页</a>
            <a href="#">话题</a>
            <a href="#">热门</a>
        </div>
        <div class="search">
            <form action="">
                <input type="text" class="keyword" name="keyword" placeholder="输入你想搜索的内容">
                <input type="submit" class="submit" name="submit" value="">
            </form>
        </div>
        <div class="login">
            <a href="">登录</a>
            &nbsp;
            <a href="">注册</a>
        </div>
    </div>
</div>
<div class="place-holder"></div>