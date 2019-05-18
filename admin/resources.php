<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/17
 * Time: 21:03
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';

$template['title'] = "IBBS后台管理";
$template['css'] = array('css/index.css');

$conn = connect();
?>
<?php include 'inc/header.inc.php' ?>

<div id="main">
    <div class="title">资源列表</div>
    <table class="list">
        <tr>
            <th>名称</th>
            <th>存储位置</th>
            <th>添加时间</th>
            <th>封面图</th>
            <th>操作</th>
        </tr>
        <?php
        $query = 'select * from ibbs_resource';
        $result = execute($conn, $query);
        while($data = mysqli_fetch_assoc($result)) {
            $url = urlencode("resource_delete.php?id={$data['id']}");
            $return_url = urlencode($_SERVER['REQUEST_URI']);
            $message = "确定要删除资源 {$data['title']} 吗？";
            $delete_url = "confirm.php?url={$url}&return_url={$return_url}&message={$message}";
            $pic_path = $data['photo'];
            //echo $delete_url;
            $html=<<<JN
        <tr>
            <td>{$data['title']}&nbsp;[id:&nbsp;{$data['id']}]</td>
            <td>{$data['url']}</td>
            <td>{$data['add_time']}</td>
            <!-- 待转为动态获取图片链接 -->
            <td><img width=80 height=110 src="{$pic_path}" alt=""></td>
            <td><a href="{$data['url']}">[访问]</a>&nbsp;&nbsp;<a href="resource_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;<a href="$delete_url">[删除]</a></td>
        </tr>
JN;
            echo $html;
        }
        ?>
    </table>
</div>

<?php include 'inc/footer.inc.php' ?>
