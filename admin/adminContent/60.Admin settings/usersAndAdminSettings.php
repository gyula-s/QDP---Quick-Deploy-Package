<?php
/**
* @about: The file will allow the user, to change the admin settings of the site. 
* these settings include the admin template and the firebase url.
* As a secondary function, it is possible to create and delete users, and also to change passwords of existing users.
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
*MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* See LICENSE.txt for copyright notices and details.
*/

defined('QDP') or die('Restricted access');
$str_admindata = file_get_contents(adminRootFolder.DS.'adminSettings.json');
$adminSettings = json_decode($str_admindata, true);

$firebase = $adminSettings['firebase'];
$adminTemplate = $adminSettings['adminTemplate'];

if (isset($_POST["saveFirebase"])){
  $adminSettings['firebase'] = $_POST["firebase"];
  $adminSettings['adminTemplate'] = $_POST["adminTemplate"];
if (empty($_POST["firebase"])){
    errorMessage("You don't want to leave the firebase value empty!");
  } else {
    file_put_contents(adminRootFolder.DS.'adminSettings.json', json_encode($adminSettings));
    header("Refresh:0");
  }
}

function errorMessage($theMessage){
  echo '<div id="errorMessage">';
  echo $theMessage;
  echo '</div>';
}

function getTemplates($location){
  global $adminSettings;
  if ($location == "site"){
    $templateFolder = '..'.DS.'templates'.DS;
  } elseif ($location == "admin"){
    $templateFolder = 'template'.DS;
  }
  $availableTemplates = array_diff(scandir($templateFolder), array('..', '.',));

  foreach ($availableTemplates as $key => $value) {
    //will return something like this:
    //<option name='template' id='template' value='whatever folder found'>Whatever the folder name is</option>
    echo "\n<option value='".$value."' ";
    if($adminSettings['adminTemplate'] == $value){
      echo ('selected="selected"');
    }
    echo ">".$value."</option>";
  }
}
?>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdn.firebase.com/js/client/2.4.1/firebase.js"></script>
<style type="text/css">
body{
  position: relative;

}

#loginWindow{
  width: 400px;
  position: absolute;
  top: 30%;
  left:50%;
  transform: translate(-50% , -50%);
  margin:auto;
  vertical-align: middle;
  display: block;
  border: 1px solid black;
  padding: 50px;
  box-shadow: 0 0 5px 1px #969696;
}

label{
  display: inline-block;
  width: 100px;
  text-align: left;
  margin-bottom: 10px;
  font-size: 16px;
  font-weight: bold;
  font-family: sans-serif;
}

input[type="text"], input[type="email"], input[type="password"] {
  font-family: sans-serif;
  font-size: 18px;
  padding: 10px;
  border: solid 1px #dcdcdc;
  transition: box-shadow 0.3s, border 0.3s;
}

input[type="text"]:focus, input[type="password"]:focus, input[type="text"]:hover, input[type="password"]:hover, input[type="email"]:hover {
  border: solid 1px #707070;
  box-shadow: 0 0 5px 1px #969696;
}

#createUser, #removeUser, #changePassword, #changeEmail{
  font-family: sans-serif;
  font-size: 16px;
  display: table;
  margin: 15px auto;
  width: 170px;
  height: 60px;
}

#createUser:hover, #removeUser:hover, #changePassword:hover, #changeEmail:hover{
  box-shadow: 0 0 5px 1px #969696;
}

p{
  text-align: center;
  font-family: sans-serif;
}

#error{
  color: red;
  font-weight: bold;
}
h3{
  font-family: sans-serif;
  text-align: center;
}

legend{
	font-size: 12px;
}

fieldset label{
  width: 100%; text-align:center;
}
.fakeLink{
  cursor:pointer;
}

.fakeLink:hover{
  color:red;
}
</style>
	


</head>

  <body>
	<h3>
	<p id="showCreateUser" class="fakeLink">Create a new user</p>
	<fieldset id="createUserForm" style="display:none;">
		<legend>Create a new user</legend>
		Email:<br>
		<input type="email" id="createEmail">
		<br>
		Password:<br>
		<input type="password" id="createPassword">
		<br><br>
		<button id="createUser" type="button">Create a new user</button>
	</fieldset>

	<p id="showChangePassword" class="fakeLink">Change password</p>
	<fieldset id="changePasswordUserForm" style="display:none;">
		<legend>Change password</legend>
		Email:<br>
		<input type="email" id="changePasswordUsername">
		<br>
		Old Password:<br>
		<input type="password" id="oldPassword">
		<br>
		New Password:<br>
		<input type="password" id="newPassword">
		<br><br>
		<button id="changePassword" type="button">Change the password</button>
	</fieldset>

	<p id="showChangeEmail" class="fakeLink">Change the email of an user</p>
	<fieldset id="changeEmailForm" style="display:none;">
		<legend>Change the email of an user</legend>
		Old Email:<br>
		<input type="email" id="oldEmail">
		<br>
		New Email:<br>
		<input type="email" id="newEmail">
		<br>
		Password:<br>
		<input type="password" id="changeEmailPassword">
		<br><br>
		<button id="changeEmail" type="button">Change the email address</button>
	</fieldset>
	<p id="error"></p>

  <fieldset >
    <legend>A few more admin related settings:</legend>
    <form method="post" name="fireBaseSettingsForm" id="fireBaseSettingsForm" action="">
    <p>
    <label>Admin template:</label>
    <br />
    <select name="adminTemplate" id="adminTemplate" >
      <?php getTemplates("admin"); ?>
    </select>
    </p>
    <label style="color:red;" >The URL to the firebase database. CAUTION! If you leave it empty or add the wrong URL you will shut yourself out!</label>
    <br />
    <input required name="firebase" type="url" id="firebase" size="50" value="<?php echo $firebase;?>" />
    <br /><br />
    <input name="saveFirebase" type="submit" id="saveFirebase" value="Save these settings" />
    </form>
  </fieldset>
  </body>


  <script type="text/javascript">
var ref = new Firebase("<?php echo $adminSettings['firebase']; ?>");
var errorMessage = document.getElementById("error");

var createUser = document.getElementById("createUserForm");
var changePassword = document.getElementById("changePasswordUserForm");
var changeEmail = document.getElementById("changeEmailForm");

$("#showCreateUser").on("click", function (){
	toogleVisibility(createUser, changePassword, changeEmail);
	
});

$("#showChangePassword").on("click", function (){

	toogleVisibility(changePassword, createUser, changeEmail);
});

$("#showChangeEmail").on("click", function (){

	toogleVisibility(changeEmail, createUser, changePassword);
});

function toogleVisibility(elementToShow, elementToHide, secondElementToHide){
	if (elementToShow.style.display == "block")
		elementToShow.style.display = "none";

	else
		elementToShow.style.display = "block";
    elementToHide.style.display = "none";
    secondElementToHide.style.display = "none";
	}


$('#createUser').on("click", function (){
  var username = $("#createEmail").val();
  var password = $("#createPassword").val();

  ref.createUser({
  email: username,
  password: password
}, function(error, userData) {
  if (error) {
    switch (error.code) {
      case "EMAIL_TAKEN":
      errorMessage.innerHTML = "The new user account cannot be created because the email is already in use.";
        console.log("The new user account cannot be created because the email is already in use.");
        break;
      case "INVALID_EMAIL":
      errorMessage.innerHTML = "The specified email is not a valid email.";
        console.log("The specified email is not a valid email.");
        break;
      default:
      errorMessage.innerHTML = "Error creating user";
        console.log("Error creating user:", error);
    }
  } else {
    errorMessage.innerHTML = "Successfully created user account.";
    console.log("Successfully created user account with uid:", userData.uid);
  }
});

});

$('#changePassword').on("click", function (){
  var username = $("#changePasswordUsername").val();
  var oldPassword = $("#oldPassword").val();
  var newPassword = $("#newPassword").val();

ref.changePassword({
  email: username,
  oldPassword: oldPassword,
  newPassword: newPassword
}, function(error) {
  if (error) {
    switch (error.code) {
      case "INVALID_PASSWORD":
      errorMessage.innerHTML = "The specified user account password is incorrect.";
        console.log("The specified user account password is incorrect.");
        break;
      case "INVALID_USER":
      errorMessage.innerHTML = "The specified user account does not exist.";
        console.log("The specified user account does not exist.");
        break;
      default:
      errorMessage.innerHTML = "Error changing password";
        console.log("Error changing password:", error);
    }
  } else {
  	errorMessage.innerHTML = "User password changed successfully!";
    console.log("User password changed successfully!");
  }
});
});

$('#changeEmail').on("click", function (){
  var oldEmail = $("#oldEmail").val();
  var newEmail = $("#newEmail").val();
  var password = $("#changeEmailPassword").val();

  ref.changeEmail({
  oldEmail: oldEmail,
  newEmail: newEmail,
  password: password
}, function(error) {
  if (error) {
    switch (error.code) {
      case "INVALID_PASSWORD":
      errorMessage.innerHTML = "The specified user account password is incorrect.";
        console.log("The specified user account password is incorrect.");
        break;
      case "INVALID_USER":
      errorMessage.innerHTML = "The specified user account does not exist.";
        console.log("The specified user account does not exist.");
        break;
      default:
      errorMessage.innerHTML = "Error creating user";
        console.log("Error creating user:", error);
    }
  } else {
  	errorMessage.innerHTML = "User email changed successfully!";
    console.log("User email changed successfully!");
  }
});
});
  </script>
</html>