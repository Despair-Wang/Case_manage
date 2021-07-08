<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once 'head.php';
?>
    <style>
    .table>.row:first-child {
        background-color: cornflowerblue !important;
        color: #fff;
        font-size: 1.1rem;
    }

    .table>.row {
        padding: 15px 0px;
        font-size: 1rem;
        display: flex;
        align-items: center;
    }

    .table>.row:nth-child(2n) {
        background-color: #e9f4ff;
        ;
    }

    .table>.row:nth-child(2n+1) {
        background-color: #e9ecef;
    }

    #price>div {
        padding: 5px 10px;
    }

    #price>div:nth-child(even) {
        background-color: #e9ecef;
    }


    .step_mark {
        display: flex;
        position: relative;
        justify-content: center;
        align-items: center;
    }

    .top_line>div:first-child {
        position: absolute;
        height: 50%;
        width: 50%;
        border-left: 2px solid blueviolet;
        top: 0;
        right: 0;
    }

    .bottom_line>div:last-child {
        position: absolute;
        height: 50%;
        width: 50%;
        border-left: 2px solid blueviolet;
        bottom: 0;
        right: 0;
    }

    .step_mark>div:nth-child(2) {
        height: 15px;
        width: 15px;
        border-radius: 100px;
        background-color: blueviolet;
    }

    #service_content>div:nth-child(even) {
        background-color: #e9ecef;
    }

    #service_content>div:nth-child(odd) {
        background-color: #e9f4ff;
    }
    </style>
</head>

<body oncontextmenu="return false" data-spy="scroll" data-offset="0">
    <?php
require_once 'menu.php';
?>
    <!--頁面內容-->
    <div id="wrap" style="background-color: rgba(175,255,255,0.7)">
        <div id="content" style="background-color:rgba(255,255,255,0.6); overflow:hidden">
            <!-- InstanceBeginEditable name="EditRegion3" -->
            <!-- Top menu -->
            <!--預約氣球-->
            <div style="position:fixed; right:2%; bottom:7%; z-index:1217">
                <a href=""><img src="../assets/pic/etc/buttom2-3.png" class="shiny" style="height:18vmin" /></a>
            </div>
            <!--預約氣球over-->
            <!-- 行程主題介紹-->
            <div id="tua" class="w-100">
                <div style="border-bottom:rgba(0,0,0,1); border-bottom-width:medium">
                </div>
                <div id="banner" style="background-size:cover; background-repeat:no-repeat">
                    <div style="background-color:rgba(0,0,0,0.2); padding-top:12vh">
                        <h1 id="service_title"></h1>
                        <hr />
                        <br />
                    </div>
                </div>
                <!--------------------------------------------->
                <div class="row" style="background-color: rgba(255,255,255,0.7)">
                    <div class="col-12 col-md-8 offset-md-2">
                        <h2 id="intro" style="text-align:center; margin-top:5vmin">
                        </h2>
                    </div>
                </div>
                <!--1-->
                <!--ギャラリー-->
                <div class="row p-3" style="background-color: rgba(255,255,255,1)">
                    <div class="srf" id="a1">
                        <ul>
                        </ul>
                    </div>
                </div>
                <!--ギャラリー-->
                <!-- 値段-->
                <!-- <div class="container"> -->
                <div class="row" style="padding-top:3vmin; padding-bottom:3vmin">
                    <div class="col-md-8 col-12 offset-md-2">
                        <h3 class="b2">&nbsp;値段一覧表</h3>
                        <hr style="border-color:#666" />
                        <h2>料金</h2>
                        <h4 style="float:right;">元＝TWD／台湾ドル</h4>
                        <div style="clear:both;"></div>
                        <div class="table">
                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-12">対象</div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-3">人数</div>
                                        <div class="col-9">値段</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-12">大人＆子供<p style="font-size:1vmin; display:inline">(2歳以上)
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8" id="price">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-12">幼児
                                            <p style="font-size:1vmin; display:inline">(0~1歳)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-12">無料</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    ※幼児(0～1歳)は座席のご用意はありません。チャイルドシートをご追加してください。
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- オプション-->
                    <div class="row my-3">
                        <div class="col-md-8 offset-md-2 col-12" style="font-size: 2vmin;">
                            <h2>オプション</h2>
                            <h4>※道路交通法の規定により、4歳未満の幼児を乗車させる場合には、幼児用補助装置（チャイルドシート）の使用が義務づけられています。<br />
                                もしご利用される場合はお知らせ下さい。また同時にお子様の年齢もご確認させてくださいませ。</h4>
                            <div class="table" id="option">
                                <div class="row">
                                    <div class="col-12 col-md-6">オプション</div>
                                    <div class="col-12 col-md-6">値段</div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6>※現在の日本円の値段は2018/4/20の為替レートで計算してます。</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6>時期により、為替レートが変わりますので、決算当日の金額の相違の可能性がございます。ご了承ください。</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <!--スケジュール-->
                <div class="row mb-3">
                    <div class="col-12 col-md-8 offset-md-2">
                        <h3 class="b2">&nbsp;当日のスケジュール</h3>
                        <hr style="border-color:#666" />
                        <div id="service_content">

                        </div>
                    </div>
                </div>
                <!--スケジュールOVER-->
                <!--ギャラリー-->
                <h3 class="mt-4">ギャラリー</h3>
                <h6>クリックすると、他の画像は見えます</h6>
                <div class="row mb-4">
                    <div id="gallery2" class="container_mk2">
                    </div>
                </div>
                <div class="row">
                    <div class="name">
                        <p></p>
                    </div>
                </div>
                <!--ギャラリーover-->
                <div class="my-4 container">
                    <div id="remark" class="p-5" style="border:3px #FF0000 double;">
                        <h3>お申込み前の注意事項</h3>
                        <h6 class="bb mt-3">＜参加前、参加時必要事項＞</h6>
                        <h6 id="service_remark1" style="text-align:left"></h6>
                        <h6 class="bb mt-4">＜備考・その他＞</h6>
                        <h6 id="service_remark1" style="text-align:left"> </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php
require_once 'footer.php';
?>
</body>
<script>
<?php
if (isset($_GET['id'])) {
    echo "var id = '{$_GET['id']}';\n";
}
?>
var g = new gallery();
$(function() {
    init();
});

function init() {
    $.post('admin/api.php?do=service_show', {
            id
        },
        function(result) {
            $('body').append(result);
            $('#a1').scrollForever({
                delayTime: 30,
            });
            var name = $('.container_mk2').children('img').first().attr('alt');
            $('.name p').html(name);
            g.run();
        }
    )
}
</script>

</html>