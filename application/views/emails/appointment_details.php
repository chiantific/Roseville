<html>
<head>
    <title>Appointment Details</title>
<!--[if gte mso 9]>
<style type="text/css">
img#logo { width: 60px; }
img#facebook { width: 30px; }
</style>
<![endif]-->
</head>
<body style="font: 13px arial, helvetica, tahoma;">
    <div class="email-container" style="width: 650px; border: 1px solid #eee;">
        <div id="header" style="background-color: #15595F; border-bottom: 4px solid #115595F;
                height: 55px; padding: 10px 20px;">
            <strong id="logo" style="color: white; font-size: 20px;
                    text-shadow: 1px 1px 1px #8F8888; margin-top: 10px; margin-left: 10px;display: inline-block; float: left;">
                    $company_name</strong>
        </div>

        <div id="content" style="padding: 10px 15px;">
            <h2>$email_message_title</h2>
            <p>$email_message_1</p>

            <h2>Appointment Details</h2>
            <table id="appointment-details">
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold; width: 150px;">Service</td>
                    <td style="padding: 3px;">$appointment_service</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Provider</td>
                    <td style="padding: 3px;">$appointment_provider</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Date</td>
                    <td style="padding: 3px;">$appointment_date</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Hour</td>
                    <td style="padding: 3px;">$appointment_hour</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Language</td>
                    <td style="padding: 3px;">$appointment_language</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px; font-weight: bold;">Amount</td>
                    <td style="padding: 3px;">$paid_amount</td>
                </tr>
            </table>
            <p>$email_message_2</p>

            <h2>Customer Details</h2>
            <table id="customer-details">
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold; width: 150px;">Name</td>
                    <td style="padding: 3px;">$customer_name</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Email</td>
                    <td style="padding: 3px;">$customer_email</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Phone</td>
                    <td style="padding: 3px;">$customer_phone</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Notes</td>
                    <td style="padding: 3px;">$appointment_notes</td>
                </tr>
            </table>
            <p>$email_message_3</p>

            <div style="width: 60px; display: inline-block; float: left;">
                <a href="$company_link">
                    <img id="logo" alt="logo" src="$company_link/img/logo_escape.png" style="height: 60px; max-width: 100%;" height="60"/>
                </a>
            </div>
            <p style="padding: 3px; display: inline-block; float: left;">$address</p>
            <p style="padding: 3px; clear: both;">$phone_numbers</p>
            <div style="width: 30px;">
                <a href="$fb_link">
                    <img id="facebook" alt="Facebook logo" src="https://images.seeklogo.net/2016/09/facebook-icon-preview-1.png" style="height: 30px; max-width: 100%;" height="30"/>
                </a>
            </div>
        </div>

        <div id="content" style="padding: 10px 15px;">
            <p>Footer</p>
        </div>

        <div id="footer" style="padding: 10px; text-align: center; margin-top: 10px;
                border-top: 1px solid #EEE; background: #FAFAFA;">
            <a href="$company_link" style="text-decoration: none;">$company_name</a>
        </div>
    </div>
</body>
</html>
