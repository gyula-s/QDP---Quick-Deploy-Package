<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<?php
/**
* @about: This is the default template that comes with the QDP 
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

defined('QDP') or die('Restricted access'); //to stop bad guys sneaking around

?>
    <head>
        <link rel="stylesheet" type="text/css" href="./templates/default/default.css" />        
        <?php include_once(rootFolder.'/php/htmlHead.php');//all the information that needs to be in the head. REQUIRED! ?>
    </head>

    <body>

        <div id="pageWrap-0">
            <a href="./admin">Admin</a>

            <div id="header-1">
                <a href="./" title="Home page">
                    <?php echo $siteSettings['siteName'] ?>
                </a>
            </div>

            <div id="mainMenu-2">
                <?php 
                    //this is the main menu of the site. REQUIRED!
                    include_once(rootFolder.'/php/mainMenu.php');
                    createMenu($activeMenuItem);
                ?>
            </div>  

            <div id="content-2">
                <?php 
                    //this is the content of the site. REQUIRED!
                    include_once(rootFolder.'/content/content.php');
                    readArticles($activeMenuItem, $articleFileName);
                ?>
            </div>

            <div id="footer-4">
                <?php 
                    //this is the footer of the site. REQUIRED!
                    include_once(rootFolder.'/php/footer.php') 
                ?>
            </div>
        </div>
    </body>
</html>