<?php

// Alpha Note
echo '<p>Under Construction...</p>';

// Introduction
echo '<p>Deltik is sad that most people don\'t know about Linux, so he made a quiz to see if you will like Linux. Feel free to check everything. A Linux distribution will be there. That "Please don\'t check these!" section lets you know Linux\'s weaknesses.</p>';

// Away from Microsoft Windows
echo '
<h2>My Current Operating System</h2>
<p>[&nbsp;&nbsp;] I use Microsoft Windows.<br />
[&nbsp;&nbsp;] I am unsatisfied with Microsoft Windows.<br />
[&nbsp;&nbsp;] I think Windows is costly ($100 and more is crazy).<br />
[&nbsp;&nbsp;] I think Windows takes too long to start up (averagely, more than 30 seconds).<br />
[&nbsp;&nbsp;] When I am logged in, it takes a while to open a program like Internet Explorer (it feels like I could take a jog and come back for it to load).<br />
[&nbsp;&nbsp;] I don\'t like Internet Explorer or I am interested in the world\'s best web browser, Mozilla Firefox.<br />
[&nbsp;&nbsp;] Windows lags and/or freezes, even when I am not playing a graphical game (so I have to pull up Task Manager to pry that program out).<br />
[&nbsp;&nbsp;] I think the Start Menu is unorganized (it\'s hard to find stuff).<br />
[&nbsp;&nbsp;] I would rather use a Mac, but they are too costly.<br />
[&nbsp;&nbsp;] I am worried about viruses and malware.<br />
[&nbsp;&nbsp;] I don\'t want to pay for antimalware software.<br />
[&nbsp;&nbsp;] Windows gives me annoying popups or messages (AHH! "Send Error Report", "Security Warning", Blue Screen of Death, "Virus Protection - Not Found"; MAKE IT STOP!!!).<br />
[&nbsp;&nbsp;] I see that many computers that come with Windows prompt for you to take Microsoft Office\'s 60-day free trial. I want a free office suite.<br />
[&nbsp;&nbsp;] I am unsatisfied with Microsoft Update (it is slow; it often suddenly jumps from 0% to 100%; it forces my computer to restart sometimes).<br />
[&nbsp;&nbsp;] I wish I could download and install free software as easily as checking a check box.</p>';

// Basic information to collect
echo'
<h2>Basic</h2>
<p>[&nbsp;&nbsp;] I want an operating system that is free with no catches.<br />
[&nbsp;&nbsp;] I want an operating system that is fast with no long waits.<br />
[&nbsp;&nbsp;] I want an operating system with no viruses, spyware, and other malware in their world.<br />
[&nbsp;&nbsp;] I want an operating system with no headaches.<br />
[&nbsp;&nbsp;] I want an operating system that is supported by everyone in a community, not by a big company.<br />
[&nbsp;&nbsp;] I want to have an operating system\'s source code.</p>';

// Software
echo '
<h2>Software</h2>
<p>[&nbsp;&nbsp;] I want the world\'s best Internet browser (Mozilla Firefox) included on my operating system or I don\'t want Internet Explorer and want something else.<br />
[&nbsp;&nbsp;] I want a full-force CD/DVD creator.<br />
[&nbsp;&nbsp;] I want to put sticky notes on my desktop.<br />
[&nbsp;&nbsp;] I want to have some built-in games to keep me occupied.<br />
[&nbsp;&nbsp;] I want to have an office suite that comes with my operating system.<br />
[&nbsp;&nbsp;] I want to have an image editor that is like Adobe Photoshop.<br />
[&nbsp;&nbsp;] I want to be able to use my printer/scanner with software included in my operating system.<br />
[&nbsp;&nbsp;] I want to have one program to handle all my IM accounts.<br />
[&nbsp;&nbsp;] I want to be able to make phone calls from my computer.<br />
[&nbsp;&nbsp;] I want a full email client.<br />
[&nbsp;&nbsp;] I want to connect to other people\'s computer and help them remotely.<br />
[&nbsp;&nbsp;] I want a dictionary on my desktop.<br />
[&nbsp;&nbsp;] I want a movie/music player and/or a sound recorder.<br />
[&nbsp;&nbsp;] I want to be able to download and install lots of free software from a program manager on my desktop.</p>';

// Personalize
echo '
<h2>Personalize</h2>
<p>[&nbsp;&nbsp;] I want to change my look and feel in an organized fashion.<br />
[&nbsp;&nbsp;] I want awesome desktop effects like <span id="compizcube"><button onclick="showCube();">this</button></span>.<br />
<script type="text/javascript">
function showCube()
 {
 document.getElementById("compizcube").innerHTML="<button onclick=\"hideCube();\"><img src=\"images/compiz-desktop-cube.png\" /></button>";
 }
function hideCube()
 {
 document.getElementById("compizcube").innerHTML="<button onclick=\"showCube();\">this</button>";
 }
</script>
[&nbsp;&nbsp;] I want to set my own keyboard shortcuts.<br />
[&nbsp;&nbsp;] I want to configure hardware in an organized fashion.<br />
[&nbsp;&nbsp;] I want to configure my network and Internet in an organized fashion.<br />
[&nbsp;&nbsp;] I want to change my way of running my desktop in an organized fashion.</p>';

// Administration
echo '
<h2>Administration</h2>
<p>[&nbsp;&nbsp;] I want to be able to give certain authorizations to a user.<br />
[&nbsp;&nbsp;] I want to be able to change how my computer\'s login screen looks.<br />
[&nbsp;&nbsp;] I want a program to configure software sources for an software downloader and installer I wanted in the "Basic" section.<br />
[&nbsp;&nbsp;] I want a more advanced software manager that feels like the easy software downloader and installer I wanted in the "Basic" section.<br />
[&nbsp;&nbsp;] I want to configure start-up programs.<br />
[&nbsp;&nbsp;] I want a system monitor that gives me information about my computer and can terminate unresponsive programs.<br />
[&nbsp;&nbsp;] I want a program to test to see if my computer is working properly.<br />
[&nbsp;&nbsp;] I want to have my flash drive run my operating system.<br />
[&nbsp;&nbsp;] I want a program to edit users and what their permissions.</p>';

// Server
echo '
<h2>Server</h2>
<p>[&nbsp;&nbsp;] I want to run a server using an operating system that can stay online as long as I want it.</p>';

// Please don't check these!
echo '
<h2>Please don\'t check these!</h2>
<p>[&nbsp;&nbsp;] I am heavy computer gamer. Most, if not all, of your computer games work only on Microsoft Windows. Special software called WINE on Linux will emulate Windows for your games, but is not 100% effective. Your Windows games running on Linux may have glitches or may not work at all.<br />
[&nbsp;&nbsp;] I am a computer dummy. Unless you think you are capable of figuring out how Linux works, maybe you should get a book about Linux and read about it. Nah, scratch that. Linux books always make you think Linux is for computer geeks. Some distrubutions like <a href="http://www.ubuntu.com/">Ubuntu</a> are actually no where close to being as hard as the books are describing Linux.';

?>
