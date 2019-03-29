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

<!--

$query="select count(*) from sfk_content where module_id={$data_son['id']} and time > CURDATE()";
				$count_today=num($link,$query);
				$query="select count(*) from sfk_content where module_id={$data_son['id']}";
				$count_all=num($link,$query);
				$html=<<<A
					<div class="childBox new">
						<h2><a href="#">{$data_son['module_name']}</a> <span>(今日{$count_today})</span></h2>
						帖子：{$count_all}<br />
					</div>
A;
				echo $html;
-->

    <div class="box auto">
        <div class="title">MySQL</div>
        <div class="classlist">
            <div style="padding:10px 0;">暂无子版块...</div>
        </div>
    </div>
    <div class="box auto">
        <div class="title">其他</div>
        <div class="classlist">
            <div class="childBox new">
                <h2><a href="#">Java</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox old">
                <h2><a href="#">Python</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox lock">
                <h2><a href="#">JavaScript</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox new">
                <h2><a href="#">C++</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox new">
                <h2><a href="#">Java</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox old">
                <h2><a href="#">Python</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox lock">
                <h2><a href="#">JavaScript</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox new">
                <h2><a href="#">C++</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>
            <div class="childBox new">
                <h2><a href="#">Java</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox old">
                <h2><a href="#">Python</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox lock">
                <h2><a href="#">JavaScript</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox new">
                <h2><a href="#">C++</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>
            <div class="childBox new">
                <h2><a href="#">Java</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox old">
                <h2><a href="#">Python</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox lock">
                <h2><a href="#">JavaScript</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox new">
                <h2><a href="#">C++</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>
            <div class="childBox new">
                <h2><a href="#">Java</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox old">
                <h2><a href="#">Python</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox lock">
                <h2><a href="#">JavaScript</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <div class="childBox new">
                <h2><a href="#">C++</a><span>&nbsp;(今日66)</span></h2>
                帖子：1997<br>
            </div>

            <!-- 注意清除浮动! -->
            <div style="clear:both;"></div>
        </div>
    </div>
<?php include 'inc/footer.inc.php'; ?>