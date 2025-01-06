<div class="wrap">
<section class=" help_form <?= $GLOBALS['hide_products'] ? 'hide' : null; ?>">
	<form id="help_formm" class="">
		<input type="hidden" name="type_of_form" value="Форма помощи">
		<img class="form_img" src="/catalog/img/pipes_form.png">

		<div class="right_box">
			<div class="form_title"><?= $form_title; ?></div>

			<div class="show_mobile mobile_text">
				Просто оставьте заявку на сайте, мы поможем с заказом!
			</div>

			<div class="grid form_grid">
				<div class="grid_item input">
					<input class="form_field required" placeholder="Ваше имя" type="text" name="name">
					<img class="field_img" src="/catalog/img/inp_name.svg">
				</div>

				<div class="grid_item input">
					<input class="form_field required phone" placeholder="Телефон" type="text" name="phone">
					<img class="field_img" src="/catalog/img/inp_phone.svg">
				</div>

				<div class="grid_item input mail">
					<input class="form_field required mail" placeholder="Электронная почта" type="text" name="mail">
					<img class="field_img" src="/catalog/img/inp_mail.svg">
				</div>

				<div class="grid_item textarea">
					<textarea name="comment" class="form_field" placeholder="Комментарий или пожелание к заказу ..."></textarea>
					<img class="field_img" src="/catalog/img/inp_comm.svg">
				</div>
			</div>

			<div class="order_line">
				<div class="order_text">
					Нажимая Отправить заявку мы руководствуемся <br>
					<a href="#">Политикой конфиденциальности</a> и бережно храним данные
				</div>

				<a class="order_button form" href="#">
					<div>Отправить заявку</div>
					<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
					</svg>
				</a>

				<div class="order_button mobile hide">
					<div>Отправить заявку</div>
					<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
					</svg>
				</div>
			</div>
		</div>
	</form>

	<div class="success hide">
		<img class="succ_img" src="/local/templates/ewromet/img/success_img.svg">
		<div class="succ_title">Заявка уже в пути!</div>
		<div class="succ_text">
			Спасибо, что выбрали компанию Евромет. Наши специалисты уже изучают ваши пожелания и ответят в рабочее время
		</div>
		<button class="one_more">Отправить еще</button>
	</div>
</section>
</div>

<script type="text/javascript">
	$(".form_field.phone").mask("+7(999) 999-9999");

	$('.help_form .order_button.form').on('click', () => Send_Form($('#help_formm'), event));

	$('.help_form .one_more').on('click', function(){
	    $('.help_form #help_formm').toggleClass("hide");
		$('.help_form .success').toggleClass("hide");
	});

	$('.order_button.mobile').on('click', Scroll_To_Form);
</script>