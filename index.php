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
        <div class="title">热门动态</div>
        <ul class="newlist">
            <li><a href="#">IBBS</a><a href="#">网站持续建设中...</a></li>
        </ul>
        <!-- 清除左右漂浮 -->
        <div style="clear:both;"></div>
    </div>

<?php
    $query = "select * from ibbs_father_module order by sort desc";
    $result_f = execute($conn, $query);
    while ($data_f = mysqli_fetch_assoc($result_f)) {
?>
        <div class="box auto">
            <div class="title"><?php echo $data_f['module_name']; ?></div>
            <div class="classlist">
                <?php
                    $query = "select * from ibbs_son_module where father_module_id={$data_f['id']}";
                    $result_s = execute($conn, $query);
                    if (mysqli_num_rows($result_s)) {
                        while ($data_s = mysqli_fetch_assoc($result_s)) {
                            $query = "select count(*) from ibbs_content where module_id={$data_s['id']} and time > CURDATE()";
                            $count_today = execute($conn, $query);
                            $query = "select count(*) from ibbs_content where module_id={$data_s['id']}";
                            $count_all = execute($conn, $query);
$html = <<<JN
                            <div class="childBox new">
                                <h2><a href="#">{$data_s['module_name']}</a><span>&nbsp;(今日{$count_today}})</span></h2>
                                帖子：{$count_all}<br>
                            </div>              
JN;

                        }
                    }
                    else {
                        echo '<div style="padding:10px 0;">暂无子版块...</div>';
                    }
                ?>
            </div>
        </div>
<?php
    }
?>
<?php include 'inc/footer.inc.php'; ?>