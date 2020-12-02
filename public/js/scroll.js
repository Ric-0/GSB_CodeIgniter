function checkScroll(){
    var startY = $('.navbar').height() * 0.2;

    if($(window).scrollTop() > startY){
        $('.navbar').addClass("scrolled");
    }else{
        $('.navbar').removeClass("scrolled");
    }
}

if($('.navbar').length > 0){
    $(window).on("scroll load resize", function(){
        checkScroll();
    });
}

$(document).ready(function() {
		$('.js-scrollTo').on('click', function() { // Au clic sur un élément
			var page = $(this).attr('href'); // Page cible
			var speed = 1000; // Durée de l'animation (en ms)
			$('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
			return false;
		});
	});

AOS.init({
  duration: 1200,
})


jQuery(document).ready(function($){
var $timeline_block = $('.cd-timeline-block');

//hide timeline blocks which are outside the viewport
$timeline_block.each(function(){
if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
}
});

//on scolling, show/animate timeline blocks when enter the viewport
$(window).on('scroll', function(){
$timeline_block.each(function(){
if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
$(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
}
});
});
});
