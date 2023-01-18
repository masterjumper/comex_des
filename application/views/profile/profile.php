<body>
<?php echo form_open_multipart('Profile/update/');?>
    <table class="table table-hover" >
        <caption>&nbsp;</caption>
        <thead></thead>
        <tbody>
            <tr>
                <td class="col-xs-2"><?php echo $titulo_user;?></td>
                <td class="col-xs-2"><input type="input" readonly class="form-control" id="usuuser" name="usuuser"  value='<?php echo $usuario->usuuser;?>'></td>
            </tr>
            <tr>
                <td class="col-xs-2"><?php echo $titulo_pass;?></td>
                <td class="col-xs-2"><input type="password" class="form-control" id="usupass" name="usupass"  value='<?php echo $pass;?>'></td>
            </tr>
            <tr>
                <td class="col-xs-2"><?php echo $titulo_nom;?></td>
                <td class="col-xs-2"><input type="input" class="form-control" id="usunom" name="usunom" value='<?php echo $usuario->usunom;?>'></td>
            </tr>
            <tr>
                <td class="col-xs-2"><?php echo $titulo_ape;?></td>
                <td class="col-xs-2"><input type="input" class="form-control" id="usuape" name="usuape" value='<?php echo $usuario->usuape;?>'></td>
            </tr>
            <tr>
                <td class="col-xs-2"><?php echo $titulo_mail;?></td>
                <td class="col-xs-2"><input type="input" class="form-control" id="usumai" name="usumai" value='<?php echo $usuario->usumai;?>'></td>
            </tr>              
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <button type="submit" class="btn btn-primary" value="<?php echo $titulo_btn_guardar;?>">
                                <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Save" data-placement="top" title="Save"></span>    
                                <?php echo $titulo_btn_guardar;?>
                            </button>
                            <?=form_close()?>
                        </td>
                        <td>
                            &nbsp;                     
                        </td>
                        <td>
                        <?php echo form_open(base_url().'login/inicio');?>                            
                            <button type="submit" class="btn btn-warning" value="<?php echo $titulo_btn_cancelar;?>">
                                <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" data-toggle="Cancelar" data-placement="top" title="Cancelar"></span>
                                <?php echo $titulo_btn_cancelar;?>
                            </button>                        
                        <?=form_close()?> 
                        </td>
                    </td>
                </table>                
            </td>
        </tr>
        </tbody>
    </table>
</body>