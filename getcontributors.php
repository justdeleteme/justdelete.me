<?php
	// $data = file_get_contents("https://api.github.com/repos/rmlewisuk/justdelete.me/contributors");
	$data = json_decode(file_get_contents('https://api.github.com/repos/rmlewisuk/justdelete.me/contributors'));

	// echo "<pre>";
	// print_r($data);
	// echo "</pre>";

	$x=0; 
	while($x<=5)
  	{
  		echo "<li><a href='http://github.com/" . $data[$x]->login . "'>" . $data[$x]->login . "</a></li>";
  		$x++;
  	}
?>