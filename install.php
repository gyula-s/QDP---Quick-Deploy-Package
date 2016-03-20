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
define('outsidePublic' , realpath(rootFolder.DS.'..'));
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
	$adminSettings['adminTemplate'] = "adminDefault";

}
	
	//this placeholder is inserted in the text fiels when they are empty
	$siteNamePlaceholder = "";
	$userNamePlaceholder = "";
	$passwordPlaceholder = "";

	if(isset($_POST['save'])){
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$location = $_POST['location'].preg_replace('/\s+/', '_', $_POST['siteName']).'_pass';

		$siteSettings['siteName'] = $_POST['siteName'];
		$adminSettings['htpLocation'] = $location;

		//if either of the sitename or firebase URL-s are missing, show a placeholder text
		if ($siteSettings['siteName'] == ""){
			$siteNamePlaceholder = "Please enter a name for the site";
		} 

		if ($userName == ""){
			$userNamePlaceholder = "Please enter a username";
		} 

		if ($password == ""){
			$passwordPlaceholder = "Please enter a password";
		} 

		//when both entires are present, save the siteSettings, adminSettings and delete this install file. Then refresh the page to land 
		if (!empty($siteSettings['siteName']) && !empty($_POST['userName']) && !empty($_POST['password']) ){
			$password = passwordGenerator(base64_decode($password));

			//saving the site settings and admin settings json file
			file_put_contents(rootFolder.DS.'siteSettings.json', json_encode($siteSettings));
			file_put_contents(adminRootFolder.DS.'adminSettings.json', json_encode($adminSettings));

			//saving htpsswrd file. first it creates a separate folder for the htpsswrd since it doesnt have a proper filename
			if (!file_exists($location)){
				mkdir($location, 0701, true);
			}
			file_put_contents($location.DS.'.htpasswd', $userName.':'.$password);
			writeRuleInHtaccess();
			unlink(rootFolder.DS.'install.php');
			header("Refresh:0");
		}	
	}

/*
This function requires the original .htaccess file to be present in the admin folder
or
no file at all, 
or
the following lines to be present in the .htaccess file:

#Block_External_Access
AuthType Basic
AuthName 'My Protected Area'
AuthUserFile locaton\of\htpasswrd\on\the\server/.htpasswd
Require valid-user

It has been created this way, so nothing will be overwritten in your htaccess file, in case anything is deleted.
*/
function writeRuleInHtaccess(){
	global $location;
	$htaccess = adminRootFolder.DS.'.htaccess';
	if (file_exists($htaccess)){
		$lines = explode("\n", file_get_contents($htaccess));
		foreach ($lines as $key => $line) {
			$firstWord = substr($line,0,12);
			if ($firstWord == "AuthUserFile"){
				$lines[$key] = $firstWord.' '.$location."/.htpasswd\n";
			} else {
				$lines[$key] = $line."\n";
			}
		}
		file_put_contents($htaccess, $lines);
	} else {
		$blockExternalAccess = array();
		$blockExternalAccess[] = "#Block_External_Access\n";
		$blockExternalAccess[] = "AuthType Basic\n";
		$blockExternalAccess[] = "AuthName 'My Protected Area'\n";
		$blockExternalAccess[] = "AuthUserFile ".$location."/.htpasswd\n";
		$blockExternalAccess[] = "Require valid-user\n";

		file_put_contents($htaccess, $blockExternalAccess);
	}
}

//function written by By Virendra Chandak on March 2, 2014
// https://www.virendrachandak.com/techtalk/using-php-create-passwords-for-htpasswd-file/
function passwordGenerator($plainpasswd){
    $salt = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);
    $len = strlen($plainpasswd);
    $text = $plainpasswd.'$apr1$'.$salt;
    $bin = pack("H32", md5($plainpasswd.$salt.$plainpasswd));
    for($i = $len; $i > 0; $i -= 16) { $text .= substr($bin, 0, min(16, $i)); }
    for($i = $len; $i > 0; $i >>= 1) { $text .= ($i & 1) ? chr(0) : $plainpasswd{0}; }
    $bin = pack("H32", md5($text));
	$tmp = "";
    for($i = 0; $i < 1000; $i++)
    {
        $new = ($i & 1) ? $plainpasswd : $bin;
        if ($i % 3) $new .= $salt;
        if ($i % 7) $new .= $plainpasswd;
        $new .= ($i & 1) ? $bin : $plainpasswd;
        $bin = pack("H32", md5($new));
    }
    for ($i = 0; $i < 5; $i++)
    {
        $k = $i + 6;
        $j = $i + 12;
        if ($j == 16) $j = 5;
        $tmp = $bin[$i].$bin[$k].$bin[$j].$tmp;
    }
    $tmp = chr(0).chr(0).$bin[11].$tmp;
    $tmp = strtr(strrev(substr(base64_encode($tmp), 2)),
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
    "./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"); 
    return "$"."apr1"."$".$salt."$".$tmp;
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
				<br />
				<fieldset>
					<legend>Set up an admin account</legend>
				<p>
				<label>Please enter a username:</label>
				<br />
				<input required name="userName" type="text" id="userName" size="50" value="" placeholder="<?php echo $userNamePlaceholder; ?>"/>
				</p>
				<p>
				<label>Please enter a password:</label>
				<br />
				<input required name="password" type="text" id="password" size="50" value="" placeholder="<?php echo $passwordPlaceholder; ?>"/>
				</p>
				<label>Please select the location of the password file on the server:</label>
				<br />
				<input type="radio" name="location" value="<?php echo adminRootFolder; ?>">Root of the admin folder<br />
				<input type="radio" name="location" value="<?php echo outsidePublic.DS ?>" checked>Outsite the public html folder in it's own folder(recommended)<br />
				</fieldset>
				<p>
					<label>
						When you hit save, the .htpasswrd file will be created on the location you have choosen, <br />
						The .htaccess file in the admin folder will be updated with this location,<br />
						and this installation file will be deleted.<br />
						To access the admin page, please visit "yourdomain.com/admin".<br />
					</label>
    			<button name="save" type="submit" id="save" value="Save settings" onClick="encryptPassword()">Save</button>
    			</p>
			</form>
		</div>
		<div id="firebaseInstructions">
			<p>To setup a new admin account, you can find more information on the wiki page:</p>
			<a href="https://github.com/soosgyul/QDP---Quick-Deploy-Package/wiki">QDP Wiki</a>
		</div>
	</div>
	<script type="text/javascript">
		function encryptPassword(){
			var passwordField = document.forms["installQDP"]["password"];
			var password = passwordField.value;
			passwordField.value = btoa(password);
		}	


	</script>
</body>
</html>