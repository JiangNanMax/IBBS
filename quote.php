<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/14
 * Time: 18:34
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$template['title'] = '引用回复';
$template['css'] = array('css/public.css', 'css/publish.css');

$conn = connect();

if (!($member_id = is_login($conn))) {
    skip('login.php', 'error', '登录后才能进行回复！');
}
if (!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('index.php', 'error', '参数错误!');
}

$query = "select ic.id,ic.title,im.username from ibbs_content ic,ibbs_member im where ic.id={$_GET['id']} and ic.member_id=im.id";
$result_content = execute($conn, $query);
if (mysqli_num_rows($result_content) != 1) {
    skip('index.php', 'error', '您要回复的帖子不存在!');
}
$data_content = mysqli_fetch_assoc($result_content);
$data_content['title'] = htmlspecialchars($data_content['title']);

if(!isset($_GET['reply_id']) || !is_numeric($_GET['reply_id'])) {
    skip('index.php', 'error', '参数错误!');
}
$query = "select ibbs_reply.content,ibbs_member.username from ibbs_reply,ibbs_member where ibbs_reply.id={$_GET['reply_id']} and ibbs_reply.content_id={$_GET['id']} and ibbs_reply.member_id=ibbs_member.id";
$result_reply=execute($conn, $query);
if(mysqli_num_rows($result_reply) != 1){
    skip('index.php', 'error', '您要引用的回复不存在!');
}
if(isset($_POST['submit'])) {
    include 'inc/reply_check.php';
    $_POST = escape($conn, $_POST);
    $query = "insert into ibbs_reply(content_id,quote_id,content,reply_time,member_id) 
			values(
				{$_GET['id']},{$_GET['reply_id']},'{$_POST['content']}',now(),{$member_id}
			)";
    execute($conn, $query);
    if(mysqli_affected_rows($conn) == 1){
        skip("show_detail.php?id={$_GET['id']}", 'ok', '回复成功!');
    }else{
        skip($_SERVER['REQUEST_URI'], 'error', '回复失败,请重试!');
    }
}
$data_reply = mysqli_fetch_assoc($result_reply);
$data_reply['content'] = nl2br(htmlspecialchars($data_reply['content']));
//使用计算在这一条回复之前（包括着一条记录在内）的所有记录的数量就能得到这条记录是在第几楼
$query = "select count(*) from ibbs_reply where content_id={$_GET['id']} and id<={$_GET['reply_id']}";
$floor = get_num($conn, $query);

?>
<?php include 'inc/header.inc.php'; ?>
    <div id="position" class="auto">
        <a href="">首页</a> &gt; <a href="">Java</a> &gt; <a href="">JDBC</a> &gt; 连接数据库
    </div>
    <div id="publish" class="auto">
        <div>回复：由 <?php echo $data_content['username']?> 发布的： <?php echo $data_content['title']?></div>
        <div class="quote">
            <p class="title">引用<?php echo $floor?>楼 <?php echo $data_reply['username']?> 发表的：</p>
            <?php echo $data_reply['content']?>
        </div>
        <form action="" method="post">
            <textarea name="content" class="content"></textarea>
            <input type="submit" class="reply" name="submit" value="回复">
        </form>
    </div>
<?php include 'inc/footer.inc.php'; ?>
