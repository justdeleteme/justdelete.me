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
		$contributors = "";
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

	$definitions = json_decode(file_get_contents('trans/site/'.$lang.'.json'));

	// var_dump($definitions);
	// die;

	$title = $definitions->title;
	$description = $definitions->description;
	$difficulty = $definitions->difficulty;
	$difficulty_easy = $definitions->difficulty_easy;
	$difficulty_medium = $definitions->difficulty_medium;
	$difficulty_hard = $definitions->difficulty_hard;
	$difficulty_impossible = $definitions->difficulty_impossible;
	$tagline = $definitions->tagline;
	$noinfo = $definitions->noinfo;
	$showinfo = $definitions->showinfo;
	$hideinfo = $definitions->hideinfo;
	$whatisthis = $definitions->whatisthis;
	$whatisthis1 = $definitions->whatisthis1;
	$whatisthis2 = $definitions->whatisthis2;
	$whatisthis3 = $definitions->whatisthis3;
	$guide = $definitions->guide;
	$guideexplanations = $definitions->guideexplanations;
	$guideeasy = $definitions->guideeasy;
	$guidemedium = $definitions->guidemedium;
	$guidehard = $definitions->guidehard;
	$guideimpossible = $definitions->guideimpossible;
	$translationcontrib = $definitions->translationcontrib;
	$morecontrib = $definitions->morecontrib;
	$viewcontrib = $definitions->viewcontrib;
	$extensionguide = $definitions->extensionguide;
	$extension = $definitions->extension;
	$extensionp1 = $definitions->extensionp1;
	$extensionp2 = $definitions->extensionp2;
	$extensionp3 = $definitions->extensionp3;
	$extensionl1 = $definitions->extensionl1;
	$extensionl2 = $definitions->extensionl2;
	$extensionl3 = $definitions->extensionl3;
	$extensionl4 = $definitions->extensionl4;
	$banner = $definitions->banner;
	$footer = $definitions->footer;
	$help_translate = $definitions->help;
	$donate = $definitions->donate;
	$sendmail = $definitions->sendmail;
	$submit = $definitions->submit;

	if ($lang == "en")
	{
		$note_lang = "notes";
	}
	else
	{
		$note_lang = "notes_" . $lang;
	}
	$homepage = true;


?>
<?php include('inc/header.php'); ?>

	<div class="search">
		<div class="search-container">
			<input type="text" id="search">
			<a href="#">search</a>
		</div>

		<div class="sort-container">
			<button class="popular">Popular</button>
	    	<button data-dropdown="#dropdown-2" class="az-sort">A - Z &#9660;</button>
	    	<button data-dropdown="#dropdown-3" class="diff-sort">Difficulty &#9660;</button>
	    	<button class="reset">reset</button>
		</div>

	</div>
	<section class="main">

	<section class="adsense">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- JDM -->
			<ins class="adsbygoogle"
			     style="display:inline-block;width:728px;height:90px"
			     data-ad-client="ca-pub-9778304973218149"
			     data-ad-slot="6251902116"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>	
	</section>
		<section class="sites" id="sites">

			<p class="no-results">Can't find what you're looking for? <a href='http://github.com/rmlewisuk/justdelete.me'>Help make justdelete.me better</a>.</p>

			<!-- // FIRST FOR EACH -->

                        <?php foreach ($sites as $site) : ?><section class="site-block <?php echo $site->difficulty; ?>">
                                <a class="site-header" href="<?php echo $site->url; ?>">
                                    <?php echo $site->name; ?>
                                </a>                            
                                <p class="site-difficulty">
                                    <?php echo eval('return $difficulty_' . $site->difficulty . ';'); ?>
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
                                <?php if (isset($site->meta)) : ?>
                                    	<span class="meta"><?php echo $site->meta; ?></span>
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
		    		<li class="de"><a href="http://www.erbloggt.de/">Konstantin Hinrichs</a>, <a href="http://www.floriankeller.de/">Florian Keller</a></li>
		        	<li class="fr"><a href="https://github.com/buzzb0x">Ethan Ohayon</a></li>
		        	<li class="fr"><a href="https://github.com/p1rox">Armand Vignat</a></li>
		        	<li class="ru"><a href="https://github.com/morozd">morozd</a></li>
		        	<li class="pt_br"><a href="https://github.com/mkbu95">Matheus Macabu</a></li>
		        	<li class="cat"><a href="https://github.com/rockbdn">JP Queralt (+ Español)</a></li>
		        	<li class="vi"><a href="https://github.com/giangnb">Giang Nguyen</a></li>
		        	<li class="tr"><a href="https://github.com/MarioErmando">Erman Sayın</a></li>
		        	<li class="ar"><a href="https://github.com/adahhane">Dahhane Ayyoub</a></li>
		        	<li class="nl"><a href="https://github.com/mprins">Mark Prins</a></li>
		        	<li class="fa"><a href="https://github.com/Arasteh">Mahmoud Arasteh Nasab</a></li>
		        	<li class="zh-cn"><a href="https://github.com/Jonwei">Joe Shen</a></li>
		        	<li class="id"><a href="https://github.com/rafeyu">Ramdziana Feri Y</a></li>

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
	        <li class="nl"><a href="nl.html">Nederlands</a></li>
	        <li class="es"><a href="es.html">Español</a></li>
	        <li class="cat"><a href="cat.html">Català</a></li>
	        <li class="pt_br"><a href="pt_br.html">Português</a></li>
	        <li class="ru"><a href="ru.html">Pусский</a></li>
	        <li class="vi"><a href="vi.html">Tiếng Việt</a></li>
	        <li class="tr"><a href="tr.html">Türk</a></li>
	        <li class="ar"><a href="ar.html">العربية</a></li>
	        <li class="fa"><a href="fa.html">فارسی</a></li>
	        <li class="zh-cn"><a href="zh-cn.html">中国的</a></li>
	        <li class="id"><a href="id.html">Indonesia</a></li>
	        <li class="dropdown-divider"></li>
	        <li class="help"><a target="_blank" href="https://github.com/rmlewisuk/justdelete.me/issues/164"><?php echo $help_translate; ?></a></li>
	    </ul>
	</div>

	<div id="dropdown-2" class="dropdown dropdown-tip">
		<ul class="dropdown-menu">
			<span class="alpha-sort">
				<li><a href="#">a</a></li>
				<li><a href="#">b</a></li>
				<li><a href="#">c</a></li>
				<li><a href="#">d</a></li>
				<li><a href="#">e</a></li>
				<li><a href="#">f</a></li>
				<li><a href="#">g</a></li>
				<li><a href="#">h</a></li>
				<li><a href="#">i</a></li>
				<li><a href="#">j</a></li>
				<li><a href="#">k</a></li>
				<li><a href="#">l</a></li>
				<li><a href="#">m</a></li>
				<li><a href="#">n</a></li>
				<li><a href="#">o</a></li>
				<li><a href="#">p</a></li>
				<li><a href="#">q</a></li>
				<li><a href="#">r</a></li>
				<li><a href="#">s</a></li>
				<li><a href="#">t</a></li>
				<li><a href="#">u</a></li>
				<li><a href="#">v</a></li>
				<li><a href="#">w</a></li>
				<li><a href="#">x</a></li>
				<li><a href="#">y</a></li>
				<li><a href="#">z</a></li>
			</span>
		</ul>
	</div>

	<div id="dropdown-3" class="dropdown dropdown-tip">
		<ul class="dropdown-menu">
			<span class="diff-sort">
				<li><a href="#">Easy</a></li>
				<li><a href="#">Medium</a></li>
				<li><a href="#">Hard</a></li>
				<li><a href="#">Impossible</a></li>
			</span>
		</ul>
	</div>
	
</body>
</html>
