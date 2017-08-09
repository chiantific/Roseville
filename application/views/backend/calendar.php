<link rel="stylesheet" type="text/css"
        href="<?php echo $base_url; ?>/assets/ext/jquery-fullcalendar/jquery.fullcalendar.css" />

<script type="text/javascript"
        src="<?php echo $base_url; ?>/assets/ext/jquery-fullcalendar/jquery.fullcalendar.min.js"></script>

        <script type="text/javascript"
        src="/jquery-ui/jquery-ui-timepicker-addon.js"></script>

<script type="text/javascript"
        src="<?php echo $base_url; ?>/assets/js/backend_calendar.js"></script>

<script type="text/javascript">
    var GlobalVariables = {
        'csrfToken'             : <?php echo json_encode($this->security->get_csrf_hash()); ?>,
        'availableProviders'    : <?php echo json_encode($available_providers); ?>,
        'availableServices'     : <?php echo json_encode($available_services); ?>,
        'baseUrl'               : <?php echo '"' . $base_url . '"'; ?>,
        'bookAdvanceTimeout'    : <?php echo $book_advance_timeout; ?>,
        'dateFormat'            : <?php echo json_encode($date_format); ?>,
        'editAppointment'       : <?php echo json_encode($edit_appointment); ?>,
        'customers'             : <?php echo json_encode($customers); ?>,
        'user'                  : {
            'id'        : <?php echo $user_id; ?>,
            'email'     : <?php echo '"' . $user_email . '"'; ?>,
            'role_slug' : <?php echo '"' . $role_slug . '"'; ?>,
            'privileges': <?php echo json_encode($privileges); ?>
        }
    };

    $(document).ready(function() {
        BackendCalendar.initialize(true);
    });
</script>

<div id="calendar-page">
    <div id="calendar-toolbar">
        <div id="calendar-filter" class="form-group form-inline">
            <label for="select-filter-item">
                <?php echo $this->lang->line('display_calendar'); ?>
            </label>
            <select id="select-filter-item" class="form-control">
                    title="<?php echo $this->lang->line('select_filter_item_hint'); ?>">
            </select>
        </div>

        <div id="calendar-actions">
            <div class="btn-group">
                <button id="reload-appointments" class="btn btn-default"
                        title="<?php echo $this->lang->line('reload_appointments_hint'); ?>">
                    <span class="glyphicon glyphicon-repeat"></span>
                    <?php echo $this->lang->line('reload'); ?>
                </button>
            </div>

            <?php if ($privileges[PRIV_APPOINTMENTS]['add'] == TRUE) { ?>
            <div class="btn-group">
                <button id="insert-appointment" class="btn btn-primary"
                        title="<?php echo $this->lang->line('new_appointment_hint'); ?>">
                    <span class="glyphicon glyphicon-plus"></span>
                    <?php echo $this->lang->line('appointment'); ?>
                </button>

                <button id="insert-unavailable" class="btn btn-default"
                        title="<?php echo $this->lang->line('unavailable_periods_hint'); ?>">
                    <span class="glyphicon glyphicon-plus"></span>
                    <?php echo $this->lang->line('unavailable'); ?>
                </button>
            </div>
            <?php } ?>
        </div>
    </div>

    <div id="calendar"></div> <?php // Main calendar container ?>
</div>

<?php
    // --------------------------------------------------------------------
    //
    // MANAGE APPOINTMENT
    //
    // --------------------------------------------------------------------
?>
<div id="manage-appointment" class="modal fade full-screen" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="wrapper">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h3 class="modal-title"><?php echo $this->lang->line('edit_appointment_title'); ?></h3>
                </div>

                <div class="modal-body">
                    <div class="modal-message alert hidden"></div>

                    <form class="form-horizontal">
                        <fieldset class="container">
                            <legend><?php echo $this->lang->line('appointment_details_title'); ?></legend>

                            <input id="appointment-id" type="hidden" />

                            <div class="form-group">
                                <label for="select-service" class="col-sm-3 control-label"><?php echo $this->lang->line('service'); ?> *</label>
                                <div class="col-sm-7">
                                    <select id="select-service" class="required form-control">
                                        <?php
                                            // Group services by category, only if there is at least one service
                                            // with a parent category.
                                            $has_category = FALSE;
                                            foreach($available_services as $service) {
                                                if ($service['category_id'] != NULL) {
                                                    $has_category = TRUE;
                                                    break;
                                                }
                                            }

                                            if ($has_category) {
                                                $grouped_services = array();

                                                foreach($available_services as $service) {
                                                    if ($service['category_id'] != NULL) {
                                                        if (!isset($grouped_services[$service['category_name']])) {
                                                            $grouped_services[$service['category_name']] = array();
                                                        }

                                                        $grouped_services[$service['category_name']][] = $service;
                                                    }
                                                }

                                                // We need the uncategorized services at the end of the list so
                                                // we will use another iteration only for the uncategorized services.
                                                $grouped_services['uncategorized'] = array();
                                                foreach($available_services as $service) {
                                                    if ($service['category_id'] == NULL) {
                                                        $grouped_services['uncategorized'][] = $service;
                                                    }
                                                }

                                                foreach($grouped_services as $key => $group) {
                                                    $group_label = ($key != 'uncategorized')
                                                            ? $group[0]['category_name'] : 'Uncategorized';

                                                    if (count($group) > 0) {
                                                        echo '<optgroup label="' . $group_label . '">';
                                                        foreach($group as $service) {
                                                            echo '<option value="' . $service['id'] . '">'
                                                                . $service['name'] . '</option>';
                                                        }
                                                        echo '</optgroup>';
                                                    }
                                                }
                                            }  else {
                                                foreach($available_services as $service) {
                                                    echo '<option value="' . $service['id'] . '">'
                                                                . $service['name'] . '</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="select-provider" class="col-sm-3 control-label"><?php echo $this->lang->line('provider'); ?> *</label>
                                <div class="col-md-7">
                                    <select id="select-provider" class="required form-control"></select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="start-datetime" class="col-sm-3 control-label" ><?php echo $this->lang->line('start_date_time'); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" id="start-datetime" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end-datetime" class="control-label col-sm-3" ><?php echo $this->lang->line('end_date_time'); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" id="end-datetime" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nb_participants" class="control-label col-sm-3" ><?php echo $this->lang->line('nb_participants'); ?> *</label>
                                <div class="col-sm-7">
                                    <input type="number" id="nb_participants" class="required" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="language" class="control-label col-sm-3" ><?php echo $this->lang->line('language'); ?> *</label>
                                <div class="col-sm-7">
                                    <select id="language" class="required form-control">
                                        <option value="1">Français</option>
                                        <option value="2">Anglais</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="language" class="control-label col-sm-3" ><?php echo $this->lang->line('is_paid'); ?></label>
                                <div class="col-sm-7">
                                    <input type="checkbox" id="is_paid" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="appointment-notes" class="control-label col-sm-3" ><?php echo $this->lang->line('notes'); ?></label>
                                <div class="col-sm-7">
                                    <textarea id="appointment-notes" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="container">
                            <legend>
                                <?php echo $this->lang->line('customer_details_title'); ?>
                                <button id="new-customer" class="btn btn-default btn-xs"
                                        title="<?php echo $this->lang->line('clear_fields_add_existing_customer_hint'); ?>"
                                        type="button"><?php echo $this->lang->line('new'); ?>
                                </button>
                                <button id="select-customer" class="btn btn-primary btn-xs"
                                        title="<?php echo $this->lang->line('pick_existing_customer_hint'); ?>"
                                        type="button"><?php echo $this->lang->line('select'); ?>
                                </button>
                                <input type="text" id="filter-existing-customers"
                                       placeholder="<?php echo $this->lang->line('type_to_filter_customers'); ?>"
                                       style="display: none;" class="input-medium span4"/>
                                <div id="existing-customers-list" style="display: none;"></div>
                            </legend>

                            <input id="customer-id" type="hidden" />

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name" class="control-label col-sm-2">
                                        <?php echo $this->lang->line('first_name'); ?> *</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="first-name" class="required form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="last-name" class="control-label col-sm-2">
                                        <?php echo $this->lang->line('last_name'); ?>*</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="last-name" class="required form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="control-label col-sm-2">
                                        <?php echo $this->lang->line('email'); ?>*</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="email" class="required form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone-number" class="control-label col-sm-3">
                                        <?php echo $this->lang->line('phone_number'); ?>*</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="phone-number" class="required form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer-notes" class="control-label col-sm-3">
                                        <?php echo $this->lang->line('notes'); ?></label>
                                    <div class="col-md-8">
                                        <textarea id="customer-notes" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

            </div>
            <div class="modal-footer footer">
                <button id="save-appointment" class="btn btn-primary">
                    <?php echo $this->lang->line('save'); ?>
                </button>
                <button id="cancel-appointment" class="btn btn-default" data-dismiss="modal">
                    <?php echo $this->lang->line('cancel'); ?>
                </button>
            </div>
        </div>

    </div>
</div>

<?php
    // --------------------------------------------------------------------
    //
    // MANAGE UNAVAILABLE
    //
    // --------------------------------------------------------------------
?>
<div id="manage-unavailable" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                <h3 class="modal-title"><?php echo $this->lang->line('new_unavailable_title'); ?></h3>
            </div>

            <div class="modal-body">
                <div class="modal-message alert hidden"></div>

                <form class="form-horizontal">
                    <fieldset>
                        <input id="unavailable-id" type="hidden" />

                        <div class="form-group">
                            <label for="unavailable-start" class="control-label col-sm-3">
                                <?php echo $this->lang->line('start'); ?>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" id="unavailable-start" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unavailable-end" class="control-label col-sm-3">
                                <?php echo $this->lang->line('end'); ?>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" id="unavailable-end" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unavailable-notes" class="control-label col-sm-3">
                                <?php echo $this->lang->line('notes'); ?>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="unavailable-notes" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="modal-footer">
                <button id="save-unavailable" class="btn btn-primary">
                    <?php echo $this->lang->line('save'); ?>
                </button>
                <button id="cancel-unavailable" class="btn btn-default" data-dismiss="modal">
                    <?php echo $this->lang->line('cancel'); ?>
                </button>
            </div>

        </div>
    </div>
</div>
