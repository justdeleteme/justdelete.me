$(document).ready(function(){

  $("input").keyup(function(){

	var term = $(this).val();
    var $sites = $('.sites').children('section');

    $sites.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(term);
    }).hide();
  });
});