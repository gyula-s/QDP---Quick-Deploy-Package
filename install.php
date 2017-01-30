<?php 
/**
* @about:This file is used to set up a new QDP instance for the first time.
* 
* 
* PHP version 5.5.0
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

defined('QDP') or die('Restricted access'); //checks whether the index.php called this file or it was opened on its own.
define('adminRootFolder', rootFolder.DS.'admin'); //various variables and arrays for later use
$siteSettings = array();
$langSettings = array();
$users = array();

//in cases when the install file is used to recover from bad configuration, the rest of the site settings are saved.
if (file_exists(rootFolder.DS.'siteSettings.json')){
	$str_data = file_get_contents(rootFolder.DS.'siteSettings.json');
	$siteSettings = json_decode($str_data, true);
	if (file_exists(rootFolder.DS.'content'.DS.$siteSettings['languages'][0].DS.'langSettings.json')){
		$str_langData = file_get_contents(rootFolder.DS.'content'.DS.$siteSettings['languages'][0].DS.'langSettings.json');
		$langSettings = json_decode($str_langData, true);
	}
}

//when the there is no settings file, create one with these default values.
if(empty($siteSettings)){	
	$siteSettings['siteFromYear'] = date("Y");
	$siteSettings['timezone'] = "Europe/London";
	$siteSettings['languages'] = array();
	$siteSettings['template'] = "default";
	$siteSettings['contactEmail'] = "changeme@qdpsite.com";
	$siteSettings['outgoingEmailFrom'] = "changeme@qdpsite.com";
	$siteSettings['recaptchaSiteKey'] = "";
	$siteSettings['recaptchaSecret'] = "";
	$siteSettings['offline'] = false;
}

//when the there is no settings file, create one with these default values.
if(empty($langSettings)){
	$langSettings['siteName'] = "";
	$langSettings['homeName'] = "Home";
	$langSettings['description'] = "QDP - the database free Quick Deploy Package";
	$langSettings['keywords'] = "";
	$langSettings['404'] = "<p>This page you were trying to reach at this address doesn't seem to exist. This is usually the result of a bad or outdated link. We apologize for any inconvenience.</p>";
	$langSettings['401'] = "<p>You don't have necessary credentials to display this page.</p>";
	$langSettings['403'] = "<p>You don't have necessary permissions for this page.</p>";
	$langSettings['errNoName'] = "I'm sorry, I need your name!";
	$langSettings['errNoEmail'] = "I'm sorry, no email address was entered!";
	$langSettings['errNotValidEmail'] = "I'm sorry. The email doesn't appear to be valid!";
	$langSettings['errNoSubject'] = "I'm sorry, there is no subject!";
	$langSettings['errNoMessage'] = "I'm sorry. There was no message!";
	$langSettings['emailSubject'] = "Contact form on ";
	$langSettings['emailBody'] = "A new message from: ";
	$langSettings['confirmSending'] = "Thank you! Message was sent successfully!";
	$langSettings['formName'] = "Full name:";
	$langSettings['formEmail'] = "Your email address:";
	$langSettings['formSubject'] = "Subject:";
	$langSettings['formMessage'] = "Message:";
	$langSettings['formRequestCopy'] = "Check this box, if you would like a copy of this message:";
	$langSettings['formAllFieldsReq'] = "All fields are required!";
	$langSettings['formSend'] = "Send message";
	$langSettings['offlineMessage'] = "<h1>The website is under maintenance.</h1>";
}

//this placeholder is inserted in the text fiels when they are empty
$siteNamePlaceholder = "";
$userNamePlaceholder = "";
$passwordPlaceholder = "";

function getLanguages(){ //function to list all available languages to use on the site. in this case, the original default language is determined
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

foreach ($languages as $key => $value) { //this part formats the data and feeds it into the form selection
	echo "\n<option value='".$value."' ";
	if ($value == "gb"){
		echo ('selected="selected"');
	}
	echo ">".$key." - ".$value."</option>";
}
}


if(isset($_POST['save'])){ 
	$userName = $_POST['user']; //save username and password
	$password = $_POST['pass'];
	$repeatPass = $_POST['repass'];

	array_push($siteSettings['languages'], $_POST['defaultLanguage']); //get the selected default language
	$langSettings['siteName'] = $_POST['siteName'];

//if passwords are matching, the necessary folders are created and various settings files are placed. In the end the installation script is deleted and the page is refreshed
	if ($password == $repeatPass && strlen($_POST['siteName'])){

		//creating folders for the default language. but only if they are not present already
		if(!is_dir(rootFolder.DS.'content'.DS.$siteSettings['languages'][0])){
			mkdir(rootFolder.DS.'content'.DS.$siteSettings['languages'][0]);
			mkdir(rootFolder.DS.'content'.DS.$siteSettings['languages'][0].DS.'00.Home');
		}

		//hashing the password
		$users[strtolower($_POST['user'])] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		
		//saving the user credentials and settings to the file system
		file_put_contents(adminRootFolder.DS.'authentication'.DS.'users.json', json_encode($users, JSON_PRETTY_PRINT)); //users file
		file_put_contents(rootFolder.DS.'siteSettings.json', json_encode($siteSettings, JSON_PRETTY_PRINT)); //site settings file
		file_put_contents(rootFolder.DS.'content'.DS.$siteSettings['languages'][0].DS.'langSettings.json', json_encode($langSettings, JSON_PRETTY_PRINT)); //language settings

		//removing the install file and refreshing the page
		unlink(rootFolder.DS.'install.php');
		header("Refresh:0");	
		
	}
	elseif ($password != $repeatPass)
	{
		echo "Passwords don't match!";
	}
	else
	{
		echo "Something went wrong! Check the details and try again!";
	}
}
?>

<!DOCTYPE html>

<head>	
	<title>QDP setup</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		#container{
			width: 800px;
			margin: auto;
			margin-top: 30px;
		}

		input[type=text], input[type=password], input[type=number], input[type=textarea], select {
			width: 80%;
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

	</style>	
</head>

<body>
	<div id="container">
		<h1>QDP installation</h1>
		<div id="settingsForm">
			<form method="post" >
				<h2>I just need a few things, before we can go on</h2>
				<p>
					<label >Please enter the name of the site:</label>
					<br />
					<input required name="siteName" type="text" size="50" value="<?php echo $langSettings['siteName']; ?>" placeholder="The name of the Site (it may be changed later)"/>
				</p>
				<p>
					<label>Choose the default language of the site</label>
					<br />
					<select name="defaultLanguage" >
						<?php getLanguages(); ?>
					</select>
				</p>
				<br />
				<fieldset>
					<legend>Set up an admin account</legend>
					<p>
						<input type="text" name="user" placeholder="Email address" required="required"/>
						<br />
						<input type="password" name="pass" placeholder="Password" required="required" />
						<br />
						<input type="password" name="repass" placeholder="Repeat password" required="required" />
					</fieldset>
					<p>
						<label>
							To access the admin page, please visit "yourdomain.com/admin".<br />
						</label>
						<input type="submit" name="save" value="Save settings">Save</input>
					</p>
				</form>
			</div>
			<div id="firebaseInstructions">
				<p>You may set up additional accounts in the administrator backend, furthermore you may find more information on the wiki page:</p>
				<a href="https://github.com/soosgyul/QDP---Quick-Deploy-Package/wiki">QDP Wiki</a>
			</div>
		</div>
	</body>
	</html>