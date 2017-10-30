<script type="text/javascript"
        src="<?php echo $base_url; ?>/assets/js/backend_settings.js"></script>
<script type="text/javascript"
        src="<?php echo $base_url; ?>/assets/js/working_plan.js"></script>

<script type="text/javascript">
    var GlobalVariables = {
        'csrfToken'     : <?php echo json_encode($this->security->get_csrf_hash()); ?>,
        'baseUrl'       : <?php echo '"' . $base_url . '"'; ?>,
        'dateFormat'    : <?php echo json_encode($date_format); ?>,
        'userSlug'      : <?php echo '"' . $role_slug . '"'; ?>,
        'settings'      : {
            'system'    : <?php echo json_encode($system_settings); ?>,
            'user'      : <?php echo json_encode($user_settings); ?>
        },
        'user'          : {
            'id'        : <?php echo $user_id; ?>,
            'email'     : <?php echo '"' . $user_email . '"'; ?>,
            'role_slug' : <?php echo '"' . $role_slug . '"'; ?>,
            'privileges': <?php echo json_encode($privileges); ?>
        }
    };

    document.addEventListener("DOMContentLoaded", function() {
        BackendSettings.initialize(true);
    });
</script>

<div id="settings-page" class="row-fluid">
    <ul class="nav nav-tabs">
        <?php if ($privileges[PRIV_SYSTEM_SETTINGS]['view'] == TRUE) { ?>
        <li role="representation" class="general-tab tab"><a><?php echo $this->lang->line('general'); ?></a></li>
        <?php } ?>

        <?php if ($privileges[PRIV_SYSTEM_SETTINGS]['view'] == TRUE) { ?>
        <li role="representation" class="business-logic-tab tab"><a><?php echo $this->lang->line('business_logic'); ?></a></li>
        <?php } ?>

        <?php if ($privileges[PRIV_USER_SETTINGS]['view'] == TRUE) { ?>
        <li role="representation" class="user-tab tab"><a><?php echo $this->lang->line('current_user'); ?></a></li>
        <?php } ?>
    </ul>

    <?php
        // --------------------------------------------------------------
        //
        // GENERAL TAB
        //
        // --------------------------------------------------------------
    ?>
    <?php $hidden = ($privileges[PRIV_SYSTEM_SETTINGS]['view'] == TRUE) ? '' : 'hidden'; ?>
    <div id="general" class="tab-content <?php echo $hidden; ?>">
        <form>
            <fieldset>
                <legend>
                    <?php echo $this->lang->line('general_settings'); ?>
                    <?php if ($privileges[PRIV_SYSTEM_SETTINGS]['edit'] == TRUE) { ?>
                    <button type="button" class="save-settings btn btn-primary btn-xs"
                            title="<?php echo $this->lang->line('save'); ?>">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                    <?php } ?>
                </legend>

                <div class="wrapper row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company-name"><?php echo $this->lang->line('company_name'); ?> *</label>
                            <input type="text" id="company-name" data-field="company_name" class="required form-control">
                            <span class="help-block">
                                <?php echo $this->lang->line('company_name_hint'); ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="company-email"><?php echo $this->lang->line('company_email'); ?> *</label>
                            <input type="text" id="company-email" data-field="company_email" class="required form-control">
                            <span class="help-block">
                                <?php echo $this->lang->line('company_email_hint'); ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="company-link"><?php echo $this->lang->line('company_link'); ?> *</label>
                            <input type="text" id="company-link" data-field="company_link" class="required form-control">
                            <span class="help-block">
                                <?php echo $this->lang->line('company_link_hint'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date-format">
                                <?php echo $this->lang->line('date_format'); ?>
                            </label>
                            <select class="form-control" id="date-format" data-field="date_format">
                                <option value="DMY">DMY</option>
                                <option value="MDY">MDY</option>
                                <option value="YMD">YMD</option>
                            </select>
                            <span class="help-block">
                                <?php echo $this->lang->line('date_format_hint'); ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('customer_notifications'); ?></label>
                            <br>
                            <button type="button" id="customer-notifications" class="btn btn-default" data-toggle="button" aria-pressed="false">
                                <span class="glyphicon glyphicon-envelope"></span>
                                <?php echo $this->lang->line('receive_notifications'); ?>
                            </button>
                            <span class="help-block">
                                <?php echo $this->lang->line('customer_notifications_hint'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <?php
        // --------------------------------------------------------------
        //
        // BUSINESS LOGIC TAB
        //
        // --------------------------------------------------------------
    ?>
    <?php $hidden = ($privileges[PRIV_SYSTEM_SETTINGS]['view'] == TRUE) ? '' : 'hidden'; ?>
    <div id="business-logic" class="tab-content <?php echo $hidden; ?>">
        <form>
            <fieldset>
                <legend>
                    <?php echo $this->lang->line('business_logic'); ?>
                    <?php if ($privileges[PRIV_SYSTEM_SETTINGS]['edit'] == TRUE) { ?>
                    <button type="button" class="save-settings btn btn-primary btn-xs"
                            title="<?php echo $this->lang->line('save'); ?>">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                    <?php } ?>
                </legend>

                <div class="row-fluid">
                    <div class="col-md-7 working-plan-wrapper">
                        <h4><?php echo $this->lang->line('working_plan'); ?></h4>
                        <span class="help-block">
                            <?php echo $this->lang->line('edit_working_plan_hint'); ?>
                        </span>

                        <table class="working-plan table table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('day'); ?></th>
                                    <th><?php echo $this->lang->line('start'); ?></th>
                                    <th><?php echo $this->lang->line('end'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="monday" />
                                                    <?php echo $this->lang->line('monday'); ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="text" id="monday-start" class="work-start" /></td>
                                    <td><input type="text" id="monday-end" class="work-end" /></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="tuesday" />
                                                    <?php echo $this->lang->line('tuesday'); ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="text" id="tuesday-start" class="work-start" /></td>
                                    <td><input type="text" id="tuesday-end" class="work-end" /></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="wednesday" />
                                                    <?php echo $this->lang->line('wednesday'); ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="text" id="wednesday-start" class="work-start" /></td>
                                    <td><input type="text" id="wednesday-end" class="work-end" /></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="thursday" />
                                                    <?php echo $this->lang->line('thursday'); ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="text" id="thursday-start" class="work-start" /></td>
                                    <td><input type="text" id="thursday-end" class="work-end" /></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="friday" />
                                                    <?php echo $this->lang->line('friday'); ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="text" id="friday-start" class="work-start" /></td>
                                    <td><input type="text" id="friday-end" class="work-end" /></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="saturday" />
                                                    <?php echo $this->lang->line('saturday'); ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="text" id="saturday-start" class="work-start" /></td>
                                    <td><input type="text" id="saturday-end" class="work-end" /></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="sunday" />
                                                    <?php echo $this->lang->line('sunday'); ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="text" id="sunday-start" class="work-start" /></td>
                                    <td><input type="text" id="sunday-end" class="work-end" /></td>
                                </tr>
                            </tbody>
                        </table>

                        <br>

                        <h4><?php echo $this->lang->line('book_advance_timeout'); ?></h4>
                        <span class="help-block">
                            <?php echo $this->lang->line('book_advance_timeout_hint'); ?>
                        </span>
                        <div class="form-group">
                            <label for="book-advance-timeout"><?php echo $this->lang->line('timeout_minutes'); ?></label>
                            <input type="text" id="book-advance-timeout" data-field="book_advance_timeout" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-5 breaks-wrapper">
                        <h4><?php echo $this->lang->line('breaks'); ?></h4>

                        <span class="help-block">
                            <?php echo $this->lang->line('edit_breaks_hint'); ?>
                        </span>

                        <div>
                            <button type="button" class="add-break btn btn-primary">
                                <span class="glyphicon glyphicon-white glyphicon glyphicon-plus"></span>
                                <?php echo $this->lang->line('add_break');?>
                            </button>
                        </div>

                        <br>

                        <table class="breaks table table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('day'); ?></th>
                                    <th><?php echo $this->lang->line('start'); ?></th>
                                    <th><?php echo $this->lang->line('end'); ?></th>
                                    <th><?php echo $this->lang->line('actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <?php
        // --------------------------------------------------------------
        //
        // USER TAB
        //
        // --------------------------------------------------------------
    ?>
    <?php $hidden = ($privileges[PRIV_USER_SETTINGS]['view'] == TRUE) ? '' : 'hidden'; ?>
    <div id="user" class="tab-content <?php echo $hidden; ?>">
        <form>
            <fieldset class="col-md-5 personal-info-wrapper">
                <legend>
                    <?php echo $this->lang->line('personal_information'); ?>
                    <?php if ($privileges[PRIV_USER_SETTINGS]['edit'] == TRUE) { ?>
                    <button type="button" class="save-settings btn btn-primary btn-xs"
                            title="<?php echo $this->lang->line('save'); ?>">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                    <?php } ?>
                </legend>

                <input type="hidden" id="user-id" />

                <div class="form-group">
                    <label for="first-name"><?php echo $this->lang->line('first_name'); ?> *</label>
                    <input type="text" id="first-name" class="form-control required" />
                </div>

                <div class="form-group">
                    <label for="last-name"><?php echo $this->lang->line('last_name'); ?> *</label>
                    <input type="text" id="last-name" class="form-control required" />
                </div>

                <div class="form-group">
                    <label for="email"><?php echo $this->lang->line('email'); ?> *</label>
                    <input type="text" id="email" class="form-control required" />
                </div>

                <div class="form-group">
                    <label for="phone-number"><?php echo $this->lang->line('phone_number'); ?> *</label>
                    <input type="text" id="phone-number" class="form-control required" />
                </div>

                <div class="form-group">
                    <label for="mobile-number"><?php echo $this->lang->line('mobile_number'); ?></label>
                    <input type="text" id="mobile-number" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="notes"><?php echo $this->lang->line('notes'); ?></label>
                    <textarea id="notes" class="form-control" rows="3"></textarea>
                </div>
            </fieldset>

            <fieldset class="col-md-5 miscellaneous-wrapper">
                <legend><?php echo $this->lang->line('system_login'); ?></legend>

                <div class="form-group">
                    <label for="username"><?php echo $this->lang->line('username'); ?> *</label>
                    <input type="text" id="username" class="form-control required" />
                </div>

                <div class="form-group">
                    <label for="password"><?php echo $this->lang->line('password'); ?></label>
                    <input type="password" id="password" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="retype-password"><?php echo $this->lang->line('retype_password'); ?></label>
                    <input type="password" id="retype-password" class="form-control" />
                </div>

                <button type="button" id="user-notifications" class="btn btn-default" data-toggle="button">
                    <span class="glyphicon glyphicon-envelope"></span>
                    <?php echo $this->lang->line('receive_notifications'); ?>
                </button>
            </fieldset>
        </form>
    </div>
</div>
