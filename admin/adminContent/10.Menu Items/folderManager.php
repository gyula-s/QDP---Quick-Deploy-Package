<?php 
/**
* @about: The file will list all available menu items / folders in the content folder.
* 
* 
* PHP version 5.4
*
* @version 			2.0 - 30/01/2017
* @package 			This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright 		(C) 2017 Gyula Soós
* @license 			This program is free software: you can redistribute it and/or modify
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


//siteRootFolder, and adminRootFolder already defined
defined('QDP') or die("Rerstricted access");

include(adminRootFolder.'/helpers/languageSelector.php'); 

$str_data = file_get_contents(adminRootFolder.DS.'adminSettings.json');
$siteSettings = json_decode($str_data, true);

define('contentPath', siteRootFolder.DS.'content'.DS.languageToEdit);

//store the variables from the URL if any
if (isset($_GET["path"])){
	$path = $_GET["path"];
} else {
	$path = "/";
}

if (isset($_GET["menuItem"])){
	$menuItem = $_GET["menuItem"];
} else {
	$menuItem = "/";
}

//create the table rows and data 
function populateTable(){
	$foldersInContent = array_diff(scandir(contentPath), array('..', '.','langSettings.json')); //this is a file that is present in every language folder, and it is excluded this way.
	foreach ($foldersInContent as $key => $value) {
		list($order, $menuItem) = explode(".", $value);
		echo "<tr>";
		echo "<td class='tableItem'>";
		echo linkBuilder(null,$value);
		echo "</td>";
		getSubItems($value);
		echo "</tr>";		
	}
}

//scan for the folders and subfolders (1 level down) in the content folder
function getSubItems($path){
	$subitems = array_diff(scandir(contentPath.DS.$path), array('..', '.'));
	foreach ($subitems as $keys => $values) {
		if (!is_dir(contentPath.DS.$path.DS.$values)){
			unset($subitems[$keys]);
		}
	}
	foreach ($subitems as $key => $value) {		
		echo "<td class='tableSubitem'>";
		echo linkBuilder($path,$value);//subitem function comes here
		echo "</td>";
	}		
}

//create links for each menu item. The links will generate a special URL that holds the variables.
function linkBuilder($path, $argument){
	echo "<a href='";
	echo siteDomain.'index.php?cat=10.Menu+Items&amp;menuItem='.urlencode($path).'/'.urlencode($argument);
	echo "'>";
	echo $argument;
	echo "</a>";
}
?>


<table id="t01">

	<caption>Click on the menu item to rename or delete. Or start typing in the form below for a new menu item.</caption>
	<tr>
		<th>Menu Item</th>
		<th>SubItems</th>
	</tr>
	<?php populateTable(); ?>
</table>


<?php 
	//inlcude the file that will handle the creating, renaming and deleting options
include(adminRootFolder.DS.'adminContent'.DS.'10.Menu Items'.DS.'actions'.DS.'createOrModify.php'); 
?>
