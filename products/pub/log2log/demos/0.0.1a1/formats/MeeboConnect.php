<?php
/**
 * Log2Log Online Chat Log Converter
 *  Formats
 *   Meebo Raw Chat Log Format
 *    Meebo API Interface
 * 
 * License:
 *  This file is part of Log2Log.
 *  
 *  Log2Log is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *  
 *  Log2Log is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with Log2Log.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

#### CONTENTS ####
# Class Variables   - "Meebo Connect Variable Declarations"
# Class Constructor - "Meebo Connect Class Constructor"
# Low-Level Access  - "Meebo API Raw Access Functions"
# Standard Access   - "Meebo API Normal Access Functions"
# High-Level Access - "Meebo API Sophisticated Access Functions"
# Advanced Features - "Log2Log Functions"
##################

class MeeboConnect extends Meebo
  {
  /**
   * #######################################
   * # Meebo Connect Variable Declarations #
   * #######################################
   */
  // Format Handler Information
  public $name   = "MeeboConnect";
  public $unix   = "meeboconnect";
  public $client = "Meebo";
  // Session Variables
  private $sessionKey;
  private $sessionId;
  private $clientId;
  private $revision = 0;
  // Authentication Variables
  private $username;
  private $password;
  private $authenticated = null;
  
  /**
   * ###################################
   * # Meebo Connect Class Constructor #
   * ###################################
   */
  public function __construct()
    {
    // Trick Log2Log into letting us procede without a file upload.
    $_FILES['file']['error'] = 4;
    }
  
  /**
   * ##################################
   * # Meebo API Raw Access Functions #
   * ##################################
   */
  
  /**
   * Top-level API accessor commands
   * @param string $function API's function
   * @param string $parameters Parameters to set in the API function
   * @param string $_request Either "get" or "post" for either type of submission
   * @param bool $https_bool Set to TRUE for HTTPS access mode
   */
  private function accessMCMD($function, $parameters = array(), $_request = "get", $https_bool = false)
    {
    $function = "mcmd/".$function;
    return $this->accessMeebo($function, $parameters, $_request, $https_bool);
    }
  private function accessCMD($function, $parameters = array(), $_request = "get", $https_bool = false)
    {
    $function = "cmd/".$function;
    return $this->accessMeebo($function, $parameters, $_request, $https_bool);
    }
  
  /**
   * Accesses an JSON-API functions through this,
   * processes data for accessing the API,
   * accesses the API,
   * and returns the output.
   */
  private function accessMeebo($function, $parameters, $_request = "get", $https_bool = false)
    {
    $_request = strtolower($_request);
    if ($_request != "get" && $_request != "post")
      $_request = "get";
    if ($_request == "get")
      {
      $parameters_url = "";
      foreach ($parameters as $parameter => $data)
        {
        $parameter = urlencode($parameter);
        $data      = urlencode($data);
        $parameters_url .= "$parameter=$data&";
        }
      $parameters_url = trim($parameters_url, "&");
      $parameters_url = "$function?".$parameters_url;
      }
    if ($_request == "post")
      {
      $postdata = http_build_query($parameters);
      log2log_debug_info("meeboconnect", "Built POST query $postdata");
      $opts = array(
        "http" => array(
          "method" => "POST",
          "content" => $postdata
          )
        );
      $context = stream_context_create($opts);
      $parameters_url = $function;
      }
    return $this->accessAPI($parameters_url, $https_bool, $context);
    }
  
  /**
   * Accesses the Meebo API directly.
   */
  private function accessAPI($command, $https_bool = false, $context = null)
    {
    $s = "";
    if ($https_bool == true)
      {
      $s = "s";
      }
    $url = "http$s://www.meebo.com/".$command;
    $response = @file_get_contents($url, false, $context);
    log2log_debug_info("meeboconnect", "Accessed Meebo API at URL $url");
    log2log_debug_info("meeboconnect", "Meebo returned these exact data: $response");
    // Successful JSON parse
    if ($return = json_decode($response, true))
      {
      log2log_debug_info("meeboconnect", "Received data parsed as JSON");
      return $return;
      }
    // Not JSON code returned
    else
      {
      log2log_debug_info("meeboconnect", "Received data returned as raw");
      return $response;
      }
    }
  
  /**
   * #####################################
   * # Meebo API Normal Access Functions #
   * #####################################
   */
  
  /**
   * Start a Meebo session
   * @param string $bcookie (optional) Random beginning cookie identifier
   * @returns array
   */
  public function startAPI($bcookie = null)
    {
    // Set unique Log2Log/Meebo ID, if not already given
    if (!$bcookie)
      $bcookie = uniqid("log2log-");
    // Set up parameters to send with the function
    $parameters = array(
      "type" => "core",
      "bcookie" => $bcookie,
      "ts" => time()*100,
      );
    
    // Access API!
    $response = $this->accessMCMD("start", $parameters);
    
    // Set session variables
    $this->sessionKey = $response['sessionKey'];
    $this->sessionId  = $response['sessionId'];
    $this->clientId   = $response['clientId'];
    
    // Return the response, just to be nice. ;)
    return $response;
    }
  
  /**
   * Get updates from Meebo
   * @param string $rev (optional) Update revision request number
   * @param string $sessionKey (optional) Meebo's generated unique session ID
   * @param string $clientId (optional) Meebo's generated unique client ID
   * @param string $focustime (optional) [WHAT IN THE WORLD DOES THIS DO?!]
   * @returns array
   */
  public function updateAPI($rev = null, $sessionKey = null, $clientId = null, $focustime = null)
    {
    // Parameter defaults
    if (!$rev) $rev = $this->revision;
    if (!$sessionKey) $sessionKey = $this->sessionKey;
    if (!$clientId) $clientId = $this->clientId;
    if (!$focustime) $focustime = $rev;
    // Set up parameters to send with the function
    $parameters = array(
      "sessionKey" => $sessionKey,
      "rev" => $revision,
      "clientId" => $clientId,
      "focustime" => $focustime,
      );
    
    // Access API!
    $response = $this->accessMCMD("events", $parameters);
    
    // Set the session variables
    $this->revision = $response['rev'];
    
    // Return the response
    return $response;
    }
  
  /**
   * Log in to Meebo account
   * @param string $username Meebo ID
   * @param string $password The password required to connect to a Meebo ID
   * @param string $sessionKey (optional) Meebo's generated unique session ID
   * @param string $clientId (optional) Meebo's generated unique client ID
   * @returns void
   */
  public function loginAPI($username, $password, $sessionKey = null, $clientId = null)
    {
    // Parameter defaults
    if (!$sessionKey) $sessionKey = $this->sessionKey;
    if (!$clientId) $clientId = $this->clientId;
    // Set up parameters to send with the function
    $parameters = array(
      "sessionKey" => $sessionKey,
      "requestId" => "F0",
      "clientId" => $clientId,
      "username0" => $username,
      "protocol0" => "meebo",
      "password0" => $password,
      "num" => "1",
      );
    
    // Access API!
    $this->accessMCMD("joinexisting", $parameters, "post", true);
    
    // Set the authentication variables
    $this->username = $username;
    $this->password = $password;
    }
  
  /**
   * Disconnect from Meebo
   * @param string $sessionKey (optional) Meebo's generated unique session ID
   * @param string $clientId (optional) Meebo's generated unique client ID
   */
  public function quitAPI($sessionKey = null, $clientId = null)
    {
    // Parameter defaults
    if (!$sessionKey) $sessionKey = $this->sessionKey;
    if (!$clientId) $clientId = $this->clientId;
    // Set up parameters to send with the function
    $parameters = array(
      "sessionKey" => $sessionKey,
      "clientId" => $clientId,
      );
    
    // Access API!
    $this->accessMCMD("quit", $parameters);
    }
  
  /**
   * Sign Off of Meebo
   * @param string $sessionKey (optional) Meebo's generated unique session ID
   * @param string $locationId (optional) Meebo's generated unique client ID
   * @param string $clientId (optional) Meebo's generated unique client ID
   */
  public function logoffAPI($sessionKey = null, $locationId = null, $clientId = null)
    {
    // Parameter defaults
    if (!$sessionKey) $sessionKey = $this->sessionKey;
    if (!$locationId) $locationId = $this->clientId;
    if (!$clientId) $clientId = $this->clientId;
    // Set up parameters to send with the function
    $parameters = array(
      "sessionKey" => $sessionKey,
      "locationId" => $locationId,
      "clientId" => $clientId,
      );
    
    // Access API!
    $this->accessMCMD("detach", $parameters);
    }
  
  /**
   * CMD: "mauserlist" (I have no idea what this does.)
   * @param string $sessionKey (optional) Meebo's generated unique session ID
   * @param string $clientId (optional) Meebo's generated unique client ID
   * @param string $username_meebo Meebo username associated with sessionKey
   */
  public function mauserlistAPI($sessionKey = null, $clientId = null, $username_meebo = null)
    {
    // Parameter defaults
    if (!$username_meebo) $username_meebo = $this->username;
    if (!$sessionKey) $sessionKey = $this->sessionKey;
    if (!$clientId) $clientId = $this->clientId;
    // Set up parameters to send with the function
    $parameters = array(
      "clientId" => $clientId,
      "muser" => $username_meebo,
      "sessionKey" => $sessionKey,
      );
    
    // Access API!
    $this->accessCMD("mauserlist", $parameters, "post", false);
    }
  
  /**
   * CMD: "gwid" (I have no idea what this does.)
   * @param string $sessionKey (optional) Meebo's generated unique session ID
   * @param string $clientId (optional) Meebo's generated unique client ID
   * @param string $username_meebo Meebo username associated with sessionKey
   */
  public function gwidAPI($sessionKey = null, $clientId = null, $username_meebo = null)
    {
    // Parameter defaults
    if (!$username_meebo) $username_meebo = $this->username;
    if (!$sessionKey) $sessionKey = $this->sessionKey;
    if (!$clientId) $clientId = $this->clientId;
    // Set up parameters to send with the function
    $parameters = array(
      "clientId" => $clientId,
      "muser" => $username_meebo,
      "sessionKey" => $sessionKey,
      );
    
    // Access API!
    $this->accessCMD("gwid", $parameters, "post", false);
    }
  
  /**
   * MCMD: "dbg" (I have no idea what this is.)
   * @param string $data Requested information from 'dbg'
   * @param string $category (optional) Category of data received
   * @param string $sessionKey (optional) Meebo's generated unique session ID
   * @param string $clientId (optional) Meebo's generated unique client ID
   */
  public function dbgAPI($data, $category = "javascript", $sessionKey = null, $clientId = null)
    {
    // Parameter defaults
    if (!$sessionKey) $sessionKey = $this->sessionKey;
    if (!$clientId) $clientId = $this->clientId;
    // Set up parameters to send with the function
    $parameters = array(
      "sessionKey" => $sessionKey,
      "cat" => $category,
      "m" => $data,
      "clientId" => $clientId,
      );
    
    // Access API!
    $this->accessMCMD("dbg", $parameters);
    }
  
  /**
   * Load into the Server some Buddy Information
   * @param string $username_with The other chatter's username
   * @param string $username_self Account to which the contact is assigned
   * @param string $protocol Protocol to which the contact is on
   * @param string $sessionKey (optional) Meebo's generated unique session ID
   * @param string $clientId (optional) Meebo's generated unique client ID
   */
  public function infoAPI($username_with, $username_self, $protocol, $sessionKey = null, $clientId = null)
    {
    // Parameter defaults
    if (!$sessionKey) $sessionKey = $this->sessionKey;
    if (!$clientId) $clientId = $this->clientId;
    // Set up parameters to send with the function
    $parameters = array(
      "sessionKey" => $sessionKey,
      "u" => $username_self,
      "p" => $protocol,
      "b" => $username_with,
      "clientId" => $clientId,
      );
    
    // Access API!
    $this->accessMCMD("info", $parameters, "post", false);
    }
  
  /**
   * Get Chat Log
   * @param string $username_with The other chatter's username
   * @param string $username_self Account to which the log is assigned
   * @param string $protocol Protocol to which the log is assigned
   * @param string $username_meebo Meebo username associated with sessionKey
   * @param string $sessionKey (optional) Meebo's generated unique session ID
   * @param string $clientId (optional) Meebo's generated unique client ID
   * @returns string The messed up chat log that needs help from Log2Log
   */
  public function getChatLogAPI($username_with, $username_self, $protocol, $username_meebo = null, $sessionKey = null, $clientId = null)
    {
    // Parameter defaults
    if (!$username_meebo) $username_meebo = $this->username;
    if (!$sessionKey) $sessionKey = $this->sessionKey;
    if (!$clientId) $clientId = $this->clientId;
    // Set up parameters to send with the function
    $parameters = array(
      "bu" => $username_with,
      "clientId" => $clientId,
      "muser" => $username_meebo,
      "p" => $protocol,
      "sessionKey" => $sessionKey,
      "u" => $username_self,
      );
    
    /*// Load Buddy Information
    $this->infoAPI($username_with, $username_self, $protocol, $sessionKey, $clientId);
    $this->updateAPI();*/
    
    // Access API!
    $response = $this->accessCMD("cl_proxy", $parameters, "post", false);
    
    // Return the response
    return $response;
    }
  
  /**
   * ############################################
   * # Meebo API Sophisticated Access Functions #
   * ############################################
   */
  
  /**
   * Collect Initial Meebo Account Data
   * @param string $username Meebo ID
   * @param string $password The password required to connect to a Meebo ID
   * @param int $threshold (optional) Data capture threshold
   *                       Higher : Slower, captures more data
   *                       Lower  : Faster, captures less data
   *                       null   : Default capture threshold of 5
   * @returns array Collected data
   */
  public function initialize($username, $password, $threshold = 5)
    {
    // Start the connection with Meebo
    $this->startAPI();
    $this->updateAPI();
    // Log in
    log2log_debug_info("meeboconnect", "Going to authenticate as '$username' with password '$password'...");
    $this->loginAPI($username, $password);
    sleep(1);
    // Capture data
    $final = array();
    for ($i = 2; $i <= $threshold; $i ++)
      {
      // Detect incorrect authentication
      if ($i == 3)
        {
        if (strpos(json_encode($temp), '"protocol":"meebo","data":{"type":2,"description":"Incorrect username or password."}}}') !== FALSE)
          {
          $this->authenticated = false;
          log2log_debug_info("meeboconnect", "LOGIN FAILED with username '$username' and password '$password'!");
          log2log_debug_error("meeboconnect", "LOGIN FAILED with username '$username' and password '$password'!");
          break;
          }
        else
          {
          $this->authenticated = true;
          log2log_debug_info("meeboconnect", "LOGIN SUCCEEDED with username '$username' and password '$password'!");
          }
        }
      if ($i == 3)
        {
        //$this->quitAPI();
        $this->mauserlistAPI();
        $this->gwidAPI();
        }
      sleep(1);
      $temp = $this->updateAPI();
      $final[] = $temp;
      }
    return $final;
    }
  
  /**
   * #####################
   * # Log2Log Functions #
   * #####################
   */
  
  /**
   * Filter to Buddy List
   * @param array $data Data collected by $this->initialize()
   * @returns array Array([accounts] => $ACCOUNTS, [contacts] => $BUDDIES)
   */
  public function parseContacts($data)
    {
    // Variable Definitions
    $ACCOUNTS = array();
    $BUDDIES = array();
    
    // For each data update collected...
    foreach ($data as $update)
      {
      $update = $update['events'];
      // For each update revision event...
      foreach ($update as $event)
        {
        // Process the type of event
        $event_type = explode("::", $event['type']);
        $event_category = $event_type[0];
        $event_type = $event_type[1];
        
        # Extract Account Information
        if ($event_category == "account")
          {
          if ($event_type == "info" || $event_type == "connecting")
            {
            $_account_username = $event['data']['user'];
            $_account_protocol = $event['data']['protocol'];
            $_account_alias    = $event['data']['alias'];
            $ACCOUNTS[$_account_username]['protocol'] = $_account_protocol;
            $ACCOUNTS[$_account_username]['alias'] = $_account_alias;
            }
          if ($event_type == "alias_changed" || $event_type == "online")
            {
            $_account_username = $event['data']['user'];
            $_account_protocol = $event['data']['protocol'];
            $_account_alias    = $event['data']['data'];
            $ACCOUNTS[$_account_username]['protocol'] = $_account_protocol;
            $ACCOUNTS[$_account_username]['alias']    = $_account_alias;
            }
          }
        
        # Extract Buddy Information
        if ($event_category == "buddy")
          {
          $_buddy_account_assoc = $event['data']['user'];
          $_buddy_username      = $event['data']['buddy'];
          $_buddy_alias         = $event['data']['buddyalias'];
          $_buddy_protocol      = $event['data']['protocol'];
          // Verify that buddies are not being repeated before adding it.
          $add = true;
          foreach ($BUDDIES as $BUDDY)
            {
            if ($BUDDY['account_assoc'] == $_buddy_account_assoc && $BUDDY['username'] == $_buddy_username)
              {
              $add = false;
              break;
              }
            }
          if ($add)
            {
            $BUDDIES[] = array("account_assoc" => $_buddy_account_assoc,
                               "username"      => $_buddy_username,
                               "alias"         => $_buddy_alias,
                               "protocol"      => $_buddy_protocol);
            }
          }
        }
      }
    
    // Return the processed data.
    return array("accounts" => $ACCOUNTS, "contacts" => $BUDDIES);
    }
  
  /**
   * Collect All Chat Logs based on BUDDIES list
   * @param array $BUDDIES Buddy list generated by parseContacts()
   * @returns array Corresponds to each key in $BUDDIES
   */
  public function getAllChatLogs($BUDDIES)
    {
    // For each buddy...
    foreach ($BUDDIES as $BUDDY)
      {
      $LOGS[] = $this->getChatLogAPI($BUDDY['username'], $BUDDY['account_assoc'], $BUDDY['protocol']);
      }
    
    // Return the processed data.
    return $LOGS;
    }
  
  /**
   * Pull Data from External Session If Necessary
   *  AKA Log2Log Compatibility When Logged In Elsewhere
   *  AKA Meebo Events Loaded from another Session
   * @param array $data Data collected by $this->initialize()
   * @returns array Array(..., [events] => ARRAY_MEEBO_EVENTS, ...)
   */
  public function pullExternalSessionEvents($data)
    {
    // For each data update collected...
    foreach ($data as $key => $update)
      {
      $update = $update['events'];
      // For each update revision event...
      foreach ($update as $event)
        {
        // Process the type of event
        $event_type = explode("::", $event['type']);
        $event_category = $event_type[0];
        $event_type = $event_type[1];
        
        # Extract External Session Information, If Existant
        if ($event_category == "info" && $event_type == "external_session" && !$event['data']['errorcode'])
          {
          $data[$key] = $event['data']['data'];
          log2log_debug_info("meeboconnect", "Using update data from a currently active session...");
          }
        }
      }
    
    return $data;
    }
  
  /**
   * Public Information
   *  @returns array Format class information for Log2Log
   */
  public function info()
    {
    $from = true;
    $to   = false;
    $instructions = '<p>MeeboConnect can download all your chat logs by connecting to Meebo. It\'s not much more difficult than logging onto Meebo.</p><p>Important information:<ul><li>You must be completely logged out of Meebo before MeeboConnect can successfully retrieve your chat logs. This is a complication in Meebo\'s design, and it has a difficult workaround that is currently not implemented. Make sure all sessions are closed by logging onto Meebo through their Web client and signing off all locations.</li><li>It takes a long time to connect to Meebo and download chat logs. If the process fails, it was probably because there was too much workload for MeeboConnect. In that case, contact <a href="http://www.deltik.org/" target="_blank">Deltik</a>, and he shall assist you the best he can.</li></ul></p>';
    $submission_form_custom = '<table width="100%" style="border-collapse: collapse;">
 <tr>
  <td width="280px" style="vertical-align: top;">
   <div style="background-color: #F7FAFF; width: 280px; border-radius: 8px; -moz-border-radius: 8px; -webkit-border-radius: 8px; border: 8px solid #7A9BC5; padding: 5px; text-align: right;">
    <h3 style="color: #4468A3; padding: 7px 0 0 54px; margin: 0; font-size: 20px; padding-left: 5px; font-family: \'Arial Rounded MT Bold\',Tahoma,sans-serif; font-weight: normal;" align="left">sign on to meebo</h3>
    <table style="font-family: Tahoma,Arial,sans-serif; font-size: 12px; text-align: right; padding: 12px 12px 6px 0; margin-left: auto;">
     <tr>
      <td><label for="username" style="color: #4468A3;">meebo id</label></td>
      <td><input type="text" name="username" id="username" autocomplete="off" style="background: #E9F0F5; border: 1px solid #B4CFE5; padding-left: 2px; margin: 1px 0; height: 13px; width: 130px; font: 11px Tahoma,Arial,sans-serif;" /></td>
     </tr>
     <tr>
      <td><label for="password" style="color: #4468A3;">password</label></td>
      <td><input type="password" name="password" id="password" autocomplete="off" style="background: #E9F0F5; border: 1px solid #B4CFE5; padding-left: 2px; margin: 1px 0; height: 13px; width: 130px; font: 11px Tahoma,Arial,sans-serif;" /></td>
     </tr>
     <tr>
      <td><label for="timezone" style="color: #4468A3;">timezone</label></td>
      <td><input type="text" name="timezone" id="timezone" autocomplete="off" style="background: #E9F0F5; border: 1px solid #B4CFE5; padding-left: 2px; margin: 1px 0; height: 13px; width: 130px; font: 11px Tahoma,Arial,sans-serif; color: #B4CFE5;" value="'.date_default_timezone_get().'" onfocus="if(this.value==\''.date_default_timezone_get().'\'){this.style.color=\'black\';this.value=\'\';}" onblur="if(!this.value){this.value=\''.date_default_timezone_get().'\';this.style.color=\'#B4CFE5\';}" /></td>
     </tr>
     <tr>
      <td colspan="2"><a href="http://www.meebo.com/lostpassword/" target="_blank" style="color: #4468A3; font: 11px Tahoma,Arial,sans-serif; line-height: 14px;">forgot password?</a></td>
     </tr>
    </table>
    <input type="submit" value="Sign On, Fetch Chat Logs, and Convert" style="height: 28px; font: 12px sans-serif; color: #666666;" />
   </div>
  </td>
  <td style="vertical-align: top; text-align: right;"><strong>Privacy Policy:</strong> The official Log2Log MeeboConnect will not store your password longer than necessary to retrieve your chat logs. Additionally, the official Log2Log MeeboConnect will not store fetched chat logs longer than necessary for you to download the converted logs. It will forget your Meebo data as soon as your browser completes the request to this server.<br /><strong>Disclaimer:</strong> The official Log2Log MeeboConnect is not designed to modify any data on any Meebo accounts. Deltik and Log2Log are not responsible for any data changed on your Meebo account.</td>
 </tr>
</table>';
    $return = array("name"         => $this->name,
                    "from"         => $from,
                    "to"           => $to,
                    "instructions" => $instructions,
                    "form"         => $submission_form_custom,
                   );
    return $return;
    }
  
  /**
   * Process Log2Log "From" Request
   * @param array $raw Imported structure and data
   */
  public function processFrom($raw = null)
    {
    // Step 1/3: Fetch the data.
    $data = $this->initialize($_REQUEST['username'], $_REQUEST['password']);
    $data = $this->pullExternalSessionEvents($data);
    $data_procd = $this->parseContacts($data);
    $LOGS = $this->getAllChatLogs($data_procd['contacts']);
    $this->quitAPI();
    $this->logoffAPI();
    
    // Step 2/3: Process the data through the format class 'Meebo'.
    //           (This class extends Meebo.)
    if ($data_procd['contacts'])
      {
      foreach ($data_procd['contacts'] as $key => $BUDDY)
        {
        $this->setAccount($BUDDY['account_assoc']);
        $this->setProtocol($BUDDY['protocol']);
        $this->setWith($BUDDY['username']);
        
        $this->load($LOGS[$key]);
        }
      }
    else
      {
      log2log_debug_error("meeboconnect", "Contacts list showed up empty! Did you sign off all your sessions of Meebo? Do you have any friends?");
      }
    
    // Step 3/3: Submit the Log2Log-standardized chat log array.
    return $this->log;
    }
    
  /**
   * Process Log2Log "To" Request
   * @param array $log Log2Log-standardized chat log array
   */
  public function processTo($log)
    {
    // There's no such thing!
    return false;
    }
  }

?>
