<?php include_once ("theme.php"); $template = new Template(); ?>    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 <!-- Theme Style -->
 <link rel="stylesheet" href="<?=THEME_REL?>style.css" type="text/css" media="all" />
 <!-- System Style -->
 <link rel="stylesheet" href="<?=$system['style']?>" type="text/css" media="all" />
 <!-- System Script -->
 <script type="text/javascript" src="<?=$system['script']?>"></script>
 <title><?=$system['title_flush']?></title>
</head>
<body>
<!-- Main Container -->
<div id="main_container">
 <!-- Header -->
 <table class="header">
  <tr>
  <!-- Left Header -->
   <td style="background: url('<?=THEME_REL?>images/header-background-left.png') #E4A20D no-repeat; width: 5px;">
    <img src="<?=THEME_REL?>images/header-background-left.png" />
   </td>
   <!-- Logo -->
   <td>
    <img src="<?=$system['logo']?>" />
   </td>
   <!-- Login Box -->
   <td style="float: right;">
<?php echo $template->func("loginForm", array("mode" => "full")); ?>
   </td>
   <!-- Right Header -->
   <td style="background: url('<?=THEME_REL?>images/header-background-right.png') #E4A20D no-repeat; width: 5px;">
    <img src="<?=THEME_REL?>images/header-background-right.png" />
   </td>
  </tr>
 </table>
 <!-- Navibar -->
 <table class="navibar">
  <tr>
  <!-- Left Header -->
   <td style="background: url('<?=THEME_REL?>images/navibar-background-left.png') #E4A20D no-repeat; width: 5px;">
    <img src="<?=THEME_REL?>images/navibar-background-left.png" />
   </td>
   <!-- Login Box -->
   <td style="width: 100%; text-align: center;">
    Navibar: TODO
   </td>
   <!-- Right Header -->
   <td style="background: url('<?=THEME_REL?>images/navibar-background-right.png') #E4A20D no-repeat; width: 5px;">
    <img src="<?=THEME_REL?>images/navibar-background-right.png" />
   </td>
  </tr>
 </table>
 <!-- Main Content Section -->
 <!-- Top Style -->
 <div class="content_top">
  <div style="background: url('<?=THEME_REL?>images/body-top-left.png') #E4A20D no-repeat; background-position: top left; float: left; width: 5px; height: 8px; top: 0px; left: 0px;">&nbsp;</div>
  <div style="background: url('<?=THEME_REL?>images/body-top-right.png') #E4A20D no-repeat; background-position: top right; float: right; width: 5px; height: 8px; top: 0px; right: 0px;">&nbsp;</div>&nbsp;
 </div>
 <!-- Main Content -->
 <div class="content" id="content">
  <?=$system['content_flush']?>
 </div>
 <!-- Bottom Style -->
 <div class="content_bottom">
  <div style="background: url('<?=THEME_REL?>images/body-bottom-left.png') #E4A20D no-repeat; background-position: bottom left; float: left; width: 5px; height: 8px; top: 0px; left: 0px;">&nbsp;</div>
  <div style="background: url('<?=THEME_REL?>images/body-bottom-right.png') #E4A20D no-repeat; background-position: bottom right; float: right; width: 5px; height: 8px; top: 0px; right: 0px;">&nbsp;</div>&nbsp;
 </div><?php if ($system['disclaimer']) { ?>
 <!-- Footer Section -->
 <div class="footer_box">
  <!-- Top Style -->
  <div class="footer_top">
   <div style="background: url('<?=THEME_REL?>images/footer-top-left.png') #E4A20D no-repeat; background-position: top left; float: left; width: 5px; height: 8px; top: 0px; left: 0px;">&nbsp;</div>
   <div style="background: url('<?=THEME_REL?>images/footer-top-right.png') #E4A20D no-repeat; background-position: top right; float: right; width: 5px; height: 8px; top: 0px; right: 0px;">&nbsp;</div>&nbsp;
  </div>
  <!-- Footer -->
  <div class="footer" id="footer">
   <?php eval('echo \''.$system['disclaimer'].'\';'); ?>
  </div>
 </div><?php } ?>
</div>
</body>
</html>
