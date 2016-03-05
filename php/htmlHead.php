<?php 
defined('QDP') or die('Restricted access');
$str_data = file_get_contents(rootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

?>

<title><?php echo $siteSettings['siteName'] ?></title>
<meta name="description" content=<?php echo '"'.$siteSettings['description'].'"' ?> />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include_once(rootFolder.'/plugins/analyticstracking.php') ?>