<?php
$language = "en";

if (isset($_GET['lang']))
{
    if (file_exists("index_" . $_GET['lang'] . ".html"))
    {
        $language = $_GET['lang'];    
        setcookie("selectedlanguage", $language, time()+60*60*24*30);
    }
}
else if (isset($_COOKIE['selectedlanguage']))
{
    $language = $_COOKIE['selectedlanguage'];    
}
$filename = "index_" . $language . ".html";
include $filename;
?>
