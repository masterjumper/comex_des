<body>
        <table class="table table-hover" table-layout="fixed"  white-space="nowrap">
        <th class="col-xs-2" nowrap="true"><a href=<?php echo base_url().'business/index/';?>>
            <submit class="btn btn-danger" type="submit" data-toggle="Back" data-placement="top" title="Back"><i class="bi bi-arrow-left"></i></submit></a>
        </th> 
            <?php foreach($business as $item) { ?>
                <?php echo form_open(base_url().'negocio/save/'.$item->negid); ?>
                <tr>
                    <td  class="col-xs-5">Id</td>
                    <td class="form-control" ><?php echo $item->negid;?></td>
                </tr>
                <tr>
                    <td class="col-xs-5">Business</td>
                    <td class="form-control" ><?php echo $item->negnom;?></td>
                </tr>
                <tr>
                    <td class="col-xs-5">Description</td>
                    <td  class="form-control"><?php echo $item->negdsc;?></td>
                </tr>
                <tr>
                    <td class="col-xs-5">Date</td>
                    <td  class="form-control" ><?php echo $item->negfec;?></td>
                </tr>
                <!-- <tr>
                    <td>
                        <a href=<?php //echo base_url().'business/index/';?>>
                            <submit class="btn btn-danger" type="submit">Back</submit></a>
                    </td>
                </tr> -->
            <?php } ?>
        </table>
</body>
