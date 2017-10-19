<script type="text/javascript"
        src="<?php echo $base_url; ?>/assets/js/backend_services.js"></script>

<script type="text/javascript">
    var GlobalVariables = {
        'csrfToken'     : <?php echo json_encode($this->security->get_csrf_hash()); ?>,
        'baseUrl'       : <?php echo '"' . $base_url . '"'; ?>,
        'dateFormat'    : <?php echo json_encode($date_format); ?>,
        'services'      : <?php echo json_encode($services); ?>,
        'categories'    : <?php echo json_encode($categories); ?>,
        'user'          : {
            'id'        : <?php echo $user_id; ?>,
            'email'     : <?php echo '"' . $user_email . '"'; ?>,
            'role_slug' : <?php echo '"' . $role_slug . '"'; ?>,
            'privileges': <?php echo json_encode($privileges); ?>
        }
    };

    document.addEventListener("DOMContentLoaded", function() {
        BackendServices.initialize(true);
    });
</script>

<div id="services-page" class="container">
    <ul class="nav nav-tabs">
        <li role="presentation" class="services-tab tab active"><a><?php echo $this->lang->line('services'); ?></a></li>
        <li role="presentation" class="categories-tab tab"><a><?php echo $this->lang->line('categories'); ?></a></li>
    </ul>
    
    <!-- Services tab -->
    <div id="services" class="tab-content">
        <div class="row">
            <div id="filter-services" class="col-md-4">
                <div class="results"></div>
            </div>

            <div class="details col-md-7">
                <div class="btn-toolbar">
                    <div class="add-edit-delete-group btn-group">
                        <button id="add-service" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span>
                            <?php echo $this->lang->line('add'); ?>
                        </button>
                        <button id="edit-service" class="btn btn-default" disabled="disabled">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <?php echo $this->lang->line('edit'); ?>
                        </button>
                        <button id="delete-service" class="btn btn-default" disabled="disabled">
                            <span class="glyphicon glyphicon-remove"></span>
                            <?php echo $this->lang->line('delete'); ?>
                        </button>
                    </div>

                    <div class="save-cancel-group btn-group" style="display:none;">
                        <button id="save-service" class="btn btn-primary">
                            <span class="glyphicon glyphicon-ok"></span>
                            <?php echo $this->lang->line('save'); ?>
                        </button>
                        <button id="cancel-service" class="btn btn-default">
                            <span class="glyphicon glyphicon-ban-circle"></span>
                            <?php echo $this->lang->line('cancel'); ?>
                        </button>
                    </div>
                </div>

                <h3><?php echo $this->lang->line('details'); ?></h3>
                <div class="form-message alert" style="display:none;"></div>

                <input type="hidden" id="service-id" />

                <div class="form-group">
                    <label for="service-name"><?php echo $this->lang->line('name'); ?> *</label>
                    <input type="text" id="service-name" class="form-control required" />
                </div>

                <div class="form-group">
                    <label for="service-duration"><?php echo $this->lang->line('duration_minutes'); ?> *</label>
                    <input type="text" id="service-duration" class="form-control required"  />
                </div>

                <div class="form-group">
                    <label for="service-price-week"><?php echo $this->lang->line('price_week'); ?> *</label>
                    <input type="text" id="service-price-week" class="form-control required" />
                </div>

                <div class="form-group">
                    <label for="service-price-week-end"><?php echo $this->lang->line('price_week_end'); ?> *</label>
                    <input type="text" id="service-price-week-end" class="form-control required" />
                </div>

                <div class="form-group">
                    <label for="service-currency"><?php echo $this->lang->line('currency'); ?></label>
                    <input type="text" id="service-currency" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="service-category"><?php echo $this->lang->line('category'); ?></label>
                    <select id="service-category" class="form-control"></select>
                </div>

                <div class="form-group">
                    <label for="service-description"><?php echo $this->lang->line('description'); ?></label>
                    <textarea id="service-description" rows="4" class="form-control"></textarea>
                </div>
                <br/>
                <br/>
                <em id="form-message" class="text-error">
                    <?php echo $this->lang->line('fields_are_required'); ?>
                </em>
            </div>
        </div>
    </div>

    <!-- Categories tab -->
    <div id="categories" class="tab-content" style="display:none;">
        <div class="row">
            <div id="filter-categories" class="col-md-4">
                <div class="results"></div>
            </div>

            <div class="details col-md-7">
                <div class="btn-toolbar">
                    <div class="add-edit-delete-group btn-group">
                        <button id="add-category" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus glyphicon glyphicon-white"></span>
                            <?php echo $this->lang->line('add'); ?>
                        </button>
                        <button id="edit-category" class="btn btn-default" disabled="disabled">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <?php echo $this->lang->line('edit'); ?>
                        </button>
                        <button id="delete-category" class="btn btn-default" disabled="disabled">
                            <span class="glyphicon glyphicon-remove"></span>
                            <?php echo $this->lang->line('delete'); ?>
                        </button>
                    </div>

                    <div class="save-cancel-group btn-group" style="display:none;">
                        <button id="save-category" class="btn btn-primary">
                            <span class="glyphicon glyphicon-ok glyphicon glyphicon-white"></span>
                            <?php echo $this->lang->line('save'); ?>
                        </button>
                        <button id="cancel-category" class="btn btn-default">
                            <span class="glyphicon glyphicon-ban-circle"></span>
                            <?php echo $this->lang->line('cancel'); ?>
                        </button>
                    </div>
                </div>

                <h3><?php echo $this->lang->line('details'); ?></h3>
                <div class="form-message alert" style="display:none;"></div>

                <input type="hidden" id="category-id" />

                <div class="form-group">
                    <label for="category-name"><?php echo $this->lang->line('name'); ?> *</label>
                    <input type="text" id="category-name" class="form-control required" />
                </div>

                <div class="form-group">
                    <label for="category-description"><?php echo $this->lang->line('description'); ?></label>
                    <textarea id="category-description" rows="4" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
