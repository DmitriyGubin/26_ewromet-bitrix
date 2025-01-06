
$('.vacancy .tab_item').each(function(){

	let butt = $(this).find('.count_butt');
	let hide_box = $(this).find('.descr');

	butt.on('click', function(){
		butt.toggleClass('hide');
		hide_box.slideToggle(500);
	});

});


$(".phone_inp").mask("+7(999) 999-9999");


/***********файл***********/
$resume_inp = $('#resume_input');

$('#resume_popup .grid_item.resum_butt').on('click', function () {
	$resume_inp[0].click();
});

$resume_inp.on('change', function(){

	let file_name = $(this)[0].files[0].name;

	$('#resume_popup .resume_title').html(file_name);

});

/***********файл***********/

$('#resume_popup .check_text').on('click', function(){
	$(this).find('.my-checkbox').toggleClass('active');
});

$('#close_resume_popup').on('click', function(){
	$.fancybox.close();
});

$('#big_message').on('input', function(){
	let len = $(this).val().length;
	$('#text_length').html(len);
});

/***отправка формы резюме********/

var $vacancy_inp = $('#type_of_vacancy');
var $title_pos = $('#resume_popup .title_pos');

$('.vacancy .tab_item').each(function(){

	var position = $(this).find('.position').html();

	$(this).find('.order_button').on('click', function(){
		$vacancy_inp.val(position);
		$title_pos.html(position);
	});

});

$('#resume_popup .order_button').on('click', () => Send_Form($('#resume_form'), event));

$('.vacancy .order_button').on('click', function(){

	$('#resume_popup .success').addClass("hide");
	$('#resume_popup .form_only').removeClass("hide");

});

/***отправка формы резюме********/
