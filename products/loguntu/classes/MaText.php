<?php
/**
 * Loguntu
 *  Classes
 *   Ported
 *    "MaText v2.1.0"
 *     From: TI-BASIC
 *      By: Nick Liu <webmaster@deltik.org>
 *       Source: <http://www.ticalc.org/archives/files/fileinfo/420/42081.html>
 */

#### CONTENTS ####
# Class Variables   - "MaText Variable Declarations"
# Class Constructor - "MaText Class Constructor"
# Low-Level Access  - "MaText Binary Functions"
# Basic Operations  - "MaText Data Manipulation Functions"
# Purpose Functions - "MaText Encryption Functions"
# Storage Functions - "MaText File Operations"
# Miscellaneous     - "MaText Original Source Code"
##################

class MaText extends Matrix
  {
  /**
   * ################################
   * # MaText Variable Declarations #
   * ################################
   */
  // System
  public $charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  // Process
  public $text;
  public $list;
  
  /**
   * ############################
   * # MaText Class Constructor #
   * ############################
   */
  public function MaText()
    {
    $argv = func_get_args();
    if (is_string($argv[0]))
      return setText($argv[0]);
    elseif (is_array($argv[0]))
      return $this->list = $argv[0];
    }
  
  /**
   * ###########################
   * # MaText Binary Functions #
   * ###########################
   */
  
  /**
   * Hexadecimal to String
   * @param string $x Hexadecimal safe binary string to ASCII string
   */
  public function hextostr($x)
    {
    $s = '';
    foreach (explode("\n", trim(chunk_split($x, 2))) as $h)
      $s .= chr(hexdec($h));
    return $s;
    }
  
  /**
   * String to Hexadecimal
   * @param string $x ASCII string to hexadecimal safe binary string
   */
  public function strtohex($x)
    {
    $s = '';
    foreach (str_split($x) as $c)
      $s .= sprintf("%02X", ord($c));
    return $s;
    }
  
  /**
   * ######################################
   * # MaText Data Manipulation Functions #
   * ######################################
   */
  
  /**
   * Load Text Input
   * @param string $string Inputted text
   * @returns bool TRUE - Guaranteed success
   */
  public function setText($string)
    {
    $this->text = $string;
    return true;
    }
  
  /**
   * Make Numeric Representation of Text
   * @param string $string (optional) Inputted text
   * @returns array The converted list
   */
  public function makeList($string = null)
    {
    // Fall back on pre-set text
    if ($string == null)
      $string = $this->text;
    // Return failure if the string isn't set
    if (!is_string($string) || !strlen($string))
      return false;
    // Break break break break break some strings
    $string_parts = str_split($string);
    $charset_parts = array_flip(str_split($this->charset));
    
    // Do numeric encode
    foreach ($string_parts as $string_char)
      {
      $final[] = $charset_parts[$string_char];
      }
    
    // Store the created list in the object.
    $this->list = $final;
    
    // Return the created list, just to be nice.
    return $final;
    }
  
  /**
   * Make Textual Representation of Numbers
   * @param array $list (optional) Inputted list
   * @returns string The converted text
   */
  public function makeText($list = null)
    {
    // Fall back on pre-set list
    if ($list == null)
      $list = $this->list;
    // Return failure if the list isn't set
    if (!is_array($list) || !count($list))
      return false;
    // Break break break break break some strings
    $charset_parts = str_split($this->charset);
    
    // Do numeric decode
    foreach ($list as $list_char)
      {
      $final .= $charset_parts[$list_char];
      }
    
    // Store the created list in the object.
    $this->list = $final;
    
    // Return the created list, just to be nice.
    return $final;
    }
  
  
  /**
   * ######################################
   * # MaText Data Manipulation Functions #
   * ######################################
   */
  
  /**
   * Encrypt
   * @param array $password The password square matrix
   * @param array $list Numeric representation to encrypt
   * @returns array The encrypted list
   */
  public function encrypt($password = array(1), $list = null)
    {
    // Fall back on pre-set list
    if ($list == null)
      $list = $this->list;
    // Fall back on pre-set text
    if ((!is_array($list) || !count($list)) && $string == null)
      {
      $string = $this->text;
      $list = $this->makeList($string);
      }
    // Return failure if the list isn't set
    if (!is_array($list) || !count($list))
      return false;
    
    // Build password matrix
    $password_matrix = new Matrix($password);
    
    // Check the password
    if (!$password_matrix->checkSquare())
      return false;
    
    // Pad the list to password-compatible size
    $part_size = $password_matrix->getRows();
    $pad_size = count($list) + ($part_size - (count($list) % $part_size));
    $list = array_pad($list, $pad_size, -1);
    
    // OMG, encrypt! :D
    $final = array();
    for ($i = 0; $i < count($list); $i += $part_size)
      {
      $encrypt_proc_part = array(array_slice($list, $i, $part_size));
      // This is the actual encryption right here:
      $encrypted_part = $password_matrix->multiply($encrypt_proc_part, $password);
      // Add the encrypted part to the final array.
      $final = array_merge($final, $encrypted_part[0]);
      }
    
    // Store the created list in the object.
    $this->list = $final;
    
    // Return the created list, just to be nice.
    return $final;
    }
  
  /**
   * Decrypt
   * @param array $password The password square matrix
   * @param array $list Numeric representation to decrypt
   * @returns array The decryupted list
   */
  public function decrypt($password = array(1), $list = null)
    {
    // Fall back on pre-set list
    if ($list == null)
      $list = $this->list;
    // Return failure if the list isn't set
    if (!is_array($list) || !count($list))
      return false;
    
    // Build password matrix
    $password_matrix = new Matrix($password);
    
    // Check the password
    if (!$password_matrix->checkSquare())
      return false;
    
    // Set the encryption part size.
    $part_size = $password_matrix->getRows();
    
    // OMG, decrypt! :D
    $final = array();
    for ($i = 0; $i < count($list); $i += $part_size)
      {
      $decrypt_proc_part = array(array_slice($list, $i, $part_size));
      // This is the actual decryption right here:
      $decrypted_part = $password_matrix->multiply($decrypt_proc_part, $password_matrix->inverse($password));
      // Add the encrypted part to the final array.
      $final = array_merge($final, $decrypted_part[0]);
      }
    
    // Store the created list in the object.
    $this->list = $final;
    
    // Return the created list, just to be nice.
    return $final;
    }
  
  /**
   * ##########################
   * # MaText File Operations #
   * ##########################
   */
  
  /**
   * Generate File
   * @param array $data List to store in the file
   * @param string $accuracy (optional) Format code for the numeric data
   * @returns string Binary string containing the NDF file contents
   */
  public function makeFile($data, $accuracy = "f")
    {
    # MaText stores data in NDF files.
    #  NDF stands for Numeric Data File.
    #   It's just a file format that Deltik made up.
    // Header (identifying characters)
    $final_hex = "FFDEAD";
    
    // Check for valid format code
    if (strlen($accuracy) != 1 || !@pack($accuracy, "10101.10101"))
      return false;
    
    // Add and store format code information
    $final_hex .= $this->strtohex($accuracy);
    
    // Convert the hexadecimal header to binary
    $final = $this->hextostr($final_hex);
    
    // Generate hexadecimal for the data
    foreach ($data as $datum)
      {
      $final .= pack($accuracy, $datum);
      }
    
    // Return the generated file
    return $final;
    }
  
  /**
   * Read File
   * @param string $data NDF File contents
   * @returns array List contents from file
   */
  public function readFile($data)
    {
    # MaText stores data in NDF files.
    #  NDF stands for Numeric Data File.
    #   It's just a file format that Deltik made up.
    // Convert the file contents to hexadecimal
    $data_hex = $this->strtohex($data);
    
    // Check header (identifying characters)
    if (substr($data_hex, 0, 6) != "FFDEAD")
      {
      return false;
      }
    else
      {
      $data_hex_proc = substr($data_hex, 6);
      }
    // Break hexadecimal data process into bytes.
    $data_hex_proc = str_split($data_hex_proc, 2);
    // Save the unpack format code.
    $accuracy_hex = array_shift($data_hex_proc);
    $accuracy = $this->hextostr($accuracy_hex);
    // Reassemble the hexadecimal data process.
    $data_hex_proc = implode("", $data_hex_proc);
    // Convert the hexadecimal data to binary for unpack()ing.
    $data_proc = $this->hextostr($data_hex_proc);
    
    // Determine byte size for this accuracy
    $data_size = strlen(pack($accuracy, "10101.10101"));
    
    // Break binary data process into each individual number.
    $data_proc = str_split($data_proc, $data_size);
    
    // Unpack.
    $final = array();
    foreach ($data_proc as $datum)
      {
      $final = array_merge($final, unpack($accuracy, $datum));
      }
    
    // Return the read file
    return $final;
    }
  }

/**
 * ###############################
 * # MaText Original Source Code #
 * ###############################
 */
<<<sourceCodePortedFrom
::"MaText v2.1.0
:Lbl B
:Full:ClrHome
:Normal:Float
:" ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzθ0123456789,.?!+-*/^()23-1{}[]eπiorT=≠>≥<≤n□┼∙‾':[xhat][yhat]>F[phat]→Str5
:Menu("MaText v2.1.0   ","Encrypt",E,"Decrypt",D,"About",A,"Character Map",C,"σxit",X
:Lbl A
:Output(1,6,"MaText
:Output(2,6,"v2.1.0
:Output(3,1,"----------------
:Output(4,3,"Row Matrices
:Output(5,4,"Encryption
:Output(6,1,"----------------
:Output(7,2,"Programmed By:
:Output(8,5,"Nick Liu
:Pause
:Goto B
:Lbl C
:Output(1,1,Str5
:Pause :Goto B
:Lbl E
:DelVar TMenu("  Encrypt from  ","text input.",E1,"list input.",E2,"L1.",E3,"...never mind.",B
:Lbl E1:ClrHome
:Input ">",Str0
:If 998<length(Str0:Then
:¦ sub(Str0,1,995)+"...→Str0
:¦ Disp "","WARNING! The","string is too","long. It has
:¦ Pause "been cropped.
:End
:ClrHome
:Goto E0:Lbl E3
:L1→L2:1→T
:Goto E0:Lbl E2
:ClrHome
:Input "List>",L2:1→T
:Lbl E0:ClrHome
:Disp "Enter a 4-number","password","separated by","spaces or commas
:Input ">",Str1
:DelVar L1
:1→θ:1→Y
:Str1+" 0 0 0 0→Str1
:While Y<length(Str1) and θ≤4
:¦ " →Str2
:¦ Repeat sub(Str1,Y,1)=" " or sub(Str1,Y,1)=",
:¦ ¦ Str2+sub(Str1,Y,1→Str2
:¦ ¦ Y+1→Y:End
:¦ Repeat sub(Str1,Y,1)≠" " and sub(Str1,Y,1)≠",
:¦ ¦ Y+1→Y:End
:¦ expr(sub(Str2,2,length(Str2)-1→L1(θ
:¦ ">→Str9
:¦ For(X,1,Y-2
:¦ ¦ Str9+"*→Str9
:¦ End
:¦ Output(5,1,Str9
:¦ θ+1→θ
:End
:DelVar Str1DelVar Str2DelVar Str9
:[[L1(1),L1(2)][L1(3),L1(4)]]→[B]:ClrHome
:If T=1:Goto E9
:If length(Str0)/2≠iPart(length(Str0)/2
:Str0+" →Str0
:DelVar L1length(Str0→dim(L1
:Output(1,1,"Status:
:Output(2,1,"Text►List
:Output(4,4,"
:Output(7,1,"---
:Output(8,1,length(Str0
:length(Str0→dim(L1
:1→θ
:While θ≤length(Str0
:¦ inString(Str5,sub(Str0,θ,1→Y
:¦ Y-1→L1(θ
:¦ If Y=0:66→L1(θ
:¦ θ+1→θ
:¦ Output(6,1,θ-1
:¦ Output(4,1,round((θ-1)/length(Str0)*100,0
:End
:Goto E8
:Lbl E9:L2→L1
:Lbl E8
:ClrHome
:Output(1,1,"Encrypting...  
:Output(4,1,"---
:Output(5,1,dim(L1)/2
:For(θ,1,dim(L1),2
:¦ Output(3,1,(θ-1)/2
:¦ [[L1(θ),L1(θ+1)]]*[B]→[A]
:¦ [A](1,1→L1(θ
:¦ [A](1,2→L1(θ+1
:End
:DelVar [A]DelVar [B]
:Disp " Text Encrypted","----------------"," Encrypted data
:Output(5,1,"<<  [SCROLL]  >>
:Output(7,1,"Press [ENTER] to    continue
:Pause L1:Goto B:Lbl D
:Menu("  Decrypt from  ","L1.",D1,"data entry.",D2,"...never mind.",B
:Lbl D2
:Disp "Enter crypted","data in list","syntax.
:Input ">",Str0
:expr(Str0→L1
:ClrHome
:Lbl D1
:L1→L3
:Disp "Enter 4-number","password for the","data separated","by spaces or ","commas
:Input ">",Str1
:1→θ:1→Y
:Str1+" 0 0 0 0→Str1
:While Y<length(Str1) and θ≤4
:¦ " →Str2
:¦ Repeat sub(Str1,Y,1)=" " or sub(Str1,Y,1)=",
:¦ ¦ Str2+sub(Str1,Y,1→Str2
:¦ ¦ Y+1→Y:End
:¦ Repeat sub(Str1,Y,1)≠" " and sub(Str1,Y,1)≠",
:¦ ¦ Y+1→Y:End
:¦ expr(sub(Str2,2,length(Str2)-1→L2(θ
:¦ ">→Str9
:¦ For(X,1,Y-2
:¦ ¦ Str9+"*→Str9
:¦ End
:¦ Output(6,1,Str9
:¦ θ+1→θ:End
:DelVar Str1DelVar Str2DelVar Str9
:[[L2(1),L2(2)][L2(3),L2(4)]]→[B]:DelVar L2ClrHome
:If dim(L1)/2≠iPart(dim(L1)/2
:0→L1(dim(L1)+1
:Output(1,1,"Decrypting...
:Output(4,1,"---
:Output(5,1,dim(L1)/2
:For(θ,1,dim(L1),2
:¦ Output(3,1,(θ-1)/2
:¦ [[L1(θ),L1(θ+1)]]*[B]-1→[A]
:¦ [A](1,1)+1→L1(θ
:¦ [A](1,2)+1→L1(θ+1
:End
:If max(L1)>length(Str5) or min(L1)<1
:Then:Lbl P
:¦ ClrHome
:¦ Output(3,1,"The password youentered is not  correct.
:¦ Output(7,1,"Press [ENTER] to
:¦ Output(8,5,"continue
:¦ Pause "ERR:PASSWORD
:¦ L3→L1:DelVar L3Goto B:End
:ClrHome
:Output(1,1,"Status:
:Output(2,1,"List►Text
:Output(4,4,"
:Output(7,1,"---
:Output(8,1,dim(L1
:Output(6,6,"+----------
:Output(7,6,"_Processing
:Output(8,6,"_
:">→Str0
:For(θ,1,dim(L1
:¦ Output(4,1,round(θ/dim(L1)*100,0
:¦ Output(6,1,θ
:¦ round(L1(θ),0→L1(θ
:¦ If L1(θ)<1 or L1(θ)>length(Str5
:¦ Goto P
:¦ Str0+sub(Str5,L1(θ),1→Str0
:¦ Output(8,11,sub(Str5,L1(θ),1
:End
:ClrHome
:Disp " Text Decrypted","----------------"," Decrypted Data
:Output(5,1,"<<  [SCROLL]  >>
:Output(7,1,"Press [ENTER] to
:Output(8,5,"continue
:Output(4,4,"LOADING...
:For(θ,1,dim(L1
:¦ L1(θ)-1→L1(θ
:End
:sub(Str0,2,length(Str0)-1→Str0
:Output(4,4,"          
:Pause L1
:Lbl F
:ClrHome
:Menu("","View",V,"Unsave",U,"Return",B,"σxit",X
:Lbl U
:DelVar Str0L3→L1
:Output(1,1,"The decrypted   data has been   deleted and re- placed with the encrypted list.
:Output(7,1,"Press [ENTER] to
:Output(8,5,"continue
:Pause :Goto B
:Lbl V
:"----------------Press [CLEAR] toexit text viewer----------------"+Str0→Str1
:1→θ
:length(Str1→Y
:DelVar XWhile X≠45
:¦ getKey→X
:¦ Output(1,1,sub(Str1,θ,Y-θ+1)+"                
:¦ If X=25:θ-16→θ
:¦ If X=34:θ+16→θ
:¦ If θ>Y
:¦ θ-16→θ
:¦ If θ<1
:¦ 1→θ
:End:Goto F
:Lbl X
:DelVar TDelVar XDelVar YDelVar θDelVar L3DelVar Str0DelVar Str1DelVar Str5DelVar [A]DelVar [B]
:ClrHome
:Output(1,1,"
sourceCodePortedFrom;

?>
