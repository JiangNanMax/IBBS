<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/4/9
 * Time: 10:51
 */
    header("Content-type:text/html;charset=utf-8");
    function page($count, $page_size, $num_btn=10, $page='page') {
        if (!isset($_GET[$page]) || !is_numeric($_GET[$page]) || $_GET[$page] < 1) {
            $_GET[$page] = 1;
        }
        $page_num_all = ceil($count / $page_size);
        if ($page_num_all < $_GET[$page]) {
            $_GET[$page] = $page_num_all;
        }

        $start = ($_GET[$page] - 1) * $page_size;
        $limit = "limit {$start},{$page_size}";
        echo '当前页：'.$_GET[$page].'<br />';
        $html = array();
        if ($num_btn >= $page_num_all) {
            for ($i = 1; $i <= $page_num_all; $i++) {
                if ($_GET[$page] == $i) {
                    $html[$i] = "<span>{$i}</span>";
                }
                else {
                    $html[$i] = "<a href='test.php?page={$i}'>{$i}</a>";
                }
            }
        }
        else {
            $num_btn_left = floor(($num_btn - 1) / 2);
            $start = $_GET[$page] - $num_btn_left;
            $end = $start + $num_btn - 1;
            echo '结束序号'.$end.'<br>';
            if ($start < 1) {
                $start = 1;
            }
            if ($end > $page_num_all) {
                $start = $page_num_all - ($num_btn - 1);
            }
            for ($i = 0; $i < $num_btn; $i++) {
                if ($_GET[$page] == $start) {
                    $html[$start] = "<span>{$start}</span>";
                }
                else {
                    $html[$start] = "<a href='test.php?page={$start}'>{$start}</a>";
                }
                $start++;
            }
            if (count($html) >= 3) {
                reset($html);
                $key_first = key($html);
                end($html);
                $key_last = key($html);
                if ($key_first != 1) {
                    array_shift($html);
                    array_unshift($html, "<a href='test.php?page=1'>1..</a>");
                }
                if ($key_last != $page_num_all) {
                    array_pop($html);
                    array_push($html, "<a href='test.php?page={$page_num_all}'>..{$page_num_all}</a>");
                }
            }
        }
        if ($_GET[$page] != 1) {
            $prev = $_GET[$page] - 1;
            array_unshift($html, "<a href='test.php?page={$prev}'>« 上一页</a>");
        }
        if ($_GET[$page] != $page_num_all) {
            $next = $_GET[$page] + 1;
            array_push($html, "<a href='test.php?page={$next}'>下一页 »</a>");
        }
        $html = implode(' ', $html);
        $data = array(
            'limit' => $limit,
            'html' => $html
        );
        return $data;
    }

    $page = page(100, 10, 5);
    echo $page['html'];
?>
