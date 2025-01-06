
/*********подменю**********/
if(screen.width > 1000)
{
	Desctop_Sub_Menu();
}


function Desctop_Sub_Menu()
{
	$('.sub_menu_point').on('mouseover', function(){

		$(this).find('.sub_menu_box').removeClass('hide');

	});


	$('.sub_menu_point').on('mouseout', function(){

		$(this).find('.sub_menu_box').addClass('hide');

	});
}
/*********подменю**********/

/*******скролл меню**********/
var $w = $(window);
var $header = $('header');
var $ind = $('#show_scroll_sub_menu');

if(screen.width > 1000)
{
	window.addEventListener('scroll', function(){
	
		if($w.scrollTop() == 0)
		{
			$header.removeClass('scroll');
			Close_Scroll_Sub_Menues();
		}
		else
		{
			$header.addClass("scroll");
		}
	});
}

/*******скролл меню**********/


/*******скролл подменю**********/
$('#show_scroll_sub_menu').on('click', function(){

	let elem = document.querySelector('header');
	let style = getComputedStyle(elem);
	let height = parseInt(style.height)/2 + 'px';
	let $ind = $('header .indicator');
	$ind[0].style.top = height;

	$('header .indicator').toggleClass('hide');
	$('#show_scroll_sub_menu').toggleClass('active');
	$('header .scroll_menu_box').fadeToggle(300);
	$('.menu_shade').fadeToggle(300);
	$('body').toggleClass('overflow_hidden');
});

$('.menu_shade').on('click', Close_Scroll_Sub_Menues);

function Close_Scroll_Sub_Menues()
{
	$('header .indicator').addClass('hide');
	$('#show_scroll_sub_menu').removeClass('active');
	$('header .scroll_cat_box').fadeOut(300);
	$('header .scroll_menu_box').fadeOut(300);
	$('.menu_shade').fadeOut(300);
	$('header .catalog_nav.show_scroll li').removeClass('active');
	$('header .catalog_nav.hide_scroll li').removeClass('active');
	$('body').removeClass('overflow_hidden');
}

/*******скролл подменю**********/

/*******скролл подменю каталог**********/
var $lis = $('header .catalog_nav.show_scroll li');

$lis.on('click', function(){
	Toggle_Header_Catalog_Sub_Menu($lis,$(this));
});

var $lis_no_scroll = $('header .catalog_nav.hide_scroll li');

$lis_no_scroll.on('click', function(){
	Toggle_Header_Catalog_Sub_Menu($lis_no_scroll,$(this));
});

var $mobile_sects = $('header .cat_item.sects');
$mobile_sects.on('click', function(){
	Toggle_Header_Catalog_Sub_Menu($mobile_sects,$(this));
});

function Toggle_Header_Catalog_Sub_Menu($lis, $this)
{
	$('body').addClass('overflow_hidden');
	$lis.removeClass('active');
	$this.addClass('active');
	
	$('header .scroll_cat_box').fadeIn(300);
	$('.menu_shade').fadeIn(300);

	let id = $this.attr('id');
	id =  id.replace(/_777/, '');
	id =  id.replace(/_888/, '');

	//console.log(id);

	var $sub = $('header .sub_cat_box');

	for(let item of $sub)
	{
		if(item.classList.contains(id))
		{
			$sub.addClass('hide');
			item.classList.remove('hide');
		}
	}
}
/*******скролл подменю каталог**********/

// $('header .toggle').on('click', function(){
// 	$(this).toggleClass('active');
// });

$('header .forms_box').niceScroll();

/**************логика личного кабинета**************/

$('header #person_cabinet_butt').on('click',() => Toggle_Cabinet_Basket('header #person_cabinet_butt', 'header .forms_box'));
// $('header #small_basket_button').on('click', Toggle_Small_Basket);

function Toggle_Small_Basket()
{
	if(screen.width < 1000)
	{
		document.location.href = '/basket/';
	}
	else
	{
		if(!$('#small_basket_icon_number').hasClass('hide'))
		{
			Toggle_Cabinet_Basket('header #small_basket_button', 'header .small_basket');
		}
	}
}

$('.cabinet_shade').on('click', Close_Basket_Cabiner_Search);

document.addEventListener('keydown', function(event){
	if(event.key == 'Escape')
	{
		Close_Basket_Cabiner_Search();
		$('.menu_shade')[0].click();
	}
});

function Close_Basket_Cabiner_Search()
{
	if($('header #person_cabinet_butt').hasClass('active'))
	{
		Toggle_Cabinet_Basket('header #person_cabinet_butt', 'header .forms_box');
		setTimeout(function(){
			Swich_Сabinet_Forms('header #come_in_form');
		}, 500);
	}

	if($('header #small_basket_button').hasClass('active'))
	{
		Toggle_Cabinet_Basket('header #small_basket_button', 'header .small_basket');
	}

	if($('header').hasClass('active_serch'))
	{
		Close_Search_Box();
	}

	if($('#title-search-input').hasClass('active'))
	{
		Toggle_Search_Title();
	}

	$('body').removeClass('overflow_hidden');
}

function Toggle_Cabinet_Basket(button_sel, box_sel)
{
	$('header').toggleClass('active_cabinet');
	$('body').toggleClass('overflow_hidden');
	$(button_sel).toggleClass('active');

	if($('header #small_basket_button').hasClass('active'))
	{
		$('header .bass_prods').niceScroll();
	}

	setTimeout(function() {
		$(box_sel).fadeToggle(300);
		$('.cabinet_shade').fadeToggle(300);
	}, 200);
}

/***переключение пунктов меню*******/
$('header .register_butt').on('click', () => Swich_Сabinet_Forms('header #registr_form'));

$('header .restore_passw').on('click', () => Swich_Сabinet_Forms('header #restore_passw'));

$('header .come_in_butt').on('click', () => Swich_Сabinet_Forms('header #come_in_form'));

function Swich_Сabinet_Forms(show_form_sel)
{
	$('header .cabinet_form').addClass('hide');
	$(show_form_sel).removeClass('hide');
}


/***регистрация********/

function Registration(event)
{
	event.preventDefault();
	let err = Validate($('header #registr_form'));
	//console.log(err);
	let res = Interpreta_Validate(err,$('#registr_form .error_mess'));
	if(res && $('header .toggle.register').hasClass('active'))
	{
		$('#create_new_person_hide').click();
		BX.addCustomEvent('onAjaxSuccess', function() 
		{
			if($('header p .errortext'))
			{
				if($('header p .errortext').html() == 'Неверно введено слово с картинки')
				{
					$('#registr_form .error_mess').removeClass('hide').html('Неверно введено слово с картинки');
					$('#registr_form .form_inp.captcha').addClass('error');
					$('#registr_form').removeClass('hide');
				}
				else
				{
					location.reload();
				}
			}
			else
			{
				location.reload();
			}
		});
	}
}

/***регистрация********/

/*********авторизация*********/
$('header #go_to_cabinet_butt').on('click', function(event){

	event.preventDefault();
	let err = Validate($('header #come_in_form'));
	let res = Interpreta_Validate(err,$('#come_in_form .error_mess'));

	if(res)
	{
		$.ajax({
			type: "POST",
			url: '/ajax/common.php',
			data: {
				'type_of_form': 'Проверка пользователя при авторизации',
				'login': $('#come_in_form #auth_login').val(),
				'password': $('#come_in_form #auth_password').val()
			},
			dataType: "json",
			success: function(data){

				if (data.status == true)
				{
					$('header #go_to_cabinet_butt_hide').click();
				}
				else
				{
					$('#come_in_form .error_mess').removeClass('hide').html('Не правильно ввели логин или пароль.');
					$('#come_in_form .form_inp').addClass('error');
				}
			}
		});
	}
});
/*********авторизация*********/

/***восстановление пароля**********/
$('header #restore_passw_butt').on('click', function(event){

	event.preventDefault();
	let err = Validate($('header #restore_passw'));
	let res = Interpreta_Validate(err,$('#restore_passw .error_mess'));

	if(res)
	{
		$.ajax({
			type: "POST",
			url: '/ajax/common.php',
			data: {
				'type_of_form': 'Восстановление пароля',
				'login_mail': $('#restore_login_mail').val()
			},
			dataType: "json",
			success: function(data){

				if (data.status == true)
				{
					$('#restore_passw .form_box').addClass('hide');
					$('#restore_passw .succes_box').removeClass('hide');
				}
				else
				{
					$('#restore_passw .error_mess').removeClass('hide').html('Не правильно ввели логин или пароль.');
					$('#restore_passw .form_inp').addClass('error');
				}
			}
		});
	}
});
/***восстановление пароля**********/


/***выход из личного кабинета********/
$('#go_out_cabinet').on('click', function(){

	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'type_of_form': 'Выход из личного кабинета',
		},
		dataType: "json",
		success: function(data){

			if (data.status == true)
			{
				window.location = window.location.href.split("?")[0];
			}
		}
	});
});

/***выход из личного кабинета********/

/**************логика личного кабинета**************/

/**********Поиск по сайту************/

var $header = $('header');
var $cabinet_shade = $('.cabinet_shade');
var $inp = $('header .search_inp_with_result');
var $search_result = $('.title-search-result');
var $clear_butt = $('header .clear_serch');

$clear_butt.on('click', function(){
	$inp.val('');
	//$search_result.fadeOut(300);
	$clear_butt.addClass('hide');
});

$inp.on('focus', () => Focus_Search_Input($(this)));

function Focus_Search_Input($input)
{
	if($input.hasClass('hide_inp'))
	{
		$header.addClass('active_serch');
	}
	else
	{
		$('body').addClass('overflow_hidden');
		setTimeout(function() {
			$cabinet_shade.fadeIn(300);
		}, 300);
		$cabinet_shade.css('z-index', 9999999);
		$header.addClass('active_cabinet');
		$inp.css('background', 'white');
		$header.addClass('active_serch');
	}
}

function Close_Search_Box()
{
	setTimeout(function() {
		$header.removeClass('active_cabinet');
	}, 300);
	$cabinet_shade.fadeOut(300);
	$cabinet_shade.css('z-index', 99999999);
	$inp.css('background', 'none');
	$header.removeClass('active_serch');
	//$search_result.fadeOut(300);
}

$inp.on('input', function(){

	var text = $(this).val();
	$header.addClass('active_serch');

	if(text.length != 0)
	{
	  //$search_result.fadeIn(300);
	  $clear_butt.removeClass('hide');
	}
	else
	{
	  //$search_result.fadeOut(300);
	  $clear_butt.addClass('hide');
	}
});

/**********Поиск по сайту************/

/***********Форма консультации***************/

var $forms_box = $('.consult_box .consult_form');
var $top_order_butt = $('.consult_box .top_line .order_button');
var $cross = $('.consult_box .close_cross');

$(".consult_box .form_field.phone").mask("+7(999) 999-9999");

$('.consult_box .rule_box').on('click', function(){

	$forms_box.slideToggle('slow');
	$top_order_butt.toggleClass('hide');
	$cross.toggleClass('hide');

});

$('.consult_box .consult_form .order_button').on('click', () => Send_Form($('#footer_consult_form'), event));

$('.consult_box .one_more').on('click', function(){
	
	$('#footer_consult_form').toggleClass("hide");
	$('.consult_box .success').toggleClass("hide");

})

/***********Форма консультации***************/

$('header .cabinet_butt').on('click', function(){

	$('.menu_shade')[0].click();

	setTimeout(function() {
		$('#person_cabinet_butt').click();
	}, 400);
});

$('header .phone_order_butt').on('click', function(){

	$('.menu_shade')[0].click();

	setTimeout(function() {
		Scroll_To_Form();
	}, 400);
});

$('header #call_order_mob_menu').on('click', function(){

	$('header .burger')[0].click();

	setTimeout(function() {
		Scroll_To_Form();
	}, 400);
});

$('header #go_to_cab_mob').on('click', function(){

	$('header .burger')[0].click();

	setTimeout(function() {
		$('header #person_cabinet_butt').click();
	}, 400);
});

$('footer .call_order').on('click', Scroll_To_Form);

$('.go_main_catalor_arrow').on('click', function(){

	$('.menu_shade')[0].click();

});

/********мобильное меню**********/

var $menu_box = $('header .top_menu');
var $body = $('body');

$('header .burger').on('click', function() {
	$(this).toggleClass("active");
	$menu_box.toggleClass("active");
	$body.toggleClass("overflow");
});


/********мобильное меню**********/

/***цепочка навигации и другие кнопки мобилы каталога***/

var nav_chain = $('.nav_chain');

$('.open_box.mobile').on('click', function(){

	nav_chain.addClass('active');
	$('.cabinet_shade').fadeToggle(300);
	$('body').addClass('overflow_hidden');

});

if(screen.width < 750)
{
	$('.cabinet_shade').on('click', function(){

		if(nav_chain.hasClass('active'))
		{
			$('.cabinet_shade').fadeToggle(300);
		}

		nav_chain.removeClass('active');

		$('body').removeClass('overflow_hidden');
	});
}



/***цепочка навигации и другие кнопки мобилы каталога***/

/******подменю мобилка***/
if(screen.width < 1000)
{
	$('header .menu_box .sub_menu_box').removeClass('hide');
	Slide_Toggle($('header .cat_item.serv'), $('.cat_item.serv .var_box'), $('.cat_item.serv .serv_arrow'));
	Slide_Toggle($('header .menu_box .link_arrow'), $('header .menu_box .sub_menu_box'), $('header .menu_box .arrow_menue'))
}
/******подменю мобилка***/

/***поиск мобилка***/

$mob_inp = $('#title-search-input');

$('#mobile_search_loopa').on('click', Toggle_Search_Title);

if(screen.width < 1000)
{
	$('.cabinet_shade').on('click', function(){

		if($mob_inp.hasClass('active'))
		{
			Toggle_Search_Title();
		}

	})
}

function Toggle_Search_Title()
{
	$('header #title-search').fadeToggle(300);
	$mob_inp.toggleClass('active');
	$('body').removeClass('overflow_hidden');

	if($mob_inp.hasClass('active'))
	{
		Focus_Search_Input($mob_inp);
	}
	else
	{
		$('.cabinet_shade')[0].click();
	}
}

/***поиск мобилка***/



