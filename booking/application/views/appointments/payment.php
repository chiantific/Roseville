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
                            <h3 class="panel-title">Redirection vers la page de paiement</h3>
                        </div>
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
                            <input type="submit" value="Click here if you are not redirected in 5 seconds..." id="submit2" name="submit2">
                        </form>
                    </div>
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
        };

        var EALang = <?php echo json_encode($this->lang->language); ?>;
    </script>

    <script type="text/javascript">
         window.onload=function(){ 
                        window.setTimeout(function() { document.paymentform.submit(); }, 2000);
                             };
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
