
<div class="register-container">
    <div class="row col-md-8 col-md-offset-2">
        <div class="register span6">
            <form id="formRegister" action="<?php echo base_url('home/accounts/create'); ?>" method="post">
                <h2>Đăng ký</h2>
                <!--      Wizard container        -->
                <div class="wizard-container">
                        <div class="card wizard-card ct-wizard-orange" id="wizard">
                            <!--        You can switch "ct-wizard-orange"  with one of the next bright colors: "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"             -->
                            <ul>
                                <li class="first-tab-regis"><a href="#about" data-toggle="tab">1</a></li>
                                <li><a href="#account" data-toggle="tab">2</a></li>
                                <!--<li><a href="#address" data-toggle="tab">Địa chỉ</a></li>-->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="about">
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-1">
                                            <div class="picture-container">
                                                <div class="picture">
                                                    <img src="<?php
                                                        if(!empty($set_value['avatar'])){
                                                            echo $set_value['avatar'];
                                                        }else{
                                                            echo base_url('modules/web_auth/assets/img/user-default.png');
                                                        }
                                                    ?>" class="picture-src" id="wizardPicturePreview" title=""/>
                                                    <input type="file" id="wizard-picture" value="<?php
                                                        if(!empty($set_value['avatar'])){
                                                            echo $set_value['avatar'];
                                                        }
                                                    ?>">
<!--                                                    <div class="form-group">-->
<!--                                                        <label for="avatar" class="pull-left"></label>-->
                                                        <input name="avatar" type="hidden" class="form-control" id="avatar" value="<?php
                                                            if(!empty($set_value['avatar'])){
                                                                echo $set_value['avatar'];
                                                            }
                                                        ?>">
<!--                                                    </div>-->
                                                </div>
                                                <h6>Hình đại diện</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group <?php echo !empty($validation["username"]) ? "has-error" : null; ?>">
                                                <label for="username" class="pull-left">Tên đăng nhập</label><br>
                                                <input name="username" type="text" class="form-control" id="username" placeholder="Tên đăng nhập" value="<?php
                                                //validation
                                                if(!empty($set_value['username'])){
                                                    echo $set_value['username'];
                                                }
                                                ?>">
                                                <?php if(!empty($validation["username"])){ ?>
                                                    <span class="help-block with-errors"><?php echo $validation["username"]; ?></span>
                                                <?php } ?>
                                                <div class="help-content hidden">
                                                    <ul class="tip-info">
                                                        <li>Tên đăng nhập không được để trống.</li>
                                                        <li>Tên đăng nhập chỉ sử dụng ký tự (a-z) và số.</li>
                                                        <li>Tên đăng nhập phải lớn hơn hoặc bằng 5 ký tự.</li>
                                                        <li>Tên đăng nhập ít nhất 1 ký tự từ a đến z.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="pull-left">Mật khẩu</label><br>
                                                <input name="password" type="password" class="form-control" id="password" placeholder="Mật khẩu">
                                                <div class="help-content hidden">
                                                    <ul class="tip-info">
                                                        <li>Mật khẩu không được để trống.</li>
                                                        <li>Mật khẩu phải lớn hơn hoặc bằng 6 ký tự.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm_password" class="pull-left">Nhập lại mật khẩu</label><br>
                                                <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Nhập lại mật khẩu">
                                                <div class="help-content hidden">
                                                    <ul class="tip-info">
                                                        <li>Nhập lại mật khẩu giống mật khẩu đã nhập bên trên.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="form-group <?php echo !empty($validation["full_name"]) ? "has-error" : null; ?>">
                                                <label for="full_name" class="pull-left">Họ và tên</label><br>
                                                <input name="full_name" id="full_name" type="text" class="form-control" placeholder="Họ và tên" value="<?php
                                                //validation
                                                if(!empty($set_value['full_name'])){
                                                    echo $set_value['full_name'];
                                                }
                                                ?>">
                                                <?php if(!empty($validation["full_name"])){ ?>
                                                    <span class="help-block with-errors"><?php echo $validation["full_name"]; ?></span>
                                                <?php } ?>
                                                <div class="help-content hidden">
                                                    <ul class="tip-info">
                                                        <li>Họ và tên không được để trống.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-sm-7 pull-left no-padding-left" >
                                                <div class="form-group clear <?php echo !empty($validation["date_of_birth"]) ? "has-error" : null; ?>">
                                                    <label for="date_of_birth" class="pull-left">Ngày sinh</label><br>
                                                    <div class='input-group date clear' id='datetimepicker'>
                                                        <input id="date_of_birth" name="date_of_birth" type="text" class="form-control bg-white" placeholder="Ngày sinh" readonly  value="<?php
                                                        //validation
                                                        if(!empty($set_value['date_of_birth'])){
                                                            echo $set_value['date_of_birth'];
                                                        }
                                                        ?>">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                    <?php if(!empty($validation["date_of_birth"])){ ?>
                                                        <span class="help-block with-errors"><?php echo $validation["date_of_birth"]; ?></span>
                                                    <?php } ?>
                                                    <input type="hidden" id="parram-date" value="">
                                                    <input type="hidden" id="current_date" value="<?php echo date('d-m-Y'); ?>">

                                                    <div class="help-content hidden">
                                                        <ul class="tip-info">
                                                            <li>Ngày sinh không được để trống.</li>
                                                            <li>Ngày sinh phải lớn hơn ngày hiện tại.</li>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-5">
                                                <div class="form-group clear<?php echo !empty($validation["gender"]) ? "has-error" : null; ?>">
                                                    <label for="gender" class="pull-left">Giới tính</label><br>
                                                    <select id="gender" name="gender" class="form-control">
                                                        <option value=""  <?php echo (!empty($validation["gender"]))? 'selected' : ''; ?> > Chọn giới tính </option>
                                                        <?php foreach(get_gender_arr() as $key => $gender){  ?>
                                                            <?php if(empty($validation["gender"]) && empty($set_value['gender']) ){ ?>
                                                                <option value="<?php echo $gender["id"]; ?>">  <?php echo $gender['name']; ?> </option>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $gender["id"]; ?>" <?php echo ($gender["id"] == $set_value['gender'])? 'selected' : null; ?> >  <?php echo $gender['name']; ?> </option>
                                                            <?php }  ?>
                                                        <?php } ?>
                                                    </select>
                                                    <?php if(!empty($validation["gender"])){ ?>
                                                        <span class="help-block with-errors"><?php echo $validation["gender"]; ?></span>
                                                    <?php } ?>
                                                    <div class="help-content hidden">
                                                        <ul class="tip-info">
                                                            <li>Chọn giới tính.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div style="margin-top: 10px;" class="form-group <?php echo !empty($validation["identity_card_id"]) ? "has-error" : null; ?>">
                                                <label for="identity_card_id" class="pull-left">Số CMND</label><br>
                                                <input  id="identity_card_id" name="identity_card_id" type="text" class="form-control" placeholder="Số CMND" value="<?php
                                                //validation
                                                if(!empty($set_value['identity_card_id'])){
                                                    echo $set_value['identity_card_id'];
                                                }
                                                ?>">
                                                <?php if(!empty($validation["identity_card_id"])){ ?>
                                                    <span class="help-block with-errors"><?php echo $validation["identity_card_id"]; ?></span>
                                                <?php } ?>
                                                <div class="help-content hidden">
                                                    <ul class="tip-info">
                                                        <li>Số CMND không được để trống.</li>
                                                        <li>Số CMND gồm 9 số.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="form-group <?php echo !empty($validation["phone_number"]) ? "has-error" : null; ?>">
                                                <label for="phone_number"  class="pull-left">Số điện thoại</label><br>
                                                <input id="phone_number" name="phone_number" type="text" class="form-control" placeholder="Số điện thoại" value="<?php
                                                //validation
                                                if(!empty($set_value['phone_number'])){
                                                    echo $set_value['phone_number'];
                                                }
                                                ?>">
                                                <?php if(!empty($validation["phone_number"])){ ?>
                                                    <span class="help-block with-errors"><?php echo $validation["phone_number"]; ?></span>
                                                <?php } ?>
                                                <div class="help-content hidden">
                                                    <ul class="tip-info">
                                                        <li>Số điện thoại không được để trống.</li>
                                                        <li>Số điện thoại ít nhất 10 số.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="form-group <?php echo !empty($validation["email"]) ? "has-error" : null; ?>">
                                                <label for="email" class="pull-left">Email</label><br>
                                                <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="<?php
                                                //validation
                                                if(!empty($set_value['email'])){
                                                    echo $set_value['email'];
                                                }
                                                ?>">
                                                <?php if(!empty($validation["email"])){ ?>
                                                    <span class="help-block with-errors"><?php echo $validation["email"]; ?></span>
                                                <?php } ?>
                                                <div class="help-content hidden">
                                                    <ul class="tip-info">
                                                        <li>Định dạng email ví dụ example@gmail.com.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--<div class="clear"></div>-->
                                            <div class="col-sm-7 no-padding-left clear" >
                                                <div class="form-group <?php echo !empty($validation["blood_group_id"]) ? "has-error" : null; ?>">
                                                    <label for="blood_group_id" class="pull-left">Chọn nhóm máu</label><br>
                                                    <select id="blood_group_id" name="blood_group_id" class="form-control">
                                                        <option value="" <?php echo (!empty($validation["blood_group_id"]))? 'selected' : ''; ?>  > Chọn nhóm máu </option>
                                                        <?php foreach(get_blood_group() as $key => $bloodItem){  ?>
                                                            <?php if(empty($validation["blood_group_id"]) && empty($set_value['blood_group_id']) ){ ?>
                                                                <option value="<?php echo $bloodItem["id"]; ?>" >  <?php echo $bloodItem['name']; ?> </option>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $bloodItem["id"]; ?>" <?php echo ($bloodItem["id"] == $set_value['blood_group_id'])? 'selected' : null; ?> >  <?php echo $bloodItem['name']; ?> </option>
                                                            <?php }  ?>
                                                        <?php } ?>
                                                    </select>
                                                    <?php if(!empty($validation["blood_group_id"])){ ?>
                                                        <span class="help-block with-errors"><?php echo $validation["blood_group_id"]; ?></span>
                                                    <?php } ?>
                                                    <div class="help-content hidden">
                                                        <ul class="tip-info">
                                                            <li>Chọn nhóm máu.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-5">
                                                <div class="form-group <?php echo !empty($validation["blood_group_rh_id"]) ? "has-error" : null; ?>">
                                                    <label for="blood_group_rh_id" class="pull-left">Chọn nhóm máu RH</label><br>
                                                    <select id="blood_group_rh_id" name="blood_group_rh_id" class="form-control">
                                                        <option value="" <?php echo (!empty($validation["blood_group_rh_id"]))? 'selected' : ''; ?>  > Chọn nhóm máu RH </option>
                                                        <?php foreach(get_blood_group_rh() as $key => $bloodItem){  ?>
                                                            <?php if(empty($validation["blood_group_rh_id"]) && empty($set_value['blood_group_rh_id']) ){ ?>
                                                                <option value="<?php echo $bloodItem["id"]; ?>" >  <?php echo $bloodItem['name']; ?> </option>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $bloodItem["id"]; ?>" <?php echo ($bloodItem["id"] == $set_value['blood_group_rh_id'])? 'selected' : null; ?> >  <?php echo $bloodItem['name']; ?> </option>
                                                            <?php }  ?>
                                                        <?php } ?>
                                                    </select>
                                                    <?php if(!empty($validation["blood_group_rh_id"])){ ?>
                                                        <span class="help-block with-errors"><?php echo $validation["blood_group_rh_id"]; ?></span>
                                                    <?php } ?>
                                                    <div class="help-content hidden">
                                                        <ul class="tip-info">
                                                            <li>Chọn nhóm máu RH.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="account">
                                    <h4 class="info-text"> Vui lòng chọn tài khoản. </h4>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <!--radio 1-->
                                            <div class="col-sm-6">
                                                <div class="choice <?php
                                                    if(!empty($set_value['account_type'])){
                                                        if($set_value['account_type'] == 1){
                                                            echo 'active';
                                                         }
                                                    }
                                                    ?>" data-toggle="wizard-radio">

                                                    <input type="radio" name="ac_type" value="1" <?php
                                                        if(!empty($set_value['account_type'])){
                                                            if($set_value['account_type'] == 1){
                                                                echo 'checked="checked"';
                                                            }
                                                        }
                                                    ?>>

                                                    <div class="icon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                    <h6>Người sử dụng</h6>
                                                </div>
                                            </div>

                                            <!--radio 2-->
                                            <div class="col-sm-6">
                                                <div class="choice <?php
                                                if(!empty($set_value['account_type'])){
                                                    if($set_value['account_type'] == 2){
                                                        echo 'active';
                                                         }
                                                }
                                                ?>" data-toggle="wizard-radio">

                                                    <input type="radio" name="ac_type" value="2" <?php
                                                    if(!empty($set_value['account_type'])){
                                                        if($set_value['account_type'] == 2){
                                                            echo 'checked="checked"';
                                                            }
                                                    }
                                                    ?>>

                                                    <div class="icon">
                                                        <i class="fa fa-wrench"></i>
                                                    </div>
                                                    <h6>Nhà cung cấp</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="account_type" id="account_type" value = "<?php
                                            if(!empty($set_value['account_type'])){
                                                    echo $set_value['account_type'];
                                            }
                                            ?>" >


                                        <div class="row clear">
                                            <div class="form-group">
                                                <label for="ac_address" class="pull-left">Địa chỉ</label><br>
                                            <textarea id="ac_address" name="ac_address" rows="3" class="form-control" placeholder="Địa chỉ"><?php
                                                if(!empty($set_value['address'])){
                                                    echo $set_value['address'];
                                                }
                                                ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <hr class="line">
                                                <label class="pull-left"><strong>Liên hệ khẩn cấp</strong></label>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="form-group">
                                                <label for="contact_name" class="pull-left">Họ và tên</label><br>
                                                <input id="contact_name" name="contact_name" type="text" class="form-control" placeholder="Họ và tên"  value="<?php
                                                if(!empty($set_value['contact_name'])){
                                                    echo $set_value['contact_name'];
                                                }
                                                ?>">
                                            </div>
                                            <div class="form-group <?php echo !empty($validation["contact_phone"]) ? "has-error" : null; ?>">
                                                <label for="contact_phone" class="pull-left">Số điện thoại</label><br>
                                                <input id="contact_phone" name="contact_phone" type="text" class="form-control" placeholder="Số điện thoại"  value="<?php
                                                if(!empty($set_value['contact_phone'])){
                                                    echo $set_value['contact_phone'];
                                                }
                                                ?>">
                                                <?php if(!empty($validation["contact_phone"])){ ?>
                                                    <span class="help-block with-errors"><?php echo $validation["contact_phone"]; ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input disabled="disabled" type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm btn-form' name='next' value='Tiếp theo' />
                                    <input disabled="disabled" type='submit' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm btn-form btn-submit-regis' name='finish' value='Đăng ký' />

                                </div>
                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm btn-form' name='previous' value='Về trước' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
