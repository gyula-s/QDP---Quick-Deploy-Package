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

function getLanguages(){
	$languages = array(
		"Afghanistan"=>"af",
		"Aland Islands"=>"ax",
		"Albania"=>"al",
		"Algeria"=>"dz",
		"American Samoa"=>"as",
		"Andorra"=>"ad",
		"Angola"=>"ao",
		"Anguilla"=>"ai",
		"Antarctica"=>"aq",
		"Antigua and Barbuda"=>"ag",
		"Argentina"=>"ar",
		"Armenia"=>"am",
		"Aruba"=>"aw",
		"Australia"=>"au",
		"Austria"=>"at",
		"Azerbaijan"=>"az",
		"Bahamas"=>"bs",
		"Bahrain"=>"bh",
		"Bangladesh"=>"bd",
		"Barbados"=>"bb",
		"Belarus"=>"by",
		"Belgium"=>"be",
		"Belize"=>"bz",
		"Benin"=>"bj",
		"Bermuda"=>"bm",
		"Bhutan"=>"bt",
		"Bolivia"=>"bo",
		"Bosnia and Herzegovina"=>"ba",
		"Botswana"=>"bw",
		"Bouvet Island"=>"bv",
		"Brazil"=>"br",
		"British Virgin Islands"=>"vg",
		"British Indian Ocean Territory"=>"io",
		"Brunei Darussalam"=>"bn",
		"Bulgaria"=>"bg",
		"Burkina Faso"=>"bf",
		"Burundi"=>"bi",
		"Cambodia"=>"kh",
		"Cameroon"=>"cm",
		"Canada"=>"ca",
		"Cape Verde"=>"cv",
		"Cayman Islands"=>"ky",
		"Central African Republic"=>"cf",
		"Chad"=>"td",
		"Chile"=>"cl",
		"China"=>"cn",
		"Hong Kong, Special Administrative Region of China"=>"hk",
		"Macao, Special Administrative Region of China"=>"mo",
		"Christmas Island"=>"cx",
		"Cocos (Keeling) Islands"=>"cc",
		"Colombia"=>"co",
		"Comoros"=>"km",
		"Congo (Brazzaville)"=>"cg",
		"Congo, Democratic Republic of the"=>"cd",
		"Cook Islands"=>"ck",
		"Costa Rica"=>"cr",
		"Côte d'Ivoire"=>"ci",
		"Croatia"=>"hr",
		"Cuba"=>"cu",
		"Cyprus"=>"cy",
		"Czech Republic"=>"cz",
		"Denmark"=>"dk",
		"Djibouti"=>"dj",
		"Dominica"=>"dm",
		"Dominican Republic"=>"do",
		"Ecuador"=>"ec",
		"Egypt"=>"eg",
		"El Salvador"=>"sv",
		"Equatorial Guinea"=>"gq",
		"Eritrea"=>"er",
		"Estonia"=>"ee",
		"Ethiopia"=>"et",
		"Falkland Islands (Malvinas)"=>"fk",
		"Faroe Islands"=>"fo",
		"Fiji"=>"fj",
		"Finland"=>"fi",
		"France"=>"fr",
		"French Guiana"=>"gf",
		"French Polynesia"=>"pf",
		"French Southern Territories"=>"tf",
		"Gabon"=>"ga",
		"Gambia"=>"gm",
		"Georgia"=>"ge",
		"Germany"=>"de",
		"Ghana"=>"gh",
		"Gibraltar"=>"gi",
		"Greece"=>"gr",
		"Greenland"=>"gl",
		"Grenada"=>"gd",
		"Guadeloupe"=>"gp",
		"Guam"=>"gu",
		"Guatemala"=>"gt",
		"Guernsey"=>"gg",
		"Guinea"=>"gn",
		"Guinea-Bissau"=>"gw",
		"Guyana"=>"gy",
		"Haiti"=>"ht",
		"Heard Island and Mcdonald Islands"=>"hm",
		"Holy See (Vatican City State)"=>"va",
		"Honduras"=>"hn",
		"Hungary"=>"hu",
		"Iceland"=>"is",
		"India"=>"in",
		"Indonesia"=>"id",
		"Iran, Islamic Republic of"=>"ir",
		"Iraq"=>"iq",
		"Ireland"=>"ie",
		"Isle of Man"=>"im",
		"Israel"=>"il",
		"Italy"=>"it",
		"Jamaica"=>"jm",
		"Japan"=>"jp",
		"Jersey"=>"je",
		"Jordan"=>"jo",
		"Kazakhstan"=>"kz",
		"Kenya"=>"ke",
		"Kiribati"=>"ki",
		"Korea, Democratic People's Republic of"=>"kp",
		"Korea, Republic of"=>"kr",
		"Kuwait"=>"kw",
		"Kyrgyzstan"=>"kg",
		"Lao PDR"=>"la",
		"Latvia"=>"lv",
		"Lebanon"=>"lb",
		"Lesotho"=>"ls",
		"Liberia"=>"lr",
		"Libya"=>"ly",
		"Liechtenstein"=>"li",
		"Lithuania"=>"lt",
		"Luxembourg"=>"lu",
		"Macedonia, Republic of"=>"mk",
		"Madagascar"=>"mg",
		"Malawi"=>"mw",
		"Malaysia"=>"my",
		"Maldives"=>"mv",
		"Mali"=>"ml",
		"Malta"=>"mt",
		"Marshall Islands"=>"mh",
		"Martinique"=>"mq",
		"Mauritania"=>"mr",
		"Mauritius"=>"mu",
		"Mayotte"=>"yt",
		"Mexico"=>"mx",
		"Micronesia, Federated States of"=>"fm",
		"Moldova"=>"md",
		"Monaco"=>"mc",
		"Mongolia"=>"mn",
		"Montenegro"=>"me",
		"Montserrat"=>"ms",
		"Morocco"=>"ma",
		"Mozambique"=>"mz",
		"Myanmar"=>"mm",
		"Namibia"=>"na",
		"Nauru"=>"nr",
		"Nepal"=>"np",
		"Netherlands"=>"nl",
		"Netherlands Antilles"=>"an",
		"New Caledonia"=>"nc",
		"New Zealand"=>"nz",
		"Nicaragua"=>"ni",
		"Niger"=>"ne",
		"Nigeria"=>"ng",
		"Niue"=>"nu",
		"Norfolk Island"=>"nf",
		"Northern Mariana Islands"=>"mp",
		"Norway"=>"no",
		"Oman"=>"om",
		"Pakistan"=>"pk",
		"Palau"=>"pw",
		"Palestinian Territory, Occupied"=>"ps",
		"Panama"=>"pa",
		"Papua New Guinea"=>"pg",
		"Paraguay"=>"py",
		"Peru"=>"pe",
		"Philippines"=>"ph",
		"Pitcairn"=>"pn",
		"Poland"=>"pl",
		"Portugal"=>"pt",
		"Puerto Rico"=>"pr",
		"Qatar"=>"qa",
		"Réunion"=>"re",
		"Romania"=>"ro",
		"Russian Federation"=>"ru",
		"Rwanda"=>"rw",
		"Saint-Barthélemy"=>"bl",
		"Saint Helena"=>"sh",
		"Saint Kitts and Nevis"=>"kn",
		"Saint Lucia"=>"lc",
		"Saint-Martin (French part)"=>"mf",
		"Saint Pierre and Miquelon"=>"pm",
		"Saint Vincent and Grenadines"=>"vc",
		"Samoa"=>"ws",
		"San Marino"=>"sm",
		"Sao Tome and Principe"=>"st",
		"Saudi Arabia"=>"sa",
		"Senegal"=>"sn",
		"Serbia"=>"rs",
		"Seychelles"=>"sc",
		"Sierra Leone"=>"sl",
		"Singapore"=>"sg",
		"Slovakia"=>"sk",
		"Slovenia"=>"si",
		"Solomon Islands"=>"sb",
		"Somalia"=>"so",
		"South Africa"=>"za",
		"South Georgia and the South Sandwich Islands"=>"gs",
		"South Sudan"=>"ss",
		"Spain"=>"es",
		"Sri Lanka"=>"lk",
		"Sudan"=>"sd",
		"Suriname *"=>"sr",
		"Svalbard and Jan Mayen Islands"=>"sj",
		"Swaziland"=>"sz",
		"Sweden"=>"se",
		"Switzerland"=>"ch",
		"Syrian Arab Republic (Syria)"=>"sy",
		"Taiwan, Republic of China"=>"tw",
		"Tajikistan"=>"tj",
		"Tanzania *, United Republic of"=>"tz",
		"Thailand"=>"th",
		"Timor-Leste"=>"tl",
		"Togo"=>"tg",
		"Tokelau"=>"tk",
		"Tonga"=>"to",
		"Trinidad and Tobago"=>"tt",
		"Tunisia"=>"tn",
		"Turkey"=>"tr",
		"Turkmenistan"=>"tm",
		"Turks and Caicos Islands"=>"tc",
		"Tuvalu"=>"tv",
		"Uganda"=>"ug",
		"Ukraine"=>"ua",
		"United Arab Emirates"=>"ae",
		"United Kingdom"=>"gb",
		"United States of America"=>"us",
		"United States Minor Outlying Islands"=>"um",
		"Uruguay"=>"uy",
		"Uzbekistan"=>"uz",
		"Vanuatu"=>"vu",
		"Venezuela (Bolivarian Republic of)"=>"ve",
		"Viet Nam"=>"vn",
		"Virgin Islands, US"=>"vi",
		"Wallis and Futuna Islands"=>"wf",
		"Western Sahara"=>"eh",
		"Yemen"=>"ye",
		"Zambia"=>"zm",
		"Zimbabwe"=>"zw"
		);

foreach ($languages as $key => $value) {
	echo "\n<option value='".$value."' ";
	echo ">".$key." - ".$value."</option>";
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
		if (!file_exists(siteRootFolder.DS.'content'.DS.$_POST["defaultLanguage"])){
			mkdir(siteRootFolder.DS.'content'.DS.$_POST["defaultLanguage"]);
			mkdir(siteRootFolder.DS.'content'.DS.$_POST["defaultLanguage"].DS."00.Home");
			file_put_contents(siteRootFolder.DS.'content'.DS.$_POST["defaultLanguage"].DS.'langSettings.json', json_encode($langSettings, JSON_PRETTY_PRINT));
		}
		else
		{
			echo "<p>The language files were already on the server!</p>";
			echo "<p>At this moment, this language has been added to the available languages.</p>";
			echo "<p>If you wanted to delete and then re-create the language, first you have to remove the files from the server!</p>";
		}

	#here chekck if new language is already in the list
		if(!in_array($_POST["defaultLanguage"], $siteSettings["languages"])){
			array_push($availableLanguages, $_POST["defaultLanguage"]);
			$availableLanguages = array_values($availableLanguages);
			$siteSettings["languages"] = $availableLanguages;
			file_put_contents(siteRootFolder.DS.'siteSettings.json', json_encode($siteSettings, JSON_PRETTY_PRINT));
			echo "The language ".$_POST["defaultLanguage"]." has been added to the site!";
		}
	}
	?>
	<form method="post" name="addNewLanguage" id="addNewLanguage">
		<div id="form">
			<p>

				<label>Select the language you want to add</label>
				<select name="defaultLanguage" >
					<?php getLanguages(); ?>
				</select>
				<input name="addNewLang" type="submit" id="addNewLang" value="addNewLang" />
			</p>
		</div>
	</form>
</fieldset>
<br />
<br />
<fieldset>
	<legend>Remove a language</legend>
	<?php 
	if (isset($_POST["DELETE"])){
		if (count($siteSettings["languages"])>1){
			echo "<p>For security reasons, you have to delete the content manually from the server.</p>";
			echo "<p>Now I'm going to remove the site from the list of available languages.</p>";

			$availableLanguages = array_diff($siteSettings["languages"], array($_POST['language']));
			$availableLanguages = array_values($availableLanguages);

			$siteSettings["languages"] = $availableLanguages;
			file_put_contents(siteRootFolder.DS.'siteSettings.json', json_encode($siteSettings, JSON_PRETTY_PRINT));
		}
		else
		{
			echo "You need to leave at least one language!";
		}
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
	<!-- global settings form -->
