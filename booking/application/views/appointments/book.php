<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">
    <title>Réservation</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">

    <link
        rel="stylesheet"
        type="text/css"
        href="/css/bootstrap.min.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="/jquery-ui/jquery-ui.min.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="/jquery-qtip/jquery.qtip.min.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>/assets/css/frontend.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>/assets/css/general.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="/css/jquery.bootstrap-touchspin.css">

    <script
        type="text/javascript"
        src="/js/jquery.min.js"></script>
    <script
        type="text/javascript"
        src="/jquery-ui/jquery-ui.min.js"></script>
    <script
        type="text/javascript"
        src="/jquery-qtip/jquery.qtip.min.js"></script>
    <script
        type="text/javascript"
        src="/js/bootstrap.min.js"></script>
    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/ext/datejs/date.js"></script>
    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/frontend_book.js"></script>
    <script
        type="text/javascript"
        src="/js/jquery.bootstrap-touchspin.js"></script>


<script type="text/javascript">
var GlobalVariables = {
availableServices   : <?php echo json_encode($available_services); ?>,
    availableProviders  : <?php echo json_encode($available_providers); ?>,
    baseUrl             : <?php echo '"' . $this->config->item('base_url') . '"'; ?>,
    manageMode          : <?php echo ($manage_mode) ? 'true' : 'false'; ?>,
    dateFormat          : <?php echo json_encode($date_format); ?>,
    appointmentData     : <?php echo json_encode($appointment_data); ?>,
    providerData        : <?php echo json_encode($provider_data); ?>,
    customerData        : <?php echo json_encode($customer_data); ?>,
    csrfToken           : <?php echo json_encode($this->security->get_csrf_hash()); ?>
        };

var EALang = <?php echo json_encode($this->lang->language); ?>;
var availableLanguages = <?php echo json_encode($this->config->item('available_languages')); ?>;

$(document).ready(function() {
    FrontendBook.initialize(true, GlobalVariables.manageMode);
    GeneralFunctions.enableLanguageSelection($('#select-language'));
});
</script>
</head>

<body>
    <nav id="header" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-brand">
                <img src="/img/logo_R.png" alt="roseville escape logo" id="logo"/>
                <span><?php echo $this->lang->line('page_title'); ?></span>
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
                            <div class="form-group">
                                <div class="row">
                                    <div class="row">
                                        <h3>
                                            <?php
                                                echo $this->lang->line('select_room');
                                            ?>
                                        </h3>
                                        <select id="select-provider" class="form-control"></select>
                                    </div>
                                    <div class="row">
                                        <h3>
                                            <?php
                                                echo $this->lang->line('nb_participants');
                                            ?>
                                        </h3>
                                        <input id="nb_participants" type="text" value="1"  name="nb_participants"/>
                                    </div>
                                    <div class="row">
                                        <h3>
                                            <?php
                                                echo $this->lang->line('language');
                                            ?>
                                        </h3>
                                        <select id="language" class="form-control">
                                            <option value="1">Français</option>
                                            <option value="2">Anglais</option>
                                        </select>
                                    </div>
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

                    <div class="command-buttons">
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
                                <em id="form-message" class="text-danger">
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
            <p>Copyright &copy; Roseville Escape
        <?php if ($this->session->userdata('user_id')): ?>
            |
            <a href="<?php echo $this->config->item('base_url'); ?>/index.php/backend">
                <?php echo $this->lang->line('backend_section'); ?>
            </a>
        <?php endif; ?>
            </p>
        </div>
    </div>

    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"></script>
    <script>
        $("input[name='nb_participants']").TouchSpin({
            min: 2,
            max: 6,
            verticalbuttons: true,
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
