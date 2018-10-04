<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#35A768">
        <title><?php echo $this->lang->line('booking_title'); ?></title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.2/jquery.bootstrap-touchspin.min.css"
              rel="stylesheet" type="text/css" />
        <!--[if IE]>
            <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
                  rel="shortcut icon">
        <![endif]-->
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
              rel="icon" type="image/x-icon" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/apple-touch-icon.png"
              rel="apple-touch-icon" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/general.css"
              rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/book.css"
              rel="stylesheet" type="text/css" />
        <link href='https://www.planyo.com/schemes/?calendar=38662&detect_mobile=auto&sel=scheme_css'
              rel="stylesheet" type='text/css' />
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
                        <li class="dropdown">
                            <a href="#" id="select-language">
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
    // Display exceptions (if any)
    if (isset($exceptions)) {
        echo '<div style="margin: 10px">';
        echo '<h4>' . $this->lang->line('unexpected_issues') . '</h4>';
        foreach($exceptions as $exception) {
            echo exceptionToHtml($exception);
        }
        echo '</div>';
    }
    ?>

    <!-- Select room -->




<div id='planyo_content' class='planyo'><img src='https://www.planyo.com/images/hourglass.gif' align='middle' /></div>

<noscript><a href='http://www.planyo.com/about-calendar.php?calendar=38662'>Make a reservation</a><br/><br/>
    <a href='http://www.planyo.com/'>Reservation system powered by Planyo</a></noscript>




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
                |
                <a href="<?php echo $this->config->item('base_url'); ?>/index.php/backend">
                    <?php echo $this->lang->line('backend_section'); ?>
                </a>
            <?php endif; ?>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.js"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.2/jquery.bootstrap-touchspin.min.js"
                type="text/javascript">
        </script>
        <script
            type="text/javascript"
            src="<?php echo $this->config->item('base_url'); ?>/assets/js/frontend_book.js">
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/main.js"
                type="text/javascript">
        </script>
        <script type="text/javascript">
            var GlobalVariables = {
                baseUrl             : <?php echo '"' . $this->config->item('base_url') . '"'; ?>,
                csrfToken           : <?php echo json_encode($this->security->get_csrf_hash()); ?>
            };

            var EALang = <?php echo json_encode($this->lang->language); ?>;
            var availableLanguages = <?php echo json_encode($this->config->item('available_languages')); ?>;
            var selectedLanguage = <?php echo json_encode($this->config->item('language')); ?>;

            $(document).ready(function() {
                FrontendBook.initialize(true, GlobalVariables.manageMode);
                GeneralFunctions.enableLanguageSelection($('#select-language'), "toggle");
                GeneralFunctions.hidePreloader();
                /* Save form before load */
                window.onbeforeunload = FrontendBook.saveFormToSession;
                /* Load form after refresh */
                window.onload = FrontendBook.loadFormFromSession;
            });
        </script>
        <script
            type="text/javascript"
            src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"></script>
        <script type="text/javascript">
         // Planyo settings
         var planyo_site_id='38662';
         var planyo_default_mode='reserve';
         var planyo_include_js_library=false;
         var planyo_language = <?php echo json_encode($short_lang); ?>; // you can optionally change the language here, e.g. 'FR' or 'ES' or pass the language in the 'lang' parameter.
         var ulap_script="jsonp";
         var planyo_use_https=("https:" == document.location.protocol);
         var planyo_files_location=(planyo_use_https ? "https" : "http") + '://www.planyo.com/Plugins/PlanyoFiles';
         var empty_mode=false; // should be always set to false
        </script>

        <script type="text/javascript">
         function get_param (name) {
             name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
             var regexS = "[\\?&]"+name+"=([^&#]*)";
             var regex = new RegExp (regexS);
             var results = regex.exec (window.location.href);
             if (results == null) return null;
             else  return results[1];
         }
         if (get_param('mode'))planyo_embed_mode = get_param('mode');
         function get_full_planyo_file_path(name) {
             if(planyo_files_location.length==0||planyo_files_location.lastIndexOf('/')==planyo_files_location.length-1)return planyo_files_location+name;
             else return planyo_files_location+'/'+name;
         }
        </script>
        <script src='https://www.planyo.com/Plugins/PlanyoFiles/booking-utils.js' type='text/javascript'></script>
    </body>
</html>
