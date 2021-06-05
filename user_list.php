<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
require_once "db_cone.php";
?>
</head>

<body>
    <div class="content">
        <?php
require_once "sidebar.php";
set_title("使用者列表");
set_h1("USER LIST");
?>
        <!-- 主題內文 -->
        <div class="container">
            <div class="row case_filter">
                <div class="col-12 col-md-4">
                    <span>使用者類型:</span>
                    <select name="role_type" id="role_type">
                        <option value="all">全部</option>
                        <option value="admin">管理者</option>
                        <option value="operator">司機</option>
                        <option value="user">使用者</option>
                    </select>
                </div>
                <div class="col-12 offset-md-4 col-md-4">
                    <span>每頁顯示資料筆數:</span>
                    <select name="show_count" id="show_count">
                        <option value=5>5</option>
                        <option value=10>10</option>
                        <option value=20>20</option>
                        <option value=30>30</option>
                    </select>
                </div>
            </div>
            <div id="list">
                <div class="row list_title">
                    <div class="col-10">
                        <div class="row">
                            <div class="col-6 col-md-2">
                                <div class="list_df">
                                    <h4>ID</h4>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="list_df">
                                    <h4>姓名</h4>
                                </div>
                            </div>
                            <div class="col-5 col-md-3">
                                <div class="list_df">
                                    <h4>帳號類型</h4>
                                </div>
                            </div>
                            <div class="col-7 col-md-4">
                                <div class="list_df">
                                    <h4>電子郵件</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-2">
                        <div class="list_df">
                            <h4>狀態</h4>
                        </div>
                    </div>
                </div>
                <!-- 人員列表內容 -->
                <div id="list_content">

                </div>
                <form action="user_info.php" method="post">
                    <input type="hidden" name="row_id" id="row_id">
                </form>
                <div class="row list_control">
                    <div class="col-4"><a id="prev_b" onclick="prev()">
                            < PREV</a>
                    </div>
                    <div class="col-4"><a id="frist_b" onclick="frist()">FRIST</a></div>
                    <div class="col-4"><a id="next_b" onclick="next()">NEXT ></a></div>
                </div>
            </div>
        </div>
    </div>
    <?php
require_once "footer.php";
?>
</body>
<script>
var start, count = 5;
var la = new loading_anime();
$(document).ready(function() {
    start = 0;
    $('#prev_b').hide()
    loading();
    $('#role_type,#show_count').change(function() {
        start = 0;
        btn_init();
    });
})

function loading() {
    la.l.fadeIn();
    let s_role = ($('#role_type').val() == 'all') ? (1) : (`\`role\` = '${$('#role_type').val()}'`);
    $.ajax({
        type: "POST",
        url: 'http://127.0.0.1/api.php?do=user_list',
        data: {
            start: start,
            where: s_role,
            limit: count
        },
        success: function(result) {
            la.l.hide();
            if (result != 'FAIL') {
                $('#list_content').html(result);
            } else {
                console.log(result);
            }
        }
    })
}

function btn_init() {
    let s_role = ($('#role_type').val() == 'all') ? (1) : (`\`role\` = '${$('#role_type').val()}'`);
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=get_number',
        type: 'post',
        data: {
            target: 'row_id',
            table: 'user',
            where: s_role
        },
        success: function(result) {
            let limit = eval(result);
            count = eval($('#show_count').val());
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

// function get_number(target, table) {
//     let s_role = ($('#role_type').val() == 'all') ? (1) : (`\`role\` = '${$('#role_type').val()}'`);
//     let got_number;
//     $.ajax({
//         url: 'http://127.0.0.1/api.php?do=get_number',
//         type: 'post',
//         data: {
//             target: target,
//             table: table,
//             where: s_role
//         },
//         async: false,
//         success: function(result) {
//             got_number = eval(result);
//         }
//     })
//     return got_number;
// }


function next() {
    // la.l.fadeIn();
    let s_role = ($('#role_type').val() == 'all') ? (1) : (`\`role\` = '${$('#role_type').val()}'`);
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=get_number',
        type: 'post',
        data: {
            target: 'row_id',
            table: 'user',
            where: s_role
        },
        success: function(result) {
            let limit = eval(result);
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
    // let limit = get_number("row_id", "user");

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

function frist() {
    start = 0;
    $('#next_b').show();
    $('#prev_b').hide();
    loading();
}

function submit(index) {
    let f = document.forms[0];
    f.row_id.value = index;
    f.submit();
}
</script>

</html>