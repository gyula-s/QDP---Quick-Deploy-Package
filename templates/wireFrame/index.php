<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<?php
    defined('QDP') or die('Restricted access'); //to stop bad guys sneaking around

//echo siteDomain: this is domain of the site. Make sure the path to your css file uses this! like this: <?php echo siteDomain;
?>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo siteDomain; ?>templates/wireFrame/wireFrame.css">        
        <?php include_once(rootFolder.'/php/htmlHead.php');//all the information that needs to be in the head. REQUIRED! ?>
    </head>

    <body>

        <div id="pageWrap-0">

            <div id="header-1">
                <a href="<?php echo siteDomain; ?>" title="Home page">
                    <?php echo $siteSettings['siteName'] ?>
                </a>
            </div>

            <div id="mainMenu-2">
                <ul id="menu>"
                    <?php 
                        //this is the main menu of the site. REQUIRED!
                        include_once(rootFolder.'/php/mainMenu.php');
                        createMenu($activeMenuItem);
                    ?>
                </ul>
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