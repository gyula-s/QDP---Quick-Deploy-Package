<?php
define('QDP', TRUE); //defines a variable, that is checked in all other included php files. If those php files are not called by the index, it will restrict access to them
define('DS', DIRECTORY_SEPARATOR);
define('rootFolder', dirname(__FILE__));

if(file_exists(rootFolder.DS."install.php")){
	include(rootFolder.DS."install.php");
	die;
}

$str_data = file_get_contents(rootFolder.DS.'siteSettings.json');
$siteSettings = json_decode($str_data, true);

if ($siteSettings["offline"]){
    echo $siteSettings["offlineMessage"];
    die;
}



if (isset($_GET["content"])){
    $activeMenuItem = $_GET["content"];
} else {
    $activeMenuItem = "00.Home";
}

if (isset($_GET["article"])){
    $articleFileName = $_GET["article"];
} else {
    $articleFileName = "";
}

include(rootFolder.DS."templateSelector.php");
?>
   