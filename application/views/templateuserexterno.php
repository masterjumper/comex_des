<!DOCTYPE html>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo APP_NAME ?></title>
    <link rel="icon" href="<?php echo base_url().'media/logo.png'; ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.6/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url().'assets/dist/css/sb-admin-2.css';?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <style>
        .swal2-popup {
        font-size: 1.5rem !important;
        }
    </style> 
</head>

<body>

<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url().'index.php?/Login/inicio'?>"><?php echo APP_NAME ?></a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['usunom'].' '.$_SESSION['usuape']?> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?php echo base_url().'Profile/index'?>"><i class="fa fa-user fa-fw"></i> My Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url().'Login/index'?>"><i class="fa fa-sign-out fa-fw"></i> Exit</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?php echo base_url().'login/inicio';?>"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'Business/index'?>"><i class="fa fa-tasks"></i> Purchases</a>
                    </li>
                    <!-- <li>
                        <a href="<?php //echo base_url().'Claims/index'?>"><i class="fa fa-exclamation-circle"></i> Claims</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="panel-heading"><?php echo $title; ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <?php echo $_content ;?>
            </div>
        </div>
    </div>
</div>
<!-- <script src="<?php //echo base_url().'assets/vendor/jquery/jquery.min.js';?>"></script>
<script src="<?php //echo base_url().'assets/vendor/bootstrap/js/bootstrap.min.js';?>"></script>
<script src="<?php //echo base_url().'assets/vendor/metisMenu/metisMenu.min.js';?>"></script>
<script src="<?php //echo base_url().'assets/vendor/raphael/raphael.min.js';?>"></script>
<script src="<?php //echo base_url().'assets/dist/js/sb-admin-2.js';?>"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.6/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.2.7/morris.min.js"></script>
<script src="<?php echo base_url().'assets/dist/js/sb-admin-2.js';?>"></script>

</body>
</html>