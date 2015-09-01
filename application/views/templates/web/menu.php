<div class="header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('home'); ?>"><img class="logo-home" src="<?php echo base_url('resources/img/logo/logo_small.png'); ?>"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                <?php if(empty($_SESSION['']['web_user_login'])){ ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="<?php echo $active == 'register' ? 'active' : ''; ?>"><a href="<?php echo base_url('home/register'); ?>">Đăng ký</a></li>
                        <li class="<?php echo $active == 'login' ? 'active' : ''; ?>"><a href="<?php echo base_url('home/login'); ?>">Đăng nhập</a></li>
                    </ul>
                <?php }else{ ?>
                    <ul class="nav navbar-nav navbar-right hidden-lg hidden-sm">
                        <li><a href="<?php echo base_url('home/logout'); ?>">Đăng xuất</a></li>
                    </ul>
                    <ul class="nav navbar-top-links navbar-right hidden-xs hidden-md">
                        <li class="dropdown">
                            <a class="dropdown-toggle user-profile" data-toggle="dropdown" href="#">
                                Chào <?php echo $_SESSION['']['web_user_login']['full_name']; ?>  <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="<?php echo base_url('home/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo $this->lang->line('logout_text'); ?></a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                <?php } ?>

            </div>
        </div>
    </nav>
</div>

<div class="container">
        <?php if(!empty($_SESSION['']['web_user_login'])){ ?>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-home"></i></a></li>
                <?php if(!empty($breadcrumbs) && count($breadcrumbs) > 0) {?>
                        <?php foreach($breadcrumbs as $key => $breadcrumb) { ?>
                            <li class="<?php echo ($breadcrumb['active'] == true) ? 'active' : '' ; ?>" >
                                <!--<a href="<?php /*// echo $breadcrumb['href'] */?>">-->
                                    <?php echo $breadcrumb['name'] ?>
                                <!--</a>-->
                            </li>
                        <?php } ?>
                <?php } ?>
            </ul>
        <?php } ?>

