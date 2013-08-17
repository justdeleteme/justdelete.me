$(document).ready(function(){

  $("input").keyup(function(){

	if ($('.no-results').is(':visible')) {
		$('.no-results').hide();
	}

	var term = $(this).val().toLowerCase();
    var $sites = $('.sites').children('section');

    $sites.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(term);
    }).hide();

    if ( ! $('.site').is(':visible')) {
		console.log($('.site').is(':visible'));
		$('.no-results').show();
    }
  });
});