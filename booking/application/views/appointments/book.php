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
        href="/css/style.css">


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
    <div id="main" class="container">
        <div class="wrapper row">
            <div id="book-appointment-wizard" class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

                <div id="header">
                    <span id="company-name">Réservation</span>
                </div>

<?php
// ------------------------------------------------------
// CANCEL APPOINTMENT BUTTON
// ------------------------------------------------------
if ($manage_mode === TRUE) {
    echo '
                            <div id="cancel-appointment-frame" class="row">
                                <div class="col-xs-12 col-sm-10">
                                    <p>' .
                                        $this->lang->line('cancel_appointment_hint') .
                                    '</p>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                    <form id="cancel-appointment-form" method="post"
                                            action="' . $this->config->item('base_url')
                                            . '/index.php/appointments/cancel/' . $appointment_data['hash'] . '">
                                        <input type="hidden" name="csrfToken" value="' . $this->security->get_csrf_hash() . '" />
                                        <textarea name="cancel_reason" style="display:none"></textarea>
                                        <button id="cancel-appointment" class="btn btn-default">' .
                                                $this->lang->line('cancel') . '</button>
                                    </form>
                                </div>
                            </div>';
}
?>

<?php
// ------------------------------------------------------
// DISPLAY EXCEPTIONS (IF ANY)
// ------------------------------------------------------
if (isset($exceptions)) {
    echo '<div style="margin: 10px">';
    echo '<h4>' . $this->lang->line('unexpected_issues') . '</h4>';
    foreach($exceptions as $exception) {
        echo exceptionToHtml($exception);
    }
    echo '</div>';
}
?>

<?php
// ------------------------------------------------------
// SELECT ROOM AND DATE
// ------------------------------------------------------ ?>

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
                                <h3 class="frame-title">Choisissez une salle</h3>
                                <select id="select-provider" class="col-md-4 form-control"></select>
                            </div>
                        </div>
                        <div class="frame-content">
                            <div class="form-group row">
                                <h3 class="frame-title">Choissez la date & l'heure</h3>
                                <div class="col-md-6">
                                    <div id="select-date"></div>
                                </div>

                                <div class="col-md-6">
                                    <?php // Available hours are going to be fetched via ajax call. ?>
                                    <div id="available-hours"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="button-next-1" class="btn button-next btn-primary"
                                data-step_index="1">
                            Suivant
                            <span class="glyphicon glyphicon-forward"></span>
                        </button>
                    </div>
                </div>

<?php
    // ------------------------------------------------------
    // ENTER CUSTOMER DATA
    // ------------------------------------------------------ ?>

                <div id="wizard-frame-2" class="wizard-frame" style="display:none;">
                    <div class="frame-container">

                        <h3 class="frame-title">Remplissez vos informations</h3>

                        <div class="frame-content row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name" class="control-label">Prénom *</label>
                                    <input type="text" id="first-name" class="required form-control" maxlength="100" />
                                </div>
                                <div class="form-group">
                                    <label for="last-name" class="control-label">Nom *</label>
                                    <input type="text" id="last-name" class="required form-control" maxlength="250" />
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">Email *</label>
                                    <input type="text" id="email" class="required form-control" maxlength="250" />
                                </div>
                                <div class="form-group">
                                    <label for="phone-number" class="control-label">Numéro de téléphone *</label>
                                    <input type="text" id="phone-number" class="required form-control" maxlength="60" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="control-label">Adresse</label>
                                    <input type="text" id="address" class="form-control" maxlength="250" />
                                </div>
                                <div class="form-group">
                                    <label for="city" class="control-label">Ville</label>
                                    <input type="text" id="city" class="form-control" maxlength="120" />
                                </div>
                                <div class="form-group">
                                    <label for="zip-code" class="control-label">Code postal</label>
                                    <input type="text" id="zip-code" class="form-control" maxlength="120" />
                                </div>
                                <div class="form-group">
                                    <label for="notes" class="control-label">Informations</label>
                                    <textarea id="notes" maxlength="500" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <em id="form-message" class="text-danger">Les champs avec un * sont obligatoires</em>
                        </div>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="button-back-2" class="btn button-back btn-default"
                                data-step_index="2"><span class="glyphicon glyphicon-backward"></span>
                            Retour
                        </button>
                        <button type="button" id="button-next-2" class="btn button-next btn-primary"
                                data-step_index="2">
                            Suivant
                            <span class="glyphicon glyphicon-forward"></span>
                        </button>
                    </div>
                </div>

<?php
    // ------------------------------------------------------
    // APPOINTMENT DATA CONFIRMATION
    // ------------------------------------------------------ ?>

                <div id="wizard-frame-3" class="wizard-frame" style="display:none;">
                    <div class="frame-container">
                        <h3 class="frame-title">Confirmation</h3>
                        <div class="frame-content row">
                            <div id="appointment-details" class="col-md-6"></div>
                            <div id="customer-details" class="col-md-6"></div>
                        </div>
                        <?php if ($this->settings_model->get_setting('require_captcha') === '1'): ?>
                        <div class="frame-content row">
                            <div class="col-md-6 col-sm-12">
                                <h4 class="captcha-title">
                                    CAPTCHA
                                    <small class="glyphicon glyphicon-refresh"></small>
                                </h4>
                                <img class="captcha-image" src="<?php echo $this->config->item('base_url'); ?>/index.php/captcha">
                                <input class="captcha-text" type="text" value="" />
                                <span id="captcha-hint" class="help-block" style="opacity:0">&nbsp;</span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="button-back-3" class="btn button-back btn-default"
                                data-step_index="3">
                            <span class="glyphicon glyphicon-backward"></span>
                            Retour
                        </button>
                        <form id="book-appointment-form" style="display:inline-block" method="post">
                            <button id="book-appointment-submit" type="button" class="btn btn-success">
                                <span class="glyphicon glyphicon-ok"></span>
Confirmation
                            </button>
                            <input type="hidden" name="csrfToken" />
                            <input type="hidden" name="post_data" />
                        </form>
                    </div>
                </div>

                <div id="frame-footer">
                    <div class="container">
                        <p>Copyright &copy; Roseville.</p>
                    </div>
                    <?php if ($this->session->userdata('user_id')): ?>
                        |
                        <a href="<?php echo $this->config->item('base_url'); ?>/index.php/backend">
                            <?php echo $this->lang->line('backend_section'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"></script>
</body>
</html>
