<?php
/**
* @about:This file will display the an error when required. 404/401/403
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
define('QDP', TRUE); //defines a variable, that is checked in all other included php files. If those php files are not called by the index, it will restrict access to them
define('DS', DIRECTORY_SEPARATOR); //replacing the "DIRECTORY_SEPARATOR" with "DS" - it's just easier to read
define('rootFolder', dirname(__FILE__)); //defining the rootfolder path

//if the install file exist, include that and stop.
if(file_exists(rootFolder.DS."install.php")){
	include(rootFolder.DS."install.php");
	die;
}

$str_data = file_get_contents(rootFolder.DS.'siteSettings.json');
$siteSettings = json_decode($str_data, true);

//if the site is offline, then display the offline message, and stop
if ($siteSettings["offline"]){
    echo $siteSettings["offlineMessage"];
    die;
}

//read variables from the URL
if (isset($_GET["content"])){
    $activeMenuItem = $_GET["content"];
} else {
    $activeMenuItem = "00.Home";
}

if (isset($_GET["article"])){
    $articleFileName = $_GET["article"];
} else {
    $articleFileName = "";
}

//include the template selector
include(rootFolder.DS."templateSelector.php");
?>
   