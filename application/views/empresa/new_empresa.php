<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
    <?php echo form_open(base_url().'empresa/save_new/'); ?>
    <tr>
        <td class="col-xs-5">Descripcion</td>
        <td><input class="form-control" type="input" name="emprazsoc" value=""></td>
    </tr>
    <tr>
        <td class="col-xs-5">Tag SAP</td>
        <td><input class="form-control" type="input" name="emptagsap" value=""></td>
    </tr>
    <tr>
        <td class="col-xs-2">Tipo de Empresa</td>
        <td>
            <select class="form-control" id="tipid" name="tipid">                   
            <?php foreach ($tipocliente as $item) { ?>               
                <option value='<?php echo $item->tipid;?>'><?php echo $item->tipdsc; ?></option>
            <?php } ?>
        </select>
        </td>
    </tr>
    <tr>
        <td class="col-xs-2">Estado</td>
        <td>
            <select class="form-control" id="empest" name="empest">
                <option selected value='<?php echo '1' ?>'><?php echo 'Habilitado' ?></option>
                <option  value='<?php echo '0';?>'><?php echo 'Deshabilitado'; ?></option>
            </select>
        </td>
    </tr>
    
    
    <tr>
        <td><button type="submit" class="btn btn-primary" value="Guardar">
        <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Agregar" data-placement="top" title="Agregar"></span>    
        Aceptar
        </button>
            <?=form_close()?>
            <a href=<?php echo (base_url()."empresa/index/");?>>
                    <!-- <submit type="submit" class="btn btn-danger"> Cancelar</submit> -->
                <button type="submit" class="btn btn-warning" value="Cancelar">
                    <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" data-toggle="Agregar" data-placement="top" title="Agregar"></span>    
                    Cancelar
                </button>
            </a>    
        </td>
    </tr>

</table>
</body>