<?php 
	//siteRootFolder and adminRootFolder already defined
	defined('QDP') or die("Rerstricted access");

	$str_data = file_get_contents(adminRootFolder.'/adminSettings.json');
	$siteSettings = json_decode($str_data, true);

	define('contentPath', siteRootFolder.'/content');



if (isset($_GET["path"])){
    $path = $_GET["path"];
} else {
    $path = "/";
}

if (isset($_GET["menuItem"])){
    $menuItem = $_GET["menuItem"];
} else {
    $menuItem = "/";
}



function populateTable(){
	$foldersInContent = array_diff(scandir(contentPath), array('..', '.','content.php'));

	foreach ($foldersInContent as $key => $value) {
		list($order, $menuItem) = explode(".", $value);
		echo "<tr>";
		echo "<td class='tableItem'>";
		echo linkBuilder(null,$value);
		echo "</td>";

		getSubItems($value);

		echo "</tr>";
		
	}
}

function getSubItems($path){
	$subitems = array_diff(scandir(contentPath.'/'.$path), array('..', '.'));
	foreach ($subitems as $keys => $values) {
		if (!is_dir(contentPath.'/'.$path.'/'.$values)){
                unset($subitems[$keys]);
        }
	}

	foreach ($subitems as $key => $value) {		
		echo "<td class='tableSubitem'>";
		echo linkBuilder($path,$value);//subitem function comes here
		echo "</td>";
	}		
}

function linkBuilder($path, $argument){

	echo "<a href='";
	echo './index.php?cat=30.Menu+Items&amp;menuItem='.urlencode($path).'/'.urlencode($argument);
	echo "'>";
	echo $argument;
	echo "</a>";
}

?>

<table id="t01">
	<caption>Click on the menu item to rename or delete. Or start typing in the form below for a new menu item.</caption>
	<tr>
		<th>Menu Item</th>
		<th>SubItems</th>
		<?php populateTable(); ?>
	</tr>	
</table>


<?php include(adminRootFolder.'/adminContent/30.Menu Items/actions/createOrModify.php'); ?>
