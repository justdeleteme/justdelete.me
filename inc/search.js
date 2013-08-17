$(document).ready(function(){

  $("input").keyup(function(){

    var term = ".site a:not(:contains(" + $(this).val() + "))";
    console.log(term);
    var $sites = $('.sites').children('section');
    console.log($sites);
    $sites.each(function(index, value) {
    	console.log(index, value);
    });
    $(term).parent().css('display', 'none');
  });
});