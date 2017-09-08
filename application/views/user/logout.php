<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#35A768">
        <title><?php echo $this->lang->line('log_out') . ' - ' . $company_name; ?></title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/general.css"
            rel="stylesheet" type="text/css" />

        <!--[if IE]>
            <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
                  rel="shortcut icon">
        <![endif]-->
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
              rel="icon" type="image/x-icon" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/apple-touch-icon.png"
              rel="apple-touch-icon" />

<!--
        <style>
            body {
                width: 100vw;
                height: 100vh;
                display: table-cell;
                vertical-align: middle;
                background-color: #CAEDF3;
            }

            #logout-frame {
                width: 630px;
                margin: auto;
                background: #FFF;
                border: 1px solid #DDDADA;
                padding: 70px;
            }

            .btn {
                margin-right: 10px;
            }

            @media(max-width: 640px) {
                #logout-frame {
                    width: 100%;
                    padding: 20px;
                }

                .btn {
                    width: 100%;
                    margin-bottom: 20px;
                }
            }
        </style>
-->
    </head>
    <body>
        <div id="preloader">
            <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/preloader.gif"
                 alt="preloader animation" />
        </div>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header pull-left">
                    <div class="navbar-brand">
                        <a href="<?php echo $company_link; ?>">
                            <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/logo_escape.png"
                                 alt="logo" id="logo" />
                        </a>
                        <span><?php echo $this->lang->line('booking_title'); ?></span>
                    </div>
                </div>
                <div class="pull-right align-center">
                    <button type="button" class="navbar-toggle pull-left"
                                          data-toggle="collapse"
                                          data-target=".navbar-collapse">
                        <span class="sr-only">
                            <?php echo $this->lang->line('toggle_navigation'); ?>
                        </span>
                        <span>
                            <i class="fa fa-bars"></i>
                        </span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown" id="select-language">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo ucfirst($this->config->item('language')); ?><b class="caret"></b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="logout-frame" class="frame-container">
            <h3><?php echo $this->lang->line('log_out'); ?></h3>
            <p>
                <?php echo $this->lang->line('logout_success'); ?>
            </p>

            <br>

            <a href="<?php echo $this->config->item('base_url'); ?>" class="btn btn-primary btn-large">
                <span class="glyphicon glyphicon-calendar"></span>
                <?php echo $this->lang->line('book_appointment_title'); ?>
            </a>

            <a href="<?php echo $this->config->item('base_url'); ?>/index.php/backend" class="btn btn-danger btn-large">
                <span class="glyphicon glyphicon-home"></span>
                <?php echo $this->lang->line('backend_section'); ?>
            </a>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"
                type="text/javascript">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                type="text/javascript">
        </script>
        <script type="text/javascript">
            var EALang = <?php echo json_encode($this->lang->language); ?>;
            $(document).ready(function() {
                GeneralFunctions.hidePreloader();
            });
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"
                type="text/javascript">
        </script>
    </body>
</html>
