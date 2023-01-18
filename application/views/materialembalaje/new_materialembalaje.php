<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
    <?php echo form_open(base_url().'MaterialEmbalaje/save_new/'); ?>
    <tr>
        <td class="col-xs-5">Material de Embalaje</td>
        <td><input class="form-control" type="input" name="matembdsc" value=""></td>
    </tr>
    <?php // } ?>
    <tr>
        <td><input type="submit" class="btn btn-primary" value="Guardar" />
            <?=form_close()?>
            <a href=<?php echo (base_url()."MaterialEmbalaje/index/");?>>
                <submit type="submit" class="btn btn-danger"> Cancelar</submit></a>
        </td>
    </tr>

</table>
</body>