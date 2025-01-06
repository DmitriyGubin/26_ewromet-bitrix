// $('.tablebodytext').addClass('hide');

$('.banner_slider').slick({
	dots: true,
	infinite: true,
	slidesToScroll: 1,
	slidesToShow: 1,
	arrows: false,
	// adaptiveHeight: true,
	fade: true
});

if(screen.width < 750)
{
	$('.metal_serv .serv_box').slick({
		dots: false,
		infinite: true,
		slidesToScroll: 1,
		slidesToShow: 1,
		arrows: false,
		adaptiveHeight: true,
		variableWidth: true
	});
}

$('.top_banner .order_button').on('click', Scroll_To_Form);
$('.metal .order_button').on('click', Scroll_To_Form);
$('.metal_serv .order_button').on('click', Scroll_To_Form);

$('.metal .metal_item').each(function(){
	
	var $hide_box = $(this).find('.ref_box');
	var $arrow = $(this).find('.arrow');

	$(this).find('.more_items').on('click', function(){

		$hide_box.slideToggle('slow');
		$arrow.toggleClass('active')

	});
});

$('.about .more_text').on('click', function(){

	$(this)[0].remove();
	$('.about .hide_text').slideToggle('slow');

});