
document.addEventListener("DOMContentLoaded", function () {
    const playBtn = document.getElementById("playButton");
    const thumb = document.getElementById("videoThumb");
    const iframe = document.querySelector(".iframe-video");
    const video = document.querySelector(".html-video");

    if (playBtn) {
        playBtn.addEventListener("click", function () {

            playBtn.style.display = "none";
            if (thumb) thumb.style.display = "none";

            // YouTube / Vimeo
            if (iframe) {
                iframe.src = iframe.getAttribute("data-src");
            }

            // Self hosted
            if (video) {
                video.play();
            }
        });
    }
});


jQuery(document).ready(function($){
	$( document ).ready(function() {
		$('[data-sidenav]').sidenav();
	});
 
    $(window).scroll(function(){
        if ($(this).scrollTop() > 400) {
           $('.navbar-fixed-top').addClass('newBg');
        } else {
           $('.navbar-fixed-top').removeClass('newBg');
        }
    });
	 //Banner slider
	 $('#bannerSlider').slick({
        dots: true,
        infinite: true,
        speed: 800,
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,
		arrows: false,
    });
    $('#gallarySlider').slick({
        dots: true,
        infinite: true,
        speed: 800,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
    });
    // List slider 
    $('.featured-digital-slider').slick({
        dots: false,
        arrows:false,
        infinite: true,
        speed: 300,
        autoplay: true,
        slidesToShow: 5,
        accessibility: true,
        variableWidth: false,
        focusOnSelect: false,
        centerMode: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                slidesToShow: 2,
                }
            }
        ]
    });
    // List slider 
    $('.features-slider').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 300,
        autoplay: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        accessibility: true,
        variableWidth: false,
        focusOnSelect: false,
        centerMode: false,
        customPaging: function (slick, index) {
            var number = (index + 1).toString().padStart(2, '0');
            return '<a class="item-number">' + number + '</a>';
        },
        responsive: [
            {
                breakpoint: 991,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                }
            }
        ]
    });

    // thumbnail slider for case study 
    $('.thumb-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.main-slider',
        vertical: true,
        focusOnSelect: true,
        arrows: false,
        centerMode: true,
        centerPadding: "0px",
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    vertical: false,
                    centerMode: false,
                }
            }
        ]
    });

    $('.main-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.thumb-slider'
    });
}(jQuery));	
