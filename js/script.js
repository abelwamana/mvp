/**
 * WEBSITE: https://themefisher.com
 * TWITTER: https://twitter.com/themefisher
 * FACEBOOK: https://www.facebook.com/themefisher
 * GITHUB: https://github.com/themefisher/
 */

jQuery(function ($) {
	'use strict';

	/* ----------------------------------------------------------- */
	/*  Fixed header
	/* ----------------------------------------------------------- */
	$(window).on('scroll', function () {

		// fixedHeader on scroll
		function fixedHeader() {
			var headerTopBar = $('.top-bar').outerHeight();
			var headerOneTopSpace = $('.header-one .logo-area').outerHeight();

			var headerOneELement = $('.header-one .site-navigation');
			var headerTwoELement = $('.header-two .site-navigation');

			if ($(window).scrollTop() > headerTopBar + headerOneTopSpace) {
				$(headerOneELement).addClass('navbar-fixed');
				$('.header-one').css('margin-bottom', headerOneELement.outerHeight());
			} else {
				$(headerOneELement).removeClass('navbar-fixed');
				$('.header-one').css('margin-bottom', 0);
			}
			if ($(window).scrollTop() > headerTopBar) {
				$(headerTwoELement).addClass('navbar-fixed');
				$('.header-two').css('margin-bottom', headerTwoELement.outerHeight());
			} else {
				$(headerTwoELement).removeClass('navbar-fixed');
				$('.header-two').css('margin-bottom', 0);
			}
		}
		fixedHeader();


		// Count Up
		function counter() {
			var oTop;
			if ($('.counterUp').length !== 0) {
				oTop = $('.counterUp').offset().top - window.innerHeight;
			}
			if ($(window).scrollTop() > oTop) {
				$('.counterUp').each(function () {
					var $this = $(this),
						countTo = $this.attr('data-count');
					$({
						countNum: $this.text()
					}).animate({
						countNum: countTo
					}, {
						duration: 1000,
						easing: 'swing',
						step: function () {
							$this.text(Math.floor(this.countNum));
						},
						complete: function () {
							$this.text(this.countNum);
						}
					});
				});
			}
		}
		counter();


		// scroll to top btn show/hide
		function scrollTopBtn() {
			var scrollToTop = $('#back-to-top'),
				scroll = $(window).scrollTop();
			if (scroll >= 50) {
				scrollToTop.fadeIn();
			} else {
				scrollToTop.fadeOut();
			}
		}
		scrollTopBtn();
	});


	$(document).ready(function () {

		// navSearch show/hide
		function navSearch() {
			$('.nav-search').on('click', function () {
				$('.search-block').fadeIn(350);
			});
			$('.search-close').on('click', function () {
				$('.search-block').fadeOut(350);
			});
		}
		navSearch();

		// navbarDropdown
		function navbarDropdown() {
			if ($(window).width() < 992) {
				$('.site-navigation .dropdown-toggle').on('click', function () {
					$(this).siblings('.dropdown-menu').animate({
						height: 'toggle'
					}, 300);
				});

				var navbarHeight = $('.site-navigation').outerHeight();
				$('.site-navigation .navbar-collapse').css('max-height', 'calc(100vh - ' + navbarHeight + 'px)');
			}
		}
		navbarDropdown();


		// back to top
		function backToTop() {
			$('#back-to-top').on('click', function () {
				$('#back-to-top').tooltip('hide');
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		}
		backToTop();


		// banner-carousel
		function bannerCarouselOne() {
			$('.banner-carousel.banner-carousel-1').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				dots: true,
				speed: 600,
				arrows: true,
				prevArrow: '<button type="button" class="carousel-control left" aria-label="carousel-control"><i class="fas fa-chevron-left"></i></button>',
				nextArrow: '<button type="button" class="carousel-control right" aria-label="carousel-control"><i class="fas fa-chevron-right"></i></button>'
			});
			$('.banner-carousel.banner-carousel-1').slickAnimation();
		}
		bannerCarouselOne();


		// banner Carousel Two
		function bannerCarouselTwo() {
			$('.banner-carousel.banner-carousel-2').slick({
				fade: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				dots: false,
				speed: 600,
				arrows: true,
				prevArrow: '<button type="button" class="carousel-control left" aria-label="carousel-control"><i class="fas fa-chevron-left"></i></button>',
				nextArrow: '<button type="button" class="carousel-control right" aria-label="carousel-control"><i class="fas fa-chevron-right"></i></button>'
			});
		}
		bannerCarouselTwo();


		// pageSlider
		function pageSlider() {
			$('.page-slider').slick({
				fade: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				dots: false,
				speed: 600,
				arrows: true,
				prevArrow: '<button type="button" class="carousel-control left" aria-label="carousel-control"><i class="fas fa-chevron-left"></i></button>',
				nextArrow: '<button type="button" class="carousel-control right" aria-label="carousel-control"><i class="fas fa-chevron-right"></i></button>'
			});
		}
		pageSlider();


		// Shuffle js filter and masonry
		function projectShuffle() {
			if ($('.shuffle-wrapper').length !== 0) {
				var Shuffle = window.Shuffle;
				var myShuffle = new Shuffle(document.querySelector('.shuffle-wrapper'), {
					itemSelector: '.shuffle-item',
					sizer: '.shuffle-sizer',
					buffer: 1
				});
				$('input[name="shuffle-filter"]').on('change', function (evt) {
					var input = evt.currentTarget;
					if (input.checked) {
						myShuffle.filter(input.value);
					}
				});
				$('.shuffle-btn-group label').on('click', function () {
					$('.shuffle-btn-group label').removeClass('active');
					$(this).addClass('active');
				});
			}
		}
		projectShuffle();


		// testimonial carousel
		function testimonialCarousel() {
			$('.testimonial-slide').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: true,
				speed: 600,
				arrows: false
			});
		}
		testimonialCarousel();


		// team carousel
		function teamCarousel() {
			$('.team-slide').slick({
				dots: false,
				infinite: false,
				speed: 300,
				slidesToShow: 4,
				slidesToScroll: 2,
				arrows: true,
				prevArrow: '<button type="button" class="carousel-control left" aria-label="carousel-control"><i class="fas fa-chevron-left"></i></button>',
				nextArrow: '<button type="button" class="carousel-control right" aria-label="carousel-control"><i class="fas fa-chevron-right"></i></button>',
				responsive: [{
						breakpoint: 992,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 481,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		}
		teamCarousel();


		// media popup
		function mediaPopup() {
			$('.gallery-popup').colorbox({
				rel: 'gallery-popup',
				transition: 'slideshow',
				innerHeight: '500'
			});
			$('.popup').colorbox({
				iframe: true,
				innerWidth: 600,
				innerHeight: 400
			});
		}
		mediaPopup();

	});


});
// Pesquisa e mostra dos resultados
$(document).ready(function() {
    $('.search-form2 button').on('click', function(event) {
        event.preventDefault(); // Impede o envio do formulário
        var query = $('.search-form2 input').val(); // Obtém o valor do campo de entrada
        search(query); // Chama a função de pesquisa com o termo de pesquisa
    });
});

//function search(query) {
//    // Atualiza o conteúdo do elemento com ID "searchResults" com uma mensagem de exemplo
//    $('#searchResults').html('Exibindo resultados para: ' + query);
//}

document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('.search-form2');
    var input = form.querySelector('input');
    var searchResults = document.getElementById('search-results');
    
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Evita o envio do formulário
        searchResults.innerHTML = ''; // Limpa os resultados anteriores
        
        var searchTerm = input.value.trim().toLowerCase(); // Obtém o termo de pesquisa
        if (searchTerm === '') return; // Sai se o termo de pesquisa estiver vazio
        
        // Percorre todos os elementos de texto na página
        Array.from(document.querySelectorAll('body *')).forEach(function (element) {
            if (element.nodeType === Node.TEXT_NODE) {
                var text = element.textContent.toLowerCase();
                var index = text.indexOf(searchTerm);
                if (index !== -1) {
                    // Se a palavra-chave for encontrada, destaca-a
                    var result = document.createElement('span');
                    result.textContent = element.textContent.substring(index, index + searchTerm.length);
                    result.style.backgroundColor = 'yellow';
                    searchResults.appendChild(result);
                }
            }
        });
    });
});


 // Popup
 $(document).ready( function() {
  
	$('.add').click(function(e){
	  e.stopPropagation();
	 if ($(this).hasClass('active')){
	   $('.dialog').fadeOut(200);
	   $(this).removeClass('active');
	 } else {
	   $('.dialog').delay(300).fadeIn(200);
	   $(this).addClass('active');
	 }
   });
   $('.add1').click(function(e){
	e.stopPropagation();
   if ($(this).hasClass('active')){
	 $('.dialog1').fadeOut(200);
	 $(this).removeClass('active');
   } else {
	 $('.dialog1').delay(300).fadeIn(200);
	 $(this).addClass('active');
   }
  });
  $('.add2').click(function(e){
	e.stopPropagation();
   if ($(this).hasClass('active')){
	 $('.dialog2').fadeOut(200);
	 $(this).removeClass('active');
   } else {
	 $('.dialog2').delay(300).fadeIn(200);
	 $(this).addClass('active');
   }
  });
   $('.radio > .button').click( function() {
	 $('.radio').find('.button.active').removeClass('active');
	 $(this).addClass('active');
   });
	 
   function closeMenu(){
	 $('.dialog').fadeOut(200);
	 $('.add').removeClass('active'); 
	 $('.dialog1').fadeOut(200);
   $('.add1').removeClass('active'); 
   $('.dialog2').fadeOut(200);
   $('.add2').removeClass('active');   
   }
	 
   $(document.body).click( function(e) {
		closeMenu();
   });
   
   $(".dialog").click( function(e) {
	   e.stopPropagation();
   });
   $(".dialog1").click( function(e) {
	 e.stopPropagation();
  });
  $(".dialog2").click( function(e) {
	e.stopPropagation();
 });
   });
   
   jQuery(document).ready(function() {
	jQuery('.toggle-nav2').click(function(e) {
		jQuery(this).toggleClass('active');
		jQuery('.menu2 ul').toggleClass('active');

		e.preventDefault();
	});
});