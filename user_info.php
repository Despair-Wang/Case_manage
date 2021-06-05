<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
?>

</head>

<body>
    <div class="container">
        <div class="content">
            <?php
require_once "sidebar.php";
set_h1("USER INFOMATION");
set_title("會員資料檢視");
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    set_init("$('.admin_only').show();");
}
?>
            <!-- 主題內文 -->

            <div id="back" onclick="location.href='user_list.php'">
                <div>BACK</div>
                <div></div>
                <div></div>
            </div>
            <div class="case_info">
                <div id="info_content">
                    <div div class="row">
                        <div class="col-12 col-md-3 d-flex justify-content-center align-self-center">
                            <div class="info_block">
                                <img id="pic" src="" alt="" class="img-fluid" />
                            </div>
                        </div>
                        <div class="col-12 col-md-9 d-flex align-self-center">
                            <!-- block-1 -->
                            <div class="row info_block">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>姓名</h5>
                                        </div>
                                        <div class="col-8">
                                            <h5 id="name"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>暱稱</h5>
                                        </div>
                                        <div class="col-8">
                                            <h5 id="nickname"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>性別</h5>
                                        </div>
                                        <div class="col-8">
                                            <h5 id="sex"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 oper_only">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>身分</h5>
                                        </div>
                                        <div class="col-8">
                                            <h5 id="identity"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 oper_only">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>使用車種</h5>
                                        </div>
                                        <div class="col-8">
                                            <h5 id="car_type"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>電子郵件</h5>
                                        </div>
                                        <div class="col-8">
                                            <h5 id="mail"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>電話</h5>
                                        </div>
                                        <div class="col-8">
                                            <h5 id="tel"></h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 admin_only">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>備註</h5>
                                        </div>
                                        <div class="col-8">
                                            <h5 id="remark"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 admin_only">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>帳號狀態</h5>
                                        </div>
                                        <div class="col-8">
                                            <h5 id="enable"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- control-button -->
                        </div>
                    </div>
                </div>
                <form action="user_create.php" method="POST">
                    <input type="hidden" name="row_id" id="row_id">
                    <input type="hidden" name="role" id="role">
                    <div class="row">
                        <div class="col-12">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <a class="btn case_ctrl" onclick="update()">
                                        <h4>修改</h4>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="btn case_ctrl" onclick="user_delete()">
                                        <h4>刪除</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
require_once "footer.php";
?>
    <script>
    <?php
if (isset($_POST['row_id'])) {
    echo "let row_id = '{$_POST['row_id']}';\n";
} else {
    echo "let row_id = '{$_SESSION['row_id']}';\n";
}
echo "let user_row_id = '{$_SESSION['row_id']}';\n";
?>
    $(document).ready(function() {
        loading();
    })
    var la = new loading_anime();

    function loading() {
        la.l.fadeIn();
        $.post(
            'http://127.0.0.1/api.php?do=user_info', {
                row_id
            },
            function(result) {
                la.l.hide();
                $('head').append(result);
            }
        )
    }

    function user_delete() {
        if (confirm("確定要刪除本筆資料？")) {
            l.fadeIn();
            $.post(
                'http://127.0.0.1/api.php?do=user_delete', {
                    row_id
                },
                function(result) {
                    if (result == 'DELETED') {
                        show_mes('資料已經刪除');
                        // alert('資料已經刪除');
                        b.click(function() {
                            close_load();
                            if (user_row_id == row_id) {
                                location.href = "logout.php";
                            } else {
                                history.back(1);
                            }
                        })
                    } else {
                        // alert('刪除失敗，請聯絡系統管理員');
                        show_mes('刪除失敗，請聯絡系統管理員');
                        b.click(function() {
                            close_load();
                        })
                    }
                }
            )
        }
    }

    function update() {
        let f = document.forms[0];
        f.row_id.value = row_id;
        f.submit();
    }
    </script>
</body>

</html>