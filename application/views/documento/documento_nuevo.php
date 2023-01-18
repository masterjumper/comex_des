<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
        <?php echo form_open_multipart(base_url().'documento/save_nuevo/'.$negid);?>
        <tr>
            <td  class="col-xs-5">Nombre</td>
            <td><input class="form-control" type="input" name="docnom" ></td>
        </tr>
        <tr>
            <td class="col-xs-5">Descripcion</td>
            <td><input class="form-control" type="input" name="docdsc" ></td>
        </tr>
        <tr>
            <td class="col-xs-5">Fecha</td>
            <td><input class="form-control" type="date" name="docfec" ></td>
        </tr>
        <tr>
            <td class="col-xs-5">Archivo</td>            
            <td class="col-xs-5">             
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btn btn-primary">
                            Seleccionar&hellip; <input name="docpath" id="docpath" type="file" style="display: none;">
                            <input hidden type="input" name="docpathtxt">                                    
                        </span>
                    </label>
                    <input type="text" class="form-control" readonly name="customdocpathtxt">
                </div>            
            </td>
        </tr>
    <tr>
        <td>
            <button type="submit" class="btn btn-primary" value="Guardar">
                <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Agregar" data-placement="top" title="Agregar"></span>    
                    Aceptar
            </button>
            &nbsp
            <?=form_close()?>
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