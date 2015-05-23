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

class WxData extends CodonData{
	
	public static $metarurl = 'http://weather.noaa.gov/pub/data/observations/metar/stations/';
	public static $tafurl = 'http://weather.noaa.gov/pub/data/forecasts/taf/stations/';
	
	public function icaoCheck($icao)
	{
		if (strlen($icao)==4 && ctype_alpha(substr($icao,0,1)))
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	private function fileCheck($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_TIMEOUT,5);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($code==200) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function getFile($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER , false);
		curl_setopt($ch, CURLOPT_TIMEOUT,5);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($ch);
		curl_close($ch);
		return substr($result,16,strlen($result)-16);
	}
	
	public function tafCheck($icao)
	{
		return WxData::fileCheck(WxData::$tafurl.strtoupper($icao).'.TXT');
	}
	
	public function metarCheck($icao)
	{
		return WxData::fileCheck(WxData::$metarurl.strtoupper($icao).'.TXT');
	}
	
	public function getMetar($icao)
	{
		return WxData::getFile(WxData::$metarurl.$icao.'.TXT');
	}
	
	public function getTaf($icao)
	{
		return WxData::getFile(WxData::$tafurl.$icao.'.TXT');
	}
}

?>
