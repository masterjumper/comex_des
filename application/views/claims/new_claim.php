<body>
<table class="table table-hover" table-layout="fixed"  white-space="nowrap">
    <?php echo form_open(base_url().'Claim/save_new/'); ?>
    <tr>
        <td class="col-xs-5">Reference</td>
        <td><input class="form-control" type="input" name="claref" value=""></td>
    </tr>
    <tr>
        <td class="col-xs-5">Invoice</td>
        <td><input class="form-control" type="input" name="clainv" value=""></td>
    </tr>    
    <tr>
        <td class="col-xs-5">Container</td>
        <td><input class="form-control" type="input" name="clacon" value=""></td>
    </tr>    
    <tr>
        <td class="col-xs-5">Vessel</td>
        <td><input class="form-control" type="input" name="claves" value=""></td>
    </tr>    
    <tr>
        <td class="col-xs-5">Amount</td>
        <td><input class="form-control" type="input" name="claamo" value=""></td>
    </tr>    
    <tr>
        <td class="col-xs-5">Comments</td>
        <td><input class="form-control" type="input" name="clacom" value=""></td>
    </tr>    
    <tr>
        <td><input type="submit" class="btn btn-primary" value="Guardar" />
            <?=form_close()?>
            <a href=<?php echo (base_url());?>>
                <submit type="submit" class="btn btn-danger"> Cancelar</submit></a>
        </td>
    </tr>

</table>
</body>

