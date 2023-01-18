<body>
        <table class="table table-hover" table-layout="fixed"  white-space="nowrap">
            <?php echo form_open(base_url().'MaterialEmbalaje/save/'); ?>
            <?php foreach($materialembalaje as $item) { ?>
                <tr>
                    <!-- <td  class="col-xs-5">Id</td> -->
                    <td><input class="form-control hidden" type="input" name="matembid" readonly value=<?php echo $item->matembid;?>></td>
                </tr>
                <tr>
                    <td class="col-xs-5">Material de Embalaje</td>
                    <td><input class="form-control" type="input" name="matembdsc" value="<?php echo $item->matembdsc;?>"></td>
                </tr>

            <?php } ?>
            <tr>
                <td><input type="submit" class="btn btn-primary" value="Guardar" />
                    <?=form_close()?>
                    <a href=<?php echo (base_url()."MaterialEmbalaje/index/");?>>
                        <submit type="submit" class="btn btn-danger"> Cancelar</submit></a>
                </td>
            </tr>
        </table>
</body>
