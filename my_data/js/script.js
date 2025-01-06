
// $('.univ_toggle').on('click', function() {
	
// 	$(this).toggleClass('active');
// 	$('header .go_out').toggleClass('hide');

// 	if($(this).hasClass('active'))
// 	{
// 		$('.toggle_inp').val('1');
// 	}
// 	else
// 	{
// 		$('.toggle_inp').val('');
// 	}

// });



/**********пароль**********/
$(".phone_inp").mask("+7(999) 999-9999");

$('.univ_form_box.passw').each(function(){

	var eye = $(this).find('.inp_visible');
	var no_eye = $(this).find('.inp_no_visible');
	var inp = $(this).find('input');

	$(this).find('.eye_box').on('click', function() {

		eye.toggleClass('hide');
		no_eye.toggleClass('hide');
		inp.toggleClass('no_visible');

		if(inp.hasClass('no_visible'))
		{
			inp[0].type = 'password';
		}
		else
		{
			inp[0].type = 'text';
		}

	});

});



/**********пароль**********/


/***сохранение изменений****/

$('.my_data #save_my_data').on('click', function(event){

	event.preventDefault();
	var formData = new FormData($('#my_data_form')[0]);
	let err = Validate($('.my_data #my_data_form'));
	let res = Interpreta_Validate(err,$('#my_data_form .error_mess'));

	if(res)
	{
		$.ajax({
			type: "POST",
			url: '/ajax/common.php',
			contentType: false,
			processData: false,
			data: formData,
			dataType: "json",
			success: function(data){
				if (data.status == true)
				{
					var $save_text = $('#save_my_data div');
					$save_text.html('Данные сохранены').css('color', 'red');
					setTimeout(function() {
						$save_text.html('Сохранить изменения').css('color', 'black');
					}, 2000);
				}
				else
				{
					$('.my_data .error_mess').removeClass('hide').html('Не верно указали старый пароль');
					$('#my_data_form #old_pass').addClass('error');
				}
			}
		});
	}
});

/***сохранение изменений****/
