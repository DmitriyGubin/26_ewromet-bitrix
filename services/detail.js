
$('.serv_slider').slick({
	dots: true,
	infinite: true,
	slidesToScroll: 1,
	slidesToShow: 1,
	fade: true,
	// autoplay: true
});


/***********табы таблица с ценами**************/

$all_sects = $('.serv_price .var_item');
$tables = $('.serv_price .tables_wrap');

$all_sects.on('click', function(){
	Swich($all_sects,$(this));
	Tabs($tables,$(this));
});

function Tabs($hide_boxes,$this)
{
	var id = $this.attr('id');
	$hide_boxes.addClass('hide');

	$hide_boxes.each(function(){

		if($(this).hasClass(id))
		{
			$(this).removeClass('hide');
		}

	});
}

function Swich($all_sects,$this)
{
	$all_sects.removeClass('active');
	$this.addClass('active');
}

/***********табы таблица с ценами**************/


/*********табы вопрос - ответ******************/

$('.why_box .tab_item').each(function(){

  let butt = $(this).find('.count_butt');
  let hide_box = $(this).find('.tab_text');

  butt.on('click', function(){
    butt.toggleClass('hide');
    hide_box.slideToggle(300);
  });

});

/*********табы вопрос - ответ******************/

$('.serv_top .order_button.order').on('click', Scroll_To_Form);

	
if(screen.width < 750)
{
	$('.metal_serv .add_serv_box').slick({
		dots: false,
		infinite: false,
		slidesToScroll: 1,
		slidesToShow: 1,
		arrows: false,
		variableWidth: true
	});
}

if(screen.width < 1000)
{
	$('.serv_price .var_box').slick({
		dots: false,
		infinite: false,
		slidesToScroll: 1,
		slidesToShow: 1,
		arrows: false,
		variableWidth: true
	});
}

