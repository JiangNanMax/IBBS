<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/14
 * Time: 15:17
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$template['title'] = '回复';
$template['css'] = array('css/public.css', 'css/publish.css');

$conn = connect();

if (!($member_id = is_login($conn))) {
    skip('login.php', 'error', '登录后才能进行回复！');
}
if (!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('index.php', 'error', '参数错误!');
}

$query = "select ic.id,ic.title,im.username from ibbs_content sc,ibbs_member im where ic.id={$_GET['id']} and ic.member_id=im.id";
$result_content = execute($conn, $query);
if (mysqli_num_rows($result_content) != 1) {
    skip('index.php', 'error', '您要回复的帖子不存在!');
}
if (isset($_POST['submit'])) {
    include 'inc/reply_check.php';
    $_POST = escape($conn, $_POST);
    $query = "insert into ibbs_reply(content_id,content,reply_time,member_id) values({$_GET['id']},'{$_POST['content']}',now(),{$member_id})";
    execute($conn, $query);
    if(mysqli_affected_rows($link) == 1) {
        skip("show.php?id={$_GET['id']}", 'ok', '回复成功!');
    }else{
        skip($_SERVER['REQUEST_URI'], 'error', '回复失败,请重试!');
    }
}

$data_content=mysqli_fetch_assoc($result_content);
$data_content['title']=htmlspecialchars($data_content['title']);

?>
<?php include 'inc/header.inc.php'; ?>
    <div id="position" class="auto">
        <a href="index.php">首页</a> &gt; 回复
    </div>
    <div id="publish" class="auto">
        <div>回复：由 <?php echo $data_content['name']?> 发布的： <?php echo $data_content['title']?></div>
        <form method="post">
            <textarea name="content" class="content"></textarea>
            <input type="submit" name="submit" class="publish" value="回复">
            <div style="clear:both;"></div>
        </form>
    </div>
<?php include 'inc/footer.inc.php'; ?>