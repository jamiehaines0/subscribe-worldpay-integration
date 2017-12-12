<?php ob_start( "ob_gzhandler");?>
<?php $company_name='Company Name' ; 
	$errors='' ; 
	$name='' ; 
	$telephone='' ; 
$email='' ; 
$subject='' ; 
$contact='' ; 
$enquiry='' ; 

if ( isset( $_POST[ 'submit' ] ) ) { 
	$firstName= $_POST[ 'firstName' ]; 
	$lastName= $_POST[ 'lastName' ]; 
	$email= $_POST[ 'email' ]; 
	$package= $_POST[ 'package' ]; 
	// $enquiry=$ _POST[ 'message']; // 
	$phone= $_POST[ 'phone']; 
	//echo $name . $telephone . $email . $company . $subject . $budget . $enquiry;
	///------------Do Validations------------- 
	if ( empty( $firstName ) || empty( $email ) || empty( $lastName ) ) { 
		$errors .="\n Please make sure that all fields marked with an * are completed. " ; } 
	if ( IsInjected( $email ) ) { 
		$errors .="\n Bad email value!" ; } 
	if ( empty( $errors ) ) { 
		$emailSuccess=1 ; 
		$email_address = $_POST[ 'email ' ];
		$name = $_POST[ 'firstName ' ] . ' ' . $_POST[ 'lastName ' ];
		$subject = "Register Interest - ".$company_name;

		$headers = "From: " . $from . "\r\n";
		$headers .= "Reply-To: " . $from . "\r\n";
		$headers .= "BCC: admin@zealonite.co.uk\r\n";

		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message = '<html>

<body>'; $message .= '
    <h1>Register Interest</h1>'; $message .= '
    <p>Hi Sharon</p>'; $message .= '
    <p>This contact has registered their interest in '.$company_name.' through your website.</p>'; $message .= '
    <table rules="all" style="border-color: #666;" cellpadding="10" width="600">'; $message .= "
        <tr style='background: #eee;'>
            <td><strong>Name:</strong> </td>
            <td>" . strip_tags( $name ) . "</td>
        </tr>"; $message .= "
        <tr>
            <td><strong>Email:</strong> </td>
            <td>" . strip_tags( $email ) . "</td>
        </tr>"; $message .= "
        <tr>
            <td><strong>Package:</strong> </td>
            <td>" . strip_tags( $package ) . "</td>
        </tr>"; $message .= "</table>"; $message .= '
    <p>This email was sent using an automated email sending system by Zealonite. Should you think that this is being abused by spam then please contact us.</p>'; $message .= '
    <p>All the best</p>'; $message .= '
    <p>Zealonite</p>'; $message .= "</body>

</html>"; mail( $to, $subject, $message, $headers ); } else { header( 'Location: index.php?error=' . $errors ); } } 
// Function to validate against any email injection attempts 
function IsInjected( $str ) { 
	$injections = array( '(\n+)', '(\r+)', '(\t+)', '(%0A+)', '(%0D+)', '(%08+)', '(%09+)' ); 
	$inject = join( '|', $injections ); $inject = "/$inject/i"; if ( preg_match( $inject, $str ) ) { return true; } else { return false; } 
} ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Your Interest | <?php echo $company_name;?>
    </title>
    <meta name="description" content="">
    <?php include( 'dist/includes/page/global_vars.php');?>
    <script src="dist/js/card.js"></script>
    <script src="dist/js/sha512.js"></script>
    <script src="dist/js/forms.js"></script>
</head>
<body class="one-page">
    <?php include( 'dist/includes/page/navigation.php');?>
    <div class="slide bg-image" data-nav="remove" style="background-image: url('#');background-size: 43%;background-color: #f7f7f7;background-position: right bottom;">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-green text-light-shadow">Subscribe to <?php $company_name;?></h1>
                    <p class="caption text-light-shadow" style="margin-bottom: 0;">
                        <!-- Enter company header descrtiption -->
                    </p>
                </div>
            </div>
        </div>
        <a class="btn btn-large btn-floating btn-light-green btn-next btn-next-center btn-ripple" data-anchor="slide2" data-nav-link=""><i class="ion-chevron-down"></i></a>
    </div>
    </div>
    <div class="slide" data-nav="slide5">
        <div class="container">
            <div class="tsf-wizard tsf-wizard-1 left" data-step-effect="default-effect" data-step-index="0">
                <!-- BEGIN NAV STEP-->
                <div class="tsf-nav-step tsf-left-nav-step">
                    <!-- BEGIN STEP INDICATOR-->
                    <ul class="gsi-step-indicator triangle gsi-style-2 gsi-vertical">
                        <li class="current" data-target="step-1">
                            <a href="#0" data-mce-href="#0"> <span class="number">1</span> <span class="desc"> <label>Account setup</label> <span class="">Account details</span> </span>
                            </a>
                        </li>
                        <li data-target="step-2" class="">
                            <a href="#0" data-mce-href="#0"> <span class="number">2</span> <span class="desc"> <label>Package</label> <span class="">Choose a package</span> </span>
                            </a>
                        </li>
                        <li data-target="step-3" class=""><a href="#0"><span class="number">3</span><span class="desc"><label>User Profile</label><span class="">Basic user information</span></span></a>
                        </li>
                        <li data-target="step-4" class=""><a href="#0"><span class="number">4</span><span class="desc"><label>Payment</label><span class="">Payment &amp; Billing</span></span></a>
                        </li>
                        <li data-target="step-5" class=""><a href="#0"><span class="number">5</span><span class="desc"><label>Review</label><span class="">Review &amp; Submit</span></span></a>
                        </li>
                    </ul>
                    <!-- END STEP INDICATOR--->
                </div>
                <!-- END NAV STEP-->
                <!-- BEGIN STEP CONTAINER -->
                <div class="tsf-container tsf-right-container">
                    <!-- BEGIN CONTENT-->
                    <form enctype="multipart/form-data" method="post" class="tsf-content" id="reg_form" name="reg_form" style="height: auto; overflow-y: visible !important;" onsubmit="return Worldpay.checkTemplateForm(this)">
                        <!--<form class="tsf-form">-->
                        <!-- BEGIN STEP 1-->
                        <div class="tsf-step step-1 active">
                            <div class="tsf-step-content email-editor-elements-sortable ui-sortable">
                                <div class="bal-elements-list-item ui-draggable ui-draggable-handle active">

                                </div>
                                <div class="bal-elements-list-item ui-draggable ui-draggable-handle active">

                                </div>
                                <div class="element-content">
                                    <div class="form-group">
                                        <h1 style="font-weight: normal;" class="">Account Setup</h1>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Username</label>
                                        <div class="col-xs-10">
                                            <input id="username" class="form-control" type="text" data-type="input" name="username" required="required" onBlur="checkUserAvailability()">
                                            <span id="user-availability-status" style="display: block; float: right; width: 100%; text-align: right; height: 25px; font-weight: bold;"></span>
                                            <span class="help-block" data-type="help">This will be your username used to login to your account.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-content">
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Email Address</label>
                                        <div class="col-xs-10">
                                            <input id="email" class="form-control required" type="text" data-type="input" placeholder="" required="required" name="email" onBlur="checkEmailAvailability()">
                                            <span id="email-availability-status" style="display: block; float: right; width: 100%; text-align: right; height: 25px; font-weight: bold;"></span> <span class="help-block" data-type="help">You will occasionally receive account related emails. We promise not to share your email with anyone.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-content">
                                    
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Password</label>
                                        <div id="results" style="display: none;" class="default">Breakdown of points</div>
                                        <div id="details" style="display: none;"></div>
                                        <div class="col-xs-10">
                                            <input id="inputPassword" class="form-control" type="password" data-type="input" required="required" name="password">
                                            <div id="complexity" class="default" style="margin-top:10px; margin-bottom: 20px; display: block; float: right; width: 100%; text-align: right; height: 25px; font-weight: bold;"></div>
                                            <span class="help-block" data-type="help">Use at least one lowercase letter, one numeral, and seven characters.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <div class="form-group">
                                        <div style="width:100%;background-color:#E7E7E7;height:1px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END STEP 1-->
                        <!-- BEGIN STEP 2-->
                        <div class="tsf-step step-2">
                            <!-- BEGIN STEP CONTENT-->
                            <div class="tsf-step-content email-editor-elements-sortable ui-sortable">
                                <div class="bal-elements-list-item ui-draggable ui-draggable-handle">

                                </div>
                                <div class="element-content">
                                    <div class="form-group">
                                        <h1 style="font-weight: normal;">Select a Package</h1>
                                    </div>
                                </div>
                                <?php 
								$sql_packages="SELECT * FROM packages WHERE package_status = 'OK'"; 
								$result_packages=mysqli_query($conn, $sql_packages); ?>
                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Select a package</label>
                                        <div class="col-xs-10">
                                            <select id="package" class="form-control" name="package" required data-type="input" onchange="getPackageInfo(this);">
                                                <option> </option>
												
												<!-- remove -->
												<option value="example_package_option">example package option</option>
												<input id="price" value="0.00" type="hidden">
												<!-- end remove -->
												
                                                <?php if ( mysqli_num_rows( $result_packages )> 0 ) { 
												// output data of each row
												while ( $rowPackages = mysqli_fetch_assoc( $result_packages ) ) { 
												echo "<option value='" . $rowPackages[ ' package_id ' ] . "'>" . $rowPackages[ 'package_name' ] . "</option>"; } } else { } ?>
                                            </select>
                                            <span class="help-block" data-type="help">Select a package from the dropdown above. For a full feature list view packages and features on the site.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <div class="form-group">
                                        <div id="package_info"></div>
                                        <div class="element-content" style="padding:25px 10px;">
                                            <hr>
                                            <h1 style="font-weight: normal; font-size: 18px;" class="">Not sure which package to choose?</h1>If you need more information on which package to choose then <a href="#" data-toggle="modal" data-target="#packages">view our plans and pricing</a> section.</div>
                                    </div>
                                </div>

                            </div>
                            <!-- END STEP CONTENT-->
                        </div>
                        <!-- END STEP 2-->
                        <!--</form>-->
                        <div class="tsf-step step-3 slide-right-left-effect">
                            <div class="tsf-step-content email-editor-elements-sortable ui-sortable">
                                <div class="element-content">
                                    <div class="form-group">
                                        <h1 style="font-weight: normal;" class="">User Profile</h1>
                                    </div>
                                </div>
                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">First Name</label>
                                        <div class="col-xs-10">
                                            <input id="first_name" class="form-control" type="text" name="first_name" data-type="input" required="required">
                                            <span class="help-block" data-type="help"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row requried">
                                        <label class="col-xs-2 col-form-label" data-type="label">Last Name</label>
                                        <div class="col-xs-10">
                                            <input id="last_name" class="form-control" type="text" name="last_name" data-type="input">
                                            <span class="help-block" data-type="help"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Contact Number</label>
                                        <div class="col-xs-10">
                                            <input id="telephone" required="required" class="form-control" type="text" name="telephone" data-type="input">
                                            <span class="help-block" data-type="help"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-content" style="display: none;">
                                    <!-- Text -->
                                    <div class="form-group row">
                                        <label class="col-xs-2 col-form-label" data-type="label">Profile Image </label>
                                        <div class="col-xs-10">
                                            <input class="form-control" type="file" name="file" multiple data-type="input" accept=".gif, .jpg, .png">
                                            <span class="help-block" data-type="help"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tsf-step step-4">
                            <div class="tsf-step-content email-editor-elements-sortable ui-sortable">
                                <div class="bal-elements-list-item ui-draggable ui-draggable-handle">

                                </div>
                                <div class="element-content">
                                    <div class="form-group">
                                        <h1 style="font-weight: normal;" class="element-contenteditable active">Payment &amp; Billing</h1>
                                    </div>
                                </div>

                                <div class="element-content" style="padding:25px 10px;">
                                    To Process Payment for your subscription, please provide all billing information below. Please note if you are on a free plan you will not be charged for you subscription.
                                </div>

                                <div class="element-content">
                                    <div class="form-group">
                                        <h1 style="font-weight: normal;" class="">
											<p><span style="font-size: 18pt;" data-mce-style="font-size: 18pt;">Billing Address</span>
											</p>
										</h1>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <div class="form-group">
                                        <div style="width:100%;background-color:#E7E7E7;height:1px;"></div>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Address Line 1</label>
                                        <div class="col-xs-10">
                                            <input id="billing_add_1" required="required" class="form-control" name="billing_add_1" type="text" data-type="input">
                                        </div>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row">
                                        <label class="col-xs-2 col-form-label" data-type="label">Address Line 2</label>
                                        <div class="col-xs-10">
                                            <input id="billing_add_2" class="form-control" name="billing_add_2" type="text" data-type="input">
                                        </div>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Town</label>
                                        <div class="col-xs-10">
                                            <input id="billing_town" required="required" class="form-control" type="text" name="billing_town" data-type="input">
                                        </div>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row">
                                        <label class="col-xs-2 col-form-label" data-type="label">County</label>
                                        <div class="col-xs-10">
                                            <input id="billing_county" class="form-control" name="billing_county" type="text" data-type="input">
                                        </div>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Postcode</label>
                                        <div class="col-xs-10">
                                            <input id="postcode" required="required" class="form-control" type="text" name="postcode" data-type="input">
                                        </div>
                                    </div>
                                </div>

                                <div class="element-content">
                                    <!-- Text -->
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Country Code</label>
                                        <div class="col-xs-10">
                                            <select id="countryCode" required class="form-control" name="countryCode" style="">
                                                <option selected="" value="">Please select country</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="BN">Brunei Darussalam</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="CI">Côte d'Ivoire</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="TP">East Timor</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="TF">French Southern Territories</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GU">Guam</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                <option value="VA">Holy See (Vatican City State)</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgystan</option>
                                                <option value="LA">Lao</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libyan Arab Jamahiriya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macau</option>
                                                <option value="MK">Macedonia (FYR)</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia</option>
                                                <option value="MD">Moldova</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="AN">Netherlands Antilles</option>
                                                <option value="NT">Neutral Zone</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="KP">North Korea</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PW">Palau</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PN">Pitcairn</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="QA">Qatar</option>
                                                <option value="RE">Reunion</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russian Federation</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="SH">Saint Helena</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">Sao Tome and Principe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SK">Slovakia </option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="GS">South Georgia</option>
                                                <option value="KR">South Korea</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syria</option>
                                                <option value="TW">Taiwan</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="UM">United States Minor Outlying Islands</option>
                                                <option value="US">United States of America</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Viet Nam</option>
                                                <option value="VG">Virgin Islands (British)</option>
                                                <option value="VI">Virgin Islands (U.S.)</option>
                                                <option value="WF">Wallis and Futuna Islands</option>
                                                <option value="EH">Western Sahara</option>
                                                <option value="YE">Yemen</option>
                                                <option value="YU">Yugoslavia</option>
                                                <option value="ZR">Zaire</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-content">
                                    <div class="form-group">
                                        <div style="width:100%;background-color:#E7E7E7;height:1px;"></div>
                                    </div>
                                </div>
                                <div class="element-content">
                                    <div class="form-group">
                                        <h1 style="font-weight: normal;" class=""><span style="font-size: 18pt;" data-mce-style="font-size: 18pt;">Billing Card Details</span></h1>
                                    </div>
                                </div>
                                <div class="element-content">
                                    <div class="form-group row required">
                                        <label class="col-xs-2 col-form-label" data-type="label">Billing Name </label>
                                        <div class="col-xs-10">
                                            <input id="billing_name" class="form-control" name="name" type="text" data-type="input" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="background: #f0f2f5; padding-top: 15px;">
                                        <div class="col-xs-6">
                                            <script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
                                            <script type='text/javascript'>
                                            </script>
                                            <div id='paymentSection'></div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="card-wrapper"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tsf-step step-5">
                            <div class="tsf-step-content email-editor-elements-sortable ui-sortable">
                                <div class="bal-elements-list-item ui-draggable ui-draggable-handle">
                                </div>
                                <div class="bal-elements-list-item ui-draggable ui-draggable-handle">
                                </div>
                                <div class="element-content">
                                    <div class="form-group">
                                        <h1 style="font-weight: normal;" class="">Review &amp; Submit</h1>
                                    </div>
                                </div>
                                <div class="element-content" style="padding:25px 10px;">
                                    <p class="col-xs-12">
                                        <hr style="clear: both" ;>
                                        <span style="font-size: 18pt;" data-mce-style="font-size: 18pt;">Package and Pricing</span>
                                    </p>
                                    <div style="clear: both;" class="col-xs-12 selectedPackage" id="package_info_summary"></div>
                                    <hr style="clear: both" ;>
                                    <p class="col-xs-12"><span style="font-size: 18pt;" data-mce-style="font-size: 18pt;">Contact &amp; Billing Information</span>
                                    </p>
                                    <div class="col-xs-12 col-md-6">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr bgcolor="#96c03d">
                                                    <th colspan="2">Contact Info</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>Contact Name</th>
                                                    <td>
                                                        <div id="first_name_summary"></div>
                                                        <div id="last_name_summary"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Email Address</th>
                                                    <td>
                                                        <div id="email_summary"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Telephone</th>
                                                    <td>
                                                        <div id="telephone_summary"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr bgcolor="#96c03d">
                                                    <th colspan="2">Blling Info</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>Billing Name</th>
                                                    <td>
                                                        <div id="billing_name_summary"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Billing Address</th>
                                                    <td>
                                                        <div id="billing_add_1_summary"></div>
                                                        <div id="billing_add_2_summary"></div>
                                                        <div id="billing_town_summary"></div>
                                                        <div id="billing_county_summary"></div>
                                                        <div id="postcode_summary"></div>
                                                        <div id="countryCode_summary"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="col-xs-12">
                                        <hr style="clear: both" ;>
                                        <p><span style="font-size: 18pt;" data-mce-style="font-size: 18pt;">Terms and Conditions&nbsp;</span>
                                        </p>
                                        <input type="checkbox" name="terms_agreed" onclick="regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password);">
                                        <p>By clicking on "Create an account" below, you are agreeing to the Terms of Service and the Privacy Policy.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END CONTENT-->
                    <!-- BEGIN CONTROLS-->
                    <div class="tsf-controls " style="display: block;">
                        <!-- BEGIN PREV BUTTTON-->
                        <button type="button" data-type="prev" class="btn btn-left tsf-wizard-btn" style="display: none;"><i class="fa fa-chevron-left"></i> PREV</button>
                        <!-- END PREV BUTTTON-->
                        <!-- BEGIN NEXT BUTTTON-->
                        <button type="button" data-type="next" id="nextBtn" class="btn btn-right tsf-wizard-btn">NEXT <i class="fa fa-chevron-right"></i>
                        </button>
                        <!-- END NEXT BUTTTON-->
                        <!-- BEGIN FINISH BUTTTON-->
                        <button type="submit" data-type="finish" class="btn finishBtn btn-right tsf-wizard-btn" style="display: none;" onClick=" " required="required">FINISH</button>
                        <!-- END FINISH BUTTTON-->
                    </div>
                    <!-- END CONTROLS-->
                </div>
                <!-- END STEP CONTAINER -->
            </div>
        </div>
    </div>
    <?php include( 'dist/includes/page/global_footer.php');?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="dist/css/tsf-wizard.bundle.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="dist/js/modernizr.min.js"></script>
	<script src="dist/js/tsf-wizard.bundle.min.js"></script>
    <script src="dist/js/parsley.js"></script>
    <script src="dist/js/jquery.validate.js"></script>
    <script src="dist/js/check_password_strength.js"></script>
<script src="dist/js/scripts.js"></script>
    <div id="packages" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Packages and Pricing</h4>
                </div>
                <div class="modal-body">
                    <?php include( 'dist/includes/registration/packages.php');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div id="paymentModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Payment Failed</h3>
                </div>
                <div class="modal-body">
                    <p>Unfortunatly there has been a problem submiting your payment. Plase try again.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="result"></div>
    <p id="demo" class="terms_agreed">Click me to change my text color.</p>
    <div class="overlay">
        <div id="loading-img"></div>
    </div>
	<style>
		.block {
			width: 300px;
			margin: 0 auto 0 auto;
		}
		#complexity,
		#results {
			width: 300px;
			padding: 3px 0;
			height: 20px;
			color: #000;
			font-size: 14px;
			text-align: center;
		}
		#results {
			margin: 30px 0 20px 0;
		}
		.default {
			background-color: #CCC;
		}
		.weak {
			background-color: #FF5353;
		}
		.strong {
			background-color: #FAD054;
		}
		.stronger {
			background-color: #93C9F4;
		}
		.strongest {
			background-color: #B6FF6C;
		}
		span.value {
			font-weight: bold;
			float: right;
		}
                                  
        .modal.fade .modal-dialog {
            position: absolute;
            left: 10%;
            width: 80%;
            top: 10%;
            font-size: 1.3em;
        }
        #loading-img {
            background: url(dist/images/loading.gif) center center no-repeat;
            height: 100%;
            z-index: 20;
        }
        .overlay {
            background: #e9e9e9;
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0.5;
            z-index: 999;
        }
    </style>
<script>
	//externalise  and markup js
	
function checkEmailAvailability() {
	
			jQuery.ajax( {
				url: "dist/includes/registration/check_email_availability.php",
				data: 'email=' + $( "#email" ).val(),
				type: "POST",
				success: function ( data ) {
					$( "#email-availability-status" ).html( data );
				},
				error: function () {}
			} );
		};
		function checkUserAvailability() {
			jQuery.ajax( {
				url: "dist/includes/registration/check_user_availability.php",
				data: 'username=' + $( "#username" ).val(),
				type: "POST",
				success: function ( data ) {
					if(data === "success"){
						$( "#user-availability-status" ).html("<span class='status-available' style='color:green;'> Username Available.</span>");
						
						//document.getElementById("nextBtn").disabled = false;
					} else {
						$( "#user-availability-status" ).html("<span class='status-not-available' style='color:red;'> Username Not Available.</span>");
						
						//add validation to true below
						document.getElementById("nextBtn").disabled = false; 
					}
				},
				error: function () {}
			} );
		}
		function getPackageInfo( selectedPackage ) {
			var $selectedPackage;
			$selectedPackage = selectedPackage.value;
			//$("#loaderIcon").show();
			jQuery.ajax( {
				url: "dist/includes/registration/get_package_info.php",
				data: 'package=' + $selectedPackage,
				type: "POST",
				success: function ( data ) {
					$( "#package_info" ).html( data );
					$( "#package_info_summary" ).html( data );
					//$("#loaderIcon").hide();
				},
				error: function () {}
			} );
		}
	document.addEventListener('DOMContentLoaded', function() {
            var card = new Card({
                // a selector or DOM element for the form where users will
                // be entering their information
                form: '#container form', // *required*
                // a selector or DOM element for the container
                // where you want the card to appear
                container: '.card-wrapper', // *required*
                formSelectors: {
                    numberInput: 'input[data-worldpay="number"]', // optional — default input[name="number"]
                    expiryInput: 'input[data-worldpay="number"]', // optional — default input[name="expiry"]
                    cvcInput: 'input[data-worldpay="number"]', // optional — default input[name="cvc"]
                    nameInput: 'input[data-worldpay="number"]' // optional - defaults input[name="name"]
                },
                width: 200, // optional — default 350px
                formatting: true, // optional - default true

                // Strings for translation - optional
                messages: {
                    validDate: 'valid\ndate', // optional - default 'valid\nthru'
                    monthYear: 'mm/yyyy', // optional - default 'month/year'
                },
                // Default placeholders for rendered fields - optional
                placeholders: {
                    number: '•••• •••• •••• ••••',
                    name: 'Full Name',
                    expiry: '••/••',
                    cvc: '•••'
                },

                masks: {
                    cardNumber: '•' // optional - mask card number
                },
                // if true, will log helpful messages for setting up Card
                debug: true // optional - default false
            });
 });


		$( "iframe" ).contents().find( "#_el_input_cardnumber" ).addClass( "myClass" );

		$( '.tsf-wizard-1' ).tsfWizard( {
			stepEffect: 'basic',
			stepStyle: 'style2',
			navPosition: 'left',
			validation: true,
			stepTransition: true,
			showButtons: true,
			showStepNum: true,
			height: 'auto',
		//	prevBtn: '<i class="fa fa-chevron-left"></i> PREV',
		//	nextBtn: 'NEXT <i class="fa fa-chevron-right"></i>',
			finishBtn: 'FINISH',
			disableSteps: 'after_current',
			onNextClick: function (e, from, to, validation) {
                    $('#result').append('onNextClick from ' + from + ' - to ' + to + ' validation ' + validation);
            },
			onBeforeNextButtonClick: function ( e, validation ) {
				console.log( 'onBeforeNextButtonClick' );
				console.log( validation );
				
				
				//for return please write below code
				//  e.preventDefault();
			},
			onAfterNextButtonClick: function ( e, from, to, validation ) {
				console.log( 'onAfterNextButtonClick' );
				Worldpay.submitTemplateForm(); 
			},
			onBeforePrevButtonClick: function ( e, from, to ) {
				console.log( 'onBeforePrevButtonClick' );
				console.log( 'from ' + from + ' to ' + to );
				//  e.preventDefault();
			},
			onAfterPrevButtonClick: function ( e, from, to ) {
				console.log( 'onAfterPrevButtonClick' );
				console.log( 'validation ' + from + ' to ' + to );
			},
			onBeforeFinishButtonClick: function ( e, validation ) {
				
				
				console.log( 'onBeforeFinishButtonClick' );
				console.log( 'validation ' + validation );
				Worldpay.submitTemplateForm();    
				//e.preventDefault();
			},
			onAfterFinishButtonClick: function ( e, validation ) {
				
				inputText =  $("#price").attr('value') ;
    			if(inputText === "0.00" ){
						var url = "../includes/registration/register-free-account.php"; // the script where you handle the form input.
				$.ajax({
					   type: "POST",
					   url: url,
					   data: $("#reg_form").serialize(), // serializes the form's elements.
					   dataType: 'json',
					   success: function(response_data_json)
					   {
						   console.log(response_data_json.payment_responce, response_data_json.database_responce);
						   if(response_data_json.database_responce === "SUCCESS"){
								   $(".overlay").hide();
								   window.location.replace("https://#/client/login/");
							   } else{
								   $(".overlay").hide();
								   $('#paymentModel').modal({show:true});
							   //alert("failed");
						   	   }
					   }
					 });
				}
				else {
					
					var url = ".../includes/registration/register-submit-payment.php"; // the script where you handle the form input.
				$.ajax({
					   type: "POST",
					   url: url,
					   data: $("#reg_form").serialize(), // serializes the form's elements.
					   dataType: 'json',
					   success: function(response_data_json)
					   {
						   console.log(response_data_json.payment_responce, response_data_json.database_responce);
						   if(response_data_json.payment_responce === "SUCCESS"){
							  //alert("SUCCESS");
							   if(response_data_json.database_responce === "SUCCESS"){
								   $(".overlay").hide();
								   window.location.replace("https://#/client/login/");
							   } else{
								   $(".overlay").hide();
								   $('#paymentModel').modal({show:true});
							   //alert("failed");
						   	   }
						   } else{
							   $(".overlay").hide();
							   //alert("failed");
							   $('#paymentModel').modal({show:true});
						   }
					   }
					 });
					
					
				}
				
				
				

				
				console.log( 'onAfterFinishButtonClick' );
				console.log( 'validation ' + validation );
			}
		} );
		
		window.onload = function () {
			Worldpay.useTemplateForm( {

				'clientKey': 'YOUR WORLDPAY CLIENT KEY',
				'form': 'reg_form',
				'orderType': 'RECURRING',
				'paymentSection': 'paymentSection',
				'display': 'inline',
				'reusable': true,
				'saveButton': false,
				'callback': function ( obj ) {
					if ( obj && obj.token ) {
						var _el = document.createElement( 'input' );
						_el.value = obj.token;
						_el.type = 'hidden';
						_el.name = 'token';
						document.getElementById( 'reg_form' ).appendChild( _el );
						//document.getElementById( 'reg_form' ).submit();
					}
				}

			} );
		};
		
	$(function() {
		$('#first_name').keyup(function() { $('#first_name_summary').text($(this).val()); });
		$('#last_name').keyup(function() { $('#last_name_summary').text($(this).val()); });
		$('#email').keyup(function() { $('#email_summary').text($(this).val()); });
		$('#telephone').keyup(function() { $('#telephone_summary').text($(this).val()); });
		$('#billing_name').keyup(function() { $('#billing_name_summary').text($(this).val()); });
		
		$('#billing_add_1').keyup(function() { $('#billing_add_1_summary').text($(this).val()); });
		$('#billing_add_2').keyup(function() { $('#billing_add_2_summary').text($(this).val()); });
		$('#billing_town').keyup(function() { $('#billing_town_summary').text($(this).val()); });
		$('#billing_county').keyup(function() { $('#billing_county_summary').text($(this).val()); });
		$('#postcode').keyup(function() { $('#postcode_summary').text($(this).val()); });
		$('#countryCode').keyup(function() { $('#countryCode_summary').text($(this).val()); });
		$(".finishBtn").click(function () { $(".overlay").show();});		
	});
	$(function(){
    	$("[data-toggle=popover]").popover();
	});
</script>
</body>

</html>