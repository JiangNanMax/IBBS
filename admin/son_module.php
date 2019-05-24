<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/23
 * Time: 14:49
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
include_once '../inc/page.inc.php';

$template['title'] = 'IBBS后台管理';
$template['css'] = array('css/index.css');

$conn = connect();
include_once 'inc/is_manage_login.inc.php';

$query = "select count(*) from ibbs_son_module";
$count_reply = get_num($conn, $query);
$page_size = 6;
$page = page($count_reply, $page_size, 5);
?>
<?php include 'inc/header.inc.php'?>
<div id="main">
    <div class="title">子版块列表</div>
    <table class="list">
        <tr>
            <th>版块名称</th>
            <th>所属父版块</th>
            <th>操作</th>
        </tr>
        <?php

        $query = "select ism.id,ism.module_name,ifm.module_name as father_module_name,ism.member_id from ibbs_son_module as ism join ibbs_father_module as ifm on ism.father_module_id=ifm.id order by ifm.id {$page['limit']}";
        $result = execute($conn, $query);
        while ($data = mysqli_fetch_assoc($result)) {
            $url = urlencode("son_module_delete.php?id={$data['id']}");
            $return_url = urlencode($_SERVER['REQUEST_URI']);
            $message = "确定要删除子版块 {$data['module_name']} 吗？";
            $delete_url = "confirm.php?url={$url}&return_url={$return_url}&message={$message}";
            $html = <<<JN
                    <tr>
                        <td>{$data['module_name']}&nbsp;[id:&nbsp;{$data['id']}]</td>
                        <td>{$data['father_module_name']}</td>
                        <td><a href="list_son.php?id={$data['id']}">[访问]</a>&nbsp;&nbsp;<a href="son_module_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;<a href="{$delete_url}">[删除]</a></td>
                    </tr>
JN;
            echo $html;
        }
        ?>
    </table>
    <div class="pages_wrap_show">
        <div class="pages">
            <?php
            echo $page['html'];
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.inc.php'?>



