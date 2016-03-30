<?php 
/**
* @about: Displays a quick message for the logged in user, and provides a log out functionality.
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


//siteRootFolder, and adminRootFolder already defined
defined('QDP') or die("Rerstricted access");

if (!isset($_SERVER['PHP_AUTH_USER'])){
	$message = "Not secure, user not authenticated! ";
	echo $message;
} else{
	$message = $_SERVER['PHP_AUTH_USER'];
	echo "Hello ".$message."! ";
}

?>
<button type="button" onclick="logout();">Log out</button>
<br /><br />
<a href="../">Preview site</a>
<br />
<script type="text/javascript">
function logout() {

	alert("Hello\nI will deffinitely try to log you out now,\nbut I can't promise anything due to limitations in the apache webserver.\n\nYou should restart your browser, and then test if it worked.\nIf not, a computer restart will deffinitely help!\n\nThis will not work on Microsoft Edge, so you'll have to close the browser!");
	window.location.replace('../admin/logout');
}
</script>