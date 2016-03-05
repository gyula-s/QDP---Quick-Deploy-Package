<?php
defined('QDP') or die('Restricted access');

?>

<script src="./tinymce/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ 	
	selector:'.showEditor',
	width : 700,
	min_height: 350,
	max_height: 350,
	browser_spellcheck: true,
	plugins: [
		"advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"],
	toolbar: ["insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"],
	file_browser_callback: RoxyFileBrowser
 });

function RoxyFileBrowser(field_name, url, type, win) {
  var roxyFileman = './tinymce/js/tinymce/plugins/fileman/index.html';
  if (roxyFileman.indexOf("?") < 0) {     
    roxyFileman += "?type=" + type;   
  }
  else {
    roxyFileman += "&type=" + type;
  }
  roxyFileman += '&input=' + field_name + '&value=' + win.document.getElementById(field_name).value;
  if(tinyMCE.activeEditor.settings.language){
    roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
  }
  tinyMCE.activeEditor.windowManager.open({
     file: roxyFileman,
     title: 'Roxy Fileman',
     width: 850, 
     height: 650,
     resizable: "yes",
     plugins: "media",
     inline: "yes",
     close_previous: "no"  
  }, {     window: win,     input: field_name    });
  return false; 
}
</script>

