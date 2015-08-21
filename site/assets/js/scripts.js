$(function(){
    $('body').addClass('js-on');

    // A - Z Sorting
    $('.alpha-sort a').click(function(e){
        e.preventDefault();
        var term = $(this).text();
        var $sites = $('.sites section');

        $sites.show().filter(function() {
            var text = $(this).find('.site-header').text().replace(/\s+/g, ' ').toLowerCase().substr(1,1);
            return !~text.indexOf(term);
        }).hide();

        if ( ! $('.site-block').is(':visible')) {
            $('.no-results').show();
        }
    });

    // Difficulty sorting
    $('.diff-sort a').click(function(e){
        e.preventDefault();
        var term = $(this).text().toLowerCase();
        var $sites = $('.sites section');

        $sites.show().filter(function() {
            var text = $(this).find('.site-difficulty').text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(term);
        }).hide();

        if ( ! $('.site-block').is(':visible')) {
            $('.no-results').show();
        }
    });

    // Popular sorting
    $('button.popular').click(function(e){
        e.preventDefault();
        var term = "popular";
        var $sites = $('.sites section');

        $sites.show().filter(function() {
            var text = $(this).find('.meta').text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(term);
        }).hide();

        if ( ! $('.site-block').is(':visible')) {
            $('.no-results').show();
        }
    });

    // Clear search and sorting
    $('button.reset').click(function(e){
        var $sites = $('.sites section');
        $sites.show();
        $('.no-results').hide();
        $('input').val('');
    });

    // When the search field changes, update the hash
    $('input').keyup(function(){
		window.location.hash = $(this).val();
    });
	
	// Call updateSearch when hash changes
	$(window).on('hashchange', function() {
		updateSearch();
	});
	
	// Search function
	function updateSearch() {
		if ($('.no-results').is(':visible')) {
			$('.no-results').hide();
		}
		
		var hash = document.location.hash.toLowerCase();
		var term = hash.substr(1);
		
		var $sites = $('.sites section');

		$sites.show().filter(function() {
			var text = $(this).find('.site-header').text().replace(/\s+/g, ' ').toLowerCase();
			return !~text.indexOf(term);
		}).hide();

		if ( ! $('.site-block').is(':visible')) {
			$('.no-results').show();
		}
		
		// Insert the term into the field
		// (sometimes this is missed if the hash is changed directly)
		$('#search').val(window.location.hash.substr(1));
	}
	
	// Update search results on page load (if there is a hash)
	if (window.location.hash !== "" && window.location.hash !== "#") {
		// Insert the term into the field
		$('#search').val(window.location.hash.substr(1));
		
		// Update the results
		updateSearch();
	}
	
    $('.site a').prop('title', '');

    // jQuery ScrollTo plugin from http://lions-mark.com/jquery/scrollTo/

    $.fn.scrollTo = function( target, options, callback ){
      if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
      var settings = $.extend({
        scrollTarget  : target,
        offsetTop     : 50,
        duration      : 500,
        easing        : 'swing'
      }, options);
      return this.each(function(){
        var scrollPane = $(this);
        var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
        var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
        scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
          if (typeof callback == 'function') { callback.call(this); }
        });
      });
    }

    // Banner scroll to bottom

    $('.banner').click(function(e) {
        e.preventDefault();
     $('body').scrollTo('.banner-block');
    });

    $('.info').click(function(e) {
        e.preventDefault();
     $('body').scrollTo('.about');
    });

    // create the keys and konami variables
    var keys = [],
    konami = "38,38,40,40,37,39,37,39,66,65";

    $(document).keydown(function(e){
        keys.push(e.keyCode);

        // and check to see if the user has entered the Konami code
        if (keys.toString().indexOf(konami) >= 0) {

            // do something such as:
            (function(){
                $('.site-block:first').after('<section class="site-block impossible"><a class="site-header" href="http://www.nsa.gov/">NSA</a><p class="site-difficulty">Difficulty: impossible</p><p class="tooltip-toggle">No Info Available</p></section>'
                    +'<section class="site-block impossible"><a class="site-header" href="http://www.gchq.gov.uk/Pages/homepage.aspx">GCHQ</a><p class="site-difficulty">Difficulty: impossible</p><p class="tooltip-toggle">No Info Available</p></section>');
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
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    console.log('Welcome to justdelete.me. We currently have ' + $('.site-block').length + ' services listed.');
};
