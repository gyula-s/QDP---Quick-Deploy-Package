<?php
defined('QDP') or die('Restricted access');

$str_data = file_get_contents(rootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

date_default_timezone_set($siteSettings["timezone"]);

$year = date("Y");
$yearStart = $siteSettings['siteFromYear'];



echo '<p>&copy; ';
if ($year > $yearStart && !empty($yearStart)) {
	echo $yearStart.' - ';
}
echo $year;
echo ' - ';
echo $siteSettings['siteName'];
echo '</p>';
?>

<p style="color:grey; font-size:0.8em;">Site powered by <a style="text-decoration:none;" href="http://designjulio.com" target="_blank">QDP</a></p>
