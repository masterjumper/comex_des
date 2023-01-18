<body>
    <table class="table table-hover" table-layout="fixed"  white-space="nowrap">
        <?php echo form_open(base_url().'Usuario/save_new/'); ?>
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
            <td class="col-xs-2">Grupo</td>
            <td class="col-xs-2">
                <select class="form-control" id="gruid" name="gruid">
                    <?php foreach($grupos as $grupo){ ?>
                        <option value=<?php echo $grupo->gruid;?>><?php echo $grupo->grudsc; ?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="col-xs-2">Sector Fabrica</td>
            <td class="col-xs-2">
                <select class="form-control" id="secfabid" name="secfabid">
                    <?php foreach($sectorfabrica as $secfab){ ?>
                        <option value= <?php echo $secfab->secfabid;?>><?php echo $secfab->secfabdsc; ?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" class="btn btn-primary" value="Guardar" />
                <?=form_close();?>
            </td>
            <td><a href=<?php echo base_url().'Usuario/index';?>>
                    <submit type="submit" class="btn btn-danger"> Cancelar</submit></a></td>
        </tr>
    </table>
</body>
