<?php
/**
* @about: This script is responsible to show the admin the available languages
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


$str_data = file_get_contents(siteRootFolder.DS.'siteSettings.json');
$siteSettings = json_decode($str_data, true);

define ('languageToEdit', languageSelector($siteSettings));


function languageSelector($siteSettings){

    $known_langs = $siteSettings["languages"];
    $preferredLang = $siteSettings["languages"][0]; #if none of the preferred languages are available, just use the first available
    # first we see if the url requests a new language to be displayed

    # if no new request for a language is set, we check a previous cookie
    if(isset($_COOKIE['lang'])) {
        $preferredLang = $_COOKIE["lang"];
        return $preferredLang;
    }
    
    return $preferredLang;
}

function setTheLanguageCookie($language){
    setcookie('lang', $language);
}

function getAvailableLanguages($siteSettings){
	foreach ($siteSettings['languages'] as $key => $language) {
		echo "\n<option language='".$language."' ";
		if($language == languageToEdit){
			echo ('selected="selected"');
		}
		echo ">".$language."</option>";
	}
}

if (isset($_POST["select"])){
	setTheLanguageCookie($_POST["language"]);
	header("Refresh:0");
}

?>

<form method="post" name="selectLanguageForm" id="selectLanguageForm">
    <div id="form">
        <p>
            <label>Select the language you wish to modify:</label>
            <br />
            <select name="language" id="language" >
                <?php getAvailableLanguages($siteSettings); ?>
            </select>

            <input name="select" type="submit" id="select" value="select" />
        </p>
    </div>
</form>