
function main() {

(function () {
   'use strict';

    $(window).load(function() {
        // load the map
        $('[aftersrc]').each(function() {
            var aftersrc = $(this).attr("aftersrc");
            var scriptElement = document.createElement('script');
            scriptElement.type = 'text/javascript';
            scriptElement.src = aftersrc;
            document.head.appendChild(scriptElement);
        });
  	}) 

   // Page scroll
  	$('a.page-scroll').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top - 40
            }, 900);
            return false;
          }
        }
      });

  	// Portfolio Isotope Filter
    $(window).load(function() {
        var $container = $('.portfolio-items');
        $container.isotope({
            filter: '*',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
        $('.cat a').click(function() {
            $('.cat .active').removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });

    });
	
	

  // jQuery Parallax
/*  function initParallax() {
    $('#intro').parallax("100%", 0.3);
    $('#section2').parallax("100%", 0.3);
    $('#aboutimg').parallax("100%", 0.3);	
    $('#section5').parallax("100%", 0.1);

  }
  initParallax();
*/
  	// Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false,
        iframe_markup: "<iframe src='{path}' width='{width}' height='{height}' frameborder='no' allowfullscreen='true'></iframe>"
	});	

    // Close menu on mobile when a link is clicked
    $(".navbar-nav li a.page-scroll").click(function(e) {
      if ( $(e.target).is('a'))
          $(".navbar-collapse.in").collapse('hide');
    });

    // Close menu dropdown when a link is clicked
    $(".dropdown-menu a").click(function() {
        $(this).closest(".dropdown-menu").prev().dropdown("toggle");
    });

    // Popover
    $('[data-toggle="popover"]').popover({
        placement: 'right'
    });
    $('[data-toggle="popover"]').click(function(e){
        e.preventDefault();
    })

}());


}
main();

