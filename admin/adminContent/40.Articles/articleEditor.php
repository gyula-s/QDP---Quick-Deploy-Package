<?php
defined('QDP') or die('Restricted access');
define('contentPath', siteRootFolder.'/content');
define('DS', DIRECTORY_SEPARATOR);
$str_data = file_get_contents(siteRootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

date_default_timezone_set($siteSettings["timezone"]);
global $articlePath;
global $fileOrder;

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

if ($action == "delete"){
	$file = contentPath.DS.$articlePath.DS.$articleFilename;
	if (file_exists($file)){
		unlink($file);
		echo "<p style='color:red;font-size:1.5em;'>".$articlePath.DS.$articleFilename." was successfully deleted"."</p>";
	} else {
		echo "<p style='color:red;font-size:1.5em;'>There file was not found on the server. Something must have went wrong!</p>";
	}
	
}

if (isset($_POST["newArticle"])){
	global $articlePath, $articleFilename, $action;
    unset($articlePath, $articleFilename, $action);
	header("Refresh:0; url=./index.php?cat=40.Articles#showWindow");
}

if (isset($_POST["saveArticle"])){

	$saveDirectory = $_POST["menuSelect"];
	$order = $_POST["orderNumber"];
	$title = $_POST["articleTitle"];
	$subtitle = $_POST["articleSubtitle"];
	$date = $_POST["articleDate"];
	$text = $_POST["articleText"];

	$theWholeArticle = array();

	$theWholeArticle['title'] = $title;
	$theWholeArticle['subtitle'] = $subtitle;
	$theWholeArticle['date'] = $date;
	$theWholeArticle['text'] = $text;

	if ($action == 'edit'){
		unlink(contentPath.DS.$articlePath.DS.$articleFilename);
		file_put_contents(contentPath.DS.$saveDirectory.DS.$order.'.'.$title.'.json', json_encode($theWholeArticle));
		header("Refresh:0; url=./index.php?cat=40.Articles");
	} else {
		file_put_contents(contentPath.DS.$saveDirectory.DS.$order.'.'.$title.'.json', json_encode($theWholeArticle));
    	header("Refresh:0");
	}
}

function getFoldersInDropDown(){
	global $articlePath;
	$topLevel = array_diff(scandir(contentPath), array('..', '.','content.php'));

	foreach ($topLevel as $key => $menuItem) {
		$subLevel = array_diff(scandir(contentPath.'/'.$menuItem), array('..', '.'));
		list($order, $plainMenuItem) = explode('.', $menuItem);
		echo "\n<option value='".$menuItem."'";
		if ($menuItem == $articlePath){
			echo 'selected';
		}
		echo " >".$plainMenuItem."</option>";
		foreach ($subLevel as $keys => $subItem) {
			if (!is_dir(contentPath.'/'.$menuItem.'/'.$subItem)){
                unset($subLevel[$keys]);
            }
        }
        foreach ($subLevel as $keys => $subItem) {
        	list($order, $plainSubMenuItem) = explode('.', $subItem);
        	echo "\n<option value='".$menuItem.'/'.$subItem."'";
        	
        	if ($menuItem.DS.$subItem == $articlePath){
			echo 'selected';
		}
        	echo " >".$plainMenuItem.'/'.$plainSubMenuItem."</option>";
        }		
	}
}

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

function linkBuilder($path, $filename, $action){
	if ($action == "edit"){
		echo "<a onclick='toogleVisibility(editorWindow)' href='./index.php?cat=40.Articles&amp;articlePath="; //onclick function added to hide the article already selected
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
		echo "<a id='delete' style='cursor:pointer;' onclick='deleteConfirmation()' href='./index.php?cat=40.Articles&amp;articlePath="; //onclick function added to hide the article already selected
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

function openTextFile($path,$filename,$s){
	$getArticle = file_get_contents(contentPath.DS.$path.'/'.$filename);
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
					<br />
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
		var editorWindow = document.getElementById("editorBackGround");
		var title = document.getElementById("articleSubtitle");
		var subtitle = document.getElementById("articleTitle");
		var articleDate = document.getElementById("articleDate");	
		var order = document.getElementById("orderNumber");	

		var lh = location.hash;	

		if (lh == '#showWindow'){
			toogleVisibility(editorWindow);
		}

		$("#closeButton").on("click", function (){
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

		function doubleDigits(){
			order.value= ("0" + order.value).slice(-2);;
		}

		function deleteConfirmation(){
			var link = document.getElementById=('delete');
			if (confirm('Do you really want to delete this article?') == true){
				//carry on with deleting
			} else {
				event.preventDefault();
				alert("Noting was deleted!");
			}			
		}

		function getDate(){
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!

			var yyyy = today.getFullYear();
			if(dd<10){
				dd='0'+dd
			} 

			if(mm<10){
				mm='0'+mm
			} 

			var today = yyyy+'-'+mm+'-'+dd;

			return today;
		}
	</script>
	<?php include(adminRootFolder.'/wyswyg.php'); ?>