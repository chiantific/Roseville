<!DOCTYPE html>
<html>
    <head>
        <!-- meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#35A768" />
        <title><?php echo $this->lang->line('login') . ' - ' . $company_name; ?></title>

        <!-- CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/general.css"
            rel="stylesheet" type="text/css" />

        <!-- favicon -->
        <!--[if IE]>
            <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
                  rel="shortcut icon">
        <![endif]-->
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico"
              rel="shortcut icon" type="image/x-icon" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/img/apple-touch-icon.png"
              rel="apple-touch-icon" />
    </head>
    <body>
        <!-- preloader -->
        <div id="preloader">
            <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/preloader.gif"
                 alt="preloader animation" />
        </div>

        <!-- navbar -->
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header pull-left">
                    <a class="navbar-brand" href="<?php echo $company_link; ?>">
                        <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/logo_escape.png"
                             alt="logo" id="logo" class="logo_small" />
                        <span><?php echo $this->lang->line('booking_title'); ?></span>
                    </a>
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

        <!-- login -->
        <div id="login-frame" class="clear-frame">
            <div class="container">
                <div class="row">
                    <h1><?php echo $this->lang->line('backend_section'); ?></h1>
                    <p><?php echo $this->lang->line('you_need_to_login'); ?></p>
                    <hr />
                    <div class="alert hidden"></div>
                    <form id="login-form">
                        <div class="form-group">
                            <label for="username"><?php echo $this->lang->line('username'); ?></label>
                            <input type="text" id="username"
                                    placeholder="<?php echo $this->lang->line('enter_username_here'); ?>"
                                    class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="password"><?php echo $this->lang->line('password'); ?></label>
                            <input type="password" id="password"
                                    placeholder="<?php echo $this->lang->line('enter_password_here'); ?>"
                                    class="form-control" />
                        </div>
                        <br />
                        <button type="submit" id="login" class="btn btn-primary">
                            <?php echo $this->lang->line('login'); ?>
                        </button>
                        <br />
                        <br />
                        <a href="<?php echo $base_url; ?>/index.php/user/forgot_password" class="forgot-password">
                            <?php echo $this->lang->line('forgot_your_password'); ?></a>
                    </form>
                </div>
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                type="text/javascript">
        </script>
        <script type="text/javascript">
            var GlobalVariables = {
                'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
                'baseUrl': <?php echo '"' . $base_url . '"'; ?>,
                'destUrl': <?php echo '"' . $dest_url . '"'; ?>,
                'AJAX_SUCCESS': 'SUCCESS',
                'AJAX_FAILURE': 'FAILURE'
            };

            var EALang = <?php echo json_encode($this->lang->language); ?>;
            var availableLanguages = <?php echo json_encode($this->config->item('available_languages')); ?>;

            $(document).ready(function() {
                GeneralFunctions.enableLanguageSelection($('#select-language'), 'dropdown');
                GeneralFunctions.hidePreloader();

                /**
                 * Event: Login Button "Click"
                 *
                 * Make an ajax call to the server and check whether the user's credentials are right.
                 * If yes then redirect him to his desired page, otherwise display a message.
                 */
                $('#login-form').submit(function(event) {
                    event.preventDefault();

                    var postUrl = GlobalVariables.baseUrl + '/index.php/user/ajax_check_login';
                    var postData = {
                        'csrfToken': GlobalVariables.csrfToken,
                        'username': $('#username').val(),
                        'password': $('#password').val()
                    };

                    $('.alert').addClass('hidden');

                    $.post(postUrl, postData, function(response) {
                        //////////////////////////////////////////////////
                        console.log('Check Login Response: ', response);
                        //////////////////////////////////////////////////

                        if (!GeneralFunctions.handleAjaxExceptions(response)) return;

                        if (response == GlobalVariables.AJAX_SUCCESS) {
                            window.location.href = GlobalVariables.destUrl;
                        } else {
                            $('.alert').text(EALang['login_failed']);
                            $('.alert')
                                .removeClass('hidden alert-danger alert-success')
                                .addClass('alert-danger');
                        }
                    }, 'json');
                });
            });
        </script>
        <script src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"
                type="text/javascript">
        </script>
    </body>
</html>
