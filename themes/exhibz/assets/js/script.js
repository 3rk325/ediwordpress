jQuery( document ).ready( function($){
   "use strict";

             /**-------------------------------------------------
     *Fixed HEader
     *----------------------------------------------------**/
    $(window).on('scroll', function () {

      /**Fixed header**/
      if ($(window).scrollTop() > 250) {
         $('.navbar-fixed').addClass('sticky fade_down_effect');
      } else {
         $('.navbar-fixed').removeClass('sticky fade_down_effect');
      }
});

  /* ----------------------------------------------------------- */
  /*  Mobile Menu
  /* ----------------------------------------------------------- */
   $('.dropdown > a').on('click', function(e) {
      var dropdown = $(this).parent('.dropdown');
      dropdown.find('>.dropdown-menu').slideToggle('show');
      $(this).toggleClass('opened');
      return false;
    });

    

/* ----------------------------------------------------------- */
   /*  Site search
   /* ----------------------------------------------------------- */


   $('.nav-search').on('click', function () {
      $('.search-block').fadeIn(350);
      $('.nav-search').addClass('hide');
   });

   $('.search-close').on('click', function () {
      $('.search-block').fadeOut(350);
      $('.nav-search').removeClass('hide');
   });

   $(document).on('mouseup', function (e) {
      var container = $(".nav-search-area");

      if (!container.is(e.target) && container.has(e.target).length === 0) {
         $('.search-block').fadeOut(350);
         $('.nav-search').removeClass('hide');
      }

  }); 
  
   /* ----------------------------------------------------------- */
   /*  Back to top
   /* ----------------------------------------------------------- */

   $(window).on('scroll', function () {
    if ($(window).scrollTop() > $(window).height()) {
       $(".BackTo").fadeIn('slow');
    } else {
       $(".BackTo").fadeOut('slow');
    }

    });

    $("body, html").on("click", ".BackTo", function (e) {
        e.preventDefault();
        $('html, body').animate({
          scrollTop: 0
        }, 800);
    });

      /*==========================================================
               go current section
      ======================================================================*/
      $('.scroll a').on('click', function() {
         $('html, body').animate({scrollTop: $(this.hash).offset().top - 70}, 1000);
         return false;
     });
     
     if ($('.box-style').length > 0) {
      $('.box-style').each(function () {
         if ($(this).find('.elementor-row').length > 0) {
            $(this).find('.elementor-row').append('<div class="indicator"></div>')
         }
      })
   }

} );