<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Faster One' rel='stylesheet'>
    <link href='//fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link href='//fonts.googleapis.com/css?family=Archivo Black' rel='stylesheet'>
    <link href='//fonts.googleapis.com/css?family=Trade Winds' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="<?php //echo base_url(); ?>css/style.css">
    <script src="<?php //echo base_url(); ?>js/index.js"></script>
    <script type="text/javascript">const tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/"); document.write(unescape("<script src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript' %3E%3C/script%3E"));
</script>
    <title><?php //echo APP_NAME ?></title>
</head> 

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <script src="<?php echo base_url(); ?>js/index.js"></script>
    <title><?php echo APP_NAME ?></title>
</head>
<body>
    <div class="container" text-align="center">
        <h2><?php echo APP_NAME ?></h2>
        <p></p>
        <div class="form-horizontal">
        <?php
            $url_text   = 'login/verificar';
            //$encriptado = $this->encrypt->encode($url_text);
        ?>
        <?php echo form_open(base_url().$url_text); ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">User:</label>
            <div class="col-sm-5">
                <input type="input" class="form-control" id="usuario" placeholder="ingrese su usuario" name="usuario">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Password:</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="password" placeholder="ingrese su contraseña" name="password">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" value="Register" />
            </div>
        </div>
            
        <?php echo form_close() ?>
        </div>
    </div>
    <div  class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-8 sidenav">
                <div class="well">
                    <img src="<?php echo base_url()?>media/logo.png">
                </div>
        </div>
    </div>
</div>
<script language="JavaScript" type="text/javascript">TrustLogo("https://micuenta.donweb.com/img/sectigo_positive_sm.png", "CL1", "none");</script><a href="https://donweb.com/es-ar/certificados-ssl" id="comodoTL" title="Certificados SSL Argentina">Certificados SSL Argentina</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>