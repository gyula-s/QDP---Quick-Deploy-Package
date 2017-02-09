<?php 
/**
* @about: Displays a quick message for the logged in user, and provides a log out functionality.
* 
* PHP version 5.5
*
* @version          1.0 - 30/01/2017
* @package          This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright        (C) 2017 Gyula Soós
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
echo '<style type="text/css"> @import url("'.siteDomain.'helpers/logoutBar/logoutBar.css") </style>'; //inlcude the custom css for it

if(isset($_POST['logout'])){
	$_SESSION = array();
	session_unset(); 
	session_destroy();
	header("Refresh:0");
}
?>
<div id="loggedIn">
	<form method="post" >
		<?php 
		if (isset($_SESSION['loggedIn'])){
			$gravatarID = md5( strtolower( trim( $_SESSION['username'] ) ) );
			$str = file_get_contents( 'https://www.gravatar.com/'.$gravatarID.'.php' );
			$profile = unserialize( $str );
			if (isset( $profile['entry'][0]['name']['formatted']) ){
				echo $profile['entry'][0]['name']['formatted']; 
			}
			else
			{
				echo $_SESSION['username'];
			}
			echo ", greetings! ";
			echo '<a href="https://www.gravatar.com/'.$gravatarID.'" target="_blank"><img id="gravatar" src="https://www.gravatar.com/avatar/'.$gravatarID.'?s=35&d=retro"/></a>';		
		}
		?>
		<input type="submit" name="logout" id="logout" value="Logout" ></input>

		
		<br />
	</form>
</div>