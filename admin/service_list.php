<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
?>
</head>

<body>
    <div class="content">
        <?php
require_once "sidebar.php";
set_title("服務項目一覽");
set_h1("SERVICE LIST");
?>
        <!-- 主題內文 -->
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <button id="insert" class="btn case_ctrl w-auto">
                        <h4>
                            新增
                        </h4>
                    </button>
                </div>
            </div>
            <div class="row case_filter">
                <div class="col-12 col-md-4">
                    <span>開放狀態:</span>
                    <select name="status" id="status">
                        <option value="all">全部</option>
                        <option value=1>開放</option>
                        <option value=0>關閉</option>
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
                    <div class="col-6 col-md-2">
                        <div class="list_df">
                            <h4>ID</h4>
                        </div>
                    </div>
                    <div class="col-6 col-md-1">
                        <div class="list_df">
                            <h4>首圖</h4>
                        </div>
                    </div>
                    <div class="col-5 col-md-7">
                        <div class="list_df">
                            <h4>項目名稱</h4>
                        </div>
                    </div>
                    <div class="col-7 col-md-2">
                        <div class="list_df">
                            <h4>開放狀況</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 人員列表內容 -->
            <div id="list_content">

            </div>
            <form action="service_create.php" method="post">
                <input type="hidden" name="id" id="id">
            </form>
            <div class="row list_control">
                <div class="col-4"><a id="prev_b" onclick="prev()"><i class="fa fa-caret-left"></i>&ensp;PREV</a>
                </div>
                <div class="col-4"><a id="first_b" onclick="first()">FIRST</a></div>
                <div class="col-4"><a id="next_b" onclick="next()">NEXT&ensp;<i class="fa fa-caret-right"></i></a>
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
var start, count = 5;
var la = new loading_anime();
var status = 1;
$(function() {
    start = 0;
    $('#insert').click(function() {
        location.href = 'service_create.php';
    })
    // $('#prev_b').hide()
    btn_init();
    $('#show_count').change(function() {
        start = 0;
        btn_init();
    });
})

function loading() {
    $.ajax({
        type: "POST",
        url: 'api.php?do=service_list',
        data: {
            start: start,
            where: status,
            count: count
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
    la.l.fadeIn();
    $.ajax({
        url: 'api.php?do=get_number',
        type: 'post',
        data: {
            target: 'serial',
            table: 'users',
            where: status
        },
        success: function(result) {
            let limit = parseInt(result);
            count = parseInt($('#show_count').val());
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
        url: 'api.php?do=get_number',
        type: 'post',
        data: {
            target: 'serial',
            table: 'users',
            where: status
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
}


function prev() {
    la.l.fadeIn();
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
    la.l.fadeIn();
    start = 0;
    $('#next_b').show();
    $('#prev_b').hide();
    loading();
}

function submit(index) {
    let f = document.forms[0];
    f.id.value = index;
    f.submit();
}
</script>

</html>