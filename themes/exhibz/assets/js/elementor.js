( function ($, elementor) {
	"use strict";


    var Exhibs = {

        init: function () {
            
            var widgets = {
				'exhibz-speaker.default': Exhibs.Speaker_Image_Popup,
				'exhibz-countdown.default': Exhibs.Ts_Count_Down,
				'exhibz-slider.default': Exhibs.Main_Slider,
            
            };
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
           
		},
		
		Speaker_Image_Popup: function ($scope) {
			var $container = $scope.find('.ts-image-popup');
		
			$container.magnificPopup({
				type: 'inline',
				closeOnContentClick: false,
				midClick: true,
				callbacks: {
				beforeOpen: function () {
					this.st.mainClass = this.st.el.attr('data-effect');
				}
				},
				zoom: {
				enabled: true,
				duration: 500, // don't foget to change the duration also in CSS
				},
				mainClass: 'mfp-fade',
			});																										
		
		},
		//2nd start
		Ts_Count_Down: function ($scope) {
			var $container = $scope.find('.countdown');
		   var date_time = $container.data("event_time");    
			if ($container.length > 0) {
				$container.jCounter({
				   date: date_time,
				   serverDateSource:'',
				 
				   fallback: function () {
					  console.log("count finished!")
				   }
				});
			 }																									
		
		},
			//3rd start
		Main_Slider: function ($scope) {
			var $container = $scope.find('.main-slider');
		     
			    if ($container.length > 0) {
     
			       $container.owlCarousel({
						items: 1,
						mouseDrag: true,
						loop: true,
						touchDrag: true,
						autoplay:true,
						dots: true,
						autoplayTimeout: 5000,
						animateOut: 'fadeOut',
						autoplayHoverPause: true,
						smartSpeed: 250,

			      });
			   }																									
		
		},
    };
    $(window).on('elementor/frontend/init', Exhibs.init);
}(jQuery, window.elementorFrontend) ); 