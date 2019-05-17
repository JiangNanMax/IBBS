<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/23
 * Time: 13:58
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title'] = '添加子版块';
$template['css'] = array('css/index.css');

$conn = connect();
if (isset($_POST['submit'])) {
    //验证
    $check_type = 'add';
    include 'inc/son_module_check.inc.php';
    $query = "insert into ibbs_son_module(father_module_id,module_name,info,member_id,sort) values({$_POST['father_module_id']},'{$_POST['module_name']}','{$_POST['info']}',{$_POST['member_id']},{$_POST['sort']})";
    execute($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        skip('son_module.php', 'ok', '子版块添加成功！');
    }
    else {
        skip('son_module_add.php', 'error', '子版块添加失败，请重试！');
    }
}
?>
<?php include 'inc/header.inc.php' ?>
<div id="main">
    <div class="title" style="margin-bottom:20px;">添加父版块</div>
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
                            while ($data = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$data['id']}'>{$data['module_name']}</option>";
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
                <td><input name="module_name" type="text" /></td>
                <td class="note">
                    版块名称不得为空，且最长不得超过50个字符
                </td>
            </tr>
            <tr>
                <td>版块简介</td>
                <td>
                    <textarea name="info"></textarea>
                </td>
                <td class="note">
                    建议添加版块简介，优化用户体验
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
                <td><input name="sort" type="text" /></td>
                <td class="note">
                    填写一个数字即可，越大则优先级越高
                </td>
            </tr>
        </table>
        <input style="margin-left:110px;margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="添加" />
    </form>
</div>
<?php include 'inc/footer.inc.php' ?>