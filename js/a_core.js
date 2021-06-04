$(document).ready(function () {
    let open = false;
    $('.sb_btn').click(function () {
        let bar1 = $('.sb_btn ul li:first-child');
        let bar2 = $('.sb_btn ul li:last-child');
        if (!open) {
            $('.sidebar').css({ animation: 'sb_out 0.3s linear', left: '0px' });
            $('.sb_btn ul li').css('display', 'none');
            bar1.css({ display: 'block', transform: 'rotate(45deg) translate(9px, 12px)' });
            bar2.css({ display: 'block', transform: 'rotate(-45deg) translate(-3px, 0px)' });
            open = true;
        } else {
            $('.sidebar').css({ animation: 'sb_in 0.3s linear', left: '-350px' });
            $('.sb_btn ul li').css('display', 'block');
            bar1.css('transform', '');
            bar2.css('transform', '');
            open = false;
        }
    });

});
