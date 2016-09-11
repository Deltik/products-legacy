<?php
/**
 * MuSeSPinger
 *  Main File
 * 
 * License:
 *  This file is part of MuSeSPinger.
 *  
 *  MuSeSPinger is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *  
 *  MuSeSPinger is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with MuSeSPinger.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

include ("core.php");

// Input Checking
if (!isset($_REQUEST['urls'])) $_REQUEST['urls'] = null;

?><!DOCTYPE html>
<html>
<head>
 <title><?=ISUP_NAME?></title>
 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>
<body onload="start();">
<!-- Main Container -->
<div id="main">
<table class="main">
 <tbody>
  <tr>
   <td class="inbar">
    <div id="inbar">
     <!-- Form only used for no-JavaScript compatibility -->
     <form action="<?=$_SERVER['PHP_SELF']?>">
      <input type="hidden" name="action" value="go" />
      <textarea name="urls" id="urls" cols="35" rows="5" placeholder="Server(s) to test" onkeyup="go();"><?=$_REQUEST['urls']?></textarea>
      <div id="advisory">Press Enter to specify more URLs</div>
      <span id="submitter">
       <br />
       <input type="radio" name="mode" id="mode_table" value="table" checked="checked" /><label for="mode_table"> Table</label><br />
       <input type="radio" name="mode" id="mode_image" value="image" /><label for="mode_image"> Image</label><br />
       <input type="submit" value="Go" />
      </span>
     </form>
    </div>
   </td>
   <td class="outbar">
    <div id="outbar">
     <?=$output?>
    </div>
   </td>
  </tr>
 </tbody>
</table>

</div>

<!-- Footer Container -->
<div id="footer">
<span class="glow"><?=ISUP_NAME?></span>
<br />
<span style="font-size: 18px;"><strong>Mu</strong>ltiple <strong>Se</strong>rver <strong>S</strong>tatus <strong>Pinger</strong> v<?=ISUP_VERSION?></span>
</div>

<!-- Floating Containers -->
<!-- Settings -->
<div id="settings" style="display: none;">
	<input type="checkbox" id="local" value="local" onchange="go();" /><label for="local"> Work Locally</label><br />
	<input type="checkbox" id="mode" value="image" onchange="go();" /><label for="mode"> Render Image</label>
</div>
<!-- Infobox -->
<div id="infobox" style="display: none;">
	Test content
</div>
<!-- Report Problems Link -->
<span style="position: fixed; bottom: 0px; right: 0px; padding: 8px; background: red; color: white; font-size: 12px; border-left: 4px red outset; border-top: 4px red outset; border-radius: 15px 0px 0px 0px; -moz-border-radius: 15px 0px 0px 0px; -webkit-border-radius: 15px 0px 0px 0px;" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.cursor='default';" onclick="if(!disable)window.open(document.getElementById('reportproblem').href);"><a href="http://www.deltik.org/contact.php?subject=[MuSeSPinger]%20I%20Found%20a%20Problem&body=%28Provide%20details%20of%20your%20problem%20or%20bug%20report%20here.%20Be%20descriptive.%29" target="_blank" style="color: white;" id="reportproblem" onmouseover="disable=true;" onmouseout="disable=false;">Report Problem</a></span>

<!-- JavaScript -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
/***********\
| VARIABLES |
\***********/
var xhr = $.ajax();


/***********\
| FUNCTIONS |
\***********/

/**
 * Initialize
 */
function start()
{
	adaptTextareaSize();
	
	// Fit the page for JavaScript
	$('#settings').show();
	$('#submitter').hide();
	
	// Render if there is already content in the textarea
	if ($('#urls').val().length > 0)
		go();
}

/**
 * Go
 */
function go()
{
	// Get the current input
	var soFar = $('#urls').val();
	// Break the input by line
	soFarItems = soFar.split("\n");
	
	// Adapt textarea size
	adaptTextareaSize();
	// Check advisory message
	if (soFarItems.length > 1)
		$('#advisory').css('display', "none");
	else
		$('#advisory').css('display', "inherit");
	
	// The Real "Go"
	var append = "";
	if ($('#local').prop('checked'))
		workLocally();
	if ($('#mode').prop('checked'))
		renderImage();
	if (!$('#local').prop('checked') && !$('#mode').prop('checked'))
	{
		xhr.abort();
		xhr = $.ajax(
		{
			type: "POST",
			url: "index.php",
			data: 'action=go&ajax=true&urls='+escape(soFar)+append,
			success: function(result)
			{
				$('#outbar').html(result);
			}
		});
	}
}

/**
 * Adapt Input Textarea Size
 */
function adaptTextareaSize()
{
	// Get the current input
	var soFar = $('#urls').val();
	// Break the input by line
	soFarItems = soFar.split("\n");
	// Check column size
	var maxCol = 35;
	for (i in soFarItems)
	{
		if (soFarItems[i].length > maxCol)
			maxCol = soFarItems[i].length;
	}
	// Check row size
	var maxRow = 5;
	if (soFarItems.length > maxRow)
	maxRow = soFarItems.length;
	// Set
	$('#urls').attr('rows', maxRow);
	$('#urls').attr('cols', maxCol);
}

/**
 * Work Locally
 */
function workLocally()
{
	var soFarItems = $('#urls').val().split("\n");
	var table = '<table>';
	for (i in soFarItems)
	{
	var date = new Date;
	var unixtime_ms = date.getTime();
	var unixtime = parseInt(unixtime_ms / 1000);
	table = table + '<tr><td>' + soFarItems[i] + '</td><td><img src="status.php?data='+soFarItems[i]+'&time='+unixtime+'" /></td></tr>';
	}
	table = table + '</table>';
	$('#outbar').html(table);
}

/**
 * Render Image
 */
function renderImage()
{
	var date = new Date;
	var unixtime_ms = date.getTime();
	var unixtime = parseInt(unixtime_ms / 1000);
	$('#outbar').html('<img src="img.php?' + escape($('#urls').val()) + '&time=' + unixtime + '" alt="Loading status image...  If the image does not appear within <?=ini_get('max_execution_time')?> seconds, then the image could not be loaded." />');
}

/**
 * Display Infobox
 */
function showInfo(url)
{
	$('body').css('cursor', 'progress');
	$('#infobox').stop(true, true);
	$('#infobox').html('<iframe style="width: 235px; height: 155px; border: 0px; overflow: hidden;" src="'+url+'" onload="$(\'body\').css(\'cursor\', \'default\');"></iframe>');
	$('#infobox').slideDown();
}

/**
 * Hide Infobox
 */
function hideInfo()
{
	$('body').css('cursor', 'default');
	$('#infobox').slideUp();
}
</script>
</body>
</html>
