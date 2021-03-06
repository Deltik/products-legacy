[Log2Log Chat Log Converter]

╔═══════════════════════════════════════════╤═╤═╤═╗
║Information                                │-│■│X║
╟───────────────────────────────────────────┴─┴─┴─╢
║Version: 0.0.1 Alpha 2 (v0.0.1a2)                ║
║Website: http://www.deltik.org/                  ║
║Information: http://products.deltik.org/log2log/ ║
║E-Mail: webmaster@deltik.org                     ║
║Release Date: 27 March 2011                      ║
╚═════════════════════════════════════════════════╝

▛▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▜
▌ CONTENTS OF THIS FILE ▐
▙▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▟
 * About Log2Log
 * Requirements and Notes
 * Installation
 * Configuration and Features
 * Known Problems
 * More Information
 * Version History


┏━━━━━━━━━━━━━━━┓
┃ ABOUT LOG2LOG ┃
┗━━━━━━━━━━━━━━━┛
Log2Log Chat Log Converter, often simply called "Log2Log", is an online PHP
service that converts uploaded chat logs to another format and returns the new
format to the user.

Legal information about Log2Log:
 * Know your rights when using Log2Log:
   See LICENSE.txt in the same directory as this document.


┏━━━━━━━━━━━━━━━━━━━━━━━━┓
┃ REQUIREMENTS AND NOTES ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━┛
Log2Log requires:
  - A Web server. Apache (version 2.0 or greater) is recommended.
    <http://httpd.apache.org/>
  - PHP 5.2.0 (or greater) <http://www.php.net/>
    - eval() is a core function and needs to be enabled.
    - file_get_contents() for local data processing is very important.
    - Access to the temporary directory (UNIX /tmp ) is crucial

Log2Log recommends for the best functionality:
  - The ZipArchive class should be installed on PHP so that Log2Log can support
    .ZIP files. (This feature has not yet been implemented as of v0.0.1a1.)
  - gzip and bzip classes should also be installed to support .TAR.GZ and
    .TAR.BZ2 files. (This feature also hasn't been implemented yet.)
  - file_get_contents() for remote URLs is used in some conversion formats
    such as MeeboConnect and should be enabled. Log2Log also checks for updates
    by downloading information from update servers. (Updates not implemented.)


┏━━━━━━━━━━━━━━┓
┃ INSTALLATION ┃
┗━━━━━━━━━━━━━━┛
Install Log2Log in three easy steps:
  ┌─────────────┐
  │ REMOTE HOST │
  └─────────────┘
  1.1: If you can extract archives on the remote host, upload the Log2Log
       package to the directory that you want to run Log2Log on.
  1.2: If you cannot extract archives on the remote host, extract them on your
       local host and then upload the files inside the Log2Log archive to the
       remote host. If you must follow this step, then Log2Log might not work
       because file archive handling is an important feature that ensures the
       functionality of Log2Log.
  2.1: Visit the corresponding HTTP page of Log2Log on a Web browser.
  3.1: There is no step 3.
  ┌────────────┐
  │ LOCAL HOST │
  └────────────┘
  1.1: Extract the Log2Log archive package into the directory that you want to
       run Log2Log on.
  2.2: Visit the corresponding HTTP page of Log2Log on a Web browser.
  3.1: There is no step 3.


┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃ CONFIGURATION AND FEATURES ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
Basic configuration for Log2Log is located in the config.php file.
There are two required configuration elements in Log2Log v0.0.1a1:
  - LOG2LOG_THEME : The theme is needed to display anything on Log2Log.
  - Array(NAVI) : The navigation bar is needed to get around the Log2Log site.

Configurable constants begin with "LOG2LOG_". For conflict avoidance, use the
included function autodefine() to define constants.
config.php can override any constants because it is the first file executed.
Configurable constants may be inserted anywhere in the execution process of
Log2Log.

List of configurable constants:
  - LOG2LOG_THEME : Required. Use a theme directory in ./themes .
  - LOG2LOG_VERSION : Should not be changed. This is a system constant that
      contains the version number of the current Log2Log you are running.
  - LOG2LOG_FORMAT : The name of the standardized log format. It should remain
      at "Log2Log" unless you remade Log2Log's entire standardized format.
  - LOG2LOG_FORMAT_SERVICEICON_SRC : The URL to the icon of the standardized
      log format. The icon is included in Log2Log and likely is ready to go.
  - LOG2LOG_NAVIBAR : The navigation HTML. Usually, Log2Log builds this
      automatically from your Array(NAVI) set in config.php .
  - LOG2LOG_ALPHA_DIAGNOSTICS : A development release diagnostics information
      that is automatically generated by Log2Log
  - LOG2LOG_TITLE : The content encased in the <title> tag of the output HTML.
      Pages in Log2Log usually define this.
  - LOG2LOG_LOGO : HTML that displays the logo of Log2Log. This should be set
      in config.php
  - LOG2LOG_TAGLINE : HTML that displays in the tagline (usually under the
      logo) of the output of Log2Log. This should be defined in config.php or
      sometimes in the pages of Log2Log.
  - LOG2LOG_MENU1 : HTML of the primary menu bar. In double menu bar themes,
      this is usually the left-side menu bar.
  - LOG2LOG_MENU2 : HTML of the right-side menu bar.
  - LOG2LOG_MENU3 : Another menu bar that isn't often used.
  - LOG2LOG_MENU4 : Yet another menu bar that isn't often used.
  - LOG2LOG_BODY : The main HTML code for the page. It should be defined in the
      page and should not ever be set anywhere else to ensure functionality.

This is the structure of Log2Log:
  - ./config.php : The configuration file of Log2Log
  - ./contact.php : Optional. This has default contact information to Deltik.
  - ./convert.php : The front-end conversion script to handle log conversions
  - ./core.php : The crucial file that contains important functions and data
  - ./debug.php : If this file is included in your package of Log2Log, it was
      an error by Deltik's deployment procedure. This file serves no purpose
      anymore, whatsoever, and it should be removed.
  - ./debug2.php : This file, if included, is also a packaging mistake by
      Deltik's deployment procedure. It should also be removed.
  - ./download.php : Optional. This has the default download information.
  - ./index.php : The homepage of Log2Log
  - ./LICENSE.php : Know your rights when using Log2Log.
  - ./README.php : It is the informational file that you are reading right now.
  - ./classes/ : This directory contains third-party classes that Log2Log uses
      for features such as archiving.
  -- tar.php : This is the ad-hoc class for file archive handling in v0.0.1a1.
       It should be replaced with a better class for support of more archive
       types in a later version of Log2Log.
  - ./formats/ : This directory contains the classes for chat log conversion.
      Log2Log automatically detects these converters, so adding more chat log
      support is as easy as uploading a new converter file.
  -- Deltik.php : Does not work yet. This is an experimental conversation log
       format being developed by Deltik that has maximum human readability,
       compatibility, and minimal data loss.
  -- Meebo.php : Converts raw Meebo chat logs
  -- MeeboConnect.php : Automatically downloads chat logs from Meebo
  -- Pidgin.php : Converts Pidgin HTML chat logs. Full compatibility is not yet
       complete, but conversation data is processed well.
  -- Skype.php : Does not work yet. Converts Skype DBB chatmsg logs
  -- Template.php.txt : The template for making converters, used by developers
  - ./images/ : This directory contains general non-theme related images.
  -- services/ : This directory contains icons for the chat log formats.
  - ./test/ : This directory should not be included in the Log2Log package. It
      contains the original test scripts for processing chat logs.
  -- sekret/ : This directory contains sensitive personal information of the
       lead developer, Deltik. For an act of respect, please remove this
       directory without viewing the content and immediately report this
       packaging error to Deltik <webmaster@deltik.org>.
  - ./themes/ : This directory contains all the themes of Log2Log.
  -- index.php : Do not visit this page in a Web browser, or forever hold your
       peace. This page is for hackers only.
  -- burntincandescent/ : The default theme of Log2Log v0.0.1a1
  -- */index.php : The theme execution file. This is what Log2Log calls to
       displays content. To keep away prying hackers, this page should redirect
       to a JavaScript bomb when opened directly from a Web browser.
  -- */theme.php : The theme data file. Log2Log v0.0.1a1 looks in here for
       information about generating the navibar, if needed.


┏━━━━━━━━━━━━━━━━┓
┃ KNOWN PROBLEMS ┃
┗━━━━━━━━━━━━━━━━┛
1. Log2Log would like to have support for the following archive extensions:
     - .ZIP
     - .TAR.GZ
     - .TAR.BZ2
     - .TAR
   , but unfortunately, only .TAR and .TAR.GZ are supported in v0.0.1a1 because
   Deltik has not found classes for the other archive types. Log2Log pretends
   to support the above file types, but conversion will fail for those that are
   not supported.

2. Converting chat log formats is no easy task. Note that Log2Log converters
   might not be 100% successful at converting chat logs.

3. Time zone compatibility is rough, but fixes are underway.

4. Error handling front-end has not been made in v0.0.1a1. Log2Log-specific
   error messages do not show up.

5. Oh-ho-ho! This is an alpha release of Log2Log. There are many known problems
   that are just too plentiful to list. Feel free to report any problems
   because Deltik probably would forget about most of them and needs reminders.


┏━━━━━━━━━━━━━━━━━━┓
┃ MORE INFORMATION ┃
┗━━━━━━━━━━━━━━━━━━┛
For more information, updates, and just... more..., visit Deltik's Web site
at <http://www.deltik.org/>.


┏━━━━━━━━━━━━━━━━━┓
┃ VERSION HISTORY ┃
┗━━━━━━━━━━━━━━━━━┛
0.0.1a2 (2011/03/27)
  - NEW: JSON.php: Direct export of the Log2Log Standard Chat Log Format in JSON
  - NEW: Debug error handler
  - FIX: Pidgin.php: Prevented processing chat log entry if corrupt
  - MOD: core.php: Incompatible archive types now pass warnings instead of errors.

0.0.1a1 (2011/03/19)
  - Initial Release

0.0.1dev (2011/01/07)
  - Development Layout

0.0.1pre (2011/01/01)
  - Log2Log Project Founded
