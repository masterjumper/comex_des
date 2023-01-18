<body>
    <form class="form-horizontal" action="#">
        <div class="form-group">
            <div class="col-sm-10">
                <table class="table table-hover" width="50%" table-layout="fixed" white-space="nowrap">
                    <caption> </caption>
                    <thead>                                        
                    <th class="col-xs-2" nowrap="true">File</th>
                    <th class="col-xs-2">Date</th>                                        
                    </thead>
                    <tbody>
                    <?php foreach($archivos as $archivo){ ?>
                    <tr>                    	
                        <td class="col-xs-2" nowrap="true"><?php echo trim($archivo->arcpat);?></td>
                        <td class="col-xs-2"><?php echo $archivo->arcfec;?></td>                        
                        <td class="col-xs-2"><a href=<?php echo base_url().'Archivo/delete/'. $claid . '/' . $archivo->arcid;?>>
                                <submit class="btn btn-danger" type="submit">X</submit></a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>                        
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <a href=<?php echo base_url().'Archivo/new_archivo/'.$claid;?>>
        <submit class="btn btn-primary" type="submit">Add</submit></a>
        &nbsp;    
    <a href=<?php echo base_url().'Claim/index/'.$claid;?>>
    <submit class="btn btn-primary" type="submit">Back</submit></a>
</body>