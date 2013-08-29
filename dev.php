<?php
$sites = json_decode(file_get_contents('sites.json'));
usort($sites, function($a, $b) {
          $a = strtolower($a->name);
          $b = strtolower($b->name);
          
	if ($a < $b) return -1;
	if ($a > $b) return 1;
	return 0;
}); 
require('lang/en.php');
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo title ?></title>
	<meta charset="UTF-8">
	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="<?php echo description; ?>">

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

</head>	
<body>

	<!-- Facebook Like Button SDK -->
	<div id="fb-root"></div>

	<a href="https://chrome.google.com/webstore/detail/justdeleteme/hfpofkfbabpbbmchmiekfnlcgaedbgcf" target="_blank" class="banner">
	    <?php echo banner; ?>
	</a>


	<header>
		<h1>just<span>delete</span>.me</h1>
	    <p class="tagline"><?php echo tagline; ?></p>
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

	    <p class="no-results"><?php echo noResults; ?></p>

			<!-- // FIRST FOR EACH -->

			<?php foreach ($sites as $site) : ?><section class="site-block <?php echo $site->difficulty; ?>">
					<a class="site-header" href="<?php echo $site->url; ?>">
						<?php echo $site->name; ?>
					</a>
					<p class="site-difficulty">
	    <?php echo difficulty; ?><?php echo $site->difficulty; ?>
					</p>
					<?php if (isset($site->notes)) : ?>
						<div class="tooltip-content">
							<?php echo $site->notes; ?>	
						</div>
						<a href="#" class="tooltip-toggle contains-info">showInfo</a>
					<?php else : ?>
	    <p class="tooltip-toggle"><?php echo noInfo; ?></p>
					<?php endif; ?>
				</section><?php endforeach; ?>

		</section>
	</section>
	<section class="info-block">
		<div class="info-container">

			<div class="info-block-half">
	    <h2><?php echo whatIsThis; ?></h2>
	    <p><?php echo whatIsThisp1; ?></p>
	    <p><?php echo whatIsThisp2; ?></p>
	    <p><?php echo whatIsThisp3; ?></p>
				<ul>
	    <li><?php echo whatIsThisl1; ?></li>
	    <li><?php echo whatIsThisl2; ?></li>
	    <li><?php echo whatIsThisl3; ?></li>
				</ul>
	    <p><?php echo twitter; ?></p>
			</div><div class="info-block-half">
	    <h2><?php echo guide; ?></h2>
	    <p><?php echo guideExplanations; ?></p>
				<ul>
	    <li><?php echo guideEasy; ?></li>
	    <li><?php echo guideMedium; ?></li>
	    <li><?php echo guideHard; ?></li>
	    <li><?php echo guideImpossible; ?></li>
				</ul>
			</div>		
		</div>
	</section>
	<div class="banner-block">
		<div class="banner-content">
			<div class="banner-block-half">
	    <h2><?php echo extension; ?></h2>
	    <p><?php echo extensionp1; ?></p>
	    <p><?php echo extensionp2; ?></p>
	    <p><?php echo extensionp3; ?></p>			
			</div><div class="banner-block-half">
				<h2>Extension Dot Guide</h2>
				<ul>
	    <li><?php echo extensionl1; ?></li>
	    <li><?php echo extensionl2; ?></li>
	    <li><?php echo extensionl3; ?></li>
	    <li><?php echo extensionl4; ?></li>					
				</ul>				
			</div>	
		</div>
		<div class="banner-block-extension"></div>
	</div>
	<section class="info-block">
		<div class="info-container">
			<footer>
	    <span><?php echo footer; ?></span>
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
