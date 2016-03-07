<?php 
/**
* @about:This file is used to set up a new QDP for the first time.
* 
* 
* PHP version 5.4
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
$adminSettings = array();

//in cases when the install file is used to recover from bad configuration, the rest of the site settings are saved.
if (file_exists(rootFolder.DS.'siteSettings.json')){
	$str_data = file_get_contents(rootFolder.DS.'siteSettings.json');
	$siteSettings = json_decode($str_data, true);
}

//in cases when the install file is used to recover from bad configuration, the rest of the site settings are saved.
if (file_exists(adminRootFolder.DS.'adminSettings.json')){
	$str_adminData = file_get_contents(adminRootFolder.DS.'adminSettings.json');
	$adminSettings = json_decode($str_adminData, true);
}

//when the there is no settings file, create one with these default values.
if(empty($siteSettings)){
	$siteSettings['siteName'] = "";
	$siteSettings['description'] = "QDP - the database free Quick Deploy Package";
	$siteSettings['siteFromYear'] = "2016";
	$siteSettings['timezone'] = "Europe/London";
	$siteSettings['template'] = "default";
	$siteSettings['contactEmail'] = "changeme@qdpsite.com";
	$siteSettings['outgoingEmailFrom'] = "changeme@qdpsite.com";
	$siteSettings['404'] = "<p>This page you were trying to reach at this address doesn't seem to exist. This is usually the result of a bad or outdated link. We apologize for any inconvenience.</p>";
	$siteSettings['401'] = "<p>You don't have necessary credentials to display this page.</p>";
	$siteSettings['403'] = "<p>You don't have necessary permissions for this page.</p>";
	$siteSettings['offline'] = false;
	$siteSettings['offlineMessage'] = "<h1>The website is under maintenance.</h1>";	
}

//when the there is no settings file, create one with these default values.
if(empty($adminSettings)){
	$adminSettings['firebase'] = "";
	$adminSettings['adminTemplate'] = "adminDefault";	
}
	
	//this placeholder is inserted in the text fiels when they are empty
	$siteNamePlaceholder = "";
	$firebasePlaceholder = "";

	if(isset($_POST['save'])){
		$siteSettings['siteName'] = $_POST['siteName'];
		$adminSettings['firebase'] = $_POST['firebase'];

		//if either of the sitename or firebase URL-s are missing, show a placeholder text
		if ($siteSettings['siteName'] == ""){
			$siteNamePlaceholder = "Please enter the name of the site";
		} 
		if ($adminSettings['firebase'] == ""){
			$firebasePlaceholder = "Please enter a valid firebase link";
		}

		//when both entires are present, save the siteSettings, adminSettings and delete this install file. Then refresh the page to land 
		if (!empty($siteSettings['siteName']) && !empty($adminSettings['firebase'])){
			file_put_contents(rootFolder.DS.'siteSettings.json', json_encode($siteSettings));
			file_put_contents(adminRootFolder.DS.'adminSettings.json', json_encode($adminSettings));
			unlink(rootFolder.DS.'install.php');
			header("Refresh:0");
		}	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>	
	<title>QDP setup</title>
	<style type="text/css">
	#container{
		width: 800px;
		margin: auto;
		margin-top: 30px;
	}
	</style>

	
</head>

<body>

	<div id="container">
		<h1>QDP installation</h1>
		<div id="settingsForm">
			<form method="post" name="installQDP" id="installQDP" action="">
				<h2>I just need a few things, before we can go on</h2>
				<p>
				<label >Please enter the name of the site:</label>
				<br />
				<input required name="siteName" type="text" id="siteName" size="50" value="<?php echo $siteSettings['siteName']; ?>" placeholder="<?php echo $siteNamePlaceholder; ?>"/>
				</p>
				<label>Please enter the link to the firebase database:</label>
				<br />
				<input required name="firebase" type="text" id="firebase" size="50" value="<?php echo $adminSettings['firebase']; ?>" placeholder="<?php echo $firebasePlaceholder; ?>" />
				</p>
				<p>
    			<button name="save" type="submit" id="save" value="Save settings">Save</button>
    			</p>
			</form>
		</div>
		<div id="firebaseInstructions">
			<p>To setup a new Firebase account, you can find more information here:</p>
			<a href="https://github.com/soosgyul/quick_deploy_package/wiki/Creating-the-Firebase-database">Creating the Firebase database</a>
		</div>
	</div>
</body>
</html>