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
set_title("WELCOME");
set_h1('CASE MANAGE SYSTEM');
?>
        <!-- 主題內文 -->
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex">
                    <h3></h3>
                    <h2 class="welcome mx-auto">WELCOME</h2>
                </div>
                <div class="report row">
                    <div class="col-12 d-flex">
                        <h3 class="light_word mx-auto my-3 p-2">TODAY REPORT</h3>
                    </div>
                    <div class="col-12">
                        <h5>2021/05/12</h5>
                    </div>
                    <div class="col-12">
                        <h4>會員增加數：</h4>
                        <h4>2</h4>
                    </div>
                    <div class="col-12">
                        <h4>案件增加數：</h4>
                        <h4>15</h4>
                    </div>
                    <div class="col-12">
                        <h4>目前執行數：</h4>
                        <h4>4</h4>
                    </div>
                    <div class="col-12">
                        <h4>回饋增加數：</h4>
                        <h4>7</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
require_once "footer.php";
?>
</body>

</html>