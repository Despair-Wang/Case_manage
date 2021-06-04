function check_ok(target) {
    $(target).closest("h5").after('<span class="is_checked"><i class="fa fa-check"></i></span>');
}

function set_error(target, message) {
    $(target).closest(".row").addClass('justify-content-center');
    $(target).closest("div").after(`<p class="error_m">${message}</p>`);
}

function remove_error(target) {
    $(target).focus(function() {
        $(this).closest("div").next(".error_m").remove();
        $(this).closest("h5").next(".is_checked").remove();
    })
}

let mail_format = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/,
    pw_format = /^(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9_@#$%&^*+-/~!=]*$/,
    tel_format = /^09+[0-9]{8}|0+[0-9]{8,9}$/,
    nosp = /^\s+$/;

$('.show_pw').click(function() {
    $(this).children('i').toggleClass('fa-eye fa-eye-slash')
    if ($("#pw").attr('type') == 'password') {
        $("#pw").attr('type', 'text');
    } else {
        $("#pw").attr('type', 'password');
    }
})

$('#name').blur(function() {
    if ($(this).val() == "" || nosp.test($(this).val())) {
        set_error(this, "請輸入姓名");
    } else {
        check_ok(this);
    }
})

$('#pw').blur(function() {
    if ($(this).val() == '') {
        set_error(this, "請輸入密碼");
    } else if (!pw_format.test($(this).val())) {
        set_error(this, "請至少包含一個大寫英文及一個數字，不可使用空格");
    } else if ($(this).val().length < 8) {
        set_error(this, "請輸入8位數以上的密碼");
    } else {
        check_ok(this);
    }
})

$('#mail').blur(function() {
    if ($(this).val() == '') {
        set_error(this, "請輸入電子郵件");
    } else if (!mail_format.test($(this).val())) {
        set_error(this, "請填寫有效的電子郵件格式");
    } else {
        check_ok(this);
    }
})

$('#tel').blur(function() {
    if (!tel_format.test($(this).val()) && $(this).val().length > 1 || nosp.test($(this).val())) {
        set_error(this, "請填寫有效的電話格式，區碼不須加括號");
    } else if ($(this).val().length > 8) {
        check_ok(this);
    }
})

remove_error('#name');
remove_error('#pw');
remove_error("#mail");
remove_error("#tel");
