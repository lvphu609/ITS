searchVisible = 0;
transparent = true;

$(document).ready(function(){
    var url = $('#hidUrl').val();
    $.backstretch([
        url + "modules/web_auth/assets/img/backgrounds/1.jpg"
    ], {duration: 3000, fade: 750});

    /*$("#datetimepicker").datetimepicker({
        format: "dd-mm-yyyy",
        pickTime: false
    });*/
    $("#datetimepicker").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        language:  'vi',
        /*linkField: "parram-date",*/
    });
});

$(document).ready(function(){

    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();

    jQuery.validator.setDefaults({
        highlight: function (element, errorClass, validClass) {
            /*if (element.type === "radio") {
                this.findByName(element.name).addClass(errorClass).removeClass(validClass);
            } else {
                $(element).closest('.form-group').removeClass('has-success has-feedback').addClass('has-error has-feedback');
                $(element).closest('.form-group').find('i.fa').remove();
                $(element).closest('.form-group').append('<i class="fa fa-exclamation fa-lg form-control-feedback"></i>');
            }*/
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            /*if (element.type === "radio") {
                this.findByName(element.name).removeClass(errorClass).addClass(validClass);
            } else {
                $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
                $(element).closest('.form-group').find('i.fa').remove();
                $(element).closest('.form-group').append('<i title="ádasd" class="fa fa-check fa-lg form-control-feedback"></i>');
            }*/
            $(element).closest('.form-group').removeClass('has-error');
        }
    });

    jQuery.validator.addMethod("emailCustom", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element ) || /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/i.test( value );
        /*
         /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/
        */
    }, 'Please enter a valid email address.');

    jQuery.validator.addMethod(
        "greaterThan",
        function(value, element, params) {
            var current_date = $(params).val();

            var date_input = value.split("-");
            var date_current = current_date.split("-");

            var x = new Date(date_input[2],date_input[1],date_input[0]);
            var y = new Date(date_current[2],date_current[1],date_current[0]);

            if(x<y){
                return true;
            }else{
                return false;
            }
        },
        'Must be greater than {0}.'
    );

    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "No space please and don't leave it empty");

    jQuery.validator.addMethod(
        "DateFormat",
        function(value, element) {
            // put your own logic here, this is just a (crappy) example
            return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);

            /*
             /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
            */
        },
        "Please enter a date in the format dd-mm-yyyy."
    );

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]([a-z]|[a-z0-9])+$/i.test(value);
    }, "Letters only please");

    var $validator = $("#formRegister").validate({
        focusInvalid: false,
        /*debug: true,*/
        /*onkeyup: function(element) { $(element).valid(); },*/
        onkeyup: function(element,event){
            checkEnableButton();
            var $valid = $("#formRegister").validate().element(element);
            if(!$valid){
                $('.btn-next').attr('disabled', 'disabled');
                $(element).closest('.form-group').removeClass('has-error').find('.error').remove();
            }
        },
        keypress : true,
        onfocusout: function(element, event) {
            this.element(element);
            $(element).popover('hide');
            $('span.with-errors').closest('.form-group').removeClass('has-error');
            $('span.with-errors').remove();
            checkEnableButton();
            var $valid = $("#formRegister").validate().element(element);
            if(!$valid){
                $('.btn-next').attr('disabled', 'disabled');
            }
        },
        onfocusin: function(element, event) {
            /*this.element(element);*/
            /*alert('ok');*/
            $(element).closest('.form-group').removeClass('has-error').find('.error').remove();
            //product detail
            $(element).popover({
                animation:true,
                placement: 'left',
                /*placement: function (tip, element) {
                    var offset = $(element).offset();
                    height = $(document).outerHeight();
                    width = $(document).outerWidth();
                    vert = 0.5 * height - offset.top;
                    vertPlacement = vert > 0 ? 'left' : 'right';
                    horiz = 0.5 * width - offset.left;
                    horizPlacement = horiz > 0 ? 'top' : 'bottom';
                    placement = Math.abs(horiz) > Math.abs(vert) ?  horizPlacement : vertPlacement;
                    return placement;
                },*/
                container: 'body',
                html: true,
                trigger: 'manual',
                content: function () {
                    //return $(this).parent().parent().find('.popper-color-content').html();
                    return $(element).closest('.form-group').find('.help-content').html();
                }
            });
            $(element).popover('show');
            $('span.with-errors').closest('.form-group').removeClass('has-error');
            $('span.with-errors').remove();
            checkEnableButton();
            var $valid = $("#formRegister").validate().element(element);
            if(!$valid){
                $('.btn-next').attr('disabled', 'disabled');
                $(element).closest('.form-group').removeClass('has-error').find('.error').remove();
            }

        },
        ignore: "",
        rules: {
            /*username: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                minlength: 5,
                noSpace: true,
                lettersonly: true
            },*/
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                equalTo: "#password",
                minlength: 6
            },
            full_name: {
                required: true
            },
            date_of_birth: {
                required: true,
                DateFormat: true,
                greaterThan: "#current_date"
            },
            gender: {
                required: true
            },
            identity_card_id: {
                required: true,
                number: true,
                minlength: 9,
                maxlength: 9
            },
            phone_number: {
                required: true,
                number: true,
                minlength: 10,
            },
            email: {
                required: true,
                emailCustom: true
            },
            avatar:{
                required: true
            },
        },
        messages: {
            /*username: {
                required: "Tên đăng nhập không được để trống.",
                minlength: "Tên đăng nhập phải lớn hơn hoặc bằng 5 ký tự.",
                noSpace: "Tên đăng nhập không có khảng trắng.",
                lettersonly: "Tên đăng nhập bắt đầu bằng ký tự chữ, bao gồm ký tự chữ hoặc chữ và số, ít nhất 1 ký tự từ a đến z và không có ký tự đặc biệt.",
            },*/
            password: {
                required: "Mật khẩu không được để trống.",
                minlength: "Mật khẩu phải lớn hơn hoặc bằng 6 ký tự."
            },
            confirm_password: {
                required: "Xác nhận mật khẩu không được để trống.",
                equalTo: "Xác nhận mật khẩu không trùng khớp với trường mật khẩu.",
                minlength: "Xác nhận mật khẩu phải lớn hơn hoặc bằng 6 ký tự."
            },
            full_name: {
                required: "Họ và tên không được để trống."
            },
            date_of_birth: {
                required: "Ngày sinh không được để trống.",
                DateFormat: "Ngày sinh phải có định dạng dd-mm-yyyy.",
                greaterThan: "Ngày sinh phải nhỏ hơn ngày hiện tại."
            },
            gender: {
                required: "Chọn giới tính."
            },
            identity_card_id: {
                required: "Số CMND không được để trống.",
                number: "Số CMND phải là số.",
                minlength: "Số CMND gồm 9 số.",
                maxlength: "Số CMND gồm 9 số."

            },
            phone_number: {
                required: "Số điện thoại không được để trống.",
                number: "Số điện thoại phải là số.",
                minlength: "Số điện thoại ít nhất 10 số.",
            },
            email: {
                required: "Email không được để trống.",
                emailCustom: "Email không đúng định dạng. ví dụ example@gmail.com",
            },
            avatar:{
                required: "Hình đại diện không được để trống."
            },
            contact_phone: {
                number: "Số điện thoại phải là số."
            }
        },
        tooltip_options: {
            /*example4: {trigger:'focus'},
            example5: {placement:'right',html:true}*/
           /* username: {placement:'top'},*/
            password: {placement:'top'},
            confirm_password: {placement:'top'},
            full_name: {placement:'top'},
            date_of_birth: {placement:'top'},
            gender: {placement:'top'},
            identity_card_id: {placement:'top'},
            phone_number: {placement:'top'},
            email:{placement:'top'},
            avatar:{placement:'top'},
            contact_phone: {placement:'top'}
        },
        /*errorPlacement: function(error,element) {
            checkEnableButton();
            return true;
        },*/
        invalidHandler: function(event, validator) {
            var arrTemp = [];
            for (var i=0;i<validator.errorList.length;i++){
                arrTemp[i] = validator.errorList[i].element.id;
            }

            /*if(arrTemp.length == 0){
             $(".wizard-card").find('.btn-next').removeAttr('disabled');
             }*/
            //console.log(arrTemp);
            try {
                if ($.inArray("avatar", arrTemp) == false) {
                    $(".wizard-card").find('.picture').css('border', '4px solid #FF0000');
                } else {
                    $(".wizard-card").find('.picture').css('border', '4px solid #CCCCCC');
                }
            }catch(e){

            }
            checkEnableButton();
        }
    });

    $('#wizard').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',
        onInit : function(tab, navigation,index){

            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            $width = 100/$total;

            $display_width = $(document).width();

            if($display_width < 400 && $total > 3){
                $width = 50;
            }
            navigation.find('li').css('width',$width + '%');
        },
        'onNext': function(tab, navigation, index) {
            $('.form-group').removeClass('has-error');
            $('span.with-errors').remove();
            $('.help-block.with-errors').remove();
            var $valid = $("#formRegister").valid();
            if(!$valid) {
                $validator.focusInvalid();
                return false;
            }

            //check chose account type
            /*if(index != 0 && index != 1){
                if ($("#account_type").val() == "") {
                    $('#account').find('.info-text').css('color','#FF0000');
                }
            }*/
        },
        'onPrevious': function (tab, navigation, index) {
            /*var $valid = $("#formRegister").valid();
            if(!$valid) {
                $validator.focusInvalid();
                return false;
            }
            //check chose account type
            if(index == 0 || index == 2){
                if ($("#account_type").val() == "") {
                    $('#account').find('.info-text').css('color','#FF0000');
                    return false
                }
            }*/
            return true;
        },
        onTabClick : function(tab, navigation, index){
            // Disable the posibility to click on tabs
            return false;
        },
        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;

            var wizard = navigation.closest('.wizard-card');

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $(wizard).find('.btn-next').hide();
                $(wizard).find('.btn-finish').show();
            } else {
                $(wizard).find('.btn-next').show();
                $(wizard).find('.btn-finish').hide();
            }
        }
    });

    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });


    $('[data-toggle="wizard-radio"]').click(function(event){
        $type = $(this).find('[type="radio"]').val();
        $("#account_type").val($type);
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
        $('#account').find('.info-text').css('color','#555');
        checkEnableButton();
    });

    $height = $(document).height();
    $('.set-full-height').css('height',$height);

    //functions for demo purpose

    $(document).on('click','.btn-submit-regis',function(e){
        if ($("#account_type").val() == "") {
            $('#account').find('.info-text').css('color','#FF0000');
            e.preventDefault();
        }
    });

    /*$("#username").blur(function(){
        $("#formRegister").validate().element( this );
    });*/
    $(document).on('keypress','#password',function(){
        $confirm = $('#confirm_password');
        $confirm.val('');
        $confirm.closest('.form-group').removeClass('has-error').find('.error').remove();
    });

    /*$(document).mouseup(function (e)
    {
        var container = $(".popover.fade.top.in");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('[data-toggle="popover"]').each(function () {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        }
    });*/

    $(document).on('change','#date_of_birth',function(){
        //$("#formRegister").validate().element( $('#date_of_birth') );
        checkEnableButton();
        var $valid = $("#formRegister").validate().element($('#date_of_birth'));
        if(!$valid){
            $('.btn-next').attr('disabled', 'disabled');
        }
    });

    $(document).on('change','#gender',function(){
        checkEnableButton();
        var $valid = $("#formRegister").validate().element($('#gender'));
        if(!$valid){
            $('.btn-next').attr('disabled', 'disabled');
        }
    });

    $(document).on('click','#gender',function(){
        $(this).closest('.form-group').removeClass('has-error').find('.error').remove();
    });

    $(document).on('change','#avatar',function(){
        checkEnableButton();
        var $valid = $("#formRegister").validate().element($('#avatar'));
        if(!$valid){
            $('.btn-next').attr('disabled', 'disabled');
        }
    });


    function checkEnableButton(){
        /*var username = $('#username').val();*/
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        var full_name = $('#full_name').val();
        var date_of_birth = $('#date_of_birth').val();
        var gender = $('#gender').val();
        var identity_card_id = $('#identity_card_id').val();
        var phone_number = $('#phone_number').val();
        var email = $('#email').val();
        var avatar = $('#avatar').val();
        var account_type = $('#account_type').val();

        if(
            //username != "" &&
            password != "" &&
            confirm_password != "" &&
            full_name != "" &&
            date_of_birth != "" &&
            gender != "" &&
            identity_card_id != "" &&
            phone_number != "" &&
            email != "" &&
            avatar != ""){
            $('.btn-next').removeAttr('disabled');
        } else {
            $('.btn-next').attr('disabled', 'disabled');
        }

        if(
            //username != "" &&
            password != "" &&
            confirm_password != "" &&
            full_name != "" &&
            date_of_birth != "" &&
            gender != "" &&
            identity_card_id != "" &&
            phone_number != "" &&
            email != "" &&
            avatar != "" &&
            account_type != ""
            ){
            $('.btn-finish').removeAttr('disabled');
        } else {
            $('.btn-finish').attr('disabled', 'disabled');
        }
    }

    //Function to show image before upload

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                $('#avatar').val(e.target.result).trigger('change');
                $(".wizard-card").find('.picture').css('border', '4px solid #CCCCCC');
                $('#avatar-error').remove();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


});
















