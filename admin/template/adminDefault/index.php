<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="<?php echo siteDomain;?>template/adminDefault/adminDefault.css" />
    <title><?php echo $siteSettings['siteName']; ?> - Admininstration</title>	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <noscript>
      For full functionality of this site it is necessary to enable JavaScript.
      Here are the <a href="http://www.enable-javascript.com/" target="_blank">
      instructions how to enable JavaScript in your web browser</a>.
    </noscript>

    <div id="container">
      <div id="titleBar">
        <h1><a href="/admin"><?php echo $siteSettings['siteName']; ?> - Admininstration</a></h1>
      </div>

      <div id="statusBar">
        <?php include_once(adminRootFolder.'/loginState.php');?>

      </div>

            <div id="adminMenu">
        <ul>
          <?php include_once(adminRootFolder.'/adminMenu.php');
            createMenu($activeMenuItem);
          ?>
        </ul>
      </div>

      <div id="content">
        <?php include_once(adminRootFolder.'/adminContent/contentReader.php');
        readContent($activeMenuItem);
        ?>
      </div>

      <div id="footer">
        <?php include_once(adminRootFolder.'/footer.php'); ?>
      </div>
    </div>
  </body>

</html>