$(document).ready(function(){
    webAccount.run();

});

var webAccount = {
    handle: function(){
        $("#datetimepicker").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            language:  'vi'
        });
    },
    imageCrop: function(){
        $(document).on('click','.avatar-account', function () {
            var $imageUrl = $('#img_url').val();
            $('.image-editor').cropit({
                imageState: {
                    src: $imageUrl
                },
                imageBackground: true,
                imageBackgroundBorderWidth: 15
            });
        });

        $('.export').click(function() {
            var imageData = $('.image-editor').cropit('export');
            $('#img_base64').val(imageData);
            $('.avatar-account').attr('src',imageData);
            $('.avatar-account').parent().removeClass('has-error');
            $('#myModal').modal('hide');
        });
    },
    run: function(){
        this.handle();
        this.imageCrop();
    }
}
