<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
?>
</head>

<body>
    <!-- 側邊控制欄 -->
    <div class="content">
        <?php
require_once "sidebar.php";
set_title('案件清單');
set_h1('ORDER LIST');
?>
        <!-- 主題內文 -->
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn case_ctrl w-auto" onclick="location.href='case_create.php'">
                        <h4>
                            新增
                        </h4>
                    </button>
                </div>
            </div>
            <div class="row case_filter">
                <div class="col-12 col-md-4"><span>起始時間：</span><input type="date" name="start_date" id="start_date" />
                </div>
                <div class="col-12 col-md-4"><span>結束時間：</span><input type="date" name="end_date" id="end_date" /></div>
                <div class="col-12 col-md-1">
                    <a id="time_filter" class="btn btn_wt">篩選</a>
                </div>
                <div class="col-12 col-md-3">
                    <span>處理狀態:</span>
                    <select name="status" id="status">
                        <option value="1">全部</option>
                        <option value="待處理">待處理</option>
                        <option value="已指派">已指派</option>
                        <option value="已結束">已結束</option>
                        <option value="已取消">已取消</option>
                    </select>
                </div>
            </div>
            <div id="list">
                <div class="row list_title">
                    <div class="col-11">
                        <div class="row">
                            <div class="col-4 col-md-3">
                                <h4>案件編號</h4>
                            </div>
                            <div class="col-4 col-md-2">
                                <h4>出發時間</h4>
                            </div>
                            <div class="col-4 col-md-2">
                                <h4>預約人</h4>
                            </div>
                            <div class="col-5 col-md-3">
                                <h4>預約服務項目</h4>
                            </div>
                            <div class="col-7 col-md-2">
                                <h4>預約時間</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 d-flex align-items-center justify-content-center">
                        <h4>狀態</h4>
                    </div>
                </div>
                <!-- 案件清單內容 -->
                <form id="case_info" name="case_info" action="case_info.php" method="post">
                    <input type="hidden" name="serial">
                </form>
                <div id="list_box"></div>
                <!-- 案件清單內容 -->
            </div>
            <div class="row list_control">
                <div class="col-4"><a id="prev_b" onclick="prev()"><i class="fa fa-caret-left"></i>&ensp;PREV</a></div>
                <div class="col-4"><a id="first_b" onclick="first()">FIRST</a></div>
                <div class="col-4"><a id="next_b" onclick="next()">NEXT&ensp;<i class="fa fa-caret-right"></i></a></div>
            </div>
        </div>
    </div>
    <?php
require_once "footer.php";
?>
</body>
<script>
var start, count = 3,
    status = 1,
    la = new loading_anime();
$(function() {
    start = 0;
    $('#prev_b').hide()
    // loading();
    btn_init();
    $('#status').change(function() {
        get_status();
        btn_init();
    })
    $('#time_filter').click(function() {
        date_filter();
    })
})

function loading() {
    // la.l.fadeIn();
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=case_list',
        type: 'post',
        data: {
            start: start,
            count: count,
            where: status
        },
        success: function(result) {
            la.l.hide();
            $('#list_box').html(result);
        }
    })
}

function btn_init() {
    la.l.fadeIn();
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=get_number',
        type: 'post',
        data: {
            target: 'serial',
            table: 'orders',
            where: status
        },
        success: function(result) {
            let limit = parseInt(result);
            // count = eval($('#show_count').val());
            if (limit <= count) {
                $('#next_b').hide();
                $('#prev_b').hide();
            } else {
                $('#next_b').show();
                $('#prev_b').hide();
            };
            loading();
        }
    })
}

function next() {
    la.l.fadeIn();
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=get_number',
        type: 'post',
        data: {
            target: 'serial',
            table: 'orders',
            where: status
        },
        success: function(result) {
            let limit = parseInt(result);
            if (start <= limit - count) {
                start += count;
                loading();
                $("#prev_b").show();
                if (start >= limit - count) {
                    $('#next_b').hide();
                }
            }
        }
    })
}


function prev() {
    if (start > 0) {
        start = (start - count < 0) ? (0) : (start - count);
        loading();
        $('#next_b').show();
        if (start == 0) {
            $('#prev_b').hide();
        }
    }
}

function first() {
    start = 0;
    $('#next_b').show();
    $('#prev_b').hide();
    loading();
}

function date_filter() {
    // la.l.fadeIn();
    let sd = $('#start_date').val(),
        ed = $('#end_date').val();
    if (sd != '' && ed != '') {
        let rule = /-/g;
        let sd_n = parseInt(sd.replace(rule, '')),
            ed_n = parseInt(ed.replace(rule, ''));
        if (sd_n <= ed_n) {
            get_status();
            if (sd_n == ed_n) {
                status += " AND `created_at` LIKE '" + sd + "%' ";
            } else {
                status += " AND `created_at` BETWEEN '" + sd + " 00:00:00' AND '" + ed + " 23:59:59' ";
            }
            btn_init();
        } else {
            la.l.fadeIn('fast');
            la.show_mes('結束日期不可小於開始日期');
            la.b.click(function() {
                la.close_load();
            })
        }
    } else {
        console.log('not date');
    }
}

function get_status() {
    let s = $('#status').val();
    status = (s == '1') ? (s) : ("`status` = '" + s + "'");
}

function submit(id) {
    let f = document.forms['case_info'];
    f.serial.value = id;
    f.submit();
}
</script>

</html>