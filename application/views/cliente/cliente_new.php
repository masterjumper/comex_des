<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
    <?php echo form_open(base_url().'Cliente/save_new/'); ?>
    <tr>
        <td class="col-xs-2">Usuario</td>
        <td class="col-xs-2"><input type="input" class="form-control" id="usuuser" name="usuuser"></td>
    </tr>
    <tr>
        <td class="col-xs-2">Contraseña</td>
        <td class="col-xs-2"><input type="password" class="form-control" id="usupass" name="usupass"></td>
    </tr>
    <tr>
        <td class="col-xs-2">Nombre</td>
        <td class="col-xs-2"><input type="input" class="form-control" id="usunom" name="usunom"></td>
    </tr>
    <tr>
        <td class="col-xs-2">Apellido</td>
        <td class="col-xs-2"><input type="input" class="form-control" id="usuape" name="usuape"></td>
    </tr>
    <tr>
        <td class="col-xs-2">Correo Electronico</td>
        <td class="col-xs-2"><input type="input" class="form-control" id="usumai" name="usumai"></td>
    </tr>
    <tr>
        <td class="col-xs-2">Lista Correo Electronico</td>
        <td class="col-xs-2">
            <textarea name="usulstmai" id="usulstmai" rows="5" cols="75"></textarea>
    </tr>
    <tr>
        <td class="col-xs-2">Empresa</td>
        <td class="col-xs-2">
            <select class="form-control" id="empid" name="empid">
                <?php foreach ($empresas as $empresa){?>
                    <option value='<?php echo $empresa->empid;?>'><?php echo $empresa->emprazsoc; ?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="col-xs-2">Estado</td>
        <td>
            <select class="form-control" id="usuest" name="usuest">
                    <option selected value='<?php echo '1' ?>'><?php echo 'Habilitado' ?></option>
                    <option  value='<?php echo '0';?>'><?php echo 'Deshabilitado'; ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <!-- <td>
            <input type="submit" class="btn btn-primary" value="Guardar" />
            <? //=form_close();?>
            <a href=<?php //echo base_url().'Cliente/index';?>>
                <submit type="submit" class="btn btn-danger"> Cancelar</submit></a>
        </td>-->
        <td> 
            <button type="submit" class="btn btn-primary" value="Guardar">
                <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Aceptar" data-placement="top" title="Aceptar"></span>    
                Aceptar
            </button>
            <?=form_close()?>
            <a href=<?php echo (base_url()."Cliente/index");?>>
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
