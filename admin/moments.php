<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/17
 * Time: 09:52
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
include_once '../inc/page.inc.php';

$conn = connect();
include_once 'inc/is_manage_login.inc.php';

$template['title'] = "IBBS后台管理";
$template['css'] = array('css/index.css');

$query = "select count(*) from ibbs_moment";
$count_reply = get_num($conn, $query);
$page_size = 8;
$page = page($count_reply, $page_size, 5);
?>
<?php include 'inc/header.inc.php' ?>

<div id="main">
    <div class="title">动态列表</div>
    <table class="list">
        <tr>
            <th>名称</th>
            <th>链接</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        <?php
        $query = "select * from ibbs_moment order by add_time desc {$page['limit']}";
        $result = execute($conn, $query);
        while($data = mysqli_fetch_assoc($result)) {
            $url = urlencode("moment_delete.php?id={$data['id']}");
            $return_url = urlencode($_SERVER['REQUEST_URI']);
            $message = "确定要删除动态 {$data['title']} 吗？";
            $delete_url = "confirm.php?url={$url}&return_url={$return_url}&message={$message}";
            //echo $delete_url;
            $html=<<<JN
        <tr>
            <td>{$data['title']}&nbsp;[id:&nbsp;{$data['id']}]</td>
            <td>{$data['url']}</td>
            <td>{$data['add_time']}</td>
            <td><a href="{$data['url']}">[访问]</a>&nbsp;&nbsp;<a href="moment_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;<a href="$delete_url">[删除]</a></td>
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

<?php include 'inc/footer.inc.php' ?>
