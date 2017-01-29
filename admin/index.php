<?php
/**
* @about: This is the main landing index page for the backend. 
* 
* PHP version 5.5
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

if (version_compare(phpversion(), '5.5.0', '<')) {
    die("<h4>PHP version isn't high enough.<br /> Minimum PHP version required is 5.5.0</h4>");
}
session_start();
session_regenerate_id();
define('QDP', TRUE); //defines a variable, that is checked in all other included php files. If those php files are not called by the index, it will restrict access to them

//defining various locations on the site structure
define('adminRootFolder', dirname(__DIR__).'/admin');
define('siteRootFolder', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);
define('siteDomain', pathUrl());

//reading and storing the data regarding the siteSettings and adminSettings from the respective json files

$str_data = file_get_contents(siteRootFolder.DS.'siteSettings.json');
$siteSettings = json_decode($str_data, true);

$str_data = file_get_contents(siteRootFolder.DS.'content'.DS.$siteSettings["languages"][0].DS.'langSettings.json');
$langSettings = json_decode($str_data, true);

$str_admindata = file_get_contents(adminRootFolder.'/adminSettings.json');
$adminSettings = json_decode($str_admindata, true);

function checkUserAuth(){
    return (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true);
}

if(!checkUserAuth()){
    include_once(dirname(__DIR__).'/admin/authentication/login.php');
    exit();
}

//reading and storing variables from the URL
if (isset($_GET["cat"])){
    $activeMenuItem = $_GET["cat"];
} else {
    $activeMenuItem = "00.Home";
}
if (isset($_GET["menuItem"])){
    define ('menuItem', $_GET["menuItem"]);
} else {
    define ('menuItem', null);
}
//get the template for the site
$template = $adminSettings['adminTemplate'];
include(".".DS."template".DS.$template.DS."index.php");

//function written by fallinov as it can be found on:
//http://stackoverflow.com/questions/18220977/how-do-i-get-the-root-url-of-the-site
function pathUrl($dir = __DIR__){

    $root = "";
    $dir = realpath($dir);

    //HTTPS or HTTP
    $root .= !empty($_SERVER['HTTPS']) ? 'https' : 'http';

    //HOST
    $root .= '://' . $_SERVER['HTTP_HOST'];

    //ALIAS
    if($_SERVER['CONTEXT_PREFIX']) {
        $root .= $_SERVER['CONTEXT_PREFIX'];
        $root .= substr($dir, strlen($_SERVER[ 'CONTEXT_DOCUMENT_ROOT' ]));
    } else {
        $root .= substr($dir, strlen($_SERVER[ 'DOCUMENT_ROOT' ]));
    }
    $root .= '/';
    return $root;
}
?>