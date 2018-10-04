<?php
/* Config */
$default_lang = 'fr';

/* End config */

session_start();
$available_lang = array(
    'fr',
    'en',
);

/* Change language selection if given as GET parameter. */
if (!empty($_GET["lang"])) {
    switch (strtolower($_GET["lang"])) {
    case "en":
        $_SESSION['lang'] = 'en';
        break;
    case "fr":
        $_SESSION['lang'] = 'fr';
        break;
    default:
        $_SESSION['lang'] = $default_lang;
        break;
    }
}

/* Now, lang should be set by the session of GET selection. */
/* If lang is still not set, use default. */
if (empty($_SESSION['lang'])) {
    $_SESSION['lang'] = $default_lang;
}

/* Populate translations with adequate lang file. */
$lang_file_path = "lang_" . $_SESSION['lang'] . ".php";
include($lang_file_path);
/* Now, $lang is available.
 * Use $lang['main_title'] to access the corresponding line. */
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#35A768">
        <meta name="description"
              content="<?php echo $lang['meta_description_content']; ?>"/>
        <meta name="keywords"
              content="<?php echo $lang['meta_keywords_content']; ?>" />
        <title><?php echo $lang['booking_title']; ?></title>

        <!-- CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
              rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300'
              rel='stylesheet' type='text/css' />
        <link href="/static/css/general.css"
              rel="stylesheet" type="text/css" />
        <link href="/static/css/book.css"
              rel="stylesheet" type="text/css" />
        <link href='https://www.planyo.com/schemes/?calendar=38662&detect_mobile=auto&sel=scheme_css'
              rel="stylesheet" type='text/css' />

        <!-- favicon -->
        <!--[if IE]>
            <link href="/static/img/favicon.ico" rel="shortcut icon">
        <![endif]-->
        <link href="/static/img/favicon.ico" rel="icon" type="image/x-icon" />
        <link href="/static/img/apple-touch-icon.png" rel="apple-touch-icon" />
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header pull-left">
                    <div class="navbar-brand">
                        <a href="/">
                            <img src="/static/img/logo_escape.png"
                                 alt="logo" id="logo" />
                        </a>
                        <span><?php echo $lang['booking_title']; ?></span>
                    </div>
                </div>
                <div class="pull-right align-center">
                    <button type="button" class="navbar-toggle pull-left"
                                          data-toggle="collapse"
                                          data-target=".navbar-collapse">
                        <span class="sr-only">
                            <?php echo $lang['toggle_navigation']; ?>
                        </span>
                        <span>
                            <i class="fa fa-bars"></i>
                        </span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="language"
                                <?php
                                switch ($_SESSION['lang']) {
                                    case "en":
                                        echo 'href=/booking.php?lang=fr';
                                        break;
                                    case "fr":
                                        echo 'href=/booking.php?lang=en';
                                        break;
                                    default:
                                        echo 'href=/booking.php?lang=en';
                                        break;
                                }
                                ?>>
                                <?php echo $lang['other_language']; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="main" class="container">
            <div class="wrapper row">
                <div id="book-appointment-wizard" class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

                    <?php
                    global $planyo_site_id, $planyo_files_location, $planyo_language,
                    $planyo_always_use_ajax, $planyo_sort_fields, $planyo_resource_id,
                    $planyo_js_library_used, $planyo_include_js_library,
                    $planyo_default_mode, $planyo_extra_search_fields, $planyo_resource_ordering, $planyo_attribs;

                    $planyo_site_id = '38662';
                    $planyo_files_location_real = 'planyo-files';
                    $planyo_files_location = '/planyo-files';
                    $planyo_language=$_SESSION['lang'];
                    $planyo_always_use_ajax = true;
                    $planyo_sort_fields='';
                    $planyo_resource_ordering='name';
                    $planyo_extra_search_fields='';
                    $planyo_default_mode='reserve';
                    $planyo_resource_id = null;
                    $planyo_include_js_library=false;
                    $planyo_attribs='resource_id=126186&mode=reserve';
                    require_once($planyo_files_location_real.'/planyo-plugin-impl.php');
                    echo "<div id='planyo_plugin_code' class='planyo'>";
                    planyo_setup();
                    echo "</div>";
                    ?>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="container">
                <p>Copyright &copy;
                    <a href="/">
                        Roseville
                    </a>
                </p>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
                type="text/javascript">
        </script>
        <script src="/static/js/main.js"
                type="text/javascript">
        </script>
        <script src="/static/js/general_functions.js"
                type="text/javascript">
        </script>
        <script type="text/javascript">
         var availableLanguages = <?php echo json_encode($available_lang); ?>;
         var selectedLanguage = <?php echo json_encode($_SESSION['lang']); ?>;
        </script>
    </body>
</html>
