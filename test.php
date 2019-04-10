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
        $html = '';
        if ($num_btn >= $page_num_all) {
            for ($i = 1; $i <= $page_num_all; $i++) {
                if ($_GET[$page] == $i) {
                    $html .= "<span>{$i}</span> ";
                }
                else {
                    $html .= "<a href='test.php?page={$i}'>{$i}</a> ";
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
                    $html .= "<span>{$start}</span> ";
                }
                else {
                    $html .= "<a href='test.php?page={$start}'>{$start}</a> ";
                }
                $start++;
            }
        }

        $data = array(
            'limit' => $limit,
            'html' => $html
        );
        return $data;
    }

    $page = page(100, 10, 5);
    //var_dump(page(100, 10, 11));
    echo $page['html'];
?>
