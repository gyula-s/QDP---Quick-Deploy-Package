<?php
/**
* @about:This file will display the page footer
* 
* 
* 
* PHP version 5.4
*
* @version          2.0 - 20/01/2017
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

$str_data = file_get_contents(rootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

$str_lang_data = file_get_contents(rootFolder.DS.'content'.DS.siteLanguage.DS.'langSettings.json');
$langSettings = json_decode($str_lang_data, true);

date_default_timezone_set($siteSettings["timezone"]);

$year = date("Y");
$yearStart = $siteSettings['siteFromYear'];

//if site from year is set up, the following format will be used "2004-2016"
echo '<p>&copy; ';
if ($year > $yearStart && !empty($yearStart)) {
	echo $yearStart.' - ';
}
echo $year;
echo ' - ';
echo $langSettings['siteName'];
echo '</p>';
?>

<p style="color:grey; font-size:0.8em;">Site powered by <a style="text-decoration:none; color:grey;" href="https://github.com/soosgyul/QDP---Quick-Deploy-Package" target="_blank">QDP</a></p>
