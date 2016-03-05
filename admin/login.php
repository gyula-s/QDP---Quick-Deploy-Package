<?php
$str_data = file_get_contents('../siteSettings.json');
$siteSettings = json_decode($str_data, true);

$str_adminData = file_get_contents('adminSettings.json');
$adminSettings = json_decode($str_adminData, true);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">


      #loginWindow{
      width: 400px;
      position: absolute;
      top: 30%;
      left: 50%;
      transform: translate(-50% , -50%);
      margin:auto;
      vertical-align: middle;
      display: block;
      border: 1px solid black;
      padding: 50px;
      box-shadow: 0 0 5px 1px #969696;
      }

      label{
      display: inline-block;
      width: 100px;
      text-align: left;
      margin-bottom: 10px;
      font-size: 16px;
      font-weight: bold;
      font-family: sans-serif;
      }

      input[type="text"], input[type="password"] {
      font-family: sans-serif;
      font-size: 18px;
      padding: 10px;
      border: solid 1px #dcdcdc;
      transition: box-shadow 0.3s, border 0.3s;
      }

      input[type="text"]:focus, input[type="password"]:focus, input[type="text"]:hover, input[type="password"]:hover {
      border: solid 1px #707070;
      box-shadow: 0 0 5px 1px #969696;
      }

      #signIn, #resetPassword{
      font-family: sans-serif;
      font-size: 16px;
      display: table;
      margin: 15px auto;
      width: 170px;
      height: 30px;
      }

      #signIn:hover{
      box-shadow: 0 0 5px 1px #969696;
      }

      p{
      text-align: center;
      font-family: sans-serif;
      }

      #error{
      color: red;
      font-weight: bold;
      }
      h3{
      font-family: sans-serif;
      text-align: center;
      }

      #firebaseInstructions{
        float: right;
        width: 100%;
        line-height: 40%;
        padding: 0px;
        font-family: sans-serif;
        position: absolute;
        top: 90%;
        text-align: right;
      }

      #firebaseInstructions p{
        text-align: right;
      }

    </style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.firebase.com/js/client/2.4.1/firebase.js"></script>

  </head>

  <body>
    <div id="loginWindow">
      <h3><?php echo $siteSettings['siteName']; ?> Admin Login</h3>
      <p>Please enter your credentials:</p>
  	<label>Username: </label>
    <input name="username" type="text" id="username" /> 

    <label>Password: </label>
  	<input name="password" type="password" id="password" /> 

  	<button id="signIn" type="button">Log in</button>
    <button id="resetPassword" type="button">Reset Password</button>
    <p id="error"></p>
    </div>

    <div id="firebaseInstructions">
      <p>For help and for the documentation please visit:</p>
      <a href="https://github.com/soosgyul/quick_deploy_package/wiki" target="_blank">Documentation on GitHub</a>
    </div>
    
    <script type="text/javascript">

    var ref = new Firebase("<?php echo $adminSettings['firebase']; ?>");
    var errorMessage = document.getElementById("error");

    $('#signIn').on("click", function (){ 
    var username = $("#username").val();
    var password = $("#password").val();

      ref.authWithPassword({
      email    : username,
      password : password
      },

      function(error, authData) {
      if (error) {
        switch (error.code) {
          case "INVALID_EMAIL":
            errorMessage.innerHTML = "The specified user account email is invalid."
            console.log("The specified user account email is invalid.");
            break;
          case "INVALID_PASSWORD":
            errorMessage.innerHTML = "The specified user account password is incorrect."
            console.log("The specified user account password is incorrect.");
            break;
          case "INVALID_USER":
            errorMessage.innerHTML = "The specified user account does not exist."
            console.log("The specified user account does not exist.");
            break;
          default:
            errorMessage.innerHTML = "Error logging user in"
            console.log("Error logging user in:", error);
        }
        } else {
      console.log("Authenticated successfully with payload:", authData);
      window.location.href = "index.php";
      remember: "sessionOnly"
      }
      });
    });

    $('#resetPassword').on("click", function (){
      var username = $("#username").val();

      ref.resetPassword({
        email: username
      }, function(error) {
        if (error) {
          switch (error.code) {
            case "INVALID_USER":
              errorMessage.innerHTML = "The specified user account does not exist. Please enter a valid email address."
              console.log("The specified user account does not exist.");
              break;
            default:
              errorMessage.innerHTML = "Error resetting password"
              console.log("Error resetting password:", error);
          }
        } else {
          errorMessage.innerHTML = "Password reset email sent successfully!"
          console.log("Password reset email sent successfully!");
        }
      });
    });
  </script>
  </body>


  
</html>

