$(function(){     

	$('body').addClass('js-on');

	$('input').keyup(function(){

		if ($('.no-results').is(':visible')) {
			$('.no-results').hide();
		}

		var term = $(this).val().toLowerCase();
		var $sites = $('.sites section');

		$sites.show().filter(function() {
			var text = $(this).find('a').text().replace(/\s+/g, ' ').toLowerCase();
			return !~text.indexOf(term);
		}).hide();

		if ( ! $('.site').is(':visible')) {
			$('.no-results').show();
		}
	});
	
	$('.site a').prop('title', '');

	$('.site').hover(function () {
		$(this).find('.tooltip').fadeIn();
	}, function () {
		$(this).find('.tooltip').fadeOut('fast');
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
				$('.site:first').after('<section class="site impossible"><a href="http://www.nsa.gov/">NSA</a></section>'
					+'<section class="site impossible"><a href="http://www.gchq.gov.uk/Pages/homepage.aspx">GCHQ</a></section>');
			})();

			// and finally clean up the keys array
			keys = [];
		}
	});
});