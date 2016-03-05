<?php 
defined('QDP') or die('Restricted access');
define('adminRootFolder', rootFolder.DS.'admin');
$siteSettings = array();
$adminSettings = array();

if (file_exists(rootFolder.DS.'siteSettings.json')){
	$str_data = file_get_contents(rootFolder.DS.'siteSettings.json');
	$siteSettings = json_decode($str_data, true);
}

if (file_exists(adminRootFolder.DS.'adminSettings.json')){
	$str_adminData = file_get_contents(adminRootFolder.DS.'adminSettings.json');
	$adminSettings = json_decode($str_adminData, true);
}

if(empty($siteSettings)){
	$siteSettings['siteName'] = "";
	$siteSettings['description'] = "QDP - the database free Quick Deploy Package";
	$siteSettings['siteFromYear'] = "2016";
	$siteSettings['timezone'] = "Europe/London";
	$siteSettings['template'] = "default";
	$siteSettings['contactEmail'] = "changeme@qdpsite.com";
	$siteSettings['outgoingEmailFrom'] = "changeme@qdpsite.com";
	$siteSettings['404'] = "<p>This page you were trying to reach at this address doesn't seem to exist. This is usually the result of a bad or outdated link. We apologize for any inconvenience.<\/p>";
	$siteSettings['401'] = "<p>You don't have necessary credentials to display this page.<\/p>";
	$siteSettings['403'] = "<p>You don't have necessary permissions for this page.<\/p>";
	$siteSettings['offline'] = false;
	$siteSettings['offlineMessage'] = "<h1>The website is under maintenance.<\/h1>";	
}

if(empty($adminSettings)){
	$adminSettings['firebase'] = "";
	$adminSettings['adminTemplate'] = "adminDefault";	
}

	$siteNamePlaceholder = "";
	$firebasePlaceholder = "";

	if(isset($_POST['save'])){

		$siteSettings['siteName'] = $_POST['siteName'];
		$adminSettings['firebase'] = $_POST['firebase'];

		if ($siteSettings['siteName'] == ""){
			$siteNamePlaceholder = "Please enter the name of the site";
		} 
		if ($adminSettings['firebase'] == ""){
			$firebasePlaceholder = "Please enter a valid firebase link";
		}

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
				<input  name="siteName" type="text" id="siteName" size="50" value="<?php echo $siteSettings['siteName']; ?>" placeholder="<?php echo $siteNamePlaceholder; ?>"/>
				</p>
				<label>Please enter the link to the firebase database:</label>
				<br />
				<input  name="firebase" type="text" id="firebase" size="50" value="<?php echo $adminSettings['firebase']; ?>" placeholder="<?php echo $firebasePlaceholder; ?>" />
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