<script>
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        // Great success! All the File APIs are supported.
    } else {
        alert('The File APIs are not fully supported in this browser.');
    }
    
    function CallMe()
    {
        window.open("file:///");
    }
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }
</script>
<body>
<?php echo form_open(base_url().'documento/filtro/'.$negid);?>
<div class="form-group">
    <div class="col-sm-8">
        <table>
            <tbody>
            <tr>                                
                <td class="col-xs-1">                                               
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Nombre" name="filtro_nom">
                    </div>
                </td>                
                <td class="col-xs-1">                                               
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Descripcion" name="filtro_des">                            
                        </div>
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
                    <th class="col-xs-2" nowrap="true"><a href=<?php echo base_url().'negocio/index/';?>>
                            <submit class="btn btn-danger" type="submit" data-toggle="Volver" data-placement="top" title="Volver"><i class="bi bi-arrow-left"></i></submit></a>
                    </th>                            
                    <th class="col-xs-2" nowrap="true">Nombre</th>
                    <th class="col-xs-5" nowrap="true">Descripcion del Documento</th>
                    <th class="col-xs-5" nowrap="true">Fecha</th>
                    <th class="col-xs-5" nowrap="true">Estado</th>
                    <th class="col-xs-5" nowrap="true">Fecha Hora Veri.</th>
                    <th class="col-xs-2" nowrap="true">&nbsp;</th>
                    <th class="col-xs-2" nowrap="true">&nbsp;</th>
                    <th class="col-xs-5" nowrap="true"> <a href=<?php echo base_url().'documento/nuevo/'.$negid;?>>                  
                    <submit class="btn btn-primary" type="submit" data-toggle="Agregar" data-placement="top" title="Agregar"><i class="bi bi-plus-lg"></i></submit></a></th>
                    </thead>
                    <tbody>
                    <?php foreach($documentos as $documento){ ?>
                    <tr>
                        <td class="col-xs-2">
                            <a href=<?php echo base_url().'documento/update/'. $documento->docid;?>>
                            <submit class="btn btn-info" type="submit" data-toggle="Editar" data-placement="top" title="Editar"><i class="bi bi-pencil-fill"></i></submit></a>
                        </td>
                        <td class="col-xs-2" nowrap="true"><?php echo $documento->docnom;?></td>
                        <td class="col-xs-8" nowrap="true"><?php echo trim($documento->docdsc); ?></td>
                        <td class="col-xs-5" nowrap="true"><?php echo trim($documento->docfec); ?></td>
                        <td class="col-xs-8" nowrap="true" align="center">
                            <?php if($documento->docchk == 1){?>
                                <!-- <input class="form-control" disabled type="checkbox" name="docchk" checked > -->
                                <span class="label label-success" disabled>
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="Verificado" data-placement="top" title="Verificado"></span>
                                </span>
                            <?php }else{;?>  
                                <!-- &nbsp;  -->                              
                                <!-- <span class="label label-default" disabled>
                                            <span class="glyphicon glyphicon-minus" aria-hidden="true" data-toggle="No Verificado" data-placement="top" title="No Verificado"></span>
                                </span> -->
                            <?php };?>
                        </td>
                        <td class="col-xs-5" nowrap="true"><?php echo trim($documento->docfecchk); ?></td>
                        <td class="col-xs-2">
                            <a target="_blank" href="<?php echo base_url().'documento/abrir/'.$documento->docid;?>">
                                <submit class="btn btn-info" type="submit" data-toggle="Descargar" data-placement="top" title="Descargar"><i class="bi bi-cloud-arrow-down-fill"></i></submit>                                
                            </a>
                        </td>
                        <td class="col-xs-2">
                        <td class="col-xs-2">
                                <a href=<?php echo base_url().'documento/borrar/'. $documento->docid;?>>
                                <submit class="btn btn-danger" type="submit" data-toggle="Eliminar" data-placement="top" title="Eliminar"><i class="bi bi-trash-fill"></i></a>
                                </a>
                        </td>
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
                url: "<?php echo base_url().'documento/delete/'.$this->session->flashdata('delete');?>",
                success:function(datos){                                
                    var jsonData = JSON.parse(datos);                
                    //console.log(jsonData);
                    if (jsonData.success == "1")                
                    {   
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Se Elimino con Exito',
                        showConfirmButton: false,
                        timer: 1500
                        });                                    
                        window.location = "<?php echo base_url().'documento/index/';?>" + jsonData.negid;  
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