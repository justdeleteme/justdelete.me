<?php
$sites = json_decode(file_get_contents('sites.json'));
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
        <script type="text/javascript">
             $(document).ready(function() {
                 $('#LanguageSwitcher').LanguageSwitcher({
                    effect: 'fade',
                    openMode: 'hover',                    
                    onChange: function(evt){                                           
                        setCookie("selectedlanguage", evt.selectedItem, 365);
                        selectedlanguage = evt.selectedItem;
                        $.ajax({
                             url: "definitions.json",              
                            
                             success: function(result) {                          
                                for (var v in result)
                                {
                                    var val = result[v][evt.selectedItem];
                                    if (v == 'title')
                                    {
                                        document.title = val;
                                    }
                                    else if (v == 'description')
                                    {
                                         $('meta[name=description]').remove();
                                         $('head').append( '<meta name="description" content="' + val + '">' );
                                    }
                                    else
                                    {
                                         if (v == 'showinfo')
                                             showinfo = val;
                                        else if (v == 'hideinfo')
                                            hideinfo = val;

                                        replaceContentInContainer(v, val);
                                    }
                                }
                            }
                        });
                    }
                });
            });
        </script>
</head>	
<body>

	<!-- Facebook Like Button SDK -->
	<div id="fb-root"></div>

	<a href="https://chrome.google.com/webstore/detail/justdeleteme/hfpofkfbabpbbmchmiekfnlcgaedbgcf" target="_blank" class="banner">
            <label class="banner">Try our new <span>Chrome Extension</span></label>
	</a>


	<header>
               <!-- begin language switcher -->
                <div id="LanguageSwitcher">
                    <form action="#">
                        <select id="language-options">
                            <option id="en" value="en" selected>English</option>                          
                            <option id="it" value="it">Italiano</option>                           
                        </select>
                    </form>
                </div>
                <br><br>
                <!-- end language switcher -->
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

			<!-- // FIRST FOR EACH -->

                        <?php foreach ($sites as $site) : ?><section class="site-block <?php echo $site->difficulty; ?>">
                                <a class="site-header" href="<?php echo $site->url; ?>">
                                    <?php echo $site->name; ?>
                                </a>                            
                                <p class="site-difficulty">
                                    <label class="difficulty">Difficulty</label>: <label class="difficulty_<?php echo $site->difficulty; ?>"><?php echo $site->difficulty; ?></label>
                                </p>
                                <?php if (isset($site->notes)) : ?>
                                    <div class="tooltip-content">
                                        <?php if (isset($site->notes_it)) {
                                            echo '<div class="tooltip-content-it" style="display: none">';
                                            echo $site->notes_it;
                                            echo '</div>';
                                        }
                                        ?>                                   
                                       
                                        <div class="tooltip-content-en">
                                        <?php echo $site->notes; ?>
                                        </div>
                                    </div>
                                    <a href="#" class="tooltip-toggle contains-info"><label class="showinfo">Show Info...</label></a>
                                <?php else : ?>
                                    <p class="tooltip-toggle"><label class="noinfo">No Info Available</label></p>
                                <?php endif; ?>
                            </section><?php endforeach; ?>

		</section>
	</section>
	<section class="info-block">
		<div class="info-container">

			<div class="info-block-half">
				<h2><label class="whatisthis">What is this?</label></h2>
				<p><label class="whatisthis1">Many companies use <a href="http://darkpatterns.org/">dark pattern</a> techniques to make it difficult to find how to delete your account. JustDelete.me aims to be a directory of urls to enable you to easily delete your account from web services.</label></p>
				<p><label class="whatisthis2">Got a site you think should be added? <a href="http://github.com/rmlewisuk/justdelete.me">Fork the project GitHub</a>.</label></p>
				<p><label class="whatisthis3"><em><Email submission is temporarily disabled</em></label></p>
				<ul>
					<li><a href="http://robblewis.me/just-delete-me?utm_source=JustDeleteMe&amp;utm_medium=link&amp;utm_campaign=Just+Delete+Me" target="_blank">Read the announcement blog post &raquo;</a></li>
					<li><a href="http://robblewis.me/24-hours-of-just-delete-me/" target="_blank">See the first-day stats &raquo;</a></li>
					<li><a href="http://thetechtailor.com/justdeleteme" target="_blank">Listen to an interview with Robb on The Tech Tailor podcast &raquo;</a></li>
					<li><a href="http://robblewis.me/just-delete-me-one-million-page-views/">One Million Page Views &raquo;</a></li>
				</ul>
				<p><a href="https://twitter.com/justdeletedotme" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @justdeletedotme</a></p>
			</div><div class="info-block-half">
				<h2><label class="guide">Guide</label></h2>
				<p><label class="guideexplanations">The links above are colour-coded to indicate the difficulty level of account deletion:</label></p>
				<ul>
					<li><label class="guideeasy"><span class="green">Easy</span> - Simple process</label></li>
					<li><label class="guidemedium"><span class="yellow">Medium</span> - Some extra steps involved</label></li>
					<li><label class="guidehard"><span class="red">Hard</span> - Cannot be fully deleted without contacting customer services</label></li>
					<li><label class="guideimpossible"><span class="black">Impossible</span> - Cannot be deleted</label></li>
				</ul>
			</div>		
		</div>
	</section>
	<div class="banner-block">
		<div class="banner-content">
			<div class="banner-block-half">
				<h2><label class="extension">Google Chrome Extension</label></h2>
				<p><label class="extensionp1">Our good friend <a target="_blank" href="http://mikerogers.io">Mike Rogers</a> has helped us to release an awesome Google Chrome Extension for JustDelete.me.</label></p>
				<p><label class="extensionp2">When you are on a website that is listed on justdelete.me, the Chrome Extension will add a small dot to the omnibar. Clicking on this dot will take you to the relevant delete page.</label></p>
				<p><label class="extensionp3">To install it, simply proceed to the <a target="_blank" href="https://chrome.google.com/webstore/detail/justdeleteme/hfpofkfbabpbbmchmiekfnlcgaedbgcf">Chrome Web Store</a>.</label></p>			
			</div><div class="banner-block-half">
				<h2>Extension Dot Guide</h2>
				<ul>
					<li><label class="extensionl1"><span class="dot-wrapper"><span class="dot easy"></span></span> - Simple process</label></li>
					<li><label class="extensionl2"><span class="dot-wrapper"><span class="dot medium"></span></span> - Some extra steps involved</label></li>
					<li><label class="extensionl3"><span class="dot-wrapper"><span class="dot hard"></span></span> - Cannot be fully deleted without contacting customer-services</label></li>
					<li><label class="extensionl4"><span class="dot-wrapper"><span class="dot impossible"></span></span> - Cannot be deleted</label></li>					
				</ul>				
			</div>	
		</div>
		<div class="banner-block-extension"></div>
	</div>
	<section class="info-block">
		<div class="info-container">
			<footer>
				<span><label class="footer">Made by <a href="http://robblewis.me">Robb Lewis</a> and <a href="http://edpoole.me">Ed Poole</a> | Fork on <a href="http://github.com/rmlewisuk/justdelete.me">GitHub</a> | Hosted by <a href="http://www.mediatemple.net/#a_aid=521a8aefe4c3b">Media Temple</a> | Analytics by <a href="https://t.co/fvPnva7p4Y">GoSquared</a></span></label>
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