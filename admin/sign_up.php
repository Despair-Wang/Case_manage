<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>會員註冊</title>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/croppie.css" />
    <script src="js/a_core.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="js/croppie.js"></script>
</head>

<body>
    <!-- 主題內文 -->
    <div class="content">
        <div class="container">
            <nav class="navbar navbar-dark pt-4">
                <h1 id="title" class="light_word mx-auto p-2 my-3">SIGN UP</h1>
            </nav>
            <div class="case_info">
                <form id="create_form" method="post">
                    <input type="hidden" name="role" id="role" value="user">
                    <input type="hidden" name="img" id="img">
                    <?php
require_once "writen_item.php";
?>
                    <div class="row">
                        <div class="col-12">
                            <div class="row d-flex justify-content-center">

                                <div class="col-6">
                                    <a class="btn case_ctrl" onclick="submit()">
                                        <h4 id="sub">註冊</h4>
                                    </a>
                                </div>

                                <div class="col-6">
                                    <button class="btn case_ctrl" type="reset" id="reset">
                                        <h4>重填</h4>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="oldImg_frame">
            <div class="row">
                <div class="col-12">
                    <div id="oldImg">
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-center align-self-center">
                        <label id="crop_img" class="btn case_ctrl w_auto mr-3">
                            <i class="fa fa-scissors"></i>&emsp;剪裁圖片
                        </label>
                        <label id="cancel" class="btn case_ctrl w_auto">
                            取消
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <span>案件分配管理系統 version 1.0</span>
    </div>
    <div id="loading">
        <div>
            <div id="run">
                <div></div>
                <div></div>
                <div id="message">
                    <h4>Loading...</h4>
                </div>
            </div>
            <div id="completed" class="container">
                <div class="row">
                    <div id="com_mes" class="col-12">
                        <h3>COMPLETED</h3>
                    </div>
                    <div id="com_btn" class="col-12">
                        <button>OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
let l = $('#loading'),
    mes = $('#com_mes > h3'),
    b = $('#com_btn > button'),
    r = $('#run'),
    c = $('#completed');
$(document).ready(function() {
    $("input:radio").addClass('cur_p');
    $("input:radio").next("label").addClass('cur_p mb-0');
    <?php
if (isset($_POST['role'])) {
    echo "document.forms['create_form'].role.value = '{$_POST['role']}';";
    if ($_POST['role'] == 'operator') {
        echo "$('.oper_only').removeClass('oper_only');";
    }
}
?>
})

$("#reset").on('click', function() {
    $(".error_m").remove();
    $(".is_checked").remove();
})



function submit() {
    // console.log('click');
    let no_write = false;
    let f = document.forms['create_form'];
    if (f.name.value == "" || nosp.test(f.name.value)) {
        set_error($("#name"), "請輸入姓名");
        no_write = true;
    }
    if (f.pw.value == "" || nosp.test(f.pw.value)) {
        set_error($("#pw"), "請輸入密碼");
        no_write = true;
    }

    if (f.sex.value == "") {
        set_error($("#sex_m"), "請選擇性別");
        no_write = true;
    }

    if (f.mail.value == "" || nosp.test(f.mail.value)) {
        set_error($("#mail"), "請輸入電子郵件");
        no_write = true;
    }
    if (no_write) {
        return;
    }


    l.fadeIn();
    let data = $(':input').serialize();
    $.post(
        'api.php?do=sign_up',
        data,
        function(result) {
            if (result == 'OVERLAP') {
                show_mes('您的電子郵件已經在本系統註冊過了，請使用其他的電子郵件。');
                b.click(function() {
                    close_load();
                });
                // alert('您的電子郵件已經在本系統註冊過了，請使用其他的電子郵件。');
            } else if (result == 'INSERTED') {
                show_mes('註冊成功，歡迎使用本系統。');
                b.click(function() {
                    close_load();
                    location.href = "login.html";
                });
            } else {
                // alert('註冊失敗，請聯絡系統管理員。');
                show_mes('註冊失敗，請聯絡系統管理員。');
                b.click(function() {
                    close_load();
                });
                console.log(result);
            }
        }
    )
}

function show_mes(message) {
    r.hide();
    mes.html(message);
    c.slideToggle();

}

function close_load() {
    l.hide();
    setTimeout(() => {
        r.show();
        c.hide();
    }, 100);
}



<?php
require_once "js/crop_img.js";
require_once "js/write_role.js";
?>
</script>

</html>