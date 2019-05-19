<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/14
 * Time: 22:19
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$template['title'] = '动态';
$template['css'] = array('css/public.css', 'css/show.css', './style.css', './icon.css');

$conn = connect();
$member_id = is_login($conn);
?>
<?php include 'inc/header.inc.php' ?>

<div class="section section-news" id="section-news">
    <div class="section-title">
        <h1>新鲜动态</h1>
        <h2>科技前沿、大咖直播、活动展会，24小时更新不停</h2>
    </div>
    <div class="section-wrapper">
        <div class="news-body">
            <div class="news-main">
                <a style="text-decoration: none;"  class="news-main-card" href="">
                    <div class="news-main-card-bg" style="background-image: url(./images/homepage-news-img.jpg)"></div>
                    <div class="news-main-card-bg news-main-card-bg-mb" style="background-image: url(statics/images/homepage-news-img-mb.jpg)"></div>
                    <div class="news-main-card-top">
                        <div class="news-play-btn">
                            <span class="cui-icon cui-icon-play"></span>
                        </div>
                    </div>
                    <div class="news-main-card-bottom">
                        <h2 class="h2">【直播】技术小白如何花2小时搭建一个精美网站</h2>
                        <p class="p">云速建站服务，无需代码，自由拖拽，并可提供PC 、手机 、微信网站 、小程序 、 APP五站合一的模板建站产品。</p>
                    </div>
                </a>
            </div>
            <div class="news-sub">

                <ul class="news-list-v show">
                    <?php
                    $query = "select * from ibbs_moment order by add_time desc limit 5";
                    $result = execute($conn, $query);
                    while($data = mysqli_fetch_assoc($result)) {
                    ?>
                        <li>
                            <a style="text-decoration: none;" href="<?php echo $data['url'] ?>" class="news-list-card">
                                <h3 class="h3"><?php echo $data['title'] ?></h3>
                                <p class="p"><?php echo $data['introduction'] ?></p>
                                <span class="more">查看详情</span>
                            </a>
                        </li>

                    <?php
                    }
                    ?>
                </ul>

                <ul class="news-list-v">

                    <?php
                    $query = "select * from ibbs_moment order by add_time desc limit 5 offset 5";
                    $result = execute($conn, $query);
                    while($data = mysqli_fetch_assoc($result)) {
                    ?>

                        <li>
                            <a style="text-decoration: none;" href="<?php echo $data['url'] ?>" class="news-list-card">
                                <h3 class="h3"><?php echo $data['title'] ?></h3>
                                <p class="p"><?php echo $data['introduction'] ?></p>
                                <span class="more">查看详情</span>
                            </a>
                        </li>

                    <?php
                    }
                    ?>

                </ul>

                <ul class="news-list-v">

                    <?php
                    $query = "select * from ibbs_moment order by add_time desc limit 5 offset 10";
                    $result = execute($conn, $query);
                    while($data = mysqli_fetch_assoc($result)) {
                    ?>

                        <li>
                            <a style="text-decoration: none;" href="<?php echo $data['url'] ?>" class="news-list-card">
                                <h3 class="h3"><?php echo $data['title'] ?></h3>
                                <p class="p"><?php echo $data['introduction'] ?></p>
                                <span class="more">查看详情</span>
                            </a>
                        </li>

                    <?php
                    }
                    ?>

                </ul>

            </div>
        </div>
    </div>
    <div class="section-bottom">
        <div class="section-more-wrap">
            <a class="news-more" href="#">
                <span>更多新鲜动态</span><i class="cui-icon cui-icon-more"></i>
            </a>
            <a class="news-change">
                <span>换一换</span>
            </a>
        </div>
    </div>
</div>


<script src="./jquery-1.11.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var $newsLists = $('.news-sub').find('.news-list-v');

    function changeNews() {
        var $currentNews = $newsLists.filter('.show');
        var $nextNews = $currentNews.next();

        if($nextNews.length === 0) {
            $nextNews = $newsLists.eq(0);
        }

        $newsLists.removeClass('show');
        $nextNews.addClass('show');
    }
    $('.news-change').on('click', function() {
        changeNews();
    });
</script>

<?php include 'inc/footer.inc.php' ?>

