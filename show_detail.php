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


?>
<?php include 'inc/header.inc.php' ?>
<div id="position" class="auto">
    <a href="">首页</a> &gt; <a href="">Java</a> &gt; <a href="">JDBC</a> &gt; 数据库连接
</div>

<div id="main" class="auto">
    <div class="contentWrap">
        <div class="left">
            <div class="head_img">
                <a href="">
                    <img src="css/head_img_1.png" alt="">
                </a>
            </div>
            <div class="name">
                <a href="">JiangNanMax</a>
            </div>
        </div>
        <div class="right">
            <div class="title">
                <h2>测试帖</h2>
                <span>阅读：339&nbsp;|&nbsp;回复：15</span>
            </div>
            <div class="pubdate">
                <span class="date">发布于：2019-03-18 22:17:34</span>
                <span class="floor_master">楼主</span>
            </div>
            <div class="content">
                数据库连接数据库连接数据库连接...
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
