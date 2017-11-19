<?php
session_start();
$available_lang = array(
    'fr',
    'en',
);
$default_lang = 'fr';

if (!empty($_GET["lang"])) {
    switch (strtolower($_GET["lang"])) {
        case "en":
            $_SESSION['lang'] = 'en';
            break;
        case "fr":
            $_SESSION['lang'] = 'fr';
            break;
        default:
            $_SESSION['lang'] = $defaultLang;
            break;
    }
}

if (empty($_SESSION["lang"])) {
    $locale = locale_lookup($available_lang, $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $_SESSION['lang'] = $locale;
}

if (empty($_SESSION["lang"])) {
    $_SESSION['lang'] = $default_lang;
}

$lang_file = "lang_" . $_SESSION["lang"] . ".php";
include($lang_file);
/*
lang array is now available. Just use $lang['main_title'] to access the corresponding line
*/

$booking_url = 'booking/?lang=' . $_SESSION["lang"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $lang['main_title']; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
              content="<?php echo $lang['meta_description_content']; ?>">
        <meta name="keywords"
              content="<?php echo $lang['meta_keywords_content']; ?>">
        <!--[if IE]><link rel="shortcut icon" href="img/favicon.ico"><![endif]-->
        <link href="img/favicon.ico" rel="icon" type="image/x-icon" />
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet" />
        <link rel="stylesheet" type="text/css"  href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css' />
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <div id="preloader">
            <div id="preloader-img">
                <img src="img/preloader.gif" height="64" width="64" alt="preloader animation">
            </div>
        </div>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header pull-left">
                    <a class="navbar-brand page-scroll" href="#page-top">
                        <img src="img/logo_escape.png" alt="logo" id="logo">
                        <span>Roseville Escape</span>
                    </a>
                </div>
                <div class="pull-right align-center">
                    <button type="button" class="navbar-toggle pull-left"
                                          data-toggle="collapse"
                                          data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span>
                            <i class="fa fa-bars"></i>
                        </span>
                    </button>
                    <ul class="nav navbar-nav pull-left">
                        <li>
                            <a class="language"
                                <?php
                                    switch ($_SESSION["lang"]) {
                                        case "en":
                                            echo 'href=index.php?lang=fr';
                                            break;
                                        case "fr":
                                            echo 'href=index.php?lang=en';
                                            break;
                                        default:
                                            echo 'href=index.php?lang=en';
                                            break;
                                    }
                                ?>>
                                <?php echo $lang['other_language']; ?>
                            </a>
                        </li>
                    </ul>
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
                                <?php echo $lang['our_rooms'];?>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"
                                        data-toggle="dropdown">
                                <?php echo $lang['bookings']; ?><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="page-scroll"
                                        href="<?php echo $booking_url; ?>">
                                        <?php echo $lang['book_now']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#gcard">
                                        <?php echo $lang['gift_certificate']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#price">
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
                                    <a class="page-scroll" href="#section5">
                                        <?php echo $lang['faq']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#where">
                                        <?php echo $lang['location']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#contact">
                                        <?php echo $lang['contact_us']; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Intro -->
        <div id="intro">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3
                    col-xs-6 col-xs-offset-3">
                        <img alt="Logo" class="img-responsive" src="img/logo_escape.png"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-xs-12">
                        <h1><?php echo $lang['welcome_to']; ?> 
							<span class="brand-heading">
								<?php echo $lang['brand']; ?>
							</span>
						</h1>
                        <p class="intro-text"><?php echo $lang['intro_text']; ?></p>
                        <a href="#section1" class="btn btn-default page-scroll">
                            <?php echo $lang['enter']; ?>
                        </a>
                            <a href="<?php echo $booking_url; ?>"
                                 class="btn btn-default page-scroll">
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
                    <img src="img/ancientdoorlock.jpg"
                        alt="<?php echo $lang['alt_lock_to_illustrate_the_game']; ?>"
                        class="img-rounded" class="img-responsive">
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
                <h3><?php echo $lang['what_public']; ?></h3>
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
                    <h2><?php echo $lang['our_rooms']; ?></h2>
                    <p><?php echo $lang['text_our_rooms']; ?></p>
                    <div class="text-center">
                    <a href="<?php echo $booking_url; ?>"
                             class="btn btn-default">
                            <?php echo $lang['bookings']; ?>
                        </a>
                        <a href="#contact" class="btn btn-default page-scroll">
                            <?php echo $lang['btn_contact_us']; ?>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 sub-section">
                        <img src="img/chocolat.jpg" alt="<?php echo $lang['alt_chocolat']; ?>" class="img-thumbnail" width="100%"/>
                        <h3><?php echo $lang['header_chocolate']; ?></h3>
                        <p><?php echo $lang['text_chocolate']; ?></p>
                        <p><?php echo $lang['group_chocolate']; ?></p>
                        <div class="grouped-buttons">
                        <!-- button to trigger chocolat more info modal  -->
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                <?php echo $lang['btn_more_info']; ?>
                            </button>
                            <!-- chocolat more info modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <?php echo $lang['header_intro_room_chocolate']; ?>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                        <p><?php echo $lang['text_intro_room_chocolate']; ?>
                                        </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                                <?php echo $lang['close']; ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End modal -->
                            <!-- button to trigger teaser -->
                            <a href="#myYoutubeModal" class="btn btn-default" data-toggle="modal"><?php echo $lang['teaser']; ?></a>
                            <!-- Modal HTML -->
                            <div id="myYoutubeModal" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <iframe id="teaserVideo" width="100%" height="350" src="https://www.youtube.com/embed/GyssJMtZRaM" frameborder="0" allowfullscreen></iframe>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 sub-section">
                        <img class="img-thumbnail" src="img/raisin.jpg"
                            alt="<?php echo $lang['alt_grappe_bunch']; ?>" width="100%"/>
                        <h3><?php echo $lang['header_ivv']; ?></h3>
                        <p><?php echo $lang['text_ivv']; ?></p>
                        <p><?php echo $lang['group_ivv']; ?></p>
                        <div class="grouped-buttons">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_ivv">
                                <?php echo $lang['btn_more_info']; ?>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_ivv" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <?php echo $lang['header_intro_room_ivv']; ?>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                        <p><?php echo $lang['text_intro_room_ivv']; ?>
                                        </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                                <?php echo $lang['close']; ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End modal -->
                            <!-- Button trigger modal peek inside -->
                            <a href="#carouselModal" class="btn btn-default" data-toggle="modal"><?php echo $lang['peek_inside']; ?></a>
                            <!-- Modal peek inside -->
                            <div id="carouselModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="modal-body">
                                          <div id="IVVcarousel" class="carousel slide" data-ride="carousel">
                                            <!-- Indicators dot nav -->
                                            <ol class="carousel-indicators">
                                              <li data-target="#IVVcarousel" data-slide-to="0" class="active"></li>
                                              <li data-target="#IVVcarousel" data-slide-to="1"></li>
                                              <li data-target="#IVVcarousel" data-slide-to="2"></li>
                                              <li data-target="#IVVcarousel" data-slide-to="3"></li>
                                            </ol>
                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                              <div class="item active">
                                                <img src="img/pompe.jpg" alt="pompe et arrosoirs">
                                              </div>
                                              <div class="item">
                                                <img src="img/shelf.jpg" alt="étagère">
                                              </div>
                                              <div class="item">
                                                <img src="img/tonneau.jpg" alt="tonneau">
                                              </div>
                                              <div class="item">
                                                <img src="img/manivelle.jpg" alt="Manivelle">
                                              </div>
                                            </div>
                                            <!-- Left and right controls -->
                                            <a class="left carousel-control" href="#IVVcarousel" role="button" data-slide="prev">
                                              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                              <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#IVVcarousel" role="button" data-slide="next">
                                              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                              <span class="sr-only">Next</span>
                                            </a>
                                          </div>
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
                        <img class="img-thumbnail" src="img/R_de_fete.jpg"
                            alt="<?php echo $lang['alt_r_lounge']; ?>" width="100%"/>
                        <h3><?php echo $lang['header_area_R']; ?></h3>
                        <p><?php echo $lang['text_area_R']; ?></p>
                        <p><?php echo $lang['group_area']; ?></p>
                        <a type="button" href="http://espace.roseville.ch" target="_blank" class="btn btn-default bottom">
                            <?php echo $lang['btn_more_info']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section bon cadeau -->
        <div id="gcard">
            <div class="container">
                <div class="section-title text-center center">
                <h2><?php echo $lang['gift_certificate']; ?></h2>
                </div>
                <div id="row">
                    <div class="col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-1 sub-section">
                        <i class="fa fa-gift"></i>
                        <h4><?php echo $lang['sub_header_gift_card']; ?></h4>
                        <p><?php echo $lang['how_to_order_gift_card']; ?>
                            <a class="page-scroll" href="#contact">
                                <?php echo $lang['contact_form']; ?>.
                            </a>
                        </p>
                        <p><?php echo $lang['payment_gift_card']; ?></p>
                        <p><?php echo $lang['how_to_use_gift_card']; ?>
                            <a class="page-scroll" href="#contact">
                                <?php echo $lang['contact_us_verb']; ?>
                            </a>
                            <?php echo $lang['send_mail_indicating_date_time']; ?></p>
                            <p><?php echo $lang['gift_card_validity']; ?></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2 carton">
                        <img src="img/bon_cadeau.jpg" alt="bon cadeau" class="img-responsive img-rounded" height="450px" width="300px">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section tarifs -->
        <div id="price">
            <div class="container">
                <div class="jumbotron">
                <h2><?php echo $lang['our_pricing']; ?></h2>
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
                        <p><?php echo $lang['cost_weekdays']; ?></p>
                        <p><?php echo $lang['cost_weekend']; ?></p>
                        <p><?php echo $lang['cost_gift_card']; ?></>
                    </div>
                    <div class="col-md-4 ">
                        <h3><?php echo $lang['header_payment_methods']; ?></h3>
                        <i class="fa fa_big fa_custom">
                            <img src="img/money_bag.png" alt="money bag icon">
                        </i>
                        <p><?php echo $lang['text_payment_methods']; ?></p>
                        <ul>
                            <li><img class="ic" src="img/cc.png" alt="transfer icon"</li>
                            <li><img class="ic" src="img/transfer.png" alt="transfer icon"></li>
                            <li><img class="ic" src="img/cash.png" alt="cash icon"></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a href="<?php echo $booking_url; ?>"
                             class="btn btn-default page-scroll">
                            <?php echo $lang['book_now']; ?>
                        </a>
                        <a href="#contact" class="btn btn-default page-scroll">
                            <?php echo $lang['btn_contact_us']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 5 -->
        <div id="section5">
            <div class="container">
                <div class="section-title text-center">
                <h2><?php echo $lang['frequently_asked_questions']; ?></h2>
                <h4><?php echo $lang['dont_hesitate']; ?>
                    <a class="page-scroll" href="#contact">
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
                                    <p><?php echo $lang['monday'] . ': ' . $lang['hours_wks']; ?></p>
                                    <p><?php echo $lang['tuesday'] . ': ' .$lang['hours_wks']; ?></p>
                                    <p><?php echo $lang['wednesday'] . ': ' .$lang['hours_wks']; ?></p>
                                    <p><?php echo $lang['thursday'] . ': ' .$lang['hours_wks']; ?></p>
                                    <p><?php echo $lang['friday'] . ': ' .$lang['hours_wks']; ?></p>
                                    <p><?php echo $lang['saturday'] . ': ' .$lang['hours_we']; ?></p>
                                    <p><?php echo $lang['sunday'] . ': ' .$lang['hours_we']; ?></p>
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
                                    <a class="page-scroll" href="#where">
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
                                    <a class="collapsed"data-toggle="collapse" data-parent="#accordion" href="#collapse12">
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
                                    <a class="collapsed"data-toggle="collapse" data-parent="#accordion" href="#collapse13">
                                        <?php echo $lang['question_showing_up_without_reservation']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse13" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $lang['answer_showing_up_without_reservation']; ?>
                                    <a class="page-scroll" href="#contact">
                                        <?php echo $lang['contact_us_verb']; ?>
                                    </a>
                                    <?php echo $lang['by_email_or_by_phone']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed"data-toggle="collapse" data-parent="#accordion" href="#collapse14">
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
        <!-- où nous trouver -->
        <div id="where">
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
                            <img src="img/atelier.jpg" class="img-responsive img-thumbnail" 
                                 alt="<?php echo $lang['alt_atelier']; ?>"/>
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
                            <a class="page-scroll"
                                href="http://www.vevey.ch/N1134/camping-de-la-pichette.html" 
                                target="_blank">
                                <?php echo $lang['pichette_campground']; ?>
                            </a>
                        </p>   
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Contact Section -->
        <div id="contact">
            <div class="container">
                <div class="jumbotron">
                <h2><?php echo $lang['contact_us']; ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="atelier_view">
                            <i class="fa fa-phone"></i>
                            <p>078 638 80 79<p>
                            <p>079 623 04 11</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="atelier_view">
                            <i class="fa fa-clock-o"></i>
                            <div class="schedule">
                                <p><?php echo $lang['monday'] . ': ' . $lang['hours_wks']; ?></p>
                                <p><?php echo $lang['tuesday'] . ': ' .$lang['hours_wks']; ?></p>
                                <p><?php echo $lang['wednesday'] . ': ' .$lang['hours_wks']; ?></p>
                                <p><?php echo $lang['thursday'] . ': ' .$lang['hours_wks']; ?></p>
                                <p><?php echo $lang['friday'] . ': ' .$lang['hours_wks']; ?></p>
                                <p><?php echo $lang['saturday'] . ': ' .$lang['hours_we']; ?></p>
                                <p><?php echo $lang['sunday'] . ': ' .$lang['hours_we']; ?></p>
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
                                            placeholder="<?php echo $lang['name']; ?>"
                                            required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control"
                                            placeholder="<?php echo $lang['email']; ?>"
                                            required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" class="form-control" rows="4"
                                            placeholder="<?php echo $lang['message']; ?>"
                                            required="required"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-default">
                                        <?php echo $lang['send']; ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row social">
                            <h3><?php echo $lang['follow_us']; ?></h3>
                            <div class="col-md-3">
                                <a href="https://www.facebook.com/rosevilleescape/" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="https://www.twitter.com/RosevilleEscape" target="_blank"><i class="fa fa-twitter"></i></a>
                            </div>
                            <div class="col-md-3">
                                <a href="https://www.instagram.com/roseville_escape/" target="_blank"><i class="fa fa-instagram"></i></a>
                            </div>
                            <div class="col-md-3">
                                <a href="https://www.youtube.com/channel/UCNq0gAc1oAZnBeBmyZQBaMw" target="_blank"><i class="fa fa-youtube-square"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="container">
                <p>Copyright &copy; Roseville Escape</p>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="js/bootstrap.js"></script> 
        <script type="text/javascript" src="js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script> 
        <script type="text/javascript" src="js/jquery.isotope.js"></script> 
        <script type="text/javascript" src="js/jquery.parallax.js"></script> 
        <script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 
        <script type="text/javascript" src="js/contact_me.js"></script> 
        <script type="text/javascript" src="js/main.js"></script> 
        <script type="text/javascript" src="js/accordion.js"></script>
        <script type="text/javascript" src="js/modalVideo.js"></script>
        <script type="text/javascript" aftersrc="js/gmaps.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            /* Get iframe src attribute value i.e. YouTube video url and store it in a variable */
            var url = $("#teaserVideo").attr('src');

            /* Assign empty url value to the iframe src attribute when modal hide, which stop the video playing */
            $("#myYoutubeModal").on('hide.bs.modal', function(){
                $("#teaserVideo").attr('src', '');
            });

            /* Assign the initially stored url back to the iframe src
            attribute when modal is displayed again */
            $("#myYoutubeModal").on('show.bs.modal', function(){
                $("#teaserVideo").attr('src', url);
            });
          });
        </script>
        <script type="text/javascript" aftersrc="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOgXOBkD944XhomrMeeNRhD8pBbxroVeM&callback=initMap"></script>
        <script type="text/javascript" aftersrc="js/piwik.js"></script>
        <noscript><p><img aftersrc="//roseville.ch/piwik/piwik.php?idsite=2" style="border:0;" alt="Piwik" /></p></noscript>
    </body>
</html>
