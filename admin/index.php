<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<?php
define('QDP', TRUE); //defines a variable, that is checked in all other included php files. If those php files are not called by the index, it will restrict access to them

define('adminRootFolder', dirname(__DIR__).'/admin');
define('siteRootFolder', dirname(__DIR__));


$str_data = file_get_contents(siteRootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

$str_admindata = file_get_contents(adminRootFolder.'/adminSettings.json');
$adminSettings = json_decode($str_admindata, true);

if (isset($_GET["cat"])){
    $activeMenuItem = $_GET["cat"];
} else {
    $activeMenuItem = "00.Home";
}

if (isset($_GET["menuItem"])){
    define ('menuItem', $_GET["menuItem"]);
} else {
    define ('menuItem', null);
}

?>

  <head>

	<title><?php echo $siteSettings['siteName']; ?> - Admininstration</title>
	<?php include_once(adminRootFolder.'/adminTemplateSelector.php') ?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.firebase.com/js/client/2.4.1/firebase.js"></script>
  
 
  </head>

  <body>
    <noscript>
      For full functionality of this site it is necessary to enable JavaScript.
 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
 instructions how to enable JavaScript in your web browser</a>.
    </noscript>   

    
    <div id="container" style="display:none">

      <div id="titleBar">
        <h1><a href="/admin"> <?php echo $siteSettings['siteName']; ?>- Admininstration</a></h1>
      </div>

      <div id="statusBar">
        <a href="../" target="_blank" title="Opens in a new window">Preview the main site or </a>

        <button id="signOut" type="button">Log out</button>
        <a href="https://en.gravatar.com/emails/" target="_blank"><img id="gravatar" src="" alt="gravatar" style="width:50px;height:50px;" /></a>
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

       <script type="text/javascript">
   var ref = new Firebase("<?php echo $adminSettings['firebase']; ?>");
    

    var authData = ref.getAuth();
    if (authData) {
      console.log("User is authenticated!");
      document.getElementById("container").style.display = "block";
    } else {
      var login = "login.php";
      window.location.href = login;
      console.log("I'm not authenticated;")
    }

    $('#signOut').on("click", function (){ 
      console.log("sign out pressed");
      document.getElementById("container").style.display = "none";
      ref.unauth();
      location.reload();
    });
    
var gravatar = document.getElementById("gravatar");
gravatar.src = authData.password.profileImageURL;
  </script>
  </body>

</html>
