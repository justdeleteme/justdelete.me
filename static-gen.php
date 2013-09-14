<?php
	
	$langs = ['en', 'it', 'de', 'fr', 'ru', 'pt_br', 'cat', 'es', 'vi', 'tr', 'ar'];

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
		if ($lang == "it") {
			$full_name = "Italiano";
		}
		if ($lang == "de") {
			$full_name = "Deutsch";
		}
		if ($lang == "fr") {
			$full_name = "Français";
		}
		if ($lang == "ru") {
			$full_name = "Pусский";
		}
		if ($lang == "pt_br") {
			$full_name = "Português";
		}
		if ($lang == "cat") {
			$full_name = "Català";
		}
		if ($lang == "es") {
			$full_name = "Español";
		}
		if ($lang == "vi") {
			$full_name = "Việt";
		}
		if ($lang == "tr") {
			$full_name = "Türk";
		}
		if ($lang == "ar") {
			$full_name = "العربية";
		}
		
		include ('dev.php');

		if ($language == "en")
		{
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
