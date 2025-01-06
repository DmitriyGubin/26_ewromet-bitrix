var big_slider_sel = '.gallery .big_slider';
var small_slider_sel = '.gallery .small_slider';

$(big_slider_sel).slick({
	dots: false,
	infinite: false,
	slidesToScroll: 1,
	slidesToShow: 1,
	centerMode: true,
	centerPadding: '500px',
	adaptiveHeight: true,
	responsive: [
	{
		breakpoint: 1400,
		settings: {
			centerPadding: '300px',
		}
	},
	{
		breakpoint: 1100,
		settings: {
			centerPadding: '200px',
		}
	},
	{
		breakpoint: 1000,
		settings: {
			centerPadding: '20px',
		}
	}
	],
	asNavFor: small_slider_sel,
	prevArrow: '<div class="prev-photo"><svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M33 7H1M1 7L7 1M1 7L7 13" stroke="white" stroke-width="1.4"/></svg></div>',
	nextArrow: '<div class="next-photo"><svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="white" stroke-width="1.4"/></svg></div>'
});

$(small_slider_sel).slick({
	dots: false,
	infinite: false,
	slidesToScroll: 1,
	variableWidth: true,
	centerMode: true,
	arrows: false,
	asNavFor: big_slider_sel,
	focusOnSelect: true
});

/******************************/

if(screen.width < 750)
{
	$('.gallery .tab_buts_box').slick({
		dots: false,
		infinite: false,
		slidesToScroll: 1,
		slidesToShow: 1,
		arrows: false,
		variableWidth: true
	});
}

