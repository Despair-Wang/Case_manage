<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
?>
    <script src="js/croppie.js"></script>
</head>

<body>

    <!-- 主題內文 -->
    <div class="container">
        <div class="content">
            <?php
require_once "sidebar.php";
set_h1("INFOMATION UPDATE");
set_title("會員資料修改");
?>
            <div id="back" onclick="go_back()">
                <div>BACK</div>
                <div></div>
                <div></div>
            </div>
            <div class="case_info">
                <form id="create_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="role" id="role">
                    <input type="hidden" name="img" id="img">
                    <input type="hidden" name="row_id" id="row_id">
                    <?php
require_once "writen_item.php";
?>
                    <div class="row">
                        <div class="col-12">
                            <div class="row d-flex justify-content-center">

                                <div class="col-6">
                                    <a class="btn case_ctrl" onclick="submit()">
                                        <h4 id="sub">更新</h4>
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
                <form name="back" action="user_info.php" method="POST">
                    <input type="hidden" name="row_id" id="row_id_back">
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
                        <label id="crop_img" class="btn case_ctrl w_atuo mr-3">
                            <i class="fa fa-scissors"></i>&emsp;剪裁圖片
                        </label>
                        <label id="cancel" class="btn case_ctrl w_atuo">
                            取消
                        </label>
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
echo "\nvar row_id = {$_POST['row_id']};\n"
?>
$(document).ready(function() {
    $("input:radio").addClass('cur_p');
    $("input:radio").next("label").addClass('cur_p mb-0');
    $("#role_select").change(function() {
        if ($(this).val() == 'operator') {
            $('.oper_only').show();
        } else {
            $('.oper_only').hide();
        }
    })
    loading();
})

var la = new loading_anime();

function loading() {
    la.l.fadeIn();
    $.post(
        'http://127.0.0.1/api.php?do=update_get', {
            row_id
        },
        function(result) {
            la.l.hide();
            $('body').append(result);
        }
    )

}

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

    let data = $(':input').serialize();
    // console.log("data is " + data);
    la.l.fadeIn();
    $.post(
        'http://127.0.0.1/api.php?do=update_set',
        data,
        function(result) {
            if (result == 'UPDATED') {
                // alert('資料更新完成！部分資料會在下次登入後生效。');
                la.show_mes('資料更新完成！部分資料會在下次登入後生效。');
                la.b.click(function() {
                    la.close_load();
                    go_back();
                })
            } else {
                // alert('資料更新失敗，請聯絡系統管理員。');
                la.show_mes('資料更新失敗，請聯絡系統管理員。');
                console.log(result);
                la.b.click(function() {
                    la.close_load();
                })

            }
        }
    )

}

$("#reset").click(function() {
    $(".error_m").remove();
    $(".is_checked").remove();
})

function go_back() {
    document.forms['back'].submit();
}
<?php
require_once "js/crop_img.js";
require_once "js/write_role.js";
?>
</script>

</html>