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
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* See LICENSE.txt for copyright notices and details.
*/

defined('QDP') or die('Restricted access');
$str_admindata = file_get_contents(adminRootFolder.DS.'adminSettings.json');
$adminSettings = json_decode($str_admindata, true);

$adminTemplate = $adminSettings['adminTemplate'];

if (isset($_POST["saveSettings"])){
   $adminSettings['adminTemplate'] = $_POST["adminTemplate"];
    file_put_contents(adminRootFolder.DS.'adminSettings.json', json_encode($adminSettings));
    header("Refresh:0");
  
}

if (isset($_POST["saveUsers"])){
  $usersList = $_POST['users'];
    file_put_contents($adminSettings['htpLocation'].DS.'.htpasswd', $_POST['users']);
    header("Refresh:0");  
}

function readHtpasswords(){
  global $adminSettings;
  $usersList = explode("\n", file_get_contents($adminSettings['htpLocation'].DS.'.htpasswd'));
  foreach ($usersList as $key => $user) {
    echo $user;
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


	<fieldset>
		<legend>Manage Users</legend>
    <form method="post" name="usersForm" id="usersForm" action="#">
    <p>username:password - each user should be on a new line</p>
		<textarea name="users" rows="10" cols="90" id="users"><?php readHtpasswords(); ?></textarea>
		<br />
    <p>To generate passwords for users, I strongly reccomend to use <a href="http://aspirine.org/htpasswd_en.html" target="_blank">THIS SITE</a>. You will need a password generated.</p>
		<input name="saveUsers" type="submit" id="saveUsers" value="Save htpasswrd file" />
  </form>
	</fieldset>
<br /><br />


  <fieldset >
    <legend>Some admin related settings:</legend>
    <form method="post" name="settingsForm" id="settingsForm" action="#">
    <label>Admin template:</label>
    <br />
    <select name="adminTemplate" id="adminTemplate" >
      <?php getTemplates("admin"); ?>
    </select>
    <br /><br />
    <input name="saveSettings" type="submit" id="saveSettings" value="Save these settings" />
    </form>
  </fieldset>
