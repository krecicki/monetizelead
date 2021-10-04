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
			<h3 style="padding:5px;background-color:lightgrey">SMS Configuration</h3>
			<p>Learn more about how to use this feature by <a target="_blank" href="">clicking here</a>.</p>
            <div class="form-group">
			    <label for="lead_sms_template" class="col-sm-4 control-label">Lead SMS Notification Template</label>
			    <div class="col-sm-6">
			      <textarea rows="4" class="form-control" id="lead_sms_template" name="lead_sms_template"><?php echo (isset($options->lead_sms_template)? $options->lead_sms_template: 'Hey, |username|, you have |leadname| from the zipcode |leadzipcode| waiting for you to call them at |leadphone| or email them at |leademail|. They just submitted this information moments ago. Buy the lead here |leadurl|');?></textarea>
				  <em>You can change the text and re-postion the variables(delimited by '|' symbol). But you can't add any new variable.You can use the follow variables for charge sms template. <br>|username|<br>|leadname|<br>|leademail|<br>|leadphone|<br>|leadzipcode|<br>|leadurl|<br>|teamurl|</em>	 				 
			    </div>				
			</div>
			<div class="form-group">
			    <label for="charge_sms_template" class="col-sm-4 control-label">Lead Receipt SMS Template</label>
			    <div class="col-sm-6">
			      <textarea rows="4" class="form-control" id="charge_sms_template" name="charge_sms_template"><?php echo (isset($options->charge_sms_template)? $options->charge_sms_template: 'Thanks you |username| from your purchase.');?></textarea>
				  <em>You can change the text and re-postion the variables(delimited by '|' symbol). But you can't add any new variable. You can use the follow variables for charge sms template. <br>|username|<br>|leadname|<br>|email|<br>|phone|<br>|token|<br>|cost|<br>|click_hash|<br>|affilate_id|</em>	
				   <!-- code below displays lead type cloud for inserting into things
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
				  -->						  
			    </div>				
			</div>
			<div class="form-group">
			    <label for="charge_sms_template" class="col-sm-4 control-label">Lead Accept Limit</label>
			    <div class="col-sm-6">
			      <textarea rows="1" class="form-control" id="lead_rate_limit" name="lead_rate_limit"><?php echo (isset($options->lead_rate_limit)? $options->lead_rate_limit: '1000');?></textarea>			  
			    </div>				
			</div>
			<hr>
			<h3 style="padding:5px;background-color:lightgrey">Lead Notification & Sales Page Colors</h3>
			<p>To learn how to use this feature visit <a target="_blank" href="">here</a>.
			<div class="form-group">
			    <label for="header_color" class="col-sm-4 control-label">Header Color Code Picker</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-controler" name="header_color" value="<?php echo (isset($options->header_color)? $options->header_color: '222222');?>"/>				 	 
			    </div>				
			</div>
			<div class="form-group">
			    <label for="button_color" class="col-sm-4 control-label">Pay Now Button Color Picker</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-controler" name="button_color" value="<?php echo (isset($options->button_color)? $options->button_color: '5cb85c');?>"/>				 	 
			    </div>				
			</div>
		<div class="form-group">
			    <label for="button_hover_color" class="col-sm-4 control-label">Pay Now Button Hover Picker</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-controler" name="button_hover_color" value="<?php echo (isset($options->button_hover_color)? $options->button_hover_color: '5cb85c');?>"/>				 	 
			    </div>				
			</div>
				<div class="form-group">
			    <label for="button_border_color" class="col-sm-4 control-label">Pay Now Button Border Picker</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-controler" name="button_border_color" value="<?php echo (isset($options->button_border_color)? $options->button_border_color: '4cae4c');?>"/>				 	 
			    </div>				
			</div>			
		<hr>
		<h3 style="padding:5px;background-color:lightgrey">MonetizeContact™ Colors, Redirects & Links</h3>
			<p>Learn how to use this feature by<a target="_blank" href="https://monetizelead.com/blog/index.php/2018/07/11/what-to-do-after-subscribing-to-monetizelead/"> seeing more here</a>.
			<div class="form-group">			
			    <label for="monetizecontact_background_color" class="col-sm-4 control-label">Page Background Color</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-controler" name="monetizecontact_background_color" value="<?php echo (isset($options->monetizecontact_background_color)? $options->monetizecontact_background_color: 'CFCFCF');?>"/>				 	 
			    </div>				
			</div>
			<div class="form-group">			
			    <label for="monetizecontact_redirect" class="col-sm-4 control-label">Redirect After Contact Page Submission</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="monetizecontact_redirect" value="<?php echo (isset($options->monetizecontact_redirect)? $options->monetizecontact_redirect: 'http://paste-a-website-url-here.com');?>"/>				 	 
			    </div>				
			</div>
			<p>Below are links to your MonetizeContact™ contact page and manual submission page.</p>
			<div class="form-group">			
			    <label for="monetizecontact_contact" class="col-sm-4 control-label">Share this link to your new smart contact form. See it yourself by <a target="_blank" href="<?php echo(str_replace('/ls', '', base_url()).'forms/index');?>">clicking here</a>.</label>
			    <div class="col-sm-6">
			      <input type="text" id="monetizecontact_contact" class="form-control" name="monetizecontact_contact" value="<?php echo(str_replace('/ls', '', base_url()).'forms/index');?>"/>
			      </div>
			</div>
			<div class="form-group">			
			    <label for="monetizecontact_contact" class="col-sm-4 control-label">See the link to your new manual lead submission form. See it yourself click <a target="_blank" href="<?php echo(str_replace('/ls', '', base_url()).'forms/manual');?>">here</a>.</label>
			    <div class="col-sm-6">
			      <input type="text" id="monetizecontact_manual" class="form-control" name="monetizecontact_manual" value="<?php echo(str_replace('/ls', '', base_url()).'forms/manual');?>"/>
			<br />
			     <p>See your lead types below you can use on the manual lead submission page.</p>
				   <?php if(!empty($lead_types)):?>			
				    <div  class="lead-type-tagcloud">				
						<ul>
							<?php
							foreach($lead_types->result() as $l) : 									
							?>
							<li><a data-control="monetizecontact_redirect" href="#"><?php echo $l->lead_type?></a></li>
							<?php endforeach;?>
						</ul>	
					</div>	
				  <?php endif;?>
				</div>
			</div>
		<hr>
			<h3 style="padding:5px;background-color:lightgrey">Stripe Keys</h3>
			<p>You need a Stripe account to sell leads and take payments <a target="_blank" href="https://monetizelead.com/blog/index.php/2018/07/11/what-to-do-after-subscribing-to-monetizelead/">see more here</a>.
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo $app_keys->id?>"/>			
			    <label for="secret_key" class="col-sm-4 control-label">Stripe Secret Key</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="stripe_secret_key" value="<?php echo $app_keys->stripe_secret_key;?>"/>				 	 
			    </div>				
			</div>
			<div class="form-group">
			    <label for="stripe_publishable_key" class="col-sm-4 control-label">Stripe Publishable Key</label>
			    <div class="col-sm-6">
			      <input type="text"  class="form-control" name="stripe_publishable_key" value="<?php echo $app_keys->stripe_publishable_key;?>"/>				 	 
			    </div>				
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
		<br />
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
