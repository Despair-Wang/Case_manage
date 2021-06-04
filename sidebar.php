<?php

$hello_role =
    "var get_role = '{$_SESSION['role']}',user_role;
    if(get_role=='admin'){
        user_role = '管理者';
    }else if(get_role=='operator'){
        user_role = '幹員';
    }else{
        user_role = '會員';
    }
    $('#user_name').html(`<div id='user_image_sb'><img src='{$_SESSION['image']}'></div><h5>Hello！\${user_role} {$_SESSION['name']}<h5>`);";
set_init($hello_role);
?>
<!-- 側邊控制欄 -->
<div class="sidebar">
    <div id="user_name">
    </div>
    <ul>
        <li id="logout"><a href="logout.php">登出</a></li>
        <li id="my_info"><a href="user_info.php">我的資訊</a></li>
        <li id="calender"><a href="#">出勤管理</a></li>
        <li id="case"><a href="case_list.html">預約案件管理</a></li>
        <?php
$role = $_SESSION['role'];
if ($role == 'admin') {
    echo <<<admin
            <li id="user"><a href="user_list.php">使用者管理</a></li>
            <li id="service"><a href="#">服務項目管理</a></li>
            admin;
}
?>
        <li id="bonus"><a href="#">報酬管理</a></li>
        <span class="sb_btn">
            <ul>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </span>
    </ul>
</div>
<!-- 側邊控制欄 -->
<!-- 頂端標題 -->
<nav class="navbar navbar-dark pt-4">
    <h1 id="title" class="light_word mx-auto p-2 my-3">
    </h1>
</nav>
<!-- 頂端標題 -->
<?php
function set_h1($h1)
{
    set_init("$('#title').html('{$h1}');");
}