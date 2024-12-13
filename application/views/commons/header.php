<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dial Up Delta | Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('includes/plugins/fontawesome-free/css/all.min.css');?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('includes/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('includes/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('includes/plugins/jqvmap/jqvmap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('includes/dist/css/adminlte.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('includes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('includes/plugins/daterangepicker/daterangepicker.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('includes/plugins/summernote/summernote-bs4.min.css');?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="<?= base_url('includes/js/jquery.toast.js'); ?>"></script>
    <link rel="stylesheet" href="<?= base_url(); ?>includes/css/jquery.toast.css" type="text/css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.6.2/css/colReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url('includes/dist/img/AdminLTELogo.png');?>" alt="AdminLTELogo" height="60" width="60">
        </div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url();?>" class="nav-link">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('AdminController/logout');?>">
                        Log Out
                    </a>    
                </li>
            </ul>
        </nav>