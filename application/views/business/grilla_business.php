<body>
    <form class="form-horizontal" action="#">
        <div class="form-group">
            <div class="col-sm-10">
                <table class="table table-hover" width="50%" table-layout="fixed" white-space="nowrap">
                    <caption> </caption>
                    <thead>
                    <th class="col-xs-2">&nbsp;</th>
                    <th class="col-xs-2" nowrap="true"># Customer Ref.</th>
                    <th class="col-xs-2" nowrap="true"># BBE Ref.</th>
                    <th class="col-xs-2" nowrap="true">Purchases</th>
                    <th class="col-xs-2">Date</th>
                    <th class="col-xs-2" nowrap="true">Attachments</th>
                    <th class="col-xs-2" nowrap="true">Customer Docs./Files</th>
                    </thead>
                    <tbody>
                    <?php foreach($negocio as $item){ ?>
                    <tr>
                        <td class="col-xs-2"><a href=<?php echo base_url().'business/view/'.$item['businessid'];?>>
                                <submit class="btn btn-info" type="submit">
                                <span class="glyphicon glyphicon-eye-open" data-toggle="View" data-placement="top" title="View"></span></submit></a>
                        </td>
                        <td class="col-xs-2"><?php echo $item['negid'];?></td>                        
                        <td class="col-xs-2"><?php echo $item['negid'];?></td>
                        <td class="col-xs-2" nowrap="true"><?php echo trim($item['negnom']); ?></td>
                        <td class="col-xs-2" nowrap="true"><?php echo trim($item['negfec']); ?></td>
                        </td>
                        <td class="col-xs-2"><a href=<?php echo base_url().'documents/index/'.$item['businessid'];?>>
                                <submit class="btn btn-primary" type="submit">
                                <i class="fa fa-book"></i>
                                    Docs./Files.</submit></a>
                        </td>
                        <td class="col-xs-2"><a href=<?php echo base_url().'documents/PrepaymentSwift/'.$item['businessid'];?>>
                                <submit class="btn btn-danger" type="submit">
                                <span class="glyphicon glyphicon-list-alt" data-toggle="Upload" data-placement="top" title="Upload"></span>
                                Prepayment Swift</submit></a>
                            <p style="font-size:12px;">(To upload  document)<p>
                        </td>
                        <td class="col-xs-2"><a href=<?php echo base_url().'documents/ShippingIntructions/'.$item['businessid'];?>>
                                <submit class="btn btn-danger" type="submit">
                                <span class="glyphicon glyphicon-plane" data-toggle="Upload" data-placement="top" title="Upload"></span>
                                    Shipping Intructions</submit></a>
                            <p style="font-size:12px;">(To upload  document)<p>
                        </td>
                        <td class="col-xs-2"><a href=<?php echo base_url().'documents/BalancePaymentSwift/'.$item['businessid'];?>>
                                <submit class="btn btn-danger" type="submit">
                                <span class="glyphicon glyphicon-folder-close" data-toggle="Upload" data-placement="top" title="Upload"></span>                                
                                    Balance Payment Swift</submit></a>
                            <p style="font-size:12px;">(To upload  document)<p>
                        </td>
                    </tr>
                    <?php } //}?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container">
            <b><?php echo $links; ?></b>
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
</script>