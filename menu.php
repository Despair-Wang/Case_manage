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
                    <ul class="sub-menu" id="service_list">
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
    $.ajax({
        url: 'admin/api.php?do=get_menu',
        success: function(result) {
            $('#service_list').html(result);
            // console.log(result);
        }
    })
})
</script>