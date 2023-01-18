<body>
        <table class="table table-hover" table-layout="fixed"  white-space="nowrap">
            <?php echo form_open(base_url().'tipoCliente/save/'); ?>
            <?php foreach($tipocliente as $item) { ?>
                <tr>
                    <!-- <td  class="col-xs-5">Id</td> -->
                    <td><input class="form-control hidden" type="input" name="tipid" readonly value=<?php echo $item->tipid;?>></td>
                </tr>
                <tr>
                    <td class="col-xs-5">Descripcion</td>
                    <td><input class="form-control" type="input" name="tipdsc" value="<?php echo $item->tipdsc;?>"></td>
                </tr>

            <?php } ?>
            <tr>
                <td><input type="submit" class="btn btn-primary" value="Guardar" />
                    <?=form_close()?>
                    <a href=<?php echo (base_url()."tipoCliente/index/");?>>
                        <submit type="submit" class="btn btn-danger"> Cancelar</submit></a>
                </td>
            </tr>
        </table>
</body>
