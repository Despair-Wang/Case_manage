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
                <div class="col-12 col-md-4">
                    <span>處理狀態:</span>
                    <select name="case_status" id="case_status">
                        <option value="all">全部</option>
                        <option value="standby">處理中</option>
                        <option value="ready">已安排</option>
                        <option value="over">已結束</option>
                        <option value="cancel">已取消</option>
                    </select>
                </div>
            </div>
            <div id="list">
                <div class="row list_title">
                    <div class="col-10">
                        <div class="row">
                            <div class="col-6 col-md-3">
                                <h4>案件編號</h4>
                            </div>
                            <div class="col-6 col-md-2">
                                <h4>預約時間</h4>
                            </div>
                            <div class="col-5 col-md-3">
                                <h4>預約人姓名</h4>
                            </div>
                            <div class="col-7 col-md-4">
                                <h4>預約服務項目</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <h4>處理狀況</h4>
                    </div>
                </div>
                <!-- 案件清單內容 -->
                <form id="case_info" name="case_info" action="case_info.php" method="post">
                    <input type="hidden" name="case_id">
                </form>
                <div id="list_box"></div>
                <!-- 案件清單內容 -->
            </div>
            <div class="row list_control">
                <div class="col-4"><a herf="#">
                        < PREV</a>
                </div>
                <div class="col-4"><a herf="#">FRIST</a></div>
                <div class="col-4"><a herf="#">NEXT ></a></div>
            </div>
        </div>
    </div>
    <?php
require_once "footer.php";
?>
</body>
<script>
var start, count = 10;
$(function() {
    start = 0;
    loading();
})

function loading() {
    let status = 1;
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=case_list',
        type: 'post',
        data: {
            start: start,
            count: count,
            where: status
        },
        success: function(result) {
            $('#list_box').html(result);
        }


    })
}

function submit(id) {
    let f = document.forms['case_info'];
    f.case_id.value = id;
    f.submit();
}
</script>

</html>