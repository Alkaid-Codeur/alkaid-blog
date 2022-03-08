jQuery(document).ready(function ($) {


	"use strict";

	// Page loading animation

	$("#preloader").animate({
		'opacity': '0'
	}, 600, function () {
		setTimeout(function () {
			$("#preloader").css("visibility", "hidden").fadeOut();
		}, 300);
	});


	// $(window).scroll(function() {
	//   var scroll = $(window).scrollTop();
	//   var box = $('.header-text').height();
	//   var header = $('header').height();

	//   if (scroll >= box - header) {
	//     $("header").addClass("background-header");
	//   } else {
	//     $("header").removeClass("background-header");
	//   }
	// });

	if ($('.owl-clients').length) {
		$('.owl-clients').owlCarousel({
			loop: true,
			nav: false,
			dots: true,
			items: 1,
			margin: 30,
			autoplay: false,
			smartSpeed: 700,
			autoplayTimeout: 6000,
			responsive: {
				0: {
					items: 1,
					margin: 0
				},
				460: {
					items: 1,
					margin: 0
				},
				576: {
					items: 3,
					margin: 20
				},
				992: {
					items: 5,
					margin: 30
				}
			}
		});
	}

	if ($('.owl-banner').length) {
		$('.owl-banner').owlCarousel({
			loop: true,
			nav: true,
			dots: true,
			items: 3,
			margin: 10,
			autoplay: true,
			smartSpeed: 700,
			autoplayTimeout: 6000,
			responsive: {
				0: {
					items: 1,
					margin: 0
				},
				460: {
					items: 1,
					margin: 0
				},
				576: {
					items: 1,
					margin: 10
				},
				992: {
					items: 3,
					margin: 10
				}
			}
		});
	}

	// Post Gallery Carousel
	var owl = $('.gallery-carousel');
	owl.owlCarousel({
		items: 1,
		dots: false,
		nav: true,
		loop: true,
		autoplay: true,
		smartSpeed: 700,
		autoplayTimeout: 6000,
		// responsive: {
		// 	0: {
		// 		nav: false
		// 	},
		// 	992: {
		// 		nav: true
		// 	}
		// }
	});
	$('.play').on('click', function () {
		owl.trigger('play.owl.autoplay', [1000])
	})
	$('.stop').on('click', function () {
		owl.trigger('stop.owl.autoplay')
	})

	let tgPassword = document.getElementById('password-view');
	if(tgPassword) {
		tgPassword.addEventListener('click', function(e) {
			let target = e.target.previousElementSibling;
			if(target.getAttribute('type') === 'password') {
				target.setAttribute('type', 'text');
			}
			else {
				target.setAttribute('type', 'password');
			}
		})
	
	}
});




