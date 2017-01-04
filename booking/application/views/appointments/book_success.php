<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">
    <title><?php echo $this->lang->line('appointment_registered') . ' - ' . $company_name; ?></title>

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

                <div class="col-xs-12 col-sm-2">
                    <img id="success-icon" class="pull-right" src="<?php echo $this->config->item('base_url'); ?>/assets/img/success.png" />
                </div>
                <div>
                    <p><?php
                        echo $_GET['SHASign'];
                        $password = "cKC8QtsN6v*cKC8QtsN6v*";
                        $ncerror = "ALIAS.NCERROR=".$_GET['Alias_NCError'];
                        $aliasid = "ALIAS.ALIASID=".$_GET['Alias_AliasId'];


                        $sha_chain = $aliasid . $password . $ncerror . $password;
                        $shasign = sha1($sha_chain);
                        echo "<br/>" . $shasign;
                        echo "<br/>";
                        var_dump($_GET);
                        ?>
                        <?php
                        echo "<h1>".$_GET['Card_Cvc']."</h1>";
                        $submit_url = "https://e-payment.postfinance.ch/Ncol/Test/orderdirect.asp";
                        $data = array(
                            "PSPID" => "rosevilleTEST",
//                            "ORDERID" => $_GET['Alias_OrderId'],
                            "ORDERID" => "89",
                            "USERID" => "rosevilleTESTAPI",
                            "PSWD" => "Password123?!",
                            "AMOUNT" => "8000",
                            "CURRENCY" => "CHF",
                            "CARDNO" => "4111111111111111",
                            "BRAND" => "VISA",
                            "ED" => "0117",
                            "CVC" => "222",
/*                            "CARDNO" => $_GET['Card_CardNumber'],
                            "BRAND" => $_GET['Card_Brand'],
                            "ED" => $_GET['Card_ExpiryDate'],
                            "CVC" => $_GET['Card_Cvc'],*/
                            "OPERATION" => "SAL"
                        );
                        $options = array(
                            'http' => array(
                                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                                'method' => "POST",
                                'content' => http_build_query($data)
                            )
                        );

                        $context = stream_context_create($options);
                        $result = file_get_contents($submit_url, false, $context);
                        if ($result == FALSE) {
                            echo '<h4>Unexpected Error</h4>';
                        }
                        echo "<h4>START1</h4>";
                        echo "<pre>";
                        $result = str_replace('&', '&amp;', $result);
                        $result = str_replace('<', '&lt;', $result);
                        htmlspecialchars($result);
                        echo "</pre>";
                        echo "<h4>START2</h4>";
                        echo "<pre>";
                        var_dump($result);
                        echo "</pre>";
                        echo "<h4>END</h4>";
                        ?>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-10">
                    <?php
                        echo '
                            <h3>' . $this->lang->line('appointment_registered') . '</h3>
                            <p>' . $this->lang->line('appointment_details_was_sent_to_you') . '</p>
                            <a href="'.$this->config->item('base_url').'" class="btn btn-success btn-large">
                                <span class="glyphicon glyphicon-calendar"></span>' .
                                $this->lang->line('go_to_booking_page') . '
                            </a>
                        ';

                        if ($this->config->item('ea_google_sync_feature')) {
                            echo '
                                <button id="add-to-google-calendar" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    ' . $this->lang->line('add_to_google_calendar') . '
                                </button>';
                        }

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
