<?php
/**
* @about: The file will list all available json files in the content folder 
* and will offer an option to edit them or to delete them.
* 
* PHP version 5.4
*
* @version 			1.0 - 06/03/2016
* @package 			This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright 		(C) 2016 Gyula Soós
* @license 			This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
*MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* See LICENSE.txt for copyright notices and details.
*/

defined('QDP') or die('Restricted access');
define('contentPath', siteRootFolder.'/content');

global $articlePath;
global $fileOrder;

$str_data = file_get_contents(siteRootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

date_default_timezone_set($siteSettings["timezone"]);

/*
* Collecting variables from URL
*
*/
if (isset($_GET["articlePath"])){
    $articlePath = $_GET["articlePath"];
} else {
    $articlePath = "";
}

if (isset($_GET["articleFilename"])){
    $articleFilename = $_GET["articleFilename"];
    list($fileOrder, $filename) = explode('.', $articleFilename);
} else {
    $articleFilename = "";
}

if (isset($_GET["action"])){
    $action = $_GET["action"];
} else {
    $action = "";
}

/*
* If the action is delete, then delete the file from the server
*
*/
if ($action == "delete"){
	$file = contentPath.DS.$articlePath.DS.$articleFilename;
	if (file_exists($file)){ //check if file exists first
		unlink($file);
		echo "<p style='color:red;font-size:1.5em;'>".$articlePath.DS.$articleFilename." was successfully deleted"."</p>";
	} else {
		echo "<p style='color:red;font-size:1.5em;'>There file was not found on the server. Something must have went wrong!</p>";
	}	
}

//When the "New Article" button is pressed, unset all the variables that might be in the URL or anywhere else by refreshing the page.
if (isset($_POST["newArticle"])){
	header("Refresh:0; url=./index.php?cat=20.Articles#showWindow");
}

//When an article is saved, capture the form contents, ans save them in a json file.
if (isset($_POST["saveArticle"])){
	$saveDirectory = $_POST["menuSelect"];
	$order = $_POST["orderNumber"];
	$title = $_POST["articleTitle"];
	$subtitle = $_POST["articleSubtitle"];
	$date = $_POST["articleDate"];
	$text = $_POST["articleText"];

	$theWholeArticle = array(); //this array will hold the whole article

	$theWholeArticle['title'] = $title;
	$theWholeArticle['subtitle'] = $subtitle;
	$theWholeArticle['date'] = $date;
	$theWholeArticle['text'] = $text;

	if ($action == 'edit'){ //if the action is edit, the original file is deleted, and then the new file is save in the new location and new title - if any
		unlink(contentPath.DS.$articlePath.DS.$articleFilename);
		file_put_contents(contentPath.DS.$saveDirectory.DS.$order.'.'.$title.'.json', json_encode($theWholeArticle));
		header("Refresh:0; url=./index.php?cat=20.Articles");
	} else { //if it's a new article, just save the file
		//the output will be something like: {path}/menu/01.Article Title.json
		file_put_contents(contentPath.DS.$saveDirectory.DS.$order.'.'.$title.'.json', json_encode($theWholeArticle));
    	header("Refresh:0");
	}
}

//This function will scan all the directories and sub-directories (1-level down) and present them as a dropdown list in the article editor
function getFoldersInDropDown(){
	global $articlePath;
	$topLevel = array_diff(scandir(contentPath), array('..', '.','content.php'));

	foreach ($topLevel as $key => $menuItem) {
		$subLevel = array_diff(scandir(contentPath.DS.$menuItem), array('..', '.')); //scan the 'content' folder
		list($order, $plainMenuItem) = explode('.', $menuItem); //store the ordernumber and the folder name separately
		echo "\n<option value='".$menuItem."'"; //list this top level folder
		if ($menuItem == $articlePath){ //if the path matches this folder, then select this folder by default
			echo 'selected';
		}
		echo " >".$plainMenuItem."</option>";
		foreach ($subLevel as $keys => $subItem) { //now scan every folder for subfolders
			if (!is_dir(contentPath.'/'.$menuItem.DS.$subItem)){
                unset($subLevel[$keys]); //remove every item, that is not a folder. 
            }
        }
        foreach ($subLevel as $keys => $subItem) { //and now list the folders
        	list($order, $plainSubMenuItem) = explode('.', $subItem);
        	echo "\n<option value='".$menuItem.DS.$subItem."'";
        	
        	if ($menuItem.DS.$subItem == $articlePath){
			echo 'selected';
		}
        	echo " >".$plainMenuItem.DS.$plainSubMenuItem."</option>";
        }		
	}
}

/**
* in a similar pattern to the getFoldersInDropdown, scan the folders, but now looking for articles
* This will generate a list of the article items. 
* The list will look like:
* TopLevelFolder 		articleTitle		date 		edit/delete
* Toplevel/Sublevel 	articleTitle 		date 		edit/delete
* nextToplevel....
* 
*/
function find_files(){ 
	$mainDir = array_diff(scandir(contentPath), array('..', '.','content.php'));
	foreach ($mainDir as $key => $dirs) {
		$mainMenus = array_diff(scandir(contentPath.DS.$dirs), array('..', '.','content.php', 'contact.php'));
		foreach ($mainMenus as $key => $menus) {
			list($order,$plainDirs) = explode('.', $dirs);
					list($order,$plainMenus) = explode('.', $menus);
			if (is_dir(contentPath.DS.$dirs.DS.$menus)){
				$subMenus = array_diff(scandir(contentPath.DS.$dirs.DS.$menus), array('..', '.','content.php', 'contact.php'));
				foreach ($subMenus as $key => $article) {
					
					echo "<tr>";
					echo "<td>";
					echo $plainDirs.'/'.$plainMenus;
					echo "</td>";
					echo "<td>";
					echo explode('.', $article)[0];
					echo "</td>";
					echo "<td>";
					echo openTextFile($dirs.DS.$menus, $article, "title");
					echo "</td>";
					echo "<td>";
					echo openTextFile($dirs.DS.$menus, $article, "date");
					echo "</td>";
					echo "<td class='editArticleLink'>";
						linkBuilder($dirs.DS.$menus, $article, "edit");
					echo "</td>";
					echo "<td class='deleteArticleLink'>";
						linkBuilder($dirs.DS.$menus, $article, "delete");
					echo "</td>";
					echo "</tr>";
				}

			} else {
				echo "<tr>";
				echo "<td>";
				echo $plainDirs;
				echo "</td>";
				echo "<td>";
					echo explode('.', $menus)[0];
					echo "</td>";
				echo "<td>";
				echo openTextFile($dirs, $menus, "title");
				echo "</td>";
				echo "<td>";
				echo openTextFile($dirs, $menus, "date");
				echo "</td>";
				echo "<td class='editArticleLink'>";
						linkBuilder($dirs, $menus, "edit");
				echo "</td>";
				echo "<td class='deleteArticleLink'>";
					linkBuilder($dirs, $menus, "delete");					
				echo "</td>";
				echo "</tr>";
			}
		}
	}
}


/*
*this function will generate the links for the edit and the delete buttons.
*/
function linkBuilder($path, $filename, $action){
	if ($action == "edit"){
		echo "<a onclick='toogleVisibility(editorWindow)' href='./index.php?cat=20.Articles&amp;articlePath="; //onclick function added to hide the article already selected
		echo $path;
		echo "&amp;articleFilename=";
		echo $filename;
		echo "&amp;action=";
		echo $action;
		echo ($action == "edit" ? "#showWindow" : ""); //show the editor window only when the edit mode is selected
		echo "' >";
		echo $filename;
		echo "</a></td>";
	} else {
		echo "<a id='delete' style='cursor:pointer;' onclick='deleteConfirmation()' href='./index.php?cat=20.Articles&amp;articlePath="; //onclick function added to hide the article already selected
		echo $path;
		echo "&amp;articleFilename=";
		echo $filename;
		echo "&amp;action=";
		echo $action;
		echo ($action == "edit" ? "#showWindow" : ""); //show the editor window only when the edit mode is selected
		echo "' >";
		echo $filename;
		echo "</a></td>";
	}
}

/*
* This function opens each individual text file, and reads the article tite and date. THis is used in the list of articles
*/
function openTextFile($path,$filename,$s){
	$getArticle = file_get_contents(contentPath.DS.$path.DS.$filename);
    $article = json_decode($getArticle, true);
    return $article[$s];
}
	
?>

	<form method="post" name="newArticleForm" id="newArticleForm" action="">
		<button name="newArticle"  type="submit" id="newArticle" onclick="newArticle();">New Article</button>
		<br /><br />
	</form>

		<table id="articleList" style="width:100%;">
		  <tr>
		    <th>Menu category</th>
		    <th>Order</th>
		    <th>Title</th>	
		    <th>Date</th>	
		    <th>Edit</th>
		    <th>Delete</th>
		  </tr>
		    <?php 
		    	find_files();
		    ?>
		</table>
		<div id="editorBackGround" style="display:none;">
			<div id="editorWindow">
				<div id="closeButton"><p>&#10006;</p></div>
				<form method="post" name="articleEdit" id="editorForm" action="">
					<label>Menu:</label><br />
					<select name="menuSelect" id="menuSelect">
						<?php getFoldersInDropDown(); ?>
					</select>
					<br /><br />
					<label>Order Number:</label><br>
					<input  type="number" onchange="doubleDigits()" id="orderNumber" name="orderNumber" size="10" value="<?php echo $fileOrder; ?>" />
					<br /><br />
					<label>Title:</label><br />
					<input  type="text" id="articleTitle" name="articleTitle"size="50" value="<?php 
					echo (!empty($articlePath) ? openTextFile($articlePath,$articleFilename,'title') : ""); ?>" />
					<br /><br />
					<label>Subtitle:</label><br>
					<input type="text" id="articleSubtitle" name="articleSubtitle" size="50" value="<?php 
					echo (!empty($articlePath) ? openTextFile($articlePath,$articleFilename,'subtitle') : ""); ?>" />
					<br /><br />
					<label>Date:</label><br>
					<input  type="date" id="articleDate" name="articleDate" size="48" value="<?php 
					echo (!empty($articlePath) ? openTextFile($articlePath,$articleFilename,'date') : date("Y").'-'.date("m").'-'.date("d")); ?>" />
					<br /><br />
					<label>Article:</label><br>
					<br />
						<textarea  name="articleText" rows="10" cols="50" id="articleText" class="showEditor"><?php 
						echo (!empty($articlePath) ? openTextFile($articlePath,$articleFilename,'text') : ""); ?></textarea>
					<br /><br />					
					<button id="closeWindow" type="button" onclick="toogleVisibility(editorWindow)">Cancel</button>
					<button id="saveArticle" name="saveArticle" type="submit" onclick="doubleDigits();">Save</button>
					
				</form>
			</div>
		</div>

	<script type="text/javascript">
	/* declaring variables and connecting them witht he form elements */
		var editorWindow = document.getElementById("editorBackGround");
		var title = document.getElementById("articleSubtitle");
		var subtitle = document.getElementById("articleTitle");
		var articleDate = document.getElementById("articleDate");	
		var order = document.getElementById("orderNumber");	

		var lh = location.hash;	//This is the #showWindow tag at the end of url. 

		if (lh == '#showWindow'){ //if #showWindow is present at the end of url, show the editor window
			toogleVisibility(editorWindow); 
		}

		$("#closeButton").on("click", function (){ //close the editor window
			toogleVisibility(editorWindow);
		});

		$("#").on("click", function (){
			toogleVisibility(editorWindow);
		});

		function toogleVisibility(elementToShow){
			if (elementToShow.style.display == "block"){
				elementToShow.style.display = "none";
			} else {
					elementToShow.style.display = "block";
				}
		}

		function doubleDigits(){ //make a double digit number of a single digit number in the article
			order.value= ("0" + order.value).slice(-2);;
		}

		//before doing anything to the file display a prompt. No accidents here! :)
		function deleteConfirmation(){ 
			var link = document.getElementById=('delete');
			if (confirm('Do you really want to delete this article?') == true){
				//carry on with deleting
			} else {
				event.preventDefault(); //stop the default action of the button, thus the deleting php function will not be called.
				alert("Noting was deleted!");
			}			
		}

	</script>
	<?php 
		//include the what you see what you get editor for the textbox
		include(adminRootFolder.'/wyswyg.php'); 
	?> 