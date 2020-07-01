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
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#35A768" />
        <meta name="description"
              content="<?php echo $lang['meta_description_content']; ?>" />
        <meta name="keywords"
              content="<?php echo $lang['meta_keywords_content']; ?>" />
        <title><?php echo $lang['main_title']; ?></title>

        <!-- CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.css"
              rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300'
              rel='stylesheet' type='text/css' />
        <link href="/static/css/general.css"
              rel="stylesheet" type="text/css" />
        <link href="/static/css/home.css"
              rel="stylesheet" type="text/css" />

        <!-- favicon -->
        <!--[if IE]>
            <link href="/static/img/favicon.ico" rel="shortcut icon">
        <![endif]-->
        <link href="/static/img/favicon.ico" rel="icon" type="image/x-icon" />
        <link href="/static/img/apple-touch-icon.png" rel="apple-touch-icon" />
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <!-- preloader -->
        <div id="preloader">
            <img src="/static/img/preloader.gif" alt="preloader animation" />
        </div>

        <!-- navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header pull-left">
                    <a class="navbar-brand page-scroll" href="#page-top">
                        <img src="/static/img/logo_escape.png"
                             alt="logo" id="logo" />
                        <span>Roseville Escape</span>
                    </a>
                </div>
                <div class="pull-right align-center">
                    <button type="button" class="navbar-toggle pull-left"
                                          data-toggle="collapse"
                                          data-target=".navbar-collapse">
                        <span>
                            <i class="fa fa-bars"></i>
                        </span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#section1">
                                <?php echo $lang['how_it_works']; ?>
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#section2">
                                <?php echo $lang['what_public']; ?>
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#section3">
                                <?php echo $lang['our_rooms']; ?>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"
                               data-toggle="dropdown">
                                <?php echo $lang['bookings']; ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="page-scroll"
                                        href="/booking.php">
                                        <?php echo $lang['book_now']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#section4">
                                        <?php echo $lang['gift_certificate']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#section5">
                                        <?php echo $lang['our_pricing']; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $lang['about']; ?><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="page-scroll" href="#section6">
                                        <?php echo $lang['faq']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#section7">
                                        <?php echo $lang['location']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#section8">
                                        <?php echo $lang['links']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#section9">
                                        <?php echo $lang['contact_us']; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="language"
                                <?php
                                switch ($_SESSION['lang']) {
                                    case "en":
                                        echo 'href="/index.php?lang=fr"';
                                        break;
                                    case "fr":
                                        echo 'href="/index.php?lang=en"';
                                        break;
                                    default:
                                        echo 'href="/index.php?lang=en"';
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

        <!-- Intro -->
        <div id="intro">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                        <img src="/static/img/logo_escape.png"
                             alt="Logo" class="img-responsive" />
                    </div>
                </div>
                <div class="row">

<!-- Temp popup -->
                            <div class="modal fade" id="qoqa" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <?php
                                                    echo $lang['text1_qoqa'];
                                                ?>
                                            </p>
                                            <p>
                                                <a target="_blank" href="https://welqome.qoqa.ch/fr/offers/28200">
                                                    https://welqome.qoqa.ch/fr/offers/28200
                                                </a>
                                            </p>
                                            <p>
                                                <?php
                                                    echo $lang['text2_qoqa'];
                                                ?>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default btn-sm" data-dismiss="modal">
                                                <?php echo $lang['close']; ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
<!-- End temp popup -->

                    <div class="col-md-10 col-md-offset-1 col-xs-12">
                        <h1><?php echo $lang['welcome_to']; ?>
			    <span class="brand-heading">
				<?php echo $lang['brand']; ?>
			    </span>
			</h1>
                        <p class="intro-text">
                            <?php echo $lang['intro_text']; ?>
                        </p>
                        <a href="#section1" class="btn btn-default page-scroll">
                            <?php echo $lang['enter']; ?>
                        </a>
                        <a href="/booking.php" class="btn btn-default page-scroll">
                            <?php echo $lang['bookings']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 1 -->
        <div id="section1">
            <div class="container">
                <div class="col-md-10 col-md-offset-1 jumbotron">
                <h3><?php echo $lang['header_adventure_heros']; ?></h3>
                <p><?php echo $lang['text_adventure_heros']; ?></p>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 sub-section text-center">
                    <img src="/static/img/ancientdoorlock.jpg"
                         alt="<?php echo $lang['alt_lock_to_illustrate_the_game']; ?>"
                         class="img-rounded img-responsive">
                    </div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-lock"></i>
                        <h4><?php echo $lang['header_game_univers']; ?></h4>
                        <p><?php echo $lang['text_game_univers']; ?></p>
                    </div>
                    <div class="clearfix visible-sm"></div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-cogs"></i>
                        <h4><?php echo $lang['header_find_the_solution']; ?></h4>
                        <p><?php echo $lang['text_find_the_solution']; ?></p>
                    </div>

                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-trophy"></i>
                        <h4><?php echo $lang['header_the_clock_is_ticking']; ?></h4>
                        <p><?php echo $lang['text_the_clock_is_ticking']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2 -->
        <div id="section2">
            <div class="container">
                <div class="jumbotron">
                    <h3><?php echo $lang['header_what_public']; ?></h3>
                    <p><?php echo $lang['text_what_public']; ?></p>
                </div>
                <div class="space"></div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-users"></i>
                        <h4><?php echo $lang['header_family_and_friends']; ?></h4>
                        <p><?php echo $lang['text_family_and_friends']; ?></p>
                    </div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-black-tie"></i>
                        <h4><?php echo $lang['header_colleagues']; ?></h4>
                        <p><?php echo $lang['text_colleagues']; ?></p>
                    </div>
                    <div class="clearfix visible-sm"></div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-camera"></i>
                        <h4><?php echo $lang['header_tourists']; ?></h4>
                        <p><?php echo $lang['text_tourists']; ?></p>
                    </div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-briefcase"></i>
                        <h4><?php echo $lang['header_compagnies']; ?></h4>
                        <p><?php echo $lang['text_compagnies']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3 -->
        <div id="section3">
            <div class="container">
                <div class="jumbotron">
                    <h2><?php echo $lang['header_our_rooms']; ?></h2>
                    <p><?php echo $lang['text_our_rooms']; ?></p>
                    <div class="text-center">
                        <a href="/booking.php"
                           class="btn btn-default">
                            <?php echo $lang['bookings']; ?>
                        </a>
                        <a href="#section9" class="btn btn-default page-scroll">
                            <?php echo $lang['contact_us']; ?>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 sub-section">
                    <img src="/static/img/chocolat.jpg"
                    alt="<?php echo $lang['alt_chocolat']; ?>" class="img-thumbnail" width="100%" />
                        <h3><?php echo $lang['header_chocolate']; ?></h3>
                        <p><?php echo $lang['text_chocolate']; ?></p>
                        <p><?php echo $lang['group_chocolate']; ?></p>
                        <div class="grouped-buttons">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                <?php echo $lang['more_info']; ?>
                            </button>
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <?php echo $lang['header_intro_room_chocolate']; ?>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <?php
                                                    echo $lang['text_intro_room_chocolate_start'];
                                                    echo date('Y');
                                                    echo $lang['text_intro_room_chocolate_end'];
                                                ?>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default btn-sm" data-dismiss="modal">
                                                <?php echo $lang['close']; ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button to trigger teaser -->
                            <a href="#myYoutubeModal" class="btn btn-default" data-toggle="modal">
                                <?php echo $lang['teaser']; ?>
                            </a>
                            <div id="myYoutubeModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe id="teaserVideo" width="100%" height="350" vid_src="https://www.youtube.com/embed/GyssJMtZRaM"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 sub-section">
                        <img src="/static/img/la_serre.jpg"
                             class="img-thumbnail" alt="<?php echo $lang['alt_grappe_bunch']; ?>" width="100%" />
                        <h3><?php echo $lang['header_ivv']; ?></h3>
                        <p><?php echo $lang['text_ivv']; ?></p>
                        <p><?php echo $lang['group_ivv']; ?></p>
                        <div class="grouped-buttons">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_ivv">
                                <?php echo $lang['more_info']; ?>
                            </button>
                            <div class="modal fade" id="modal_ivv" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <?php echo $lang['header_intro_room_ivv']; ?>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $lang['text_intro_room_ivv']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default btn-sm" data-dismiss="modal">
                                                <?php echo $lang['close']; ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_carousel_ivv">
                                <?php echo $lang['peek_inside']; ?>
                            </button>
                            <div class="modal fade" id="modal_carousel_ivv" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <?php echo $lang['header_intro_room_ivv']; ?>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Carousel -->
                                            <div id="IVVcarousel" class="carousel slide" data-ride="carousel">
                                                <!-- Indicators -->
                                                <ol class="carousel-indicators">
                                                    <li data-target="#IVVcarousel" data-slide-to="0" class="active"></li>
                                                    <li data-target="#IVVcarousel" data-slide-to="1"></li>
                                                    <li data-target="#IVVcarousel" data-slide-to="2"></li>
                                                    <li data-target="#IVVcarousel" data-slide-to="3"></li>
                                                    <li data-target="#IVVcarousel" data-slide-to="4"></li>
                                                    <li data-target="#IVVcarousel" data-slide-to="5"></li>
                                                </ol>
                                                <!-- Wrapper for slides -->
                                                <div class="carousel-inner">
                                                    <div class="item active">
                                                        <img class="img-responsive center-block"
                                                             src="/static/img/entree.jpg"
                                                             alt="<?php echo $lang['alt_ivv_entrance']; ?>">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="/static/img/pompe.jpg"
                                                             alt="<?php echo $lang['alt_pump_can']; ?>">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="/static/img/shelf.jpg"
                                                             alt="<?php echo $lang['alt_shelf']; ?>">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="/static/img/liter_register.jpg"
                                                             alt="<?php echo $lang['alt_liter_register']; ?>">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="/static/img/tonneau.jpg"
                                                             alt="<?php echo $lang['alt_barrel']; ?>">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="/static/img/manivelle.jpg"
                                                             alt="<?php echo $lang['alt_crank']; ?>">
                                                    </div>
                                                </div>
                                                <!-- Left and right controls -->
                                                <a class="left carousel-control" href="#IVVcarousel" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                                    <span class="sr-only"><?php echo $lang['previous']; ?></span>
                                                </a>
                                                <a class="right carousel-control" href="#IVVcarousel" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                                    <span class="sr-only"><?php echo $lang['next']; ?></span>
                                                </a>
                                            </div>
                                            <!-- End carousel -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                                <?php echo $lang['close']; ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 sub-section">
                        <img src="/static/img/R_de_fete.jpg"
                             class="img-thumbnail" alt="<?php echo $lang['alt_r_lounge']; ?>" width="100%" />
                        <h3><?php echo $lang['header_area_R']; ?></h3>
                        <p><?php echo $lang['text_area_R']; ?></p>
                        <p><?php echo $lang['group_area']; ?></p>
                        <div class="grouped-buttons">
                            <a type="button" href="http://espace.roseville.ch" target="_blank" class="btn btn-default">
                                <?php echo $lang['more_info']; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 4 -->
        <div id="section4">
            <div class="container">
                <div class="section-title text-center center">
                <h2><?php echo $lang['header_gift_certificate']; ?></h2>
                </div>
                <div id="row">
                    <div class="col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-1 sub-section">
                        <i class="fa fa-gift"></i>
                        <h4><?php echo $lang['sub_header_gift_card']; ?></h4>
                        <p><?php echo $lang['how_to_order_gift_card']; ?>
                            <a class="page-scroll" href="#section9">
                                <?php echo $lang['contact_form']; ?>.
                            </a>
                        </p>
                        <p><?php echo $lang['payment_gift_card']; ?></p>
                        <p><?php echo $lang['how_to_use_gift_card']; ?>
                            <a class="page-scroll" href="#section9">
                                <?php echo $lang['contact_us_verb']; ?>
                            </a>
                            <?php echo $lang['send_mail_indicating_date_time']; ?></p>
                            <p><?php echo $lang['gift_card_validity']; ?></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2 carton">
                        <img src="/static/img/bon_cadeau.jpg"
                             alt="<?php echo $lang['alt_gift_card']; ?>"
                             class="img-responsive img-rounded" height="450px" width="300px" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 5 -->
        <div id="section5">
            <div class="container">
                <div class="jumbotron">
                <h2><?php echo $lang['prices']; ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-4 ">
                    <h3><?php echo $lang['header_what_you_get']; ?></h3>
                        <i class="fa fa_big fa-users" aria-hidden="true"></i>
                        <p><?php echo $lang['text_what_you_get']; ?></p>
                    </div>
                    <div class="col-md-4 ">
                    <h3><?php echo $lang['prices']; ?></h3>
                        <i class="fa fa_big fa-shopping-cart" aria-hidden="true"></i>
                        <p><?php echo $lang['cost_session']; ?></p>
                        <p><?php echo $lang['cost_gift_card']; ?></>
                    </div>
                    <div class="col-md-4 ">
                        <h3><?php echo $lang['header_payment_methods']; ?></h3>
                        <i class="fa fa_big fa_custom">
                        <img src="/static/img/money_bag.png"
                             alt="money bag icon" />
                        </i>
                        <p><?php echo $lang['text_payment_methods']; ?></p>
                        <ul>
                            <li><img src="/static/img/cc.png"
                                     class="ic" alt="transfer icon" /></li>
                            <li><img src="/static/img/transfer.png"
                                     class="ic" alt="transfer icon" /></li>
                            <li><img src="/static/img/cash.png"
                                     class="ic" alt="cash icon" /></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a href="/booking.php"
                           class="btn btn-default page-scroll">
                            <?php echo $lang['book_now']; ?>
                        </a>
                        <a href="#section9" class="btn btn-default page-scroll">
                            <?php echo $lang['contact_us']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 6 -->
        <div id="section6">
            <div class="container">
                <div class="section-title text-center">
                <h2><?php echo $lang['frequently_asked_questions']; ?></h2>
                <h4><?php echo $lang['dont_hesitate']; ?>
                    <a class="page-scroll" href="#section9">
                        <?php echo $lang['contact_us_verb']; ?>
                    </a>
                    <?php echo $lang['no_answer_to_question']; ?></h4>
                </div>
                <div id="section-question" class="text-left">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                        <?php echo $lang['question_how_difficult']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_how_difficult']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                        <?php echo $lang['question_how_to_pay']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_how_to_pay']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                        <?php echo $lang['question_opening_hours']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table-condensed">
                                        <tbody>
                                            <?php
                                                $schedule = array(
                                                    "monday" => array('10:30', '22:45'),
                                                    "tuesday" => array('10:30', '22:45'),
                                                    "wednesday" => array('10:30', '22:45'),
                                                    "thursday" => array('10:30', '22:45'),
                                                    "friday" => array('10:30', '22:45'),
                                                    "saturday" => array('10:30', '22:45'),
                                                    "sunday" => array('10:30', '22:45'));
                                                foreach ($schedule as $day => $time) {
                                            ?>
                                            <tr>
                                                <td class="text-left"><?php echo $lang[$day]; ?></td>
                                                <td><?php echo $lang[$time[0]]; ?></td>
                                                <td>-</td>
                                                <td><?php echo $lang[$time[1]]; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                        <?php echo $lang['question_where_location']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_where_location']; ?>
                                    <a class="page-scroll" href="#section7">
                                        <?php echo $lang['map']; ?>.
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                        <?php echo $lang['question_cost']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <?php echo $lang['answer_cost']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                        <?php echo $lang['question_group_size']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <?php echo $lang['answer_group_size']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                        <?php echo $lang['question_skills']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_skills']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                                        <?php echo $lang['question_cancellation']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <?php echo $lang['answer_cancellation']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                                        <?php echo $lang['question_time_in_roseville']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse9" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <?php echo $lang['answer_time_in_roseville']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                                        <?php echo $lang['question_minimum_age']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse10" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_minimum_age']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                                        <?php echo $lang['question_accessibility']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse11" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_accessibility']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse12">
                                        <?php echo $lang['question_health_safety']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse12" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_health_safety']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse13">
                                        <?php echo $lang['question_showing_up_without_reservation']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse13" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_showing_up_without_reservation']; ?>
                                    <a class="page-scroll" href="#section9">
                                        <?php echo $lang['contact_us_verb']; ?>
                                    </a>
                                    <?php echo $lang['or_by_phone']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse14">
                                        <?php echo $lang['question_reading_glasses']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse14" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_reading_glasses']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 7 -->
        <div id="section7">
            <div class="container">
                <div class="jumbotron">
                <h2><?php echo $lang['where_to_find_us']; ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div id="mapid" style="width:100%;height:500px"></div>
                    </div>
                    <div class="col-md-6">
                        <h4><?php echo $lang['header_address']; ?></h4>
                        <p><?php echo $lang['text_address']; ?></p>
                        <div class="atelier_view">
                            <img src="/static/img/atelier.jpg"
                                 class="img-responsive img-thumbnail"
                                 alt="<?php echo $lang['alt_atelier']; ?>" />
                        </div>
                        <h4><?php echo $lang['header_public_transport']; ?></h4>
                        <p><?php echo $lang['text_public_transport']; ?>
                            <a class="page-scroll"
                                href="http://www.vmcv.ch/ligne211?d=A&a=COXGONEA"
                                target="_blank">
                                <?php echo $lang['VMCV_site']; ?>
                            </a>
                        </p>
                        <h4><?php echo $lang['header_parking']; ?></h4>
                        <p><?php echo $lang['text_parking']; ?>
                            <a href="http://www.vevey.ch/N1134/camping-de-la-pichette.html"
                               target="_blank">
                                <?php echo $lang['pichette_campground']; ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 8 -->
        <div id="section8">
            <div class="container">
                <div class="jumbotron">
                    <h2><?php echo $lang['header_links']; ?></h2>
                </div>
                <!-- Partners -->
                <h3><?php echo $lang['our_partners']; ?></h3>
                <div class="row">
                    <div class="col-sm-4">
                        <a href="http://co-n-co.ch/" target="_blank">
                            <div class="darken">
                                <img src="/static/img/co-n-co.jpg"
                                     alt="<?php echo $lang['alt_co_n_co']; ?>" class="img-thumbnail" />
                            </div>
                            <h4><?php echo $lang['header_co_n_co']; ?></h4>
                        </a>
                        <p><?php echo $lang['text_co_n_co']; ?></p>
                    </div>
                    <div class="col-sm-4">
                        <a href="https://corentin-m.com/" target="_blank">
                            <div class="darken">
                                <img src="/static/img/corentin.jpg"
                                     alt="<?php echo $lang['alt_corentin']; ?>" class="img-thumbnail" />
                            </div>
                            <h4><?php echo $lang['header_corentin']; ?></h4>
                        </a>
                        <p><?php echo $lang['text_corentin']; ?></p>
                    </div>
                    <div class="col-sm-4">
                        <a href="https://espace.roseville.ch/" target="_blank">
                            <div class="darken">
                                <img src="/static/img/aire_de_fete_atmosphere.jpg"
                                     alt="<?php echo $lang['alt_roseville_r']; ?>" class="img-thumbnail" />
                            </div>
                            <h4><?php echo $lang['header_roseville_r']; ?></h4>
                        </a>
                        <p><?php echo $lang['text_roseville_r']; ?></p>
                    </div>
                    <div class="col-sm-4">
                        <a href="https://labyrinthe-sonore.com/" target="_blank">
                            <div class="darken">
                                <img src="/static/img/logo_labyrinthe_sonore.jpg"
                                     alt="<?php echo $lang['alt_labyrinthe_sonore']; ?>" class="img-thumbnail" />
                            </div>
                            <h4><?php echo $lang['header_labyrinthe_sonore']; ?></h4>
                        </a>
                        <p><?php echo $lang['text_labyrinthe_sonore']; ?></p>
                    </div>

              </div>
                <!-- Escape -->
                <h3><?php echo $lang['other_escapes']; ?></h3>
                <div class="row">
                   <div class="col-xs-6 col-sm-3">
                        <a href="http://www.klugle.com/" target="_blank">
                            <img src="/static/img/kluge.png"
                                 alt="<?php echo $lang['alt_kluge']; ?>" class="img-thumbnail" />
                            <h4><?php echo $lang['header_kluge']; ?></h4>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a href="http://www.enigm.ch/" target="_blank">
                            <img src="/static/img/enigm.png"
                                 alt="<?php echo $lang['alt_enigm']; ?>" class="img-thumbnail" />
                            <h4><?php echo $lang['header_enigm']; ?></h4>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a href="http://www.l-ichu.ch/" target="_blank">
                            <img src="/static/img/ichu-escape-game.png"
                                 alt="<?php echo $lang['alt_ichu']; ?>" class="img-thumbnail" />
                            <h4><?php echo $lang['header_ichu']; ?></h4>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a href="http://www.hotel-enigma.ch/" target="_blank">
                            <img src="/static/img/hotel-enigma-escape-game.png"
                                 alt="<?php echo $lang['alt_hotel_enigma']; ?>" class="img-thumbnail" />
                            <h4><?php echo $lang['header_hotel_enigma']; ?></h4>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a href="https://www.escapeworld.ch" target="_blank">
                            <img src="/static/img/escapeworld.png"
                                 alt="<?php echo $lang['alt_escapeworld']; ?>" class="img-thumbnail" />
                            <h4><?php echo $lang['header_escapeworld']; ?></h4>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a href="https://www.the-evasion.ch/" target="_blank">
                            <img src="/static/img/evasion.png"
                                 alt="<?php echo $lang['alt_evasion']; ?>" class="img-thumbnail" />
                            <h4><?php echo $lang['header_evasion']; ?></h4>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a href="http://www.housetrap.ch/" target="_blank">
                            <img src="/static/img/housetrap.png"
                                 alt="<?php echo $lang['alt_housetrap']; ?>" class="img-thumbnail" />
                            <h4><?php echo $lang['header_housetrap']; ?></h4>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a href="https://www.escaperiviera.ch/" target="_blank">
                            <img src="/static/img/escape-riviera.png"
                                 alt="<?php echo $lang['alt_riviera']; ?>" class="img-thumbnail" />
                            <h4><?php echo $lang['header_riviera']; ?></h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 9 -->
        <div id="section9">
            <div class="container">
                <div class="jumbotron">
                <h2><?php echo $lang['contact_us']; ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="atelier_view">
                            <i class="fa fa-envelope-o"></i>
                            <p>
                                <script type="text/javascript">
                                    var username = "info";
                                    var hostname = "roseville.ch";
                                    var linktext = username + "@" + hostname ;
                                    document.write("<a href='" + "mail" + "to:" + username + "@" + hostname + "'>" + linktext + "</a>");
                                </script>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="atelier_view">
                            <i class="fa fa-map-signs" aria-hidden="true"></i>
                            <p><?php echo $lang['street_address']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="atelier_view">
                            <i class="fa fa-phone"></i>
                            <p><?php echo $lang['phone_numbers']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="atelier_view">
                            <i class="fa fa-clock-o"></i>
                            <div class="schedule">
                                <table class="table-condensed">
                                    <tbody>
                                        <?php
                                            foreach ($schedule as $day => $time) {
                                        ?>
                                        <tr>
                                            <td class="text-left"><?php echo $lang[$day]; ?></td>
                                            <td><?php echo $lang[$time[0]]; ?></td>
                                            <td>-</td>
                                            <td><?php echo $lang[$time[1]]; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                    <h3><?php echo $lang['leave_us_a_message']; ?></h3>
                        <form name="sentMessage" id="contactForm" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="name" class="form-control"
                                            placeholder="<?php echo $lang['form_name']; ?>"
                                            required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control"
                                            placeholder="<?php echo $lang['form_email']; ?>"
                                            required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" class="form-control" rows="4"
                                            placeholder="<?php echo $lang['form_message']; ?>"
                                            required="required"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-default">
                                        <?php echo $lang['form_send']; ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row social">
                            <h3><?php echo $lang['follow_us']; ?></h3>
                            <div class="col-xs-3">
                                <a href="https://www.facebook.com/rosevilleescape/" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <a href="https://www.twitter.com/RosevilleEscape" target="_blank"><i class="fa fa-twitter"></i></a>
                            </div>
                            <div class="col-xs-3">
                                <a href="https://www.instagram.com/roseville_escape/" target="_blank"><i class="fa fa-instagram"></i></a>
                            </div>
                            <div class="col-xs-3">
                                <a href="https://www.youtube.com/channel/UCNq0gAc1oAZnBeBmyZQBaMw" target="_blank"><i class="fa fa-youtube-square"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div id="footer">
            <div class="container">
                <p>Copyright &copy;
                    <a href="/">
                        Roseville
                    </a>
                </p>
            </div>
        </div>

        <!-- JS scripts -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"
                type="text/javascript">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.6/SmoothScroll.min.js"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.4/isotope.pkgd.min.js"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-parallax/1.1.3/jquery-parallax-min.js"
                type="text/javascript">
        </script>
        <script aftersrc="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOgXOBkD944XhomrMeeNRhD8pBbxroVeM&callback=initMap"
                type="text/javascript">
        </script>
        <script src="/static/js/main.js"
                type="text/javascript">
        </script>
        <script src="/static/js/accordion.js"
                type="text/javascript">
        </script>
        <script src="/static/js/fix_modal_navbar.js"
                type="text/javascript">
        </script>
        <script src="/static/js/jqBootstrapValidation.js"
                type="text/javascript">
        </script>
        <script aftersrc="/static/js/gmaps.js"
                type="text/javascript">
        </script>
        <script type="text/javascript">
         var availableLanguages = <?php echo json_encode($available_lang); ?>;
         var selectedLanguage = <?php echo json_encode($_SESSION['lang']); ?>;

         $(document).ready(function() {
             GeneralFunctions.hidePreloader();
             GeneralFunctions.autoToggleNavbar();
             $('#qoqa').modal('show');
         });
        </script>
        <script src="/static/js/contact_me.js"
                type="text/javascript">
        </script>
        <script src="/static/js/modalVideo.js"
                type="text/javascript">
        </script>
        <script src="/static/js/general_functions.js"
                type="text/javascript">
        </script>
    </body>
</html>
