<body>
<?php echo form_open(base_url().'Negocio/filtro/');?>
<div class="form-group">
    <div class="col-sm-10">
        <table>
            <tbody>
            <tr>                                
                <td class="col-xs-3">                                               
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="BBE Ref. #" name="filtro_negbberef">
                    </div>
                </td>
                <!-- <td class="col-xs-1 col-sm-1">Fecha<input type="date" name="filtro_negfec"></></td> -->
                <td class="col-xs-1">                                               
                        <div class="input-group">
                            <input type="date" class="form-control" placeholder="Fecha" name="filtro_negfec">                            
                        </div>
                    </td>  
                <td class="col-xs-5">
                    <select class="form-control" id="filtro_empid" name="filtro_empid">
                        <?php foreach ($empresas as $empresa){?>
                            <option value='<?php echo $empresa->empid;?>'><?php echo $empresa->emprazsoc; ?></option>
                        <?php }?>
                        <option selected value=''><?php echo 'Empresas' ?></option>
                    </select>
                </td>
                <td class="col-xs-1">
                        <button class="btn btn-primary" type="input"  data-toggle="Buscar" data-placement="top" title="Buscar">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>                                     
                        </button>
                </td>
            </tr>
            </tbody>            
        </table>
    </div>
</div>
<?=form_close()?>
</body>
<body>
    <form class="form-horizontal" action="#">
        <div class="form-group">
            <div class="col-sm-10">
                <table class="table table-hover" width="50%" table-layout="fixed" white-space="nowrap">
                    <caption> </caption>
                    <thead>
                    <th class="col-xs-2">&nbsp;</th>
                    <!-- <th class="col-xs-2">Id</th> -->
                    <th class="col-xs-2" nowrap="true">BBE Ref. #</th>
                    <th class="col-xs-2" nowrap="true">Customer Ref. #</th>
                    <!-- <th class="col-xs-2" nowrap="true">Negocio</th> -->
                    <th class="col-xs-2">Fecha</th>
                    <th class="col-xs-2" nowrap="true">Empresa</th>
                    <th class="col-xs-2">Estado</th>
                    <th class="col-xs-2">Docs./Arch.</th>
                    <th class="col-xs-2"> <a href=<?php echo base_url().'negocio/new_negocio/';?>>
                        <submit name = "t" class="btn btn-primary" type="submit" data-toggle="Agregar" data-placement="top" title="Agregar"><i class="bi bi-plus-lg"></i></submit></th>        
                    <th><a href=<?php echo base_url().'negocio/createExcel/' ?> target="_blank"> <submit class="btn btn-success" type="submit" data-toggle="Exportar a Planilla" data-placement="top" title="Exportar a Planilla"><span class="glyphicon glyphicon-cloud-download"></span></submit></a></a></th>
                </thead>
                    </thead>
                    <tbody>
                    <?php foreach($negocios as $negocio){ ?>
                    <tr>
                        <!-- <td class="col-xs-2"><a href=<?php //echo base_url().'negocio/update/'.$negocio->negid;?>>
                                <submit class="btn btn-info" type="submit">Ver</submit></a>
                        </td> -->                                            
                        <td class="col-xs-2"><a href=<?php echo base_url().'negocio/update/'.$negocio->negid ;?>>
                                <submit class="btn btn-info" type="submit" data-toggle="Editar" data-placement="top" title="Editar"><i class="bi bi-pencil-fill"></i></submit></a>
                        </td>
                        <td class="col-xs-2" nowrap="true"><?php echo trim($negocio->negbberef); ?></td>                        
                        <td class="col-xs-2" nowrap="true"><?php echo trim($negocio->negcusref); ?></td>    
                        <!-- <td class="col-xs-2"><?php //echo $negocio->negid;?></td> -->
                        <!-- <td class="col-xs-2" nowrap="true"><?php //echo trim($negocio->negnom); ?></td> -->                        
                        <td class="col-xs-2" nowrap="true"><?php echo trim($negocio->negfec); ?></td>
                        <td class="col-xs-2" nowrap="true"><?php echo trim($negocio->emprazsoc); ?></td>
                        
                        <td class="col-xs-2" nowrap="true">
                            <?php if($negocio->negest == 1){ ?>
                                <a href=<?php echo base_url().'negocio/negocio_modifica_estado/'.$negocio->negid;?>>
                                    <span class="btn btn-danger glyphicon glyphicon-lock" data-toggle="Cerrado" data-placement="top" title="Cerrado"></span>
                                </a>
                            <?php }else{ ?>
                                <a href=<?php echo base_url().'negocio/negocio_modifica_estado/'.$negocio->negid;?>>
                                    <span class="btn btn-success glyphicon glyphicon-cog" data-toggle="En Proceso" data-placement="top" title="En Proceso"></span>
                                </a>
                            <?php } ?>
                        </td>
                        </td>
                        <td class="col-xs-2"><a href=<?php echo base_url().'documento/index/'.$negocio->negid;?>>
                            <submit class="btn btn-primary" type="submit" data-toggle="Arch./Docs." data-placement="top" title="Arch./Docs."><i class="fa fa-book"></i></submit></a>
                        </td>   
                        <td class="col-xs-2"><a href=<?php echo base_url().'negocio/borrar/'.$negocio->negid ;?>>
                            <submit class="btn btn-danger" type="submit" data-toggle="Eliminar" data-placement="top" title="Eliminar"><i class="bi bi-trash-fill"></i></a>
                        </td>        
                        <td>&nbsp;</td>
                    </tr>
                    <?php } //}?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container">
            <b><?php echo $links; ?></b>
        </div>
    </form>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>        
</body>
<script>
    <?php if($this->session->flashdata('success')){ ?>
    Swal.fire({
        position: 'center',
        icon: 'success',
        text: '<?php echo $this->session->flashdata('success'); ?>',
        showConfirmButton: false,
        timer: 1500
    });
    <?php } ?>


    <?php if($this->session->flashdata('error')){ ?>
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: '<?php echo $this->session->flashdata('error'); ?>',
            showConfirmButton: true,
            timer: 1500
        });
    <?php } ?>



    <?php if($this->session->flashdata('delete')){ ?>        
    Swal.fire({
        position: 'center',
        title: 'Seguro de Eliminar este Registro?',
        text: "No se podra Revertir!",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',        
        cancelButtonText: 'NO',
        confirmButtonText: 'SI'
    }).then((result)=>{
        if(result.isConfirmed){
        $.ajax({
            type:"DELETE",
            url: "<?php echo base_url().'negocio/delete/'.$this->session->flashdata('delete');?>",
            success:function(datos){                                
                var jsonData = JSON.parse(datos);                
                //console.log(jsonData);
                if (jsonData.success == "1")                
                {                    
                    Swal.fire({
                        position: 'center',
                        icon: 'error',                        
                        text:jsonData.text,
                        showConfirmButton: true,
                        timer: 1000000
                    });    
                }else{
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Se Elimino con Exito',
                    showConfirmButton: false,
                    timer: 1500
                    });                                    
                }
                //window.location = "<?php //echo base_url().'e/i/';?>";
            },
            error: function() {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: 'Ocurrio un Problema',
                    showConfirmButton: false,
                    timer: 1500
                });                
            }
        });
    }
    })
    <?php } ?>
    
</script>