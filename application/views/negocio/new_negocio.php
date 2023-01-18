<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
    <?php echo form_open(base_url().'negocio/save_new/'); ?>
    <tr>
        <td class="col-xs-5">BBE Ref. #</td>
        <td><input class="form-control" type="input" name="negbberef" value=""></td>
    </tr>
    <tr>
        <td class="col-xs-5">Customer Ref. #</td>
        <td><input class="form-control" type="input" name="negcusref" value=""></td>
    </tr>
    <tr>
        <td class="col-xs-5">Negocio</td>
        <td><input class="form-control" type="input" name="negnom" value=""></td>
    </tr>    
    <tr>
        <td class="col-xs-5">Descripcion</td>
        <td><input class="form-control" type="input" name="negdsc" value=""></td>
    </tr>
    <tr>
        <td class="col-xs-5">Fecha</td>
        <td><input class="form-control" type="date" name="negfec" value=""></td>
    </tr>
    <tr>
        <td class="col-xs-5">Estado</td>
        <td>
            <select class="form-control" id="negest" name="negest">
                <option  value='<?php echo '1' ?>'><?php echo 'Cerrado' ?></option>
                <option  selected value='<?php echo '2';?>'><?php echo 'En Proceso'; ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="col-xs-5">Empresa</td>
        <td class="col-xs-5">
            <select class="form-control" id="empid" name="empid">
                <?php foreach ($empresas as $empresa){?>
                        <option value='<?php echo $empresa->empid;?>'><?php echo $empresa->emprazsoc; ?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <button type="submit" class="btn btn-primary" value="Guardar">
                <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Aceptar" data-placement="top" title="Aceptar"></span>    
                Aceptar
            </button>
            <?=form_close()?>
            <a href=<?php echo (base_url()."negocio/index/");?>>
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