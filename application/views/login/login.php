<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
    <script type="text/javascript">const tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/"); document.write(unescape("<script src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript' %3E%3C/script%3E"));</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <style>
        .swal2-popup {
        font-size: 1.0rem !important;
        }
    </style> 
    <title><?php echo APP_NAME ?></title>
</head>
<body>
    <div class="container">            
        <h2 class="text-center"><?php echo APP_NAME ?></h2>
        <p></p>   
        <div class="row p-5">
            <div class="col align-self-center">
                <?php
                    $url_text   = 'login/verificar';
                    //$encriptado = $this->encrypt->encode($url_text);
                ?>
                <?php echo form_open(base_url().$url_text); ?>                     
                <div class="container">
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col">
                            <div class="d-grid gap-1">
                                <label for="staticEmail2" class="visually-hidden">User:</label>                                
                                <input type="text" class="form-control" id="usuario" placeholder="User" name="usuario">
                            </div>
                            <p></p>
                            <div class="d-grid gap-1">
                                <label for="inputPassword2" class="visually-hidden">Password:</label>                                
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                            </div>
                            <p></p>                                
                            <div class="d-grid gap-1">
                                <button type="submit" class="btn btn-primary inline-block">Register</button>
                            </div>                                
                        </div>
                        <div class="col">                            
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>  
            <div>
        <div>
    </div> 
      
    <div class="container-fluid text-center">
        <img src=<?php echo base_url().'media/logo.png'?>>
        <script language="JavaScript" type="text/javascript">TrustLogo("https://micuenta.donweb.com/img/sectigo_positive_sm.png", "CL1", "none");</script><a href="https://donweb.com/es-ar/certificados-ssl" id="comodoTL" title="Certificados SSL Argentina">Certificados SSL Argentina</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        <?php if($this->session->flashdata('error')){ ?>
            Swal.fire({
                icon: 'error',
                title: '<?php echo $this->session->flashdata('title'); ?>',
                text: '<?php echo $this->session->flashdata('error'); ?>',
                //footer: '<a href="">Why do I have this issue?</a>'
                })
        <?php } ?>
    </script>
</body>
</html>