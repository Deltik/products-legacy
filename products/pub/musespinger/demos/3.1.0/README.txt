[Multiple Server Status Pinger]

╔═══════════════════════════════════════════════╤═╤═╤═╗
║Information                                    │-│■│X║
╟───────────────────────────────────────────────┴─┴─┴─╢
║Version: 3.1.0 (v3.1.0)                              ║
║Website: http://www.deltik.org/                      ║
║Information: http://products.deltik.org/musespinger/ ║
║E-Mail: webmaster@deltik.org                         ║
║Release Date: 07 July 2011                           ║
╚═════════════════════════════════════════════════════╝

▛▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▜
▌ CONTENTS OF THIS FILE ▐
▙▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▟
 * About MuSeSPinger
 * Requirements and Notes
 * Installation
 * Configuration and Features
 * Known Problems
 * More Information
 * Version History


┏━━━━━━━━━━━━━━━━━━━┓
┃ ABOUT MUSESPINGER ┃
┗━━━━━━━━━━━━━━━━━━━┛
Multiple Server Status Pinger, often simply called "MuSeSPinger", checks the
status of websites by the masses.

Legal information about MuSeSPinger:
 * Know your rights when using MuSeSPinger:
   See LICENSE.txt in the same directory as this document.


┏━━━━━━━━━━━━━━━━━━━━━━━━┓
┃ REQUIREMENTS AND NOTES ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━┛
MuSeSPinger requires:
  - A Web server. Apache (version 2.0 or greater) is recommended.
    <http://httpd.apache.org/>
  - PHP 5 (or greater) <http://www.php.net/>
    - cURL should be enabled and unrestricted for best results.
    - fsockopen may be used as an alternative to cURL with less detailed
      results.
    - file_get_contents() is needed for joining a MuSeSPinger network or as
      another (not recommended) alternative to cURL and fsockopen.


┏━━━━━━━━━━━━━━┓
┃ INSTALLATION ┃
┗━━━━━━━━━━━━━━┛
Install MuSeSPinger in three easy steps:
  ┌─────────────┐
  │ REMOTE HOST │
  └─────────────┘
  1.1: If you can extract archives on the remote host, upload the MuSeSPinger
       package to the directory that you want to run MuSeSPinger on.
  1.2: If you cannot extract archives on the remote host, extract them on your
       local host and then upload the files inside the MuSeSPinger archive to
       the remote host.
  2.1: Visit the corresponding HTTP page of MuSeSPinger in a Web browser.
  3.1: There is no step 3.
  ┌────────────┐
  │ LOCAL HOST │
  └────────────┘
  1.1: Extract the MuSeSPinger archive package into the directory that you want
       to run MuSeSPinger on.
  2.2: Visit the corresponding HTTP page of MuSeSPinger in a Web browser.
  3.1: There is no step 3.


┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃ CONFIGURATION AND FEATURES ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
Basic configuration of MuSeSPinger is located in the config.php file.
These are the required configuration elements in MuSeSPinger:
  - $online : The path of the "online" icon
  - $offline : The path of the "offline" icon
  - $midline : The path of the "online with problems" icon
  - $noline : The path of the "status unavailable" icon
  - ISUP_METHOD : The method that you want MuSeSPinger to use

Configurable constants begin with "ISUP_".
config.php should be the file that contains all the constants.
Configurable constants may be inserted anywhere in the execution process.

List of configurable constants:
  - ISUP_METHOD : Required. MuSeSPinger supports cURL, fsockopen, and
      file_get_contents, respective in decreasing effectiveness and increasing
      compatibility with webservers.
  - ISUP_VERSION : Should not be changed. This is a system constant that
      contains the version number of the current MuSeSPinger you are running.
  - ISUP_NAME : The name of the MuSeSPinger service you are operating. Rename
      it at your own discretion.
  - ISUP_NETWORK : The URL to the MuSeSPinger network you want to join. Having
      a network allows a client to check sites from many locations. Do not
      specify a URL if you want to disable networking.

This is the structure of MuSeSPinger:
  - ./admin.php : The administration control center
  - ./config.php : The configuration file of MuSeSPinger
  - ./core.php : The crucial file that contains important functions and data
  - ./img.php : The old image renderer, which still needs to be updated
  - ./images/ : This directory contains the status images.
  -- midline.png : The default image for "online with problems"
  -- noline.png : The default image for "unknown online status"
  -- offline.png : The default image for "offline"
  -- online.png : The default image for "online"
  - ./index.php : The main page of MuSeSPinger
  - ./status.php : The crucial file that makes MuSeSPinger work
  - ./style.css : Stylesheet for MuSeSPinger
  - ./LICENSE.txt : Know your rights when using MuSeSPinger.
  - ./README.txt : It is the informational file that you are reading right now.


┏━━━━━━━━━━━━━━━━┓
┃ KNOWN PROBLEMS ┃
┗━━━━━━━━━━━━━━━━┛
All systems go! We haven't found any problems yet.


┏━━━━━━━━━━━━━━━━━━┓
┃ MORE INFORMATION ┃
┗━━━━━━━━━━━━━━━━━━┛
For more information, updates, and just... more..., visit Deltik's Web site
at <http://www.deltik.org/>.


┏━━━━━━━━━━━━━━━━━┓
┃ VERSION HISTORY ┃
┗━━━━━━━━━━━━━━━━━┛
3.1.0 (2011/07/07)
  - NEW: Mouseover server status details
  - NEW: Mouseover mirror information
  - FIX: Improved AJAX data fetching
  - FIX: Minor English grammar fix
  - FIX: Cache disabled for remote table rendering
  - FIX: API typo with cURL system for "reason"

3.0.0 (2011/05/20)
  - NEW: Completely rewritten
  - NEW: Redesigned interface
  - NEW: cURL and file_get_contents for server status checking
  - NEW: MuSeSPinger network for worldwide server status checking
  - NEW: Option to render without the network: "Work Locally"
  - NEW: Status icons for "online with problems" and "status unavailable"
  - NEW: No JavaScript compatibility
  - NEW: "Report Problem" link
  - NEW: Administration control center for modifying configuration
  - NEW: Fetch MuSeSPinger news from Deltik
  - MOD: URL input uses line breaks instead of spaces.
  - MOD: Remade status icons
  - MOD: Foreign language support removed
  - MOD: Automatic update system removed
  - MOD: 'update' directory re-purposed to MuSeSPinger news
  - MOD: Implemented GNU GPL License

2.1.0b (2011/02/04)
  - NEW: Implemented image output feature

2.1.0a (2010/10/24)
  - FIX: Improved update system to eliminate 500 Internal Server Errors

2.0.1a4
  - FIX: Fixed a critical Update Manager bug in which only the last update server was considered for use

2.0.1a3
  - MOD: Cleaned up source code to meet the Deltik Programming Syntax Standard

2.0.1a2 (2009/12/30)
  - FIX: Fixed Update System

2.0.1a1
  - FIX: Update System Test

2.0.1a
  - NEW: Added Background Communications (API)

2.0.0a (2009/10/31)
  - Initial Release
  - NEW: Redesigned interface
  - FIX: Massively optimized

1.0.0pre
  - Undocumented Version
  - MOD: Renamed to MuSeSPinger

0.5.0 (2008/20/09)
  - Released by JRD as imw_status_viewer 0.5
  - NEW: Massively improved backend
  - MOD: Called IMWNSC (IsMyWebsite Node Status Checker) 0.5.0

0.4.3
  - Undocumented Version
