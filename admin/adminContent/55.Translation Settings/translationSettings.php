<?php
/**
* @about: The file will allow the user, to change the individual settings of the languages. 
* these settings include the site name, description, and the error messages in the 404/401/403 errors.
* It also can be specified, what should the offline message be.
* 
* PHP version 5.4
*
* @version          1.0 - 26/01/2017
* @package          This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright        (C) 2017 Gyula Soós
* @license          This program is free software: you can redistribute it and/or modify
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

defined('QDP') or die('Restricted access');

include(adminRootFolder.'/helpers/languageSelector.php'); 

$str_data = file_get_contents(siteRootFolder.DS.'content'.DS.languageToEdit.DS.'langSettings.json');
$langSettings = json_decode($str_data, true);

//when the save button pressed, store each data in the siteSettings array
if (isset($_POST["save"])){

  $langSettings['siteName'] = $_POST["siteName"];
  $langSettings['homeName'] = $_POST["homeName"];
  $langSettings['description'] = $_POST["description"];
  $langSettings['keywords'] = $_POST['keywords'];
  $langSettings['404'] = $_POST["fourOFour"];
  $langSettings['401'] = $_POST["fourOOne"];
  $langSettings['403'] = $langSettings['403'] = $_POST["fourOThree"];
  $langSettings['offlineMessage'] = $_POST["offlineMessage"];

  $langSettings['errNoName'] = $_POST["errNoName"];
  $langSettings['errNoEmail'] = $_POST["errNoEmail"];
  $langSettings['errNotValidEmail'] = $_POST["errNotValidEmail"];
  $langSettings['errNoSubject'] = $_POST["errNoSubject"];
  $langSettings['errNoMessage'] = $_POST["errNoMessage"];
  $langSettings['emailSubject'] = $_POST["emailSubject"];
  $langSettings['emailBody'] = $_POST["emailBody"];
  $langSettings['confirmSending'] = $_POST["confirmSending"];
  $langSettings['formName'] = $_POST["formName"];
  $langSettings['formEmail'] = $_POST["formEmail"];
  $langSettings['formSubject'] = $_POST["formSubject"];
  $langSettings['formMessage'] = $_POST["formMessage"];
  $langSettings['formRequestCopy'] = $_POST["formRequestCopy"];
  $langSettings['formAllFieldsReq'] = $_POST["formAllFieldsReq"];
  $langSettings['formSend'] = $_POST["formSend"];


  //save the array as a json file and then refresh the page
  file_put_contents(siteRootFolder.DS.'content'.DS.languageToEdit.DS.'langSettings.json', json_encode($langSettings, JSON_PRETTY_PRINT));
  header("Refresh:0");
}

?>
<p>All these informations are used in the main site (and some in the admin interface) at various locations and they may be different for each translation of the site. For example the sitename is used in the page title, the footer and in the sent out emails in the contact form. </p>
<p>Feel free to modify these, just make sure, that you don't leave them empty, so all my work doesn't goes to waste!</p>



<!--settings form -->


<form method="post" name="globalSettingsForm" id="globalSettingsForm">
  <div id="form">

    <p>
        <label>Site name:</label>
        <br />
        <input required name="siteName" type="text" id="siteName" size="50" value="<?php echo $langSettings['siteName'];?>" />
    </p>

    <p>
        <label>Home name:</label>
        <br />
        <input required name="homeName" type="text" id="homeName" size="50" value="<?php echo $langSettings['homeName'];?>" />
    </p>

    <p>
        <label>Site description:</label>
        <br />
        <textarea name="description" rows="2" cols="50" id="description"><?php echo $langSettings['description'];?></textarea>
    </p>

    <p>
        <label>Site keywords (one or more words, separatad by a comma):</label>
        <br />
        <textarea name="keywords" rows="2" cols="50" id="keywords"><?php echo $langSettings['keywords'];?></textarea>
    </p>

    <p>
        <label>Customise the 404 error message:</label>
        <br />
        <textarea name="fourOFour" rows="1" cols="50" id="fourOFour" required class="showEditor"><?php echo $langSettings['404'];?></textarea>
    </p>

    <p>
        <label>Customise the 401 error message:</label>
        <br />
        <textarea name="fourOOne" rows="1" cols="50" id="fourOOne" class="showEditor"><?php echo $langSettings['401'];?></textarea>
    </p>

    <p>
        <label>Customise the 403 error message:</label>
        <br />
        <textarea name="fourOThree" rows="1" cols="50" id="fourOThree" class="showEditor"><?php echo $langSettings['403'];?></textarea>
    </p>

    <p>
        <label>Customise the offline message:</label>
        <br />
        <textarea name="offlineMessage" rows="1" cols="50" id="offlineMessage" class="showEditor"><?php echo $langSettings['offlineMessage'];?></textarea>
    </p>

    <p>The following fields will provide translation for the contact form:</p>
    <p>
        <label>Error: No Name entered:</label>
        <br />
        <input required name="errNoName" type="text" id="errNoName" size="50" value="<?php echo $langSettings['errNoName'];?>" />
    </p>
    <p>
        <label>Error: No email entered:</label>
        <br />
        <input required name="errNoEmail" type="text" id="errNoEmail" size="50" value="<?php echo $langSettings['errNoEmail'];?>" />
    </p>
    <p>
        <label>Error: Not a valid email entered:</label>
        <br />
        <input required name="errNotValidEmail" type="text" id="errNotValidEmail" size="50" value="<?php echo $langSettings['errNotValidEmail'];?>" />
    </p>
    <p>
        <label>Error: No subject entered:</label>
        <br />
        <input required name="errNoSubject" type="text" id="errNoSubject" size="50" value="<?php echo $langSettings['errNoSubject'];?>" />
    </p>
    <p>
        <label>Error: No message entered:</label>
        <br />
        <input required name="errNoMessage" type="text" id="errNoMessage" size="50" value="<?php echo $langSettings['errNoMessage'];?>" />
    </p>
    <p>
        <label>Email subject</label>
        <br />
        <input required name="emailSubject" type="text" id="emailSubject" size="50" value="<?php echo $langSettings['emailSubject'];?>" />
    </p>
    <p>
        <label>Email body</label>
        <br />
        <input required name="emailBody" type="text" id="emailBody" size="50" value="<?php echo $langSettings['emailBody'];?>" />
    </p>
    <p>
        <label>Sending confirmation message</label>
        <br />
        <input required name="confirmSending" type="text" id="confirmSending" size="50" value="<?php echo $langSettings['confirmSending'];?>" />
    </p>
    <p>
        <label>Full Name label</label>
        <br />
        <input required name="formName" type="text" id="formName" size="50" value="<?php echo $langSettings['formName'];?>" />
    </p>
    <p>
        <label>Email label</label>
        <br />
        <input required name="formEmail" type="text" id="formEmail" size="50" value="<?php echo $langSettings['formEmail'];?>" />
    </p>
    <p>
        <label>Subject label</label>
        <br />
        <input required name="formSubject" type="text" id="formSubject" size="50" value="<?php echo $langSettings['formSubject'];?>" />
    </p>
    <p>
        <label>Message label</label>
        <br />
        <input required name="formMessage" type="text" id="formMessage" size="50" value="<?php echo $langSettings['formMessage'];?>" />
    </p>
    <p>
        <label>Copy is required checkbox label</label>
        <br />
        <input required name="formRequestCopy" type="text" id="formRequestCopy" size="50" value="<?php echo $langSettings['formRequestCopy'];?>" />
    </p>
    <p>
        <label>All fields are required label</label>
        <br />
        <input required name="formAllFieldsReq" type="text" id="formAllFieldsReq" size="50" value="<?php echo $langSettings['formAllFieldsReq'];?>" />
    </p>
    <p>
        <label>Send message button text</label>
        <br />
        <input required name="formSend" type="text" id="formSend" size="50" value="<?php echo $langSettings['formSend'];?>" />
    </p>
    <p>
        <input name="save" type="submit" id="save" value="Save settings" />
    </p>
</div>
</form>

<?php 
    //the wyswyg editor for the textareas in the forms
include(adminRootFolder.'/helpers/wyswyg.php'); 
?>