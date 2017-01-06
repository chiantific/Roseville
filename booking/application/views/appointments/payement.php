<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">
    <title>Paiement</title>

    <?php
        // ------------------------------------------------------------
        // INCLUDE CSS FILES
        // ------------------------------------------------------------ ?>

    <link rel="stylesheet" type="text/css"
        href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>/assets/css/frontend.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="/css/style.css">

    <?php
        // ------------------------------------------------------------
        // SET PAGE FAVICON
        // ------------------------------------------------------------ ?>

    <link rel="icon" type="image/x-icon"
        href="/img/favicon.ico">

    <link rel="icon" sizes="192x192"
        href="/img/logo_R.png">
</head>
<body>
    <div id="main" class="container">
        <div class="wrapper row">
            <div id="success-frame" class="frame-container
                    col-xs-12
                    col-sm-offset-1 col-sm-10
                    col-md-offset-3 col-md-6
                    col-lg-offset-3 col-lg-6">

                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="panel-title">Détails du paiement</h3>
                            <img class="img-responsive pull-right"
                                    src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($error) && $error) { ?>
                        <div class="row">
                            <p>Paiement refusé. Merci de réessayer, ou de nous contacter.</p>
                        </div>
                        <?php } ?>
                        <form role="form" id="payment-form" method="POST" action="javascript:void(0);">
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="cardNumber">Numéro de carte</label>
                                    <div class="form-group">
                                        <input
                                            type="tel"
                                            class="form-control input-group"
                                            name="cardNumber"
                                            placeholder="Valid Card Number"
                                            autocomplete="cc-number"
                                            required autofocus
                                        />
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7 col-md-7">
                                    <div class="form-group">
                                        <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                        <input
                                                type="tel"
                                                class="form-control"
                                                name="cardExpiry"
                                                placeholder="MM / YY"
                                                autocomplete="cc-exp"
                                                required
                                        />
                                    </div>
                                </div>
                                <div class="col-xs-5 col-md-5 pull-right">
                                    <div class="form-group">
                                        <label for=cardCVC">CVC</label>
                                        <input
                                                type="tel"
                                                class="form-control"
                                                name="cardCVC"
                                                placeholder="CVC"
                                                autocomplete="cc-csc"
                                                required
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="subscribe btn btn-success btn-lg btn-block" type="button">Soumettre</button>
                                </div>
                            </div>
                            <div class="row" style="display:none;">
                                <div class="col-xs-12">
                                    <p class="payment-errors"></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        // ------------------------------------------------------------
        // INCLUDE JS FILES
        // ------------------------------------------------------------ ?>

    <script
        type="text/javascript"
        src="/js/jquery.min.js"></script>
    <script
        type="text/javascript"
        src="/js/bootstrap.min.js"></script>
    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/ext/datejs/date.js"></script>
    <script
        type="text/javascript"
        src="https://apis.google.com/js/client.js"></script>

    <?php
        // ------------------------------------------------------------
        // CUSTOM PAGE JS
        // ------------------------------------------------------------ ?>

    <script type="text/javascript">
        var GlobalVariables = {
            'csrfToken'         : <?php echo json_encode($this->security->get_csrf_hash()); ?>,
            'appointmentData'   : <?php echo json_encode($appointment_data); ?>,
            'providerData'      : <?php echo json_encode($provider_data); ?>,
            'serviceData'       : <?php echo json_encode($service_data); ?>,
            'companyName'       : <?php echo '"' . $company_name . '"'; ?>,
            'googleApiKey'      : <?php echo '"' . Config::GOOGLE_API_KEY . '"'; ?>,
            'googleClientId'    : <?php echo '"' . Config::GOOGLE_CLIENT_ID . '"'; ?>,
            'googleApiScope'    : 'https://www.googleapis.com/auth/calendar'
        };

        var EALang = <?php echo json_encode($this->lang->language); ?>;
    </script>

    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/frontend_book_success.js">
    </script>

    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js">
    </script>

    <script
        type="text/javascript"
         src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js">
    </script>

    <script
        type="text/javascript"
         src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js">
    </script>

    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/payment.js">
    </script>

</body>
</html>
