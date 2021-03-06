<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('resources/img/icon/favicon.ico'); ?>" type="image/x-icon">
    <title><?php echo !empty($header_title) ? $header_title : "" ; ?></title>

    <!-- CSS -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('resources/includes/sb2/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('resources/includes/sb2/bower_components/metisMenu/dist/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('resources/includes/sb2/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('resources/css/web_style.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('resources/includes/sb2/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <!--css custom page-->
    <?php
    if(isset($css_file) && count($css_file)){
        foreach($css_file as $file)
            echo '<link rel="stylesheet" href="'.base_url('resources/'.$file).'">';
    }
    ?>
    <?php
        if(isset($css_file_module) && count($css_file_module)){
            foreach($css_file_module as $file)
                echo '<link rel="stylesheet" href="'.base_url('modules/'.$file).'">';
        }
    ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="loading" class="loading"></div>
    <input type="hidden" id="hidUrl" value="<?php echo base_url() ?>">


