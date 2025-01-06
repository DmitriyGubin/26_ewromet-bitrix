function Validate($form_ref)
{
	var err= [0,0]; //1-количество ошибок, 2 - код ошибки (-1==email, ... )
	var pattern_mail = /\S+@\S+\.\S+/;//для валидации почты регулярка
	var pattern_passw = /(?=^.{6,}$)(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[^A-Za-z0-9]).*/;//для пароля

	$form_ref.find('.required').each(function() {

		$this = $(this);
		var inp_val = $this.val();

		var bool;
		if($this.hasClass('phone'))
		{
			bool = (inp_val.length != 16);
		}
		else if($this.hasClass('phone_no_req'))//необязательный телефон
		{
			if(inp_val == '')
			{
				bool = false;
			}
			else
			{
				bool = (inp_val.length != 16);
				if(bool)
				{
					err[1] = 5;//код ошибки телефон
				}
			}
		}
		else if($this.hasClass('old_pass'))//старый пароль
		{
			if($form_ref.find('.new_passw').val() == '')
			{
				bool = false;
			}
			else
			{
				bool = (inp_val == '');
				if(bool)
				{
					err[1] = 6;//код ошибки старый пароль
				}
			}
		}
		else if($this.hasClass('login'))
		{
			bool = (inp_val.length < 3);
			if(bool && inp_val != '')
			{
				err[1] = 1;//код ошибки логин
			}
		}
		else if($this.hasClass('password'))
		{
			bool = !pattern_passw.test(inp_val);
			if(bool && inp_val != '')
			{
				err[1] = 2;//код ошибки пароль
			}
		}
		else if($this.hasClass('new_passw'))//необязательный пароль
		{
			if(inp_val == '')
			{
				bool = false;
			}
			else
			{
				bool = !pattern_passw.test(inp_val);
				if(bool)
				{
					err[1] = 2;//код ошибки пароль
				}
			}
		}
		else if($this.hasClass('confirm_passw_my_data'))
		{
			bool = (inp_val != $form_ref.find('.new_passw').val());
			if(bool && inp_val != '')
			{
				err[1] = 3;//код ошибки подтверждение пароля
			}
		}
		else if($this.hasClass('confirm_passw'))
		{
			bool = (inp_val != $form_ref.find('.password').val());
			if(bool && inp_val != '')
			{
				err[1] = 3;//код ошибки подтверждение пароля
			}
		}
		else if($this.hasClass('mail'))//необязательная почта
		{
			if(inp_val == '')
			{
				bool = false;
			}
			else
			{
				bool = !pattern_mail.test(inp_val);
			}
		}
		else if($this.hasClass('req_mail'))//обязательная почта
		{
			bool = !pattern_mail.test(inp_val);
			if(bool && inp_val != '')
			{
				err[1] = 4;//код ошибки почта
			}
		}
		else if($this.hasClass('file'))
		{
			bool = ($this[0].files.length == 0);
			$this = $('#resume_popup .grid_item.resum_butt');
		}
		else
		{
			bool = (inp_val == '');
		}

        if (bool)
        {
            err[0]++;
            $this.addClass("error");
        } 
        else 
        {
            $this.removeClass("error");
        }
	});

    return err;
}

function Open_Error_Box($err_ref, text)
{
	$err_ref.removeClass('hide');
	$err_ref.html(text);
}

function Interpreta_Validate(err_mass,$err_ref)
{
	if(err_mass[1] == 1)
	{
		Open_Error_Box($err_ref, 'Логин должен быть минимум 3 символа.');
		return false;
	}
	else if(err_mass[1] == 2)
	{
		let text = 'Пароль должен состоять минимум из 6 символов,'+ 
							'содержать цифру,'+ 
							'содержать заглавную и строчную буквы английского алфавита,'+
							'содержать cимвол, не являющийся буквенно-цифровым.';

		Open_Error_Box($err_ref, text);
		return false;
	}
	else if(err_mass[1] == 3)
	{
		Open_Error_Box($err_ref, 'Подтверждённый пароль не совпадает с введенным.');
		return false;
	}
	else if(err_mass[1] == 4)
	{
		Open_Error_Box($err_ref, 'Почта введена не корректно.');
		return false;
	}
	else if(err_mass[1] == 5)
	{
		Open_Error_Box($err_ref, 'Заполните телефон правильно.');
		return false;
	}
	else if(err_mass[1] == 6)
	{
		Open_Error_Box($err_ref, 'Заполните старый пароль.');
		return false;
	}
	else if(err_mass[0] > 0)
	{
		Open_Error_Box($err_ref, 'Заполните все поля.');
		return false;
	}
	else if(err_mass[0] == 0 && err_mass[1] == 0)
	{
		$err_ref.addClass('hide');
		return true;
	}
}


function Send_Form($form_ref, event)
{
	event.preventDefault();
	var err = Validate($form_ref);
	var formData = new FormData($form_ref[0]);
	var id_form = $form_ref.attr('id');

	var boll_galka = true;

	if(id_form == 'resume_form')
	{
		boll_galka = $('#resume_form .my-checkbox').hasClass('active');
	}

	//if(true)
	if(err[0] == 0 && boll_galka)
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
					$form_ref[0].reset();
					if(id_form == 'buy_form_no_cab')
					{
window.location.href='/order_make/add/';

						$('.pull-right.btn.btn-default.btn-lg.hidden-xs')[0].click();







					}
					if(id_form == 'footer_consult_form')
					{
						$('#footer_consult_form').addClass("hide");
						$('.consult_box .success').removeClass("hide");
					}
					if(id_form == 'resume_form')
					{
						// $.fancybox.close();
						$('#resume_popup .form_only').addClass("hide");
						$('#resume_popup .success').removeClass("hide");
						$('#resume_popup .resume_title').html('Прикрепить резюме');
					}
					if(id_form == 'call_order_form')
					{
						$('.call_order .form_box').addClass("hide");
						$('.call_order .success').removeClass("hide");
					}

					if(id_form == 'help_formm')
					{
						$('.help_form #help_formm').addClass("hide");
						$('.help_form .success').removeClass("hide");
					}
					if(id_form == 'reviews_form')
					{
						//Add_New_Review(data);
						$('.order_button.write_rew')[0].click();
					}
					
	 			}
			}
		});
	}
}

function Add_New_Review(data)
{
	var rew_start =  `

	<div class="rew_item">
	<div class="ava_rating">
	<div class="ava_box bord_rad">
	<img class="ava_img obj-fit bord_rad" 
	src="/local/templates/ewromet/img/no_photo.png">
	</div>
	<div class="star_box">
	`;

	var rew_star = '';
	var clas = '';

	for (let i = 1; i <= 5; i++) 
	{
		if(i <= data.fields.rating)
		{
			clas = '';
		}
		else
		{
			clas = 'no_active';
		}

		rew_star +=  `
		<img class="star ${clas}" src="/local/templates/ewromet/img/star.svg">
		`;
	}

	var rew_finish =  `
	</div>
	</div>

	<div class="rating_text">
	<div class="ath_name">${data.fields.name}</div>
	<div class="text_box">
	${data.fields.review}
	</div>

	<div class="position bott_text">		
	</div>

	<div class="company bott_text">
	${data.fields.company}	
	</div>
	</div> 
	</div>
	`;

	var rew = rew_start + rew_star + rew_finish;

	var wrapper= document.createElement('div');
	wrapper.innerHTML=rew;
	var container = document.querySelector('.reviews .rew_box');
	container.insertBefore(wrapper, container.firstElementChild);
}


function Clear_Basket(butt_selector)
{
	$(butt_selector).on('click', function(){

		$.ajax({
			type: "POST",
			url: '/ajax/common.php',
			data: {
				'type_of_form': 'Очистка корзины'
			},
			dataType: "json",
			success: function(data){

				if (data.status == true)
				{
					document.location.href = '/basket/';
				}
			}
		});

	});
}

function Clear_Small_Basket()
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'type_of_form': 'Очистка корзины'
		},
		dataType: "json",
		success: function(data){

			if (data.status == true)
			{
				BX.onCustomEvent('OnBasketChange');
				Close_Basket_Cabiner_Search();
				Check_Reload_Basket();
			}
		}
	});
}

function Add_To_Basket(id)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'type_of_form': 'Добавление в корзину',
			'id': id
		},
		dataType: "json",
		success: function(data){

			if (data.status == true)
			{
				console.log('add_to_basket');
				BX.onCustomEvent('OnBasketChange');//важно обновляет корзину малую
				Check_Reload_Basket();
			}
		}
	});
}

function Check_Reload_Basket()
{
	var this_url = window.location.href;
	if(this_url.includes('/basket/') || this_url.includes('/order_make/') || this_url.includes('/catalog/'))
	{
		location.reload();
	}
}

function Show_Hide_Something(hide_box_ref, button_ref)
{
	button_ref.on('click', function() {
		hide_box_ref.toggleClass('hide');
		Click_Out_Something(hide_box_ref, 'hide', 'mark_class');
	});
}

function Click_Out_Something(hide_box_ref, hide_class, mark_class)
{
	if(!hide_box_ref.hasClass(hide_class))
	{
		document.onclick = function (e) {
			let all_classes = e.target.className;
			if (!all_classes.includes(mark_class))
			{
				hide_box_ref.addClass(hide_class);
			}
		};
	}
}

function Show_Cod_Box(thiss)
{
	var hide_box = thiss.find('.cod_box');
	hide_box.toggleClass('hide');
	Click_Out_Something(hide_box, 'hide', 'mark_class');
}

function Scroll_To_Form()
{
	$('.consult_box')[0].scrollIntoView({
		behavior: 'smooth',
		block: 'start'
	});

	var butt = $('.consult_box .order_button');

	if(!butt.hasClass('hide'))
	{
		butt[0].click();
	}
}


$(this).find('.more_items').on('click', function(){

		$hide_box.slideToggle('slow');
		$arrow.toggleClass('active');

	});


function Slide_Toggle($button, $hide_box, $arrow)
{
	$button.on('click', function(){ 
		$hide_box.slideToggle(600);
		$arrow.toggleClass('active');
	});
}

function Sort_News()
{
	$('.news .sort_icon').toggleClass('active');

	$icon = $('.news .sort_icon');
	$asc = $('.sort_butt .prop_asc');
	$desc = $('.sort_butt .prop_desc');

	if($icon.hasClass('active'))
	{
		$asc[0].click();
	}
	else
	{
		$desc[0].click();
	}
}



