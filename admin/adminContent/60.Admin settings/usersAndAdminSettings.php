<?php
/**
* @about: The file will allow the user, to change the admin settings of the site. 
* these settings include the admin template and admin login settings
* As a secondary function, it is possible to create users and to change passwords of existing users.
*
* 
* PHP version 5.5
*
* @version          2.0 - 30/01/2017
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
$str_admindata = file_get_contents(adminRootFolder.DS.'adminSettings.json');
$adminSettings = json_decode($str_admindata, true);

$str_userdata = file_get_contents(adminRootFolder.'/authentication/users.json');
$users = json_decode($str_userdata, true);

$adminTemplate = $adminSettings['adminTemplate'];

if (isset($_POST["saveSettings"])){
 $adminSettings['adminTemplate'] = $_POST["adminTemplate"];
 file_put_contents(adminRootFolder.DS.'adminSettings.json', json_encode($adminSettings, JSON_PRETTY_PRINT));
 header("Refresh:0");
 
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
<style type="text/css">
  input[type=text], input[type=password], select {
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
</style>

<fieldset>
  <?php
  if (isset($_POST['addUser'])){
    if (!array_key_exists($_POST['user'], $users) && $_POST['pass'] == $_POST['repass']){
      $users[strtolower($_POST['user'])] = password_hash($_POST['pass'], PASSWORD_DEFAULT);

      file_put_contents(adminRootFolder.'/authentication/users.json', json_encode($users, JSON_PRETTY_PRINT));
      echo strtolower($_POST['user'])." added!";
    }
    elseif (array_key_exists($_POST['user'], $users)){
      echo "User already present!";
    }
    elseif ($_POST['pass'] != $_POST['repass'])
    {
      echo "passwords don't match";
    }
  }
  ?>
  <legend>Add User</legend>
  <form method="post">
    <input type="text" name="user" placeholder="Email address" required="required"/>
    <br />
    <input type="password" name="pass" placeholder="Password" required="required" />
    <br />
    <input type="password" name="repass" placeholder="Repeat password" required="required" />
    <br />
    <input name="addUser" type="submit" value="Add a user" />
  </form>
</fieldset>
<br /><br />


<fieldset>
  <?php 
  if (isset($_POST['changePasswd'])){
    if (array_key_exists($_POST['user'], $users) && $_POST['newPass'] == $_POST['repass'] && password_verify($_POST['pass'], $users[$_POST['user']])){
    $users[strtolower($_POST['user'])] = password_hash($_POST['newPass'], PASSWORD_DEFAULT); //the lowercase 

    file_put_contents(adminRootFolder.'/authentication/users.json', json_encode($users, JSON_PRETTY_PRINT));
    echo "Password for user: ".strtolower($_POST['user'])." has been changed!";
  }
  elseif (!array_key_exists($_POST['user'], $users))
  {
    echo "There is no such user!";
  }
  elseif ($_POST['newPass'] != $_POST['repass']){
    echo "The new passwords don't match!";
  }
  elseif (!password_verify($_POST['pass'], $users[$_POST['user']])){
    echo "The old password is incorrect!";
  }
}

?>
<legend>Change User Password</legend>
<form method="post">
  <input type="text" name="user" placeholder="Email address" required="required"/>
  <br />
  <input type="password" name="pass" placeholder="Old password" required="required" />
  <br />
  <input type="password" name="newPass" placeholder="Password" required="required" />
  <br />
  <input type="password" name="repass" placeholder="Repeat password" required="required" />
  <br />
  <input name="changePasswd" type="submit" value="Change User Password" />
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
    <input name="saveSettings" type="submit" value="Save these settings" />
  </form>
</fieldset>
