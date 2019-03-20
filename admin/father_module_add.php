<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/20
 * Time: 15:57
 */
$template['title'] = '添加父版块';
$template['css'] = array('css/index.css');
?>
<?php include 'inc/header.inc.php' ?>
<div id="main">
    <div class="title" style="margin-bottom:20px;">添加父版块</div>
    <form method="post">
        <table class="au">
            <tr>
                <td>版块名称</td>
                <td><input name="module_name" type="text" /></td>
                <td class="note">
                    版块名称不得为空，且最长不得超过50个字符
                </td>
            </tr>
            <tr>
                <td>排序优先级</td>
                <td><input name="sort" type="text" /></td>
                <td class="note">
                    填写一个数字即可
                </td>
            </tr>
        </table>
        <input style="margin-left:110px;margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="添加" />
    </form>
</div>
<?php include 'inc/footer.inc.php' ?>
