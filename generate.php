<?php
$sites = json_decode(file_get_contents('sites.json'));
usort($sites, function($a, $b) {
	list($a, $b) = array(strtolower($a->name), strtolower($b->name));
	if ($a < $b) return -1;
	if ($a > $b) return 1;
	return 0;
}); ?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Just Delete Me | A directory of direct links to delete your account from web services.</title>
	<meta charset="UTF-8">
	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="A directory of direct links to delete your account from web services. Find out how to delete your Facebook, Twitter, LinkedIn accounts and more.">

	<!-- Icons -->
	<link rel="shortcut icon" href="inc/icons/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="inc/icons/apple-touch-icon-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="inc/icons/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="inc/icons/apple-touch-icon-120x120-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="inc/icons/apple-touch-icon-144x144-precomposed.png">

	<link rel="stylesheet" type="text/css" href="style.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<header>
		<h1>just<span>delete</span>.me</h1>
		<p class="tagline">A directory of direct links to delete your account from web services.</p>
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

			<?php foreach ($sites as $site) : ?><section class="site <?php echo $site->difficulty; ?>">
				<a href="<?php echo $site->url; ?>" title="<?php if (isset($site->notes)) echo $site->notes; ?>">
					<?php echo $site->name; ?>
				</a>
				<?php if (isset($site->notes)) : ?>
					<div class="tooltip">
						<p><?php echo $site->notes; ?></p>
					</div>
				<?php endif; ?>
			</section><?php endforeach; ?>

		</section>
	</section>
	<section class="info-block">
		<div class="info-container">
			<h2>What is this? </h2>

			<ul>
				<li><a href="http://robblewis.me/just-delete-me?utm_source=JustDeleteMe&amp;utm_medium=link&amp;utm_campaign=Just+Delete+Me" target="_blank">Read the announcement blog post &raquo;</a></li>
				<li><a href="http://robblewis.me/24-hours-of-just-delete-me/" target="_blank">See the first-day stats &raquo;</a></li>
			</ul>
			
			<p>Many companies use <a href="http://darkpatterns.org/">dark pattern</a> techniques to make it difficult to find how to delete your account. JustDelete.me aims to be a directory of urls to enable you to easily delete your account from web services.</p>

			<p>The links above are colour-coded to indicate the difficulty level of account deletion:</p>
			<ul>
				<li><span class="green">Green:</span> Simple process</li>
				<li><span class="yellow">Yellow:</span> Some extra steps involved</li>
				<li><span class="red">Red:</span> Cannot be fully deleted without contacting customer services</li>
				<li><span class="black">Black:</span> Cannot be deleted</li>
			</ul>

			<p>Got a site you think should be added? <a href="http://github.com/rmlewisuk/justdelete.me">Fork the project GitHub</a> or <A HREF="mailto:&#115;&#117;&#098;&#109;&#105;&#116;&#064;&#106;&#117;&#115;&#116;&#100;&#101;&#108;&#101;&#116;&#101;&#046;&#109;&#101;?Subject=JustDelete.me%3A%20Site%20suggestion&amp;Body=Site%20name%3A%20%0AURL/Link%3A%20%0ADifficulty%3A%20%0ANotes%20%28optional%29%3A">Submit a site</a></p>
			
			<div id="share buttons">
				<!-- Twitter -->
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://justdelete.me">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				<!-- Facebook -->
				<div class="fb-like" data-href="http://justdelete.me" data-width="450" data-colorscheme="dark" data-layout="button_count" data-show-faces="false" data-send="false"></div>

			</div>

			<footer>
				<span>Made by <a href="http://robblewis.me">Robb Lewis</a> | Designed by <a href="http://edpoole.me">Ed Poole</a> | Fork on <a href="http://github.com/rmlewisuk/justdelete.me">GitHub</a></span>
			</footer>
		</div>		
	</section>	
</body>
</html>