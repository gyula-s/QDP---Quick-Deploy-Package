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
* @version      1.0 - 06/03/2016
* @package      This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright    (C) 2016 Gyula Soós
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
    echo "I'm sorry, I need your name!";
    echo "<style>#name{background-color:#C80000;color:#FFF;}</style>";
  }
  elseif (empty($email)){ //if no email was given
    echo "I'm sorry, no email address was entered!";
    echo "<style>#email{background-color:#C80000;color:#FFF;}</style>";
  }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){  //if no correct email was given
    echo "I'm sorry. The email doesn't appear to be valid!";
    echo "<style>#email{background-color:#C80000;color:#FFF;}</style>";
  }
  elseif (empty($subject)){ //if no subject was given
    echo "I'm sorry, there is no subject!";
    echo "<style>#subject{background-color:#C80000;color:#FFF;}</style>";
  }
  elseif (empty($message)){ //if no message was given
    echo "I'm sorry. There was no message!";
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
  $subject = "Contact form on ". $siteSettings['siteName']." ". $subject;  
  $emailBody = "A new message from: " . $name . " <br/>Email address: ".$email.".\n" . "<br/>Here is the message: \n<p>" . $message . "</p>";
  $emailBody = wordwrap($emailBody, 70, "\r\n");
  
  @mail($emailHome,$subject,$emailBody,$headers);
  echo "Thank you ".$name."\n. Message was sent successfully!";
  
    if (isset($_POST['emailCopy'])){    //if it was selected, to send a copy, send the same email, to the site user as well
      @mail($email,$subject,$emailBody,$headers);
    }
  }
}
?> 

<!-- contact form -->
<form method="post" name="contactForm" id="contactform" action="">
  <div id="contactForm">
    <p>
    <label>Full name:</label>
    <br />
    <input name="name" type="text" id="name" size="50" value="<?php echo $name;?>" />
    </p>

    <p>
    <label>Your email address:</label>
    <br />
    <input name="email" type="text" id="email" size="50" value="<?php echo $email; ?>" />
    </p>

    <p>
    <label>Subject:</label>
    <br />
    <input name="subject" type="text" id="subject" size="50" value="<?php echo $subject; ?>" />
    </p>

    <p>
    <label>Message:</label>
    <br />
    <textarea name="message" rows="10" cols="50" id="message"><?php echo $message;?></textarea>
    </p>

    <p>
    Check this box, if you would like a copy of this message:
    <input type="checkbox" name="emailCopy" id="emailCopy" value="" />
    </p>

    <p>
    <input name="send" type="submit" id="send" value="Send message" />
    </p>
    
    <p>All fields are required!</p>
  </div>
</form>

<?php

function captcha($answer){  //this captcha will promt the user for the dayname

/*
this html code can be reinserted at any time to the form, if required
<p>
    <label>Spam check: what day is today? Please answer in words:</label>
    <br />
    <input name="spam" type="text" id="spam" size="50" value="" />
    </p>
*/

  date_default_timezone_set($siteSettings["timezone"]);
  $today = strtolower(date("l")); //get the date
  $today = substr($today, 0, 3);  //use only the first three letter from the day name
  $answer = strtolower($answer);  //convert all letters to lowercase
  $answer = substr($answer, 0, 3);//use only the first three letters from the answer from the user
  //with this method, the user can enter a wide range of answers: ex. tue, TUE, Tue, Tuesday, TUESDAY,TuEsDaY
  if ($today == $answer)
    return true;
  else
    return false;
}
?>