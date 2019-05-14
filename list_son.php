<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/4/14
 * Time: 23:22
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';
$template['title'] = '子版块';
$template['css'] = array('css/public.css', 'css/list.css');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('index.php', 'error' ,'子版块参数错误！');
}

$conn = connect();
$member_id = is_login($conn);

$query = "select * from ibbs_son_module where id={$_GET['id']}";
$result_s = execute($conn, $query);
if (mysqli_num_rows($result_s) != 1) {
    skip('index.php', 'error', '子版块不存在！');
}
$data_s = mysqli_fetch_assoc($result_s);

$query = "select * from ibbs_father_module where id={$data_s['father_module_id']}";
$result_f = execute($conn, $query);
$data_f = mysqli_fetch_assoc($result_f);

$query = "select count(*) from ibbs_content where module_id={$_GET['id']}";
$count_all = get_num($conn, $query);

$query = "select count(*) from ibbs_content where module_id={$_GET['id']} and publish_time>CURDATE()";
$count_today = get_num($conn, $query);

$query = "select * from ibbs_member where id={$data_s['member_id']}";
$result_m = execute($conn, $query);
?>
<?php include 'inc/header.inc.php' ?>
    <div id="position" class="auto">
        <a href="index.php">首页</a> &gt; <a href="list_father.php?id=<?php echo $data_f['id'] ?>"><?php echo $data_f['module_name'] ?></a> &gt; <?php echo $data_s['module_name'] ?>
    </div>
    <div id="main" class="auto">
        <div id="left">
            <div class="box_wrap">
                <h3><?php echo $data_s['module_name'] ?></h3>
                <div class="num">
                    今日：<span><?php echo $count_today ?></span>&nbsp;&nbsp;&nbsp;
                    总帖：<span><?php echo $count_all ?></span>
                    <div class="moderator">版主：
                        <span>
                            <?php
                                if (mysqli_num_rows($result_m) == 0) {
                                    echo "暂无版主";
                                } else {
                                    $data_m = mysqli_fetch_assoc($result_m);
                                    echo $data_m['username'];
                                }
                            ?>
                        </span>
                    </div>
                    <div class="notice"><?php echo $data_s['info'] ?></div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <ul class="postList">
                <?php
                    $page = page($count_all, 1, 5);

                    $query = "select ibbs_content.title,ibbs_content.id,ibbs_content.publish_time,ibbs_content.times,ibbs_member.username,ibbs_member.photo from ibbs_content join ibbs_member on ibbs_content.member_id=ibbs_member.id where ibbs_content.module_id={$_GET['id']} {$page['limit']}";
                    $result = execute($conn, $query);
                    while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <li>
                        <div class="smallPic">
                            <a href="">
                                <img width="45" height="45" src="<?php if ($data['photo'] != '') {echo $data['photo'];} else {echo 'css/photo.jpg';} ?>" alt="">
                            </a>
                        </div>
                        <div class="subject">
                            <div class="titleWrap">
                                <a class="title" href="show_detail.php?id=<?php $data['id'] ?>"><?php echo $data['title'] ?></a>
                            </div>
                            <p>
                                楼主：<?php echo $data['username'] ?>&nbsp;<?php echo $data['publish_time'] ?>&nbsp;&nbsp;&nbsp;&nbsp;最后回复：2019-03-14
                            </p>
                        </div>
                        <div class="count">
                            <p>
                                回复<br><span>66</span>
                            </p>
                            <p>
                                浏览<br><span><?php echo $data['times'] ?></span>
                            </p>
                        </div>
                        <div style="clear:both;"></div>
                    </li>
                <?php
                    }
                ?>
            </ul>
            <div class="pages_wrap">
                <a href="publish.php?father_module_id=<?php echo $data_f['id'] ?>&son_module_id=<?php echo $_GET['id'] ?>" class="btn publish">发帖</a>
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
