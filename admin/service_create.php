<!DOCTYPE html>
<html lang="en">

<head>
    <?php
require_once "head.php";
?>
    <script src="js/croppie.js"></script>
    <script src="js/lc_switch.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/lc_switch.css" />
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
                                <h5 id='id'></h5>
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
                                <input type="number" name="times" id="times">
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
                                        <div id="newBanner"></div>
                                        <div class="col-12">
                                            <input type="hidden" id="banner_post">
                                            <input type="file" name="banner" id="banner" class="my-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>服務形象圖</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="newIndex"></div>
                                        <div class="col-12">
                                            <input type="hidden" id="index_post">
                                            <input type="file" name="index" id="index" class="my-3">
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
                                <div id="intro" class="textarea" contenteditable="true" placeholder="請輸入行程簡介"></div>
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
                                            <input class="number" type="text">
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
                                    <a id="add_price" class="btn btn_wt f_end my-3">增加欄位</a>
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
                                                <div class="textarea step_content" contenteditable="true"
                                                    placeholder="請輸入地點簡介"></div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label>相關圖片</label>
                                                <div class="over_hide"></div>
                                                <input id="step_pic-1" class="step_pic" type="file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <a id="add_content" class="btn btn_wt f_end my-3">增加欄位</a>
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
                                                <input name="g1" id="gallery-1" class="gallery" type="file">
                                                <label>請輸入圖片說明</label><input class="gallery_alt" type="text" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-12 my-3">
                                        <a id="add_gallery" class="btn btn_wt f_end my-3">增加欄位</a>
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
                                <select id="remark" class="select_wt"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>推廣選項</h5>
                            </div>
                            <div class="col-9">
                                <div class="row line_align my-2">
                                    <div class="col-12">
                                        <label for="hot">熱推行程</label>
                                        <input type="checkbox" class="w-auto" id="hot">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h5>服務開放狀態</h5>
                            </div>
                            <div class="col-9">
                                <div class="row line_align my-2">
                                    <div class="col-12">
                                        <label for="enable">開放</label>
                                        <input type="checkbox" class="w-auto" id="enable">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- control-button -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <button id="submit" class="btn case_ctrl">
                                <h4>新增</h4>
                            </button>
                        </div>
                        <div class="col-4">
                            <button id="delete" class="btn case_ctrl">
                                <h4>刪除</h4>
                            </button>
                        </div>
                        <div class="col-4">
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
                <div id="oldBanner"></div>
                <div id="oldIndex"></div>
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
    <div>
        <input type="hidden" name="gallery_temp" id="gallery_temp">
        <input type="hidden" name="step_pic_temp" id="step_pic_temp">
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
if (isset($_POST['id'])) {
    echo <<<upd
    var id = '{$_POST['id']}',
    update = true;
    upd;
}
?>
$(function() {
    if (update) {
        $('#submit').children().html('更新');
        service_get();
    } else {
        add_gallery();
        add_gallery();
        add_gallery();
    }
    get_options();
    get_remark();
    $('#submit').click(function() {
        submit();
    });
    $('#delete').click(function() {
        deleted();
    });
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
}

function get_options() {
    $.ajax({
        url: 'api.php?do=options_get',
        type: 'post',
        success: function(result) {
            $('#options').html(result);
            $('input[type=checkbox]').lc_switch();
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
                // console.log('get pic');
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
                // console.log(img);
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
                <input class="number" type="text">
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
                <div class="textarea step_content" contenteditable="true" placeholder="請輸入地點簡介"></div>
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
    add_gallery();
})

function add_gallery() {
    gallery_count += 1;
    let content = `
    <div class="row mb-2">
        <div class="col-12 col-md-5">
            <div class="over_hide"></div>
            <input id="gallery-${gallery_count}" class="gallery" type="file">
            <label>請輸入圖片說明</label><input class="gallery_alt" type="text" value="">
        </div>
    </div>`;
    $('#gallery').append(content);
    init();
}

function submit() {
    la.l.fadeIn();
    let service = $('#service').val(),
        times = $('#times').val(),
        banner_post = $('#banner_post').val(),
        index_post = $('#index_post').val(),
        intro = $('#intro').html(),
        number = new Array(),
        price = new Array(),
        options = new Array(),
        step_title = new Array(),
        step_time = new Array(),
        step_content = new Array(),
        gallery_alt = new Array(),
        remark = $('#remark').val(),
        hot = $('#hot').prop('checked'),
        enable = $('#enable').prop('checked');
    la.b.click(function() {
        la.close_load();
    })
    if (service == '') {
        la.show_mes('請輸入服務項目名稱');
        return;
    }
    if (banner_post == '') {
        la.show_mes('請選擇一張橫幅，不然前端會怨你');
        return;
    }
    if (index_post == '') {
        la.show_mes('請選擇一張形象圖，不然前端會怨你');
        return;
    }
    if (intro == '') {
        la.show_mes('請輸入服務簡介，不然企劃會唸你');
        return;
    }
    if (gallery_array.length < 4) {
        la.show_mes('請至少選擇四張相關圖片，不然前端會怨你');
        return;
    }

    let count = 0;
    $('.number').each(function() {
        if (count == 0 && $(this).val() == '') {
            la.show_mes('請至少輸入一組人數');
            return;
        } else if ($(this).val() != '') {
            number.push($(this).val());
            count++;
        }
    })
    count = 0;
    $('.price').each(function() {
        if (count == 0 && $(this).val() == '') {
            la.show_mes('請至少輸入一組價格');
            return;
        } else if ($(this).val() != '') {
            price.push($(this).val());
            count++;
        }
    })
    $('.options').each(function() {
        if ($(this).prop('checked')) {
            options.push($(this).val());
        }
    })
    if (options.length < 1) {
        options.push('no_Option');
    }
    count = 0;
    $('.step_title').each(function() {
        if (count == 0 && $(this).val() == '') {
            la.show_mes('請至少輸入一個行程標題');
            return;
        } else if ($(this).val() != '') {
            step_title.push($(this).val());
            count++;
        }
    })
    $('.step_time').each(function() {
        if ($(this).val() == '') {
            step_time.push('-');
        } else {
            step_time.push($(this).val());
        }
    })
    $('.step_content').each(function() {
        if ($(this).html() == '') {
            step_content.push('-');
        } else {
            step_content.push($(this).html());
        }
    })
    $('.gallery_alt').each(function() {
        let v = $(this).val();
        if (v == '') {
            gallery_alt.push('当地風景写真');
        } else {
            gallery_alt.push(v);
        }
    })
    if (update) {
        $.ajax({
            url: 'api.php?do=service_set',
            type: 'post',
            data: {
                id: $('#id').html(),
                service: service,
                times: times,
                banner: banner_post,
                index: index_post,
                intro: intro,
                number: number,
                price: price,
                options: options,
                step_title: step_title,
                step_time: step_time,
                step_content: step_content,
                step_pic: step_pic_array,
                gallery: gallery_array,
                gallery_alt: gallery_alt,
                remark: remark,
                hot: hot,
                enable: enable
            },
            success: function(result) {
                if (result == 'UPDATED') {
                    la.show_mes('服務項目更新成功');
                    la.b.click(function() {
                        la.close_load();
                    })
                    // console.log('done');
                } else {
                    la.show_mes('服務項目更新失敗');
                    la.b.click(function() {
                        la.close_load();
                    })
                    console.log('FAIL');
                    console.log(result);
                }
            }
        })
    } else {
        $.ajax({
            url: 'api.php?do=service_insert',
            type: 'post',
            data: {
                service: service,
                times: times,
                banner: banner_post,
                index: index_post,
                intro: intro,
                number: number,
                price: price,
                options: options,
                step_title: step_title,
                step_time: step_time,
                step_content: step_content,
                step_pic: step_pic_array,
                gallery: gallery_array,
                gallery_alt: gallery_alt,
                remark: remark,
                hot: hot,
                enable: enable
            },
            success: function(result) {
                if (result == 'INSERTED') {
                    la.show_mes('服務項目新增成功');
                    la.b.click(function() {
                        la.close_load();
                        go_back();
                    })
                    // console.log('done');
                } else {
                    la.show_mes('服務項目新增失敗');
                    la.b.click(function() {
                        la.close_load();
                    })
                    console.log('FAIL');
                    console.log(result);
                }
            }
        })
    }
}

function deleted() {
    la.l.fadeIn();
    $.post('api.php?do=service_delete', {
        id: id
    }, function(result) {
        if (result == 'DELETED') {
            la.show_mes('服務刪除成功');
            la.b.click(function() {
                la.close_load();
                go_back();
            })
        } else {
            la.show_mes('服務刪除失敗啦');
            la.b.click(function() {
                la.close_load();
            })
        }
    })
}

function service_get() {
    $.ajax({
        url: 'api.php?do=service_get',
        type: 'post',
        data: {
            id: id
        },
        success: function(result) {
            $('body').append(result);
            let set_data = setTimeout(() => {
                if ($('#gallery_temp').val() != '' && $('#step_pic_temp').val() != '') {
                    gallery_array = $('#gallery_temp').val().split('|');
                    step_pic_array = $('#step_pic_temp').val().split('|');
                    init();
                } else {
                    console.log('no data');
                    set_data;
                }
            }, 100);
        }
    })
}

function go_back() {
    location.href = 'service_list.php';
}

(function($) {
    var crop_width = 1100,
        crop_height = 380,
        crop_type = 'square',
        preview_width = 1100,
        preview_height = 380,
        compress_ratio = 0.5,
        img_type = 'png',
        target = '';
    var bannerCrop = $('#oldBanner').croppie({
            viewport: {
                width: 1100,
                height: 380,
                type: crop_type,
            },
            boundary: {
                width: 1100,
                height: 380,
            },
        }),
        indexCrop = $('#oldIndex').croppie({
            viewport: {
                width: 300,
                height: 300,
                type: crop_type,
            },
            boundary: {
                width: 300,
                height: 300,
            }
        });

    function read_file(input) {
        var oldImg = new Image(),
            file;
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
                if (target == 'banner') {
                    bannerCrop.croppie('bind', {
                        url: oldImgDataUrl,
                    });
                } else if (target == 'index') {
                    indexCrop.croppie('bind', {
                        url: oldImgDataUrl,
                    });
                }
            };
            reader.readAsDataURL(file);
        } else {
            alert('請上傳正確的圖片檔案');
        }
    }

    function display_cropImg(src) {
        var html = `<img src="${src}" class="img-fluid"/>`;
        if (target == 'banner') {
            $('#newBanner').html(html);
            $('#banner_post').val(src);
        } else if (target == 'index') {
            $('#newIndex').html(html);
            $('#index_post').val(src);
        }
        $("#oldImg_frame").css('display', 'none');
    }

    $('#banner').on('change', function() {
        $("#oldImg_frame").css('display', 'flex')
        $('#oldIndex').hide();
        $('#oldBanner').show();
        target = 'banner';
        read_file(this);
    });

    $('#index').on('change', function() {
        $("#oldImg_frame").css('display', 'flex')
        $('#oldBanner').hide();
        $('#oldIndex').show();
        target = 'index';
        read_file(this);
    });

    $('#crop_img').on('click', function() {
        if (target == 'banner') {
            bannerCrop.croppie('result', {
                    type: 'canvas',
                    format: img_type,
                    quality: compress_ratio,
                })
                .then(function(src) {
                    display_cropImg(src);
                });
        } else if (target == 'index') {
            indexCrop.croppie('result', {
                    type: 'canvas',
                    format: img_type,
                    quality: compress_ratio,
                })
                .then(function(src) {
                    display_cropImg(src);
                });
        }

        $("#oldImg_frame").css('display', 'none')
        $('#oldIBanner').hide();
        $('#oldIndex').hide();
    });

    $('#cancel').on('click', function() {
        $("#oldImg_frame").css('display', 'none')
        $('#oldIBanner').hide();
        $('#oldIndex').hide();
    })
})(jQuery);
</script>

</html>