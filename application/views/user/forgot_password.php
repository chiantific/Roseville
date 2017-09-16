<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#35A768">
        <title><?php echo $this->lang->line('forgot_your_password') . ' - ' . $company_name; ?></title>


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

        <style>
            body {
                width: 100vw;
                height: 100vh;
                display: table-cell;
                vertical-align: middle;
                background-color: #CAEDF3;
            }

            #forgot-password-frame {
                width: 630px;
                margin: auto;
                background: #FFF;
                border: 1px solid #DDDADA;
                padding: 70px;
            }

            .user-login {
                margin-left: 20px;
            }

            @media(max-width: 640px) {
                #forgot-password-frame {
                    width: 100%;
                    padding: 20px;
                }
            }
        </style>

    </head>
    <body>
        <div id="forgot-password-frame" class="frame-container">
            <h2><?php echo $this->lang->line('forgot_your_password'); ?></h2>
            <p><?php echo $this->lang->line('type_username_and_email_for_new_password'); ?></p>
            <hr>
            <div class="alert hidden"></div>
            <form>
                <div class="form-group">
                    <label for="username"><?php echo $this->lang->line('username'); ?></label>
                    <input type="text" id="username" placeholder="<?php echo $this->lang->line('enter_username_here'); ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="email"><?php echo $this->lang->line('email'); ?></label>
                    <input type="text" id="email" placeholder="<?php echo $this->lang->line('enter_email_here'); ?>" class="form-control" />
                </div>

                <br>

                <button type="submit" id="get-new-password" class="btn btn-primary btn-large">
                    <?php echo $this->lang->line('regenerate_password'); ?>
                </button>

                <a href="<?php echo $base_url; ?>/index.php/user/login" class="user-login">
                    <?php echo $this->lang->line('go_to_login'); ?></a>
            </form>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"
                type="text/javascript">
        </script>
        <script type="text/javascript">
            var EALang = <?php echo json_encode($this->lang->language); ?>;
            $(document).ready(function() {
                var GlobalVariables = {
                    'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
                    'baseUrl': <?php echo '"' . $base_url . '"'; ?>,
                    'AJAX_SUCCESS': 'SUCCESS',
                    'AJAX_FAILURE': 'FAILURE'
                };

                var EALang = <?php echo json_encode($this->lang->language); ?>;

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
