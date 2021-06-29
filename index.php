<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
?>
</head>

<body oncontextmenu="return false" data-spy="scroll" data-offset="0">
    <?php
require_once "menu.php";
?>
    <!--頁面內容-->
    <div id="wrap" style="background-color: rgba(175,255,255,0.7)">
        <div id="conte" style="background-color:rgba(255,255,255,0.6); overflow:hidden">
            <!-- InstanceBeginEditable name="EditRegion3" -->
            <!-- 首頁裝飾 -->
            <h1 style="display:none">日本語チャーター</h1>
            <style>
            .top-m-sha {
                filter: drop-shadow(0px 0px 4px #000);
            }
            </style>
            <section class="textdivider divider">
                <div id="CEC" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#CEC" data-slide-to="0" class="active"></li>
                        <li data-target="#CEC" data-slide-to="1"></li>
                        <li data-target="#CEC" data-slide-to="2"></li>
                        <li data-target="#CEC" data-slide-to="3"></li>
                        <li data-target="#CEC" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active"
                            style=" background-image:url(../assets/pic/toppage/toppic006.jpg); background-repeat:no-repeat; background-size:cover; background-position:center">
                            <table style="height:100%; width:100%">
                                <tbody>
                                    <tr>
                                        <td class="align-middle">
                                            <img src="../assets/pic/toppage/title-top.svg" class="img-fluid top-m-sha"
                                                style="height:60%" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="carousel-item"
                            style=" background-image:url(../assets/pic/toppage/910top4.jpg); background-repeat:no-repeat; background-size:cover; background-position:center; cursor:pointer"
                            onclick="location.href='order-910.html'">
                            <table style="height:100%; width:100%">
                                <tbody>
                                    <tr>
                                        <td class="align-middle">
                                            <img src="../assets/pic/toppage/title-910.svg" class="img-fluid top-m-sha"
                                                style="height:60%" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="carousel-item"
                            style=" background-image:url(../assets/pic/toppage/tainan-top.jpg); background-repeat:no-repeat; background-size:cover; background-position:center; cursor:pointer"
                            onclick="location.href='order-tainan.html'">
                            <table style="height:100%; width:100%">
                                <tbody>
                                    <tr>
                                        <td class="align-middle">
                                            <img src="../assets/pic/toppage/title-tainan.svg"
                                                class="img-fluid top-m-sha" style="height:60%" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="carousel-item"
                            style=" background-image:url(../assets/pic/toppage/hou-top2.jpg); background-repeat:no-repeat; background-size:cover; background-position:center; cursor:pointer"
                            onclick="location.href='c_o-svplan.html'">
                            <table style="height:100%; width:100%">
                                <tbody>
                                    <tr>
                                        <td class="align-middle">
                                            <img src="../assets/pic/toppage/title-svplan.svg"
                                                class="img-fluid top-m-sha" style="height:60%" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="carousel-item"
                            style=" background-image:url(../assets/pic/toppage/bosyuu-top2.jpg); background-repeat:no-repeat; background-size:cover; background-position:center"
                            onclick="location.href='cooper.html'">
                            <table style="height:100%; width:100%">
                                <tbody>
                                    <tr>
                                        <td class="align-middle">
                                            <img src="../assets/pic/toppage/title-bosyuu.svg"
                                                class="img-fluid top-m-sha" style="height:60%" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#CEC" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Prev</span>
                    </a>
                    <a class="carousel-control-next" href="#CEC" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>
            <!-- 首頁裝飾結束-->

            <!--News-->

            <!--緊急新聞用
        <div class="container pt-3">
        <div class="row">
        <div class="col-12 hidden-xs">
        <a href="storm.html">
        <img src="../assets/pic/etc/storm.jpg"  />
        </a>
        </div>
        <div class="col-12 hidden-lg">
        <a href="storm.html">
        <img src="../assets/pic/etc/storm-d.jpg" />
        </a>
        </div>
        </div>
        </div>
        -->

            <!--重大イベント-->

            <!--
        <div class="container pt-3">
        <div class="row">
        <div class="col-12 hidden-xs">
        <a href="c_o-tendoumaturi.html">
        <img src="../assets/pic/toppage/dm/tenndou-maturi-n.jpg"  />
        </a>
        </div>
        <div class="col-12 hidden-lg">
        <a href="c_o-tendoumaturi.html">
        <img src="../assets/pic/toppage/dm/tenndou-maturi-da.jpg" />
        </a>
        </div>
        </div>
        </div>
 -->
            <div id="NEWST" class="container mt-4 p-3"
                style="border:2px solid rgba(0,204,255,1); border-radius:10px; background-color:rgba(255,255,255,0.6); overflow:auto">
                <h2 style="font-weight:800; color:rgba(0,0,0,1); text-shadow:1px 2px 0px #999">NEWS</h2>
                <table class="w-100">
                    <tr class="newswaku">
                        <td style="width:20px;" class="pt-2">
                            <h4 class="tb b2 ali-r" id="fmk_news1-1"></h4>
                        </td>
                        <td class="pt-2">
                            <h4 class="tb pl-2 ali-l" id="fmk_news1-2"></h4>
                        </td>
                    </tr>
                    <tr class="newswaku">
                        <td style="width:20px;" class="pt-2">
                            <h4 class="tb b2 ali-r" id="fmk_news2-1"></h4>
                        </td>
                        <td class="pt-2">
                            <h4 class="tb pl-2 ali-l" id="fmk_news2-2"></h4>
                        </td>
                    </tr>
                    <tr class="newswaku">
                        <td style="width:20px;" class="pt-2">
                            <h4 class="tb b2 ali-r" id="fmk_news3-1"></h4>
                        </td>
                        <td class="pt-2">
                            <h4 class="tb pl-2 ali-l" id="fmk_news3-2"></h4>
                        </td>
                    </tr>
                </table>

            </div>
            <!--news-->
            <!--hot spot-->

            <div id="hs" style="margin-top:3vmin;">
                <p class="h1">HOT SPOT</p>
                <div class="w-100" style="background-color: rgba(255,204,204,0.4); overflow: hidden">
                    <div class="container plr30">
                        <div class="row">
                            <div class="col-sm-3" style="background-color:rgba(255,204,255,0.6)">
                                <table style="height:100%">
                                    <tr>
                                        <td valign="top" class="pt-3">
                                            <img src="../assets/pic/themepic/hs-shintiku.jpg"
                                                class="img-fluid rounded" />
                                            <h4>貸切】新竹＆苗栗</h4>
                                            <h5 class="b2 ali-c thai">ローカル下町巡り</h5>
                                            <h5>台湾にはまだいろいろ魅力的な場所があります。
                                                HAKKA(客家)の文化を感じながら、ローカルな下町の雰囲気を楽しみましょう。</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr">
                                            <div class="p-3">
                                                <h4 class="price">TWD 8,500~</h4>
                                                <button class="btn btn-info" type="button"
                                                    onclick="location.href='order-romanhakka.html'">予約</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-3" style="background-color: rgba(255,255,204,0.6)">
                                <table style="height:100%">
                                    <tr>
                                        <td valign="top" class="pt-3">
                                            <img src="../assets/pic/themepic/hs-ryuusan.jpg"
                                                class="img-fluid rounded" />
                                            <h4>混載】パワースポット</h4>
                                            <h5 class="b2 ali-c thai">（占い付き）</h5>
                                            <h5>【台北霞海城隍廟】＆【艋舺龍山寺】は台北最強の縁結びパワースポット！人生の悩みがある方、恋愛の悩みがある方、一緒にご利益を頂きに参りましょう♡
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr">
                                            <div class="p-3">
                                                <h4 class="price">TWD 2,760</h4>
                                                <button class="btn btn-info" type="button"
                                                    onclick="location.href='c_o-pawaspot.html'">予約</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-3" style="background-color:rgba(255,204,255,0.6)">
                                <table style="height:100%">
                                    <tr>
                                        <td valign="top" class="pt-3">
                                            <img src="../assets/pic/themepic/hs-svplan.jpg" class="img-fluid rounded" />
                                            <h4>混載】ファミリプラン</h4>
                                            <h5 class="b2 ali-c thai">猴硐坑トロッコ体験</h5>
                                            <h5>夏休みの家族旅行はぜひ台湾にお越しください！侯硐坑休閒園區の歴史ある石炭トンネルでは、トロッコの乗車体験ができますし、夏休みの自由研究にピッタリのコースです！（天燈体験付き）
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr">
                                            <div class="p-3">
                                                <h4 class="price">TWD 3,600</h4>
                                                <button class="btn btn-info" type="button"
                                                    onclick="location.href='c_o-svplan.html'">予約</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-3" style="background-color:rgba(255,255,204,0.6)">
                                <table style="height:100%">
                                    <tr>
                                        <td valign="top" class="pt-3">
                                            <img src="../assets/pic/themepic/hs-yilan.jpg" class="img-fluid rounded" />
                                            <h4>貸切】宜蘭(Yilan)に行こうよ！</h4>
                                            <h5 class="b2 ali-c thai">大人の味と手作りタピオカ味わおう♪</h5>
                                            <h5>台湾の有名な飲み物であるタピオカミルクティ作り体験とWORLD WHISKIES
                                                AWARDS最優秀賞受賞のKavalanウィスキーの工場見学・試飲が楽しめる、大人が主役の宜蘭満喫日帰りツアーです。</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr">
                                            <div class="p-3">
                                                <h4 class="price">TWD 9,600</h4>
                                                <button class="btn btn-info" type="button"
                                                    onclick="location.href='order-yilan.html'">予約</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--hot spot-->
            <!--廣告區-->

            <div class="container">
                <div class="row">

                    <div class="col-lg-6 pt-3">
                        <a href="food_yume.html">
                            <img src="../assets/pic/toppage/dm/kusoudm.jpg" class="img-fluid" />
                        </a>
                    </div>

                    <div class="col-lg-6 pt-3">
                        <a href="cooper.html">
                            <img src="../assets/pic/toppage/dm/kyouryoku.jpg" class="img-fluid" />
                        </a>
                    </div>

                </div>
            </div>

            <!--廣告區-->


            <!--Our Driver-->

            <div class="container pt-3">
                <div class="row">
                    <div class="col-lg-12 hidden-xs">
                        <a href="driver_top.html"><img src="../assets/pic/toppage/drivers-top.jpg" /></a>
                    </div>
                </div>
            </div>

            <!--Our Driver-->


            <!--其他服務-->
            <div class="container pt-3">
                <div class="row">

                    <div class="col-lg-4 pt-3">
                        <a href="omiyage_nekorenu.html">
                            <img src="../assets/pic/toppage/top-goods.jpg" class="img-fluid" />
                        </a>
                    </div>

                    <div class="col-lg-4 pt-3">
                        <a href="hotel_evergreen.html">
                            <img src="../assets/pic/toppage/top-hotel.jpg" class="img-fluid" />
                        </a>
                    </div>

                    <div class="col-lg-4 pt-3">
                        <a href="wifi_yunaito.html">
                            <img src="../assets/pic/toppage/top-wifi.jpg" class="img-fluid" />
                        </a>
                    </div>

                </div>
            </div>


            <!--其他服務-->


            <!--行程一覽區-->
            <!--貸切ツアー-->
            <div class="container" id="tua" style="margin-top:6vmin">
                <h4 class="b2" style="color:rgba(102,102,102,1)">貸切ツアー</h4>
                <div class="row pb-4">
                    <div class="col-lg-3">
                        <a href="order-910.html" id="910">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/9_10/910(4).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">九份＆十分</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 3,300</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>「千と千尋の神隠し」の世界が広がるノスタルジックな九份散策と、迫力の十分瀑布観賞、そして願掛け天燈上げで感動のひとときを。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">
                        <a href="order-ieryu.html" id="ieryu">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/raumei/raumei(6).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">九份＆十分＆野柳</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 4,345</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>台湾で最近人気急上昇中の観光スポットー野柳地質公園、様々な奇岩が見られます。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">
                        <a href="order-raumei.html" id="raumei">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/raumei/raumei(2).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">老梅石槽、北海岸線</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 14,600</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>幻い緑に染まる岩「老梅石槽」と野柳地質公園の「野柳女王頭」にご案内する春季限定ツアー。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">
                        <a href="order-romanhakka.html" id="peitai">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/shintiku/shintiku(25).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">新竹＆苗栗下町巡り</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 8,500</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>自力で行くのが難しいエリア、台北とは全く違う雰囲気のHAKKA客家文化が息づく新竹と苗栗は如何ですか。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>


                </div>



                <!---->
                <div class="row pb-4">
                    <div class="col-lg-3">
                        <a href="order-myouri.html" id="ieryu">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/myouri/myouri(14).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">ハロー苗栗(ﾐｬｵﾘｰ)</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 9,900</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>苗栗県では農業が盛んでほのぼのとした雰囲気です。また農村ならではの、心地いい風と地元民の優しさを感じれます。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">
                        <a href="order-taityuu.html" id="taityuu">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/taityuu/taityuu(8).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">台中</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 12,800</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>言葉がわからなくても大丈夫！！チャーター便で行く！日本語専用観光ツアー、台中の人気スポットを日帰り観光。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>


                    <div class="col-lg-3">
                        <a href="order-freeplan.html" id="peitai">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/themepic/freeplan01.jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">フリープラン</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 3,300</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>台湾観光を自分たちだけでフレキシブルに楽しみたい方にピッタリのプランです。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">
                        <a href="order-kuucou.html" id="kuucou">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/kuucou/driver002.jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">空港送迎チャーター</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 1,600</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>Finemakersの専用車チャーターは、ドライバーが日本語を話すので、ツアー中のコミュニケーションも安心、現地の観光情報も聞けますよ。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>


                </div>
                <!---->

                <!---->
                <div class="row">
                    <div class="col-lg-3">
                        <a href="order-yilan.html" id="yilan">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/yilan/yilan(21).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">宜蘭に行こうよ！</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 9,600</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>タピオカミルクティーシェーク作り体験とカバラン限定ウイスキー試飲、日帰り満喫ツアー</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">

                        <a href="order-night910.html" id="taityuu">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/food_umi/food_umi(11).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">夜の九份+十分（夕食「海悦楼」）</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 12,800</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>ノスタルジックな夜の九份と夜の十分へ。夕食は、九份の絶景を望むことができる「海悦楼茶坊」にて。九份と十分の両方を満喫できる貸切ツアーです。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </div>


                    <div class="col-lg-3">

                        <a href="order-tainan.html" id="tainan">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/tainan/tainan(6).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">台南半日観光ツアー</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 8,400</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>赤崁樓、烏山頭ダム、林百貨、台南の魅力が詰まった観光スポットを巡るプランです。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </div>

                    <div class="col-lg-3">

                        <a href="order-takao.html" id="takao">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/takao/takao(6).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">高雄半日観光ツアー</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 8,400</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>蓮池潭、駁二特區、美麗島駅、顔サイズの海之冰のかき氷や、夜市の屋台飯、高雄の魅力が詰まった観光スポットを巡るプランです！</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </div>


                </div>
                <!---->



            </div>
            <!--貸切ツアー-->


            <!--混載ツアー-->

            <div class="container" id="tua" style="margin-top:6vmin">
                <h4 class="b2" style="color:rgba(102,102,102,1)">混載ツアー</h4>
                <div class="row pb-4">
                    <div class="col-lg-3">
                        <a href="c_o-910.html" id="c910">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/9_10/jiufen.jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">九份・十分</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 1,600</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>13時からのグループツアー、人気の九份、十分天燈上げ、十分の滝を6時間で観光！</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">
                        <a href="c_o-gugon.html" id="npm">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/npm/npm(12).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">故宮博物院</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 3,200</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>国立故宮博物院をはじめ、台湾を知るスポットが1日で周ります。※昼食、占い付き。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">
                        <a href="c_o-raumei.html" id="craumei">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/raumei/raumei(2).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">老梅石槽、北海岸線</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 3,800</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>幻い緑に染まる岩「老梅石槽」と野柳地質公園の「野柳女王頭」にご案内する春季限定ツアー。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">
                        <a href="c_o-natsume.html" id="cnatsune">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/myouri/myouri(13).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">紅ナツメ収穫体験</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 3,600</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>今の旬フルーツ、紅ナツメ狩り体験やローゼルジャム作りの体験でき、昼食は台湾ローカル客家料理の苗栗体験混載ツアー。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>


                </div>



                <!---->
                <div class="row">
                    <div class="col-lg-3">
                        <a href="c_o-pawaspot.html" id="cpawa">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/ryusan/ryusan(1).jpg" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">パワースポット</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 2,760</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>台北随一のパワースポットと呼び声の高い【台北霞海城隍廟】＆【艋舺龍山寺】を巡るツアー。※占い付き</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="col-lg-3">

                        <a href="c_o-svplan.html" id="svplan">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/svplan/svplan(13).jpg">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">夏休みファミリプラン</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD　3,600</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>夏休みの家族旅行なら台湾に行きましょう！猴硐坑休閒園区の歴史ある石炭トンネルでトロッコ体験が出来ます。（天燈体験付き）</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </div>


                    <div class="col-lg-3">

                        <a href="c_o-taoendiy.html" id="taoendiy">
                            <table class="tour-list">
                                <tr>
                                    <td style="padding:0px">
                                        <img src="../assets/pic/taoendiy/taoendiy(17).jpg">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tour-ex" valign="top">
                                        <h5 class="b2">桃園DIY満載ツアー</h5>
                                        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD 3,200</h6>
                                        <!--
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        -->
                                        <h6>台北からおよそ一時間ほど行ける桃園、実はカラフルで面白い都市でございます。鮮やかなルートで何色があるか楽しみできるプランでございます。</h6>
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </div>

                    <div class="col-lg-3">
                        <!--
        <a href="*" id="kuucou">
        <table class="tour-list">
        <tr>
        <td style="padding:0px">
        <img src="../assets/pic/kuucou/*">
        </td>
        </tr>
        <tr>
        <td class="tour-ex" valign="top">
		<h5 class="b2">空港送迎チャーター</h5>
        <h6 style="font-weight: 600; color: rgba(0,51,153,1)">From TWD </h6>
        <h6 style="display:inline; color:rgba(255,255,0,1)">★★★★★</h6><h6 style="display:inline">(15)</h6>
        <h6>*</h6>
        </td>
        </tr>
        </table>
        </a>
        -->
                    </div>


                </div>
                <!---->


            </div>

            <!--混載ツアー-->

            <!--行程一覽區 結束-->


            <!-- 主題行程推廣-->




            <!-- 主題行程推廣結束-->

            <!-- InstanceEndEditable -->
        </div>
        <?php
require_once 'footer.php';
?>
    </div>
</body>

<!-- InstanceEnd -->

</html>