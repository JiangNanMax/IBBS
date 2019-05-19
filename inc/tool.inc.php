<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/20
 * Time: 08:25
 */
?>
<?php
    function skip($url, $pic, $message) {
$html = <<<JN
        <!DOCTYPE html>
        <html lang="zh-CN">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="refresh" content="3;URL={$url}">
                <title>正在跳转...</title>
                <link rel="shortcut icon" href="css/bbs32.png">
                <link rel="stylesheet" type="text/css" href="css/warn.css">
            </head>
            <body>
                <div class="warn"><span class="pic {$pic}"></span>&nbsp;{$message} <a href="{$url}"><span id="second">3</span>秒后自动跳转!</a></div>
                <script type="text/javascript">
                    function clock() {
                        var span = document.getElementById('second');
                        var num = span.innerHTML;
                        if(num != 0) {
                            num--;
                            span.innerHTML = num;
                        }
                    };
                    setInterval("clock()", 1000);
                </script>
            </body>
        </html>
JN;
        echo $html;
        exit();
    }

    //cookie设置失败？？？原因待查
    //本地浏览器的cookie设置成功了啊，问题在哪？？？
    //问题已解决，原因在于密码字段长度设置过短
    function is_login($conn) {
        //return true;
        if (isset($_COOKIE['username'])) {
            $query = "select * from ibbs_member where username='{$_COOKIE['username']}'";
            $result = execute($conn, $query);
            if (mysqli_num_rows($result) == 1) {
                $data=mysqli_fetch_assoc($result);
                return $data['id'];
                //Cannot use object of type mysqli_result as array in C:\website\data\web\webroot\IBBS\inc\tool.inc.php on line 39
                //return $result['id'];
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    function check_user($member_id, $content_member_id, $is_manage_login){
        if($member_id==$content_member_id || $is_manage_login){
            return true;
        } else {
            return false;
        }
    }

    //验证后台管理员是否登录
    function is_manage_login($conn) {
        if(isset($_SESSION['manage']['name']) && isset($_SESSION['manage']['pw'])){
            $query = "select * from ibbs_manage where name='{$_SESSION['manage']['name']}' and sha1(pw)='{$_SESSION['manage']['pw']}'";
            $result = execute($conn,$query);
            if(mysqli_num_rows($result) == 1){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
?>