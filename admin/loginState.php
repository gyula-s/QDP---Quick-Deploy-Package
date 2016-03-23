<?php
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
	
	alert("Hello\nI will deffinitely try to log you out now,\nbut I can't promise anything due to limitations in the apache webserver.\n\nYou should restart your browser, and then test if it worked.\nIf not, a computer restart will deffinitely help!");
	//javascript:document.location=document.URL.replace('://','://logout@');
	window.location.replace('/admin/logout');
}
</script>