<?php
/**
* @about:This file will display the page footer
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

$str_data = file_get_contents(rootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

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
echo $siteSettings['siteName'];
echo '</p>';
?>

<p style="color:grey; font-size:0.8em;">Site powered by <a style="text-decoration:none; color:grey;" href="http://gyulasoos.com" target="_blank">QDP</a></p>
