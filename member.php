<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/15
 * Time: 14:02
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';

$template['title'] = '个人中心';
$template['css'] = array('css/public.css','css/list.css','css/member.css');

$conn = connect();
$member_id = is_login($conn);

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('index.php', 'error', '参数错误!');
}
$query="select * from ibbs_member where id={$_GET['id']}";
$result_member = execute($conn, $query);
if(mysqli_num_rows($result_member) != 1){
    skip('index.php', 'error', '该会员不存在!');
}
$data_member = mysqli_fetch_assoc($result_member);
$query="select count(*) from ibbs_content where member_id={$_GET['id']}";
$count_all=get_num($conn, $query);

?>

<?php include 'inc/header.inc.php'?>
<div id="position" class="auto">
    <a href="index.php">首页</a> &gt; <?php echo $data_member['username']?>
</div>
<div id="main" class="auto">
    <div id="left">
        <ul class="postList">
            <?php
            $page=page($count_all, 5, 5);
            $query="select
			ibbs_content.title,ibbs_content.id,ibbs_content.publish_time,ibbs_content.times,ibbs_content.member_id,ibbs_member.username,ibbs_member.photo
			from ibbs_content,ibbs_member where
			ibbs_content.member_id={$_GET['id']} and
			ibbs_content.member_id=ibbs_member.id order by id desc {$page['limit']}";
            $result_content = execute($conn, $query);
            while($data_content = mysqli_fetch_assoc($result_content)) {
                $data_content['title'] = htmlspecialchars($data_content['title']);
                $query = "select reply_time from ibbs_reply where content_id={$data_content['id']} order by id desc limit 1";
                $result_last_reply = execute($conn, $query);
                if(mysqli_num_rows($result_last_reply) == 0){
                    $last_time = '暂无回复';
                }else{
                    $data_last_reply = mysqli_fetch_assoc($result_last_reply);
                    $last_time=$data_last_reply['reply_time'];
                }
                $query="select count(*) from ibbs_reply where content_id={$data_content['id']}";
                ?>
                <li>
                    <div class="smallPic">
                        <img width="45" height="45" src="<?php if($data_content['photo']!=''){echo SUB_URL.$data_content['photo'];}else{echo 'css/photo.jpg';}?>" />
                    </div>
                    <div class="subject">
                        <div class="titleWrap"><h2><a target="_blank" href="show_detail.php?id=<?php echo $data_content['id']?>"><?php echo $data_content['title']?></a></h2></div>
                        <p>
                            <?php
                            if(check_user($member_id, $data_content['member_id'])){
                                $url = urlencode("content_delete.php?id={$data_content['id']}");
                                $return_url = urlencode($_SERVER['REQUEST_URI']);
                                $message = "你真的要删除帖子 {$data_content['title']} 吗？";
                                $delete_url = "confirm.php?url={$url}&return_url={$return_url}&message={$message}";
                                echo "<a href='content_update.php?id={$data_content['id']}'>编辑</a> <a href='{$delete_url}'>删除</a>";
                            }
                            ?>
                            发帖日期：<?php echo $data_content['publish_time']?>&nbsp;&nbsp;&nbsp;&nbsp;最后回复：<?php echo $last_time ?>
                        </p>
                    </div>
                    <div class="count">
                        <p>
                            回复<br /><span><?php echo get_num($conn, $query)?></span>
                        </p>
                        <p>
                            浏览<br /><span><?php echo $data_content['times']?></span>
                        </p>
                    </div>
                    <div style="clear:both;"></div>
                </li>
            <?php }?>
        </ul>
        <div class="pages_wrap">
            <div class="pages">
                <?php
                    echo $page['html'];
                ?>
            </div>
        </div>
    </div>
    <div id="right">
        <div class="member_big">
            <dl>
                <dt>
                    <img width="180" height="180" src="<?php if($data_content['photo']!=''){echo $data_content['photo'];}else{echo 'css/photo.jpg';}?>" />
                </dt>
                <dd class="name"><?php echo $data_member['username']?></dd>
                <dd>发帖数：<?php echo $count_all?></dd>
                <!--<dd>操作：<a target="_blank" href="">修改头像</a> | <a target="_blank" href="">修改密码</a></dd>-->
                <?php
                if($member_id == $data_member['id']){
                ?>
                <dd>操作：<a target="_blank" href="member_photo_update.php">修改头像</a><!--  | <a target="_blank" href="">修改密码</a></dd> -->
                <?php }?>
            </dl>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>
<?php include 'inc/footer.inc.php'?>
