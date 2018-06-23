/**
 * This namespace contains functions that implement the book appointment page
 * functionality. Once the initialize() method is called the page is fully
 * functional and can serve the appointment booking process.
 *
 * @namespace FrontendBook
 */
var FrontendBook = {
    /**
     * Contains the free dates of the displayed month
     *
     * @type {string[]}
     */
    freeDates: [],

    /**
     * This method initializes the book appointment page.
     *
     * @param {bool} bindEventHandlers (OPTIONAL) Determines whether the default
     * event handlers will be binded to the dom elements.
     */
    initialize: function(bindEventHandlers) {
        if (bindEventHandlers === undefined) {
            bindEventHandlers = true; // Default Value
        }

        if (window.console === undefined) {
            window.console = function() {} // IE compatibility
        }

        // Initialize page's components (tooltips, datepickers etc).
        $('.book-step').qtip({
            position: {
                my: 'top center',
                at: 'bottom center'
            },
            style: {
                classes: 'qtip-green qtip-shadow custom-qtip'
            }
        });

        var today = new Date();
        $('#select-service').ready( function() {
            FrontendBook.getAvailableDates(today.getFullYear(), today.getMonth()+1);
        });

        $('#select-date').datepicker({
            dateFormat: 'dd-mm-yy',
            firstDay: 1, // Monday
            minDate: 0,
            onChangeMonthYear: FrontendBook.getAvailableDates,
            beforeShowDay: function(date) {
                return [(!(FrontendBook.freeDates.indexOf(date.getDate()) == -1))];
            },

            defaultDate: Date.today(),

            dayNames: [EALang['sunday'], EALang['monday'], EALang['tuesday'], EALang['wednesday'], EALang['thursday'], EALang['friday'], EALang['saturday']],
            dayNamesShort: [EALang['sunday'].substr(0,3), EALang['monday'].substr(0,3),
                    EALang['tuesday'].substr(0,3), EALang['wednesday'].substr(0,3),
                    EALang['thursday'].substr(0,3), EALang['friday'].substr(0,3),
                    EALang['saturday'].substr(0,3)],
            dayNamesMin: [EALang['sunday'].substr(0,2), EALang['monday'].substr(0,2),
                    EALang['tuesday'].substr(0,2), EALang['wednesday'].substr(0,2),
                    EALang['thursday'].substr(0,2), EALang['friday'].substr(0,2),
                    EALang['saturday'].substr(0,2)],
            monthNames: [EALang['january'], EALang['february'], EALang['march'], EALang['april'],
                    EALang['may'], EALang['june'], EALang['july'], EALang['august'], EALang['september'],
                    EALang['october'], EALang['november'], EALang['december']],
            prevText: EALang['previous'],
            nextText: EALang['next'],
            currentText: EALang['now'],
            closeText: EALang['close'],

            onSelect: function(dateText, instance) {
                FrontendBook.getAvailableHours(dateText);
                FrontendBook.updateConfirmFrame();
            }
        });


        // Bind the event handlers (might not be necessary every time
        // we use this class).
        if (bindEventHandlers) {
            FrontendBook.bindEventHandlers();
        }

        $('#select-service').trigger('change'); // Load the available hours.
    },

    /**
     * This method binds the necessary event handlers for the book
     * appointments page.
     */
    bindEventHandlers: function() {
        /**
         * Event: Selected Service "Changed"
         *
         * Whenever the service changes the available appointment
         * date - time periods must be updated.
         */
        $('#select-service').change(function() {
            today = Date.today()
            FrontendBook.getAvailableDates(today.getFullYear(), today.getMonth()+1);

            var selectedDate = $('#select-date').datepicker('getDate');
            if (selectedDate !== null) {
                selectedDate = selectedDate.toString('dd-MM-yyyy');
            }
            FrontendBook.getAvailableHours(selectedDate);
            FrontendBook.updateConfirmFrame();
        });

        /**
         * Event: Next Step Button "Clicked"
         *
         * This handler is triggered every time the user pressed the
         * "next" button on the book wizard. Some special tasks might
         * be perfomed, depending the current wizard step.
         */
        $('.button-next').click(function() {
            // If we are on the first step and there is not service selected do not continue
            // with the next step.
            if ($(this).attr('data-step_index') === '1' && $('#select-service').val() == null) {
                return;
            }

            // If we are on the first tab then the user should have a number of participants
            if ($(this).attr('data-step_index') === '1') {
               if ($('#nb_participants').val() == null || $('#nb_participants').val() == "") {
                return;
               }
            }

            // If we are on the first tab, then the user should have a selected language
            if ($(this).attr('data-step_index') === '1') {
                if ($('#language').val() == null || $('#language').val() == "") {
                    return;
                }
            }

            // If we are on the 2nd tab then the user should have an appointment hour
            // selected.
            if ($(this).attr('data-step_index') === '2') {
                if ($('.selected-hour').length == 0) {
                    if ($('#select-hour-prompt').length == 0) {
                        $('#available-hours').append('<br><br>'
                                + '<span id="select-hour-prompt" class="text-danger">'
                                + EALang['appointment_hour_missing']
                                + '</span>');
                    }
                    return;
                }
            }

            // If we are on the 3rd tab then we will need to validate the user's
            // input before proceeding to the next step.
            if ($(this).attr('data-step_index') === '3') {
                if (!FrontendBook.validateCustomerForm()) {
                    return; // Validation failed, do not continue.
                } else {
                    FrontendBook.updateConfirmFrame();
                }
            }

            // Display the next step tab (uses jquery animation effect).
            var nextTabIndex = parseInt($(this).attr('data-step_index')) + 1;

            $(this).parents().eq(1).hide('fade', function() {
                $('.active-step').removeClass('active-step');
                $('#step-' + nextTabIndex).addClass('active-step');
                $('#wizard-frame-' + nextTabIndex).show('fade');
            });
        });

        /**
         * Event: Back Step Button "Clicked"
         *
         * This handler is triggered every time the user pressed the
         * "back" button on the book wizard.
         */
        $('.button-back').click(function() {
            var prevTabIndex = parseInt($(this).attr('data-step_index')) - 1;

            $(this).parents().eq(1).hide('fade', function() {
                $('.active-step').removeClass('active-step');
                $('#step-' + prevTabIndex).addClass('active-step');
                $('#wizard-frame-' + prevTabIndex).show('fade');
            });
        });

        /**
         * Event: Available Hour "Click"
         *
         * Triggered whenever the user clicks on an available hour
         * for his appointment.
         */
        $('#available-hours').on('click', '.available-hour', function() {
            $('.selected-hour').removeClass('selected-hour');
            $(this).addClass('selected-hour');
            FrontendBook.updateConfirmFrame();
        });

        /**
         * Event: Book Appointment Form "Submit"
         *
         * Before the form is submitted to the server we need to make sure that
         * in the meantime the selected appointment date/time wasn't reserved by
         * another customer or event.
         */
        $('#book-appointment-submit').click(function(event) {
            FrontendBook.registerAppointment();
        });

    },

    /**
     * This function makes an ajax call and returns the available
     * dates for the selected service and month.
     * The result is pushed in FrontendBook.freeDates
     *
     * @param {int} year
     * @param {int} month
     */
    getAvailableDates: function(year, month) {
        // Find the selected service duration (it is going to
        // be send within the "postData" object).
        var selServiceDuration = 15; // Default value of duration (in minutes).
        $.each(GlobalVariables.availableServices, function(index, service) {
            if (service['id'] == $('#select-service').val()) {
                selServiceDuration = service['duration'];
            }
        });

        // Make ajax post request and get the available hours.
        var postUrl = GlobalVariables.baseUrl + '/index.php/booking/ajax_get_available_dates';

        var date="01-" + month + "-" + year;
        var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'service_id': $('#select-service').val(),
            'provider_id': 'any-provider',
            'date': date,
            'service_duration': selServiceDuration,
            'appointment_id': undefined,
        };

        $.post(postUrl, postData, function(response) {
            ///////////////////////////////////////////////////////////////
            console.log('Get Available Dates JSON Response:', response);
            ///////////////////////////////////////////////////////////////

            if (!GeneralFunctions.handleAjaxExceptions(response)) return;

            // The response contains the available dates for the selected service.
            FrontendBook.freeDates = response;
            $("#select-date").datepicker("refresh");

        }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
    },

    /**
     * This function makes an ajax call and returns the available
     * hours for the selected service and date.
     *
     * @param {string} selDate The selected date of which the available
     * hours we need to receive.
     */
    getAvailableHours: function(selDate) {
        $('#available-hours').empty();

        // Find the selected service duration (it is going to
        // be send within the "postData" object).
        var selServiceDuration = 15; // Default value of duration (in minutes).
        $.each(GlobalVariables.availableServices, function(index, service) {
            if (service['id'] == $('#select-service').val()) {
                selServiceDuration = service['duration'];
            }
        });

        // Make ajax post request and get the available hours.
        var postUrl = GlobalVariables.baseUrl + '/index.php/booking/ajax_get_available_hours';

        var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'service_id': $('#select-service').val(),
            'provider_id': 'any-provider',
            'selected_date': selDate,
            'service_duration': selServiceDuration,
            'appointment_id': undefined,
        };

        $.post(postUrl, postData, function(response) {
            ///////////////////////////////////////////////////////////////
            console.log('Get Available Hours JSON Response:', response);
            ///////////////////////////////////////////////////////////////

            if (!GeneralFunctions.handleAjaxExceptions(response)) return;

            // The response contains the available hours for the selected
            // service. Fill the available hours div with response data.
            if (response.length > 0) {
                var currColumn = 1;
                $('#available-hours').html('<div style="width:50px;"></div>');

                $.each(response, function(index, availableHour) {
                    $('#available-hours div:eq(' + (currColumn - 1) + ')').append(
                            '<span class="available-hour">' + availableHour + '</span><br/>');
                });

                // Set the available hour as stored if available. Set first otherwise.
                var select_hour = sessionStorage.getItem('select-hour');
                if (select_hour !== null) {
                    $('.available-hour:contains("' + select_hour + '"):first').addClass('selected-hour');
                } else {
                    $('.available-hour:eq(0)').addClass('selected-hour');
                }


                FrontendBook.updateConfirmFrame();

            } else {
                $('#available-hours').text(EALang['no_available_hours']);
            }
        }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
    },

    /**
     * This function validates the customer's data input. The user cannot contiue
     * without passing all the validation checks.
     *
     * @return {bool} Returns the validation result.
     */
    validateCustomerForm: function() {
        $('#wizard-frame-3 input').css('border', '');

        try {
            // Validate required fields.
            var missingRequiredField = false;
            $('.required').each(function() {
                if ($(this).val() == '') {
                    $(this).parents('.form-group').addClass('has-error');
                    missingRequiredField = true;
                }
            });
            if (missingRequiredField) {
                throw EALang['fields_are_required'];
            }

            // Validate email address.
            if (!GeneralFunctions.validateEmail($('#email').val())) {
                $('#email').parents('.form-group').addClass('has-error');
                throw EALang['invalid_email'];
            }

            return true;
        } catch(exc) {
            $('#form-message').text(exc);
            $('#form-message').addClass('text-danger');
            return false;
        }
    },

    /**
     * Every time this function is executed, it updates the confirmation
     * page with the latest customer settings and input for the appointment
     * booking.
     */
    updateConfirmFrame: function() {
        // Appointment Details
        var selectedDate = $('#select-date').datepicker('getDate');
        if (selectedDate !== null) {
            var selectedDate_js = new Date(selectedDate);
            selectedDate = GeneralFunctions.formatDate(selectedDate, GlobalVariables.dateFormat);
        }

        var selServiceId = $('#select-service').val();
        var servicePrice, serviceCurrency;
        $.each(GlobalVariables.availableServices, function(index, service) {
            if (service.id == selServiceId) {
                if (selectedDate_js.getDay() >= 5 || selectedDate_js.getDay() == 0) {
                    servicePrice = service.price_week_end;
                } else {
                    servicePrice = service.price_week;
                }
                serviceCurrency = service.currency;
                return false; // break loop
            }
        });

        var nb_participants = $('#nb_participants').val();

        var html =
            '<tr>'
                + '<td class="first">' + EALang['room'] + '</td>'
                + '<td class="first">' + $('#select-service option:selected').text() + '</td>'
            + '</tr><tr>'
                + '<td>' + EALang['date'] + '</td>'
                + '<td>' + selectedDate + ' ' +  $('.selected-hour').text() + '</td>'
            + '</tr><tr>'
                + '<td>' + EALang['price'] + '</td>'
                + '<td>' + servicePrice + ' ' + serviceCurrency + '</td>'
            + '</tr><tr>'
                + '<td>' + EALang['group_size'] + '</td>'
                + '<td>' + nb_participants + '</td>'
            + '</tr><tr>'
                + '<td>' + EALang['language'] + '</td>'
                + '<td>' + $('#language option:selected').text() + '</td>'
            + '</tr>';
        $('#appointment-details').html(html);

        // Customer Details
        var firstname = GeneralFunctions.escapeHtml($('#first-name').val()),
            lastname = GeneralFunctions.escapeHtml($('#last-name').val()),
            phoneNumber = GeneralFunctions.escapeHtml($('#phone-number').val()),
            email = GeneralFunctions.escapeHtml($('#email').val()),

        html =
            '<tr>'
                + '<td class="first">' + EALang['name'] + '</td>'
                + '<td class="first">' + firstname + ' ' + lastname + '</td>'
            + '</tr><tr>'
                + '<td>' + EALang['phone'] + '</td>'
                + '<td>' + phoneNumber + '</td>'
            + '</tr><tr>'
                + '<td>' + EALang['email'] + '</td>'
                + '<td>' + email + '</td>'
            + '</tr>';
        $('#customer-details').html(html);

        // Update appointment form data for submission to server when the user confirms
        // the appointment.
        var postData = new Object();

        postData['customer'] = {
            'last_name': $('#last-name').val(),
            'first_name': $('#first-name').val(),
            'email': $('#email').val(),
            'phone_number': $('#phone-number').val(),
        };

        postData['appointment'] = {
            'start_datetime': $('#select-date').datepicker('getDate').toString('yyyy-MM-dd')
                                    + ' ' + $('.selected-hour').text() + ':00',
            'end_datetime': FrontendBook.calcEndDatetime(),
            'notes': $('#notes').val(),
            'is_unavailable': false,
            'id_services': $('#select-service').val(),
            'nb_participants': $('#nb_participants').val(),
            'language': $('#language').val()
        };

        $('input[name="csrfToken"]').val(GlobalVariables.csrfToken);
        $('input[name="post_data"]').val(JSON.stringify(postData));
    },

    /**
     * This method calculates the end datetime of the current appointment.
     * End datetime is depending on the service and start datetime fieldss.
     *
     * @return {string} Returns the end datetime in string format.
     */
    calcEndDatetime: function() {
        // Find selected service duration.
        var selServiceDuration = undefined;

        $.each(GlobalVariables.availableServices, function(index, service) {
            if (service.id == $('#select-service').val()) {
                selServiceDuration = service.duration;
                return false; // Stop searching ...
            }
        });

        // Add the duration to the start datetime.
        var startDatetime = $('#select-date').datepicker('getDate').toString('dd-MM-yyyy')
                + ' ' + $('.selected-hour').text();
        startDatetime = Date.parseExact(startDatetime, 'dd-MM-yyyy HH:mm');
        var endDatetime = undefined;

        if (selServiceDuration !== undefined && startDatetime !== null) {
            endDatetime = startDatetime.add({ 'minutes' : parseInt(selServiceDuration) });
        } else {
            endDatetime = new Date();
        }

        return endDatetime.toString('yyyy-MM-dd HH:mm:ss');
    },

    /**
     * This method applies the appointment's data to the wizard so
     * that the user can start making changes on an existing record.
     *
     * @param {object} appointment Selected appointment's data.
     * @param {object} service Selected service's data.
     * @param {object} customer Selected customer's data.
     * @returns {bool} Returns the operation result.
     */
    applyAppointmentData: function(appointment, service, customer) {
        try {
            // Select Service
            $('#select-service').val(appointment['id_services']).trigger('change');

            // Set Appointment Date
            $('#select-date').datepicker('setDate',
                    Date.parseExact(appointment['start_datetime'], 'yyyy-MM-dd HH:mm:ss'));
            FrontendBook.getAvailableHours($('#select-date').val());

            // Apply Customer's Data
            $('#last-name').val(customer['last_name']);
            $('#first-name').val(customer['first_name']);
            $('#email').val(customer['email']);
            $('#phone-number').val(customer['phone_number']);
            var appointmentNotes = (appointment['notes'] !== null)
                    ? appointment['notes'] : '';
            $('#notes').val(appointmentNotes);

            FrontendBook.updateConfirmFrame();

            return true;
        } catch(exc) {
            console.log(exc); // log exception
            return false;
        }
    },

    /**
     * This method updates a div's html content with a brief description of the
     * user selected service (only if available in db). This is usefull for the
     * customers upon selecting the correct service.
     *
     * @param {int} serviceId The selected service record id.
     * @param {object} $div The destination div jquery object (e.g. provide $('#div-id')
     * object as value).
     */
    updateServiceDescription: function(serviceId, $div) {
        var html = '';

        $.each(GlobalVariables.availableServices, function(index, service) {
            if (service.id == serviceId) { // Just found the service.
                html = '<strong>' + service.name + ' </strong>';

                if (service.description != '' && service.description != null) {
                    html += '<br>' + service.description + '<br>';
                }

                if (service.duration != '' && service.duration != null) {
                    html += '[' + EALang['duration'] + ' ' + service.duration
                            + ' ' + EALang['minutes'] + '] ';
                }

                if (service.price_week != '' && service.price_week != null) {
                    html += '[' + EALang['price_week'] + ' ' + service.price_week + ' ' + service.currency  + ']';
                }

                if (service.price_week_end != '' && service.price_week_end != null) {
                    html += '[' + EALang['price_week_end'] + ' ' + service.price_week_end + ' ' + service.currency  + ']';
                }

                html += '<br>';

                return false;
            }
        });

        $div.html(html);

        if (html != '') {
            $div.show();
        } else {
            $div.hide();
        }
    },

    /**
     * Register an appointment to the database.
     *
     * This method will make an ajax call to the appointments controller that will register
     * the appointment to the database.
     */
    registerAppointment: function() {
        var formData = jQuery.parseJSON($('input[name="post_data"]').val());

        var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'post_data': formData
        };

        var postUrl = GlobalVariables.baseUrl + '/index.php/booking/ajax_register_appointment',
            $layer = $('<div/>');

        $.ajax({
            url: postUrl,
            method: 'post',
            data: postData,
            dataType: 'json',
            beforeSend: function(jqxhr, settings) {
                $layer
                    .appendTo('body')
                    .css({
                        'background': 'white',
                        'position': 'fixed',
                        'top': '0',
                        'left': '0',
                        'height': '100vh',
                        'width': '100vw',
                        'opacity': '0.5'
                    });
            }
        })
            .done(function(response) {
                window.location.replace(GlobalVariables.baseUrl
                    + '/index.php/booking/payment/' + response.appointment_id);
            })
            .fail(function(jqxhr, textStatus, errorThrown) {
                GeneralFunctions.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
            })
            .always(function() {
                $layer.remove();
            })
    },

    /**
     * Save the form to sessionStorage.
     *
     * This method saves the values of the filled-in fields to sessionStorage. It can be bound
     * to onbeforeunload event to keep these values when refreshing the page.
     */
    saveFormToSession: function() {
        sessionStorage.setItem('select-service', $('#select-service').val());
        sessionStorage.setItem('nb_participants', $('#nb_participants').val());
        sessionStorage.setItem('language', $('#language').val());
        sessionStorage.setItem('select-date', $('#select-date').val());
        sessionStorage.setItem('select-hour', $('.selected-hour').text());
        sessionStorage.setItem('first-name', $('#first-name').val());
        sessionStorage.setItem('last-name', $('#last-name').val());
        sessionStorage.setItem('email', $('#email').val());
        sessionStorage.setItem('phone-number', $('#phone-number').val());
        sessionStorage.setItem('notes', $('#notes').val());
    },

    /**
     * Restore the form from sessionStorage.
     *
     * This method loads the values of sessionStorage and write them in the form. It can be
     * bound th onload event to reload the values after refreshing the page.
     */
    loadFormFromSession: function() {
        var select_service = sessionStorage.getItem('select-service');
        if (select_service !== null) $('#select-service').val(select_service);

        var nb_participants = sessionStorage.getItem('nb_participants');
        if (nb_participants !== null) $('#nb_participants').val(nb_participants);

        var language = sessionStorage.getItem('language');
        if (language !== null) $('#language').val(language);

        var select_date = sessionStorage.getItem('select-date');
        if (select_date !== null) {
            $('#select-date').datepicker('setDate', select_date);
            $('#select-service').trigger('change');
        }

        var first_name = sessionStorage.getItem('first-name');
        if (first_name !== null) $('#first-name').val(first_name);

        var last_name = sessionStorage.getItem('last-name');
        if (last_name !== null) $('#last-name').val(last_name);

        var email = sessionStorage.getItem('email');
        if (email !== null) $('#email').val(email);

        var phone_number = sessionStorage.getItem('phone-number');
        if (phone_number !== null) $('#phone-number').val(phone_number);

        var notes = sessionStorage.getItem('notes');
        if (notes !== null) $('#notes').val(notes);

        FrontendBook.updateConfirmFrame();
    }
};
