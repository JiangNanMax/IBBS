<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/4/12
 * Time: 15:08
 */
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

        $current_url = $_SERVER['REQUEST_URI'];
        $arr_current_url = parse_url($current_url);
        $current_path = $arr_current_url['path'];
        $url = '';
        if (isset($arr_current_url['query'])) {
            parse_str($arr_current_url['query'], $arr_query);
            unset($arr_query[$page]);
            if (empty($arr_query)) {
                $url = "{$current_path}?{$page}=";
            }
            else {
                $other_query = http_build_query($arr_query);
                $url = "{$current_path}?{$other_query}&{$page}=";
            }
        }
        else {
            $url = "{$current_path}?{$page}=";
        }

        //echo '当前页：'.$_GET[$page].'<br />';
        $html = array();
        if ($num_btn >= $page_num_all) {
            for ($i = 1; $i <= $page_num_all; $i++) {
                if ($_GET[$page] == $i) {
                    $html[$i] = "<span>{$i}</span>";
                }
                else {
                    $html[$i] = "<a href='{$url}{$i}'>{$i}</a>";
                }
            }
        }
        else {
            $num_btn_left = floor(($num_btn - 1) / 2);
            $start = $_GET[$page] - $num_btn_left;
            $end = $start + $num_btn - 1;
            //echo '结束序号'.$end.'<br>';
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
                    $html[$start] = "<a href='{$url}{$start}'>{$start}</a>";
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
                    array_unshift($html, "<a href='{$url}1'>1..</a>");
                }
                if ($key_last != $page_num_all) {
                    array_pop($html);
                    array_push($html, "<a href='{$url}{$page_num_all}'>..{$page_num_all}</a>");
                }
            }
        }
        if ($_GET[$page] != 1) {
            $prev = $_GET[$page] - 1;
            array_unshift($html, "<a href='{$url}{$prev}'>« 上一页</a>");
        }
        if ($_GET[$page] != $page_num_all) {
            $next = $_GET[$page] + 1;
            array_push($html, "<a href='{$url}{$next}'>下一页 »</a>");
        }
        $html = implode(' ', $html);
        $data = array(
            'limit' => $limit,
            'html' => $html
        );
        return $data;
    }

    //$page = page(100, 10, 5);
    //echo $page['html'];
?>
