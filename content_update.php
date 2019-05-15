<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/15
 * Time: 16:48
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$template['title']='编辑';
$template['css']=array('css/public.css','css/publish.css');

$conn = connect();
if(!$member_id = is_login($conn)){
    skip('login.php', 'error', '请先登录!');
}
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('index.php', 'error', '参数错误!');
}
$query = "select * from ibbs_content where id={$_GET['id']}";
$result_content = execute($conn, $query);
if(mysqli_num_rows($result_content) == 1){
    $data_content = mysqli_fetch_assoc($result_content);
    $data_content['title'] = htmlspecialchars($data_content['title']);
    if(check_user($member_id, $data_content['member_id'])) {
        if(isset($_POST['submit'])) {
            include 'inc/publish_check.php';
            $_POST = escape($conn, $_POST);
            $query = "update ibbs_content set module_id={$_POST['module_id']},title='{$_POST['title']}',content='{$_POST['content']}' where id={$_GET['id']}";
            execute($conn, $query);
            if(mysqli_affected_rows($conn) == 1){
                skip("member.php?id={$member_id}", 'ok', '修改成功！');
            }else{
                skip("member.php?id={$member_id}", 'error', '修改失败，请重试！');
            }
        }
    }else{
        skip('index.php', 'error', '这个帖子不属于你，你没有权限!');
    }
}else{
    skip('index.php', 'error', '帖子不存在!');
}

?>
<?php include 'inc/header.inc.php'; ?>
    <div id="position" class="auto">
        <a href="index.php">首页</a> &gt; 编辑
    </div>
    <div id="publish" class="auto">
        <form method="post">
            <select name="module_id">
                <option value='-1'>请选择一个子版块</option>
                <?php
                $query="select * from ibbs_father_module order by sort desc";
                $result_father = execute($conn, $query);
                while ($data_father=mysqli_fetch_assoc($result_father)){
                    echo "<optgroup label='{$data_father['module_name']}'>";
                    $query="select * from sfk_son_module where father_module_id={$data_father['id']} order by sort desc";
                    $result_son=execute($conn, $query);
                    while ($data_son = mysqli_fetch_assoc($result_son)){
                        if($data_son['id'] == $data_content['module_id']){
                            echo "<option selected='selected' value='{$data_son['id']}'>{$data_son['module_name']}</option>";
                        }else{
                            echo "<option value='{$data_son['id']}'>{$data_son['module_name']}</option>";
                        }
                    }
                    echo "</optgroup>";
                }
                ?>
            </select>
            <input class="title" placeholder="请输入标题" value="<?php echo $data_content['title']?>" name="title" type="text" />
            <textarea name="content" class="content"><?php echo $data_content['content']?></textarea>
            <input class="publish" type="submit" name="submit" value="发布" />
            <div style="clear:both;"></div>
        </form>
    </div>
<?php include 'inc/footer.inc.php'; ?>