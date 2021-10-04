<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span>Payment History</div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url() ?>">Home</a></li>
        <li class="active">Payment History</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">             
                <div class="col-sm-12">
                    <p>Payment done on <?php echo date('Y-m-d H:i:s', $user->joined); ?></p>
                </div>                                               
            </div>
        </div>
    </div>

</div>

