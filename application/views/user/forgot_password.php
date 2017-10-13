<!DOCTYPE html>
<html>
    <head>
        <!-- meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#35A768" />
        <title><?php echo $this->lang->line('forgot_your_password') . ' - ' . $company_name; ?></title>

        <!-- CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/general.css"
            rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/small_page.css"
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
    <body>
        <!-- preloader -->
        <div id="preloader">
            <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/preloader.gif"
                 alt="preloader animation" />
        </div>

        <!-- navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header pull-left">
                    <a class="navbar-brand" href="<?php echo $company_link; ?>">
                        <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/logo_escape.png"
                             alt="logo" id="logo" />
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

        <!-- forgot password -->
        <div id="forgot-password-frame" class="simple-frame">
            <div class="container">
                <div class="row">
                    <h1><?php echo $this->lang->line('forgot_your_password'); ?></h1>
                    <p><?php echo $this->lang->line('type_username_and_email_for_new_password'); ?></p>
                    <hr />
                    <div class="alert hidden"></div>
                    <form id="forgot-form">
                        <div class="form-group">
                            <label for="username"><?php echo $this->lang->line('username'); ?></label>
                            <input type="text" id="username"
                                   placeholder="<?php echo $this->lang->line('enter_username_here'); ?>"
                                   class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo $this->lang->line('email'); ?></label>
                            <input type="text" id="email"
                                   placeholder="<?php echo $this->lang->line('enter_email_here'); ?>"
                                   class="form-control" />
                        </div>
                        <br />
                        <button type="submit" id="get-new-password" class="btn btn-primary btn-large">
                            <?php echo $this->lang->line('regenerate_password'); ?>
                        </button>
                        <br />
                        <br />
                        <a href="<?php echo $base_url; ?>/index.php/user/login" class="user-login">
                            <?php echo $this->lang->line('go_to_login'); ?></a>
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
                $('form').submit(function(event) {
                    event.preventDefault();

                    var postUrl = GlobalVariables.baseUrl + '/index.php/user/ajax_forgot_password';
                    var postData = {
                        'csrfToken': GlobalVariables.csrfToken,
                        'username': $('#username').val(),
                        'email': $('#email').val()
                    };

                    $('.alert').addClass('hidden');
                    $('#get-new-password').prop('disabled', true);

                    $.post(postUrl, postData, function(response) {
                        //////////////////////////////////////////////////////////
                        console.log('Regenerate Password Response: ', response);
                        //////////////////////////////////////////////////////////

                        $('.alert').removeClass('hidden alert-danger alert-success');
                        $('#get-new-password').prop('disabled', false);
                        
                        if (!GeneralFunctions.handleAjaxExceptions(response)) return;

                        if (response == GlobalVariables.AJAX_SUCCESS) {
                            $('.alert').addClass('alert-success');
                            $('.alert').text(EALang['new_password_sent_with_email']);
                        } else {
                            $('.alert').addClass('alert-danger');
                            $('.alert').text('The operation failed! Please enter a valid username '
                                    + 'and email address in order to get a new password.');
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
