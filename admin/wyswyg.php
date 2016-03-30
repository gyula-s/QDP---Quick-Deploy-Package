<?php
/**
* @about: This file is just contains the script for tinymce wyswyg editor.
* Because the same script is used on multiple locations, it is just easier to update this, and reference to this file. 
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

defined('QDP') or die('Restricted access');

?>

<script src="./tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script type="text/javascript">tinymce.init({ 	
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

