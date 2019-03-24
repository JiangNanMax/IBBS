<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/24
 * Time: 12:31
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title'] = '修改子版块';
$template['css'] = array('css/index.css');
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    skip('son_module.php', 'error', 'id参数错误！');
}
$conn = connect();
$query = "select * from ibbs_son_module where id={$_GET['id']}";
$result = execute($conn, $query);
if (!mysqli_num_rows($result)) {
    skip('son_module.php', 'error', '该板块不存在！');
}
if (isset($_POST['submit'])) {
    $check_type = 'update';
    include 'inc/son_module_check.inc.php';
    $query = "update ibbs_son_module set father_module_id={$_POST['father_module_id']},module_name='{$_POST['module_name']}',info='{$_POST['info']}',member_id={$_POST['member_id']},sort={$_POST['sort']} where id={$_GET['id']}";
    //echo $query;
    //exit();
    $result = execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('son_module.php', 'ok', '修改成功！');
    }
    else {
        skip('son_module.php', 'error', '修改失败，请重试！');
    }
}
$data = mysqli_fetch_assoc($result);
?>
<?php include './inc/header.inc.php'?>
    <div id="main">
        <div class="title" style="margin-bottom:20px;">修改子版块 - <?php echo $data['module_name']; ?></div>
        <form method="post">
            <table class="au">
                <tr>
                    <td>所属父版块</td>
                    <td>
                        <select name="father_module_id">
                            <option value="0">------请选择一个父版块------</option>
                            <?php
                            $query = "select * from ibbs_father_module";
                            $result = execute($conn, $query);
                            while ($data_father_module = mysqli_fetch_assoc($result)) {
                                if ($data_father_module['id'] == $data['father_module_id']) {
                                    echo "<option selected='selected' value='{$data_father_module['id']}'>{$data_father_module['module_name']}</option>";
                                }
                                else {
                                    echo "<option value='{$data_father_module['id']}'>{$data_father_module['module_name']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td class="note">
                        必须选择一个所属的父版块
                    </td>
                </tr>
                <tr>
                    <td>版块名称</td>
                    <td><input name="module_name" type="text" value="<?php echo $data['module_name']; ?>" /></td>
                    <td class="note">
                        版块名称不得为空，且最长不得超过50个字符
                    </td>
                </tr>
                <tr>
                    <td>版块简介</td>
                    <td>
                        <textarea name="info"><?php echo $data['info']; ?></textarea>
                    </td>
                    <td class="note">
                        版块名称不得为空，且最长不得超过50个字符
                    </td>
                </tr>
                <tr>
                    <td>版主</td>
                    <td>
                        <select name="member_id">
                            <option value="0">------请选择一名用户------</option>
                            <?php
                            /*
                                $query = "select * from ibbs_father_module";
                                $result = execute($conn, $query);
                                while ($data = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$data['id']}'>{$data['module_name']}</option>";
                                }
                            */
                            ?>
                        </select>
                    </td>
                    <td class="note">
                        选择一名注册用户成为该子版块版主
                    </td>
                </tr>
                <tr>
                    <td>排序优先级</td>
                    <td><input name="sort" type="text" value="<?php echo $data['sort']; ?>" /></td>
                    <td class="note">
                        填写一个数字即可，越大则优先级越高
                    </td>
                </tr>
            </table>
            <input style="margin-left:110px;margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="修改" />
        </form>
    </div>
<?php include './inc/footer.inc.php'?>