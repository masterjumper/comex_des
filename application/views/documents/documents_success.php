<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
        <?php echo form_open_multipart(base_url().'documents/save_new/'.$negid);?>
        <tr>
            <td class="col-xs-2">File</td>
            <td>
                <input type="file" name="docpath" id="docpath">
            </td>
        </tr>
    <tr>
        <td><input type="submit" class="btn btn-primary" value="Save" />
            <?=form_close()?>
            <a href=<?php echo (base_url()."business/index/".$negid);?>>
                <submit type="submit" class="btn btn-danger"> Cancel</submit></a>
        </td>
    </tr>
</table>
</body>