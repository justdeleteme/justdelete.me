<?php
	// $data = file_get_contents("https://api.github.com/repos/rmlewisuk/justdelete.me/contributors");
	$data = json_decode(file_get_contents('https://api.github.com/repos/rmlewisuk/justdelete.me/contributors'));

	$x=0;
	$contribs = []; 
	while($x<=4)
  	{	
  		$length = sizeof($data);
  		$random = rand(0, $length);
  		while (in_array($random, $contribs)) {
  			$random = rand(0, $length);
  		}
  		$contribs[] = $random;

  		echo "<li><a href='http://github.com/" . $data[$random]->login . "'>" . $data[$random]->login . "</a></li>";
  		$x++;
  	}
  	echo "<li><a href='http://github.com/rmlewisuk/justdelete.me/contributors'>See all " . count($data) . " contributors &raquo;</a></li>";
?>