<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
?>
    <script src="js/croppie.js"></script>

</head>

<body>
    <div class="content">
        <!-- 側邊控制欄 -->
        <?php
require_once "sidebar.php";
if (isset($_POST['serial'])) {
    set_title("服務項目更新");
    set_h1("CASE UPDATE");
} else {
    set_title("新增服務項目");
    set_h1("CASE INSERT");
}
?>
        <div id="back" onclick="go_back()">
            <div>BACK</div>
            <div></div>
            <div></div>
        </div>
        <!-- 主題內文 -->
        <div class="container">
            <div class="case_info">
                <div id="serial_block" class='row service_block'>
                    <div class='col-12'>
                        <div class='row'>
                            <div class='col-3'>
                                <h5>服務編號</h5>
                            </div>
                            <div class='col-9'>
                                <h5 id='serial'></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-1 -->
                <div class="row service_block">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>服務項目</h5>
                            </div>
                            <div class="col-9" style="display: block;">
                                <label>名稱</label>
                                <input type="text" name="service" id="service">
                                <label>總時長</label>
                                <input type="number" name="time" id="time">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>首頁大圖</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="newImg"></div>
                                        <div class="col-12">
                                            <input type="hidden" id="banner_post">
                                            <input type="file" name="banner" id="banner">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- block-2 -->
                <div class="row service_block">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>服務簡介</h5>
                            </div>
                            <div class="col-9 my-4">
                                <!-- <h5 class="w-100"> -->
                                <textarea class="w-100" id="intro" name="intro"></textarea>
                                <!-- </h5> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>價格</h5>
                            </div>
                            <div class="col-9">
                                <div id="price">
                                    <div class="row">
                                        <div class="col-9 col-md-4">
                                            <input class="number" type="number" min="1">
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <span>人</span>
                                        </div>
                                        <div class="col-9 col-md-4">
                                            <input class="price" type="number" min="0">
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <span>元</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <a id="add_price" class="btn btn-info f_end">增加欄位</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>額外服務</h5>
                            </div>
                            <div class="col-9">
                                <div id="options" class="row line_align my-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>行程介紹</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div id="service_content" class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-md-8">
                                                <label>地點名稱1</label>
                                                <input class="step_title" type="text">
                                                <label>時長</label>
                                                <input class="step_time" type="text">
                                                <label>地點簡介</label>
                                                <textarea class="w-100 step_content"></textarea>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label>相關圖片</label>
                                                <div class="over_hide"></div>
                                                <input id="step_pic-1" class="step_pic" type="file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <a id="add_content" class="btn btn-info f_end">增加欄位</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>相關圖片</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div id="gallery" class="col-12">
                                        <div class="row mb-2">
                                            <div class="col-12 col-md-5">
                                                <div class="over_hide"></div>
                                                <input id="gallery-1" class="gallery" type="file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my-3">
                                        <a id="add_gallery" class="btn btn-info f_end">增加欄位</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>備註</h5>
                            </div>
                            <div class="col-9 vertical_center">
                                <select id="remark"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>備註</h5>
                            </div>
                            <div class="col-9">
                                <div class="row line_align my-2">
                                    <div class="col-12">
                                        <input type="checkbox" class="w-auto" id="hot"><label for="hot">熱推行程</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- control-button -->
            <form name="back" action="case_info.php" method="POST">
                <input type="hidden" name="serial" id="serial_back">
            </form>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <button id="submit" class="btn case_ctrl" onclick="submit()">
                                <h4>新增</h4>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn case_ctrl" type="reset">
                                <h4>重填</h4>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="oldImg_frame">
        <div class="row">
            <div class="col-12">
                <div id="oldImg">
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center align-self-center">
                    <label id="crop_img" class="btn case_ctrl w_auto mr-3">
                        <i class="fa fa-scissors"></i>&emsp;剪裁圖片
                    </label>
                    <label id="cancel" class="btn case_ctrl w_auto">
                        取消
                    </label>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
require_once "footer.php";
?>
</body>
<script>
var la = new loading_anime(),
    update = false,
    gallery_array = new Array(),
    step_pic_array = new Array(),
    canvas = document.createElement('canvas'),
    context = canvas.getContext('2d'),
    new_width = 640,
    new_height;
<?php
if (isset($_POST['serial'])) {
    echo <<<upd
    serial = '{$_POST['serial']}';
    update = true;
    get_date("{$_POST['serial']}");
    upd;
}
?>
$(function() {
    if (update) {
        $('#submit').children().html('更新');
    }
    init();
});



function init() {
    $('.step_pic,.gallery').on('change', function(e) {
        // let pic = new Image();
        if (e.target === this) {
            let id = $(this).attr('id');
            let pic = read_file(this, id);
            $(this).prev().html(pic);
        }
    })
    get_options();
    get_remark();
}

function get_options() {
    $.ajax({
        url: 'api.php?do=options_get',
        type: 'post',
        success: function(result) {
            $('#options').html(result);
        }
    })
}

function get_remark() {
    $.ajax({
        url: 'api.php?do=remark_get',
        type: 'post',
        success: function(result) {
            $('#remark').html(result);
        }
    })
}

function read_file(input, id) {
    var file;
    let img = new Image();
    if (input.files && input.files[0]) {
        file = input.files[0];
    }
    if (file.type.indexOf('image') == 0) {
        var reader = new FileReader();
        reader.onload = function(e) {
            t = e.target.result;
            img.src = t;
            img.onload = function() {
                let origin_width = img.width,
                    origin_height = img.height;
                if (origin_width >= new_width) {
                    new_height = Math.round(origin_height * (new_width / origin_width));
                } else {
                    new_height = Math.round(origin_height * (origin_width / new_width));
                }
                canvas.width = new_width;
                canvas.height = new_height;
                context.clearRect(0, 0, new_width, new_height);
                context.drawImage(img, 0, 0, new_width, new_height);
                let p = canvas.toDataURL();
                let target = id.split('-');
                id = parseInt(target[1]) - 1;
                type = target[0];
                img.setAttribute('class', 'img-fluid');
                if (type == 'gallery') {
                    gallery_array[id] = p.toString();
                } else {
                    step_pic_array[id] = p.toString();
                }
            }
        }
    }
    reader.readAsDataURL(file);
    return img;
}


$('#add_price').click(function() {
    let content =
        `<div class="row">
            <div class="col-9 col-md-4">
                <input class="people_number" type="number" min="1">
            </div>
            <div class="col-3 col-md-2">
                <span>人</span>
            </div>
            <div class="col-9 col-md-4">
                <input class="price" type="number" min="0">
            </div>
            <div class="col-3 col-md-2">
                <span>元</span>
            </div>
        </div>`;
    $('#price').append(content);
})

let content_count = 1;
$('#add_content').click(function() {
    content_count += 1;
    let content =
        `<hr style="border-top: 1px solid #999;">
        <div class="row">
            <div class="col-12 col-md-8">
                <label>地點名稱${content_count}</label>
                <input class="step_title" type="text">
                <label>時長</label>
                <input class="step_time" type="text">
                <label>地點簡介</label>
                <textarea class="w-100 step_content"></textarea>
            </div>
            <div class="col-12 col-md-4">
                <label>相關圖片</label>
                <div class="over_hide"></div>
                <input id="step_pic-${content_count}" class="step_pic" type="file">
            </div>
        </div>`;
    $('#service_content').append(content);
    init();
})

let gallery_count = 1;
$('#add_gallery').click(function() {
    gallery_count += 1;
    let content = `
    <div class="row mb-2">
        <div class="col-12 col-md-5">
            <div class="over_hide"></div>
            <input id="gallery-${gallery_count}" class="gallery" type="file">
        </div>
    </div>`;
    $('#gallery').append(content);
    init();
})

function submit() {
    // la.l.fadeIn();
    let service = $('#service').val(),
        time = $('#time').val(),
        banner_post = $('#banner_post').val(),
        intro = $('#intro').val(),
        number = new Array(),
        price = new Array(),
        options = new Array(),
        step_title = new Array(),
        step_time = new Array(),
        step_content = new Array(),
        remark = $('#remark').val(),
        hot = ($('#hot').val()) ? (true) : (false);
    $('.number').each(function() {
        number.push($(this).val());
    })
    $('.price').each(function() {
        price.push($(this).val());
    })
    $('.options').each(function() {
        options.push($(this).val());
    })
    $('.step_title').each(function() {
        step_title.push($(this).val());
    })
    $('.step_time').each(function() {
        step_time.push($(this).val());
    })
    $('.step_content').each(function() {
        step_content.push($(this).val());
    })
    $.ajax({
        url: 'api.php?do=service_insert',
        type: 'post',
        data: {
            service: service,
            time: time,
            banner: banner_post,
            intro: intro,
            number: number,
            price: price,
            options: options,
            step_title: step_title,
            step_time: step_time,
            step_content: step_content,
            step_pic: step_pic_array,
            gallery: gallery_array,
            remark: remark,
            hot: hot
        },
        success: function(result) {
            if (result == 'INSERTED') {
                // la.show_mes('服務項目新增成功');
                // la.b.click(function() {
                // la.close_load();
                // })
                console.log('done');
            } else {
                // la.show_mes('服務項目新增失敗');
                // la.b.click(function() {
                // la.close_load();
                // })
                console.log('FAIL');
                console.log(result);
            }
        }
    })
}

function go_back() {
    document.forms['back'].submit();
}

(function($) {
    var crop_width = 1100,
        crop_height = 380,
        crop_type = 'square',
        preview_width = 1100,
        preview_height = 380,
        compress_ratio = 0.5,
        img_type = 'png',
        oldImg = new Image(),
        file;
    var myCrop = $('#oldImg').croppie({
        viewport: {
            width: crop_width,
            height: crop_height,
            type: crop_type,
        },
        boundary: {
            width: preview_width,
            height: preview_height,
        },
    });

    function read_file(input) {
        if (input.files && input.files[0]) {
            file = input.files[0];
        } else {
            alert('抱歉，您的瀏覽器不支援此功能');
            return;
        }

        if (file.type.indexOf('image') == 0) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var oldImgDataUrl = e.target.result;
                oldImg.src = oldImgDataUrl;
                myCrop.croppie('bind', {
                    url: oldImgDataUrl,
                });
            };

            reader.readAsDataURL(file);
        } else {
            alert('請上傳正確的圖片檔案');
        }
    }

    function display_cropImg(src) {
        var html = `<img id="pic" src="${src}" class="img-fluid"/>`;
        $('#newImg').html(html);
        // $('#newImg').css('padding', '25px');
        $('#banner_post').val(src);
        $("#oldImg_frame").css('display', 'none');
    }

    $('#banner').on('change', function() {
        $("#oldImg_frame").css('display', 'flex')
        $('#oldImg').show();
        read_file(this);
    });

    $('#crop_img').on('click', function() {
        myCrop.croppie('result', {
                type: 'canvas',
                format: img_type,
                quality: compress_ratio,
            })
            .then(function(src) {
                display_cropImg(src);
            });
        $("#oldImg_frame").css('display', 'none')
        $('#oldImg').hide();
    });

    $('#cancel').on('click', function() {
        $("#oldImg_frame").css('display', 'none')
        $('#oldImg').hide();
    })
})(jQuery);
</script>

</html>