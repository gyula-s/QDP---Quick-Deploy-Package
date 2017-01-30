<?php
/**
* @about: The file will allow the user, to change the individual settings of the languages. 
* these settings include the site name, description, and the error messages in the 404/401/403 errors.
* It also can be specified, what should the offline message be.
* 
* PHP version 5.4
*
* @version          1.0 - 26/01/2017
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

function getAvailableLanguages($siteSettings){
	foreach ($siteSettings['languages'] as $key => $language) {
    //will return something like this:
		echo "\n<option language='".$language."' ";
		echo ">".$language."</option>";
	}
}

$str_data = file_get_contents(siteRootFolder.DS.'content'.DS.$siteSettings["languages"][0].DS.'langSettings.json');
$langSettings = json_decode($str_data, true);
$availableLanguages = $siteSettings["languages"];
//when the save button pressed, store each data in the siteSettings array
?>

<fieldset>
	<legend>Add a new language</legend>
	<?php 
	if (isset($_POST["addNewLang"])){
		if (!file_exists(siteRootFolder.DS.'content'.DS.$_POST["countryCode"])){
			mkdir(siteRootFolder.DS.'content'.DS.$_POST["countryCode"]);
			mkdir(siteRootFolder.DS.'content'.DS.$_POST["countryCode"].DS."00.Home");
			file_put_contents(siteRootFolder.DS.'content'.DS.$_POST["countryCode"].DS.'langSettings.json', json_encode($langSettings, JSON_PRETTY_PRINT));
		}
		else
		{
			echo "<p>The language files were already on the server!</p>";
			echo "<p>At this moment, this language has been added to the available languages.</p>";
			echo "<p>If you wanted to delete and then re-create the language, first you have to remove the files from the server!</p>";
		}

	#here chekck if new language is already in the list
		if(!in_array($_POST["countryCode"], $siteSettings["languages"])){
			array_push($availableLanguages, $_POST["countryCode"]);
			$availableLanguages = array_values($availableLanguages);
			$siteSettings["languages"] = $availableLanguages;
			file_put_contents(siteRootFolder.DS.'siteSettings.json', json_encode($siteSettings, JSON_PRETTY_PRINT));
			echo "The language ".$_POST["countryCode"]." has been added to the site!";
		}
	}
	?>
	<form method="post" name="addNewLanguage" id="addNewLanguage">
		<div id="form">
			<p>

				<label>enter country code</label>
				<input required name="countryCode" type="text" id="countryCode" size="15" />


				<input name="addNewLang" type="submit" id="addNewLang" value="addNewLang" />
			</p>
		</div>
	</form>
</fieldset>
<br />
<fieldset>
	<legend>Change a language code</legend>
	<?php
	if (isset($_POST["changeLanguage"])){
		if (!file_exists(siteRootFolder.DS.'content'.DS.$_POST["newCountryCode"])){

			rename(siteRootFolder.DS.'content'.DS.$_POST["language"], siteRootFolder.DS.'content'.DS.$_POST["newCountryCode"]);
			$availableLanguages = array_diff($siteSettings["languages"], array($_POST['language']));
			array_push($availableLanguages, $_POST["newCountryCode"]);
			$availableLanguages = array_values($availableLanguages);

			$siteSettings["languages"] = $availableLanguages;
			file_put_contents(siteRootFolder.DS.'siteSettings.json', json_encode($siteSettings, JSON_PRETTY_PRINT));

			echo "Country code has been changed!";
		}
		else
		{
			echo "This language is already on the site! No change has been made";
		}
	}
	?>
	<form method="post" name="changeLanguage" id="changeLanguage">
		<div id="form">
			<p>
				If you have only one language installed, and that is not english, you might want to change the default en to your language.
				<br />
				Change <select name="language" id="language">
				<?php getAvailableLanguages($siteSettings); ?>
			</select>
			<label> to </label>
			<input required name="newCountryCode" type="text" id="newCountryCode" size="15" />
			<input name="changeLanguage" type="submit" id="changeLanguage" value="changeLanguage" />
		</p>
	</div>
</form>
</fieldset>
<br />
<fieldset>
	<legend>Remove a language</legend>
	<?php 
	if (isset($_POST["DELETE"])){
		echo "<p>For security reasons, you have to delete the content manually from the server.</p>";
		echo "<p>Now I'm going to remove the site from the list of available languages.</p>";

		$availableLanguages = array_diff($siteSettings["languages"], array($_POST['language']));
		$availableLanguages = array_values($availableLanguages);

		$siteSettings["languages"] = $availableLanguages;
		file_put_contents(siteRootFolder.DS.'siteSettings.json', json_encode($siteSettings, JSON_PRETTY_PRINT));
	}
	?>
	<form method="post" name="deleteLanguage" id="deleteLanguage">
		<div id="form">
			<p>
				<label>Language:</label>
				<br />
				<select name="language" id="language">
					<?php getAvailableLanguages($siteSettings); ?>
				</select>

				<input name="DELETE" type="submit" id="DELETE" value="DELETE" onclick="deleteConfirmation();" />
			</p>
		</div>
	</form>
</fieldset>
<script type="text/javascript">
//before doing anything to the file display a prompt. No accidents here! :)
function deleteConfirmation(){ 
	var link = document.getElementById=('delete');
	var confirm = prompt("Do you really want to delete this language? \nFor security reasons, you have to delete the content manually from the server. \n\nNow I'm going to remove the site from the list of available languages.\n\n\nTo confirm delete, please enter the word 'delete'");
	if (confirm == "delete"){
		alert("The language has been removed from the available languages.\n\n Don't forget do delete the files from the server as well!");
	} else {
				event.preventDefault(); //stop the default action of the button, thus the deleting php function will not be called.
				alert("Noting was deleted!");
			}			
		}

	</script>
