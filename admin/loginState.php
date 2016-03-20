<?php
echo "Hello ".$_SERVER['PHP_AUTH_USER'];
?>
<br />
<a href="../">Preview site</a>
<br />

<a href="#" onclick="logout();">Log out</a>

<script type="text/javascript">
function logout() {
	
	alert("Hello\nI will deffinitely try to log you out now,\nbut I can't promise anything due to limitations in the apache webserver.\n\nYou should restart your browser, and then test if it worked.\nIf not, a computer restart will deffinitely help!");
	javascript:document.location=document.URL.replace('://','://logout@');
}
</script>