<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-option-horizontal"></span>Customization Options
	</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li class="active">Customization Options</li>
</ol>

<div class="panel panel-default">
  	<div class="panel-body">
  	<?php echo form_open(site_url("Options/save"), array("class" => "form-horizontal")) ?>
			<h1>SMS Configuration</h1>
            <div class="form-group">
			    <label for="lead_sms_template" class="col-sm-4 control-label">Lead SMS Template</label>
			    <div class="col-sm-6">
			      <textarea rows="4" class="form-control" id="lead_sms_template" name="lead_sms_template"><?php echo (isset($options->lead_sms_template)? $options->lead_sms_template: 'Hey, |username|, you have |leadname| from the zipcode |leadzipcode| waiting for you to call them at |leadphone| or email them at |leademail|. They just submitted this information moments ago. Buy the lead here |leadurl|');?></textarea>
				  <em>You can change the text and re-postion the variables(delimited by '|' symbol). But you can't add any new variable.You can use the follow variables for charge sms template. <br>|username|<br>|leadname|<br>|leademail|<br>|leadphone|<br>|leadzipcode|<br>|leadurl|</em>		<?php if(!empty($lead_types)):?>
				
				    <div  class="lead-type-tagcloud">				
						<ul>
							<?php
							foreach($lead_types->result() as $l) : 									
							?>
							<li><a data-control="lead_sms_template" href="#"><?php echo $l->lead_type?></a></li>
							<?php endforeach;?>
						</ul>	
					</div>	
				  <?php endif;?>			 				 
			    </div>				
			</div>
			<div class="form-group">
			    <label for="charge_sms_template" class="col-sm-4 control-label">Lead SMS Template</label>
			    <div class="col-sm-6">
			      <textarea rows="4" class="form-control" id="charge_sms_template" name="charge_sms_template"><?php echo (isset($options->charge_sms_template)? $options->charge_sms_template: 'Thanks you |username| from your purchase.');?></textarea>
				  <em>You can change the text and re-postion the variables(delimited by '|' symbol). But you can't add any new variable. You can use the follow variables for charge sms template. <br>|username|<br>|leadname|<br>|email|<br>|phone|<br>|token|<br>|cost|<br>|click_hash|<br>|affilate_id|</em>	
				   <?php if(!empty($lead_types)):?>				
				    <div  class="lead-type-tagcloud">				
						<ul>
							<?php
							foreach($lead_types->result() as $l) : 									
							?>
							<li><a data-control="charge_sms_template" href="#"><?php echo $l->lead_type?></a></li>
							<?php endforeach;?>
						</ul>	
					</div>	
				  <?php endif;?>							  
			    </div>				
			</div>
			<hr>
			<h1>Lead Notification & Sales Page Colors</h1>
			<div class="form-group">
			    <label for="header_color" class="col-sm-4 control-label">Header Hex Color Code Without #</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="header_color" value="<?php echo (isset($options->header_color)? $options->header_color: '222222');?>"/>				 	 
			    </div>				
			</div>
			<div class="form-group">
			    <label for="button_color" class="col-sm-4 control-label">Pay Now Button Hex Color Code Without #</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="button_color" value="<?php echo (isset($options->button_color)? $options->button_color: '5cb85c');?>"/>				 	 
			    </div>				
			</div>
			<div class="form-group">
			    <label for="button_hover_color" class="col-sm-4 control-label">Pay Now Button Hex Hover Color Code Without #</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="button_hover_color" value="<?php echo (isset($options->button_hover_color)? $options->button_hover_color: '5cb85c');?>"/>				 	 
			    </div>				
			</div>
				<div class="form-group">
			    <label for="button_border_color" class="col-sm-4 control-label">Pay Now Button Border  Hex Color Code Without #</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="button_border_color" value="<?php echo (isset($options->button_border_color)? $options->button_border_color: '4cae4c');?>"/>				 	 
			    </div>				
			</div>
			<h1 class="hidden">Lead Cost</h1>
			<div class="form-group hidden">
				<label for="lead_cost" class="col-sm-4 control-label">Lead Cost</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="lead_cost" value="<?php echo $options->lead_cost;?>"/>				 	 
			    </div>				
			</div>
			<h1>Stripe Keys</h1>
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo $app_keys->id?>"/>			
			    <label for="secret_key" class="col-sm-4 control-label">Stripe Secret Key</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="stripe_secret_key" value="<?php echo $app_keys->stripe_secret_key;?>"/>				 	 
			    </div>				
			</div>
			<div class="form-group">
			    <label for="stripe_publishable_key" class="col-sm-4 control-label">Stripe Secret Key</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="stripe_publishable_key" value="<?php echo $app_keys->stripe_publishable_key;?>"/>				 	 
			    </div>				
			</div>
			<!--
			<h1>Twilio SMS API Keys & Twilio Purchased Phone Number</h1>
			<div class="form-group">
			    <label for="twilio_sid" class="col-sm-4 control-label">Account SID</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="twilio_sid" value="<?php echo $app_keys->twilio_sid;?>"/>				 	 
			    </div>				
			</div>
			<div class="form-group">
			    <label for="twilio_auth_token" class="col-sm-4 control-label">Auth Token</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="twilio_auth_token" value="<?php echo $app_keys->twilio_auth_token;?>"/>				 	 
			    </div>				
			</div>
			<div class="form-group">
			    <label for="twilio_phone_number" class="col-sm-4 control-label">Twilio Purchased Phone Number</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="twilio_phone_number" value="<?php echo $app_keys->twilio_phone_number;?>"/>				 	 
			    </div>				
			</div>
		-->
			<input type="submit" name="s" value="Save Customizations" class="btn btn-primary form-control" />
    <?php echo form_close() ?>
    </div>
</div>
</div>
<script>
	$(document).ready(function(){	
		
		$('.lead-type-tagcloud ul li a').click(function(){
			var tag = $(this);
			
			var control = $('#' + tag.attr('data-control'));
			
			control.html(control.html() + tag.text());			
			
			return false;
		});
		
	});
</script>
