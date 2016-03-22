<?php
/**
* @about: This file is responsible to display the articles found in the content folder.
* It is possible to display all articles in a given folder, or just one article.
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

global $location; //declaring location now, so other funcitions will be able to access it
function readArticles($folder, $articleFileName){
    //setting up the error messages
    if($folder == "404"){
        include_once(rootFolder.'/php/errorPage.php');
        displayError("404");
        return;
    } elseif ($folder == "401") {
        include_once(rootFolder.'/php/errorPage.php');
        displayError("401");
        return;
    } elseif ($folder == "403") {
        include_once(rootFolder.'/php/errorPage.php');
        displayError("403");
        return;
    }

	global $location;

    if ($folder == "root" or $folder == "wwwroot" or $folder == ""){
	   $folder = "Home"; //when the folder variable is root, wwwroot or empty assume the home folder
    } elseif (substr($folder, 3) == "Contact") { //the contact folder must contain the contact.php file
	   include_once(rootFolder.DS.'content'.DS.$folder.'/contact.php');
    }

    //create a variable with the exact location of the articles needed
    $location = rootFolder.DS."content".DS.$folder;

    if (strlen($articleFileName) > 0){      //if the articleFilename is specified, it means that only that article has to be displayed   
        displayArticles($articleFileName, $folder); 
        return; //after displaying the one article, exit the application
    }

    if (file_exists($location)){ //if the location is valid
    	$articleList = array_diff(scandir($location), array('..', '.','contact.php')); //scan for articles

        foreach ($articleList as $item => $itemValue) {
            if (is_dir($location.DIRECTORY_SEPARATOR.$itemValue)){
                unset($articleList[$item]); //removing directories
            }
        }
        //for each article found, display them on the page      
    	foreach ($articleList as $key => $value) {
    		displayArticles($value,$folder);
    	}
    } else {
        //if the location or filename are not valid, the link is probably broken, so displaying the 404 message
        include_once(rootFolder.'/php/errorPage.php');
        displayError("404");
    }
}

//this function is to display the article as a formatted text
// if an element is missing from an article (title, or  date) the div tags will not be displayed either.
function displayArticles($articleTitle, $folder){
	global $location;
    if (file_exists($location.DS.$articleTitle)){
        //get the article text from the location requested
		$getArticle = file_get_contents($location.DS.$articleTitle);
	    $article = json_decode($getArticle, true);

        //the title
	    echo "\n\t<div class='article'>";
        if($article['titleEnabled']){
            echo "\n\t\t<div class='title'><h1>";
            echo '<a href="./index.php?content='.$folder;
            echo '&amp;article=';
            echo urlencode($articleTitle).'">';
            	echo $article['title'].'</a>';
            echo '</h1></div>';
        }

        //subtitle
        if($article['subtitleEnabled']){
            echo "\n\t\t<div class='subtitle'><h2>";
            	echo $article['subtitle'];
            echo '</h2></div>';
        }

        //date
        if($article['dateEnabled']){
            echo "\n\t\t<div class='date'><h3>";
            	echo $article['date'];
            echo '</h3></div>';
        }

        //text
        if(!empty($article['text'])){
            echo "\n\t\t<div class='articleText'>";
            	echo $article['text'];
            echo "</div>";
        }
       //close the article div 
		echo "\n\t</div>\n\n";
    } else {
        //this will display the errormessage
        include_once(rootFolder.'/php/errorPage.php');
        displayError("404");
    }
}
?>