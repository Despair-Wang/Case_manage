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
set_title('預約案件詳細');
set_h1('CASE INFOMATION');
?>
        <!-- 主題內文 -->
        <div class="container">
            <div class="case_info">
                <div id="case_id_blcok" class='row info_header'>
                    <div class='col-12 col-md-6'>
                        <div class='row'>
                            <div class='col-4'>
                                <h5>案件編號</h5>
                            </div>
                            <div class='col-8'>
                                <h5 id='case_id'></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-1 -->
                <div class="row info_header">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <h5>預約項目</h5>
                            </div>
                            <div class="col-8">
                                <h5 id="c_title"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <h5>指派人員</h5>
                            </div>
                            <div class="col-5">
                                <h5 id="order_name"></h5>
                            </div>
                            <div class="col-3">
                                <a id="assign" class="assign btn" href="#">指派</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-2 -->
                <div class="row info_block">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <h5>期望車種</h5>
                            </div>
                            <div class="col-8">
                                <h5 id="car_type"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <h5>處理狀態</h5>
                            </div>
                            <div class="col-8">
                                <h5 id="case_status"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <h5>姓名</h5>
                            </div>
                            <div class="col-8">
                                <h5 id="c_name"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <h5>電話</h5>
                            </div>
                            <div class="col-8">
                                <h5 id="c_tel"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <h5>人數</h5>
                            </div>
                            <div class="col-8">
                                <h5 id="c_number"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <h5>電子郵件</h5>
                            </div>
                            <div class="col-8">
                                <h5 id="c_mail"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-3 -->
                <div class="row info_block">
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-6">
                                <h5>第一期望日期</h5>
                            </div>
                            <div class="col-6">
                                <h5 id="c_date1"></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>開始時段</h5>
                            </div>
                            <div class="col-6">
                                <h5 id="c_time1"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-6">
                                <h5>第二期望日期</h5>
                            </div>
                            <div class="col-6">
                                <h5 id="c_date2"></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>開始時段</h5>
                            </div>
                            <div class="col-6">
                                <h5 id="c_time2"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-6">
                                <h5>第一期望日期</h5>
                            </div>
                            <div class="col-6">
                                <h5 id="c_date3"></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>開始時段</h5>
                            </div>
                            <div class="col-6">
                                <h5 id="c_time3"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-4 -->
                <div class="row info_block">
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <h5>額外服務</h5>
                            </div>
                            <div class="col-12" id="c_option">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="row">
                            <div class="col-12">
                                <h5>備註</h5>
                            </div>
                            <div class="col-12">
                                <h5 id="c_remark">
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-5 -->
                <div id="reply_block" class="row info_block">
                    <div class="col-12 reply_title">
                        <h5>案件回饋評價</h5>
                    </div>
                    <div class="col-12">
                        <div class="reply_star">
                            <span>★</span>
                            <span>★</span>
                            <span>★</span>
                            <span>★</span>
                            <span>★</span>
                            <h6>0</h6>
                        </div>
                    </div>
                    <div id="content_block">
                    </div>
                </div>
                <!-- control-button -->
                <form id="update" name="update" action="case_create.php" method="post">
                    <input type="hidden" name="case_id">
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn case_ctrl" onclick="case_update()">
                                    <h4>修改</h4>
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn case_ctrl">
                                    <h4>刪除</h4>
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
<?php
echo "var case_id = '{$_POST['case_id']}';";
echo "var user_role = '{$_SESSION['role']}';";
echo "var user_name = '{$_SESSION['name']}';";
?>
var la = new loading_anime();
var star = $('.reply_star span');
$('document').ready(function() {
    loading();
    show_reply();
});

function loading() {
    la.l.fadeIn();
    $.post('http://127.0.0.1/api.php?do=case_info', {
            case_id
        },
        function(result) {
            la.l.hide();
            if (result != 'FAIL') {
                $('body').after(result);
            } else {
                console.log('error');
                console.log(result);
            }
        }
    )
}

function reply() {
    la.l.fadeIn();
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=case_reply',
        type: 'post',
        data: {
            case_id: case_id,
            user_name: user_name,
            user_role: user_role,
            score: eval($('.reply_star>h6').html()),
            reply: $('#reply').html()
        },
        success: function(result) {
            if (result == 'DONE') {
                la.show_mes('感謝您的回饋！');
                la.b.click(function() {
                    la.close_load();
                    loading();
                    show_reply();
                })
            } else {
                la.show_mes('回饋失敗，請聯絡系管');
                console.log(result);
                la.b.click(function() {
                    la.close_load();
                })
            }
        }
    })
}

function show_reply() {
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=show_reply',
        type: 'post',
        data: {
            case_id: case_id
        },
        success: function(result) {
            console.log(result);
            let res = result.substr(0, 1);
            if (res != '0') {
                console.log('done');
                let score = result.substr(1, 2);
                let content = result.substr(2);
                $('#content_block').html(content);
                star_light(eval(score) - 1);
            } else {
                console.log('not reply yet');
                let content = result.substr(1);
                $('#content_block').html(content);
                for (let i = 0; i < star.length; i++) {
                    $(star[i]).click(function() {
                        star_light(i);
                    });
                }
                star_light(0);
            }
        }
    })
}

function case_update() {
    let f = document.forms['update'];
    f.case_id.value = case_id;
    f.submit();
}

function star_light(index) {
    console.log('click');
    for (let i = 0; i < star.length; i++) {
        $(star[i]).css('color', 'rgba(255, 255, 0, 0.2)');
    }
    for (let i = 0; i <= index; i++) {
        $(star[i]).css('color', 'rgba(255,255,0,1)');
    }
    $('.reply_star h6').html(index + 1);
}
</script>

</html>