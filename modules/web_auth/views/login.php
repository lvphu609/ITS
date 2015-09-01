<div class="register-container">
    <div class="row col-md-6 col-md-offset-3">
        <div class="register span6">
            <form action="<?php echo base_url('home/login/auth'); ?>" method="post" id="formLogin" autocomplete="off">
                <h2>Đăng nhập</h2>
                <div class="form-group">
                    <label for="username" class="pull-left lable-form">Tên đăng nhập</label><br>
                    <input autocomplete="off" class="form-control" type="text" id="username" name="username" placeholder="Tên đăng nhập">
                </div>
                <div class="clear"></div>
                <div class="form-group">
                    <label for="password" class="pull-left lable-form">Mật khẩu</label><br>
                    <input autocomplete="off" class="form-control" type="password" id="md5_password" name="md5_password" placeholder="Mật khẩu">
                    <input  class="form-control" type="hidden" id="password" name="password"><br>
                </div>
                <?php if($error){  ?>
                    <div class="alert alert-danger" role="alert">
                        <!--<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>-->
                        <!--<span class="sr-only">Error:</span>-->
                        Bạn nhập sai tên hoặc mật khẩu.
                    </div>
                <?php } ?>
                <button id="btn-login" type="submit">ĐĂNG NHẬP</button>
            </form>
        </div>
    </div>
</div>
