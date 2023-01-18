

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
    <?php echo form_open_multipart(base_url().'documents/save_new/'.$negid);?>
    <tr>
        <!--<td class="col-xs-2">File</td>
         <td>
            <input type="file" name="docpath" id="docpath">
            <input hidden type="input" name="customer_type_file" value=<?php //echo $customer_type_file;?>>
        </td> -->
    </tr>
    <tr>
        <td> 
            <div class="container" style="margin-top: 20px;">
                <div class="row">              
                    <div class="col-lg-6 col-sm-6 col-12">
                        <h4>File:</h4>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Browse&hellip; <input name="docpath" id="docpath" type="file" style="display: none;">
                                    <input hidden type="input" name="customer_type_file" value=<?php echo $customer_type_file;?>>                                    
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly name="custom_type_file" value=<?php echo $customer_type_file;?>>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>  
    <tr>
        <td>
            <!-- <input type="submit" class="btn btn-primary" value="Save" /> -->
            <button type="submit" class="btn btn-primary" value="Save">
                <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Save" 
                data-placement="top" title="Save"></span>    
                Save
            </button>
            <?=form_close()?>
            <!-- <a href=<?php //echo (base_url()."business/index/".$negid);?>>
                <submit type="submit" class="btn btn-danger"> Cancel</submit></a> -->
            <a href=<?php echo (base_url()."business/index/".$negid);?>>
                <!-- <submit type="submit" class="btn btn-danger"> Cancelar</submit> -->
            <button type="submit" class="btn btn-warning" value="Cancel">
                <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" data-toggle="Cancel" data-placement="top" title="Cancel"></span>    
                Cancel
            </button>    
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
                    var custom_type_file = $('input[name="custom_type_file"]');
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                    if( custom_type_file.length ) {
                        custom_type_file.val(log);                        
                    }
                });
            });

        });
</script> 
   