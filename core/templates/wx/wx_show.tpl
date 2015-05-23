<?php
/**
 *
 * phpVMS-WX is a weather module for phpVMS
 * Proudly coded for Air Anatolia VA
 * Copyright (c) 2015 Alperen Sonad
 * phpVMS-Wx module is licenced under the following license:
 *   Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/3.0/
 * For more information and documentation, visit www.github.com/asonad/phpvms-Wx
 *
 * @author	Alperen Sonad
 * @copyright Copyright (c) 2015, Alperen Sonad
 * @link	http://www.airanatolia.com/wx
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 *
**/
	echo $metar ? '<div class="pageContentTitle">METAR FOR '.$icao.'</div><div class="pageContentBlock">'.$metar.'</div>' : '' ;
	echo $taf ? '<div class="pageContentTitle">TAF FOR '.$icao.'</div><div class="pageContentBlock">'.$taf.'</div>' : '' ;
?>
