<body>
<?php echo form_open(base_url().'Cliente/filtro/');?>
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
                    <td  class="col-xs-3">
                        <select class="form-control" id="filtro_empid" name="filtro_empid">
                            <?php foreach ($empresas as $empresa){?>
                                <option value='<?php echo $empresa->empid;?>'><?php echo $empresa->emprazsoc; ?></option>
                            <?php }?>
                            <option selected value=''><?php echo 'Empresas' ?></option>
                        </select>                        
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
<body>
<form class="form-horizontal" action="#">
    <div class="form-group">
        <div class="col-sm-10">
                <table class="table table-striped" table-layout="fixed" white-space="nowrap">
                <thead>
                <th class="col-xs-2">&nbsp;</th>
                <th class="col-xs-2">Usuario</th>
                <th class="col-xs-2">Nombre</th>
                <th class="col-xs-2">Apellido</th>
                <th class="col-xs-2" nowrap="true">Empresa</th>
                <!-- <th class="col-xs-2" nowrap="true">Grupo</th> -->
                <th class="col-xs-2" nowrap="true">Estado</th>
                <th class="col-xs-2"> <a href=<?php echo base_url().'Cliente/agregar_cliente/';?>>
                        <submit name = "t" class="btn btn-primary" type="submit" data-toggle="Agregar" data-placement="top" title="Agregar"><i class="bi bi-plus-lg"></i></submit></th>
                <th><a href=<?php echo base_url().'Cliente/createExcel/' ?> target="_blank"> <submit class="btn btn-success" type="submit" data-toggle="Exportar a Planilla" data-placement="top" title="Exportar a Planilla"><span class="glyphicon glyphicon-cloud-download"></span></submit></a></a></th>                        
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($usuarios as $usu){ ?>
                        <td class="col-xs-2"><a href=<?php echo base_url().'Cliente/cliente/'.$usu->usuid ;?>>
                                <submit class="btn btn-info" type="submit"data-toggle="Editar" data-placement="top" title="Editar"><i class="bi bi-pencil-fill"></i></submit></a>
                        </td>
                        <td class="col-xs-2"><?php echo $usu->usuuser ;?></td>
                        <td class="col-xs-2"><?php echo $usu->usunom; ?></td>
                        <td class="col-xs-2"><?php echo $usu->usuape; ?></td>
                        <td class="col-xs-2"><?php echo $usu->emprazsoc; ?></td>
                        <!-- <td class="col-xs-2" nowrap="true"><?php //echo $usu->grudsc; ?></td> -->
                        <td class="col-xs-1" nowrap="true">
                            <?php if($usu->usuest == 1){ ?>
                                <a href=<?php echo base_url().'Cliente/cliente_modifica_estado/'.$usu->usuid;?>>
                                    <submit type="submit">
                                    <span class="label label-success">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="Habilitado" data-placement="top" title="Habilitado"></span>
                                        </span>
                                    </submit>
                                </a>
                            <?php }else{ ?>
                                <a href=<?php echo base_url().'Cliente/cliente_modifica_estado/'.$usu->usuid;?>>
                                    <submit type="submit">
                                        <span class="label label-danger">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true" data-toggle="Habilitado" data-placement="top" title="Deshabilitado"></span>
                                        </span>
                                    </submit>
                                </a>
                            <?php } ?>
                        </td>
                        <td class="col-xs-2"><a href=<?php echo base_url().'Cliente/borrar/'.$usu->usuid ;?>>
                                <submit class="btn btn-danger" type="submit" data-toggle="Eliminar" data-placement="top" title="Eliminar"><i class="bi bi-trash-fill"></i></a>
                        </td>
                        <td class="col-xs-2"><a href="#">
                        </td>
                    </tr>
                <?php }?>
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
            url: "<?php echo base_url().'cliente/delete/'.$this->session->flashdata('delete');?>",
            success:function(datos){                                
                var jsonData = JSON.parse(datos);                
                //console.log(jsonData);
                if (jsonData.success == "1")                
                {   Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Se Elimino con Exito',
                    showConfirmButton: false,
                    timer: 1500
                    });                                    
                }
                window.location = "<?php //echo base_url().'e/i/';?>";
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

    <?php if($this->session->flashdata('changeUsuEst')){ ?>        
    Swal.fire({
        position: 'center',
        title: 'Modifica el Estado del Cliente?',
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
            url: "<?php echo base_url().'cliente/set_UsuEst/'.$this->session->flashdata('changeUsuEst');?>",
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