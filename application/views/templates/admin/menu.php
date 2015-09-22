<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top menu-admin" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url('admin'); ?>">
            <img class="logo-admin-header" src="<?php echo base_url('resources/img/logo/logo-its.png'); ?>">
        </a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right hidden-xs hidden-sm hidden-md">
        <li class="dropdown">
            <a class="dropdown-toggle user-profile" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="#" class="btn-change-password"><i class="fa fa-exchange fa-fw"></i> Đổi mật khẩu</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo $this->lang->line('logout_text'); ?></a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <?php /*<li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    <!-- /input-group -->
                </li> */ ?>
                <li>
                    <a href="<?php echo base_url('admin/home'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/accounts'); ?>"><i class="fa fa-user fa-fw"></i> Người dùng</a>
                </li>
                <!--<li class="active">-->
                <li>
                    <a href="#"><i class="fa fa-cog fa-fw"></i> <?php echo $this->lang->line('menu_text_config'); ?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('admin/config/post_types'); ?>"><i class="fa fa-list-alt fa-fw"></i> <?php echo $this->lang->line('menu_text_post_types'); ?></a>
                        </li>
                        <?php /* <li>
                            <a href="<?php echo base_url('admin/config/cogs'); ?>"><i class="fa fa-cogs fa-fw"></i> Cấu hình máy chủ</a>
                        </li> */ ?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li class="hidden-lg">
                    <a href="#" class="btn-change-password"><i class="fa fa-exchange fa-fw"></i> Đổi mật khẩu</a>
                </li>
                <li class="hidden-lg">
                    <a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo $this->lang->line('logout_text'); ?></a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

<?php /*Popup change password*/ ?>
<input type="hidden" id="changePassUrl" value="<?php echo base_url('admin/password/change'); ?>">
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


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header admin-page-header"><?php echo !empty($page_header) ? $page_header : ''; ?></h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>

