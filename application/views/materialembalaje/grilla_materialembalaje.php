<body>
    <form class="form-horizontal" action="#">
        <div class="form-group">
            <div class="col-sm-10">
                <table class="table table-hover" width="50%" table-layout="fixed" white-space="nowrap">
                    <caption> </caption>
                    <thead>
                    <th class="col-xs-2">&nbsp;</th>                    
                    <th class="col-xs-5" nowrap="true">Material Embalaje</th>                                     
                    <th class="col-xs-2"> <a href=<?php echo base_url().'MaterialEmbalaje/new_MaterialEmbalaje/';?>>
                        <submit name = "t" class="btn btn-primary" type="submit" data-toggle="Agregar" data-placement="top" title="Agregar"><i class="bi bi-plus-lg"></i></submit></th>        
                    </thead>
                    <tbody>
                    <?php foreach($materialembalajes as $materialembalaje){ ?>
                    <tr>
                        <td class="col-xs-2"><a href=<?php echo base_url().'MaterialEmbalaje/update/'.$materialembalaje->matembid;?>>
                                <submit class="btn btn-info" type="submit" data-toggle="Editar" data-placement="top" title="Editar"><i class="bi bi-pencil-fill"></i></submit></a>
                        </td>
<!--                         <td class="col-xs-2"><a href=<?php //echo base_url().'MaterialEmbalaje/update/'.$materialembalaje->matembid;?>>
                                <submit class="btn btn-info" type="submit">Ver</submit></a>
                        </td>  -->                   
                        <td class="col-xs-5" nowrap="true"><?php echo trim($materialembalaje->matembdsc); ?></td>                        
                        <td class="col-xs-5"><a href=<?php echo base_url().'MaterialEmbalaje/borrar/'.$materialembalaje->matembid;?>>
                                <submit class="btn btn-danger" type="submit">X</submit></a></td>
                        <td>&nbsp;</td>
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
            url: "<?php echo base_url().'MaterialEmbalaje/delete/'.$this->session->flashdata('delete');?>",
            success:function(datos){                                
                var jsonData = JSON.parse(datos);                
                console.log(jsonData);
                if (jsonData.success == "1")                
                {                    
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        //text: 'El Proveedor Posee Documentos',
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
                window.location = "<?php echo base_url().'MaterialEmbalaje/index/'.$_SESSION['current_page'];?>"; 
            },
            error: function() {
                var jsonData = JSON.parse(datos);
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