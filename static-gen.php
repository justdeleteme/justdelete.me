<?php

// 
include 'contrib.php';

$languages = json_decode(file_get_contents('definitions.json'));


foreach ($languages[0]->languages as $lang => $full_name) {
    ob_start();
    
    include('dev.php');
    
    if ($lang == "en") {
        $cachefile = "index.html";
    } else {
        $cachefile = "$lang.html";
    }

    $fp = fopen($cachefile, 'w');
    fwrite($fp, ob_get_contents());
    fclose($fp);
    ob_end_flush();
}
?>
