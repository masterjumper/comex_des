<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript">
    function algo() {
        document.getElementById("docpath").value = '1';
        //var x = document.getElementById("docpat").value;
    }
    function imgload() {
        document.getElementById("docimgpath").value = '1';
        //var x = document.getElementById("docpat").value;
    }
</script>
<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
    <?php foreach($documento as $item) { ?>
        <?php echo form_open_multipart(base_url().'documento/save/'.$item->docid); ?>
        <?php //echo form_open_multipart(base_url().'documento/save/'.$item->docid);?>
        <tr>
            <td  class="col-xs-5">Codigo</td>
            <td><input class="form-control" type="input" name="docnom"  value="<?php echo $item->docnom;?>"></td>
        </tr>
        <tr>
            <td class="col-xs-5">Descripcion</td>
            <td><input class="form-control" type="input" name="docdsc" value="<?php echo $item->docdsc;?>"></td>
        </tr>
        <tr>
            <td class="col-xs-5">Fecha</td>
            <td><input class="form-control" type="date" name="docfec" value=<?php echo $item->docfec;?>></td>
        </tr>
        <tr>
            <td class="col-xs-5">Archivo</td>            
            <td class="col-xs-5">             
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btn btn-primary">
                            Seleccionar&hellip; <input name="docpath" id="docpath" type="file" style="display: none;">
                            <input hidden type="input" name="docpathtxt" value=<?php echo  $item->docpath;?>>                                    
                        </span>
                    </label>
                    <input type="text" class="form-control" readonly name="customdocpathtxt" value=<?php echo  $item->docpath;?>>
                </div>
            </td>            
        </tr>
    <?php } ?>
    <tr>
        <td>
            <button type="submit" class="btn btn-primary" value="Guardar">
                <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Agregar" data-placement="top" title="Agregar"></span>    
                    Aceptar
            </button>
            <?=form_close()?>
            &nbsp
            <a href=<?php echo (base_url()."documento/index/$negid");?>>
                    <!-- <submit type="submit" class="btn btn-danger"> Cancelar</submit> -->
                <button type="submit" class="btn btn-warning" value="Cancelar">
                    <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" data-toggle="Agregar" data-placement="top" title="Agregar"></span>    
                    Cancelar
                </button>
            </a>    
        </td>
    </tr>
</table>
</body>
<script>
    $(function() {
        // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() {                
                var input = $(this),                
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);                
            });

            // We can watch for our custom `fileselect` event like this
            $(document).ready( function() {                                             
                $(':file').on('fileselect', function(event, numFiles, label) {                    
                    var custom_type_file = $('input[name="customdocpathtxt"]');
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                    if( custom_type_file.length ) {
                        custom_type_file.val(log);                        
                    }
                });
            });

        });
</script> 