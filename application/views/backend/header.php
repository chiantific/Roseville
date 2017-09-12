<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#35A768">
        <title><?php echo $company_name . " | " . $this->lang->line('administration'); ?></title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jScrollPane/2.0.23/style/jquery.jscrollpane.min.css"
              rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.css"
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
        <link href="<?php echo $this->config->item('base_url'); ?>/assets/css/backend.css"
              rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="preloader">
            <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/preloader.gif"
                 alt="preloader animation" />
        </div>
<?php /*
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header pull-left">
                    <div class="navbar-brand">
                        <a href="<?php echo $company_link; ?>">
                            <img src="<?php echo $this->config->item('base_url'); ?>/assets/img/logo_escape.png"
                                 alt="logo" id="logo" />
                        </a>
                        <span><?php echo $company_name; ?></span>
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
                        <li class="dropdown" id="select-language">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo ucfirst($this->config->item('language')); ?><b class="caret"></b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
 */ ?>

<div id="header">
    <div id="header-logo">
        <img src="/img/logo_escape.png">
        <span><?php echo $company_name; ?></span>
    </div>
    <div id="header-menu">
        <?php // CALENDAR MENU ITEM
              // ------------------------------------------------------ ?>
        <?php $hidden = ($privileges[PRIV_APPOINTMENTS]['view'] == TRUE) ? '' : 'hidden'; ?>
        <?php $active = ($active_menu == PRIV_APPOINTMENTS) ? 'active' : ''; ?>
        <a href="<?php echo $base_url; ?>/index.php/backend" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                title="<?php echo $this->lang->line('manage_appointment_record_hint'); ?>">
            <?php echo $this->lang->line('calendar'); ?>
        </a>

        <?php // CUSTOMERS MENU ITEM
              // ------------------------------------------------------ ?>
        <?php $hidden = ($privileges[PRIV_CUSTOMERS]['view'] == TRUE) ? '' : 'hidden'; ?>
        <?php $active = ($active_menu == PRIV_CUSTOMERS) ? 'active' : ''; ?>
        <a href="<?php echo $base_url; ?>/index.php/backend/customers" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                title="<?php echo $this->lang->line('manage_customers_hint'); ?>">
            <?php echo $this->lang->line('customers'); ?>
        </a>

        <?php // SERVICES MENU ITEM
              // ------------------------------------------------------ ?>
        <?php $hidden = ($privileges[PRIV_SERVICES]['view'] == TRUE) ? '' : 'hidden'; ?>
        <?php $active = ($active_menu == PRIV_SERVICES) ? 'active' : ''; ?>
        <a href="<?php echo $base_url; ?>/index.php/backend/services" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                title="<?php echo $this->lang->line('manage_services_hint'); ?>">
            <?php echo $this->lang->line('services'); ?>
        </a>

        <?php // USERS MENU ITEM
              // ------------------------------------------------------ ?>
        <?php $hidden = ($privileges[PRIV_USERS]['view'] ==  TRUE) ? '' : 'hidden'; ?>
        <?php $active = ($active_menu == PRIV_USERS) ? 'active' : ''; ?>
        <a href="<?php echo $base_url; ?>/index.php/backend/users" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                title="<?php echo $this->lang->line('manage_users_hint'); ?>">
            <?php echo $this->lang->line('users'); ?>
        </a>

        <?php // SETTINGS MENU ITEM
              // ------------------------------------------------------ ?>
        <?php $hidden = ($privileges[PRIV_SYSTEM_SETTINGS]['view'] == TRUE
                || $privileges[PRIV_USER_SETTINGS]['view'] == TRUE) ? '' : 'hidden'; ?>
        <?php $active = ($active_menu == PRIV_SYSTEM_SETTINGS) ? 'active' : ''; ?>
        <a href="<?php echo $base_url; ?>/index.php/backend/settings" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                title="<?php echo $this->lang->line('settings_hint'); ?>">
            <?php echo $this->lang->line('settings'); ?>
        </a>

        <?php // LOGOUT MENU ITEM
              // ------------------------------------------------------ ?>
        <a href="<?php echo $base_url; ?>/index.php/user/logout" class="menu-item"
                title="<?php echo $this->lang->line('log_out_hint'); ?>">
            <?php echo $this->lang->line('log_out'); ?>
        </a>

    </div>
</div>

<div id="notification" style="display: none;"></div>

<div id="loading" style="display: none;">
    <img src="<?php echo $base_url; ?>/assets/img/loading.gif" />
</div>

