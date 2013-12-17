<?php

/*
 * JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES, and JSON_UNESCAPED_UNICODE
 * only exist in PHP 5.4.0 and higher. Perform a quick check before
 * attempting to run this sort code.
 */
if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    echo "************************************************************************\n";
    echo "Sorting only works on PHP 5.4.0 and higher!\n";
    echo "Unable to perform the sort, but site generation may be able to continue.\n";
    echo "\n";
    echo "You appear to be running the following PHP Version:\n";
    echo PHP_VERSION . "\n";
    echo "************************************************************************\n";
    exit (0);
}

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
