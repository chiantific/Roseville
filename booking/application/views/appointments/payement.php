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
                    col-md-offset-2 col-md-8
                    col-lg-offset-2 col-lg-8">

                <div class="col-xs-12 col-sm-10">
                    <iframe frameborder=0 width=300px height=340px src="https://postfinance.test.v-psp.com/Tokenization/HostedPage?ACCOUNT.PSPID=rosevilleTEST&CARD.BRAND=VISA&PARAMETERS.ACCEPTURL=http%3A%2F%2Fgoogle.fr&PARAMETERS.EXCEPTIONURL=http%3A%2F%2Fstartpage.com&SHASIGNATURE.SHASIGN=747BEDE9F1E942BCDB78E1A1B727BE29CB8D976A">
                    </iframe>
                    <?php
                        // Display exceptions (if any).
                        if (isset($exceptions)) {
                            echo '<div class="col-xs-12" style="margin:10px">';
                            echo '<h4>Unexpected Errors</h4>';
                            foreach($exceptions as $exc) {
                                echo exceptionToHtml($exc);
                            }
                            echo '</div>';
                        }
                    ?>
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
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/frontend_book_success.js"></script>

    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"></script>

    <?php google_analytics_script(); ?>
</body>
</html>
