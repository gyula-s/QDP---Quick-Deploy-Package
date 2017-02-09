<?php
defined('QDP') or die('Restricted access');
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true){            
	include_once('logoutBar.php');
}
elseif ($siteSettings["offline"]) {
	echo $langSettings["offlineMessage"];
	die;
}
?>