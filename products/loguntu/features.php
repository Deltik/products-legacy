<?php

include ("core.php");

// Display Configuration
autodefine('LOGUNTU_TITLE', "Loguntu : Features");

$plans = array(0 => array("Free", "Contributor", "Customer", "<span style=\"font-weight: normal;\">Description</span>"),
               "Price" => array("FREE", "Varies", "$0.99/mo", "How much the Loguntu service costs"),
               "Storage Space" => array("50 MB", "50+ MB", "1+ GB", "Storage space limit after compression and encryption"),
               "Web Access" => array(1, 1, 1, "Access your logs anytime online"),
               "Mobile Access" => array(1, 1, 1, "Access your logs on your mobile phone"),
               "Desktop Uploader" => array(1, 1, 1, "Make your logs accessible to you online"),
               "Download Logs" => array(1, 1, 1, "Take grand unified backups of your logs"),
               "Search Logs Online" => array(0, 1, 1, "Use filters to search your logs"),
               "Priority Support" => array(0, 1, 1, "Get dedicated help ASAP"),
               "Enhanced Data Protection" => array(0, 0, 1, "Extra measures taken to ensure that your data's safe"),
               "Synchronize Chat Logs" => array(0, 0, 1, "Update chat logs throughout all your clients"),
               "Direct Access" => array(0, 0, 1, "Manipulate and edit your chat logs"),
               "Personal File Hosting" => array(0, 0, 1, "Use Loguntu as a file host"),
               );

$plans_disp = "<table>\n";
$plans_disp .= " <thead>\n  <th></th>\n";
foreach ($plans[0] as $plan_item)
  {
  $plans_disp .= "  <th>$plan_item</th>\n";
  }
$plans_disp .= " </thead>\n <tbody>\n";
unset($plans[0]);
foreach ($plans as $key => $plan_items)
  {
  $plans_disp .= "  <tr>\n";
  $plans_disp .= "   <th>$key</th>\n";
  foreach ($plan_items as $plan_item)
    {
    if ($plan_item === 0) $plan_item = '<img src="images/dialog-no.png" alt="No" />';
    if ($plan_item === 1.5) $plan_item = '<img src="images/dialog-maybe.png" alt="Varies" />';
    if ($plan_item === 1) $plan_item = '<img src="images/dialog-yes.png" alt="Yes" />';
    if (next($plan_items) !== FALSE)
      {
      $plans_disp .= "  <td>$plan_item</td>\n";
      }
    else
      {
      $plans_disp .= "  <td style=\"text-align: left;\">$plan_item</td>\n";
      }
    }
  $plans_disp .= "  </tr>\n";
  }
$plans_disp .= " </tbody>\n</table>";

autodefine('LOGUNTU_BODY', <<<body
<div class="featurecontainer">
 <div class="featuresection">
  <h1>Store with ease</h1>
 </div>
 <div class="featuresectionnoborder">
  <h1>Plans</h1>
body
.
indent($plans_disp, 2)
.
<<<body
 </div>
</div>
<style type="text/css">
.featurecontainer {
	border: 1px solid #55200b;
	border-radius: 12px;
}
.featuresection {
	border-bottom: 1px solid #55200b;
	padding: 8px;
}
.featuresectionnoborder {
	padding: 8px;
}

.featurecontainer table {
	border-collapse: collapse;
	border: 1px solid #b6937b;
}
.featurecontainer tbody th {
	padding: 4px;
	text-align: right;
}
.featurecontainer thead th, td {
	padding: 4px;
	text-align: center;
}
.featurecontainer th {
	background: #ecc797;
	color: #55200b;
}
</style>
body
);

autodefine('LOGUNTU_LOGO', '<div id="logo">&nbsp;</div>');

// Display!
$LOGUNTU->display();
?>
