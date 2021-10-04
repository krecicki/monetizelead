<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span>Transcation History</div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url() ?>">Home</a></li>
        <li class="active">Transcation History</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">             
                <div class="col-sm-3">
                    Transcation ID
                </div>                
                <div class="col-sm-3">
                    Amount
                </div>                
                <div class="col-sm-3">
                    Receipt Email
                </div>                
                <div class="col-sm-3">
                    Status
                </div>                
            </div>
            <?php foreach ($payment_his as $payment) { ?>
                <div class="row">             
                    <div class="col-sm-3">
                        <?php echo $payment['id']; ?>
                    </div>                
                    <div class="col-sm-3">
                        <?php echo $payment['amount']; ?>
                    </div>                
                    <div class="col-sm-3">
                        <?php echo $payment['receipt_email']; ?>
                    </div>                
                    <div class="col-sm-3">
                        <?php echo ucfirst($payment['status']); ?>
                    </div>                
                </div>

            <?php } ?>

        </div>
    </div>

</div>

