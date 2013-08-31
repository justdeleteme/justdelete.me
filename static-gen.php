<?php
// start the output buffer
ob_start(); ?>

<?php 
$lang = "en";
if (isset($_GET['lang']))
    $lang = $_GET['lang'];

include ('dev.php'); ?>

<?php
$cachefile = "index_" . $lang . ".html";
// open the cache file "cache/home.html" for writing
$fp = fopen($cachefile, 'w'); 
// save the contents of output buffer to the file
fwrite($fp, ob_get_contents()); 
// close the file
fclose($fp); 
// Send the output to the browser
ob_end_flush();
?>