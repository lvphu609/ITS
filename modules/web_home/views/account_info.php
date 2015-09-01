<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Thông tin tài khoản</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo $account_info['avatar']; ?>" class="img-responsive"> </div>
                    <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td>Tên đăng nhập:</td>
                                    <td><?php echo $account_info['username']; ?></td>
                                </tr>
                                <tr>
                                    <td>Họ và tên:</td>
                                    <td><?php echo $account_info['full_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Ngày sinh:</td>
                                    <td><?php echo $account_info['date_of_birth']; ?></td>
                                </tr>
                                <tr>
                                    <td>Giới tính:</td>
                                    <td><?php echo get_gender_name($account_info['gender']);?></td>
                                </tr>
                                <tr>
                                    <td>Số CMND:</td>
                                    <td><?php echo $account_info['identity_card_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại:</td>
                                    <td><?php echo $account_info['phone_number']; ?></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ email:</td>
                                    <td><a href="mailto:<?php echo $account_info['email']; ?>"><?php echo $account_info['email']; ?></a></td>
                                </tr>
                                <tr>
                                    <td>Nhóm máu:</td>
                                    <td><?php echo get_blood_group_name($account_info['blood_group_id']); ?></td>
                                </tr>
                                <tr>
                                    <td>Nhóm máu RH:</td>
                                    <td><?php echo get_blood_group_rh_name($account_info['blood_group_rh_id']); ?></td>
                                </tr>
                                <tr>
                                    <td>Loại tài khoản:</td>
                                    <td><?php echo get_account_type_name($account_info['account_type']); ?></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ:</td>
                                    <td><?php echo $account_info['address']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tên liên hệ:</td>
                                    <td><?php echo $account_info['contact_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại liên hệ:</td>
                                    <td><?php echo $account_info['contact_phone']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <span class="pull-right">
                    <a href="#" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning btn-change-password"><i class="glyphicon glyphicon-pencil"></i> Thay đổi mật khẩu</a>
                    <a href="<?php echo base_url('home/account/form'); ?>" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Sửa thông tin</a>
                </span>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

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




