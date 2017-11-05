<script type="text/javascript"
        src="<?php echo $base_url; ?>/assets/js/backend_customers.js"></script>

<script type="text/javascript">
    var GlobalVariables = {
        'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
        'availableProviders': <?php echo json_encode($available_providers); ?>,
        'availableServices' : <?php echo json_encode($available_services); ?>,
        'dateFormat'        : <?php echo json_encode($date_format); ?>,
        'baseUrl'           : <?php echo '"' . $base_url . '"'; ?>,
        'customers'         : <?php echo json_encode($customers); ?>,
        'user'              : {
            'id'        : <?php echo $user_id; ?>,
            'email'     : <?php echo '"' . $user_email . '"'; ?>,
            'role_slug' : <?php echo '"' . $role_slug . '"'; ?>,
            'privileges': <?php echo json_encode($privileges); ?>
        }
    };

    document.addEventListener("DOMContentLoaded", function() {
        BackendCustomers.initialize(true);
    });
</script>

<div id="customers-page" class="container">
    <div class="row">
    	<div id="filter-customers" class="col-md-4">
            <div class="results"></div>
    	</div>

    	<div class="details col-md-7">
            <div class="btn-toolbar">
                <div id="add-edit-delete-group" class="btn-group">
                    <?php if ($privileges[PRIV_CUSTOMERS]['add'] == TRUE) { ?>
                    <button id="add-customer" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>
                        <?php echo $this->lang->line('add'); ?>
                    </button>
                    <?php } ?>

                    <?php if ($privileges[PRIV_CUSTOMERS]['edit'] == TRUE) { ?>
                    <button id="edit-customer" class="btn btn-default" disabled="disabled">
                        <span class="glyphicon glyphicon-pencil"></span>
                        <?php echo $this->lang->line('edit'); ?>
                    </button>
                    <?php }?>

                    <?php if ($privileges[PRIV_CUSTOMERS]['delete'] == TRUE) { ?>
                    <button id="delete-customer" class="btn btn-default" disabled="disabled">
                        <span class="glyphicon glyphicon-remove"></span>
                        <?php echo $this->lang->line('delete'); ?>
                    </button>
                    <?php } ?>
                </div>

                <div id="save-cancel-group" class="btn-group" style="display:none;">
                    <button id="save-customer" class="btn btn-primary">
                        <span class="glyphicon glyphicon-ok"></span>
                        <?php echo $this->lang->line('save'); ?>
                    </button>
                    <button id="cancel-customer" class="btn btn-default">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <?php echo $this->lang->line('cancel'); ?>
                    </button>
                </div>
            </div>

            <input id="customer-id" type="hidden" />

            <div class="col-md-6" style="margin-left: 0;">
                <h3><?php echo $this->lang->line('details'); ?></h3>
                <div id="form-message" class="alert" style="display:none;"></div>

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
                    <label for="notes"><?php echo $this->lang->line('notes'); ?></label>
                    <textarea id="notes" rows="4" class="form-control"></textarea>
                </div>

                <center><em id="form-message" class="text-error">
                    <?php echo $this->lang->line('fields_are_required'); ?></em></center>
            </div>

            <div class="col-md-5">
                <h3><?php echo $this->lang->line('appointments'); ?></h3>
                <div id="customer-appointments"></div>
                <div id="appointment-details"></div>
            </div>
    	</div>
    </div>
</div>
