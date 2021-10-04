<?php require_once('../config.php'); ?>
<?php 

//Get custom setting from options menu to brand the page.
$row = $db->getOne('custom_settings');
if(!empty($row))
{
    $button_color = $row['button_color'];
    $button_hover_color = $row['button_hover_color'];
    $button_border_color = $row['button_border_color'];
    $header_color = $row['header_color'];
    $monetizecontact_background_color = $row['monetizecontact_background_color'];
    $monetizecontact_redirect = $row['monetizecontact_redirect'];
}   

$settings = $db->getOne('site_settings');
$site_logo = $settings['upload_path_relative'].'/'. $settings['site_logo'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Monetizelead</title>
        <!-- Monetizelead API JS -->
        <script type="text/javascript" src="https://monetizelead.com/client/{USERNAME}/integration/choice.integration-min.js"></script>
        <script>
            function api_callback(response)
            {
                window.location.replace("<?php echo($monetizecontact_redirect) ?>");
            }
        </script>
        <!-- Favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Themify Icons -->
        <link href="assets/themify-icons/themify-icons.css" rel="stylesheet">
        <!-- Font Awesome Icons -->
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Custom Style -->
        <link href="css/style.css" rel="stylesheet">
        <!-- Color CSS -->
        <link id="main" href="css/color_01.css" rel="stylesheet">
        <link id="theme" href="css/color_01.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/php5shiv/3.7.3/php5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Custom script options used from the PHP code above the head -->

    <style type="text/css">
        body {
            margin-top: 20px;
        }
        .stripe-button-el{display:none!important;}
        .btn-pay{
            background-color:#<?php echo $button_color;?>;
            border-color:#<?php echo $button_border_color;?>;
        }
        .btn-pay:hover{
            background-color:#<?php echo $button_hover_color;?>!important;
        }
        .navbar-inverse{
            background-color:#<?php echo $header_color;?>!important;
        }
        .bg-login{
            background: none;
            background-color: #<?php echo $monetizecontact_background_color; ?>!important;
        }
    </style>

    </head>
    <body class="bg-login">
        <!-- ==============================================
                     **PRE LOADER**
        =============================================== -->
        <div id="page-loader">
            <div class="loader-container">
                <div class="loader-logo">
                    <span>LOADING</span>
                </div>
                <div class="loader"></div>
            </div>
        </div>
        <!-- ==============================================
                     **CONTACT**
        =============================================== -->
        <div class="container">
            <div class="section_login">
                <div class="row section_row-sm-offset-3">
                    <div class="ptb-50 text-center">
                        <a href="#"><img src="../ls/<?php echo $site_logo?>" alt=""></a>
                    </div>
                    <h3 class="section_authTitle">Contact us, get a response in minutes.</h3>
                </div>
                <div class="row section_row-sm-offset-3">
                    <div class="col-xs-12 col-sm-6">	
                        <form class="section_loginForm">
                            <input data-api='apiKey' type="hidden" name="apiKey" value="ab3df-34fcf-34fab-9bc23-44af8"/>
                            <div class="input-group ptb-10">
                                <span class="input-group-addon"><i class="ti-user"></i></span>
                                <input type="text" class="form-control" data-api='name' name="fullname" placeholder="Full Name">
                            </div>
                            <div class="input-group ptb-10">
                                <span class="input-group-addon"><i class="ti-email"></i></span>
                                <input type="email" class="form-control" data-api='email' name="email" placeholder="Email">
                            </div>
                             <div class="input-group ptb-10">
                                <span class="input-group-addon"><i class="ti-email"></i></span>
                                <input type="email" class="form-control" data-api='phone' name="phone" placeholder="Phone Number">
                            </div>
                             <div class="input-group ptb-10">
                                <span class="input-group-addon"><i class="ti-email"></i></span>
                                <input type="email" class="form-control" data-api='zipcode' name="zipcode" placeholder="Zip code of the leads location">
                            </div>
                            <div class="input-group ptb-10">
                                <span class="input-group-addon"><i class="ti-email"></i></span>
                                <input type="text" class="form-control" data-api='leadTypes' value="lead,types,go,here,spaced,with,commas"/>
                            </div>
                            <div class="ptb-20">
                                <input type="button" id="btn" data-api='lead-gen' name="button" class="btn btn-lg btn-theme-primary btn-block" value="Submit Lead Manually" type="submit">
                            </div>


                        </form>
                    </div>
                </div>
                <!--
                <div class="row section_row-sm-offset-3 section_loginOr">
                    <div class="col-xs-12 col-sm-6">
                        <hr class="section_hrOr">
                        <span class="section_spanOr">or</span>
                    </div>
                </div>
                <div class="row section_row-sm-offset-3 section_socialButtons">
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block section_btn-facebook">
                            <i class="fa fa-facebook visible-xs"></i>
                            <span class="hidden-xs">Facebook</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block section_btn-twitter">
                            <i class="fa fa-twitter visible-xs"></i>
                            <span class="hidden-xs">Twitter</span>
                        </a>
                    </div>	
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block section_btn-google">
                            <i class="fa fa-google-plus visible-xs"></i>
                            <span class="hidden-xs">Google+</span>
                        </a>
                    </div>	
                </div>
                        

                <div class="row section_row-sm-offset-3">
                    <div class="ptb-10 text-center">
                        I Already Have an Account <a href="login.html">Login</a>
                    </div>
                </div>
            -->
            </div>
        </div>
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Custom JS -->
        <script src="js/custom.js"></script>
    </body>
</html>