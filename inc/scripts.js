$(document).ready(function(){     

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
				if (data[i].notes) {
					$('.sites').append("<section class='site "+data[i].difficulty+"'><a href='"+data[i].url+"'>"+data[i].name+"</a><div class='tooltip'><p>" + data[i].notes + "</p></div></section>");
				}
				else {
					$('.sites').append("<section class='site "+data[i].difficulty+"'><a href='"+data[i].url+"'>"+data[i].name+"</a></section>");
				}
			}
		});

  $("input").keyup(function(){

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

	$(".sites").on('mouseenter','.site',function () {
		$(this).find(".tooltip").fadeIn();
	});

	$(".sites").on('mouseleave','.site',function () {
	    $(this).find(".tooltip").fadeOut('fast');
	});
});