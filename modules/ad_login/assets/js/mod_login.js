$(document).ready(function(){
    //first load
    modLogin.run(false);
});

var modLogin = {
    handel: function(){
        $(document).on('click','.btn-login',function(){
            $('.alert').remove();
            var $valid = $("#frm_login").valid();
            if(!$valid) {
                $validator.focusInvalid();
                $("#frm_login").find('.form-group').addClass('has-error').find('input.form-control').addClass('error');

                e.preventDefault();
                /*return false;*/
            }
            $('#password_md5').val($.md5($('#password_input').val()));
        });


        /*$('#username').focus(function(){
            $(this).closest('.form-group').removeClass('has-error').find('label.error').remove();
        });*/

        var $validator = $("#frm_login").validate({
            focusInvalid: false,
            onkeyup: function(element,event){
               /* var $valid = $("#formRegister").validate().element(element);
                if(!$valid){
                    $('.btn-next').attr('disabled', 'disabled');
                    $(element).closest('.form-group').removeClass('has-error').find('.error').remove();
                }*/
            },
            keypress : true,
            onfocusout: function(element, event) {
                this.element(element);
                $('span.error').closest('.form-group').removeClass('has-error');
                $('span.error').remove();

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
                password_input: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: "Tên đăng nhập không được để trống."
                },
                password_input: {
                    required: "Mật khẩu không được để trống."
                }
            }
        });


    },
    setup: function(){
        this.handel();
    },
    run: function(){
        this.setup();
    }
}