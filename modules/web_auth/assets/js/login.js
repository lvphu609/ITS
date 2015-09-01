
$(document).ready(function(){
    var url = $('#hidUrl').val();
    $.backstretch([
        url + "modules/web_auth/assets/img/backgrounds/1.jpg"
    ], {duration: 3000, fade: 750});

    var $validator = $("#formLogin").validate({
            focusInvalid: false,
            onkeyup: false,
            onfocusout: function(element, event) {

            },
            onfocusin: function(element, event) {
                $(element).closest('.form-group').removeClass('has-error').find('label.error').remove();
                $(element).removeClass('error');
            },
            ignore: "",
            rules: {
                username: {
                    required: true
                },
                md5_password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: "Tên đăng nhập không được để trống."
                },
                md5_password: {
                    required: "Mật khẩu không được để trống."
                }
            }
        });


    $(document).on('click','#btn-login',function(e){
        $('.alert').remove();
        var $valid = $("#formLogin").valid();
        if(!$valid) {
            $validator.focusInvalid();
            e.preventDefault();
            /*return false;*/
        }

        $('#password').val($.md5($('#md5_password').val()));
    });

    $('#username').attr('autocomplete','off');
    $('#md5_password').val();

    $(document).ready(function(){
        $('#formLogin').on( 'focus', ':input', function(){
            $(this).attr( 'autocomplete', 'off' );
        });
    });
});
