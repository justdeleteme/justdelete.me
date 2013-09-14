<?php
	$sites = json_decode(file_get_contents('sites.json'));
	usort($sites, function($a, $b) {
	          $a = strtolower($a->name);
	          $b = strtolower($b->name);
	          
		if ($a < $b) return -1;
		if ($a > $b) return 1;
		return 0;
	}); 

	// For testing
	if ( ! isset($contributors))
	{
		include 'contrib.php';		
	}

	if (isset($_GET['lang']))
	{
		$lang = $_GET['lang'];
	}
	// For testing
	if ( !isset($lang))
	{
		$lang = "en";
	}
	if ( !isset($full_name))
	{
		$full_name = "English";
	}

	$definitions = json_decode(file_get_contents('definitions.json'));

	$title = $definitions[0]->title->$lang;
	$description = $definitions[0]->description->$lang;
	$difficulty = $definitions[0]->difficulty->$lang;
	$difficulty_easy = $definitions[0]->difficulty_easy->$lang;
	$difficulty_medium = $definitions[0]->difficulty_medium->$lang;
	$difficulty_hard = $definitions[0]->difficulty_hard->$lang;
	$difficulty_impossible = $definitions[0]->difficulty_impossible->$lang;
	$tagline = $definitions[0]->tagline->$lang;
	$noinfo = $definitions[0]->noinfo->$lang;
	$showinfo = $definitions[0]->showinfo->$lang;
	$hideinfo = $definitions[0]->hideinfo->$lang;
	$whatisthis = $definitions[0]->whatisthis->$lang;
	$whatisthis1 = $definitions[0]->whatisthis1->$lang;
	$whatisthis2 = $definitions[0]->whatisthis2->$lang;
	$whatisthis3 = $definitions[0]->whatisthis3->$lang;
	$guide = $definitions[0]->guide->$lang;
	$guideexplanations = $definitions[0]->guideexplanations->$lang;
	$guideeasy = $definitions[0]->guideeasy->$lang;
	$guidemedium = $definitions[0]->guidemedium->$lang;
	$guidehard = $definitions[0]->guidehard->$lang;
	$guideimpossible = $definitions[0]->guideimpossible->$lang;
	$translationcontrib = $definitions[0]->translationcontrib->$lang;
	$morecontrib = $definitions[0]->morecontrib->$lang;
	$viewcontrib = $definitions[0]->viewcontrib->$lang;
	$extensionguide = $definitions[0]->extensionguide->$lang;
	$extension = $definitions[0]->extension->$lang;
	$extensionp1 = $definitions[0]->extensionp1->$lang;
	$extensionp2 = $definitions[0]->extensionp2->$lang;
	$extensionp3 = $definitions[0]->extensionp3->$lang;
	$extensionl1 = $definitions[0]->extensionl1->$lang;
	$extensionl2 = $definitions[0]->extensionl2->$lang;
	$extensionl3 = $definitions[0]->extensionl3->$lang;
	$extensionl4 = $definitions[0]->extensionl4->$lang;
	$banner = $definitions[0]->banner->$lang;
	$footer = $definitions[0]->footer->$lang;
	$help_translate = $definitions[0]->help->$lang;
	$donate = $definitions[0]->donate->$lang;
	$sendmail = $definitions[0]->sendmail->$lang;
	$submit = $definitions[0]->submit->$lang;

	if ($lang == "en")
	{
		$note_lang = "notes";
	}
	else
	{
		$note_lang = "notes_" . $lang;
	}


?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $title ?></title>
	<meta charset="UTF-8">
	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="<?php echo $description ?>">

	<!-- Icons -->
	<link rel="shortcut icon" href="inc/icons/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="inc/icons/apple-touch-icon-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="inc/icons/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="inc/icons/apple-touch-icon-120x120-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="inc/icons/apple-touch-icon-144x144-precomposed.png">

	<link rel="stylesheet" type="text/css" href="style.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="inc/jquery.js"><\/script>')</script>
	<script src="inc/scripts.js"></script>
	<link type="text/css" rel="stylesheet" href="inc/jquery.dropdown.css" />
	<script type="text/javascript" src="inc/jquery.dropdown.js"></script>

	<script type="text/javascript">
	  var GoSquared = {};
	  GoSquared.acct = "GSN-106715-K";
	  (function(w){
	    function gs(){
	      w._gstc_lt = +new Date;
	      var d = document, g = d.createElement("script");
	      g.type = "text/javascript";
	      g.src = "//d1l6p2sc9645hc.cloudfront.net/tracker.js";
	      var s = d.getElementsByTagName("script")[0];
	      s.parentNode.insertBefore(g, s);
	    }
	    w.addEventListener ?
	      w.addEventListener("load", gs, false) :
	      w.attachEvent("onload", gs);
	  })(window);
	</script>
</head>	
<body>

	<!-- Facebook Like Button SDK -->
	<div id="fb-root"></div>
	<nav>
		<!-- begin language switcher -->
		<span class="language-switch" href="#" data-dropdown="#dropdown-1" id="<?php echo $lang; ?>"><?php echo $full_name; ?></span>
		<!-- end language switcher -->
		<a href="#" class="info">About</a>
		<a href="#" class="banner">Chrome Extension</a>
		<a target="_blank" href="https://docs.google.com/a/therobb.com/forms/d/1mhr3vaTni5U8PvOdp_NvQ6vKBxNTmJTeKP3VWRuioCE/viewform">Submit a site</a>
		<a target="_blank" href="http://github.com/rmlewisuk/justdelete.me">Fork on GitHub</a>
	</nav>

	<header>
		<h1>just<span>delete</span>.me</h1>
		<p class="tagline"><?php echo $tagline ?></p>
	</header>

	<div id="test">
	</div>
	<div class="search">
		<div class="search-container">
			<input type="text" id="search">
			<a href="#">search</a>
		</div>
	</div>
	<section class="main">		
		<section class="sites" id="sites">

			<p class="no-results">Can't find what you're looking for? <a href='http://github.com/rmlewisuk/justdelete.me'>Help make justdelete.me better</a>.</p>

			<!-- // FIRST FOR EACH -->

                        <?php foreach ($sites as $site) : ?><section class="site-block <?php echo $site->difficulty; ?>">
                                <a class="site-header" href="<?php echo $site->url; ?>">
                                    <?php echo $site->name; ?>
                                </a>                            
                                <p class="site-difficulty">
                                    <?php echo $definitions[0]->difficulty->$lang; ?>: <?php echo eval('return $difficulty_' . $site->difficulty . ';'); ?>
                                </p>
                                <?php if (isset($site->$note_lang)) : ?>
                                    <div class="tooltip-content">                                   
                                        <?php echo $site->$note_lang;
                                        if (isset($site->email))
                                        {
                                            echo '<br><a href="mailto:' . $site->email . '?Subject=Account%20Deletion%20Request&body=Please%20delete%20my%20account,%20my%20username%20is%20 XXXXXX">' . $sendmail . ' &raquo;</a>';
                                        }
                                        ?>                                          
                                    </div>
                                    <a href="#" class="tooltip-toggle contains-info"><?php echo $showinfo ?></a>
                                <?php elseif (isset($site->notes)) : ?>
                                	<div class="tooltip-content">                                   
                                        <?php echo $site->notes; 
                                        if (isset($site->email))
                                        {
                                            echo '<br><a href="mailto:' . $site->email . '?Subject=Account%20Deletion%20Request&body=Please%20delete%20my%20account,%20my%20username%20is%20 XXXXX">' . $sendmail . ' &raquo;</a>';
                                        }
                                        ?> 
                                        </div>
                                    <a href="#" class="tooltip-toggle contains-info"><?php echo $showinfo ?></a>
                                <?php else : ?>
                                    <p class="tooltip-toggle"><?php echo $noinfo ?></p>
                                <?php endif; ?>
                            </section><?php endforeach; ?>

		</section>
	</section>
	<section class="info-block">
		<div class="info-container">

			<div class="info-block-half">
				<h2><?php echo $whatisthis ?></h2>
				<p><?php echo $whatisthis1 ?></p>
				<p><?php echo $whatisthis2 ?></p>
				<p><a target="_blank" href="https://docs.google.com/a/therobb.com/forms/d/1mhr3vaTni5U8PvOdp_NvQ6vKBxNTmJTeKP3VWRuioCE/viewform"><?php echo $submit ?> &raquo;</a></p>
				<ul>
					<li><a href="http://robblewis.me/just-delete-me?utm_source=JustDeleteMe&amp;utm_medium=link&amp;utm_campaign=Just+Delete+Me" target="_blank">Read the announcement blog post &raquo;</a></li>
					<li><a href="http://robblewis.me/24-hours-of-just-delete-me/" target="_blank">See the first-day stats &raquo;</a></li>
					<li><a href="http://thetechtailor.com/justdeleteme" target="_blank">Listen to an interview with Robb on The Tech Tailor podcast &raquo;</a></li>
					<li><a href="http://robblewis.me/just-delete-me-one-million-page-views/">One Million Page Views &raquo;</a></li>
				</ul>
				<p><a href="https://twitter.com/justdeletedotme" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @justdeletedotme</a></p>
			</div><div class="info-block-half">
				<h2><?php echo $guide ?></h2>
				<p><?php echo $guideexplanations ?></p>
				<ul>
					<li><?php echo $guideeasy ?></li>
					<li><?php echo $guidemedium ?></li>
					<li><?php echo $guidehard ?></li>
					<li><?php echo $guideimpossible ?></li>
				</ul>

				<p><?php echo $donate; ?></p>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="E9VLGMSJ3R4Q4">
					<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
		</div>
	</section>

	<section class="info-block contributors">
		<div class="info-container">

			<div class="info-block-half">
				<h2><?php echo $translationcontrib; ?></h2>
			
				<ul class="contributors translate">
		        	<li class="it"><a href="https://github.com/LorenzoRogai">Lorenzo Rogai</a></li>
		    		<li class="de"><a href="http://www.erbloggt.de/">Konstantin Hinrichs</a></li>
		        	<li class="fr"><a href="https://github.com/buzzb0x">Ethan Ohayon</a></li>
		        	<li class="fr"><a href="https://github.com/p1rox">Armand Vignat</a></li>
		        	<li class="ru"><a href="https://github.com/morozd">morozd</a></li>
		        	<li class="pt_br"><a href="https://github.com/mkbu95">Matheus Macabu</a></li>
		        	<li class="cat"><a href="https://github.com/rockbdn">JP Queralt (+ Español)</a></li>
		        	<li class="vi"><a href="https://github.com/giangnb">Giang Nguyen</a></li>
		        	<li class="tr"><a href="https://github.com/MarioErmando">Erman Sayın</a></li>
		        	<li class="ar"><a href="https://github.com/adahhane">Dahhane Ayyoub</a></li>

				</ul>
			</div><div class="info-block-half">
				<h2><?php echo $morecontrib; ?></h2>

				<?php echo $contributors; ?>
			
				<p><br/><a href='http://github.com/rmlewisuk/justdelete.me/contributors'><?php echo $viewcontrib; ?> &raquo;</a></p>
			
				
				</ul>
			</div>
		</div>
	</section>

	<div class="banner-block">
		<div class="banner-content">
			<div class="banner-block-half">
				<h2><?php echo $extension ?></h2>
				<p><?php echo $extensionp1 ?></p>
				<p><?php echo $extensionp2 ?></p>
				<p><?php echo $extensionp3 ?></p>			
			</div><div class="banner-block-half">
				<h2><?php echo $extensionguide; ?></h2>
				<ul>
					<li><?php echo $extensionl1 ?></li>
					<li><?php echo $extensionl2 ?></li>
					<li><?php echo $extensionl3 ?></li>
					<li><?php echo $extensionl4 ?></li>		
				</ul>			
			</div>	
		</div>
		<div class="banner-block-extension"></div>
	</div>

	<section class="info-block">
		<div class="info-container">
			<footer>
				<span><?php echo $footer ?></label>
				<div class="share-buttons" id="share buttons">
				<!-- Twitter -->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://justdelete.me">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				<!-- Facebook -->
					<div class="fb-like" data-href="http://justdelete.me" data-width="450" data-colorscheme="dark" data-layout="button_count" data-show-faces="false" data-send="false"></div>

				</div>
			</footer>
		</div>		
	</section>
	<script type="text/javascript">
		$('.contains-info').click(function(e) {
            e.preventDefault();
            if ($(this).prev().hasClass('toggled')) {
                if ($(this).hasClass('text-toggled')) {
                    $(this).html("<?php echo $showinfo ?>").removeClass('text-toggled');
                } else {
                    $(this).html("<?php echo $showinfo ?>").removeClass('text-toggled');
                }
                $(this).prev().slideToggle().removeClass('toggled');
            } else {
                $('.toggled').next().html("<?php echo $showinfo ?>");
                $('.toggled').slideToggle().removeClass('toggled');
                $(this).prev().slideToggle().addClass('toggled');
                $(this).html("<?php echo $hideinfo ?>").addClass('text-toggled');
            }       
        });
	</script>

	<div id="dropdown-1" class="dropdown dropdown-tip has-icons">
	    <ul class="dropdown-menu">
	    	<li class="en"><a href="/">English</a></li>
	        <li class="it"><a href="it.html">Italiano</a></li>
	    	<li class="de"><a href="de.html">Deutsch</a></li>
	        <li class="fr"><a href="fr.html">Français</a></li>
	        <li class="ru"><a href="ru.html">Pусский</a></li>
	        <li class="pt_br"><a href="pt_br.html">Português</a></li>
	        <li class="es"><a href="es.html">Español</a></li>
	        <li class="cat"><a href="cat.html">Català</a></li>
	        <li class="vi"><a href="vi.html">Việt</a></li>
	        <li class="tr"><a href="tr.html">Türk</a></li>
	        <li class="ar"><a href="ar.html">العربية</a></li>
	        <li class="dropdown-divider"></li>
	        <li class="help"><a target="_blank" href="https://github.com/rmlewisuk/justdelete.me/issues/164"><?php echo $help_translate; ?></a></li>
	    </ul>
	</div>
</body>
</html>
