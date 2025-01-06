<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

//debug($arResult['BASKET_ITEMS']);

//debug($arResult['JS_DATA']['TOTAL'])

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

/**считаем полный вес**/
$all_weight = 0;
foreach ($arResult['BASKET_ITEMS'] as $item) 
{
	if($item['MEASURE_NAME'] == 'кг')
	{
		$all_weight += $item['QUANTITY'];
	}
}

?>

<section class="buy_no_cab wrap">
	<h1 class="cab_title">Оформление заказа</h1>

	<div class="left_box_order">

		<div class="left_order_box">

			<div class="check_box">
				<div class="text_box">
					<div class="top_line">
						Мы заметили, что у вас нет личного кабинета
					</div>

					<div class="bott_text">
						Можете зарегестрироваться и создать профиль компании или продолжить оформление заказа
					</div>
				</div>

				<div class="butt_line">
					<button id="go_to_cabinet">Войти</button>
					<button id="register_cabinet">Зарегестрироваться</button>
				</div>
			</div>

			<form id="buy_form_no_cab"> 
				<div class="form_title">Персональные данные</div>

				<div class="form_line">
					<div class="line_title">Компания</div>

					<div class="inp_box inp">
						<div class="univ_form_box three">
							<input name="company_name" placeholder="Название компании, если есть" type="text" class="univ_inp">
							<img class="univ_icon" src="img/inp_house.svg">
						</div>
					</div>
				</div>

				<div class="form_line">
					<div class="line_title">Данные профиля</div>

					<div class="inp_box inp">
						<div class="univ_form_box one">
							<input placeholder="Имя" type="text" class="univ_inp required" name="pers_name">
							<img class="univ_icon" src="img/inp_name.svg">
						</div>

						<div class="univ_form_box one">
							<input placeholder="Фамилия" type="text" class="univ_inp required" name="pers_sername">
							<img class="univ_icon" src="img/inp_name.svg">
						</div>

						<div class="univ_form_box one">
							<input placeholder="Отчество" type="text" class="univ_inp required" name="perse_patronymic">
							<img class="univ_icon" src="img/inp_name.svg">
						</div>
					</div>
				</div>

				<div class="form_line">
					<div class="line_title hide_mobile">Почта</div>

					<div class="line_title show_mobile">Почта и телефон</div>

					<div class="inp_box inp">
						<div class="univ_form_box two">
							<input placeholder="Электронная почта" type="text" class="univ_inp required mail" name="mail">
							<img class="univ_icon" src="img/inp_mail.svg">
						</div>
					</div>
				</div>

				<div class="form_line">
					<div class="line_title hide_mobile">Телефон</div>

					<div class="inp_box inp">
						<div class="univ_form_box one">
							<input placeholder="Телефон" type="text" class="univ_inp phone required" name="phone">
							<img class="univ_icon" src="img/inp_phone.svg">
						</div>
					</div>
				</div>

				<div class="form_title two_line">Параметры доставки</div>

				<div class="form_line">
					<div class="line_title">Индекс и город</div>

					<div class="inp_box">
						<div class="univ_form_box little">
							<input placeholder="Индекс" type="number" class="univ_inp no_img required" name="index">
						</div>

						<div class="univ_form_box half">
							<input placeholder="Город" type="text" class="univ_inp no_img required" name="city">
						</div>
					</div>
				</div>

				<div class="form_line">
					<div class="line_title">Улица и дом</div>

					<div class="inp_box">
						<div class="univ_form_box two">
							<input placeholder="Название улицы" type="text" class="univ_inp no_img required" name="street">
						</div>

						<div class="univ_form_box little_two">
							<input placeholder="Дом" type="text" class="univ_inp no_img required" name="house">
						</div>

						<div class="univ_form_box little_two">
							<input placeholder="Офис" type="text" class="univ_inp no_img required" name="apartment">
						</div>
					</div>
				</div>

				<div class="form_line">
					<div class="line_title">Комментарий</div>

					<div class="inp_box inp">
						<div class="univ_form_box two">
							<input placeholder="Например вход со двора или как пройти к офису" type="text" class="univ_inp no_img" name="path_comment">
						</div>
					</div>
				</div>

				<div class="form_line textarea_line">
					<div class="line_title">Комментарий</div>

					<div class="inp_box inp">
						<div class="univ_form_box three textarea_box">

							<textarea name="order_comment" type="text" class="univ_inp textarea" placeholder="Комментарий или пожелание к заказу ..."></textarea>

							<img class="univ_icon" src="img/inp_mess.svg">
						</div>
					</div>
				</div>

				<div class="form_line textarea_line marginn">
					<div class="line_title check_boxx">Способ оплаты</div>

					<div class="inp_box inp">
						<div>
							<div class="radio_box active">
								<div class="round"></div>
								<div class="radio_title">Картой</div>
							</div>

							<div class="radio_box">
								<div class="round"></div>
								<div class="radio_title">Наличными</div>
							</div>

							<div class="radio_box">
								<div class="round"></div>
								<div class="radio_title">Банковским переоводом</div>
							</div>

							<input type="hidden" id="type_of_pay" value="Картой" name="type_of_pay">
							<input type="hidden" value="Оформление заказа без кабинета" name="type_of_form">

							<?php foreach ($arResult['BASKET_ITEMS'] as $prod): ?>
							<?php 
$value = '<br>'.$prod['NAME'].' - '.$prod['QUANTITY'].' '.$prod['MEASURE_NAME'].' x '. $prod['PRICE_FORMATED'];
							//$value = str_replace('a', '!', $value);
							?>
							<input type="hidden" name="products[]" value="<?= $value; ?>">

							<?php endforeach; ?>

							<div class="remark">
								Оплата будет происходить только после формирования заказа, когда наши сотрудники свяжутся с вами
							</div>
						</div>
					</div>
				</div>

			</form>

		</div>

		<?php 
		$price = $arResult['JS_DATA']['TOTAL']['ORDER_PRICE_FORMATED'];
		?>

		<div class="order_boxx univ_shadow">
			<div class="line">
				<div class="wheigt col left">Ваш заказ</div>
				<div class="clear col right">Очистить</div>
			</div>

			<div class="delimeter"></div>

			<div class="line prop">
				<div class="no_wheigt col left">Позиций</div>
				<div class="wheigt col right">
					<?= $arResult['JS_DATA']['TOTAL']['BASKET_POSITIONS']; ?>
				</div>
			</div>

			<div class="line prop">
				<div class="no_wheigt col left">Цена</div>
				<div class="wheigt col right"><?= $price; ?></div>
			</div>

			<!-- <div class="line prop">
				<div class="no_wheigt col left">НДС</div>
				<div class="wheigt col right">0 ₽</div>
			</div> -->

			<!-- <div class="line prop">
				<div class="no_wheigt col left">Скидка</div>
				<div class="wheigt col red right">0 ₽</div>
			</div> -->

			<!-- <div class="delimeter"></div> -->

			<div class="tab_box hide">
				<div class="tab_quest">
					<div class="no_wheigt blue">
						<div class="blue">Есть код на скидку?</div>
						<div class="cod hide">Введите код</div>
					</div>

					<svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 5.5L5.5 1L10 5.5" stroke="#121419" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

				<form class="inp_butt" style="display: none;">
					<input placeholder="X000000000" class="cod_inp" type="text" name="cod">
					<button id="cod_butt">
						<svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 6L7 12L18 1" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
						</svg>
					</button>
				</form>

				<div class="promo_box hide">
					<div class="line prop">
						<div class="no_wheigt col left">Промокод</div>

						<div class="col right disc_delete">
							<div class="wheigt red discount">– 10 250 ₽</div>
							<svg class="delete_discount" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 1L13.2635 13.2635" stroke="#808DA5" stroke-width="1.4" stroke-linecap="round"/>
								<path d="M1 13.2634L13.2635 0.999976" stroke="#808DA5" stroke-width="1.4" stroke-linecap="round"/>
							</svg>
						</div>
					</div>
				</div>

			</div>

			<div class="delimeter"></div>

			<div class="line prop">
				<div class="total_price wheigt col left">Итоговая цена</div>
				<div class="wheigt col right"><?= $price; ?></div>
			</div>

			<div class="weight_order hide">Вес заказа: <?= $all_weight; ?> кг</div>

			<button id="send_order">
				<div>Отправить заказ</div>
				<svg width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 7H23M23 7L17 1M23 7L17 13" stroke="#51607E" stroke-width="1.2"/>
				</svg>
			</button>
		</div>

	</div>
	

</section>