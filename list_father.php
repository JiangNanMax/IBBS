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

$template['title'] = '父版块';
$template['css'] = array('css/public.css', 'css/list.css');

//连接DB
$conn = connect();
$member_id = is_login($conn);

//参数验证
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('index.php', 'error', '父版块参数错误！');
}

//拉取父版块信息
$query = "select * from ibbs_father_module where id={$_GET['id']}";
$result_f = execute($conn, $query);
if (mysqli_num_rows($result_f) == 0) {
    skip('index.php', 'error', '父版块不存在！');
}
$data_f = mysqli_fetch_assoc($result_f);

//拉取子版块信息
$query = "select * from ibbs_son_module where father_module_id={$_GET['id']}";
$result_s = execute($conn, $query);
$id_s = '';
$list_s = '';
//解析出需要用到的数据
while ($data_s = mysqli_fetch_assoc($result_s)) {
    $id_s.=($data_s['id'].",");
    $list_s.="<a style=\"color: #333;cursor:pointer;\">{$data_s['module_name']}</a>&nbsp;&nbsp;";
}
$id_s = trim($id_s, ",");

//两个计数
$query = "select count(*) from ibbs_content where module_id in ({$id_s})";
$count_all = get_num($conn, $query);

$query = "select count(*) from ibbs_content where module_id in ($id_s) and publish_time > CURDATE()";
$count_today = get_num($conn, $query);
?>

<?php include 'inc/header.inc.php' ?>
    <div id="position" class="auto">
        <a href="index.php">首页</a> &gt; <a href="list_father.php?id=<?php echo $data_f['id'] ?>"><?php echo $data_f['module_name'] ?></a>
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
                    $query = "select * from ibbs_content where id in ({$id_s})";
                    $result = execute($conn, $query);
                    while ($data = mysqli_fetch_assoc($result)) {

                    }
                ?>
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
        </div>

        <div id="right">
            <div class="classList">
                <div class="title">版块列表</div>
                <ul class="listWrap">
                    <li>
                        <h2><a href="">Java</a></h2>
                        <ul>
                            <li><a href="" style="color: #666;">JDBC</a></li>
                            <li><a href="" style="color: #666;">JSP</a></li>
                            <li><a href="" style="color: #666;">JVM</a></li>
                            <li><a href="" style="color: #666;">JDBC</a></li>
                            <li><a href="" style="color: #666;">JSP</a></li>
                            <li><a href="" style="color: #666;">JVM</a></li>
                        </ul>
                    </li>
                    <li>
                        <h2><a href="">Python</a></h2>
                    </li>
                </ul>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
<?php include 'inc/footer.inc.php' ?>