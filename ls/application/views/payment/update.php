<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span>Update Payment</div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url() ?>">Home</a></li>
        <li class="active">Update Payment</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">             
                <div class="col-sm-12">
                    <form action="<?php echo site_url() ?>/payment/update/<?php echo $this->security->get_csrf_hash();?>" method="post">
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_3phm3nd1RlD1I1EKryaRQFoo"
                            data-image="../../../../../../images/stripeml.png"
                            data-name="Monetize Lead"
                            data-panel-label="Update Card Details"
                            data-label="Update Card Details"
                            data-allow-remember-me=false
                            data-locale="auto">
                        </script>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    </form>
                </div>                                               
            </div>
        </div>
    </div>

</div>

