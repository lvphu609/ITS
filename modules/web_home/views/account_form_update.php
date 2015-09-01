<?php
$base64 ="";
if(!empty($account_info)) {
        $data = file_get_contents($account_info['avatar']);
        $base64 = 'data:image/png;base64,' . base64_encode($data);
}
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad" >
        <form id="formUpdateAccount" action="<?php echo base_url('home/account/update'); ?>" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Cập nhật tài khoản</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            <!--<img alt="User Pic" src="<?php /*echo $account_info['avatar']; */?>" class="img-responsive">-->
                            <div class="col-sm-10  <?php //echo !empty(form_error('avatar')) ? 'has-error' : ''; ?>">
                                <img class="avatar-account" src="<?php echo $account_info['avatar']; ?>" data-toggle="modal" data-target="#myModal" width="98" height="118">
                                <input type="hidden" id="img_url" value="<?php echo $account_info['avatar']; ?>">
                                <input type="hidden" id="img_base64" name="avatar" value="<?php echo $base64; ?>">
                            </div>
                        </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Tên đăng nhập:</td>
                                    <td><?php echo $account_info['username']; ?></td>
                                </tr>
                                <tr>
                                    <td>Họ và tên:</td>
                                    <td>
                                        <div class="form-group <?php echo !empty($validation["full_name"]) ? "has-error" : null; ?>">
                                            <input name="full_name" id="full_name" type="text" class="form-control" placeholder="Họ và tên" value="<?php
                                                //validation
                                                if(!empty($validation["full_name"])){
                                                    echo "";
                                                }else if(!empty($set_value['full_name'])){
                                                    echo $set_value['full_name'];
                                                }else{
                                                    echo $account_info['full_name'];
                                                }
                                            ?>">
                                            <?php if(!empty($validation["full_name"])){ ?>
                                                <span class="help-block with-errors"><?php echo $validation["full_name"]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ngày sinh:</td>
                                    <td>
                                        <div class="form-group  <?php echo !empty($validation["date_of_birth"]) ? "has-error" : null; ?> ">
                                            <div class='input-group date' id='datetimepicker'>
                                                <input id="date_of_birth" name="date_of_birth" type="text" class="form-control bg-white" placeholder="" readonly value="<?php
                                                //validation
                                                if(!empty($validation["date_of_birth"])){
                                                    echo "";
                                                }else if(!empty($set_value['date_of_birth'])){
                                                    echo $set_value['date_of_birth'];
                                                }else{
                                                    echo $account_info['date_of_birth'];
                                                }
                                                ?>">
                                                <span class="input-group-addon" style="width: 10px;">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            <input type="hidden" id="current_date" value="<?php echo date('d-m-Y'); ?>">
                                            <?php if(!empty($validation["date_of_birth"])){ ?>
                                                <span class="help-block with-errors"><?php echo $validation["date_of_birth"]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Giới tính:</td>
                                    <td>
                                        <div class="form-group <?php echo !empty($validation["gender"]) ? "has-error" : null; ?>">
                                            <select id="gender" name="gender" class="form-control">
                                                <option value=""  <?php echo (!empty($validation["gender"]))? 'selected' : ''; ?> > --- </option>
                                                <?php foreach(get_gender_arr() as $key => $gender){  ?>
                                                    <?php if(empty($validation["gender"]) && empty($set_value['gender']) ){ ?>
                                                        <option value="<?php echo $gender["id"]; ?>" <?php echo ($gender["id"] == $account_info['gender'])? 'selected' : null; ?> >  <?php echo $gender['name']; ?> </option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $gender["id"]; ?>" <?php echo ($gender["id"] == $set_value['gender'])? 'selected' : null; ?> >  <?php echo $gender['name']; ?> </option>
                                                    <?php }  ?>
                                                <?php } ?>
                                            </select>
                                            <?php if(!empty($validation["gender"])){ ?>
                                                <span class="help-block with-errors"><?php echo $validation["gender"]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Số CMND:</td>
                                    <td>
                                        <div class="form-group <?php echo !empty($validation["identity_card_id"]) ? "has-error" : null; ?>">
                                            <input  id="identity_card_id" name="identity_card_id" type="text" class="form-control" placeholder="Số CMND" value="<?php
                                            //validation
                                            if(!empty($validation["identity_card_id"])){
                                                echo "";
                                            }else if(!empty($set_value['identity_card_id'])){
                                                echo $set_value['identity_card_id'];
                                            }else{
                                                echo $account_info['identity_card_id'];
                                            }
                                            ?>">
                                            <?php if(!empty($validation["identity_card_id"])){ ?>
                                                <span class="help-block with-errors"><?php echo $validation["identity_card_id"]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại:</td>
                                    <td>
                                        <div class="form-group <?php echo !empty($validation["phone_number"]) ? "has-error" : null; ?>">
                                            <input id="phone_number" name="phone_number" type="text" class="form-control" placeholder="Số điện thoại" value="<?php
                                            //validation
                                            if(!empty($validation["phone_number"])){
                                                echo "";
                                            }else if(!empty($set_value['phone_number'])){
                                                echo $set_value['phone_number'];
                                            }else{
                                                echo $account_info['phone_number'];
                                            }
                                            ?>">
                                            <?php if(!empty($validation["phone_number"])){ ?>
                                                <span class="help-block with-errors"><?php echo $validation["phone_number"]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ email:</td>
                                    <td>
                                        <div class="form-group <?php echo !empty($validation["email"]) ? "has-error" : null; ?>">
                                            <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="<?php
                                            //validation
                                            if(!empty($validation["email"])){
                                                echo "";
                                            }else if(!empty($set_value['email'])){
                                                echo $set_value['email'];
                                            }else{
                                                echo $account_info['email'];
                                            }
                                            ?>">
                                            <?php if(!empty($validation["email"])){ ?>
                                                <span class="help-block with-errors"><?php echo $validation["email"]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nhóm máu:</td>
                                    <td>
                                        <div class="form-group <?php echo !empty($validation["blood_group_id"]) ? "has-error" : null; ?>">
                                            <select id="blood_group_id" name="blood_group_id" class="form-control">
                                                <option value="" <?php echo (!empty($validation["blood_group_id"]))? 'selected' : ''; ?>  > Chọn nhóm máu </option>
                                                <?php foreach(get_blood_group() as $key => $bloodItem){  ?>
                                                    <?php if(empty($validation["blood_group_id"]) && empty($set_value['blood_group_id']) ){ ?>
                                                        <option value="<?php echo $bloodItem["id"]; ?>" <?php echo ($bloodItem["id"] == $account_info['blood_group_id'])? 'selected' : null; ?> >  <?php echo $bloodItem['name']; ?> </option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $bloodItem["id"]; ?>" <?php echo ($bloodItem["id"] == $set_value['blood_group_id'])? 'selected' : null; ?> >  <?php echo $bloodItem['name']; ?> </option>
                                                    <?php }  ?>
                                                <?php } ?>
                                            </select>
                                            <?php if(!empty($validation["blood_group_id"])){ ?>
                                                <span class="help-block with-errors"><?php echo $validation["blood_group_id"]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nhóm máu RH:</td>
                                    <td>
                                        <div class="form-group <?php echo !empty($validation["blood_group_rh_id"]) ? "has-error" : null; ?>">
                                            <select id="blood_group_rh_id" name="blood_group_rh_id" class="form-control">
                                                <option value="" <?php echo (!empty($validation["blood_group_rh_id"]))? 'selected' : ''; ?>  > Chọn nhóm máu RH </option>
                                                <?php foreach(get_blood_group_rh() as $key => $bloodItem){  ?>
                                                    <?php if(empty($validation["blood_group_rh_id"]) && empty($set_value['blood_group_rh_id']) ){ ?>
                                                        <option value="<?php echo $bloodItem["id"]; ?>" <?php echo ($bloodItem["id"] == $account_info['blood_group_rh_id'])? 'selected' : null; ?> >  <?php echo $bloodItem['name']; ?> </option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $bloodItem["id"]; ?>" <?php echo ($bloodItem["id"] == $set_value['blood_group_rh_id'])? 'selected' : null; ?> >  <?php echo $bloodItem['name']; ?> </option>
                                                    <?php }  ?>
                                                <?php } ?>
                                            </select>
                                            <?php if(!empty($validation["blood_group_rh_id"])){ ?>
                                                <span class="help-block with-errors"><?php echo $validation["blood_group_rh_id"]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php /*<tr>
                                    <td>Loại tài khoản:</td>
                                    <td>
                                        <div class="form-group">
                                            <select id="ac_type" name="ac_type" class="form-control">
                                                <option value=""> --- </option>
                                                <?php foreach(get_account_type() as $key => $type){ ?>
                                                    <option value="<?php $type['id'] ?>" <?php echo ($type['id'] == $account_info['account_type'])? 'selected' : ''; ?>> <?php echo $type['name']; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr> */ ?>
                                <tr>
                                    <td>Địa chỉ:</td>
                                    <td>
                                        <div class="form-group">
                                            <textarea id="ac_address" name="ac_address" rows="3" class="form-control" placeholder="Địa chỉ"><?php
                                                if(!empty($set_value['address'])){
                                                    echo $set_value['address'];
                                                }else{
                                                    echo $account_info['address'];
                                                }
                                            ?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-bold" colspan="2">Liên hệ khẩn cấp</td>
                                </tr>
                                <tr>
                                    <td>Tên liên hệ:</td>
                                    <td>
                                        <div class="form-group">
                                            <input id="contact_name" name="contact_name" type="text" class="form-control" placeholder="Họ và tên" value="<?php
                                                if(!empty($set_value['contact_name'])){
                                                    echo $set_value['contact_name'];
                                                }else{
                                                    echo $account_info['contact_name'];
                                                }
                                            ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại liên hệ:</td>
                                    <td>
                                        <div class="form-group <?php echo !empty($validation["contact_phone"]) ? "has-error" : null; ?> ">
                                            <input id="contact_phone" name="contact_phone" type="text" class="form-control" placeholder="Số điện thoại" value="<?php
                                            if(!empty($set_value['contact_phone'])){
                                                echo $set_value['contact_phone'];
                                            }else{
                                                echo $account_info['contact_phone'];
                                            }
                                            ?>">
                                            <?php if(!empty($validation["contact_phone"])){ ?>
                                                <span class="help-block with-errors"><?php echo $validation["contact_phone"]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <span class="pull-right">
                        <button type="submit" class="btn btn-sm btn-danger btn-save-account-info"><i class="glyphicon glyphicon-pencil"></i> Lưu</button>
                        <a href="<?php echo base_url('home/account/info'); ?>" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-edit"></i> Hủy</a>
                    </span>
                    <div class="clear"></div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Hình ảnh</h4>
            </div>
            <div class="modal-body">
                <div class="image-editor">
                    <div class="cropit-image-preview"></div>
                    <input type="range" class="cropit-image-zoom-input">
                    <div class="input-file-custom">
                        <a class="btn btn-default form-control" href="javascript:;">
                            Chọn hình
                            <input class="form-control cropit-image-input" id="inputId" type="file" name="file_source" size="40" onchange="$(&quot;#upload-file-info&quot;).html($(this).val());">
                        </a>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger export">Lưu</button>
            </div>
        </div>
    </div>
</div>
