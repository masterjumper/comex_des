<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
    <?php echo form_open_multipart(base_url().'Archivo/save_new/'.$claid); ?>    
    <tr>
        <td class="col-xs-5">Upload File</td>
        <td>
            <input class="form-control" type="file" name="arcpat" id="arcpat">
        </td>
    </tr>        
    <tr>
        <td><input type="submit" class="btn btn-primary" value="Save" />
            <?=form_close()?>
            <a href=<?php echo (base_url().'Archivo/documentacion/'.$claid);?>>
                <submit type="submit" class="btn btn-danger"> Cancel</submit></a>
        </td>
    </tr>

</table>
</body>

