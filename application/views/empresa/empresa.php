<body>
        <table class="table table-hover" table-layout="fixed"  white-space="nowrap">
            <?php echo form_open(base_url().'empresa/save/'); ?>
            <?php foreach($empresa as $item) { ?>
                <tr>                    
                    <td><input class="form-control hidden" type="input" name="empid" readonly value=<?php echo $item->empid;?>></td>
                </tr>
                <tr>
                    <td class="col-xs-5">Empresa</td>
                    <td><input class="form-control" type="input" name="emprazsoc" value="<?php echo $item->emprazsoc;?>"></td>
                </tr>
                <tr>
                    <td class="col-xs-5">Tag SAP</td>
                    <td><input class="form-control" type="input" name="emptagsap" value="<?php echo $item->emptag;?>"></td>
                </tr>
                <tr>
                    <td class="col-xs-2">Tipo de Empresa</td>
                    <td>
                        <select class="form-control" id="tipid" name="tipid">                   
                        <?php foreach ($tipocliente as $val) {               
                            if ( $val->tipid == $item->tipid) { ?>               
                            <option selected value='<?php echo $val->tipid;?>'><?php echo $val->tipdsc; ?></option>
                            <?php }else{ ?>
                                <option value='<?php echo $val->tipid;?>'><?php echo $val->tipdsc; ?></option>
                        <?php }} ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td class="col-xs-2">Estado</td>
                    <td>
                        <select class="form-control" id="empest" name="empest">
                            <?php if ($item->empest == 1){ ?>
                                <option selected value=<?php echo 1 ?>><?php echo 'Habilitado' ?></option>
                                <option value=<?php echo 0 ?>><?php echo 'Deshabilitado' ?></option>
                            <?php }else{ ?>
                                <option  value=<?php echo 1 ?>><?php echo 'Habilitado' ?></option>
                                <option selected value=<?php echo 0;?>><?php echo 'Deshabilitado'; ?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                
            <?php } ?>
            <tr>
                <td><button type="submit" class="btn btn-primary" value="Guardar">
                        <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Aceptar" data-placement="top" title="Aceptar"></span>    
                        Aceptar
                    </button>
                    <?=form_close()?>
                    <a href=<?php echo (base_url()."empresa/index/".$_SESSION['current_page']);?>>
                        <!-- <submit type="submit" class="btn btn-danger"> Cancelar</submit> -->
                        <button type="submit" class="btn btn-warning" value="Cancelar">
                            <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" 
                            data-toggle="Cancelar" data-placement="top" title="Cancelar">                                
                            </span>    
                            Cancelar
                        </button>
                    </a>
                </td>
            </tr>
        </table>
</body>
