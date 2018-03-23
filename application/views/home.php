<!DOCTYPE html>
<html>
    <head>
        <!-- meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#35A768" />
        <meta name="description"
              content="<?php echo $this->lang->line('meta_description_content'); ?>" />
        <meta name="keywords"
              content="<?php echo $this->lang->line('meta_keywords_content'); ?>" />
        <title><?php echo $this->lang->line('main_title'); ?></title>

        <!-- CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/css/prettyPhoto.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.css"
              rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300'
              rel='stylesheet' type='text/css' />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/general.css"
              rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/home.css"
              rel="stylesheet" type="text/css" />

        <!-- favicon -->
        <!--[if IE]>
            <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
                  rel="shortcut icon">
        <![endif]-->
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
              rel="icon" type="image/x-icon" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/apple-touch-icon.png"
              rel="apple-touch-icon" />
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <!-- preloader -->
        <div id="preloader">
            <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/preloader.gif"
                 alt="preloader animation" />
        </div>

        <!-- navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header pull-left">
                    <a class="navbar-brand page-scroll" href="#page-top">
                        <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/logo_escape.png"
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
                                <?php echo $this->lang->line('how_it_works'); ?>
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#section2">
                                <?php echo $this->lang->line('what_public'); ?>
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#section3">
                                <?php echo $this->lang->line('our_rooms'); ?>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"
                               data-toggle="dropdown">
                                <?php echo $this->lang->line('bookings'); ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="page-scroll"
                                        href="<?php echo $this->config->item('base_url'); ?>/index.php/booking">
                                        <?php echo $this->lang->line('book_now'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#gcard">
                                        <?php echo $this->lang->line('gift_certificate'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#price">
                                        <?php echo $this->lang->line('our_pricing'); ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $this->lang->line('about'); ?><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="page-scroll" href="#section5">
                                        <?php echo $this->lang->line('faq'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#where">
                                        <?php echo $this->lang->line('location'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#contact">
                                        <?php echo $this->lang->line('contact_us'); ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" id="select-language" class="language" >
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
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3
                    col-xs-6 col-xs-offset-3">
                        <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/logo_escape.png"
                             alt="Logo" class="img-responsive" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-xs-12">
                        <h1><?php echo $this->lang->line('welcome_to'); ?> 
							<span class="brand-heading">
								<?php echo $this->lang->line('brand'); ?>
							</span>
						</h1>
                        <p class="intro-text"><?php echo $this->lang->line('intro_text'); ?></p>
                        <a href="#section1" class="btn btn-default page-scroll">
                            <?php echo $this->lang->line('enter'); ?>
                        </a>
                            <a href="<?php echo $this->config->item('base_url'); ?>/index.php/booking"
                                 class="btn btn-default page-scroll">
                            <?php echo $this->lang->line('bookings'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 1 -->
        <div id="section1">
            <div class="container">
                <div class="col-md-10 col-md-offset-1 jumbotron">
                <h3><?php echo $this->lang->line('header_adventure_heros'); ?></h3>
                <p><?php echo $this->lang->line('text_adventure_heros'); ?></p>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 sub-section text-center">
                    <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/ancientdoorlock.jpg"
                         alt="<?php echo $this->lang->line('alt_lock_to_illustrate_the_game'); ?>"
                         class="img-rounded img-responsive">
                    </div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-lock"></i>
                        <h4><?php echo $this->lang->line('header_game_univers'); ?></h4>
                        <p><?php echo $this->lang->line('text_game_univers'); ?></p>
                    </div>
                    <div class="clearfix visible-sm"></div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-cogs"></i>
                        <h4><?php echo $this->lang->line('header_find_the_solution'); ?></h4>
                        <p><?php echo $this->lang->line('text_find_the_solution'); ?></p>
                    </div>

                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-trophy"></i>
                        <h4><?php echo $this->lang->line('header_the_clock_is_ticking'); ?></h4>
                        <p><?php echo $this->lang->line('text_the_clock_is_ticking'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2 -->
        <div id="section2">
            <div class="container">
                <div class="jumbotron">
                    <h3><?php echo $this->lang->line('what_public'); ?></h3>
                    <p><?php echo $this->lang->line('text_what_public'); ?></p>
                </div>
                <div class="space"></div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-users"></i>
                        <h4><?php echo $this->lang->line('header_family_and_friends'); ?></h4>
                        <p><?php echo $this->lang->line('text_family_and_friends'); ?></p>
                    </div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-black-tie"></i>
                        <h4><?php echo $this->lang->line('header_colleagues'); ?></h4>
                        <p><?php echo $this->lang->line('text_colleagues'); ?></p>
                    </div>
                    <div class="clearfix visible-sm"></div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-camera"></i>
                        <h4><?php echo $this->lang->line('header_tourists'); ?></h4>
                        <p><?php echo $this->lang->line('text_tourists'); ?></p>
                    </div>
                    <div class="col-md-3 col-sm-6 sub-section">
                        <i class="fa fa-briefcase"></i>
                        <h4><?php echo $this->lang->line('header_compagnies'); ?></h4>
                        <p><?php echo $this->lang->line('text_compagnies'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3 -->
        <div id="section3">
            <div class="container">
                <div class="jumbotron">
                    <h2><?php echo $this->lang->line('our_rooms'); ?></h2>
                    <p><?php echo $this->lang->line('text_our_rooms'); ?></p>
                    <div class="text-center">
                        <a href="<?php echo $this->config->item('base_url') ?>/index.php/booking"
                           class="btn btn-default">
                            <?php echo $this->lang->line('bookings'); ?>
                        </a>
                        <a href="#contact" class="btn btn-default page-scroll">
                            <?php echo $this->lang->line('btn_contact_us'); ?>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 sub-section">
                    <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/chocolat.jpg"
                    alt="<?php echo $this->lang->line('alt_chocolat'); ?>" class="img-thumbnail" width="100%" />
                        <h3><?php echo $this->lang->line('header_chocolate'); ?></h3>
                        <p><?php echo $this->lang->line('text_chocolate'); ?></p>
                        <p><?php echo $this->lang->line('group_chocolate'); ?></p>
                        <div class="grouped-buttons">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                <?php echo $this->lang->line('btn_more_info'); ?>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <?php echo $this->lang->line('header_intro_room_chocolate'); ?>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $this->lang->line('text_intro_room_chocolate'); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default btn-sm" data-dismiss="modal">
                                                <?php echo $this->lang->line('close'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End modal -->
                            <a href="https://www.youtube.com/watch?v=GyssJMtZRaM" rel="prettyPhoto">
                                <button type="button" class="btn btn-default">
                                    teaser
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 sub-section">
                        <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/raisin.jpg"
                             class="img-thumbnail" alt="<?php echo $this->lang->line('alt_grappe_bunch'); ?>" width="100%" />
                        <h3><?php echo $this->lang->line('header_ivv'); ?></h3>
                        <p><?php echo $this->lang->line('text_ivv'); ?></p>
                        <p><?php echo $this->lang->line('group_ivv'); ?></p>
                        <div class="grouped-buttons">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_ivv">
                                <?php echo $this->lang->line('btn_more_info'); ?>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_ivv" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <?php echo $this->lang->line('header_intro_room_ivv'); ?>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $this->lang->line('text_intro_room_ivv'); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default btn-sm" data-dismiss="modal">
                                                <?php echo $this->lang->line('close'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End modal -->
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_carousel_ivv">
                                <?php echo $this->lang->line('peek_inside'); ?>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_carousel_ivv" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <?php echo $this->lang->line('header_intro_room_ivv'); ?>
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
                                                             src="<?php echo $this->config->item('base_url'); ?>/assets/img/entree.jpg"
                                                             alt="entrée de la salle In Vino Veritas">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="<?php echo $this->config->item('base_url'); ?>/assets/img/pompe.jpg"
                                                             alt="pompe et arrosoirs">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="<?php echo $this->config->item('base_url'); ?>/assets/img/shelf.jpg"
                                                             alt="étagère">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="<?php echo $this->config->item('base_url'); ?>/assets/img/liter_register.jpg"
                                                             alt="doseur">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="<?php echo $this->config->item('base_url'); ?>/assets/img/tonneau.jpg"
                                                             alt="tonneau">
                                                    </div>
                                                    <div class="item">
                                                        <img class="img-responsive center-block"
                                                             src="<?php echo $this->config->item('base_url'); ?>/assets/img/manivelle.jpg"
                                                             alt="Manivelle">
                                                    </div>
                                                </div>
                                                <!-- Left and right controls -->
                                                <a class="left carousel-control" href="#IVVcarousel" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#IVVcarousel" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div> <!-- Carousel -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                                <?php echo $this->lang->line('close'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End modal -->
                        </div>
                    </div>
                    <div class="col-sm-4 sub-section">
                    <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/R_de_fete.jpg"
                         class="img-thumbnail" alt="<?php echo $this->lang->line('alt_r_lounge'); ?>" width="100%" />
                            <h3><?php echo $this->lang->line('header_area_R'); ?></h3>
                            <p><?php echo $this->lang->line('text_area_R'); ?></p>
                            <p><?php echo $this->lang->line('group_area'); ?></p>
                            <div class="grouped-buttons">
                                <a type="button" href="http://espace.roseville.ch" target="_blank" class="btn btn-default">
                                    <?php echo $this->lang->line('btn_more_info'); ?>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section bon cadeau -->
        <div id="gcard">
            <div class="container">
                <div class="section-title text-center center">
                <h2><?php echo $this->lang->line('gift_certificate'); ?></h2>
                </div>
                <div id="row">
                    <div class="col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-1 sub-section">
                        <i class="fa fa-gift"></i>
                        <h4><?php echo $this->lang->line('sub_header_gift_card'); ?></h4>
                        <p><?php echo $this->lang->line('how_to_order_gift_card'); ?>
                            <a class="page-scroll" href="#contact">
                                <?php echo $this->lang->line('contact_form'); ?>.
                            </a>
                        </p>
                        <p><?php echo $this->lang->line('payment_gift_card'); ?></p>
                        <p><?php echo $this->lang->line('how_to_use_gift_card'); ?>
                            <a class="page-scroll" href="#contact">
                                <?php echo $this->lang->line('contact_us_verb'); ?>
                            </a>
                            <?php echo $this->lang->line('send_mail_indicating_date_time'); ?></p>
                            <p><?php echo $this->lang->line('gift_card_validity'); ?></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2 carton">
                        <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/bon_cadeau.jpg"
                             alt="bon cadeau" class="img-responsive img-rounded" height="450px" width="300px" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Section tarifs -->
        <div id="price">
            <div class="container">
                <div class="jumbotron">
                <h2><?php echo $this->lang->line('our_pricing'); ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-4 ">
                    <h3><?php echo $this->lang->line('header_what_you_get'); ?></h3>
                        <i class="fa fa_big fa-users" aria-hidden="true"></i>
                        <p><?php echo $this->lang->line('text_what_you_get'); ?></p>
                    </div>
                    <div class="col-md-4 ">
                    <h3><?php echo $this->lang->line('prices'); ?></h3>
                        <i class="fa fa_big fa-shopping-cart" aria-hidden="true"></i>
                        <p><?php echo $this->lang->line('cost_weekdays'); ?></p>
                        <p><?php echo $this->lang->line('cost_weekend'); ?></p>
                        <p><?php echo $this->lang->line('cost_gift_card'); ?></>
                    </div>
                    <div class="col-md-4 ">
                        <h3><?php echo $this->lang->line('header_payment_methods'); ?></h3>
                        <i class="fa fa_big fa_custom">
                        <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/money_bag.png"
                             alt="money bag icon" />
                        </i>
                        <p><?php echo $this->lang->line('text_payment_methods'); ?></p>
                        <ul>
                            <li><img src="<?php echo $this->config->item('base_url'); ?>/assets/img/cc.png"
                                     class="ic" alt="transfer icon" /></li>
                            <li><img src="<?php echo $this->config->item('base_url'); ?>/assets/img/transfer.png"
                                     class="ic" alt="transfer icon" /></li>
                            <li><img src="<?php echo $this->config->item('base_url'); ?>/assets/img/cash.png"
                                     class="ic" alt="cash icon" /></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a href="<?php echo $this->config->item('base_url'); ?>/index.php/booking"
                           class="btn btn-default page-scroll">
                            <?php echo $this->lang->line('book_now'); ?>
                        </a>
                        <a href="#contact" class="btn btn-default page-scroll">
                            <?php echo $this->lang->line('btn_contact_us'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 5 -->
        <div id="section5">
            <div class="container">
                <div class="section-title text-center">
                <h2><?php echo $this->lang->line('frequently_asked_questions'); ?></h2>
                <h4><?php echo $this->lang->line('dont_hesitate'); ?>
                    <a class="page-scroll" href="#contact">
                        <?php echo $this->lang->line('contact_us_verb'); ?>
                    </a>
                    <?php echo $this->lang->line('no_answer_to_question'); ?></h4>
                </div>
                <div id="section-question" class="text-left">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                        <?php echo $this->lang->line('question_how_difficult'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $this->lang->line('answer_how_difficult'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                        <?php echo $this->lang->line('question_how_to_pay'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $this->lang->line('answer_how_to_pay'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                        <?php echo $this->lang->line('question_opening_hours'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><?php echo $this->lang->line('monday') . ': ' . $this->lang->line('hours_wks'); ?></p>
                                    <p><?php echo $this->lang->line('tuesday') . ': ' .$this->lang->line('hours_wks'); ?></p>
                                    <p><?php echo $this->lang->line('wednesday') . ': ' .$this->lang->line('hours_wks'); ?></p>
                                    <p><?php echo $this->lang->line('thursday') . ': ' .$this->lang->line('hours_wks'); ?></p>
                                    <p><?php echo $this->lang->line('friday') . ': ' .$this->lang->line('hours_wks'); ?></p>
                                    <p><?php echo $this->lang->line('saturday') . ': ' .$this->lang->line('hours_we'); ?></p>
                                    <p><?php echo $this->lang->line('sunday') . ': ' .$this->lang->line('hours_we'); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                        <?php echo $this->lang->line('question_where_location'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $this->lang->line('answer_where_location'); ?>
                                    <a class="page-scroll" href="#where">
                                        <?php echo $this->lang->line('map'); ?>.
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                        <?php echo $this->lang->line('question_cost'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <?php echo $this->lang->line('answer_cost'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                        <?php echo $this->lang->line('question_group_size'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <?php echo $this->lang->line('answer_group_size'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                        <?php echo $this->lang->line('question_skills'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $this->lang->line('answer_skills'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                                        <?php echo $this->lang->line('question_cancellation'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <?php echo $this->lang->line('answer_cancellation'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                                        <?php echo $this->lang->line('question_time_in_roseville'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse9" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <?php echo $this->lang->line('answer_time_in_roseville'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                                        <?php echo $this->lang->line('question_minimum_age'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse10" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $this->lang->line('answer_minimum_age'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                                        <?php echo $this->lang->line('question_accessibility'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse11" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $this->lang->line('answer_accessibility'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse12">
                                        <?php echo $this->lang->line('question_health_safety'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse12" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $this->lang->line('answer_health_safety'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse13">
                                        <?php echo $this->lang->line('question_showing_up_without_reservation'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse13" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $this->lang->line('answer_showing_up_without_reservation'); ?>
                                    <a class="page-scroll" href="#contact">
                                        <?php echo $this->lang->line('contact_us_verb'); ?>
                                    </a>
                                    <?php echo $this->lang->line('by_email_or_by_phone'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse14">
                                        <?php echo $this->lang->line('question_reading_glasses'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse14" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $this->lang->line('answer_reading_glasses'); ?>
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
                <h2><?php echo $this->lang->line('where_to_find_us'); ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div id="mapid" style="width:100%;height:500px"></div>
                    </div>
                    <div class="col-md-6">
                        <h4><?php echo $this->lang->line('header_address'); ?></h4>
                        <p><?php echo $this->lang->line('text_address'); ?></p>
                        <div class="atelier_view">
                            <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/atelier.jpg"
                                 class="img-responsive img-thumbnail" 
                                 alt="<?php echo $this->lang->line('alt_atelier'); ?>" />
                        </div>
                        <h4><?php echo $this->lang->line('header_public_transport'); ?></h4>
                        <p><?php echo $this->lang->line('text_public_transport'); ?>
                            <a class="page-scroll"
                                href="http://www.vmcv.ch/ligne211?d=A&a=COXGONEA" 
                                target="_blank">
                                <?php echo $this->lang->line('VMCV_site'); ?>
                            </a>
                        </p>
                        <h4><?php echo $this->lang->line('header_parking'); ?></h4>
                        <p><?php echo $this->lang->line('text_parking'); ?></p>   
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Section -->
        <div id="contact">
            <div class="container">
                <div class="jumbotron">
                <h2><?php echo $this->lang->line('contact_us'); ?></h2>
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
                            <p>078 638 80 79<br>
                            <p>079 623 04 11</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="atelier_view">
                            <i class="fa fa-clock-o"></i>
                            <div class="schedule">
                                <p><?php echo $this->lang->line('monday') . ': ' . $this->lang->line('hours_wks'); ?></p>
                                <p><?php echo $this->lang->line('tuesday') . ': ' .$this->lang->line('hours_wks'); ?></p>
                                <p><?php echo $this->lang->line('wednesday') . ': ' .$this->lang->line('hours_wks'); ?></p>
                                <p><?php echo $this->lang->line('thursday') . ': ' .$this->lang->line('hours_wks'); ?></p>
                                <p><?php echo $this->lang->line('friday') . ': ' .$this->lang->line('hours_wks'); ?></p>
                                <p><?php echo $this->lang->line('saturday') . ': ' .$this->lang->line('hours_we'); ?></p>
                                <p><?php echo $this->lang->line('sunday') . ': ' .$this->lang->line('hours_we'); ?></p>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                    <h3><?php echo $this->lang->line('leave_us_a_message'); ?></h3>
                        <form name="sentMessage" id="contactForm" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="name" class="form-control" 
                                            placeholder="<?php echo $this->lang->line('name'); ?>"
                                            required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control"
                                            placeholder="<?php echo $this->lang->line('email'); ?>"
                                            required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" class="form-control" rows="4"
                                            placeholder="<?php echo $this->lang->line('message'); ?>"
                                            required="required"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-default">
                                        <?php echo $this->lang->line('send'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row social">
                            <h3><?php echo $this->lang->line('follow_us'); ?></h3>
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
                <p>Copyright &copy;
                    <a href="<?php echo $company_link; ?>">
                        <?php echo $company_name; ?>
                    </a>
                    <?php if ($this->session->userdata('user_id')): ?>
                    | <a href="<?php echo $this->config->item('base_url'); ?>/index.php/backend">
                        <?php echo $this->lang->line('backend_section'); ?>
                    </a>
                    <?php endif; ?>
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
	<!-- Load custom prettyPhoto because of bug #156 -->
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/jquery.prettyPhoto.min.js"
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
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/main.js"
                type="text/javascript"> 
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/accordion.js"
                type="text/javascript">
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/jqBootstrapValidation.js"
                type="text/javascript">
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/fix_modal_navbar.js"
                type="text/javascript">
        </script>
        <script aftersrc="<?php echo $this->config->item('base_url'); ?>/assets/js/gmaps.js"
                type="text/javascript">
        </script>
        <script type="text/javascript">
            var GlobalVariables = {
                'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
                'baseUrl': <?php echo '"' . $base_url . '"'; ?>,
                'AJAX_SUCCESS': 'SUCCESS',
                'AJAX_FAILURE': 'FAILURE'
            };
            
            var EALang = <?php echo json_encode($this->lang->language); ?>;
            var availableLanguages = <?php echo json_encode($this->config->item('available_languages')); ?>;
            var selectedLanguage = <?php echo json_encode($this->config->item('language')); ?>;

            $(document).ready(function() {
                GeneralFunctions.enableLanguageSelection($('#select-language'), "toggle");
                GeneralFunctions.hidePreloader();
                GeneralFunctions.autoToggleNavbar();
            });
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/contact_me.js"
                type="text/javascript"> 
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"
                type="text/javascript">
        </script>
        <script aftersrc="<?php echo $this->config->item('base_url'); ?>/assets/js/piwik.js"
                type="text/javascript">
        </script>
        <noscript><p><img aftersrc="//roseville.ch/piwik/piwik.php?idsite=2" style="border:0;" alt="Piwik" /></p></noscript>
    </body>
</html>
