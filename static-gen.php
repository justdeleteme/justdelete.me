<?php
	$langs = array(
		'en',
		'ar',
		'cat',
		'de',
		'es',
		'fa',
		'fr',
		'id',
		'it',
		'nl',
		'pt_br',
		'ru',
		'tr',
		'vi',
		'zh-cn',
		'zh-tw',
		'ro',
		'pl',
		'sk',
		'sr'
	);

	include 'contrib.php';

	foreach ($langs as $language)
	{
		// start the output buffer
		ob_start(); ?>

		<?php

		$lang = $language;

		if ($lang == "en") {
			$full_name = "English";
		}
		if ($lang == "ar") {
			$full_name = "العربية";
		}
		if ($lang == "cat") {
			$full_name = "Català";
		}
		if ($lang == "de") {
			$full_name = "Deutsch";
		}
		if ($lang == "es") {
			$full_name = "Español";
		}
		if ($lang == "fa") {
			$full_name = "فارسی";
		}
		if ($lang == "fr") {
			$full_name = "Français";
		}
		if ($lang == "id") {
			$full_name = "Indonesia";
		}
		if ($lang == "it") {
			$full_name = "Italiano";
		}
		if ($lang == "nl") {
			$full_name = "Nederlands";
		}
		if ($lang == "pt_br") {
			$full_name = "Português";
		}
		if ($lang == "ru") {
			$full_name = "Pусский";
		}
		if ($lang == "tr") {
			$full_name = "Türk";
		}
		if ($lang == "vi") {
			$full_name = "Tiếng Việt";
		}
		if ($lang == "zh-cn") {
			$full_name = "中国的";
		}
		if ($lang == "zh-tw") {
			$full_name = "正體中文";
		}
		if ($lang == "ro") {
			$full_name = "Român";
		}
		if ($lang == "pl") {
			$full_name = "Polski";
		}
		if ($lang == 'sk') {
			$full_name = "Slovak";
		}
		if ($lang == 'sr') {
			$full_name = "српски";
		}

		include ('dev.php');

		if ($language == "en") {
			$cachefile = "index.html";
		}
		else {
			$cachefile = $language.".html";
		}
		// open the cache file "cache/home.html" for writing
		$fp = fopen($cachefile, 'w');
		// save the contents of output buffer to the file
		fwrite($fp, ob_get_contents());
		// close the file
		fclose($fp);
		// Send the output to the browser
		ob_end_flush();
	}
?>
