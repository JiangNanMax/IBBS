<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/15
 * Time: 22:32
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';

$template['title'] = '资源';
$template['css'] = array('css/public.css', 'css/show.css', './style.css', './icon.css');

$conn = connect();
$member_id = is_login($conn);

?>
<?php include 'inc/header.inc.php' ?>

    <div id="main" class="auto">

        <?php
        $query = "select count(*) from ibbs_resource";
        $count_reply = get_num($conn, $query);
        $page_size = 5;
        $page = page($count_reply, $page_size, 5);

        $query = "select * from ibbs_resource {$page['limit']}";
        $result_resource = execute($conn, $query);
        while ($data_resource = mysqli_fetch_assoc($result_resource)) {
        $data_resource['title'] = nl2br(htmlspecialchars($data_resource['title']));
        $data_resource['introduction'] = nl2br(htmlspecialchars($data_resource['introduction']));
        $pic_path = substr($data_resource['photo'],1);
        $book_path = substr($data_resource['url'],1);
        ?>

            <div class="contentWrap">
                <div class="left">
                    <div class="head_img">
                        <img width=120 height=170 src="<?php echo $pic_path ?>" alt="">
                    </div>
                </div>
                <div class="right">
                    <div class="pubdate">
                        <span class="date" style="font-size:16px;">《<?php echo $data_resource['title'] ?>》</span>
                        <span class="floor"><a href="<?php echo $book_path ?>" download="<?php echo($data_resource['title'].'pdf') ?>">立即下载</a></span>
                    </div>
                    <div class="content"><?php echo $data_resource['introduction'] ?></div>
                </div>
                <div style="clear: both;"></div>
            </div>

        <?php
        }
        ?>

        <div class="pages_wrap_show">
            <div class="pages">
                <?php
                echo $page['html'];
                ?>
            </div>
        </div>
    </div>

<?php include 'inc/footer.inc.php' ?>