<?php
/**
* @about: The current script will scan each adminContent folder for files, and will include them in the page.
* This way, there is no need to hard code each element in the menu, and what file should be included. 
* If extra functionality is required from a script, might be enough to create a new php file with the new code in it.
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

function readContent($folder){
    
    //this file is called with a path from the index. If the path is either root, wwwroot, or "", assume, that the HOME folder is needed.
    if ($folder == "root" or $folder == "wwwroot" or $folder == ""){
    	$folder = "00.Home";
    }
    
    //the location is the actual path	
    $location = adminRootFolder.DS."adminContent".DS.$folder;

    //if the path exists, scan the directory, remove any folders from the array, and include the files.
    if (file_exists($location)){
        $includeList = array_diff(scandir($location), array('..', '.',));

        foreach ($includeList as $item => $itemValue) { //removing any folders from the array, just in case.
            if (is_dir($location.DS.$itemValue)){
                unset($includeList[$item]);
            }
        }
        foreach ($includeList as $key => $value) {
            include_once(adminRootFolder.DS.'adminContent'.DS.$folder.DS.$value);
        }
    }
}
?>