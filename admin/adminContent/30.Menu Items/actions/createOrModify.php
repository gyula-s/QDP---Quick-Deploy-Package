<?php
defined('QDP') or die("Rerstricted access");
$root = "";
$order = "00";
$subItem = "";
$deleteDisabled = true;
$renameDisabled = true;

if (strlen(menuItem) > 0){  //if the menuItem lenght is zero, then there was no menu item clicked on
	$deleteDisabled = false;
	$renameDisabled = false;
	list($root, $orderAndSubItem) = explode('/', menuItem);
	list($order, $subItem) = explode('.', $orderAndSubItem);
}

/***********************Creating a new folder in the content area****************************/
if (isset($_POST["new"])){
	$rootfolder = $_POST["rootfolder"];
	$order = $_POST["order"];
	$newMenu = $_POST["newMenu"];

	if (empty($order) or empty($newMenu)) {
		errorMessage("You cant leave any of the fields blank!");
	}
	else{
		mkdir(contentPath.'/'.$rootfolder.'/'.$order.'.'.$newMenu);
		header("Refresh:0; ../admin/index.php?cat=30.Menu+Items");
	}
}

/***********************Renaming a folder in the content area****************************/
if (isset($_POST["rename"])){
	if ($renameDisabled){
		errorMessage("You haven't selected a menu item by clicking on it.");
	} else {		
		$rootfolder = $_POST["rootfolder"];
		$order = $_POST["order"];
		$newMenu = $_POST["newMenu"];

		if (empty($order) or empty($newMenu)) {
			errorMessage("You cant leave any of the fields blank!");
		} else {
			//rename(oldname, newname);
			rename(contentPath.'/'.menuItem, contentPath.'/'.$rootfolder.'/'.$order.'.'.$newMenu);
			header("Refresh:0; ../admin/index.php?cat=30.Menu+Items");
		}
	
	}
}

/***********************Delete a folder in the content area****************************/
if (isset($_POST["delete"])){
	$stuffToDelete = contentPath.'/'.menuItem;
	$folderEmpty = array_diff(scandir(contentPath.'/'.menuItem), array('..', '.'));
	if ($deleteDisabled){
		errorMessage("You haven't selected a menu item by clicking on it.");
	} elseif (sizeof($folderEmpty) > 0){
		errorMessage("This menu item has subitems or articles. You have to delete all the articles first, then any subitems if any, and then delete this menu item.");
	} else {
		rmdir($stuffToDelete);
		echo menuItem.' was successfully deleted';
		header("Refresh:3; ../admin/index.php?cat=30.Menu+Items");
	}	
}

/***********************List all the available folders in the content area and lists them in a dropdown menu****************************/
function getFolders(){
	global $root;
	if (strlen(menuItem) > 0){
		list($root, $orderAndSubItem) = explode('/', menuItem);
		list($order, $subItem) = explode('.', $orderAndSubItem);
	}

	$foldersInContent = array_diff(scandir(contentPath), array('..', '.','content.php'));
	array_unshift($foldersInContent, ""); //adding the empty value for root
	foreach ($foldersInContent as $key => $value) {
		echo "\n<option value='".$value."'";
		if($root == $value){
			echo (' selected');
		}
		echo ">";
		if(empty($value)){
			echo "/";
		} else{
			echo $value."</option>";
		}
	}
}

/***********************Display error message****************************/
function errorMessage($theMessage){
	echo '<div id="errorMessage">';
	echo $theMessage;
	echo '</div>';
}

?>

<form method="post" name="newMenuOrRename" id="new" action="">
	
	<p>
    <label>The menu item is under:</label><br />
    <select name="rootfolder" id="rootfolder" >
      <?php getFolders(); ?>
    </select>
    </p>
    <p>
    <label>Enter a number to set the order:</label><br />
	<br />
    <input type="number" onchange="doubleDigits()" name="order" id="order" size="2" value="<?php echo $order; ?>"/>
    </p>
    <p>
    <label>Menu name:</label><br />
    <input name="newMenu" type="text" id="newMenu" value="<?php echo $subItem; ?>"/>
    </p>
	<button class="newItemButton" name="new" type="submit" >Create new menu item</button>
	<button class="renameButton" name="rename" type="submit">Rename</button>
	<button class="deleteButton" name="delete" type="submit">Delete</button>
</form>

<script type="text/javascript">
var order = document.getElementById("order");	
	function doubleDigits(){
			order.value= ("0" + order.value).slice(-2);;
		}
</script>