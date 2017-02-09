<?php 
/**
* @about: Contact form with validation and email sending facilities.
* A capcha has been implemented but disabled.
* To use the built in captcha uncomment lines: 51, 73-80, 141-147
* 
* Based on the script by Gyula Soos - 2015-04-23 and http://web-kreation.com/all/php-contact-form-script
* 
* PHP version 5.4
*
* @version      2.0 - 30/01/2017
* @package      This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright    (C) 2017 Gyula Soós
* @license      This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* See LICENSE.txt for copyright notices and details.
*/
$str_data = file_get_contents(rootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

$str_lang_data = file_get_contents(rootFolder.DS.'content'.DS.siteLanguage.DS.'langSettings.json');
$langSettings = json_decode($str_lang_data, true);

require_once "recaptchalib.php";
// your secret key
$secret = $siteSettings['recaptchaSecret'];
 // empty response
$response = null;

// check secret key
$reCaptcha = new ReCaptcha($secret);

$name = "";
$email = "";
$subject = "";
$message = "";
$spam = "";

/*site details. info needed to send the email*/
$emailHome = $siteSettings['contactEmail'];
$emailFrom = $siteSettings['outgoingEmailFrom'];
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: ".$emailFrom . "\r\n";
$headers .= "Reply-To: ". $email . "\r\n";

/*errorchecking mechanism*/
if (isset($_POST["send"])){

	$name = $_POST["name"];
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	$message = nl2br($message);
	$message = stripslashes($message);

  // if submitted check response recaptcha response
	if ($_POST["g-recaptcha-response"]) {
		$response = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
			);
	}

  if (empty($name)){  //if no name was given
  	echo '<div class="alert alert-danger">';
  	echo '<strong>'.$langSettings["errNoName"].'</strong>';
  	echo '</div>';
  }
  elseif (empty($email)){ //if no email was given
  	echo '<div class="alert alert-danger">';
  	echo '<strong>'.$langSettings["errNoEmail"].'</strong>';
  	echo '</div>';
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){  //if no correct email was given
  	echo '<div class="alert alert-danger">';
  	echo '<strong>'.$langSettings["errNotValidEmail"].'</strong>';
  	echo '</div>';
  }
  elseif (empty($subject)){ //if no subject was given
  	echo '<div class="alert alert-danger">';
  	echo '<strong>'.$langSettings["errNoSubject"].'</strong>';
  	echo '</div>';
  }
  elseif (empty($message)){ //if no message was given
  	echo '<div class="alert alert-danger">';
  	echo '<strong>'.$langSettings["errNoMessage"].'</strong>';
  	echo '</div>';
  }
  elseif ($response == null){
  	echo '<div class="alert alert-danger">';
  	echo "<strong>Please prove it you're a human!</strong>";
  	echo '</div>';
  }
  elseif (!($response->success)){
  	echo '<div class="alert alert-danger">';
  	echo '<strong>Captcha validation fail!</strong>';
  	echo '</div>';
  }
  else{ //combine the informations, set the variables, and send the email
  	$subject = $langSettings["emailSubject"]. $langSettings['siteName']." ". $subject;  
  	$emailBody = $langSettings["emailBody"] . $name . " <br/>Email address: ".$email.".\n" . "<br/>\n<p>" . $message . "</p>";
  	$emailBody = wordwrap($emailBody, 70, "\r\n");

  	@mail($emailHome,$subject,$emailBody,$headers);
  	echo '<div class="alert alert-success">';
  	echo '<strong>'.$langSettings["confirmSending"],'</strong>';
  	echo '</div>';

    if (isset($_POST['emailCopy'])){    //if it was selected, to send a copy, send the same email, to the site user as well
    	@mail($email,$subject,$emailBody,$headers);
    }
}
}
?> 

<script src='https://www.google.com/recaptcha/api.js?hl=<?php echo siteLanguage; ?>'></script>
<!-- contact form -->
<div class="input-group input-group-lg">
<form method="post" name="contactForm" id="contactform" action="#">
	<div id="contactForm" class="form-group">
		<p>
			<label><?php echo $langSettings["formName"]?></label>
			<br />
			<input name="name" type="text" class="form-control" id="name" size="50" value="<?php echo $name;?>" />
		</p>
</div>
<div class="form-group">
		<p>
			<label><?php echo $langSettings["formEmail"]?></label>
			<br />
			<input name="email" type="text" class="form-control" id="email" size="50" value="<?php echo $email; ?>" />
		</p>
</div>
<div class="form-group">
		<p>
			<label><?php echo $langSettings["formSubject"]?></label>
			<br />
			<input name="subject" type="text" class="form-control" id="subject" size="50" value="<?php echo $subject; ?>" />
		</p>
</div>
<div class="form-group">
		<p>
			<label><?php echo $langSettings["formMessage"]?></label>
			<br />
			<textarea name="message" rows="10" cols="50" class="form-control" id="message"><?php echo $message;?></textarea>
		</p>
</div>
<div class="form-group">
		<p>
			<?php echo $langSettings["formRequestCopy"]?>
			<input type="checkbox" name="emailCopy" id="emailCopy" value="" />
		</p>
		<div class="g-recaptcha" data-sitekey="<?php echo $siteSettings['recaptchaSiteKey'];?>"></div>
		
		</div>
<div class="form-group">
		<p>
			<input class="btn btn-default" name="send" type="submit" id="send" value="<?php echo $langSettings["formSend"]?>" />
		</p>

		<p><?php echo $langSettings["formAllFieldsReq"]?></p>
	</div>
</form>
</div>