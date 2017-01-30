<?php 
/**
* @about: The contents of the html header will be included with this file.
* These elements in the header are required for proper functionality of the site.
* 
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

$str_lang_data = file_get_contents(rootFolder.DS.'content'.DS.siteLanguage.DS.'langSettings.json');
$langSettings = json_decode($str_lang_data, true);

?>

<title><?php echo $langSettings['siteName'] ?></title>
<meta name="description" content="<?php echo $langSettings['description']; ?>" />
<meta name="keywords" content="<?php echo $langSettings['keywords']; ?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	//this particular file is inserting the google analitics code.
	//If additional includes are required, you may include them here by referencing to the file
	//But remember, everything here, will be in the header. 
	//You might want to make your includes in your template file, instead here.
	include_once(rootFolder.DS.'plugins'.DS.'analyticstracking.php') 
?>
<script src='https://www.google.com/recaptcha/api.js'></script>