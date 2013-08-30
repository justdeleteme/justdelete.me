<?php

$file = "sites.json";

$sites = json_decode(file_get_contents($file));

if (!is_null($sites)) {
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
    
    $sites_sort = json_encode($sites, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $sites_sort = preg_replace("/(},)(\s+{)/", "$1\n$2", $sites_sort);
    
    if ($sites != $sites_sort) {      
        file_put_contents($file, $sites_sort);
    }
}
?>
