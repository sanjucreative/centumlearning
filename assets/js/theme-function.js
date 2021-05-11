'use strict';
jQuery(document).ready(function($){	
    $(document).on('click', '.menu-toggle', function () {
        $(this).toggleClass("on");
        $(".main-navigation").toggleClass("on");
        $("body").toggleClass("on");
    })   

    var hlogo = $("header:not(nobanner)").find('.container .logo img').attr('src');
    $(window).scroll(function () {
		var scrollDistance = $(window).scrollTop();
		if(scrollDistance > 0){
			$("header").addClass('is_sticky').find('.container .logo img').attr('src', hlogo.replace(/\.svg$/, '-b.svg'));
		} else{
			$("header").removeClass('is_sticky');
			$("header:not(nobanner)").find('.container .logo img').attr('src', hlogo.replace(/\.svg$/, '.svg'));
		}        
		
        var scrollonscreen = $(window).scrollTop() + $(window).height();
        
        // Scroll to top function
        if(scrollonscreen > $(window).height()*2){
            $('#top-link').css("bottom", "0px");
        }
        else {
            $('#top-link').css("bottom", "-70px");
        }

});

function carouselResize(){
    var winW = $(window).width();
    if(winW < 900){
        var marginLeft = (900-winW)/2 + 15;
        $(".carousel .slides").css({"margin-left": -marginLeft})
    }else{
        $(".carousel .slides").css({"margin-left": "0px"})
    }
}
carouselResize();
$(window).resize(function(){
    carouselResize();  

});


$('#top-link').on('click', function(e){
    $('body,html').stop().animate({
        scrollTop:0
    },800)
    return false;
});    

$(document).on('click', '.readmore', function (e) {
    e.preventDefault();
    $(this).prev(".more_content").slideToggle();
});

$("header .container nav ul.sub-menu").each(function(){
	$(this).before("<span class='submenu_show'>+</span>");
})

$(document).on('click', '.submenu_show', function () {
    // $(this).next('.sub-menu').toggleClass("on");
    $(this).next('.sub-menu').slideToggle();
    if ($(this).text() == "+"){
       $(this).text("-")
    }else{
       $(this).text("+");
    }
})  

$(document).on('click', '.video_play', function () {
    var get_url = $(this).data('url') + "?autoplay=1&rel=0&showinfo=0&modestbranding=0&autohide=0&showtitle=0";
    $("#iframe_video").attr("src", get_url);
    $("body").addClass("on");
    $(".video_modal").show();
})
$(document).on('click', '.video_modal .closed', function () {
    $("#iframe_video").attr("src", "");
    $("body").removeClass("on");
    $(".video_modal").hide();
})



$('#home_hero').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    initialSlide: 0,
    infinite: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 4500,
    speed: 1000,
    dots: true,
    fade: true,
    prevArrow: false,
    nextArrow: false
    //  prevArrow: $('.arrowleft'),
    //  nextArrow: $('.arrowright')
})


$('.recognition').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    infinite: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 4500,
    speed: 1000,
//   prevArrow: $('.arrowleft'),
//    nextArrow: $('.arrowright'),
    responsive: [{
        breakpoint: 992,
        settings: {
            slidesToShow: 5,
        }
        },{
            breakpoint: 768,
            settings: {
            slidesToShow: 3,
            }
        },{
            breakpoint: 400,
            settings: {
            slidesToShow: 2,
            }
        }]
})


$('.testimonials').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 4500,
    speed: 1000,
//    prevArrow: $('.arrowleft3'),
//    nextArrow: $('.arrowright3'),
    responsive: [{
        breakpoint: 992,
        settings: {
            slidesToShow: 3,
        }
        },{
            breakpoint: 800,
            settings: {
            slidesToShow: 2,
            }
        },{
            breakpoint: 640,
            settings: {
            slidesToShow: 1,
            }
        }]
}).on('setPosition', function (event, slick) {
      //  var Height = $(".testimonials .slick-track").height();
      //  $(".testimonials .slick-track .testi_items").height(Height);
         slick.$slides.css('height', slick.$slideTrack.height() + 'px');
});







    
})


