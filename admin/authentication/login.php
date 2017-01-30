<?php
/**
* @about: Admin login page
* 
* PHP version 5.5
*
* @version          1.0 - 30/01/2017
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

$str_userdata = file_get_contents(adminRootFolder.'/authentication/users.json');
$users = json_decode($str_userdata, true);
$errorMessage = "";

function displayError(){
	global $errorMessage;
	$errorMessage = "The username or password is incorrect!";
}
$username = "";
if (isset($_POST["login"])){
	$username = strtolower($_POST['user']);
	$password = $_POST['pass'];

	$username = stripslashes($username);
	$password = stripslashes($password);

	$username = strip_tags($username);
	$password = strip_tags($password);

	if(array_key_exists($username, $users) && password_verify($password, $users[$username])){
		$_SESSION["loggedIn"] = true;
		$_SESSION["username"] = $_POST['user'];

		header("Refresh:0");
	}
	else{
		//show the user what is wrong with the login details
		displayError();
	}
}

?>

<!DOCTYPE html>
<html >
<head>
	<title>Login Form</title>
	<style type="text/css">
		#loginWindow{
			width: 250px; 
			position: fixed;
			top: 50%;
			left: 50%; 
			transform: translate(-50%, -50%);
		}

		input[type=text], input[type=password], select {
			width: 100%;
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

		div {
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px;
		}
	</style>
</head>

<body>
	<div id="loginWindow">


		<form method="post">
			<h3 style="text-align: center;"><?php echo $langSettings["siteName"]; ?> admin login</h3>
			<input type="text" name="user" placeholder="Email address" required="required" value="<?php echo $username; ?>" />
			<br />
			<input type="password" name="pass" placeholder="Password" required="required" />
			<h4 style="color:red; text-align: center;"><?php echo $errorMessage; ?></h4>
			<input type="submit" name="login"></input>
		</form>
		<a href="../" style="text-align: center; display: block; text-decoration: none;">Go Back to the site</a>
	</div>
</body>
</html>
