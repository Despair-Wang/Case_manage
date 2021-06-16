<?php
require_once "db_cone.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
set_title("預約案件指派");
?>
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/moment.js"></script>
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/main.js"></script>
    <script>
    function sub_form(number) {
        let thisform = document.forms['cf'];
        thisform.call.value = number;
        thisform.submit();
    }
    </script>
</head>

<body>
    <?php
require_once "sidebar.php";
set_h1("CASE ASSIGN");
?>
    <!-- 主題內文 -->
    <div class="container">
        <div class="case_assign">
            <div class="row assign_title">
                <div class="col-12">
                    <h2>人員指派</h2>
                </div>
                <div class="col-12 col-md-4 offset-md-2">
                    <h4>案件名稱</h4>
                </div>
                <div class="col-12 col-md-4">
                    <h4>滾滾長江東逝水行 8hr</h4>
                </div>
                <div class="col-12 col-md-4 offset-md-2">
                    <h4>預約日期</h4>
                </div>
                <div class="col-12 col-md-4">
                    <h4>2021-05-10</h4>
                </div>
                <div class="col-12 col-md-4 offset-md-2">
                    <h4>開始時間</h4>
                </div>
                <div class="col-12 col-md-4">
                    <h4>08:00</h4>
                </div>
            </div>

            <form name="cf" id="cf" method="POST">
                <input type="hidden" name="call">
                <div class="row member_list">
                    <?php
$get_member = "select * from user where 1;";
$result_m = mysqli_query($con, $get_member);

while ($row = mysqli_fetch_assoc($result_m)) {
    echo <<<block
                    <!-- member_block -->
                    <div class="col-4 col-md-2">
                        <div class="members" onclick="sub_form('{$row['row_id']}')">
                            <img src="{$row['image']}" alt="" class="img-fluid" />
                            <div>
                                <h6>{$row['name']}</h6>
                            </div>
                        </div>
                    </div>
                    <!-- member_block -->
block;
}
?>
                </div>
            </form>
        </div>
    </div>
    <div class="member_info" id="member_info">
        <div class="container">
            <div class="info_window_border">
                <div class="info_window">
                    <a href="" class="close_btn close_b">&times;</a>
                    <div class="row">
                        <?php
if (isset($_POST['call'])) {
    $target = $_POST['call'];
    $get_member2 = "SELECT * FROM `user` WHERE `row_id` = {$target};";
    // echo $get_member2;
    $result_m2 = mysqli_query($con, $get_member2);
    while ($row2 = mysqli_fetch_assoc($result_m2)) {
        $img = $row2['image'];
        $name = $row2['name'];
        $car_type = $row2['car_type'];
        $identity = $row2['identity'];
        $remark = $row2['remark'];
        if ($row2['sex'] == "F") {
            $sex = "女";
        } else if ($row2['sex'] == "M") {
            $sex = "男";
        } else {
            $sex = "其他";
        }

        echo <<<m_info
                        <div class="col-12 col-md-3 col-lg-2 offset-lg-1 member_pic"><img id="pic" src="{$img}" alt=""
                                class="img-fluid" /></div>
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <h5>姓名</h5>
                                </div>
                                <div class="col-12">
                                    <h5>{$name}</h5>
                                </div>
                                <div class="col-12">
                                    <h5>性別</h5>
                                </div>
                                <div class="col-12">
                                    <h5>{$sex}</h5>
                                </div>
                                <div class="col-12">
                                    <h5>車種</h5>
                                </div>
                                <div class="col-12">
                                    <h5>{$car_type}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <h5>評價</h5>
                                </div>
                                <div class="col-12">
                                    <div class="assign_star"><span>★★★★★</span></div>
                                </div>
                                <div class="col-12">
                                    <h5>身分</h5>
                                </div>
                                <div class="col-12">
                                    <h5>{$identity}</h5>
                                </div>
                                <div class="col-12">
                                    <h5>備註</h5>
                                </div>
                                <div class="col-12">
                                    <h5>{$remark}</h5>
                                </div>
                            </div>
                        </div>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        var cata = document.getElementById('calendar');
                        var calendar = new FullCalendar.Calendar(cata, {
                            headerToolbar: {
                                left: 'prev',
                                center: 'title',
                                right: 'today next',
                            },
                            events: [{
                                title: '獅頭山半日遊',
                                start: '2021-05-25T08:00:00',
                                end: '2021-05-25T12:00:00'
                                        },
                                        {
                                            title: '滾滾長江東逝水行',
                                            start: '2021-05-24',
                                            allDay: true
                                        }],
                                    });
                                    calendar.render();
                                });
                                console.log('run!');
                                $('#member_info').addClass('open_win');
                                $('.info_window_border').addClass('info_open');
                                $('.info_window_border').removeClass('info_close');
                                $('body').addClass('open_win_back');
                                </script>
                        m_info;
    }
}
?>
                    </div>
                    <div id="calendar"></div>
                    <div class="row okcansel my-3">
                        <div class="col-6">
                            <a href="case_info.html" class="btn case_ctrl">
                                <h4>指派</h4>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn case_ctrl close_b">
                                <h4>取消</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <span>案件分配管理系統 version 1.0</span>
    </div>
</body>
<script>
$(document).ready(function() {
    $('.close_b').click(function() {
        $('#member_info').removeClass('open_win');
        $('body').removeClass('open_win_back');
        $('.info_window_border').addClass('info_close');
        $('.info_window_border').removeClass('info_open');
    });
});
</script>

</html>