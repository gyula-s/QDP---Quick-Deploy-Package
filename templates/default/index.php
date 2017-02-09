<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo siteLanguage ?>" xml:lang="<?php echo siteLanguage ?>">

<?php
/**
* @about: This is the default template that comes with the QDP 
* 
* 
* PHP version 5.4
*
* @version          2.0 - 30/01/2017
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

defined('QDP') or die('Restricted access'); //to stop bad guys sneaking around
//echo siteDomain: this is domain of the site. Make sure the path to your css file uses this! like this: <?php echo siteDomain;
?>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo siteDomain; ?>templates/default/css/style.css" />     
    <?php include_once(rootFolder.'/helpers/htmlHead.php');//all the information that needs to be in the head. REQUIRED! ?>
</head>

<body>
    <?php include_once(rootFolder.DS.'helpers'.DS.'logoutBar'.DS.'loginCheck.php'); //just outsite the main wrapper display logout bar when the admin is logged in. Also makes it possible to test the site when it is offline ?> 
    <div id="pageWrap-0">

        <div id="header-1">
            <a href="<?php echo siteDomain; ?>" title="<?php echo $langSettings['homeName'] ?>">
                <?php echo $langSettings['siteName'] ?>
            </a>
        </div>

        <div id="mainMenu-2">
            <ul id="menu">
                <?php 
                    //this is the main menu of the site. REQUIRED!
                include_once(rootFolder.'/content/mainMenuGenerator.php');
                createMenu($activeMenuItem);
                ?>
            </ul>
        </div>  

        <div id="content-2">
            <?php 
                    //this is the content of the site. REQUIRED!
            include_once(rootFolder.'/content/contentGenerator.php');
            readArticles($activeMenuItem, $articleFileName);
            ?>
        </div>
        <div id="langSelector">
            <?php 
                //this is the language selector of the site. REQUIRED if you are using more than one language. It won't show anything if there is only one language used anyway. It comes with it's own css!
            include_once(rootFolder.'/plugins/languageSelector/langSelector.php') 
            ?>
        </div>
        <div id="footer-4">
            <?php 
                    //this is the footer of the site. REQUIRED!
            include_once(rootFolder.'/helpers/htmlFooter.php') 
            ?>
        </div>
    </div>
</body>
</html>