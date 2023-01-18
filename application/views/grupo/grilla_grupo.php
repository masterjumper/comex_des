<body>
    <form class="form-horizontal" action="#">
        <div class="form-group">
            <div class="col-sm-10">
                <table class="table table-hover" width="50%" table-layout="fixed" white-space="nowrap">
                    <caption> </caption>
                    <thead>
                    <th class="col-xs-2">&nbsp;</th>
                    <th class="col-xs-2">Id</th>
                    <th class="col-xs-8" nowrap="true">Grupo</th>
                    <th class="col-xs-5">Template</th>
                    <th class="col-xs-5" nowrap="true"></th>
                    </thead>
                    <tbody>
                    <?php foreach($grupos as $grupo){ ?>
                    <tr>

                        <td class="col-xs-2"><a href=<?php echo base_url().'grupo/update/'.$grupo->gruid;?>>
                                <submit class="btn btn-info" type="submit">Ver</submit></a>
                        </td>
                        <td class="col-xs-2"><?php echo $grupo->gruid;?></td>
                        <td class="col-xs-8" nowrap="true"><?php echo trim($grupo->grudsc); ?></td>
                        <td class="col-xs-5"><?php echo trim($grupo->grutem); ?></td>
                        <td class="col-xs-5"><a href=<?php echo base_url().'grupo/delete/'.$grupo->gruid;?>>
                                <submit class="btn btn-danger" type="submit">X</submit></a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <!--
                        <td class="col-xs-2"><a href=<?php //echo base_url().'carrito/modificar_comprobante/'.$compro_reciente->numped ;?>>
                                <submit class="btn btn-primary" type="submit">Modificar</submit></td>
                        <td class="col-xs-2"><a href=<?php // echo base_url().'mispedidos/eliminar_comprobante/'.$compro_reciente->numped ;?>>
                                <submit class="btn btn-danger" type="submit">Eliminar</submit></td>
                        -->
                    </tr>
                    <?php } //}?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <a href=<?php echo base_url().'grupo/new_grupo/';?>>
        <submit class="btn btn-primary" type="submit">Agregar</submit></a>
</body>