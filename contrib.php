<?php

        $max_count = 60;
        $img_width = 32;

        $data = json_decode(file_get_contents('https://api.github.com/repos/rmlewisuk/justdelete.me/contributors'));
        $count = sizeof($data) - 1;
        if ($count >= $max_count) {$count = $max_count;}

		$contributors = "";

        for($i = 0; $i < $count; $i++) {
                $contributors .= "<a href='".$data[$i]->html_url."'><img width='".$img_width."' src='http://www.gravatar.com/avatar/".$data[$i]->gravatar_id."?s=".$img_width."&amp;d=mm' title='" . $data[$i]->login . "'></a> ";
        }

?>
