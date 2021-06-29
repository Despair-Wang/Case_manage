<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
?>
    <script src="js/moment.js"></script>
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/main.js"></script>
</head>

<body>
    <div class="content">
        <?php
require_once "sidebar.php";
set_title("出勤設定");
set_h1("SCHEDULE");
?>
        <!-- 主題內文 -->
        <div class="container">
            <div id="back" onclick="location.href='schedule_list.php'">
                <div>BACK</div>
                <div></div>
                <div></div>
            </div>
            <div id="schedule_set" class="row">
                <div class="col-12 col-md-4">
                    <div class="row">
                        <div class="col-12 member_pic" style="text-align:center">
                            <img id="pic" src="" alt="" class="img-fluid" />
                            <h6 id="serial" class="light_word" style="color:#98efff"></h6>
                            <h5 id="name" class="light_word" style="color:#98efff"></h5>
                            <input type="hidden" name="event_id" id="event_id">
                            <input type="hidden" name="type" id="type" value="insert">
                        </div>
                        <div class="row w-100">
                            <div class="col-2">
                                <h5>行程</h5>
                            </div>
                            <div class="col-10">
                                <h5><input type="text" id="event_title" placeholder="請輸入行程名稱"></h5>
                            </div>
                        </div>
                        <div class="row w-100">
                            <div class="col-2">
                                <h5>開始日期</h5>
                            </div>
                            <div class="col-10">
                                <h5><input type="date" name="start" id="start"></h5>
                                <input type="checkbox" name="allday" id="allday" style="width: auto;"><label
                                    for="allday" class="cur_p">整天</label>
                                <h5><input id="start_time" type="time" value="00:00" min="00:00" max="23:59"></h5>
                            </div>
                        </div>
                        <div class="row w-100">
                            <div class="col-2">
                                <h5>結束日期</h5>
                            </div>
                            <div class="col-10">
                                <h5><input id="end" type="date"></h5>
                                <h5><input id="end_time" type="time" value="23:59" min="00:00" max="23:59"></h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <a class="btn case_ctrl" id="added">
                                <h4>新增</h4>
                            </a>
                        </div>
                        <div class="col-6">
                            <a class="btn case_ctrl" id="reset">
                                <h4>重填</h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div id="calendar" style="height:100%"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
require_once "footer.php";
?>
</body>
<script>
var start, count = 5,
    update = false;
var la = new loading_anime();
<?php
if ($_SESSION['role'] == 'operator') {
    echo "var serial = '{$_SESSION['serial']}';";
} else {
    echo "var serial = '{$_POST['serial']}';";
}
?>
$(document).ready(function() {
    la.l.fadeIn();
    loading();
    $('#added').click(function() {
        add_event();
    })
    $('#reset').click(function() {
        $(':input').val('');
        $('#added').children('h4').html('新增');
        $('#type').val('insert');
    })
    $('#allday').change(function() {
        if ($(this).prop('checked')) {
            $('#start_time,#end,#end_time').attr('disabled', 'disabled').addClass('input_disabled');
        } else {
            $('#start_time,#end,#end_time').removeAttr('disabled').removeClass('input_disabled');
        }
    });
})

function loading() {
    $.ajax({
        type: "POST",
        url: 'api.php?do=schedule_get',
        data: {
            serial: serial
        },
        success: function(result) {
            la.l.hide();
            if (result != 'FAIL') {
                $('body').append(result);
            } else {
                console.log(result);
            }
        }
    })
}

function add_event() {
    la.l.fadeIn();
    let start, end, start_check = '',
        end_check = '',
        allDay = false;
    if ($('#allday').prop('checked')) {
        start = $('#start').val();
        end = '';
        allDay = true;
    } else {
        start = $('#start').val() + 'T' + $('#start_time').val();
        end = $('#end').val() + 'T' + $('#end_time').val();
        start_check = parseInt(start.replace('T', '').replace(/-/g, '').replace(':', ''));
        end_check = parseInt(end.replace('T', '').replace(/-/g, '').replace(':', ''));
        console.log('s = ' + start_check);
        console.log('e = ' + end_check);
    }
    let title = $('#event_title').val(),
        id = $('#event_id').val(),
        update = $('#type').val();
    if (end_check != '' && start_check > end_check) {
        la.show_mes('結束時間要晚於開始時間');
        la.b.click(function() {
            la.close_load();
        })
    } else {
        if (update == 'update') {
            $.ajax({
                url: 'api.php?do=schedule_update',
                type: 'post',
                data: {
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    allDay: allDay
                },
                success: function(result) {
                    if (result == 'UPDATED') {
                        la.show_mes('行程更新成功');
                        la.b.click(function() {
                            la.close_load();
                            loading();
                            $(':input').val('');
                            $('#added').children('h4').html('新增');
                        })
                    } else {
                        console.log(result);
                        la.show_mes('行程更新失敗，請聯絡系管');
                        la.b.click(function() {
                            la.close_load();
                        })
                    }
                }
            })
        } else {
            $.ajax({
                url: 'api.php?do=schedule_set',
                type: 'post',
                data: {
                    title: title,
                    start: start,
                    end: end,
                    user_serial: serial,
                    allDay: allDay
                },
                success: function(result) {
                    if (result == 'ADDED') {
                        la.show_mes('行程建立成功');
                        la.b.click(function() {
                            la.close_load();
                            loading();
                            $(':input').val('');
                        })
                    } else {
                        console.log(result);
                        la.show_mes('行程建立失敗，請聯絡系管');
                        la.b.click(function() {
                            la.close_load();
                        })
                    }
                }
            })
        }
    }
}

function update_get() {
    // let t = $(document.activeElement);
    // let t = $('input:focus');
    // if (t.aa) {
    //     console.log('No focus');
    // } else {
    //     console.log(t.attr('id'));
    // }
}

// function submit(index) {
//     let f = document.forms[0];
//     f.serial.value = index;
//     f.submit();
// }
</script>

</html>