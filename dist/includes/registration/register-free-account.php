<?php
namespace Worldpay;
?>
<?php
// move to ecxternal file 
$servername="localhost" ; 
$username="USER" ; 
$password="PASS" ; 
$dbname="DBNAME" ; 

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
			$user_email = $_POST['email'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$sql_insert_profile = "INSERT INTO owner_profile (owner_profile_first_name, owner_profile_last_name, owner_status)
VALUES ('$first_name', '$last_name', 'OK')";
			if ($conn->query($sql_insert_profile) === TRUE) {
				$owner_profile_id = mysqli_insert_id($conn);
				$owner_login_username = $_POST['username'];
				$owner_login_email = $_POST['email'];
				$owner_login_password = $_POST['p'];
				
				 $owner_login_password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
					if (strlen($owner_login_password) != 128) {
						// The hashed pwd should be 128 characters long.
						// If it's not, something really odd has happened
						$error_msg .= '<p class="error">Invalid password configuration.</p>';
				 }

				 $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
				 // Create salted password 
				 $owner_login_password = hash('sha512', $owner_login_password . $random_salt);
				
				
				$sql_insert_profile = "INSERT INTO owner_login (owner_id, owner_login_username, owner_login_email, owner_login_password, owner_login_hash, owner_login_authorised)
	VALUES ('$owner_profile_id', '$owner_login_username', '$owner_login_email', '$owner_login_password', '$random_salt', 'YES')";
				if ($conn->query($sql_insert_profile) === TRUE) {
					//echo "New record created successfully";
					} else {
					//	echo "Error: " . $sql_insert_profile . "<br>" . $conn->error;
					}
				} else {
					//echo "Error: " . $sql_insert_profile . "<br>" . $conn->error;
				}
					$package_id = $_POST['package_id'];
					$start_date  = date("Y-m-d");
					$end_date = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day"));
					// insert into contact subscription
					$sql_create_subscription = "INSERT INTO owner_subscription (owner_id, package_id, owner_subscription_start_at, owner_subscription_expires_at)
					VALUES ('$owner_profile_id', '$package_id', '$start_date', '$end_date')";
					if ($conn->query($sql_create_subscription) === TRUE) {
						$subscription_id = mysqli_insert_id($conn);
						$date_paid = date("Y-m-d");
						$billingName = $_POST['name'];
						$address1 = $_POST['billing_add_1'];
						$address2 = $_POST['billing_add_2'];
						$postalCode = $_POST['postcode'];
						$town = $_POST['billing_town'];
						$county = $_POST['billing_county'];
						$countyCode = $_POST['countyCode'];

						$sql_insert_payment = "INSERT INTO owner_payments (subscription_id, order_code, token, amount, date_paid, billing_name, billing_add_1, billing_add_2, billing_town, billing_county, billing_postcode, billing_country_code)
						VALUES ('$subscription_id', '$worldpayOrderCode', '$worldpaytoken', '$amount', '$date_paid', '$billingName', '$address1', '$address2', '$town', '$county', '$postalCode', '$countyCode')";
						if ($conn->query($sql_insert_payment) === TRUE) {
							$responseStatus = $response['paymentStatus'];
									
$to = 'admin@zealonite.co.uk';
$subject = "OpenRation Account Setup Verification";

$message = '
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payment Confirmation - COMPANY NAME</title>
    <style type="text/css">
/* What it does: Remove spaces around the email design added by some email clients. */
      /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
html,  body {
	margin: 0 !important;
	padding: 0 !important;
	height: 100% !important;
	width: 100% !important;
}
/* What it does: Stops email clients resizing small text. */
* {
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%;
}
/* What it does: Forces Outlook.com to display emails full width. */
.ExternalClass {
	width: 100%;
}
/* What is does: Centers email on Android 4.4 */
div[style*="margin: 16px 0"] {
	margin: 0 !important;
}
/* What it does: Stops Outlook from adding extra spacing to tables. */
table,  td {
	mso-table-lspace: 0pt !important;
	mso-table-rspace: 0pt !important;
}
/* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
table {
	border-spacing: 0 !important;
	border-collapse: collapse !important;
	table-layout: fixed !important;
	margin: 0 auto !important;
}
table table table {
	table-layout: auto;
}
/* What it does: Uses a better rendering method when resizing images in IE. */
img {
	-ms-interpolation-mode: bicubic;
}

.yshortcuts a {
	border-bottom: none !important;
}
/* What it does: Another work-around for iOS meddling in triggered links. */
a[x-apple-data-detectors] {
	color: inherit !important;
}
</style>

    <!-- Progressive Enhancements -->
    <style type="text/css">
        
        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
            }

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid,
            .fluid-centered {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            /* And center justify these ones. */
            .fluid-centered {
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }
        
            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
                
        }

    </style>
    </head>
    <body bgcolor="#e0e0e0" width="100%" style="margin: 0;" yahoo="yahoo">
    <table bgcolor="#e0e0e0" cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" style="border-collapse:collapse;">
      <tr>
        <td><center style="width: 100%;">
            
            <!-- Visually Hidden Preheader Text : BEGIN -->
            <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;"> Welcome to the luxury student members club, your payment has been successful.</div>
            <!-- Visually Hidden Preheader Text : END --> 
            
            <!-- Email Header : BEGIN -->
            <table align="center" width="600" class="email-container">
            <tr>
                <td style="padding: 20px 0; text-align: center"><img src="https://www.luxurystudent.com/membership/account/assets/img/tls-logo.png" width="200" height="200" alt="alt_text" border="0"></td>
              </tr>
          </table>
            <!-- Email Header : END --> 
            
            <!-- Email Body : BEGIN -->
            <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" class="email-container">
            
            <!-- Hero Image, Flush : BEGIN -->
            <tr>
                <td class="full-width-image" background="https://www.luxurystudent.com/membership/account/assets/img/gold-marble.jpg" bgcolor="#222222" valign="middle" style="text-align: center; background-position: center center !important; background-size: cover !important; height:150px;"></td>
              </tr>
            <!-- Hero Image, Flush : END --> 
            
            <!-- 1 Column Text : BEGIN -->
            <tr>
                <td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                <span style="font-size: 22px; font-weight: bold; text-align: center; padding:10px;">Welcome to the Club</span><br>
                Welcome to the luxury student members club, your payment has been successful and will be debited from your account accordingly. Please login to your account to activate, see you member benefits and manage your subscription.<br>
                <br>
                
                <!-- Button : Begin -->
                
                <table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                    <tr>
                    <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td"><a href="https://www.luxurystudent.com/membership/login.php" style="background: #222222; border: 15px solid #222222; padding: 0 10px;color: #ffffff; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"> 
                      <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->Login to your Account<!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]--> 
                      </a></td>
                  </tr>
                  </table>
                
                <!-- Button : END --></td>
              </tr>
           
            <tr>
                <td align="center" valign="top" style="padding: 10px;"><table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                    <td class="stack-column-center"><table cellspacing="0" cellpadding="0" border="0">
                        <tr>
                        <td style="padding: 10px; text-align: center"><img src="http://www.luxurystudent.com/img/blog/winter-sun.jpg" width="270" height="270" alt="alt_text" border="0" class="fluid"></td>
                      </tr>
                        <tr>
                        <td style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; padding: 0 10px 10px; text-align: left;" class="center-on-narrow"><strong>Winter Sun</strong><br> Spend your points at Caffè Nero and treat yourself to a delicious hot or iced drink. </td>
                      </tr>
                      </table></td>
                    <td class="stack-column-center"><table cellspacing="0" cellpadding="0" border="0">
                        <tr>
                        <td style="padding: 10px; text-align: center"><img src="http://www.luxurystudent.com/img/blog/bethnal-green.jpg" width="270" height="270" alt="alt_text" border="0" class="fluid"></td>
                      </tr>
                        <tr>
                        <td style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; padding: 0 10px 10px; text-align: left;" class="center-on-narrow"><strong>Motivational Mentors!</strong> The older I become, the more I appreciate the extra support and guidance I receive from my mentors. I have a few. </td>
                      </tr>
                      </table></td>
                  </tr>
                  </table></td>
              </tr>
            <!-- Two Even Columns : END --> 
            
            <!-- Three Even Columns : BEGIN -->
            
            <!-- Three Even Columns : END --> 
            
           
            <!-- Thumbnail Left, Text Right : END --> 
            
            <!-- Thumbnail Right, Text Left : BEGIN -->            <!-- Thumbnail Right, Text Left : END -->
            
          </table>
            <!-- Email Body : END --> 
            
            <!-- Email Footer : BEGIN -->
            <table align="center" width="600" class="email-container">
            <tr>
                <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #222;"><webversion style="color:#222222; font-weight: bold;">This email was sent to <a style="color:#222222; text-decoration:underline">'.$to.'</a><br>
											  <br>
<br>
<unsubscribe>
If you do not wish to receive information from The Luxury Student by email (including special points offers) you can <a href="https://www.luxurystudent.com/img/email/unsubscribe.php?email_address=" target="_blank" style="color:#222; text-decoration: underline;">unsubscribe here</a> or log into your account to manage your prefrences.<br>
</unsubscribe>
<br>
We believe that this email is virus free but we cannot guarantee this. You should therefore check for viruses and similar harmful devices as we cannot accept liability for any which may occur. This email is a commercial communication from The Luxury Student Limited, registered in England under company number 10222232, registered office at Suite 3, The, Byre, Lower Hook Farm, Hook, Royal Wootton Bassett, SN4 8EF.<br>
<br>
Copyright © 2017 The Luxury Student Ltd. All rights reserved.
                </td>
              </tr>
          </table>
            <!-- Email Footer : END -->
            
          </center></td>
      </tr>
    </table>
</body>
</html>


';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <no-reply@EMAIL_ADDRESS.co.uk>' . "\r\n";
$headers .= 'Cc: admin@zealonite.co.uk' . "\r\n";

mail($to,$subject,$message,$headers);
$_SESSION['email_sent'] = 'yes';	

									
		//	redirect("https://www.luxurystudent.com/membership/payment-responce.php?responce=$responseStatus&order-code=$worldpayOrderCode");						
									
									
								$payment_responce = $response['paymentStatus'];	
								$data_responce = 'SUCCESS';
								
									
								} else {
									$payment_responce = $response['paymentStatus'];	
									$data_responce = 'FAIL';
								
									echo "Error: " . $sql_insert_payment . "<br>" . $con->error;
								}
							
						
					}else {
									$payment_responce = $response['paymentStatus'];	
									$data_responce = 'FAIL';
									
									echo "Error: " . $sql_create_subscription . "<br>" . $con->error;
								}
				
            echo json_encode(array('payment_responce' => $payment_responce, 'database_responce' => $data_responce));
?>