<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/19
 * Time: 21:47
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
            echo "<link rel='stylesheet' type='text/css' href='{$val}'>";
        }
    ?>
</head>
<body>
<div id="top">
    <div class="logo">
        IBBS管理中心
    </div>
    <div class="login_info">
        <a target="_blank" href="../index.php" style="color:#fff;">网站首页</a>&nbsp;|&nbsp;
        管理员：<?php echo $_SESSION['manage']['name']?> <a style="color:#fff;" href="logout.php">[注销]</a>
    </div>
</div>
<div id="sidebar">
    <ul>
        <li>
            <div class="small_title">系统</div>
            <ul class="child">
                <li><a href="index.php" <?php if(basename($_SERVER['SCRIPT_NAME'])=='index.php'){echo 'class="current"';}?>>系统信息</a></li>
                <li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='manage.php'){echo 'class="current"';}?> href="manage.php">管理员</a></li>
                <li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='manage_add.php'){echo 'class="current"';}?> href="manage_add.php">添加管理员</a></li>
                <!--<li><a href="#">站点设置</a></li>-->
            </ul>
        </li>
        <li>
            <div class="small_title">内容管理</div>
            <ul class="child">
                <li><a href="father_module.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'father_module.php') {echo "current";} ?>">父版块列表</a></li>
                <?php
                    if (basename($_SERVER['SCRIPT_NAME']) == 'father_module_update.php') {
                        echo '<li><a href="" class="current">修改父版块</a></li>';
                    }
                ?>
                <li><a href="father_module_add.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'father_module_add.php') {echo "current";} ?>">添加父版块</a></li>
                <li><a href="son_module.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'son_module.php') {echo "current";} ?>">子版块列表</a></li>
                <?php
                    if (basename($_SERVER['SCRIPT_NAME']) == 'son_module_update.php') {
                        echo '<li><a href="" class="current">修改子版块</a></li>';
                    }
                ?>
                <li><a href="son_module_add.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'son_module_add.php') {echo "current";} ?>">添加子版块</a></li>
                <li><a target="_blank" href="../index.php">帖子管理</a></li>
            </ul>
        </li>
        <li>
            <div class="small_title">用户管理</div>
            <ul class="child">
                <li><a href="user_list.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'user_list.php') {echo "current";} ?>">用户列表</a></li>
                <li><a href="user_search.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'user_search.php') {echo "current";} ?>">搜索用户</a></li>
            </ul>
        </li>

        <li>
            <div class="small_title">动态管理</div>
            <ul class="child">
                <li><a href="moments.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'moments.php') {echo "current";} ?>">动态列表</a></li>
                <li><a href="moment_add.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'moment_add.php') {echo "current";} ?>">添加新动态</a></li>
                <?php
                    if (basename($_SERVER['SCRIPT_NAME']) == 'moment_update.php') {
                        echo '<li><a href="" class="current">修改动态</a></li>';
                    }
                ?>
            </ul>
        </li>

        <li>
            <div class="small_title">资源管理</div>
            <ul class="child">
                <li><a href="resources.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'resources.php') {echo "current";} ?>">资源列表</a></li>
                <li><a href="resource_add.php" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'resource_add.php') {echo "current";} ?>">添加新资源</a></li>
                <?php
                if (basename($_SERVER['SCRIPT_NAME']) == 'resource_update.php') {
                    echo '<li><a href="" class="current">修改资源</a></li>';
                }
                ?>
            </ul>
        </li>

    </ul>
</div>
