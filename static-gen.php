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
      
?>

<?php

      include 'dev.php';
      $cachefile = $lang === 'en' ? 'index.html' : $lang . '.html';
      file_put_contents( $cachefile, ob_get_contents() );
      
      ob_end_flush();
  }
  
?>