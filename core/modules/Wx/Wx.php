<?php
/**
 *
 * phpVMS-WX is a weather module for phpVMS
 * Proudly coded for Air Anatolia VA
 * Copyright (c) 2015 Alperen Sonad
 * phpVMS-Metar module is licenced under the following license:
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

class Wx extends CodonModule 
{
	
	public function index()
	{
		require_once CORE_LIB_PATH.'/recaptcha/recaptchalib.php';
		
		if($this->post->submit)
		{
			$this->checkWx(strtoupper($this->post->icao));
		}
		else
		{
			$this->render('wx/wx_form.tpl');
		}
		
	}
	
	public function airport($icao='')
	{	
		if (empty($icao)) 
		{
			header("Location: ".url('/wx'));
		}
		else 
		{
			$this->checkWx(strtoupper($icao));
		}	
	}
	
	private function checkWx($icao)
	{
		if (!WxData::icaoCheck($icao))
		{
			$this->set('message', $icao.' is not a valid icao code of an airport.<br /> You will be redirecting to weather page in 5 seconds...');
			$this->render('core_error.tpl');
			header("refresh:5;url=".url('/wx') );
			return;
		}
		else
		{
			if (WxData::metarCheck($icao) && WxData::tafCheck($icao))
			{
				$this->set('icao', $icao);
				$this->set('metar', WxData::getMetar($icao));
				$this->set('taf', WxData::getTaf($icao));
				$this->render('wx/wx_show.tpl');
			}
			elseif (WxData::metarCheck($icao) && !WxData::tafCheck($icao))
			{
				$this->set('icao', $icao);
				$this->set('metar', WxData::getMetar($icao));
				$this->render('wx/wx_show.tpl');
			}
			elseif (!WxData::metarCheck($icao) && WxData::tafCheck($icao))
			{
				$this->set('icao', $icao);
				$this->set('taf', WxData::getTaf($icao));
				$this->render('wx/wx_show.tpl');
			}
			else
			{
				$this->set('message', 'There is no available weather information for '.strtoupper($this->post->icao).' right now.<br /> You will be redirecting to weather page in 5 seconds...');
				$this->render('core_error.tpl');
				header("refresh:5;url=".url('/wx') );
				return;
			}
		}
	}
	
	public function metar($icao='')
	{	
		if (empty($icao)) 
		{
			header("Location: ".url('/wx'));
		}
		else 
		{
			if (!WxData::metarCheck($icao)){
				$this->set('message', 'There is no available metar information for '.strtoupper($this->post->icao).' right now.<br /> You will be redirecting to weather page in 5 seconds...');
				$this->render('core_error.tpl');
				header("refresh:5;url=".url('/wx') );
				return;
			}
			else 
			{
				$this->set('icao', strtoupper($icao));
				$this->set('metar', WxData::getMetar(strtoupper($icao)));
				$this->render('wx/wx_show.tpl');
			}
		}	
	}
	
	public function taf($icao='')
	{	
		if (empty($icao)) 
		{
			header("Location: ".url('/wx'));
		}
		else 
		{
			if (!WxData::tafCheck($icao)){
				$this->set('message', 'There is no available taf information for '.strtoupper($this->post->icao).' right now.<br /> You will be redirecting to weather page in 5 seconds...');
				$this->render('core_error.tpl');
				header("refresh:5;url=".url('/wx') );
				return;
			}
			else 
			{
				$this->set('icao', strtoupper($icao));
				$this->set('taf', WxData::getTaf(strtoupper($icao)));
				$this->render('wx/wx_show.tpl');
			}
		}	
	}
	
	public function apt($icao='')
	{
		$this->airport($icao);
	}
	
	public function icao($icao='')
	{
		$this->airport($icao);
	}
	
}
