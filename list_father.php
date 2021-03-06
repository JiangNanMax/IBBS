<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/30
 * Time: 15:42
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';
$template['title'] = '父版块';
$template['css'] = array('css/public.css', 'css/list.css');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('index.php', 'error', '父版块参数错误！');
}

$conn = connect();
$member_id = is_login($conn);
$is_manage_login = is_manage_login($conn);

$query = "select * from ibbs_father_module where id={$_GET['id']}";
$result_f = execute($conn, $query);
if (mysqli_num_rows($result_f) == 0) {
    skip('index.php', 'error', '父版块不存在！');
}
$data_f = mysqli_fetch_assoc($result_f);

//这里会有异常发生，比如父版块下没有子版块的情况
$query = "select * from ibbs_son_module where father_module_id={$_GET['id']}";
$result_s = execute($conn, $query);
$id_s = '';
$list_s = '';

while ($data_s = mysqli_fetch_assoc($result_s)) {
    $id_s.=($data_s['id'].",");
    $list_s.="<a style=\"color: #333;cursor:pointer;\">{$data_s['module_name']}</a>&nbsp;&nbsp;";
}
$id_s = trim($id_s, ",");
if ($id_s == '') {
    $id_s = '-1';
}
//父版块下暂无子版块的情况，待处理

$query = "select count(*) from ibbs_content where module_id in ({$id_s})";
$count_all = get_num($conn, $query);

$query = "select count(*) from ibbs_content where module_id in ($id_s) and publish_time > CURDATE()";
$count_today = get_num($conn, $query);
?>

<?php include 'inc/header.inc.php' ?>
    <div id="position" class="auto">
        <a href="index.php">首页</a> &gt; <?php echo $data_f['module_name'] ?>
    </div>
    <div id="main" class="auto">
        <div id="left">
            <div class="box_wrap">
                <h3><?php echo $data_f['module_name'] ?></h3>
                <div class="num">
                    今日：<span><?php echo $count_today ?></span>&nbsp;&nbsp;&nbsp;
                    总帖：<span><?php echo $count_all ?></span>
                    <div class="moderator">子版块： <?php echo $list_s ?></div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <ul class="postList">
                <?php
                    $page = page($count_all, 5, 5);
                    $query = "select ibbs_content.title,ibbs_content.id,ibbs_content.module_id,ibbs_content.publish_time,ibbs_content.times,ibbs_content.member_id,ibbs_member.username,ibbs_member.photo,ibbs_son_module.module_name from ibbs_content join ibbs_member on ibbs_content.member_id=ibbs_member.id join ibbs_son_module on ibbs_content.module_id=ibbs_son_module.id where ibbs_content.module_id in ($id_s) order by publish_time desc {$page['limit']}";
                    $result = execute($conn, $query);
                    while ($data = mysqli_fetch_assoc($result)) {
                    $data['title'] = htmlspecialchars($data['title']);
                    $query="select reply_time from ibbs_reply where content_id={$data['id']} order by id desc limit 1";
                    $result_last_reply = execute($conn, $query);
                    if(mysqli_num_rows($result_last_reply) == 0){
                        $last_time = '暂无回复';
                    }else{
                        $data_last_reply = mysqli_fetch_assoc($result_last_reply);
                        $last_time = $data_last_reply['reply_time'];
                    }
                    $query = "select count(*) from ibbs_reply where content_id={$data['id']}";
                ?>
                    <li>
                        <div class="smallPic">
                            <a href="member.php?id=<?php echo $data['member_id'] ?>">
                                <img width="45" height="45" src="<?php if ($data['photo'] != '') {echo SUB_URL.$data['photo'];} else {echo 'css/photo.jpg';} ?>">
                            </a>
                        </div>
                        <div class="subject">
                            <div class="titleWrap">
                                <a href="list_son.php?id=<?php echo $data['module_id'] ?>">[<?php echo $data['module_name']; ?>]</a>&nbsp;&nbsp;<a class="title" href="show_detail.php?id=<?php echo $data['id'] ?>"><?php echo $data['title']; ?></a>
                            </div>
                            <p>
                                楼主：<?php echo $data['username']; ?>&nbsp;<?php echo $data['publish_time']; ?>&nbsp;&nbsp;&nbsp;&nbsp;最后回复：<?php echo $last_time ?>
                                <?php
                                if($is_manage_login) {
                                    $return_url = urlencode($_SERVER['REQUEST_URI']);
                                    $url = urlencode("content_delete.php?id={$data['id']}&return_url={$return_url}");
                                    $message = "你真的要删除帖子 {$data['title']} 吗？";
                                    $delete_url = "confirm.php?url={$url}&return_url={$return_url}&message={$message}";
                                    echo "<br />";
                                    echo "<a href='content_update.php?id={$data['id']}&return_url={$return_url}'>编辑</a> <a href='{$delete_url}'>删除</a>";
                                }
                                ?>
                            </p>
                        </div>
                        <div class="count">
                            <p>
                                回复<br><span><?php echo get_num($conn, $query) ?></span>
                            </p>
                            <p>
                                浏览<br><span><?php echo $data['times']; ?></span>
                            </p>
                        </div>
                        <div style="clear:both;"></div>
                    </li>
                <?php
                    }
                ?>
            </ul>
            <div class="pages_wrap">
                <a href="publish.php?father_module_id=<?php echo $_GET['id'] ?>" class="btn publish">发帖</a>
                <div class="pages">
                    <?php
                        echo $page['html'];
                    ?>
                </div>
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
<?php include 'inc/footer.inc.php' ?>