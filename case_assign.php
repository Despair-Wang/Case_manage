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
    <script src="js/moment.js"></script>
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/main.js"></script>
    <script>
    function sub_form(number) {
        let f = document.forms['cf'];
        f.call.value = number;
        f.submit();
    }
    </script>
</head>

<body>
    <div class="content">
        <!-- <div class="content"> -->
        <?php
require_once "sidebar.php";
set_h1("CASE ASSIGN");
?>
        <div id="back" onclick="go_back()">
            <div>BACK</div>
            <div></div>
            <div></div>
        </div>
        <!-- 主題內文 -->
        <div class="container">
            <div class="case_assign">
                <div class="row assign_title">
                    <div class="col-12">
                        <h2>人員指派</h2>
                    </div>
                    <div class="col-12 col-md-4 offset-md-2">
                        <h4>案件編號</h4>
                    </div>
                    <div class="col-12 col-md-4">
                        <h4 id="serial"></h4>
                    </div>
                    <div class="col-12 col-md-4 offset-md-2">
                        <h4>案件名稱</h4>
                    </div>
                    <div class="col-12 col-md-4">
                        <h4 id="service"></h4>
                    </div>
                    <div class="col-12 col-md-4 offset-md-2">
                        <h4>預約日期</h4>
                    </div>
                    <div class="col-12 col-md-4">
                        <h4>
                            <select id="date">
                            </select>
                        </h4>
                    </div>
                    <div class="col-12 col-md-4 offset-md-2">
                        <h4>開始時間</h4>
                    </div>
                    <div class="col-12 col-md-4">
                        <h4 id="time"></h4>
                    </div>
                </div>
                <!-- member_block -->
                <div class="row member_list">

                </div>
                <!-- member_block -->
            </div>
        </div>
        <div class="member_info" id="member_info">
            <div class="container">
                <div class="info_window_border">
                    <div class="info_window">
                        <a class="close_btn close_b">&times;</a>
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-2 offset-lg-1 member_pic">
                                <img id="pic" src="" alt="" class="img-fluid" />
                                <h6 id="user_serial" class="light_word" style="color:#98efff"></h6>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>姓名</h5>
                                    </div>
                                    <div class="col-12">
                                        <h5 id="name"></h5>
                                    </div>
                                    <div class="col-12">
                                        <h5>性別</h5>
                                    </div>
                                    <div class="col-12">
                                        <h5 id="sex"></h5>
                                    </div>
                                    <div class="col-12">
                                        <h5>車種</h5>
                                    </div>
                                    <div class="col-12">
                                        <h5 id="car_type"></h5>
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
                                        <h5 id="identity"></h5>
                                    </div>
                                    <div class="col-12">
                                        <h5>備註</h5>
                                    </div>
                                    <div class="col-12">
                                        <h5 id="remark"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row okcansel my-3">
                            <div class="col-6">
                                <a class="btn case_ctrl" onclick="assign()">
                                    <h4>指派</h4>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="" class="btn case_ctrl close_b">
                                    <h4>取消</h4>
                                </a>
                            </div>
                        </div>
                        <div id="calendar_error" style="display:none"><code>get-events.php</code> 尚未運行</div>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form name="back" action="case_info.php" method="POST">
        <input type="hidden" name="serial" id="serial_back">
    </form>
    <!-- </div> -->
    <?php
require_once "footer.php";
?>
    <div id="sf"></div>
</body>
<script id='ms'>
<?php
if (isset($_POST['serial'])) {
    $_SESSION['serial'] = $_POST['serial'];
}
echo "var order_serial = '{$_SESSION['serial']}';";
?>
var la = new loading_anime();
$(document).ready(function() {
    case_get();
    loading();
    $('#date').change(function() {
        match_check($('#date').val());
    })
    $('.close_b,#member_info').on('click', function(e) {
        if (e.target === this) {
            $('#member_info').removeClass('open_win');
            $('body').removeClass('open_win_back');
            $('.info_window_border').addClass('info_close');
            $('.info_window_border').removeClass('info_open');
        }
    });
});

function sub_form(id) {
    la.l.fadeIn()
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=assign_sub_form',
        type: 'post',
        data: {
            user_serial: id
        },
        success: function(result) {
            $('#sf').html(result);
            // $('#member_info').show();
            la.l.hide();
            $('#member_info').addClass('open_win');
            $('.info_window_border').addClass('info_open');
            $('.info_window_border').removeClass('info_close');
            $('body').addClass('open_win_back');
        }
    })
}

function case_get() {
    la.l.fadeIn();
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=assign_case_get',
        type: 'post',
        data: {
            order_serial: order_serial
        },
        success: function(result) {
            la.l.hide();
            if (result != 'FAIL') {
                $('body').append(result);
            }

        }
    })
}

function loading() {
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=assign_list',
        type: 'post',
        success: function(result) {
            if (result != '') {
                $('.member_list').html(result);
            }
        }
    })
}

function match_check(time) {
    $('.oper').css('filter', 'brightness(1)');
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=match_check',
        type: 'post',
        data: {
            time: time
        },
        success: function(result) {
            if (result != 'NO_MATCH') {
                console.log(result);
                let match_list = result.split(',');
                for (let i = 0; i < match_list.length; i++) {
                    $(match_list[i]).css('filter', 'brightness(0.3)');
                }
            }
        }
    })
}

function assign() {
    la.l.fadeIn();
    let start = $('#date').val() + 'T' + $('#time').html();
    let long = parseInt('8:00'.replace(':', ''));
    let over = ('0' + (parseInt($('#time').html().replace(':', '')) + long).toString()).substr(-4, 4);
    let end = $('#date').val() + 'T' + over.substr(0, 2) + ':' + over.substr(2, 2);
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=assign_set',
        type: 'post',
        data: {
            order_serial: order_serial,
            user_serial: $('#user_serial').html().substr(3),
            title: $('#service').html(),
            start: start,
            end: end
        },
        success: function(result) {
            if (result == 'ASSIGNED') {
                la.show_mes('案件指派成功！');
                la.b.click(function() {
                    la.close_load();
                    go_back();
                })
            } else {
                la.show_mes('案件指派失敗，請聯絡系管');
                console.log(result);
                la.b.click(function() {
                    la.close_load();
                })
            }
        }
    })
}

function go_back() {
    let f = document.forms['back'];
    f.serial.value = order_serial;
    f.submit();
}
</script>

</html>