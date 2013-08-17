<!DOCTYPE HTML>
<html>
<head>
	<title>Just Delete Me | justdelete.me</title>
	<meta charset="UTF-8">
	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="inc/search.js"></script>
</head>	
<body>
	<script>
		$.getJSON('sites.json', function(data) {
			// Sort by name, asc
			data.sort(function(a, b){
			 var nameA=a.name.toLowerCase(), nameB=b.name.toLowerCase()
			 if (nameA < nameB)
			  return -1 
			 if (nameA > nameB)
			  return 1
			 return 0
			});
			for (i = 0; i < data.length; i++) {
				$('.sites').append("<section class='site "+data[i].difficulty+"'><a href='"+data[i].url+"'>"+data[i].name+"</a></section>");
			}
		});
	</script>
	<header>
		<h1>just<span>delete</span>.me</h1>
		<p class="tagline">A directory of urls to delete your account from web services.</p>
	</header>

	<div id="test">
	</div>
	<div class="search">
		<div class="search-container">
			<input type="text" id="search">
			<a href="">search</a>
		</div>
	</div>
	<section class="main">		
		<section class="sites" id="sites">

		</section>
	</section>
	<section class="info-block">
		<div class="info-container">
			<h2>What is this?</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<ul>
				<li><span class="green">Green:</span> Simple process</li>
				<li><span class="yellow">Yellow:</span> Some steps involved</li>
				<li><span class="red">Red:</span> Cannot be deleted without contacting customer services</li>
			</ul>
			<footer>
				<span>Made by <a href="http://robblewis.me">Robb Lewis</a></span>
			</footer>
		</div>		
	</section>	
</body>
</html>