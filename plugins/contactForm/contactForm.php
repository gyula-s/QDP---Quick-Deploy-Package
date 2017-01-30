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
  /*$spam = $_POST["spam"];*/
  
  if (empty($name)){  //if no name was given
    echo $langSettings["errNoName"];
    echo "<style>#name{background-color:#C80000;color:#FFF;}</style>";
  }
  elseif (empty($email)){ //if no email was given
    echo $langSettings["errNoEmail"];
    echo "<style>#email{background-color:#C80000;color:#FFF;}</style>";
  }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){  //if no correct email was given
    echo $langSettings["errNotValidEmail"];
    echo "<style>#email{background-color:#C80000;color:#FFF;}</style>";
  }
  elseif (empty($subject)){ //if no subject was given
    echo $langSettings["errNoSubject"];
    echo "<style>#subject{background-color:#C80000;color:#FFF;}</style>";
  }
  elseif (empty($message)){ //if no message was given
    echo $langSettings["errNoMessage"];
    echo "<style>#message{background-color:#C80000;color:#FFF;}</style>";
  }
  /*elseif (empty($spam)){  //if no captcha was given
    echo "I'm sorry. You have to tell me, what day is it!";
    echo "<style>#spam{background-color:#C80000;color:#FFF;}</style>";
  }
  elseif (captcha($spam) != true){  //if no captcha is wrong
    echo "I'm sorry. That's the wrong answer!";
    echo "<style>#spam{background-color:#C80000;color:#FFF;}</style>";
  }*/
  else{ //combine the informations, set the variables, and send the email
  $subject = $langSettings["emailSubject"]. $langSettings['siteName']." ". $subject;  
  $emailBody = $langSettings["emailBody"] . $name . " <br/>Email address: ".$email.".\n" . "<br/>\n<p>" . $message . "</p>";
  $emailBody = wordwrap($emailBody, 70, "\r\n");
  
  @mail($emailHome,$subject,$emailBody,$headers);
  echo $langSettings["confirmSending"];
  
    if (isset($_POST['emailCopy'])){    //if it was selected, to send a copy, send the same email, to the site user as well
      @mail($email,$subject,$emailBody,$headers);
    }
  }
}
?> 

<!-- contact form -->
<form method="post" name="contactForm" id="contactform" action="#">
  <div id="contactForm">
    <p>
    <label><?php echo $langSettings["formName"]?></label>
    <br />
    <input name="name" type="text" id="name" size="50" value="<?php echo $name;?>" />
    </p>

    <p>
    <label><?php echo $langSettings["formEmail"]?></label>
    <br />
    <input name="email" type="text" id="email" size="50" value="<?php echo $email; ?>" />
    </p>

    <p>
    <label><?php echo $langSettings["formSubject"]?></label>
    <br />
    <input name="subject" type="text" id="subject" size="50" value="<?php echo $subject; ?>" />
    </p>

    <p>
    <label><?php echo $langSettings["formMessage"]?></label>
    <br />
    <textarea name="message" rows="10" cols="50" id="message"><?php echo $message;?></textarea>
    </p>

    <p>
    <?php echo $langSettings["formRequestCopy"]?>
    <input type="checkbox" name="emailCopy" id="emailCopy" value="" />
    </p>
    <div class="g-recaptcha" data-sitekey="6LebuBMUAAAAAF_P1yoGxIcYs95ur0aRK92x4XWx"></div>
    <p>
    <input name="send" type="submit" id="send" value="<?php echo $langSettings["formSend"]?>" />
    </p>
    
    <p><?php echo $langSettings["formAllFieldsReq"]?></p>
  </div>
</form>