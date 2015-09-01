$(document).ready(function(){
    home.run();
});

var home = {
    handle: function(){
        $(document).on('click','.btn-change-password',function(){
            $('#old_pass').val("");
            $('#new_pass').val("");
            $('#cf_pass').val("");
            $('#modalChangePass').find('.message-alert').html("");
            $('#modalChangePass').modal('show');
        });

        $(document).on('click','.btn-confirm-change-pass',function(){
            adminScript.loading.show();
            var url = $('#hidUrl').val() + 'home/account/password/change';

            var old_pass = "";
            var new_pass = "";
            var cf_pass = "";

            if($('#old_pass').val() != ""){
                old_pass = $.md5($('#old_pass').val())
            }
            if($('#new_pass').val() != ""){
                new_pass = $.md5($('#new_pass').val())
            }
            if($('#cf_pass').val() != ""){
                cf_pass = $.md5($('#cf_pass').val())
            }

            var data = {
                old_pass: old_pass,
                new_pass: new_pass,
                cf_pass: cf_pass
            };

            var ajax = $.ajax({
                url: url,
                data: data,
                method: 'POST',
                dataType: 'json',
                statusCode: {
                    404: function () {
                        adminScript.loading.hide();
                        console.log("page not found");
                    },
                    500: function (data) {
                        adminScript.loading.hide();
                        console.log(data);
                    }
                }
            });

            ajax.done(function (data) {
                if(data.status == "success"){
                    $('#modalChangePass').find('.message-alert').html("");
                    $('#modalChangePass').modal('hide');
                }
                else{
                    $('#modalChangePass').find('.message-alert').html(data.message);
                }
                adminScript.loading.hide();
            });
        });
    },
    run: function(){
        this.handle();
    }
}
