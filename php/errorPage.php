<?php
defined('QDP') or die('Restricted access');



function displayError($errorType){
$str_data = file_get_contents(rootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

	echo '<div class="article">';
                        echo '<div class="title"><h1>';
                        	echo $errorType;
                        echo '</h1></div>';

                        echo '<div class="articleText">';
                        	echo $siteSettings[$errorType];
                        echo '</div>';
    		echo '</div>';
}

?>