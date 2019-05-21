<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/20
 * Time: 15:07
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';

$template['title'] = '搜索页';
$template['css'] = array('css/public.css','css/list.css');

$conn = connect();
$member_id = is_login($conn);
$is_manage_login = is_manage_login($conn);

if(!isset($_GET['keyword'])) {
    $_GET['keyword'] = '';
}
$_GET['keyword'] = trim($_GET['keyword']);
$_GET['keyword'] = escape($conn, $_GET['keyword']);
$query = "select count(*) from ibbs_content where title like '%{$_GET['keyword']}%'";
$count_all = get_num($conn, $query);
$page = page($count_all, 5, 5);
?>
<?php include 'inc/header.inc.php'?>
    <div id="position" class="auto">
        <a href="index.php">首页</a> &gt; 搜索页
    </div>
    <div id="main" class="auto">
        <div id="left">
            <div class="box_wrap">
                <h3>共找到<?php echo $count_all?>篇匹配的帖子</h3>
            </div>
            <div style="clear:both;"></div>
            <ul class="postList">
                <?php
                $query="select
			ibbs_content.title,ibbs_content.id,ibbs_content.publish_time,ibbs_content.times,ibbs_content.member_id,ibbs_member.username,ibbs_member.photo
			from ibbs_content,ibbs_member where
			ibbs_content.title like '%{$_GET['keyword']}%' and
			ibbs_content.member_id=ibbs_member.id
			{$page['limit']}";
                $result_content = execute($conn, $query);
                while($data_content = mysqli_fetch_assoc($result_content)) {
                    $data_content['title'] = htmlspecialchars($data_content['title']);
                    $data_content['title_color'] = str_replace($_GET['keyword'],"<span style='color:red;'>{$_GET['keyword']}</span>",$data_content['title']);
                    $query = "select reply_time from ibbs_reply where content_id={$data_content['id']} order by id desc limit 1";
                    $result_last_reply = execute($conn, $query);
                    if(mysqli_num_rows($result_last_reply) == 0) {
                        $last_time = '暂无回复';
                    } else {
                        $data_last_reply = mysqli_fetch_assoc($result_last_reply);
                        $last_time = $data_last_reply['reply_time'];
                    }
                    $query = "select count(*) from ibbs_reply where content_id={$data_content['id']}";
                    ?>
                    <li>
                        <div class="smallPic">
                            <a target="_blank" href="member.php?id=<?php echo $data_content['member_id']?>">
                                <img width="45" height="45"src="<?php if($data_content['photo']!=''){echo SUB_URL.$data_content['photo'];} else {echo 'css/photo.jpg';}?>">
                            </a>
                        </div>
                        <div class="subject">
                            <div class="titleWrap"><h2><a target="_blank" href="show_detail.php?id=<?php echo $data_content['id']?>"><?php echo $data_content['title_color']?></a></h2></div>
                            <p>
                                楼主：<?php echo $data_content['username']?>&nbsp;<?php echo $data_content['publish_time']?>&nbsp;&nbsp;&nbsp;&nbsp;最后回复：<?php echo $last_time?><br />
                                <?php
                                if(check_user($member_id,$data_content['member_id'],$is_manage_login)){
                                    $return_url = urlencode($_SERVER['REQUEST_URI']);
                                    $url = urlencode("content_delete.php?id={$data_content['id']}&return_url={$return_url}");
                                    $message = "你真的要删除帖子 {$data_content['title']} 吗？";
                                    $delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";
                                    echo "<a href='content_update.php?id={$data_content['id']}&return_url={$return_url}'>编辑</a> <a href='{$delete_url}'>删除</a>";
                                }
                                ?>
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
                <div style="clear:both;"></div>
            </div>
        </div>
        <div id="right">
            <div class="classList">
                <div class="title">版块列表</div>
                <ul class="listWrap">
                    <?php
                    $query = "select * from ibbs_father_module";
                    $result_f = execute($conn, $query);
                    while ($data_f = mysqli_fetch_assoc($result_f)) {
                        ?>
                        <li>
                            <h2><a href="list_father.php?id=<?php echo $data_f['id']; ?>"><?php echo $data_f['module_name']; ?></a></h2>
                            <ul>
                                <?php
                                $query = "select * from ibbs_son_module where father_module_id={$data_f['id']}";
                                $result_s = execute($conn, $query);
                                while ($data_s = mysqli_fetch_assoc($result_s)) {
                                    ?>
                                    <li><a href="list_son.php?id=<?php echo $data_s['id'] ?>" style="color: #666;"><?php echo $data_s['module_name']; ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
<?php include 'inc/footer.inc.php'?>