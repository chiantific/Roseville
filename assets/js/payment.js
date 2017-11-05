var $form = $('#payment-form');
$form.find('.subscribe').on('click', pay);

function pay(e) {
    e.preventDefault();

    if (!validator.form()) {
        return;
    }

    $form.find('.subscribe').html('Validating <i class="fa fa-spinner fa-pulse"></i>').prop('disabled', 'true');

    var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
    var ccData = {
        csrfToken: GlobalVariables.csrfToken,
        number: $form.find('[name=cardNumber]').val().replace(/\ø=s/g,''),
        cvc: $form.find('[name=cardCVC]').val(),
        exp_month: expiry.month,
        exp_year: expiry.year
    };

    // Post data
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    var appointmentId = GlobalVariables.appointmentData['id'];
    form.setAttribute("action", "/booking/index.php/appointments/payment_process/"+appointmentId);

    for(var key in ccData) {
        if(ccData.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", ccData[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

$('input[name=cardNumber]').payment('formatCardNumber');
$('input[name=cardCVC]').payment('formatCardCVC');
$('input[name=cardExpiry').payment('formatCardExpiry');

jQuery.validator.addMethod("cardNumber", function(value, element) {
    return this.optional(element) || valid_credit_card(value);
}, "Please specify a valid credit card number.");

jQuery.validator.addMethod("cardExpiry", function(value, element) {
    value = $.payment.cardExpiryVal(value);
    return this.optional(element) || valid_expiry_date(value);
}, "Invalid expiration date.");

jQuery.validator.addMethod("cardCVC", function(value, element) {
    return this.optional(element) || valid_cvc(value);
}, "Invalid CVC.");

validator = $form.validate({
    rules: {
        cardNumber: {
            required: true,
            cardNumber: true
        },
        cardExpiry: {
            required: true,
            cardExpiry: true
        },
        cardCVC: {
            required: true,
            cardCVC: true
        }
    },
    highlight: function(element) {
        $(element).closest('.form-control').removeClass('success').addClass('error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-control').removeClass('error').addClass('success');
    },
    errorPlacement: function(error, element) {
        $(element).closest('.form-group').append(error);
    }
});

paymentFormReady = function() {
    if ($form.find('[name=cardNumber]').hasClass("success") &&
        $form.find('[name=cardExpiry]').hasClass("success") &&
        $form.find('[name=cardCVC]').val().length > 1) {
            return true;
        } else {
            return false;
        }
}

$form.find('.subscribe').prop('disabled', true);
var readyInterval = setInterval(function() {
    if (paymentFormReady()) {
        $form.find('.subscribe').prop('disabled', false);
        clearInterval(readyInterval);
    }
}, 250);

function valid_credit_card(value) {
	if (/[^0-9-\s]+/.test(value)) return false;

	// The Luhn Algorithm. It's so pretty.
	var nCheck = 0, nDigit = 0, bEven = false;
	value = value.replace(/\D/g, "");

	for (var n = value.length - 1; n >= 0; n--) {
		var cDigit = value.charAt(n),
			  nDigit = parseInt(cDigit, 10);

		if (bEven) {
			if ((nDigit *= 2) > 9) nDigit -= 9;
		}

		nCheck += nDigit;
		bEven = !bEven;
	}

	return (nCheck % 10) == 0;
}

function valid_expiry_date(value) {
    var today, someday;
    today = new Date();
    someday = new Date();
    someday.setFullYear(value.year, value.month, 1);

    if (someday < today) {
        return false;
    } else {
        return true;
    }
}

function valid_cvc(value) {
    return value.length > 1;
}
