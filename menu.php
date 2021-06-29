<nav class="navbar navbar-expand-lg navbar-light fixed-top menu_background set_trans" role="navigation" id="nav">
    <div id="logo">
        <div>
            <img src="assets/pic/logo/logo.svg" class="img-fluid">
        </div>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
        style="background-color: rgba(255,255,255,0.3);">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav flex-md-columns w-100 top_menu">
                <li>
                    <a href="index.html">トップ</a>
                </li>
                <li>
                    <a>貸切ツアー</a>
                    <ul class="sub-menu">
                        <li><a>北台湾</a>
                            <ul class="sub-menu">
                                <li><a href="order-910.html">九份・十分（天燈上げ・滝）</a></li>
                                <li><a href="order-ieryu.html">野柳＋選べる九份・十分</a></li>
                                <li><a href="order-night910.html">夜の九份+十分（夕食「海悦楼」）</a></li>
                                <li><a href="order-ryusan.html">パワースポット巡り</a></li>
                                <li><a href="order-raumei.html">老梅石槽、北海岸線</a></li>
                                <li><a href="order-romanhakka.html">新竹＆苗栗下町巡り</a></li>
                                <li><a href="order-myouri.html">苗栗公館巡り</a></li>
                            </ul>
                        </li>
                        <li><a>中台湾</a>
                            <ul class="sub-menu">
                                <li><a href="order-taityuu.html">台中スポット巡り</a></li>
                            </ul>
                        </li>
                        <li><a>東台湾</a>
                            <ul class="sub-menu">
                                <li><a href="order-yilan.html">宜蘭日帰りツアー</a></li>
                            </ul>
                        </li>
                        <li><a>南台湾</a>
                            <ul class="sub-menu">
                                <li><a href="order-tainan.html">台南半日観光ツアー</a></li>
                                <li><a href="order-takao.html">高雄半日観光ツアー</a></li>
                            </ul>
                        </li>
                        <li><a href="order-freeplan.html">フリープラン</a></li>
                        <li><a href="order-kuucou.html">空港送迎チャーター</a></li>
                    </ul>
                </li>
                <li>
                    <a>おもてなし</a>
                    <ul class="sub-menu">
                        <li><a href="driver_top.html">Our ドライバーズ</a>
                        <li><a href="cooper.html">協力者募集</a>
                    </ul>
                </li>
                <li><a href="f_qaa.html">問い合わせ</a></li>
                <li><a href="f_qaa.html">LOGIN</a></li>
            </ul>
        </div>
    </div>
</nav>
<script>
$(function() {
    $(window).scroll(function() {
        let here = $(this).scrollTop();
        if (here == 0) {
            $('nav').addClass('set_trans').removeClass('set_white');
        } else {
            $('nav').addClass('set_white').removeClass('set_trans');
        }
    })
})
</script>