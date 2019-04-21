<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/28
 * Time: 13:26
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once "inc/tool.inc.php";

$template['title'] = '发帖';
$template['css'] = array('css/public.css', 'css/publish.css');

$conn = connect();
if (!($member_id = is_login($conn))) {
    skip('login.php', 'error', '登录后才能进行发帖！');
}
if (isset($_POST['submit'])) {
    $_POST = escape($conn, $_POST);
    include 'inc/publish_check.php';
    $query = "insert into ibbs_content(module_id,title,content,publish_time,member_id) values({$_POST['module_id']},'{$_POST['title']}','{$_POST['content']}',now(),{$member_id})";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('publish.php', 'ok', '发布成功！');
    }
    else {
        skip('publish.php', 'error', '发布失败，请重试！');
    }
}
?>
<?php include 'inc/header.inc.php'; ?>
    <div id="position" class="auto">
        <a href="index.php">首页</a> &gt; 发帖
    </div>
    <div id="publish" class="auto">
        <form action="" method="post">
            <select name="module_id">
                <option value="0">------请选择一个版块------</option>
                <?php
                    $where = '';
                    if (isset($_GET['father_module_id']) && is_numeric($_GET['father_module_id'])) {
                        $where = "where id={$_GET['father_module_id']}";
                    }
                    $query = "select * from ibbs_father_module {$where} order by sort desc";
                    $result_f = execute($conn, $query);
                    while ($data_f = mysqli_fetch_assoc($result_f)) {
                        echo ("<optgroup label='{$data_f['module_name']}'>");
                        $query = "select * from ibbs_son_module where father_module_id={$data_f['id']} order by sort desc";
                        $result_s = execute($conn, $query);
                        while ($data_s = mysqli_fetch_assoc($result_s)) {
                            if (isset($_GET['son_module_id']) && $_GET['son_module_id'] == $data_s['id']) {
                                echo ("<option selected='selected' value='{$data_s['id']}'>{$data_s['module_name']}</option>");
                            }
                            else {
                                echo ("<option value='{$data_s['id']}'>{$data_s['module_name']}</option>");
                            }
                        }
                        echo ("</optgroup>");
                    }
                ?>
            </select>
            <input type="text" class="title" name="title" placeholder=" 请输入标题">
            <textarea name="content" class="content"></textarea>
            <input type="submit" name="submit" class="publish" value="发帖">
        </form>
    </div>
<?php include 'inc/footer.inc.php'; ?>