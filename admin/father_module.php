<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/8
 * Time: 12:56
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$template['title'] = "IBBS后台管理";
$template['css'] = array('css/index.css');

$conn = connect();
include_once 'inc/is_manage_login.inc.php';
?>
<?php include 'inc/header.inc.php'?>
<div id="main">
    <div class="title">父版块列表</div>
    <table class="list">
        <tr>
            <th>排序</th>
            <th>版块</th>
            <th>操作</th>
        </tr>
        <?php
            $query = 'select * from ibbs_father_module';
            $result = execute($conn, $query);
            while($data = mysqli_fetch_assoc($result)) {
                $url = urlencode("father_module_delete.php?id={$data['id']}");
                $return_url = urlencode($_SERVER['REQUEST_URI']);
                $message = "确定要删除父版块 {$data['module_name']} 吗？";
                $delete_url = "confirm.php?url={$url}&return_url={$return_url}&message={$message}";
                //echo $delete_url;
$html=<<<JN
        <tr>
            <td><input type="text" class="sort" name="sort"></td>
            <td>{$data['module_name']}&nbsp;[id:&nbsp;{$data['id']}]</td>
            <td><a href="#">[访问]</a>&nbsp;&nbsp;<a href="father_module_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;<a href="$delete_url">[删除]</a></td>
        </tr>
JN;
                echo $html;
            }
        ?>
    </table>
</div>
<?php include 'inc/footer.inc.php'?>
