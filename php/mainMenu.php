<?php
defined('QDP') or die('Restricted access');
function createMenu($activePage){
   
    $dir = array_slice(scandir(rootFolder.'/content'),2); //scan the main content folder and store all 1st level folders
    echo "<ul id='menu'>\n"; //this is the start of the unordered list
    foreach ($dir as $key => $value) { //for each folder, check if there are subfolders
        if (is_dir(rootFolder.'/content/'.$value)){ //if a folder is found in a subfolder

    $lookForFiles = array_slice(scandir(rootFolder.'/content/'.$value),2);         //scan for every folder inside the parent   
            foreach ($lookForFiles as $files => $file) { //remove the entries that are folders
                if (is_dir(rootFolder.'/content/'.$value.DIRECTORY_SEPARATOR.$file)){
                    unset($lookForFiles[$files]);
                }
            }

            if ($value == "00.Home"){//lay down the start of the li tag
                echo "\t\t\t<li><a href='./'".isActive($activePage, $value).'>'.substr($value, 3)."</a>";
            } elseif (count($lookForFiles) == 0){
                    echo "\t\t\t<li class='notARealLink'>".isActive($activePage, $value).substr($value, 3);
            } else {
                echo "\t\t\t<li><a href='./index.php?content=".urlencode($value)."'".isActive($activePage, $value).">".substr($value, 3)."</a>";
            }
            
            $subdir = array_slice(scandir(rootFolder.'/content/'.$value),2);         //scan for every folder inside the parent   
            foreach ($subdir as $item => $itemValue) { //remove the entries that are not folders
                if (!is_dir(rootFolder.'/content/'.$value.DIRECTORY_SEPARATOR.$itemValue)){
                    unset($subdir[$item]);
                }
            }
            
            if (sizeof($subdir) > 0){ //if folders found, create a sub list
                echo "\n\t\t\t<ul>\n";  //start another ul list
                foreach ($subdir as $subkey => $subvalue) {   //for each subfolder
                    if (is_dir(rootFolder.'/content/'.$value.DIRECTORY_SEPARATOR.$subvalue)){         //and only if it's a folder (not a file)          
                       echo "\t\t\t\t<li><a href='./index.php?content=".urlencode($value)."/".urlencode($subvalue)."'>".substr($subvalue,3)."</a></li>"; //insert a new li
                    }
                }
                echo "</ul>\n"; //then close the ul for the sub-items
            }
              echo "\n\t\t\t</li>\n"; //close the original list item

        }
    }
    echo "\t\t</ul>\n"; //when all finished, close the main ul
}

    function isActive($page, $active){  //this function will be called with two parameters: the pagename, and what page is active. this information is generated by the pagename script
        if ($page == "wwwroot" or $page == "root"){
            $page = "00.Home"; 
        }
        
        if ($page == $active) {
            return ' class="active" ';    //if the pagename and the active page are matching, then, the link will be marked as active
        } else {
            return '';
        }
    }

?>