$(document).ready(function () {
    $('#form-help-confirm').hide();
    $('#form-help').hide();
    $('#form-help-phone').hide();
    // $('#button').prop('disabled', true);
    if($('#action').val() != 0) $('#button').prop('disabled', false);
});

$("#role").ready(function () {
    var role = $("#role").val();
    var select = document.getElementById('project');
    switch (role) {
        case 'ZONE_ADMIN':
            $("#project-text").text("เขต").show();
            getList(role);
            break;
        case 'PROJECT_ADMIN':
            $("#project-text").text("โครงการ").show();
            getList(role);
            break;
        case 'BUILDING_ADMIN':
            $("#project-text").text("อาคาร").show();
            getList(role);
            break;
        default:
            $("#project-text").hide();
            $(select).hide();
            break;
    }


});

$("#role").change(function () {
    var role = $("#role").val();
    var select = document.getElementById('project');
    switch (role) {
        case 'ZONE_ADMIN':
            $("#project-text").text("เขต").show();
            $(select).show();
            getList(role);
            break;
        case 'PROJECT_ADMIN':
            $("#project-text").text("โครงการ").show();
            $(select).show();
            getList(role);
            break;
        case 'BUILDING_ADMIN':
            $("#project-text").text("อาคาร").show();
            $(select).show();
            getList(role);
            break;
        default:
            $("#project-text").hide();
            $(select).hide();
            break;
    }
});

function getList(role) {
    $.ajax({
        type: 'GET',
        url: '/api/role?role=' + role,
        // data: { get_param: 'value' },
        dataType: 'json',
        success: function (data) {
            var select = document.getElementById('project');
            $(select).find('option').remove().end()
            for (var i in data) {
                $(select).append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
            }
            console.log(data);
        }
    });
}

var old_email = $('#email').val();
$('#email').focusout(function () {
    console.log(old_email);
    console.log($('#email').val());
    if ($('#email').val() != null && $('#email').val() != "" && $('#email').val().length > 5 && $('#action').val() == 0) {
        checkValidateEmail();
    } else {
        if($('#action').val() != 0){
            if ($('#email').val() != old_email) {
                checkValidateEmail();
            }
        }
        if ($('#email').val().length < 6) {
            $('#form-help').find('i').remove().end()
            $('#form-help').css('color', 'red');
            $('#form-help').text('อีเมลต้องมีอัขระมากกว่า 5 ตัวอักษร');
            $('#button').prop('disabled', true);
        }
        if ($('#email').val() != "" && $('#email').val() != null && $('#action').val() == 0) {
            if ($('#email').val() != old_email) {
                $('#form-help').show();
            }
        } else {
            $('#form-help').hide();
        }
    }

});

$('#confirm_password').focusout(function () {

    var confirm = $('#confirm_password').val();
    var password = $('#password').val();
    if (confirm != password && $('#action').val() == 0) {
        $('#form-help-confirm').show();
        $('#form-help-confirm').css('color', 'red');
        $('#form-help-confirm').text('ยืนยันรหัสผ่านไม่ตรงกัน');
        $('#button').prop('disabled', true);
    } else {
        $('#button').prop('disabled', false);
        $('#form-help-confirm').hide();
    }


});

$('#last_name').keyup(function () {
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    if (first_name != null && first_name != "" && last_name != null && last_name != "") {
        $('#button').prop('disabled', false);
    } else {
        $('#button').prop('disabled', true);
    }
});
$('#first_name').keyup(function () {
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    if (first_name != null && first_name != "" && last_name != null && last_name != "") {
        $('#button').prop('disabled', false);
    } else {
        $('#button').prop('disabled', true);
    }
});
$('#phone').keyup(function () {
    var phone = $('#phone').val();
    if (isNaN(phone)) {
        $('#form-help-phone').show();
        $('#form-help-phone').find('i').remove().end();
        $('#form-help-phone').css('color', 'red');
        $('#form-help-phone').text('เบอร์โทรศัพท์ต้องเป็นตัวเลขเท่านั้น');
        $('#button').prop('disabled', true);
    } else {
        $('#button').prop('disabled', false);
        $('#form-help-phone').hide();
    }

});

function checkValidateEmail() {
    $.ajax({
        type: 'GET',
        url: '/api/validateEmail?email=' + $('#email').val(),
        // data: { get_param: 'value' },
        dataType: 'json',
        success: function (data) {
            $('#form-help').show();
            if (data.success) {
                $('#form-help').find('i').remove().end();
                $('#form-help').css('color', 'green');
                $('#form-help').text('อีเมลนี้สามารถใช้งานได้');
            } else {
                $('#form-help').find('i').remove().end();
                $('#form-help').css('color', 'red');
                $('#form-help').text('อีเมลนี้ถูกใช้งานไปแล้ว');
                $('#button').prop('disabled', true);
            }
            console.log(data.success);
        }
    });
}

if ($('#action').val() == 0) {
    $('#password').prop('required', true);
    $('#confirm_password').prop('required', true);
} else {
    $('#password').prop('required', false);
    $('#confirm_password').prop('required', false)
}