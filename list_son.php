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

$conn = connect();
$member_id = is_login($conn);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('index.php', 'error' ,'子版块参数错误！');
}

$query = "select * from ibbs_son_module where id={$_GET['id']}";
$result_s = execute($conn, $query);
if (mysqli_num_rows($result_s) != 1) {
    skip('index.php', 'error', '子版块不存在！');
}
$data_s = mysqli_fetch_assoc($result_s);



?>
<?php include 'inc/header.inc.php' ?>
    <div id="position" class="auto">
        <a href="">首页</a> &gt; <a href="">Java</a> &gt; <a href="">JDBC</a>
    </div>
    <div id="main" class="auto">
        <div id="left">
            <div class="box_wrap">
                <h3>JDBC</h3>
                <div class="num">
                    今日：<span>8</span>&nbsp;&nbsp;&nbsp;
                    总帖：<span>1024</span>
                    <div class="moderator">版主：<span>JiangNanMax</span></div>
                    <div class="notice">通知通知通知......</div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <ul class="postList">
                <li>
                    <div class="smallPic">
                        <a href="">
                            <img width="45" height="45" src=css/2374101_small.jpg alt="">
                        </a>
                    </div>
                    <div class="subject">
                        <div class="titleWrap">
                            <a href="">[分类]</a>&nbsp;&nbsp;<a class="title" href="">数据库连接</a>
                        </div>
                        <p>
                            楼主：JiangNanMax&nbsp;2019-03-14&nbsp;&nbsp;&nbsp;&nbsp;最后回复：2019-03-14
                        </p>
                    </div>
                    <div class="count">
                        <p>
                            回复<br><span>66</span>
                        </p>
                        <p>
                            浏览<br><span>666</span>
                        </p>
                    </div>
                    <div style="clear:both;"></div>
                </li>
                <li>
                    <div class="smallPic">
                        <a href="">
                            <img width="45" height="45" src=css/2374101_small.jpg alt="">
                        </a>
                    </div>
                    <div class="subject">
                        <div class="titleWrap">
                            <a href="">[分类]</a>&nbsp;&nbsp;<a class="title" href="">数据库连接</a>
                        </div>
                        <p>
                            楼主：JiangNanMax&nbsp;2019-03-14&nbsp;&nbsp;&nbsp;&nbsp;最后回复：2019-03-14
                        </p>
                    </div>
                    <div class="count">
                        <p>
                            回复<br><span>66</span>
                        </p>
                        <p>
                            浏览<br><span>666</span>
                        </p>
                    </div>
                    <div style="clear:both;"></div>
                </li>
                <li>
                    <div class="smallPic">
                        <a href="">
                            <img width="45" height="45" src=css/2374101_small.jpg alt="">
                        </a>
                    </div>
                    <div class="subject">
                        <div class="titleWrap">
                            <a href="">[分类]</a>&nbsp;&nbsp;<a class="title" href="">数据库连接</a>
                        </div>
                        <p>
                            楼主：JiangNanMax&nbsp;2019-03-14&nbsp;&nbsp;&nbsp;&nbsp;最后回复：2019-03-14
                        </p>
                    </div>
                    <div class="count">
                        <p>
                            回复<br><span>66</span>
                        </p>
                        <p>
                            浏览<br><span>666</span>
                        </p>
                    </div>
                    <div style="clear:both;"></div>
                </li>
                <li>
                    <div class="smallPic">
                        <a href="">
                            <img width="45" height="45" src=css/2374101_small.jpg alt="">
                        </a>
                    </div>
                    <div class="subject">
                        <div class="titleWrap">
                            <a href="">[分类]</a>&nbsp;&nbsp;<a class="title" href="">数据库连接</a>
                        </div>
                        <p>
                            楼主：JiangNanMax&nbsp;2019-03-14&nbsp;&nbsp;&nbsp;&nbsp;最后回复：2019-03-14
                        </p>
                    </div>
                    <div class="count">
                        <p>
                            回复<br><span>66</span>
                        </p>
                        <p>
                            浏览<br><span>666</span>
                        </p>
                    </div>
                    <div style="clear:both;"></div>
                </li>
                <li>
                    <div class="smallPic">
                        <a href="">
                            <img width="45" height="45" src=css/2374101_small.jpg alt="">
                        </a>
                    </div>
                    <div class="subject">
                        <div class="titleWrap">
                            <a href="">[分类]</a>&nbsp;&nbsp;<a class="title" href="">数据库连接</a>
                        </div>
                        <p>
                            楼主：JiangNanMax&nbsp;2019-03-14&nbsp;&nbsp;&nbsp;&nbsp;最后回复：2019-03-14
                        </p>
                    </div>
                    <div class="count">
                        <p>
                            回复<br><span>66</span>
                        </p>
                        <p>
                            浏览<br><span>666</span>
                        </p>
                    </div>
                    <div style="clear:both;"></div>
                </li>
            </ul>
            <div class="pages_wrap">
                <a href="" class="btn publish">发帖</a>
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
            <div class="pages_wrap">

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
                                    <li><a href="#" style="color: #666;"><?php echo $data_s['module_name']; ?></a></li>
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
