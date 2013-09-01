<?php

$file = "sites.json";
$sites = json_decode(file_get_contents($file));

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

function sanitize($string, $force_lowercase = true, $anal = false) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}

function normal_chars($string)
{
    $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
    $string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
    $string = preg_replace(array('~[^0-9a-z]~i', '~[ -]+~'), ' ', $string);

    return trim($string, ' -');
}

$i = 0;
foreach ($sites as $site) {
    $i++;
    $a = $site->name;
    $b = sanitize(normal_chars($a));
    echo "$a --> $b\n";

    $x = [
        'name' => $site->name,
        'url' => $site->url,
        'difficulty' => $site->difficulty,
        'notes' => [
            'en' => isset($site->notes) ? $site->notes : '',
        ]
    ];

    $langs = ['it', 'de'];

    foreach ($langs as $lang) {
        if (isset($site->{'notes_'.$lang})) {
            $x['notes'][$lang] = $site->{'notes_'.$lang};
        }
    }

    file_put_contents('sites/'.$b.'.json', json_encode($x, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

