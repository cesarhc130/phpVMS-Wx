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
?>
<div class="pageContentTitle">WEATHER</div>
<div class="pageContentBlock">
	<form method="post" action="<?php echo url('/wx'); ?>" class="bootstrap-frm">
		<strong>ICAO (Enter ICAO code of an airport):</strong>
			<input type="text" name="icao" value="" style="width: 100%;text-transform: uppercase;" />
		<strong>Captcha</strong>
			<?php echo recaptcha_get_html(Config::Get('RECAPTCHA_PUBLIC_KEY'), $captcha_error); ?><br />
			<input type="hidden" name="loggedin" value="<?php echo (Auth::LoggedIn())?'true':'false'?>" />
		<input type="submit" name="submit" value="Get Metar" class="button">
	</form>
</div>
