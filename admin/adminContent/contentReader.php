<?php
defined('QDP') or die('Restricted access');

function readContent($folder){
    
    if ($folder == "root" or $folder == "wwwroot" or $folder == ""){
    	$folder = "00.Home";
    }
    	
    $location = adminRootFolder."/adminContent/".$folder;

    if (file_exists($location)){
        $includeList = array_diff(scandir($location), array('..', '.',));

        foreach ($includeList as $item => $itemValue) { //removing any folders from the array, just in case.
                    if (is_dir($location.DIRECTORY_SEPARATOR.$itemValue)){
                        unset($includeList[$item]);
                    }
                }
        foreach ($includeList as $key => $value) {
            include_once(adminRootFolder.'/adminContent/'.$folder.'/'.$value);
        }
    }
}
?>