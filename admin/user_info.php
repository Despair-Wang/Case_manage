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
set_h1("USER INFORMATION");
set_title("會員資料檢視");
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    set_init("$('.admin_only').show();");
}
?>
        <!-- 主題內文 -->
        <div class="container">
            <div id="back">
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
                    <input type="hidden" name="serial" id="serial">
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
    var myself = false;
    <?php
if (isset($_POST['serial'])) {
    echo "let serial = '{$_POST['serial']}';\n";
} else {
    echo "let serial = '{$_SESSION['serial']}';\n";
    echo "myself = true;\n";
}
if ($_SESSION['role'] != 'admin') {
    echo "myself = true;\n";
}

?>
    $(function() {
        $('#back').click(function() {
            go_back();
        })
        loading();
    })
    var la = new loading_anime();

    function loading() {
        la.l.fadeIn();
        $.post(
            'api.php?do=user_info', {
                serial
            },
            function(result) {
                la.l.hide();
                $('head').append(result);
            }
        )
    }

    function user_delete() {
        if (confirm("確定要刪除本筆資料？")) {
            la.l.fadeIn();
            $.post(
                'api.php?do=user_delete', {
                    serial
                },
                function(result) {
                    if (result == 'DELETED') {
                        la.show_mes('資料已經刪除');
                        // alert('資料已經刪除');
                        la.b.click(function() {
                            la.close_load();
                            if (user_serial == serial) {
                                location.href = "logout.php";
                            } else {
                                history.back(1);
                            }
                        })
                    } else {
                        // alert('刪除失敗，請聯絡系統管理員');
                        la.show_mes('刪除失敗，請聯絡系統管理員');
                        la.b.click(function() {
                            la.close_load();
                        })
                    }
                }
            )
        }
    }

    function update() {
        let f = document.forms[0];
        f.serial.value = serial;
        f.submit();
    }

    function go_back() {
        if (myself) {
            location.href = 'home.php';
        } else {
            location.href = 'user_list.php';
        }
    }
    </script>
</body>

</html>