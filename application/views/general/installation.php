<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Roseville - Installation</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"
          rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
          rel="stylesheet" type="text/css" />
    <!--[if IE]>
        <link href="<?php echo $base_url; ?>/assets/img/favicon.ico"
              rel="shortcut icon">
    <![endif]-->
    <link href="<?php echo $base_url; ?>/assets/img/favicon.ico"
          rel="icon" type="image/x-icon" />
    <link href="<?php echo $base_url; ?>/assets/img/apple-touch-icon.png"
          rel="apple-touc-icon" />
    <link href="<?php echo $base_url; ?>/assets/css/general.css"
          rel="stylesheet" type="text/css" />
    <link href="<?php echo $base_url; ?>/assets/css/installation.css"
          rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="loading" class="hidden">
            <img src="<?php echo $base_url; ?>/assets/img/loading.gif" />
        </div>
        <header>
            <img src="<?php echo $base_url; ?>/assets/img/logo_escape.png"
                 alt="Logo" />
            <h3>Welcome to the installation page.</h3>
        </header>
        <div class="content container-fluid">
            <div class="alert hidden"></div>
            <div class="row">
                <div class="admin-settings col-md-5">
                    <h3>Administrator</h3>
                    <div class="form-group">
                        <label for="first-name" class="control-label">First Name</label>
                        <input type="text" id="first-name" class="form-control" />
                    </div>

                    <div class="form-group">
                    <label for="last-name" class="control-label">Last Name</label>
                    <input type="text" id="last-name" class="form-control" />
                    </div>

                    <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" id="email" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="phone-number" class="control-label">Phone Number</label>
                        <input type="text" id="phone-number" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" id="username" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" id="password" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="retype-password" class="control-label">Retype Password</label>
                        <input type="password" id="retype-password" class="form-control" />
                    </div>
                </div>

                <div class="company-settings col-md-5">
                    <h3>Company</h3>
                    <div class="form-group">
                        <label for="company-name" class="control-label">Company Name</label>
                        <input type="text" id="company-name" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="company-email" class="control-label">Company Email</label>
                        <input type="text" id="company-email" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="company-link" class="control-label">Company Link</label>
                        <input type="text" id="company-link" class="form-control" />
                    </div>
                </div>
            </div>

            <br>

            <button type="button" id="install" class="btn btn-success btn-large">
                <i class="icon-white icon-ok"></i>
                Install</button>
        </div>

        <script type="text/javascript">
            var GlobalVariables = {
                'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
                'baseUrl': <?php echo '"' . $base_url . '"'; ?>
            };
            var EALang = <?php echo json_encode($this->lang->language); ?>;
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
                type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"
                type="text/javascript">
        </script>
        <script src="<?php echo $base_url; ?>/assets/js/general_functions.js"
                type="text/javascript">
        </script>
        <script src="<?php echo $base_url; ?>/assets/ext/datejs/date.js"
            type="text/javascript">
        </script>
        <script src="<?php echo $base_url; ?>/assets/js/installation.js"
            type="text/javascript">
        </script>
    </body>
</html>
