<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li><a href="<?php echo site_url("admin/members") ?>"><?php echo lang("ctn_21") ?></a></li>
  <li class="active"><?php echo lang("ctn_22") ?></li>
</ol>

<p><?php echo lang("ctn_23") ?></p>

<hr>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("admin/edit_member_pro/" . $member->ID), array("class" => "form-horizontal")) ?>

<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_24") ?></label>
        <div class="col-md-9">
            <input type="email" class="form-control" id="email-in" name="email" value="<?php echo $member->email ?>">
        </div>
</div>
<div class="form-group">

            <label for="username-in" class="col-md-3 label-heading"><?php echo lang("ctn_25") ?></label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $member->username ?>">
                <div id="username_check"></div>
            </div>
</div>
<div class="form-group">
        <label for="inputEmail3" class="col-sm-3 label-heading"><?php echo lang("ctn_26") ?></label>
        <div class="col-sm-9">
        <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $member->avatar ?>" />
            <input type="file" name="userfile" /> 
        </div>
    </div>
<div class="form-group">

            <label for="password-in" class="col-md-3 label-heading"><?php echo lang("ctn_27") ?></label>
            <div class="col-md-9">
                <input type="password" class="form-control" id="password-in" name="password" value="">
                <span class="help-text"><?php echo lang("ctn_28") ?></span>
            </div>
    </div>

<div class="form-group">

        <label for="name-in" class="col-md-3 label-heading"><?php echo lang("ctn_29") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="name-in" name="first_name" value="<?php echo $member->first_name ?>">
        </div>
</div>
<div class="form-group">

        <label for="name-in" class="col-md-3 label-heading"><?php echo lang("ctn_30") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="name-in" name="last_name" value="<?php echo $member->last_name ?>">
        </div>
</div>
<div class="form-group">

        <label for="phone-in" class="col-md-3 label-heading">Phone No</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="phone-in" name="phone_no" value="<?php echo $member->phone_no ?>">
        </div>
</div>
<div class="form-group">

        <label for="name-in" class="col-md-3 label-heading"><?php echo lang("ctn_350") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="name-in" name="credits" value="<?php echo $member->points ?>">
        </div>
</div>
<div class="form-group">
        <label for="inputEmail3" class="col-sm-3 label-heading"><?php echo lang("ctn_31") ?></label>
        <div class="col-sm-9">
          <textarea class="form-control" name="aboutme" rows="8"><?php echo nl2br($member->aboutme) ?></textarea>
        </div>
</div>
<div class="form-group">

        <label for="name-in" class="col-md-3 label-heading"><?php echo lang("ctn_322") ?></label>
        <div class="col-md-9">
            <select name="user_role" class="form-control">
            <option value="0" <?php if($member->user_role == 0) echo "selected" ?>><?php echo lang("ctn_46") ?></option>
            <?php foreach($user_roles->result() as $r) : ?>
                <option value="<?php echo $r->ID ?>" <?php if($member->user_role == $r->ID) echo "selected" ?>><?php echo $r->name ?></option>
            <?php endforeach; ?>
            </select>
        </div>
</div>
<div class="form-group">

        <label for="name-in" class="col-md-3 label-heading"><?php echo lang("ctn_36") ?></label>
        <div class="col-md-9">
            <?php echo lang("ctn_37") ?> : <?php echo $member->IP ?> <br />
            <?php echo lang("ctn_38") ?> : <?php echo date($this->settings->info->date_format, $member->joined) ?><br />
            <?php echo lang("ctn_39") ?> : <?php echo date($this->settings->info->date_format, $member->online_timestamp) ?>
        </div>
</div>
<div class="form-group">

        <label for="name-in" class="col-md-3 label-heading"><?php echo lang("ctn_40") ?></label>
        <div class="col-md-9">
            <?php foreach($user_groups->result() as $r) : ?>
                <p><a href="<?php echo site_url("admin/view_group/" . $r->groupid) ?>"><?php echo $r->name ?></a></p>
            <?php endforeach; ?>
        </div>
</div>
<div class="form-group">

        <label for="name-in" class="col-md-3 label-heading"><?php echo lang("ctn_331") ?></label>
        <div class="col-md-9">
           <select name="active" class="form-control">
           <option value="0"><?php echo lang("ctn_332") ?></option>
           <option value="1" <?php if($member->active) echo "selected" ?>><?php echo lang("ctn_333") ?></option>
           </select>
        </div>
</div>
<?php foreach($fields->result() as $r) : ?>
            <div class="form-group">

                <label for="name-in" class="col-md-3 label-heading"><?php echo $r->name ?> <?php if($r->required) : ?>*<?php endif; ?></label>
                <div class="col-md-9">
                    <?php if($r->type == 0) : ?>
                        <input type="text" class="form-control" id="name-in" name="cf_<?php echo $r->ID ?>" value="<?php echo $r->value ?>">
                    <?php elseif($r->type == 1) : ?>
                        <textarea name="cf_<?php echo $r->ID ?>" rows="8" class="form-control"><?php echo $r->value ?></textarea>
                    <?php elseif($r->type == 2) : ?>
                         <?php $options = explode(",", $r->options); ?>
                         <?php $values = array_map('trim', (explode(",", $r->value))); ?>
                        <?php if(count($options) > 0) : ?>
                            <?php foreach($options as $k=>$v) : ?>
                            <div class="form-group"><input type="checkbox" name="cf_cb_<?php echo $r->ID ?>_<?php echo $k ?>" value="1" <?php if(in_array($v,$values)) echo "checked" ?>> <?php echo $v ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php elseif($r->type == 3) : ?>
                        <?php $options = explode(",", $r->options); ?>
                        
                        <?php if(count($options) > 0) : ?>
                            <?php foreach($options as $k=>$v) : ?>
                            <div class="form-group"><input type="radio" name="cf_radio_<?php echo $r->ID ?>" value="<?php echo $k ?>" <?php if($r->value == $v) echo "checked" ?>> <?php echo $v ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php elseif($r->type == 4) : ?>
                        <?php $options = explode(",", $r->options); ?>
                        <?php if(count($options) > 0) : ?>
                            <select name="cf_<?php echo $r->ID ?>" class="form-control">
                            <?php foreach($options as $k=>$v) : ?>
                            <option value="<?php echo $k ?>" <?php if($r->value == $v) echo "selected" ?>><?php echo $v ?></option>
                            <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    <?php endif; ?>
                    <span class="help-text"><?php echo $r->help_text ?></span>
                </div>
        </div>
    <?php endforeach; ?>
	<?php if(!empty($lead_types)):?>
	<div class="form-group">
        <label for="lead-types" class="col-md-3 label-heading">Lead Types Cloud</label>
        <div class="col-md-9">
			<div class="lead-type-tagcloud">				
				<ul>
					<?php
					$selected_tags  = '';
					foreach($lead_types as $l) : 
						if($l->is_selected)
						{
							if($selected_tags == '')
								$selected_tags = $l->id;
							else
								$selected_tags .= ',' . $l->id;
						}
					?>
					<li><a data-id="<?php echo $l->id?>" href="#" <?php echo ($l->is_selected ? 'class="selected"':''); ?> ><?php echo $l->lead_type?></a></li>
					<?php endforeach;?>
				</ul>
				<input type="hidden" name="selected_tags" value="<?php echo $selected_tags;?>" id="selected_tags"/>
			</div>
		</div>
	</div>	
	<?php endif;?>
    <p><?php echo lang("ctn_351") ?></p>
<input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_13") ?>" />
<?php echo form_close() ?>
</div>
</div>
</div>
<script>
	$(document).ready(function(){	
		
		$('.lead-type-tagcloud ul li a').click(function(){
			var tag = $(this);
			if(tag.hasClass('selected'))
				tag.removeClass('selected');
			else
				tag.addClass('selected');
			
			//Build the selected tags list 	
		
			var tags = '';
			$('.lead-type-tagcloud ul li a.selected').each(function(){
				if(tags=='')
					tags = $(this).attr('data-id');
				else
					tags+=',' + $(this).attr('data-id');
			});
			
			$('#selected_tags').val(tags);
			
			return false;
		});
		
	});
</script>