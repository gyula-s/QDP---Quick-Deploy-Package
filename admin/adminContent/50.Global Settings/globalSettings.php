<?php
defined('QDP') or die('Restricted access');

$str_data = file_get_contents(siteRootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

$siteName = $siteSettings['siteName'];
$description = $siteSettings['description'];
$siteFromYear = $siteSettings['siteFromYear'];
$timzone = $siteSettings['timezone'];
$template = $siteSettings['template'];
$contactEmail = $siteSettings['contactEmail'];
$outgoingEmailFrom = $siteSettings['outgoingEmailFrom'];
$fourOFour = $siteSettings['404'];
$fourOOne = $siteSettings['401'];
$fourOThree = $siteSettings['403'];
$offline = $siteSettings['offline'];
$offlineMessage = $siteSettings['offlineMessage'];


/*errorchecking mechanism*/
if (isset($_POST["save"])){

  $siteSettings['siteName'] = $_POST["siteName"];
  $siteSettings['description'] = $_POST["description"];
  $siteSettings['siteFromYear'] = $_POST["siteFromYear"];
  $siteSettings['timezone'] = $_POST["timezone"];
  $siteSettings['template'] = $_POST["template"];
  $siteSettings['contactEmail'] = $_POST["contactEmail"];
  $siteSettings['outgoingEmailFrom'] = $_POST["outgoingEmailFrom"];
  $siteSettings['404'] = $_POST["fourOFour"];
  $siteSettings['401'] = $_POST["fourOOne"];
  $siteSettings['403'] = $siteSettings['403'] = $_POST["fourOThree"];
  $siteSettings['offline'] = isset($_POST["offline"]) ? true : false;
  $siteSettings['offlineMessage'] = $_POST["offlineMessage"];

  file_put_contents(siteRootFolder.'/siteSettings.json', json_encode($siteSettings));
    header("Refresh:0");
}

function getTemplates($location){
  global $siteSettings;
  if ($location == "site"){
    $templateFolder = '../templates/';
  } elseif ($location == "admin"){
    $templateFolder = 'template/';
  }
  $availableTemplates = array_diff(scandir($templateFolder), array('..', '.',));

  foreach ($availableTemplates as $key => $value) {
    //will return something like this:
    //<option name='template' id='template' value='whatever folders found'>Whatever the folder name is</option>
    echo "\n<option value='".$value."' ";
    if($siteSettings['template'] == $value){
      echo ('selected="selected"');
    }
    echo ">".$value."</option>";
  }
}

function getTimezones(){
  global $siteSettings;
  
    /**
 * Timezones list with GMT offset
 *
 * @return array
 * @link http://stackoverflow.com/a/9328760
* @link http://stackoverflow.com/questions/4755704/php-timezone-list
 */
$timezones = array(
    'Pacific/Midway'       => "(GMT-11:00) Midway Island",
    'US/Samoa'             => "(GMT-11:00) Samoa",
    'US/Hawaii'            => "(GMT-10:00) Hawaii",
    'US/Alaska'            => "(GMT-09:00) Alaska",
    'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
    'America/Tijuana'      => "(GMT-08:00) Tijuana",
    'US/Arizona'           => "(GMT-07:00) Arizona",
    'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
    'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
    'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
    'America/Mexico_City'  => "(GMT-06:00) Mexico City",
    'America/Monterrey'    => "(GMT-06:00) Monterrey",
    'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
    'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
    'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
    'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
    'America/Bogota'       => "(GMT-05:00) Bogota",
    'America/Lima'         => "(GMT-05:00) Lima",
    'America/Caracas'      => "(GMT-04:30) Caracas",
    'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
    'America/La_Paz'       => "(GMT-04:00) La Paz",
    'America/Santiago'     => "(GMT-04:00) Santiago",
    'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
    'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
    'Greenland'            => "(GMT-03:00) Greenland",
    'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
    'Atlantic/Azores'      => "(GMT-01:00) Azores",
    'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
    'Africa/Casablanca'    => "(GMT) Casablanca",
    'Europe/Dublin'        => "(GMT) Dublin",
    'Europe/Lisbon'        => "(GMT) Lisbon",
    'Europe/London'        => "(GMT) London",
    'Africa/Monrovia'      => "(GMT) Monrovia",
    'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
    'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
    'Europe/Berlin'        => "(GMT+01:00) Berlin",
    'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
    'Europe/Brussels'      => "(GMT+01:00) Brussels",
    'Europe/Budapest'      => "(GMT+01:00) Budapest",
    'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
    'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
    'Europe/Madrid'        => "(GMT+01:00) Madrid",
    'Europe/Paris'         => "(GMT+01:00) Paris",
    'Europe/Prague'        => "(GMT+01:00) Prague",
    'Europe/Rome'          => "(GMT+01:00) Rome",
    'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
    'Europe/Skopje'        => "(GMT+01:00) Skopje",
    'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
    'Europe/Vienna'        => "(GMT+01:00) Vienna",
    'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
    'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
    'Europe/Athens'        => "(GMT+02:00) Athens",
    'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
    'Africa/Cairo'         => "(GMT+02:00) Cairo",
    'Africa/Harare'        => "(GMT+02:00) Harare",
    'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
    'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
    'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
    'Europe/Kiev'          => "(GMT+02:00) Kyiv",
    'Europe/Minsk'         => "(GMT+02:00) Minsk",
    'Europe/Riga'          => "(GMT+02:00) Riga",
    'Europe/Sofia'         => "(GMT+02:00) Sofia",
    'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
    'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
    'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
    'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
    'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
    'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
    'Europe/Moscow'        => "(GMT+03:00) Moscow",
    'Asia/Tehran'          => "(GMT+03:30) Tehran",
    'Asia/Baku'            => "(GMT+04:00) Baku",
    'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
    'Asia/Muscat'          => "(GMT+04:00) Muscat",
    'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
    'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
    'Asia/Kabul'           => "(GMT+04:30) Kabul",
    'Asia/Karachi'         => "(GMT+05:00) Karachi",
    'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
    'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
    'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
    'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
    'Asia/Almaty'          => "(GMT+06:00) Almaty",
    'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
    'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
    'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
    'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
    'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
    'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
    'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
    'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
    'Australia/Perth'      => "(GMT+08:00) Perth",
    'Asia/Singapore'       => "(GMT+08:00) Singapore",
    'Asia/Taipei'          => "(GMT+08:00) Taipei",
    'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
    'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
    'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
    'Asia/Seoul'           => "(GMT+09:00) Seoul",
    'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
    'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
    'Australia/Darwin'     => "(GMT+09:30) Darwin",
    'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
    'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
    'Australia/Canberra'   => "(GMT+10:00) Canberra",
    'Pacific/Guam'         => "(GMT+10:00) Guam",
    'Australia/Hobart'     => "(GMT+10:00) Hobart",
    'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
    'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
    'Australia/Sydney'     => "(GMT+10:00) Sydney",
    'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
    'Asia/Magadan'         => "(GMT+12:00) Magadan",
    'Pacific/Auckland'     => "(GMT+12:00) Auckland",
    'Pacific/Fiji'         => "(GMT+12:00) Fiji",
);

  foreach ($timezones as $key => $value) {
    echo "\n<option value='".$key."' ";
    if($siteSettings['timezone'] == $key){
      echo ('selected="selected"');
    }
    echo ">".$value."</option>";
  }
}

?> 
<html>

<p>All these informations are used in the main site (and some in the admin interface) at various locations. For example the sitename is used in the page title, the footer and in the sent out emails in the contact form. </p>
<p>Feel free to modify these, just make sure, that you don't leave them empty, so all my work doesn't goes to waste!</p>
<!-- global settings form -->
<form method="post" name="globalSettingsForm" id="globalSettingsForm" action="">
  <div id="form">

    <p>
    <label>Site name:</label>
    <br />
    <input required name="siteName" type="text" id="siteName" size="50" value="<?php echo $siteName;?>" />
    </p>

    <p>
    <label>Site description:</label>
    <br />
    <textarea name="description" rows="10" cols="50" id="description"><?php echo $description;?></textarea>
    </p>

    <p>
    <label>The year the site operates from:</label>
    <br />
    <input name="siteFromYear" type="number" id="siteFromYear" size="50" value="<?php echo $siteFromYear; ?>" />
    </p>

    <p>
      <label>Set the timezone of the site:</label>
      <br />
      <select name="timezone" id="timezone" >
        <?php getTimezones(); ?>
      </select>
    </p>

    <p>
    <label>Template:</label>
    <br />
    <select name="template" id="template" >
      <?php getTemplates("site"); ?>
    </select>
    </p>


    <p>
    <label>The email address the site should write to when a contact form is sent:</label>
    <br />
    <input required name="contactEmail" type="email" id="contactEmail" size="50" value="<?php echo $contactEmail;?>" />
    </p>

    <p>
    <label>The email address that the site is sending emails from:</label>
    <br />
    <input required name="outgoingEmailFrom" type="email" id="outgoingEmailFrom" size="50" value="<?php echo $outgoingEmailFrom;?>" />
    </p>

    <p>
    <label>Customise the 404 error message:</label>
    <br />
    <textarea name="fourOFour" rows="10" cols="50" id="fourOFour" required class="showEditor"><?php echo $fourOFour;?></textarea>
    </p>

    <p>
    <label>Customise the 401 error message:</label>
    <br />
    <textarea name="fourOOne" rows="10" cols="50" id="fourOOne" class="showEditor"><?php echo $fourOOne;?></textarea>
    </p>

    <p>
    <label>Customise the 403 error message:</label>
    <br />
    <textarea name="fourOThree" rows="10" cols="50" id="fourOThree" class="showEditor"><?php echo $fourOThree;?></textarea>
    </p>

    <p>
    <label style="color:red;">Site offline? CAUTION! (but you can uncheck it any time!)</label>
    <input name="offline" type="checkbox" id="offline" size="50" <?php echo $offline ? "checked":"";?> />
    </p>

    <p>
    <label>Customise the offline message:</label>
    <br />
    <textarea name="offlineMessage" rows="10" cols="50" id="offlineMessage" class="showEditor"><?php echo $offlineMessage;?></textarea>
    </p>

    <p>
    <input name="save" type="submit" id="save" value="Save settings" />
    </p>
  </div>


<?php include(adminRootFolder.'/wyswyg.php'); ?>