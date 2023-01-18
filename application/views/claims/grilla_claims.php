<body>
    <form class="form-horizontal" action="#">
        <div class="form-group">
            <div class="col-sm-10">
                <table class="table table-hover" width="50%" table-layout="fixed" white-space="nowrap">
                    <caption> </caption>
                    <thead>
                    <th class="col-xs-2">&nbsp;</th>
                    
                    <th class="col-xs-2">Claim</th>
                    <th class="col-xs-2" nowrap="true">Reference</th>
                    <th class="col-xs-2">Date</th>
                    <th class="col-xs-2">Empresa</th>
                    <th class="col-xs-2">Status</th>
                    <th class="col-xs-2"> </th>
                    <th class="col-xs-2" nowrap="true"></th>
                    </thead>
                    <tbody>
                    <?php foreach($claims as $claim){ ?>
                    <tr>
                        <td class="col-xs-2"><a href=<?php echo base_url().'Claim/update/'.$claim->claid;?>>
                                <submit class="btn btn-info" type="submit">View</submit></a>
                        </td>                        
                        <td class="col-xs-2"><?php echo $claim->clanum;?></td>
                        <td class="col-xs-2" nowrap="true"><?php echo trim($claim->claref); ?></td>
                        <td class="col-xs-2"><?php echo trim($claim->clafec); ?></td>
                        <td class="col-xs-2"><?php echo trim($claim->empid); ?></td>                        
                        <td class="col-xs-2">
                            <?php if($claim->claest == 1){echo 'In Process'; } ?>
                            <?php if($claim->claest == 2){echo 'Accepted'; } ?>
                            <?php if($claim->claest == 3){echo 'Rejected'; } ?>
                        </td>
                        <td class="col-xs-2"><a href=<?php echo base_url().'Archivo/documentacion/'.$claim->claid;?>>
                                <submit class="btn btn-info" type="submit">Documentation</submit></a>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>                        
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <a href=<?php echo base_url().'Claim/new_claim/';?>>
        <submit class="btn btn-primary" type="submit">Add</submit></a>
</body>