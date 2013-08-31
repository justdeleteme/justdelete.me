<?php
$sites = json_decode(file_get_contents('sites.json'));
$definitions = json_decode(file_get_contents('definitions.json'), true);
$lang = "en";
if (isset($_GET['lang']))
    $lang = $_GET['lang'];
usort($sites, function($a, $b) {
          $a = strtolower($a->name);
          $b = strtolower($b->name);
          
	if ($a < $b) return -1;
	if ($a > $b) return 1;
	return 0;
}); 
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $definitions["title"][$lang]; ?></title>
	<meta charset="UTF-8">
	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="<?php echo $definitions["description"][$lang]; ?>">

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
        <script>
            $(document).ready(function() {
                $('#LanguageSwitcher').LanguageSwitcher({
                    effect: 'fade',
                    openMode: 'hover',                   
                    onChange: function(evt){
                        window.location = "?lang=" + evt.selectedItem;
                    }
                });
                $('.contains-info').click(function(e) {
                    e.preventDefault();
                    if ($(this).prev().hasClass('toggled')) {
                           if ($(this).hasClass('text-toggled')) {
                                   $(this).html("<?php echo $definitions["showinfo"][$lang]; ?>").removeClass('text-toggled');
                           } else {
                                   $(this).html("<?php echo $definitions["showinfo"][$lang]; ?>").removeClass('text-toggled');
                           }
                           $(this).prev().slideToggle().removeClass('toggled');
                    } else {
                           $('.toggled').next().html("<?php echo $definitions["showinfo"][$lang]; ?>");
                           $('.toggled').slideToggle().removeClass('toggled');
                           $(this).prev().slideToggle().addClass('toggled');
                       $(this).html("<?php echo $definitions["hideinfo"][$lang]; ?>").addClass('text-toggled');
                    }
                });
            });          
        </script>
</head>	
<body>

	<!-- Facebook Like Button SDK -->
	<div id="fb-root"></div>

	<a href="https://chrome.google.com/webstore/detail/justdeleteme/hfpofkfbabpbbmchmiekfnlcgaedbgcf" target="_blank" class="banner">
		<?php echo $definitions["banner"][$lang]; ?>
	</a>


        <header>
            <div id="LanguageSwitcher">
                <form action="#">
                    <select id="language-options">
                        <option id="en" value="en" selected>English</option>
                        <option id="it" value="it">Italiano</option>                        
                        <!-- <option id="de" value="de">Deutsch</option> -->
                        <!-- <option id="fr" value="fr">Fran&ccedil;ais</option> -->  
                        <!-- <option id="es" value="es">Espa&ntilde;ol</option>-->
                    </select>
                </form>
            </div><br><br>
            <!-- end language switcher -->
            <h1>just<span>delete</span>.me</h1>
            <p class="tagline"><?php echo $definitions["tagline"][$lang]; ?></p>
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
						<?php echo $definitions["difficulty"][$lang]; ?>: <?php                                             
                                                echo $definitions["difficulty_" . $site->difficulty][$lang] ?>
					</p>
					<?php if (isset($site->notes)) : ?>
						<div class="tooltip-content">
                                                <?php
                                                if ($lang == "it") {
                                                    if (isset($site->notes_it))
                                                        echo $site->notes_it;
                                                    else echo $site->notes;
                                                } else echo $site->notes;                                              
                                                ?>	
						</div>
						<a href="#" class="tooltip-toggle contains-info"><?php echo $definitions["showinfo"][$lang]; ?></a>
					<?php else : ?>
						<p class="tooltip-toggle"><?php echo $definitions["noinfo"][$lang]; ?></p>
					<?php endif; ?>
				</section><?php endforeach; ?>

		</section>
	</section>
	<section class="info-block">
		<div class="info-container">

			<div class="info-block-half">
				<h2><?php echo $definitions["whatisthis"][$lang]; ?></h2>
				<p><?php echo $definitions["whatisthis1"][$lang]; ?></p>
				<p><?php echo $definitions["whatisthis2"][$lang]; ?></p>
				<p><?php echo $definitions["whatisthis3"][$lang]; ?></p>
				<ul>
					<li><a href="http://robblewis.me/just-delete-me?utm_source=JustDeleteMe&amp;utm_medium=link&amp;utm_campaign=Just+Delete+Me" target="_blank">Read the announcement blog post &raquo;</a></li>
					<li><a href="http://robblewis.me/24-hours-of-just-delete-me/" target="_blank">See the first-day stats &raquo;</a></li>
					<li><a href="http://thetechtailor.com/justdeleteme" target="_blank">Listen to an interview with Robb on The Tech Tailor podcast &raquo;</a></li>
					<li><a href="http://robblewis.me/just-delete-me-one-million-page-views/">One Million Page Views &raquo;</a></li>
				</ul>
				<p><a href="https://twitter.com/justdeletedotme" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @justdeletedotme</a></p>
			</div><div class="info-block-half">
				<h2><?php echo $definitions["guide"][$lang]; ?></h2>
				<p><?php echo $definitions["guideexplanations"][$lang]; ?></p>
				<ul>
					<li><?php echo $definitions["guideeasy"][$lang]; ?></li>
					<li><?php echo $definitions["guidemedium"][$lang]; ?></li>
					<li><?php echo $definitions["guidehard"][$lang]; ?></li>
                                        <li><?php echo $definitions["guideimpossible"][$lang]; ?></li>
				</ul>
			</div>		
		</div>
	</section>
	<div class="banner-block">
		<div class="banner-content">
			<div class="banner-block-half">
				<h2><?php echo $definitions["extension"][$lang]; ?></h2>
				<p><?php echo $definitions["extensionp1"][$lang]; ?></p>
				<p><?php echo $definitions["extensionp2"][$lang]; ?></p>
				<p><?php echo $definitions["extensionp3"][$lang]; ?></p>			
			</div><div class="banner-block-half">
				<h2>Extension Dot Guide</h2>
				<ul>
					<li><?php echo $definitions["extensionl1"][$lang]; ?></li>
					<li><?php echo $definitions["extensionl2"][$lang]; ?></li>
					<li><?php echo $definitions["extensionl3"][$lang]; ?></li>
					<li><?php echo $definitions["extensionl4"][$lang]; ?></li>					
				</ul>				
			</div>	
		</div>
		<div class="banner-block-extension"></div>
	</div>
	<section class="info-block">
		<div class="info-container">
			<footer>
				<span><?php echo $definitions["footer"][$lang]; ?></span>
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
</body>
</html>