<?php

$sites = [];

foreach (new DirectoryIterator('sites/') as $file) {
    if($file->isDot()) continue;
    echo "Reading... ".$file->getFilename()."\n";
    $x = json_decode(file_get_contents('sites/'.$file->getFilename()));
    $sites[] = $x;
}

usort($sites, function($a, $b)
{
    $a = strtolower($a->name);
    $b = strtolower($b->name);
    
    if ($a < $b) {
        return -1;
    }
    if ($a > $b) {
        return 1;
    }
    return 0;
});

file_put_contents('new.json', json_encode($sites, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

