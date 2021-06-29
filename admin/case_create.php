<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
?>
</head>

<body>
    <div class="content">
        <!-- 側邊控制欄 -->
        <?php
require_once "sidebar.php";
if (isset($_POST['serial'])) {
    set_title("案件更新");
    set_h1("CASE UPDATE");
} else {
    set_title("新增案件");
    set_h1("CASE INSERT");
}
?>
        <div id="back" onclick="go_back()">
            <div>BACK</div>
            <div></div>
            <div></div>
        </div>
        <!-- 主題內文 -->
        <div class="container">
            <div class="case_info">
                <div id="serial_block" class='row info_header'>
                    <div class='col-12 col-md-8 offset-md-2'>
                        <div class='row'>
                            <div class='col-5'>
                                <h5>案件編號</h5>
                            </div>
                            <div class='col-7'>
                                <h5 id='serial'></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-1 -->
                <div class="row info_header">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>預約項目</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <input type="text" name="service" id="service">
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>指派人員</h5>
                            </div>
                            <div class="col-4">
                                <h5 id="staff"></h5>
                            </div>
                            <div class="col-3">
                                <a class="assign btn" href="#">指派</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-2 -->
                <div class="row info_block">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>期望車種</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <select name="car_type" id="car_type">
                                        <option value="小客車">小客車</option>
                                        <option value="大客車">大客車</option>
                                        <option value="箱型車">箱型車</option>
                                        <option value="休旅車">休旅車</option>
                                    </select>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>姓名</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <input type="text" name="name" id="name">
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>電話</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <input type="tel" name="tel" id="tel">
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>人數</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <select name="number" id="number">
                                        <option value="1">1人</option>
                                        <option value="2">2人</option>
                                        <option value="3">3人</option>
                                        <option value="4">4人</option>
                                        <option value="5">5人</option>
                                        <option value="6">6人</option>
                                        <option value="7">7人</option>
                                        <option value="8">8人</option>
                                    </select>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>電子郵件</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <input type="email" name="mail" id="mail">
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-3 -->
                <div class="row info_block">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>第一期望日期</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <input type="date" name="date1" id="date1">
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <h5>開始時段</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <select name="time1" id="time1"></select>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>第二期望日期</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <input type="date" name="date2" id="date2">
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <h5>開始時段</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <select name="time2" id="time2"></select>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-5">
                                <h5>第三期望日期</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <input type="date" name="date3" id="date3">
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <h5>開始時段</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <select name="time3" id="time3"></select>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-4 -->
                <div class="row info_block">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-12">
                                <h5>額外服務</h5>
                            </div>
                            <div class="col-12">
                                <h5>
                                    <input type="checkbox" name="option1" id="option1">
                                    <label class="cur_p" for="option1">租用兒童安全座椅</label>
                                </h5>
                                <h5>
                                    <input type="checkbox" name="option2" id="option2">
                                    <label class="cur_p" for="option2">攜帶輪椅</label>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-12">
                                <h5>備註</h5>
                            </div>
                            <div class="col-12">
                                <h5>
                                    <textarea id="remark" name="remark" rows="5"></textarea>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- control-button -->
                <form name="back" action="case_info.php" method="POST">
                    <input type="hidden" name="serial" id="serial_back">
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <button id="submit" class="btn case_ctrl" onclick="submit()">
                                    <h4>新增</h4>
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn case_ctrl" type="reset">
                                    <h4>重填</h4>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
require_once "footer.php";
?>
</body>
<script>
var la = new loading_anime(),
    update = false;
<?php
if (isset($_POST['serial'])) {
    echo <<<upd
    serial = '{$_POST['serial']}';
    update = true;
    get_date("{$_POST['serial']}");
    upd;
}
?>
$('document').ready(function() {
    if (update) {
        $('#submit').children().html('更新');
    }
    set_time();
    $('.row').addClass('mb-2');
});

function get_date(id) {
    la.l.fadeIn();
    $.ajax({
        url: 'api.php?do=case_update_get',
        type: 'post',
        data: {
            serial: id
        },
        success: function(result) {
            la.l.hide();
            $('body').append(result);
        }
    })
}

function submit() {
    la.l.fadeIn();
    let data = $(':input').serialize();
    if (update) {
        $.post('api.php?do=case_update_set',
            data,
            function(result) {
                if (result == 'UPDATED') {
                    la.show_mes('案件更新成功');
                    la.b.click(function() {
                        la.close_load();
                        go_back()
                    })
                } else {
                    la.show_mes('更新失敗，請聯絡系管');
                    console.log(result);
                    la.b.click(function() {
                        la.close_load();
                    })
                }
            }
        )
    } else {
        $.post('api.php?do=case_insert',
            data,
            function(result) {
                if (result == 'INSERTED') {
                    la.show_mes('案件新增成功');
                    la.b.click(function() {
                        la.close_load();
                        location.href = 'case_list.php';
                    })
                } else {
                    la.show_mes('新增失敗，請聯絡系管');
                    console.log(result);
                    la.b.click(function() {
                        la.close_load();
                    })
                }
            })
    }
}

function set_time() {
    for (let i = 0; i < 7; i++) {
        let hh = (8 + i).toString();
        hh = (hh.length < 2) ? ("0" + hh) : (hh);
        for (let j = 0; j < 2; j++) {
            let mm = (30 * j).toString();
            mm = (mm.length < 2) ? ("0" + mm) : (mm);
            let time = hh + ":" + mm;
            $('#time1,#time2,#time3').append(`<option value="${time}">${time}</option>`)
        }
    }
}

function go_back() {
    document.forms['back'].submit();
}
</script>

</html>