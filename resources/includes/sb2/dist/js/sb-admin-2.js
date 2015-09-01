$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});


$(document).ready(function(){
    adminScript.run();
});

var adminScript = {
    init: function() {
        this.document = $(document);
        this.loading.hide();
    },
    loading: {
        show: function() {
            $('#loading').show();
        },
        hide: function() {
            $('#loading').hide();
        }
    },
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
            var url = $('#changePassUrl').val();
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
    setup: function(){
        this.init();
        this.handle();
    },
    run: function(){
        this.setup();
    }
}