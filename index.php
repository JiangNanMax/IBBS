<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/25
 * Time: 20:21
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$template['title'] = 'IBBS';
$template['css'] = array('css/public.css', 'css/index.css');

$conn = connect();
$member_id = is_login($conn);
?>
<?php include 'inc/header.inc.php'; ?>

    <div id="hot" class="auto">
        <div class="title">本站介绍</div>
        <ul class="newlist">
            <li>&nbsp;&nbsp;&nbsp;&nbsp;本站定位为编程论坛网站，主要功能即在相应的主题模块下进行发帖、评论以及回复，进行与编程相关的交流讨论。其中，管理员们有权删除不符合社会主义核心价值观的内容。另外，本站还有动态页面和资源页面。动态页面会及时推送一些技术方面的最新动态，
                通过url链接进行内容跳转。而资源页面则提供免费的编程资源下载。So, Welcome! Enjoy!</li>
        </ul>
        <div style="clear:both;"></div>
    </div>

<?php
    $query = "select * from ibbs_father_module order by sort desc";
    $result_f = execute($conn, $query);
    while ($data_f = mysqli_fetch_assoc($result_f)) {
?>
        <div class="box auto">
            <div class="title">
                <a href="list_father.php?id=<?php echo $data_f['id']; ?>" style="color:#105cb6;"><?php echo $data_f['module_name']; ?></a>
            </div>
            <div class="classlist">
                <?php
                    $query = "select * from ibbs_son_module where father_module_id={$data_f['id']}";
                    $result_s = execute($conn, $query);
                    if (mysqli_num_rows($result_s)) {
                        while ($data_s = mysqli_fetch_assoc($result_s)) {
                            $query = "select count(*) from ibbs_content where module_id={$data_s['id']} and publish_time > CURDATE()";
                            $count_today = get_num($conn, $query);
                            $query = "select count(*) from ibbs_content where module_id={$data_s['id']}";
                            $count_all = get_num($conn, $query);
                            $son_id = $data_s['id'];
$html = <<<JN
                            <div class="childBox new">
                                <h2><a href="list_son.php?id={$son_id}">{$data_s['module_name']}</a><span>&nbsp;(今日{$count_today})</span></h2>
                                帖子：{$count_all}<br>
                            </div>              
JN;
                            echo $html;
                        }
                    }
                    else {
                        echo '<div style="padding:10px 0;">暂无子版块...</div>';
                    }
                ?>
                <div style="clear:both;"></div>
            </div>
        </div>
<?php
    }
?>
<?php include 'inc/footer.inc.php'; ?>