<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/4/27
 * Time: 16:28
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';
$template['title'] = '详情页';
$template['css'] = array('css/public.css', 'css/show.css');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('index.php', 'error', '参数错误！');
}

$conn = connect();
$member_id = is_login($conn);

$query = "select ic.id cid,ic.module_id,ic.title,ic.content,ic.time,ic.publish_time,ic.member_id,ic.times,im.username,im.photo from ibbs_content ic,ibbs_member im where ic.id={$_GET['id']} and ic.member_id=im.id";
$result_content = execute($conn, $query);
if (mysqli_num_rows($result_content) != 1) {
    skip('index.php', 'error', '该帖不存在！');
}
$data_content = mysqli_fetch_assoc($result_content);
$data_content['title'] = htmlspecialchars($data_content['title']);
$data_content['content'] = nl2br(htmlspecialchars($data_content['content']));

$query = "select * from ibbs_son_module where id={$data_content['module_id']}";
$result_son = execute($conn, $query);
$data_son = mysqli_fetch_assoc($result_son);

$query = "select * from ibbs_father_module where id={$data_son['father_module_id']}";
$result_father = execute($conn, $query);
$data_father = mysqli_fetch_assoc($result_father);

?>
<?php include 'inc/header.inc.php' ?>
<div id="position" class="auto">
    <a href="index.php">首页</a> &gt; <a href="list_father.php?id=<?php echo $data_father['id'] ?>"><?php echo $data_father['module_name'] ?></a> &gt; <a href="list_son.php?id=<?php echo $data_son['id'] ?>"><?php echo $data_son['module_name'] ?></a> &gt; <?php echo $data_content['title'] ?>
</div>

<div id="main" class="auto">

    <div class="contentWrap">
        <div class="left">
            <div class="head_img">
                <a href="">
                    <img width=120 height=120 src="<?php if($data_content['photo'] != ''){echo $data_content['photo'];} else {echo 'css/photo.jpg';} ?>" alt="">
                </a>
            </div>
            <div class="name">
                <a href=""><?php echo $data_content['username'] ?></a>
            </div>
        </div>
        <div class="right">
            <div class="title">
                <h2><?php echo $data_content['title'] ?></h2>
                <span>阅读：<?php echo $data_content['times'] ?>&nbsp;|&nbsp;回复：15</span>
            </div>
            <div class="pubdate">
                <span class="date">发布于：<?php echo $data_content['publish_time'] ?></span>
                <span class="floor_master">楼主</span>
            </div>
            <div class="content">
                <?php echo $data_content['content'] ?>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="contentWrap">
        <div class="left">
            <div class="head_img">
                <a href="">
                    <img src="css/head_img_2.png" alt="">
                </a>
            </div>
            <div class="name">
                <a href="">JiangNanMax</a>
            </div>
        </div>
        <div class="right">
            <div class="pubdate">
                <span class="date">回复时间：2019-03-18 22:24:26</span>
                <span class="floor">1楼&nbsp;|&nbsp;<a href="#">引用</a></span>
            </div>
            <div class="content">嗯嗯嗯嗯嗯嗯嗯...</div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="contentWrap">
        <div class="left">
            <div class="head_img">
                <a href="">
                    <img src="css/head_img_3.png" alt="">
                </a>
            </div>
            <div class="name">
                <a href="">JiangNanMax</a>
            </div>
        </div>
        <div class="right">
            <div class="pubdate">
                <span class="date">回复时间：2019-03-18 22:28:46</span>
                <span class="floor">2楼&nbsp;|&nbsp;<a href="#">引用</a></span>
            </div>
            <div class="content">噢噢噢噢噢噢噢噢噢...</div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="contentWrap">
        <div class="left">
            <div class="head_img">
                <a href="">
                    <img src="css/head_img_4.png" alt="">
                </a>
            </div>
            <div class="name">
                <a href="">JiangNanMax</a>
            </div>
        </div>
        <div class="right">
            <div class="pubdate">
                <span class="date">回复时间：2019-03-19 10:28:46</span>
                <span class="floor">3楼&nbsp;|&nbsp;<a href="">引用</a></span>
            </div>
            <div class="content">
                <div class="quote">
                    <h2>引用 1楼 JiangNanMax 发表的: </h2>
                    嗯嗯嗯嗯嗯嗯嗯...
                </div>
                啦啦啦啦啦啦...
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>


    <a id="talk" href="" class="btn publish">发帖</a>
    <div class="pages_wrap_show">
        <div class="pages">
            <a>« 上一页</a>
            <a>1</a>
            <span>2</span>
            <a>3</a>
            <a>4</a>
            <a>...8</a>
            <a>下一页 »</a>
        </div>
    </div>
</div>
<?php include 'inc/footer.inc.php' ?>
