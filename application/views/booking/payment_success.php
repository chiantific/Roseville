<!DOCTYPE html>
<html>
    <head>
        <!-- META -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#35A768" />
        <meta name="description"
              content="<?php echo $this->lang->line('meta_description_content'); ?>" />
        <meta name="keywords"
              content="<?php echo $this->lang->line('meta_keywords_content'); ?>" />

        <title><?php echo $this->lang->line('appointment_registered'); ?></title>

        <!-- CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300"
              rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/general.css"
              rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/book.css"
              rel="stylesheet" type="text/css" />

        <!-- Favicon -->
        <!--[if IE]>
            <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
                  rel="shortcut icon">
        <![endif]-->
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
              rel="icon" type="image/x-icon" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/apple-touch-icon.png"
              rel="apple-touch-icon" />

    </head>
    <body>
        <div id="main" class="container">
            <div class="wrapper row">
                <div id="success-frame" class="frame-container col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                    <div class="col-xs-12 col-sm-2">
                        <img id="success-icon" class="pull-right" src="<?php echo $this->config->item('base_url'); ?>/assets/img/success.png" />
                    </div>
                    <div class="col-xs-12 col-sm-10">
                        <?php
                            echo '
                                <h3>' . $this->lang->line('appointment_payment_confirmed') . '</h3>
                                <p>' . $this->lang->line('thank_you_trust') . ' '
                                    . $this->lang->line('appointment_details_was_sent_to_you') . ' ' 
                                    . $this->lang->line('cant_wait') . '</p>
                                <a href="'.$company_link.'" class="btn btn-success btn-large">' .
                                    $this->lang->line('go_to_company_site') . '
                                </a>
                                <a href="'.$this->config->item('base_url').'/index.php/booking" class="btn btn-success btn-large">' .
                                    $this->lang->line('go_to_booking_page') . '
                                </a>
                            ';
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"
                type="text/javascript">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"
                type="text/javascript">
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/main.js"
                type="text/javascript">
        </script>
        <script type="text/javascript">
            var GlobalVariables = {
                'csrfToken'         : <?php echo json_encode($this->security->get_csrf_hash()); ?>,
                'appointmentData'   : <?php echo json_encode($appointment_data); ?>,
                'providerData'      : <?php echo json_encode($provider_data); ?>,
                'serviceData'       : <?php echo json_encode($service_data); ?>,
                'companyName'       : <?php echo '"' . $company_name . '"'; ?>,
            };

            var EALang = <?php echo json_encode($this->lang->language); ?>;
            var availableLanguages = <?php echo json_encode($this->config->item('available_languages')); ?>;
            var selectedLanguage = <?php echo json_encode($this->config->item('language')); ?>;

            $(document).ready(function() {
                GeneralFunctions.enableLanguageSelection($('#select-language'), "toggle");
                GeneralFunctions.hidePreloader();
            });
        </script>
        <script
            type="text/javascript"
            src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"></script>
    </body>
</html>
