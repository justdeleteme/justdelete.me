<?php

$file = "sites.json";

$sites = json_decode(file_get_contents($file));
$cs1   = md5(json_encode($sites, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

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
    $cs2        = md5($sites_sort);
    
    if ($cs1 != $cs2) {
        $sites_sort = preg_replace("/(},)(\s+{)/", "$1\n$2", $sites_sort);
        file_put_contents($file, $sites_sort);
    } else {
        echo "$file is already sorted.\n";
    }
} else {
    echo "$file is not valid.\n";
}
?>
