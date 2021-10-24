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
			$("header").addClass('is_sticky');
            // $("header").find('.container .logo img').attr('src', hlogo.replace(/\.svg$/, '-b.svg'));
		} else{
			$("header").removeClass('is_sticky');
			// $("header:not(nobanner)").find('.container .logo img').attr('src', hlogo.replace(/\.svg$/, '.svg'));
		}        
		
        var scrollonscreen = $(window).scrollTop() + $(window).height();
        
        // Scroll to top function
        if(scrollonscreen > $(window).height()*2){
            $('#top-link').css("bottom", "0px");
            // $('.contact_us_btn').css("bottom", "50px");
        }
        else {
            $('#top-link').css("bottom", "-70px");
            // $('.contact_us_btn').css("bottom", "0px");
        }

        infographics();
    });
    infographics();
function infographics(){
    $('.infographic_arrow').each(function(){  
        var $columns = $('li .arrow_excerpt',this);
        var maxHeight = Math.max.apply(Math, $columns.map(function(){
            return $(this).height();
        }).get());
        $(this).height((maxHeight*2) + (30*2));
        $columns.height(maxHeight);
        $('li.empty').prev().addClass("pre_empty");
    });


    $('.infographic_circle').each(function(){  
        var $columns = $('li .circle_excerpt',this);
        var maxHeight = Math.max.apply(Math, $columns.map(function(){
            return $(this).height();
        }).get());
        $(this).height((maxHeight*2) + (60*2));
        $columns.height(maxHeight);
    });

    $('.infographic_circle_wave').each(function(){  
        var $columns = $('li .follow_excerpt',this);
        var maxHeight = Math.max.apply(Math, $columns.map(function(){
            return $(this).height();
        }).get());
        $(this).height((maxHeight*2) + (85*2));
        $columns.height(maxHeight);
    });
}

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
    ($(this).text() === "View More") ? $(this).text("View Less") : $(this).text("View More");
});

$(document).on('click', '.platform_features_btn', function (e) {
    e.preventDefault();
    $(".platform_features_list").slideToggle();
    ($(this).text() === "View More") ? $(this).text("View Less") : $(this).text("View More");
}) 


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

$(document).on('click', '.scrollspy[href^="#"], .scrollspy a[href^="#"]', function (event) {
    event.preventDefault();
	var hash = this.hash;
    // var offsetTop = $(this).data('offset-top');
     var offsetTop = 200;

    $('html, body').animate({
       scrollTop: $(hash).offset().top - offsetTop
    }, 800);
});	



    setTimeout(function(){
        $(document).find('.infographic_circle_wave li').each(function(){  
            var columnHTML = $(this).find('.follow_excerpt').html();
            $('<div class="follow_excerpt_res">' + columnHTML + '</div>').insertBefore($(this).find('.follow_circle'));
            // $(this).html('ddads');
            console.log(columnHTML);
        });
    }, 1800);


$(document).find('select.wpcf7-select').each(function(){  
    $(this).find('option:first-child').text($(this).parents('.form-group').find('.placelabel').text());
    $(this).find('option:first-child').attr('label', $(this).parents('.form-group').find('.placelabel').text())
})

$('.form-group').find('br').remove();
$(document).on('hover', '.wpcf7-not-valid-tip', function(){
	$(this).remove();
})
$(document).on('focusin', '.form-control', function(){	
		var getEle = $(this).prop('tagName');
		if(getEle == 'INPUT'){
			var gatPlaceholder = $(this).attr('placeholder');
			if((typeof gatPlaceholder != 'undefined') && gatPlaceholder !=''){
				$(this).parents('.form-group').find('.placelabel').addClass('showlabel');
				$(this).css({'padding':'15px 10px'});
			}
			$(this).on('focusout', function() {
			if($(this).val() == '') {
				$(this).attr('placeholder', $(this).parents('.form-group').find('.placelabel').text());
				$(this).css({'padding':'15px 10px'});
				$(this).parents('.form-group').find('.placelabel').removeClass('showlabel');
			}
			})			
			$(this).removeAttr('placeholder');
			$(this).css({'padding':'10px 10px 7px'});
		}
		if(getEle == 'SELECT'){
			$(this).on('change', function() {
				$(this).parents('.form-group').find('.placelabel').addClass('showlabel');
				$(this).find('option[label]').remove();
			    $(this).css({'padding':'10px 10px 7px', 'color':'#495057'});
			});
		}
		
		if(getEle == 'TEXTAREA'){
			var gatPlaceholder = $(this).attr('placeholder');
			if((typeof gatPlaceholder != 'undefined') && gatPlaceholder !=''){
				$(this).parents('.form-group').find('.placelabel').addClass('showlabel');
				$(this).css({'padding':'17px 10px 7px'});
			}
			$(this).on('focusout', function() {
			if($(this).val() == '') {
				$(this).attr('placeholder', $(this).parents('.form-group').find('.placelabel').text());
				$(this).css({'padding':'15px 10px'});
				$(this).parents('.form-group').find('.placelabel').removeClass('showlabel');
			}
			})				
			$(this).removeAttr('placeholder');
			//$(this).css({'margin-top':'28px'})
		}
		
		$(this).next('span.error').hide();
		$(this).removeClass('required');						
})
		
	
$(document).on('change', '.custom-file-input', function (e) {
    var fileName = e.target.files[0].name;
    $(this).parents('.custom-file').find('.custom-file-label').html(fileName);
    $(this).parents('.custom-file').find('.placelabel').addClass('showlabel');
})

// autoFlipActive();
function autoFlipActive(){
    var index = 0;
	var myVar = setInterval(myTimer, 3000);
	var boxSize = $(".ourTeam-flipBox, .learnProCard-flipBox").length;
	function myTimer() {
		$(".ourTeam-flipBox, .learnProCard-flipBox").removeClass("active");
		$(".ourTeam-flipBox, .learnProCard-flipBox").eq(index).addClass('active');

		index++;
		if(index == boxSize){
			index = 0;
		}
	}
}

// Flip  Click in mobile();
flipMobileClick()
function flipMobileClick(){
    var winW = $(window).width();
    if(winW <= 768){
        $(document).on('click', '.flip-box', function () {
            $(this).toggleClass('resets');
        })
       
    }
}


$('#home_our_business').slick({
    rows: 2,
    slidesToShow: 3,
    slidesToScroll: 3,
    initialSlide: 0,
    infinite: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 4500,
    speed: 1000,
    dots: true,
    // prevArrow: false,
    // nextArrow: false,

    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToScroll: 2,
            slidesToShow: 2,
        }
        },{
            breakpoint: 800,
            settings: {
                rows: 1,
                slidesToScroll: 2,
                slidesToShow: 2,
            }
        },{
            breakpoint: 576,
            settings: {
                rows: 20,
                slidesToScroll: 1,
                slidesToShow: 1,
            }
        }]            
   }); 

$('#home_hero, .banner_right_silider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    initialSlide: 0,
    infinite: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 4500,
    speed: 10000,
    dots: true,
    fade: true,
    prevArrow: false,
    nextArrow: false
    //  prevArrow: $('.arrowleft'),
    //  nextArrow: $('.arrowright')
})


$('.trustedBy').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    infinite: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 4500,
    speed: 1000,
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
            slidesToShow: 1,
            }
        }]
})


$('.awards').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 6000,
    speed: 1000,
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
})


$('.speakers_slider').slick({
    slidesToShow: 2,
    slidesToScroll: 2,
    infinite: true,
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 6000,
    speed: 1000,
    responsive: [{
        breakpoint: 650,
        settings: {
            slidesToShow: 1,
        }
        }]
})


$('.client_slider').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    infinite: true,
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 6000,
    speed: 1000,
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            }
        },{
            breakpoint: 640,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            }
        }]
})


$('.case_slider').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    infinite: true,
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 6000,
    speed: 1000,
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            }
        },{
            breakpoint: 640,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            }
        }]
})

$('.africa_LS').slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 6000,
    speed: 1000,
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            }
        },{
            breakpoint: 640,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            }
        }]
})

$('.dialogue_slider, .impacting_lives').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    infinite: false,
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 6000,
    speed: 1000,
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            }
        },{
            breakpoint: 640,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            }
        }]
})


    
})