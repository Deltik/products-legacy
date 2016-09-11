<?php
/**
 * MuSeSPinger
 *  Configuration File
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

// Title
define('ISUP_NAME', 'MuSeSPinger');

// MuSeSPinger Network
//  The URL of the MuSeSPinger network to join
//  To disable networking, comment out the line below.
define('ISUP_NETWORK', 'http://products.deltik.org/musespinger/');

// Administration Password
define('ISUP_PASSWORD', 'Set Password Here');

// Images
$online  = 'images/online.png';
$offline = 'images/offline.png';
$midline = 'images/midline.png';
$noline  = 'images/noline.png';

// Method
//  cURL              - The most detailed
//  fsockopen         - The friendliest
//  file_get_contents - The dumbest
define('ISUP_METHOD', 'cURL');

// Network Host
define('ISUP_NETWORK_LOCAL', true);
$isup_locations =
array (
  0 => 'http://products.deltik.org/musespinger/',
);
