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
    <form class="form-horizontal" action="#">
        <div class="form-group">
            <div class="col-sm-10">
                <table class="table table-hover" width="50%" table-layout="fixed" white-space="nowrap">
                    <caption> </caption>
                    <thead>
                    <th class="col-xs-2" nowrap="true"><a href=<?php echo base_url().'business/index/';?>>
                            <submit class="btn btn-danger" type="submit" data-toggle="Back" data-placement="top" title="Back"><i class="bi bi-arrow-left"></i></submit></a>
                    </th> 
                    <th class="col-xs-2" nowrap="true">Id</th>
                    <th class="col-xs-8" nowrap="true">Description</th>
                    <th class="col-xs-5" nowrap="true">Date</th>
                    <th class="col-xs-2" nowrap="true">&nbsp;</th>
                    <th class="col-xs-2" nowrap="true">&nbsp;</th>
                    </thead>
                    <tbody>
                    <?php foreach($documents as $item){ ?>
                    <tr>
                        <td class="col-xs-2">
                        </td>
                        <td class="col-xs-2" nowrap="true"><?php echo $item['docnom'];?></td>
                        <td class="col-xs-5" nowrap="true"><?php echo trim($item['docdsc']); ?></td>
                        <td class="col-xs-5" nowrap="true"><?php echo trim($item['docfec']); ?></td>

                        <td nowrap="true" class="col-xs-2">
                            <a target="_blank" href="<?php echo base_url().'documents/open/'.$item['docid'];?>">
                                <submit class="btn btn-info" type="submit"><span class="glyphicon glyphicon-cloud-download" data-toggle="Download" data-placement="top" title="Download"></span></submit>
                            </a>
                            <p style="font-size:12px;">(To Check the documents)<p>
                        </td>
                        <td nowrap="true" class="col-xs-2">
                            <?php if ($item['docchk'] == 1 ){;?>
                                <submit class="btn btn-danger" disabled type="submit"><span class="glyphicon glyphicon-ok" data-toggle="Agree" data-placement="top" title="Agree"></span>
                                    Agree</submit>
                            <?php }else{ ;?>
                            <a href="<?php echo base_url().'documents/agree/'.$item['docid'];?>">
                                <submit class="btn btn-danger" readonly type="submit">
                                <span class="glyphicon glyphicon-ok" data-toggle="Agree" data-placement="top" title="Agree"></span>
                                    Agree</submit>
                            </a>
                            <?php };?>
                        </td>
                        <td class="col-xs-2">
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php } //}?>
                    </tbody>
                    <!-- <td>
                        <a href=<?php //echo base_url().'business/index/';?>>
                            <submit class="btn btn-danger" type="submit">Back</submit></a>
                    </td> -->
                </table>
                <div class="container">
                    <b><?php echo $links; ?></b>
                </div>

            </div>
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