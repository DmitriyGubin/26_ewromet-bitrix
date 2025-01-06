$(".univ_inp.phone.required").mask("+7(999) 999-9999");

/***переключатель способы оплаты*****/

$all_items = $('.buy_no_cab .radio_box');
$type_inp = $('#type_of_pay');
$all_items.on('click', function() {

	$all_items.removeClass('active');
	$(this).addClass('active');
	let variant = $(this).find('.radio_title').html();
	$type_inp.val(variant);

});

/***переключатель способы оплаты*****/

// $('#send_order').on('click', () => Send_Form($('#buy_form_no_cab'), event));

$('#send_order').on('click', function(){
	var address = $('input[name="index"]').val() + ', ' 
	+ $('input[name="city"]').val() + ', '
	+ $('input[name="street"]').val() + ' '
	+ $('input[name="house"]').val() + ', офис '
	+ $('input[name="apartment"]').val();
	$('#soa-property-7').val(address);
	Send_Form($('#buy_form_no_cab'), event);
});

var this_url = window.location.href;
if(this_url.includes('/?ORDER_ID='))
{
	document.location.href = '/basket/';
}

$('.left_box_order .tab_quest').on('click', function(){

	$('.left_box_order .inp_butt').slideToggle(300);

});

// очистка корзины
Clear_Basket('.clear.col.right');

/************************/

$cab_butt = $('#person_cabinet_butt');
$('#go_to_cabinet').on('click', function(){
	$cab_butt.click();
});

$('#register_cabinet').on('click', function(){
	$cab_butt.click();
	Swich_Сabinet_Forms('header #registr_form');
});


$('#soa-property-3').val('999');
$('#soa-property-7').val('тест_адрес');

$('#soa-property-1').val('фио_тест');

$('#soa-property-2').val('test@mail.ru');

// $('#ID_DELIVERY_ID_3').click();
// $('#ID_DELIVERY_ID_2').click();






