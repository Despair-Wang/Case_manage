var gallery = function(){
    this.run = function(){
        var interval;
        $('.container_mk2 img').click(function cover() {
            // console.log('click');
            $(this).addClass('zoom').fadeOut(700, append);
            function append() {
                $(this).removeClass('zoom').appendTo('.container_mk2').show();
                var name = $('.container_mk2').children('img').first().attr('alt');
                $('.name p').text(name);
            }
        });

        function auto() {
            var play = $('.container_mk2').children('img').first();
            play.addClass('zoom').fadeOut(700, append);
            function append() {
                $(this).removeClass('zoom').appendTo('.container_mk2').show();
                var name = $(this).parent().children('img').first().attr('alt');
                $('.name p').text(name);
            }
            interval = setTimeout(auto, 5000);
        }

        $('.container_mk2 img').hover(
            function () {
                stopPlay();
            },
            function () {
                interval = setTimeout(auto, 5000);
            }
        );

        function stopPlay() {
            clearTimeout(interval);
        }
        auto();
    }
};
