<?php

  $langs = [
    'en' => 'English',
    'it' => 'Italiano',
    'de' => 'Deutsch',
    'fr' => 'Français',
    'ru' => 'Pусский',
    'pt_br' => 'Português',
    'cat' => 'Català',
    'es' => 'Español'
  ];

  foreach ( $langs AS $lang => $full_name ) {
      ob_start();

      include 'dev.php';
      $cachefile = $language === 'en' ? 'index.html' : $language . '.html';
      file_put_contents( $cachefile, ob_get_contents() );
      
      ob_end_flush();
  }
  
?>