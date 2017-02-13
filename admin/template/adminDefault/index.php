<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo siteDomain;?>template/adminDefault/css/style.css" />
  <title><?php echo $langSettings['siteName']; ?> - Admininstration</title>	
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="robots" content="noindex,nofollow" />
</head>
<body>
  <noscript>
    For full functionality of this site it is necessary to enable JavaScript.
    Here are the <a href="http://www.enable-javascript.com/" target="_blank">
    instructions how to enable JavaScript in your web browser</a>.
  </noscript>
  <?php include_once(adminRootFolder.DS.'helpers'.DS.'logoutBar'.DS.'logoutBar.php'); //just outsite the main wrapper display logout bar when the admin is logged in. Also makes it possible to test the site when it is offline ?>
  <div id="container">

    <div id="adminMenu">
      <ul>
        <?php include_once(adminRootFolder.'/adminContent/adminMenu.php');
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
      <?php include_once(adminRootFolder.'/helpers/footer.php'); ?>
    </div>
  </div>
</body>

</html>