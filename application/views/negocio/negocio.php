<body>
    <table class="table table-hover" table-layout="fixed"  white-space="nowrap">

        <?php foreach($negocio as $item) { ?>
            <?php echo form_open(base_url().'negocio/save/'.$item->negid); ?>
            <tr>
                <!-- <td  class="col-xs-5">Id</td> -->
                <!-- <td></td> -->
                <input class="form-control hidden"  type="input" name="gruid" readonly value=<?php echo $item->negid;?>>
            </tr>
            <tr>
            <td class="col-xs-5">BBE Ref. #</td>
                <td><input class="form-control" type="input" name="negbberef" value="<?php echo $item->negbberef;?>"></td>
            </tr>
            <tr>
            <td class="col-xs-5">Customer Ref. #</td>
                <td><input class="form-control" type="input" name="negcusref" value="<?php echo $item->negcusref;?>"></td>
            </tr>
            <tr>
                <td class="col-xs-5">Negocio</td>
                <td><input class="form-control" type="input" name="negnom" value="<?php echo $item->negnom;?>"></td>
            </tr>
            
            
            <tr>
                <td class="col-xs-5">Descripcion</td>
                <td><input class="form-control" type="input" name="negdsc" value="<?php echo $item->negdsc;?>"></td>
            </tr>
            <tr>
                <td class="col-xs-5">Fecha</td>
                <td><input class="form-control" type="date" name="negfec" value=<?php echo $item->negfec;?>></td>
            </tr>
            <tr>
                <td class="col-xs-5">Empresa</td>
                <td class="col-xs-5">
                    <select class="form-control" id="empid" name="empid">
                        <?php foreach ($empresas as $empresa){?>
                            <?php if ($item->empid === $empresa->empid){ ?>
                                <option selected value='<?php echo $empresa->empid;?>'><?php echo $empresa->emprazsoc; ?></option>
                            <?php }else{ ?>
                                <option value='<?php echo $empresa->empid;?>'><?php echo $empresa->emprazsoc; ?></option>
                            <?php }}?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="col-xs-5">Estado</td>
                <td>
                    <select class="form-control" id="negest" name="negest">
                        <?php if ($item->negest == 1){ ?>
                            <option selected value = 1><?php echo 'Cerrado'; ?></option>
                            <option value = 2><?php echo 'En Proceso'; ?></option>
                        <?php }else{ ?>
                            <option selected value = 2><?php echo 'En Proceso'; ?></option>
                            <option  value = 1><?php echo 'Cerrado'; ?></option>
                        <?php }?>
                    </select>
                </td>
            </tr>

        <?php } ?>
        <tr>
            <td><!-- <input type="submit" class="btn btn-primary" value="Guardar" /> -->
            <button type="submit" class="btn btn-primary" value="Guardar">
                        <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Aceptar" data-placement="top" title="Aceptar"></span>    
                        Aceptar
                    </button>
                <?=form_close()?>                
                <a href=<?php echo (base_url()."negocio/index/".$_SESSION['current_page']);?>>
                    <!-- <submit type="submit" class="btn btn-danger"> Cancelar</submit> -->
                    <button type="submit" class="btn btn-warning" value="Cancelar">
                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" data-toggle="Cancelar" data-placement="top" title="Cancelar"></span>    
                        Cancelar
                    </button>
                </a>
            </td>
        </tr>
    </table>
</body>
