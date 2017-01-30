<?php
/**
* @about:This is the main index file of the page. All frontend is displayed though this file.
* 
* 
* PHP version 5.4
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
define('QDP', TRUE); //defines a variable, that is checked in all other included php files. If those php files are not called by the index, it will restrict access to them
define('DS', DIRECTORY_SEPARATOR); //replacing the "DIRECTORY_SEPARATOR" with "DS" - it's just easier to read
define('rootFolder', dirname(__FILE__)); //defining the rootfolder path
define('siteDomain', pathUrl());

//if the install file exist, include that and stop.
if(file_exists(rootFolder.DS."install.php")){
	include(rootFolder.DS."install.php");
	die;
}

//read the necessary settings from sitesettings
$str_data = file_get_contents(rootFolder.DS.'siteSettings.json');
$siteSettings = json_decode($str_data, true);

//when everything is present, get the required language and then the settins from its own setting file
define('siteLanguage', languageSelector($siteSettings));
setTheLanguageCookie(siteLanguage);

function setTheLanguageCookie($language){
    setcookie('lang', $language);
}

$str_lang_data = file_get_contents(rootFolder.DS.'content'.DS.siteLanguage.DS.'langSettings.json');
$langSettings = json_decode($str_lang_data, true);

//if the site is offline, then display the offline message, and stop
if ($siteSettings["offline"]){
    echo $langSettings["offlineMessage"];
    die;
}

//read variables from the URL
if (isset($_GET["content"])){
    $activeMenuItem = $_GET["content"];
} else {
    $activeMenuItem = "00.".$langSettings["homeName"]; //the actual name of the home folder is specified in each langSettings.json file
}

if (isset($_GET["article"])){
    $articleFileName = $_GET["article"];
} else {
    $articleFileName = "";
}

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

function languageSelector($siteSettings){ //function to determine which language should be shown to the user
    $known_langs = $siteSettings["languages"];
    $preferredLang = $siteSettings["languages"][0]; #if none of the preferred languages are available, just use the first available
    # first we see if the url requests a new language to be displayed
    if (isset($_GET["lang"])){
        $lang = $_GET["lang"];
        if (in_array($lang, $known_langs)) {
            $preferredLang = $lang;
        }
        return $preferredLang;
    }

    # if no new request for a language is set, we check a previous cookie
    elseif(isset($_COOKIE['lang'])) {
        $preferredLang = $_COOKIE["lang"];
        return $preferredLang;
    }
    
    # then detect the preferred language as told by the browser //http://stackoverflow.com/questions/3770513/detect-browser-language-in-php - Oct 11 '14 at 18:28 Darryl
    elseif (empty($preferredLang)){        
        $user_pref_langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

        foreach($user_pref_langs as $idx => $lang) {
            $lang = substr($lang, 0, 2);
            if (in_array($lang, $known_langs)) {
                $preferredLang = $lang;
                return $preferredLang;
            }
        }
    }
    return $preferredLang;
}

//this will include the index file of a template
$template = $siteSettings['template'];
include (rootFolder.DS.'templates'.DS.$template.DS.'index.php');
?>
