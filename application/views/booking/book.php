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
                    <div id="wizard-frame-1" class="wizard-frame">
                        <div class="frame-container">
                            <div class="frame-content">
                                <select id="select-service" style="display:none;">
    <?php
    foreach($available_services as $service) {
        echo '<option value="' . $service['id'] . '">'
            . $service['name'] . '</option>';
    }
    ?>
                                </select>
                                <div class="form-group row">
                                    <h3 class="frame-title">
                                        <?php
                                            echo $this->lang->line('step_one_title');
                                        ?>
                                    </h3>
                                    <div class="form-group">
                                        <label for="select-provider" class="control-label">
                                            <?php
                                                echo $this->lang->line('select_room');
                                            ?>
                                        </label>
                                        <select id="select-provider" class="form-control"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nb_participants" class="control-label">
                                            <?php
                                                echo $this->lang->line('nb_participants');
                                            ?>
                                        </label>
                                        <input id="nb_participants" type="text" value="1"  name="nb_participants"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="language" class="control-label">
                                            <?php
                                                echo $this->lang->line('language');
                                            ?>
                                        </label>
                                        <select id="language" class="form-control">
                                            <option value="1">Français</option>
                                            <option value="2">Anglais</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="command-buttons">
                            <button type="button" id="button-next-1" class="btn button-next btn-primary"
                                    data-step_index="1">
                                <?php echo $this->lang->line('next'); ?>
                            </button>
                        </div>
                    </div>

    <!-- Select schedule -->
                    <div id="wizard-frame-2" class="wizard-frame" style="display:none;">
                        <div class="frame-container">
                            <div class="frame-content">
                                <div class="form-group row">
                                    <h3 class="frame-title">
                                        <?php
                                            echo $this->lang->line('step_two_title');
                                        ?>
                                    </h3>
                                    <div class="col-sm-6">
                                        <div id="select-date"></div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="hours">
                                            <div class="header">
                                                <?php
                                                    echo $this->lang->line('schedule');
                                                ?>
                                            </div>
                                            <?php // Available hours are going to be fetched via ajax call. ?>
                                            <div id="available-hours"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-sm-offset-6 command-buttons">
                            <button type="button" id="button-back-2" class="btn button-back btn-default"
                                    data-step_index="2">
                                <?php echo $this->lang->line('back'); ?>
                            </button>
                            <button type="button" id="button-next-2" class="btn button-next btn-primary"
                                    data-step_index="2">
                                <?php echo $this->lang->line('next'); ?>
                            </button>
                        </div>
                    </div>

    <!-- Customer data -->
                    <div id="wizard-frame-3" class="wizard-frame" style="display:none;">
                        <div class="frame-container">

                        <h3 class="frame-title"><?php echo $this->lang->line('step_three_title')?></h3>

                            <div class="frame-content row">
                                <div class="col-md-6 col-left">
                                    <div class="form-group">
                                        <label for="first-name" class="control-label">
                                            <?php
                                                echo $this->lang->line('first_name');
                                            ?> *
                                        </label>
                                        <input type="text" id="first-name" class="required form-control" maxlength="100" />
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name" class="control-label">
                                            <?php
                                                echo $this->lang->line('last_name');
                                            ?> *
                                        </label>
                                        <input type="text" id="last-name" class="required form-control" maxlength="250" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label">
                                            <?php
                                                echo $this->lang->line('email');
                                            ?> *</label>
                                        <input type="email" id="email" class="required form-control" maxlength="250" />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone-number" class="control-label">
                                            <?php
                                                echo $this->lang->line('phone_number');
                                            ?> *
                                        </label>
                                        <input type="tel" id="phone-number" class="required form-control" maxlength="60" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-right">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">
                                            <?php
                                                echo $this->lang->line('notes');
                                            ?>
                                        </label>
                                        <textarea id="notes" maxlength="500" class="form-control" rows="3"></textarea>
                                    </div>
                                    <em id="form-message">
                                        <?php
                                            echo $this->lang->line('fields_are_required');
                                        ?>
                                    </em>
                                </div>
                            </div>
                        </div>

                        <div class="command-buttons">
                            <button type="button" id="button-back-3" class="btn button-back btn-default"
                                    data-step_index="3">
                                <?php echo $this->lang->line('back'); ?>
                            </button>
                            <button type="button" id="button-next-3" class="btn button-next btn-primary"
                                    data-step_index="3">
                                <?php echo $this->lang->line('next'); ?>
                            </button>
                        </div>
                    </div>

    <!-- Data confirmation -->
                    <div id="wizard-frame-4" class="wizard-frame" style="display:none;">
                        <div class="frame-container">
                            <h3 class="frame-title">
                                <?php
                                    echo $this->lang->line('step_four_title');
                                ?>
                            </h3>
                            <div class="frame-content row">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tbody id="appointment-details">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table">
                                        <tbody id="customer-details">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="command-buttons">
                            <button type="button" id="button-back-4" class="btn button-back btn-default"
                                    data-step_index="4">
                                <?php echo $this->lang->line('back'); ?>
                            </button>
                            <form id="book-appointment-form" style="display:inline-block" method="post">
                                <button id="book-appointment-submit" type="button" class="btn btn-success">
                                    <?php echo $this->lang->line('payment'); ?>
                                </button>
                                <input type="hidden" name="csrfToken" />
                                <input type="hidden" name="post_data" />
                            </form>
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
                availableServices   : <?php echo json_encode($available_services); ?>,
                availableProviders  : <?php echo json_encode($available_providers); ?>,
                baseUrl             : <?php echo '"' . $this->config->item('base_url') . '"'; ?>,
                dateFormat          : <?php echo json_encode($date_format); ?>,
                appointmentData     : <?php echo json_encode($appointment_data); ?>,
                providerData        : <?php echo json_encode($provider_data); ?>,
                customerData        : <?php echo json_encode($customer_data); ?>,
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
        <script>
            $("input[name='nb_participants']").TouchSpin({
                min: 2,
                max: 6,
                verticalbuttons: true,
            });

            $("#select-provider").change(function () {
                if ($("#select-provider option:selected").text() == "Chocolat")
                {
                    $("input[name='nb_participants']").trigger("touchspin.updatesettings",
                        {max: 6});
                } else {
                    $("input[name='nb_participants']").trigger("touchspin.updatesettings",
                        {max: 5});
                }
            });
        </script>
        <script>
            $("#phone-number").keyup(function() {
                if ($("#phone-number").val().match(/^\+?[0-9]{0,15}$/)) {
                    return true;
                } else {
                    document.getElementById("phone-number").value = $("#phone-number").val().slice(0,-1);
                    return false;
                }
            });
        </script>
    </body>
</html>
