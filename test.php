<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/4/9
 * Time: 10:51
 */
?>
<?php
    header("Content-type:text/html;charset=utf-8");
    function page($count, $page_size, $page) {
        if (!isset($_GET[$page]) || !is_numeric($page) || $page < 1) {
            $_GET[$page] = 1;
        }
        $page_num_all = ceil($count / $page_size);
        if ($page_num_all < $_GET[$page]) {
            $_GET[$page] = $page_num_all;
        }

        $start = ($_GET[$page] - 1) * $page_size;
        $limit = "limit {$start},{$page_size}";
        $data = array(
            'limit' => $limit,
            'html' => 'html代码'
        );
        return $data;
    }
    var_dump(page(26, 5, 'page'));
?>
