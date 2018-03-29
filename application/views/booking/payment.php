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

        <title><?php echo $this->lang->line('payment'); ?></title>

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
                <div class="frame-container
                        col-xs-12
                        col-sm-offset-1 col-sm-10
                        col-md-offset-3 col-md-6
                        col-lg-offset-3 col-lg-6">

                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <?php echo $this->lang->line('payment_frame_title'); ?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <form METHOD="post" action="<?php echo $payment_data['post_link']; ?>" id="form1" name="paymentform">
                                    <input type="hidden" name="PSPID"
                                        value="<?php echo $payment_data['pspid']; ?>">
                                    <input type="hidden" name="ORDERID"
                                        value="<?php echo $payment_data['orderid']; ?>">
                                    <input type="hidden" name="AMOUNT"
                                        value="<?php echo $payment_data['amount']; ?>">
                                    <input type="hidden" name="CURRENCY"
                                        value="<?php echo $payment_data['currency']; ?>">
                                    <input type="hidden" name="LANGUAGE"
                                        value="<?php echo $payment_data['language']; ?>">
                                    <input type="hidden" name="SHASIGN"
                                        value="<?php echo $payment_data['shasign']; ?>">

                                    <!-- post-payment redirection -->
                                    <input type="hidden" name="ACCEPTURL"
                                        value="<?php echo $payment_data['successurl']; ?>">
                                    <input type="hidden" name="DECLINEURL"
                                        value="<?php echo $payment_data['failurl']; ?>">
                                    <input type="hidden" name="EXCEPTIONURL"
                                        value="<?php echo $payment_data['failurl']; ?>">
                                    <input type="hidden" name="CANCELURL"
                                        value="<?php echo $payment_data['failurl']; ?>">

                                    <!-- Submit -->
                                    <input type="submit" value="<?php 
                                        echo $this->lang->line('submit_payment_button');
                                    ?>" id="submit2" name="submit2">
                            </form>
                        </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"
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
                    window.setTimeout(function() {
                        document.paymentform.submit(); }, 2000);
                });
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"
                type="text/javascript">
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/payment.js"
            type="text/javascript">
        </script>
    </body>
</html>
