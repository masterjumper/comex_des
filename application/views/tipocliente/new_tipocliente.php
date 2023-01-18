<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
    <?php echo form_open(base_url().'tipoCliente/save_new/'); ?>
    <tr>
        <td class="col-xs-5">Descripcion</td>
        <td><input class="form-control" type="input" name="tipdsc" value=""></td>
    </tr>
    <?php // } ?>
    <tr>
        <td><input type="submit" class="btn btn-primary" value="Guardar" />
            <?=form_close()?>
            <a href=<?php echo (base_url()."tipoCliente/index/");?>>
                <submit type="submit" class="btn btn-danger"> Cancelar</submit></a>
        </td>
    </tr>

</table>
</body>