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

});


/** Preview images before form submit */

let filesInput = document.querySelector('.files-input');
if(filesInput) {
	filesInput.addEventListener('change', handleFilePreview);
}


function handleFilePreview(e, files) {
	let target = e.target;
	files = target.files;
	let previewContainer = target.parentNode.querySelector('#input-preview');
	var imageType = /^image\//;
	for (var i = 0; i < files.length; i++) {
		var file = files[i];
		if (!imageType.test(file.type)) {
			alert("Veuillez sélectionner une image");
		}
		else{
			if(i == 0){
				previewContainer.innerHTML = '';
			}
			var img = document.createElement("img");
			img.classList.add("obj");
			img.file = file;
			previewContainer.appendChild(img);
			var reader = new FileReader();
			reader.onload = ( function(aImg) { 
			return function(e) { 
			aImg.src = e.target.result; 
			}; 
		})(img);

		reader.readAsDataURL(file);
		}

	}
}


// MULTIPLE SELECT FORM
$(document).ready(function() {
$('.basic-multiple-select').select2();
});