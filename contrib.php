<?php

  $data = json_decode( file_get_contents( 'https://api.github.com/repos/rmlewisuk/justdelete.me/contributors' ) );
  shuffle( $data );

  foreach ( array_slice( $data, 0, 5 ) AS $contributor ) {
      printf(
          '<li><a href="http://github.com/%s">%s</a></li>',
          $contributor->login,
          $contributor->login
      );
  }
  
?>