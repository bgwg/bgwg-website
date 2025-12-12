
document.addEventListener("DOMContentLoaded", () => {
    const videoContainer = document.getElementById("videoContainer");
    const thumbnail = document.getElementById("thumbnail");
    const playButton = document.getElementById("playButton");
    const video = document.getElementById("video");

    playButton.addEventListener("click", () => {
        // Hide thumbnail and play button
        thumbnail.style.display = "none";
        playButton.style.display = "none";

        // Show and play video
        video.style.display = "block";
        video.play();
    });

    // Optional: Pause video when clicked
    video.addEventListener("click", () => {
        if (video.paused) {
            video.play();
        } else {
            video.pause();
        }
    });
});

jQuery(document).ready(function($){
	$( document ).ready(function() {
		$('[data-sidenav]').sidenav();
	});
    $(function(){
        $('.selectpicker').selectpicker();
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
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
		arrows: false,
    });
	 //Banner slider
	 $('#gallarySlider').slick({
        dots: true,
        infinite: true,
        speed: 800,
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,
		arrows: false,
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
        accessibility: true,
        variableWidth: false,
        focusOnSelect: false,
        centerMode: false,
        customPaging: function(slick,index) {
            return '<a>' + (index + 1) + '</a>';
        },
        responsive: [
            {
                breakpoint: 991,
                settings: {
                slidesToShow: 2,
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

    // return featuredSlider();
    /* ==============================================
            CUSTOM SELECT
    ============================================== */
    const sorting = document.querySelector('.selectpicker');
    const commentSorting = document.querySelector('.selectpicker');
    const sortingchoices = new Choices(sorting, {
        placeholder: false,
        itemSelectText: ''
    });


    // Trick to apply your custom classes to generated dropdown menu
    let sortingClass = sorting.getAttribute('class');
    window.onload= function () {
        sorting.parentElement.setAttribute('class', sortingClass);
    }

    

}(jQuery));	
