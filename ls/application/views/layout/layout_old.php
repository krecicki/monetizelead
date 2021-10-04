<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>         
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

         <!-- Styles -->
        <link href="<?php echo base_url();?>styles/layouts/basic/main.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>styles/layouts/basic/dashboard.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>styles/layouts/basic/responsive.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

        <!-- SCRIPTS -->
        <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script>
        
        <script type="text/javascript">
          $.widget.bridge('uitooltip', $.ui.tooltip);
        </script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>


        <!-- Favicon: http://realfavicongenerator.net -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url() ?>images/favicon/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url() ?>images/favicon/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url() ?>images/favicon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>images/favicon/apple-touch-icon-76x76.png">
        <link rel="icon" type="image/png" href="<?php echo base_url() ?>images/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo base_url() ?>images/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo base_url() ?>images/favicon/manifest.json">
        <link rel="mask-icon" href="<?php echo base_url() ?>images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="<?php echo base_url() ?>images/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="<?php echo base_url() ?>images/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        <script type="text/javascript">
          $.widget.bridge('uitooltip', $.ui.tooltip);
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
              $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?> 
    </head>
    <body>

	<nav class="navbar navbar-header2 navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php if(!$this->settings->info->logo_option) : ?>
          <a class="navbar-brand" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><?php echo $this->settings->info->site_name ?></a>
          <?php else : ?>
            <a class="navbar-brand-two" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->settings->info->site_logo ?>" width="123" height="32"></a>
          <?php endif; ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          <?php if($this->user->loggedin) : ?>
            <li class="user_bit"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" class="user_avatar user_icon"> <a href="<?php echo site_url("user_settings") ?>"><?php echo $this->user->info->username ?></a></li>
            <li><a href="<?php echo site_url("login/logout/" . $this->security->get_csrf_hash()) ?>"><?php echo lang("ctn_149") ?></a></li>
          <?php else : ?>
          <li><a href="<?php echo site_url("login") ?>"><?php echo lang("ctn_150") ?></a></li>
            <li><a href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a></li>
          <?php endif; ?>
          </ul>
          
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
        <?php if(isset($sidebar)) : ?>
          <?php echo $sidebar ?>
        <?php endif; ?>
          <ul class="newnav nav nav-sidebar">
           <?php if($this->user->loggedin && isset($this->user->info->user_role_id) && 
           ($this->user->info->admin || $this->user->info->admin_settings || $this->user->info->admin_members || $this->user->info->admin_payment)

           ) : ?>
              <li id="admin_sb">
                <a data-toggle="collapse" data-parent="#admin_sb" href="#admin_sb_c" class="collapsed <?php if(isset($activeLink['admin'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-wrench sidebar-icon"></span> <?php echo lang("ctn_157") ?>
                  <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
                </a>
                <div id="admin_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['admin'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                    <?php if($this->user->info->admin || $this->user->info->admin_settings) : ?>
                      <li class="<?php if(isset($activeLink['admin']['settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/settings") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_158") ?></a></li>
                      <li class="<?php if(isset($activeLink['admin']['social_settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/social_settings") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_159") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                    <li class="<?php if(isset($activeLink['admin']['members'])) echo "active" ?>"><a href="<?php echo site_url("admin/members") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_160") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['custom_fields'])) echo "active" ?>"><a href="<?php echo site_url("admin/custom_fields") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_346") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin) : ?>
                    <li class="<?php if(isset($activeLink['admin']['user_roles'])) echo "active" ?>"><a href="<?php echo site_url("admin/user_roles") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_316") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                    <li class="<?php if(isset($activeLink['admin']['user_groups'])) echo "active" ?>"><a href="<?php echo site_url("admin/user_groups") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_161") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['ipblock'])) echo "active" ?>"><a href="<?php echo site_url("admin/ipblock") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_162") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin) : ?>
                      <li class="<?php if(isset($activeLink['admin']['email_templates'])) echo "active" ?>"><a href="<?php echo site_url("admin/email_templates") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_163") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                      <li class="<?php if(isset($activeLink['admin']['email_members'])) echo "active" ?>"><a href="<?php echo site_url("admin/email_members") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_164") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_payment) : ?>
                    <li class="hidden <?php if(isset($activeLink['admin']['payment_settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/payment_settings") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_246") ?></a></li>
                    <li class=" hidden<?php if(isset($activeLink['admin']['payment_plans'])) echo "active" ?>"><a href="<?php echo site_url("admin/payment_plans") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_258") ?></a></li>
                    <li class="hidden <?php if(isset($activeLink['admin']['payment_logs'])) echo "active" ?>"><a href="<?php echo site_url("admin/payment_logs") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_288") ?></a></li>
                    <li class="hidden <?php if(isset($activeLink['admin']['premium_users'])) echo "active" ?>"><a href="<?php echo site_url("admin/premium_users") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_325") ?></a></li>
                    <?php endif; ?>
                  </ul>
                </div>
              </li>
            <?php endif; ?>
            <li class="<?php if(isset($activeLink['home']['general'])) echo "active" ?>"><a href="<?php echo site_url() ?>?home=yes"><span class="glyphicon glyphicon-home sidebar-icon"></span> <?php echo lang("ctn_154") ?> <span class="sr-only">(current)</span></a></li>
            <li class="<?php echo ($this->user->info->admin? '' : 'hidden');?> <?php if(isset($activeLink['members']['general'])) echo "active" ?>"><a href="<?php echo site_url("members") ?>"><span class="glyphicon glyphicon-user sidebar-icon"></span> <?php echo lang("ctn_155") ?></a></li>
            <li class="<?php if(isset($activeLink['settings']['general'])) echo "active" ?>"><a href="<?php echo site_url("user_settings") ?>"><span class="glyphicon glyphicon-cog sidebar-icon"></span> Profile </a></li>
			<?php if($this->user->info->admin) : ?>
			  <li class="<?php if(isset($activeLink['leads']['general'])) echo "active" ?>"><a href="<?php echo site_url("leads") ?>"><span class="glyphicon glyphicon-signal sidebar-icon"></span> Leads </a></li>
			<?php endif;?>
			<?php if($this->user->info->admin) : ?>
			  <li class="<?php if(isset($activeLink['reversals']['general'])) echo "active" ?>"><a href="<?php echo site_url("user_reversals") ?>"><span class="glyphicon glyphicon-cog sidebar-icon"></span> Reversals </a></li>
			<?php endif;?>
			<?php if($this->user->info->admin) : ?>
			  <li class="<?php if(isset($activeLink['api']['general'])) echo "active" ?>"><a href="<?php echo site_url("API_integration") ?>"><span class="glyphicon glyphicon-cloud sidebar-icon"></span> API Integration </a></li>
			<?php endif;?>
			<?php if($this->user->info->admin) : ?>
			  <li class="<?php if(isset($activeLink['support']['general'])) echo "active" ?>"><a href="#"><span class="glyphicon glyphicon-cloud sidebar-icon"></span> Support Desk </a></li>
			<?php endif;?>
			<?php if($this->user->info->admin) { ?>
			  <li class="<?php if(isset($activeLink['payment']['cancel'])) echo "active" ?>"><a href="<?php echo site_url() ?>/payment/cancel/<?php echo $this->security->get_csrf_hash();?>"onclick="return confirm('Are you sure you want to Cancel Payment?');"><span class="glyphicon glyphicon-cloud sidebar-icon"></span>Cancel Payment</a></li>
			  <li class="<?php if(isset($activeLink['payment']['update'])) echo "active" ?>"><a href="<?php echo site_url() ?>/payment/update/<?php echo $this->security->get_csrf_hash();?>"><span class="glyphicon glyphicon-cloud sidebar-icon"></span>Update Payment</a></li>
			  <li class="<?php if(isset($activeLink['payment']['history'])) echo "active" ?>"><a href="<?php echo site_url() ?>/payment/history/<?php echo $this->security->get_csrf_hash();?>"><span class="glyphicon glyphicon-cloud sidebar-icon"></span>Payment History</a></li>
			  <li class="<?php if(isset($activeLink['payment']['tran_history'])) echo "active" ?>"><a href="<?php echo site_url() ?>/payment/tran_history/<?php echo $this->security->get_csrf_hash();?>"><span class="glyphicon glyphicon-cloud sidebar-icon"></span>Transcation History</a></li>
			  <li class="<?php if(isset($activeLink['payment']['ccauth'])) echo "active" ?>"><a href="<?php echo site_url() ?>/payment/ccauth/<?php echo $this->security->get_csrf_hash();?>"><span class="glyphicon glyphicon-cloud sidebar-icon"></span>Credit Card Auth</a></li>
                        <?php } ?>
			<?php if($this->user->info->admin) : ?>
			  <li class="<?php if(isset($activeLink['options']['general'])) echo "active" ?>"><a href="<?php echo site_url("Options") ?>"><span class="glyphicon glyphicon-option-horizontal sidebar-icon"></span> Options </a></li>
			<?php endif;?>
			<?php if($this->settings->info->payment_enabled) : ?>
            <li class="<?php if(isset($activeLink['funds']['general'])) echo "active" ?>"><a href="<?php echo site_url("funds") ?>"><span class="glyphicon glyphicon-piggy-bank sidebar-icon"></span> <?php echo lang("ctn_245") ?></a></li>
            <li class="<?php if(isset($activeLink['funds']['plans'])) echo "active" ?>"><a href="<?php echo site_url("funds/plans") ?>"><span class="glyphicon glyphicon-list-alt sidebar-icon"></span> <?php echo lang("ctn_273") ?></a></li>
          <?php endif; ?>
          <li class="hidden"><a href="<?php echo site_url("test") ?>"><span class="glyphicon glyphicon-heart sidebar-icon"></span> <?php echo lang("ctn_165") ?></a></li>
          <li id="restricted_sb" class="hidden">
                <a data-toggle="collapse" data-parent="#restricted_sb" href="#restricted_sb_c" class="collapsed <?php if(isset($activeLink['restricted'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-lock sidebar-icon"></span> <?php echo lang("ctn_166") ?>
                  <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
                </a>
                <div id="restricted_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['restricted'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                    <li class="<?php if(isset($activeLink['restricted']['general'])) echo "active" ?>"><a href="<?php echo site_url("test/restricted_admin") ?>"><span class="glyphicon glyphicon-wrench"></span> <?php echo lang("ctn_167") ?> <span class="sr-only">(current)</span></a></li>
                    <li class="<?php if(isset($activeLink['restricted']['groups'])) echo "active" ?>"><a href="<?php echo site_url("test/restricted_group") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_168") ?></a></li>
                    <li class="<?php if(isset($activeLink['restricted']['users'])) echo "active" ?>"><a href="<?php echo site_url("test/restricted_user") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_169") ?></a></li>
                    <li class="<?php if(isset($activeLink['restricted']['premium'])) echo "active" ?>"><a href="<?php echo site_url("test/restricted_premium") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_289") ?></a></li>
                  </ul>
                </div>
              </li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div id="responsive-menu-links">
          <select name='link' OnChange="window.location.href=$(this).val();" class="form-control">
          <option value='<?php echo site_url() ?>>?home=yes'><?php echo lang("ctn_154") ?></option>         
          <?php if($this->user->loggedin && isset($this->user->info->user_role_id) && 
           ($this->user->info->admin || $this->user->info->admin_settings || $this->user->info->admin_members || $this->user->info->admin_payment)

           ) : ?>
           <?php if($this->user->info->admin || $this->user->info->admin_settings) : ?>
            <option value='<?php echo site_url("admin/settings") ?>'><?php echo lang("ctn_158") ?></option>
            <option value='<?php echo site_url("admin/social_settings") ?>'><?php echo lang("ctn_159") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
            <option value='<?php echo site_url("admin/members") ?>'><?php echo lang("ctn_160") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin) : ?>
            <option value='<?php echo site_url("admin/user_roles") ?>'><?php echo lang("ctn_316") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
            <option value='<?php echo site_url("admin/user_groups") ?>'><?php echo lang("ctn_161") ?></option>
            <option value='<?php echo site_url("admin/ipblock") ?>'><?php echo lang("ctn_162") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin) : ?>
            <option value='<?php echo site_url("admin/email_templates") ?>'><?php echo lang("ctn_163") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
            <option value='<?php echo site_url("admin/email_members") ?>'><?php echo lang("ctn_164") ?></option>
            <?php endif; ?>
			<option value='<?php echo site_url("members") ?>'><?php echo lang("ctn_155") ?></option>
			<option value='<?php echo site_url("user_settings") ?>'>Profile</option>
			<?php if($this->user->info->admin) : ?>
			<option value='<?php echo site_url('leads') ?>'>Leads</option>
			<option value='<?php echo site_url("user_reversals") ?>'>Reversals</option>
			<option value='<?php echo site_url("API_integration") ?>'>API Integration</option>
			<option value='#'>Support Desk</option>
			<option value='<?php echo site_url("Options") ?>'>Options</option>
			
			<?php endif;?>
          <?php endif; ?>
         
          </select> 
        </div>
        <?php if($this->settings->info->install) : ?>
          <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-info"><b><span class="glyphicon glyphicon-warning-sign"></span></b> <a href="<?php echo site_url("install") ?>">Great job on uploading all the files and setting up the site correctly! Let's now create the Admin account and set the default settings. Click here! This message will disappear once you have run the install process.</a></div>
                        </div>
                    </div>
        <?php endif; ?>
        <?php $gl = $this->session->flashdata('globalmsg'); ?>
        <?php if(!empty($gl)) :?>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
                        </div>
                    </div>
        <?php endif; ?>

        <?php echo $content ?>

        <hr>
        <p class="align-center small-text hidden"><?php echo lang("ctn_170") ?> <a href="https://www.patchesoft.com/">Patchesoft</a><br /> <?php echo $this->settings->info->site_name ?> V<?php echo $this->settings->version ?> - <a href="<?php echo site_url("home/change_language") ?>"><?php echo lang("ctn_171") ?></a></p>

          </div>
      </div>
    </div>


    </body>
</html>