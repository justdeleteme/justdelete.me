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

        if ( ! $('.site-block').is(':visible')) {
            $('.no-results').show();
        }
    });
    
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
     $('body').scrollTo('.banner-block');
    });

    $('.info').click(function(e) {
     $('body').scrollTo('.info-block');
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