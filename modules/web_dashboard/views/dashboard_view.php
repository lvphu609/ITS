<?php
if(isset($js_file_module) && count($js_file_module)){
    foreach($js_file_module as $file)
        echo '<script type="text/javascript" src="'.base_url('modules/'.$file).'"></script>';
}
if(isset($css_file_module) && count($css_file_module)){
    foreach($css_file_module as $file)
        echo '<link rel="stylesheet" href="'.base_url('modules/'.$file).'">';
}

$dot_icon = base_url('resources/img/icon/pagedot_green2x.png');
?>
<div id="dashboard" class="content no-padding">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner das-inner">
                    <div class="col-lg-12">
                        <img class="sub-menu-item-icon" src="<?php echo $dot_icon; ?>">
                        <a class="das-link" href="<?php echo base_url('home/account/info'); ?>">Thông tin tài khoản.</a>
                    </div>
                    <div class="col-lg-12">
                        <img class="sub-menu-item-icon" src="<?php echo $dot_icon; ?>">
                        <a class="das-link " href="<?php echo base_url('home/account/form'); ?>">Cập nhật tài khoản.</a>
                    </div>
                    <div class="col-lg-12">
                        <img class="sub-menu-item-icon" src="<?php echo $dot_icon; ?>">
                        <a class="das-link btn-change-password" href="#">Đổi mật khẩu.</a>
                    </div>
                </div>
                <div class="icon">
                    <img class="icon-bottom" src="<?php echo base_url('resources/img/icon/icn_user_white.png'); ?>">
                </div>
                <a  href="#" class="small-box-footer das-title">
                    TÀI KHOẢN CỦA TÔI  <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="small-box bg-blue">
                <div class="inner das-inner">
                    <div class="col-lg-12">
                        <img class="sub-menu-item-icon" src="<?php echo $dot_icon; ?>">
                        <a class="das-link addNewTsmsData " href="<?php echo base_url('home/account/history'); ?>">Danh sách lịch sử hoạt động.</a>
                    </div>
                </div>
                <div class="icon">
                    <img class="icon-bottom" src="<?php echo base_url('resources/img/icon/icn_category_white.png'); ?>">
                </div>
                <a  href="#" class="small-box-footer das-title">
                    HOẠT ĐỘNG <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div>
</div>


<!--change pass-->
<div class="modal fade" id="modalChangePass" tabindex="-3" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header fontbold">Đổi mật khẩu</div>
            <div class="modal-body text-center">
                <div class="form-group">
                    <label for="old_pass" class="pull-left">Mật khẩu cũ</label></br>
                    <input  id="old_pass" name="old_pass" type="password" class="form-control" placeholder="Mật khẩu cũ">
                </div>
                <div class="form-group">
                    <label for="new_pass" class="pull-left">Mật khẩu mới</label></br>
                    <input  id="new_pass" name="new_pass" type="password" class="form-control" placeholder="Mật khẩu mới">
                </div>
                <div class="form-group">
                    <label for="cf_pass" class="pull-left">Xác nhận mật khẩu mới</label></br>
                    <input  id="cf_pass" name="cf_pass" type="password" class="form-control" placeholder="Xác nhận mật khẩu mới">
                </div>
            </div>
            <div class="col-lg-12 message-alert"></div>
            <div class="clear"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger btn-confirm-change-pass">Lưu</button>
                <button type="button" class="btn btn-sm btn-default btn-cancel-change-pass" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>



