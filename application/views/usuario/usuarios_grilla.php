<body>
<?php echo form_open(base_url().'index.php?/Usuario/filtro/');?>
<div class="form-group">
        <div class="col-sm-12">
            <table>
                <tbody>
                <tr>                                       
                    <td class="col-xs-1">                                               
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Usuario" name="filtro_usuuser">
                        </div>
                    </td>                    
                    <td class="col-xs-1">                                               
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nombre" name="filtro_usunom">                            
                        </div>
                    </td>                    
                    <td class="col-xs-1">                                               
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Apellido" name="filtro_usuape">                            
                        </div>
                    </td>                    
                    <td class="col-xs-3">
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
<form class="form-horizontal" action="#">
    <div class="form-group">
        <div class="col-sm-10">
                <table class="table table-striped" table-layout="fixed" white-space="nowrap">
                <thead>
                <th class="col-xs-2">&nbsp;</th>
                <th class="col-xs-2">Usuario</th>
                <th class="col-xs-5">Nombre</th>
                <th class="col-xs-2">Apellido</th>
                <th class="col-xs-2" nowrap="true">Grupo</th>
                <th class="col-xs-2" nowrap="true">Estado</th>
                <th class="col-xs-2" nowrap="true">Rec.Correo</th>
                <th class="col-xs-2"> <a href=<?php echo base_url().'Usuario/agregar_usuario/';?>>
                        <submit name = "t" class="btn btn-primary" type="submit" data-toggle="Agregar" data-placement="top" title="Agregar"><i class="bi bi-plus-lg"></i></submit></th>
                </thead>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($usuarios as $usu){ ?>
                        <td class="col-xs-2"><a href=<?php echo base_url().'Usuario/usuario/'.$usu->usuid ;?>>
                        <submit class="btn btn-info" type="submit" data-toggle="Editar" data-placement="top" title="Editar"><i class="bi bi-pencil-fill"></i></submit>
                    </a>
                        </td>
                        <td class="col-xs-2"><?php echo $usu->usuuser ;?></td>
                        <td class="col-xs-5"><?php echo $usu->usunom; ?></td>
                        <td class="col-xs-2"><?php echo $usu->usuape; ?></td>
                        <td class="col-xs-2" nowrap="true"><?php echo $usu->grudsc; ?></td>
                        <td class="col-xs-2" nowrap="true">
                            <?php if($usu->usuest == 1){ ?>
                                <a href=<?php echo base_url().'Usuario/usuario_modifica_estado/'.$usu->usuid;?>>
                                <submit type="submit">
                                        <span class="label label-success">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="Habilitado" data-placement="top" title="Habilitado"></span>
                                        </span>
                                    </submit>

                            <?php }else{ ?>
                                <a href=<?php echo base_url().'Usuario/usuario_modifica_estado/'.$usu->usuid;?>>
                                <submit  type="submit">
                                        <span class="label label-danger">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true" data-toggle="Habilitado" data-placement="top" title="Deshabilitado"></span>
                                        </span>
                                    </submit>
                                </a>
                            <?php } ?>
                        </td>
                        <td class="col-xs-2" nowrap="true">
                            <?php if($usu->usumarmai == 1){ ?>
                                <a href=<?php echo base_url().'Usuario/usuario_modifica_reccorr/'.$usu->usuid;?>>
                                <submit type="submit">
                                        <span class="label label-success">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="Recibe Correo" data-placement="top" title="Recibe Correo"></span>
                                        </span>
                                    </submit>

                            <?php }else{ ?>
                                <a href=<?php echo base_url().'Usuario/usuario_modifica_reccorr/'.$usu->usuid;?>>
                                <submit  type="submit">
                                        <span class="label label-danger">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true" data-toggle="No Recibe Correo" data-placement="top" title="No Recibe Correo"></span>
                                        </span>
                                    </submit>
                                </a>
                            <?php } ?>
                        </td>
                        <td class="col-xs-2"><a href=<?php echo base_url().'Usuario/delete/'.$usu->usuid ;?>>
                                <submit class="btn btn-danger" type="submit">X</submit></a>
                        </td>
                        <td class="col-xs-2"><a href="#">
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <div class="col-xs-12"><?php echo $links; ?></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</form>
<!-- <form class="form-horizontal" action="#">
<table id="tablaLinks" class="tablaColor">
    <thead>
    <tr>
        <td class="tg-6k2t" align="center"><?php //echo $links; ?></td>
    </tr>
    </thead>
</table>
</form> -->
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
            url: "<?php echo base_url().'empresa/delete/'.$this->session->flashdata('delete');?>",
            success:function(datos){                                
                var jsonData = JSON.parse(datos);                
                //console.log(jsonData);
                if (jsonData.success == "1")                
                {                    
                    /* Swal.fire({
                        position: 'center',
                        icon: 'error',
                        text: 'El Proveedor Posee Documentos',
                        showConfirmButton: true,
                        timer: 1000000
                    });    
                }else{ */
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

    <?php if($this->session->flashdata('changeEmpEst')){ ?>        
    Swal.fire({
        position: 'center',
        title: 'Modifica el Estado de la Empresa?',
        //text: "No se podra Revertir!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',        
        cancelButtonText: 'NO',
        confirmButtonText: 'SI'
    }).then((result)=>{
        if(result.isConfirmed){
        $.ajax({
            type:"SET",
            url: "<?php echo base_url().'empresa/set_EmpEst/'.$this->session->flashdata('changeEmpEst');?>",
            success:function(datos){                                
                var jsonData = JSON.parse(datos);                
                //console.log(jsonData);
                if (jsonData.success == "1")                
                {                    
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        //text: 'El Proveedor Posee Documentos',
                        text:jsonData.text,
                        showConfirmButton: false,
                        timer: 3000
                    });                                        
                    window.location = "<?php //echo base_url().'negocio/index/';?>";    
                }         
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