<?php
defined('QDP') or die('Restricted access');

$location; //declaring location now, so other funcitions will be able to access it
 function readArticles($folder, $articleFileName){

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
    	$folder = "Home";
    } elseif (substr($folder, 3) == "Contact") {
    	include_once(rootFolder.DS.'content'.DS.$folder.'/contact.php');
    }
	
	$location = rootFolder.DS."content".DS.$folder;

    if (strlen($articleFileName) > 0){
        
        displayArticles($articleFileName, $folder);
        return;
    }

    if (file_exists($location)){
    	$articleList = array_diff(scandir($location), array('..', '.','contact.php'));

        foreach ($articleList as $item => $itemValue) {
                    if (is_dir($location.DIRECTORY_SEPARATOR.$itemValue)){
                        unset($articleList[$item]);
                    }
                }

    	foreach ($articleList as $key => $value) {
    		displayArticles($value,$folder);
    	}
    } else {
        include_once(rootFolder.'/php/errorPage.php');
        displayError("404");
    }
 }

	function displayArticles($articleTitle, $folder){
		global $location;
        if (file_exists($location.'/'.$articleTitle)){
    		$getArticle = file_get_contents($location.'/'.$articleTitle);
    	    $article = json_decode($getArticle, true);


    	    echo "\n\t<div class='article'>";
                        if(!empty($article['title'])){
                            echo "\n\t\t<div class='title'><h1>";
                            echo '<a href="./index.php?content='.$folder;
                            echo '&amp;article=';
                            echo urlencode($articleTitle).'">';
                            	echo $article['title'].'</a>';
                            echo '</h1></div>';
                        }

                        if(!empty($article['subtitle'])){
                            echo "\n\t\t<div class='subtitle'><h2>";
                            	echo $article['subtitle'];
                            echo '</h2></div>';
                        }

                        if(!empty($article['date'])){
                            echo "\n\t\t<div class='date'><h3>";
                            	echo $article['date'];
                            echo '</h3></div>';
                        }

                        if(!empty($article['text'])){
                            echo "\n\t\t<div class='articleText'>";
                            	echo $article['text'];
                            echo "</div>";
                        }
                        
    		echo "\n\t</div>\n\n";
        } else {
            include_once(rootFolder.'/php/errorPage.php');
            displayError("404");
        }
	}
?>