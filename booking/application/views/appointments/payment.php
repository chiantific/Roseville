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

<?php
    $data = array(
        'pspid'     => "rosevilleTEST",
        'orderid'   => $appointment_id,
        'amount'    => 0,
        'currency'  => "CHF",
        'language'  => "fr_CH",
        'successurl'=> $this->config->item('base_url')
            . "/index.php/appointments/payment_success/"
            . $appointment_id,
        'failurl'   => $this->config->item('base_url')
            . "/index.php/appointments/payment_success",
        'shasign'   => "",
    );

    // Calculate price
    $appointment_date = $appointment_data['start_datetime'];
    if(date('N', strtotime($appointment_date)) >= 6){
        $data['amount'] = $service_data['price_week_end'];
    } else {
        $data['amount'] = $service_data['price_week'];
    }
    $data['amount'] = str_replace('.', '', $data['amount']);

    // Calculate SHASIGN
    $sha_in = "cKC8QtsN6v*cKC8QtsN6v*";
    $string_to_sha = "ACCEPTURL=" . $data['successurl'] . $sha_in
        . "AMOUNT=" . $data['amount'] . $sha_in
        . "CANCELURL=" . $data['failurl'] . $sha_in
        . "CURRENCY=" . $data['currency'] . $sha_in
        . "DECLINEURL=" . $data['failurl'] . $sha_in
        . "EXCEPTIONURL=" . $data['failurl'] . $sha_in
        . "LANGUAGE=" . $data['language'] . $sha_in
        . "ORDERID=" . $data['orderid'] . $sha_in
        . "PSPID=" . $data['pspid'] . $sha_in;

    $sha_sign = sha1($string_to_sha);

    $data['shasign'] = $sha_sign;
?>

                        <form METHOD="post" action="https://e-payment.postfinance.ch/ncol/test/orderstandard.asp" id="form1" name="paymentform">
                            <input type="hidden" name="PSPID"
                                value="<?php echo $data['pspid']; ?>">
                            <input type="hidden" name="ORDERID"
                                value="<?php echo $data['orderid']; ?>">
                            <input type="hidden" name="AMOUNT"
                                value="<?php echo $data['amount']; ?>">
                            <input type="hidden" name="CURRENCY"
                                value="<?php echo $data['currency']; ?>">
                            <input type="hidden" name="LANGUAGE"
                                value="<?php echo $data['language']; ?>">
                            <input type="hidden" name="SHASIGN"
                                value="<?php echo $data['shasign']; ?>">

                            <!-- post-payment redirection -->
                            <input type="hidden" name="ACCEPTURL"
                                value="<?php echo $data['successurl']; ?>">
                            <input type="hidden" name="DECLINEURL"
                                value="<?php echo $data['failurl']; ?>">
                            <input type="hidden" name="EXCEPTIONURL"
                                value="<?php echo $data['failurl']; ?>">
                            <input type="hidden" name="CANCELURL"
                                value="<?php echo $data['failurl']; ?>">

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
