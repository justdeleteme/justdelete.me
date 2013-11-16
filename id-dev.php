<?php 

	// For testing
	if (isset($_GET['lang']))
	{
		$lang = $_GET['lang'];
	}
	if ( !isset($lang))
	{
		$lang = "en";
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

?>

<?php include('inc/header.php'); ?>

<script type="text/javascript" src="/inc/generate.js"></script>
<script type="text/javascript" src="/inc/markov.min.js"></script>

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
<section class="content">
	<div class="generate">
		<button class="generate">Generate fake identity</button><br/>
		<input type="radio" name="gender" id="male" checked> Male <input type="radio" name="gender"> Female
	</div>
    <div id="identity"></div>

    <div class="tweet-button">
    	<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://justdelete.me/fake-identity-generator" data-text="I created a fake identity with JustDelete.me!" data-size="large" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </div>
</section>

<?php include('inc/id-footer.php'); ?>