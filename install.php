<?php 
/**
* @about:This file is used to set up a new QDP for the first time.
* 
* 
* PHP version 5.5.0
*
* @version          1.0 - 06/03/2016
* @package          This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright        (C) 2016 Gyula Soós
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
define('adminRootFolder', rootFolder.DS.'admin');
$siteSettings = array();
$langSettings = array();
$users = array();
//in cases when the install file is used to recover from bad configuration, the rest of the site settings are saved.
if (file_exists(rootFolder.DS.'siteSettings.json')){
	$str_data = file_get_contents(rootFolder.DS.'siteSettings.json');
	$siteSettings = json_decode($str_data, true);
}

//in cases when the install file is used to recover from bad configuration, the rest of the site settings are saved.
if (file_exists(rootFolder.DS.'content'.DS.'en'.DS.'langSettings.json')){
	$str_langData = file_get_contents(rootFolder.DS.'content'.DS.'en'.DS.'langSettings.json');
	$langSettings = json_decode($str_langData, true);
}

if (file_exists(adminRootFolder.DS.'authentication'.DS.'users.json')){
	$str_userdata = file_get_contents(adminRootFolder.DS.'authentication'.DS.'users.json');
	$users = json_decode($str_userdata, true);
}

//when the there is no settings file, create one with these default values.
if(empty($siteSettings)){	
	$siteSettings['siteFromYear'] = date("Y");
	$siteSettings['timezone'] = "Europe/London";
	$siteSettings['languages'] = array("en");
	$siteSettings['template'] = "default";
	$siteSettings['contactEmail'] = "changeme@qdpsite.com";
	$siteSettings['outgoingEmailFrom'] = "changeme@qdpsite.com";
	$siteSettings['offline'] = false;
}

//when the there is no settings file, create one with these default values.
if(empty($langSettings)){
	$langSettings['siteName'] = "";
	$langSettings['homeName'] = "Home";
	$langSettings['description'] = "QDP - the database free Quick Deploy Package";
	$langSettings['keywords'] = "";
	$langSettings['404'] = "<p>This page you were trying to reach at this address doesn't seem to exist. This is usually the result of a bad or outdated link. We apologize for any inconvenience.</p>";
	$langSettings['401'] = "<p>You don't have necessary credentials to display this page.</p>";
	$langSettings['403'] = "<p>You don't have necessary permissions for this page.</p>";
	$langSettings['errNoName'] = "I'm sorry, I need your name!";
	$langSettings['errNoEmail'] = "I'm sorry, no email address was entered!";
	$langSettings['errNotValidEmail'] = "I'm sorry. The email doesn't appear to be valid!";
	$langSettings['errNoSubject'] = "I'm sorry, there is no subject!";
	$langSettings['errNoMessage'] = "I'm sorry. There was no message!";
	$langSettings['emailSubject'] = "Contact form on ";
	$langSettings['emailBody'] = "A new message from: ";
	$langSettings['confirmSending'] = "Thank you! Message was sent successfully!";
	$langSettings['formName'] = "Full name:";
	$langSettings['formEmail'] = "Your email address:";
	$langSettings['formSubject'] = "Subject:";
	$langSettings['formMessage'] = "Message:";
	$langSettings['formRequestCopy'] = "Check this box, if you would like a copy of this message:";
	$langSettings['formAllFieldsReq'] = "All fields are required!";
	$langSettings['formSend'] = "Send message";
	$langSettings['offlineMessage'] = "<h1>The website is under maintenance.</h1>";
}

	//this placeholder is inserted in the text fiels when they are empty
$siteNamePlaceholder = "";
$userNamePlaceholder = "";
$passwordPlaceholder = "";

if(isset($_POST['save'])){
	$userName = $_POST['user'];
	$password = $_POST['pass'];
	$repeatPass = $_POST['repass'];

	$langSettings['siteName'] = $_POST['siteName'];

	//when both entires are present, save the siteSettings  delete this install file. Then refresh the page to land 
	if ($password == $repeatPass && strlen($_POST['siteName'])){
			//saving the site settings and admin settings json file
		$users[strtolower($_POST['user'])] = password_hash($_POST['pass'], PASSWORD_DEFAULT);

		file_put_contents(adminRootFolder.'/authentication/users.json', json_encode($users, JSON_PRETTY_PRINT));
		file_put_contents(rootFolder.DS.'siteSettings.json', json_encode($siteSettings, JSON_PRETTY_PRINT));
		file_put_contents(rootFolder.DS.'content'.DS.'en'.DS.'langSettings.json', json_encode($langSettings, JSON_PRETTY_PRINT));
		unlink(rootFolder.DS.'install.php');
		header("Refresh:0");	
	}
	elseif ($password != $repeatPass)
	{
		echo "Passwords don't match!";
	}
	else
	{
		echo "Something went wrong! Check the details and try again!";
	}
}
?>
<!DOCTYPE html>

<head>	
	<title>QDP setup</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		#container{
			width: 800px;
			margin: auto;
			margin-top: 30px;
		}

		input[type=text], input[type=password], input[type=number], input[type=textarea], select {
			width: 80%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		input[type=submit] {
			width: 100%;
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type=submit]:hover {
			background-color: #45a049;
		}

	</style>	
</head>

<body>
	<div id="container">
		<h1>QDP installation</h1>
		<div id="settingsForm">
			<form method="post" >
				<h2>I just need a few things, before we can go on</h2>
				<p>
					<label >Please enter the name of the site:</label>
					<br />
					<input required name="siteName" type="text" size="50" value="<?php echo $langSettings['siteName']; ?>" placeholder="The name of the Site (it may be changed later)"/>
				</p>
				<br />
				<fieldset>
					<legend>Set up an admin account</legend>
					<p>
						<input type="text" name="user" placeholder="Email address" required="required"/>
						<br />
						<input type="password" name="pass" placeholder="Password" required="required" />
						<br />
						<input type="password" name="repass" placeholder="Repeat password" required="required" />
					</fieldset>
					<p>
						<label>
							To access the admin page, please visit "yourdomain.com/admin".<br />
						</label>
						<input type="submit" name="save" value="Save settings">Save</input>
					</p>
				</form>
			</div>
			<div id="firebaseInstructions">
				<p>You may set up additional accounts in the administrator backend, furthermore you may find more information on the wiki page:</p>
				<a href="https://github.com/soosgyul/QDP---Quick-Deploy-Package/wiki">QDP Wiki</a>
			</div>
		</div>
	</body>
	</html>