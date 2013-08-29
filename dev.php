<?php

function visitor_country() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $result = "Unknown";
    
    $ip_data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

    if ($ip_data && $ip_data->geoplugin_countryCode != null) {
        $result = $ip_data->geoplugin_countryCode;
    }

    return $result;
}

$sites = json_decode(file_get_contents('sites.json'));
usort($sites, function($a, $b) {
            $a = strtolower($a->name);
            $b = strtolower($b->name);

            if ($a < $b)
                return -1;
            if ($a > $b)
                return 1;
            return 0;
        });

$visitorcountry = strtolower(visitor_country());

if ($visitorcountry == "it")
    require('lang/it.php');
else
    require('lang/en.php')
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
        <!--<script src="inc/scripts.js"></script>-->

        <script type="text/javascript">
            var GoSquared = {};
            GoSquared.acct = "GSN-106715-K";
            (function(w) {
                function gs() {
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
            $(function() {

                $('body').addClass('js-on');

                $('input').keyup(function() {

                    if ($('.no-results').is(':visible')) {
                        $('.no-results').hide();
                    }

                    var term = $(this).val().toLowerCase();
                    var $sites = $('.sites section');

                    $sites.show().filter(function() {
                        var text = $(this).find('a').text().replace(/\s+/g, ' ').toLowerCase();
                        return !~text.indexOf(term);
                    }).hide();

                    if (!$('.site-block').is(':visible')) {
                        $('.no-results').show();
                    }
                });

                $('.site a').prop('title', '');

                // jQuery ScrollTo plugin from http://lions-mark.com/jquery/scrollTo/

                $.fn.scrollTo = function(target, options, callback) {
                    if (typeof options == 'function' && arguments.length == 2) {
                        callback = options;
                        options = target;
                    }
                    var settings = $.extend({
                        scrollTarget: target,
                        offsetTop: 50,
                        duration: 500,
                        easing: 'swing'
                    }, options);
                    return this.each(function() {
                        var scrollPane = $(this);
                        var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
                        var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
                        scrollPane.animate({scrollTop: scrollY}, parseInt(settings.duration), settings.easing, function() {
                            if (typeof callback == 'function') {
                                callback.call(this);
                            }
                        });
                    });
                }

                // Banner scroll to bottom

                // $('.banner').click(function(e) {
                // 	$('body').scrollTo('.banner-block');
                // })

                // $('.site').hover(function () {
                // 	$(this).find('.tooltip').fadeIn();
                // }, function () {
                // 	$(this).find('.tooltip').fadeOut('fast');
                // });

                $('.contains-info').click(function(e) {
                    e.preventDefault();
                    if ($(this).prev().hasClass('toggled')) {
                        if ($(this).hasClass('text-toggled')) {
                            $(this).html("<?php echo showInfo; ?>").removeClass('text-toggled');
                        } else {
                            $(this).html("<?php echo showInfo; ?>").removeClass('text-toggled');
                        }
                        $(this).prev().slideToggle().removeClass('toggled');
                    } else {
                        $('.toggled').next().html("<?php echo showInfo; ?>");
                        $('.toggled').slideToggle().removeClass('toggled');
                        $(this).prev().slideToggle().addClass('toggled');
                        $(this).html("<?php echo hideInfo; ?>").addClass('text-toggled');
                    }
                });

                // create the keys and konami variables
                var keys = [],
                        konami = "38,38,40,40,37,39,37,39,66,65";

                $(document).keydown(function(e) {
                    keys.push(e.keyCode);

                    // and check to see if the user has entered the Konami code
                    if (keys.toString().indexOf(konami) >= 0) {

                        // do something such as:
                        (function() {
                            $('.site-block:first').after('<section class="site-block impossible"><a class="site-header" href="http://www.nsa.gov/">NSA</a><p class="site-difficulty">Difficulty: impossible</p><p class="tooltip-toggle">No Info Available</p></section>'
                                    + '<section class="site-block impossible"><a class="site-header" href="http://www.gchq.gov.uk/Pages/homepage.aspx">GCHQ</a><p class="site-difficulty">Difficulty: impossible</p><p class="tooltip-toggle">No Info Available</p></section>');
                        })();

                        // and finally clean up the keys array
                        keys = [];
                    }
                });
            });

            // Load Facebook after page load
            window.onload = function() {

                $('#search').focus();

                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));

                console.log('Welcome to justdelete.me. We currently have ' + $('.site-block').length + ' services listed.');
            };
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

                <?php foreach ($sites as $site) : ?><section class="site-block <?php
                    if ($site->difficulty == 0) {
                        echo "easy";
                    } else if ($site->difficulty == 1) {
                        echo "medium";
                    } else if ($site->difficulty == 2) {
                        echo "hard";
                    } else if ($site->difficulty == 3) {
                        echo "impossible";
                    }
                    ?>">
                        <a class="site-header" href="<?php echo $site->url; ?>">
                            <?php echo $site->name; ?>
                        </a>
                        <p class="site-difficulty">
                            <?php echo difficulty; ?><?php
                            if ($site->difficulty == 0) {
                                echo difficulty_easy;
                            } else if ($site->difficulty == 1) {
                                echo difficulty_medium;
                            } else if ($site->difficulty == 2) {
                                echo difficulty_hard;
                            } else if ($site->difficulty == 3) {
                                echo difficulty_impossible;
                            }
                            ?>
                        </p>
                        <?php if (isset($site->notes)) : ?>
                            <div class="tooltip-content">                               
                                <?php
                                if ($visitorcountry == "it") {
                                    if (isset($site->notes_it))
                                        echo $site->notes_it;
                                    else
                                        echo $site->notes;
                                } else {
                                    echo $site->notes;
                                }
                                ?>	
                            </div>
                            <a href="#" class="tooltip-toggle contains-info"><?php echo showInfo; ?></a>
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
                        <script>!function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = p + '://platform.twitter.com/widgets.js';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, 'script', 'twitter-wjs');</script>
                        <!-- Facebook -->
                        <div class="fb-like" data-href="http://justdelete.me" data-width="450" data-colorscheme="dark" data-layout="button_count" data-show-faces="false" data-send="false"></div>

                    </div>
                </footer>
            </div>		
        </section>
    </body>
</html>