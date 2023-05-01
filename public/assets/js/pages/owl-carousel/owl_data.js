$(document).ready(function() {
				$("#owl-demo").owlCarousel({
					autoPlay: 3000,
					navigation: true,
					slideSpeed: 300,
					paginationSpeed: 400,
					singleItem: true
				});
				$("#owl-demo2").owlCarousel({
					autoPlay: 2000,
					items: 2,
					itemsDesktop: [1199, 3],
					// itemsDesktopSmall: [979, 3],
					pagination: false // Set pagination option to false
				});
				
			});