<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/5/15
 * Time: 22:32
 */
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';

$template['title'] = '资源';
$template['css'] = array('css/public.css', 'css/show.css', './style.css', './icon.css');

$conn = connect();
$member_id = is_login($conn);
?>
<?php include 'inc/header.inc.php' ?>

    <div id="main" class="auto">
        <div class="contentWrap">
            <div class="left">
                <div class="head_img">
                    <a href="">
                        <img width=120 height=170 src="css/thinking_in_java.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="right">
                <div class="pubdate">
                    <span class="date" style="font-size:16px;">《Java编程思想》</span>
                    <span class="floor"><a href="#">立即下载</a></span>
                </div>
                <div class="content">本书共22章，包括操作符、控制执行流程、访问权限控制、复用类、多态、接口、通过异常处理错误、字符串、泛型、数组、容器深入研究、JavaI/O系统、枚举类型、并发以及图形化用户界面等内容。这些丰富的内容，包含了Java语言基础语法以及高级特性，适合各个层次的Java程序员阅读，同时也是高等院校讲授面向对象程序设计语言以及Java语言的绝佳教材和参考书</div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="contentWrap">
            <div class="left">
                <div class="head_img">
                    <a href="">
                        <img width=120 height=170 src="css/thinking_in_java.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="right">
                <div class="pubdate">
                    <span class="date" style="font-size:16px;">《Java编程思想》</span>
                    <span class="floor"><a href="#">立即下载</a></span>
                </div>
                <div class="content">本书共22章，包括操作符、控制执行流程、访问权限控制、复用类、多态、接口、通过异常处理错误、字符串、泛型、数组、容器深入研究、JavaI/O系统、枚举类型、并发以及图形化用户界面等内容。这些丰富的内容，包含了Java语言基础语法以及高级特性，适合各个层次的Java程序员阅读，同时也是高等院校讲授面向对象程序设计语言以及Java语言的绝佳教材和参考书</div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="contentWrap">
            <div class="left">
                <div class="head_img">
                    <a href="">
                        <img width=120 height=170 src="css/thinking_in_java.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="right">
                <div class="pubdate">
                    <span class="date" style="font-size:16px;">《Java编程思想》</span>
                    <span class="floor"><a href="#">立即下载</a></span>
                </div>
                <div class="content">本书共22章，包括操作符、控制执行流程、访问权限控制、复用类、多态、接口、通过异常处理错误、字符串、泛型、数组、容器深入研究、JavaI/O系统、枚举类型、并发以及图形化用户界面等内容。这些丰富的内容，包含了Java语言基础语法以及高级特性，适合各个层次的Java程序员阅读，同时也是高等院校讲授面向对象程序设计语言以及Java语言的绝佳教材和参考书</div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="contentWrap">
            <div class="left">
                <div class="head_img">
                    <a href="">
                        <img width=120 height=170 src="css/thinking_in_java.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="right">
                <div class="pubdate">
                    <span class="date" style="font-size:16px;">《Java编程思想》</span>
                    <span class="floor"><a href="#">立即下载</a></span>
                </div>
                <div class="content">本书共22章，包括操作符、控制执行流程、访问权限控制、复用类、多态、接口、通过异常处理错误、字符串、泛型、数组、容器深入研究、JavaI/O系统、枚举类型、并发以及图形化用户界面等内容。这些丰富的内容，包含了Java语言基础语法以及高级特性，适合各个层次的Java程序员阅读，同时也是高等院校讲授面向对象程序设计语言以及Java语言的绝佳教材和参考书</div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="contentWrap">
            <div class="left">
                <div class="head_img">
                    <a href="">
                        <img width=120 height=170 src="css/thinking_in_java.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="right">
                <div class="pubdate">
                    <span class="date" style="font-size:16px;">《Java编程思想》</span>
                    <span class="floor"><a href="#">立即下载</a></span>
                </div>
                <div class="content">本书共22章，包括操作符、控制执行流程、访问权限控制、复用类、多态、接口、通过异常处理错误、字符串、泛型、数组、容器深入研究、JavaI/O系统、枚举类型、并发以及图形化用户界面等内容。这些丰富的内容，包含了Java语言基础语法以及高级特性，适合各个层次的Java程序员阅读，同时也是高等院校讲授面向对象程序设计语言以及Java语言的绝佳教材和参考书</div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="pages_wrap_show">
            <div class="pages">
                <a>« 上一页</a>
                <a>1</a>
                <span>2</span>
                <a>3</a>
                <a>4</a>
                <a>...8</a>
                <a>下一页 »</a>
            </div>
        </div>
    </div>

<?php include 'inc/footer.inc.php' ?>

