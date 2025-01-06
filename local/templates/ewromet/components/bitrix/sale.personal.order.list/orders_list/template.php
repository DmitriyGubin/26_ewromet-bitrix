<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

//debug($arResult['ORDERS']);

/** @var CBitrixPersonalOrderListComponent $component */
/** @var array $arParams */
/** @var array $arResult */

$user_obj = new CUser;
$user_id = $user_obj -> GetID();
$phone = Return_All_Users(Array('ID' => $user_id), Array())['PERSONAL_PHONE'];  
//Get_Order_Adress

//id_товаров
$all_id = [];
foreach ($arResult['ORDERS'] as $ord_item)
{
	foreach ($ord_item['BASKET_ITEMS'] as $prod_item)
	{
		$all_id[] = $prod_item['PRODUCT_ID'];
	}
}
//debug($all_id);
$all_prods = Return_All_Fields_Props(
	Array("IBLOCK_ID"=>18, "ACTIVE"=>"Y", "ID"=>$all_id),
	Array()
);

//debug($all_prods);

function Return_Mark($id,$all_prods)
{
	foreach ($all_prods as $prod_item) 
	{
		if($prod_item['fields']['ID'] == $id)
		{
			return $prod_item['props']['BREND']['VALUE'];
		}
	}
}

$count_orders = count($arResult['ORDERS']);

?>

<section class="my_orders wrap top_box univ_table">

	<div class="orders_section">
		<div class="title_line">
			<div class="title_count">
				<h1 class="cab_title">Мои заказы</h1>
				<div class="count"><?= $count_orders; ?></div>
			</div>

			<!-- <div class="filter_box">
				<div class="remark">Фильтр заказов</div>

				<div class="tab_item active" id="in_way">В пути</div>
				<div class="tab_item" id="completed">Завершенные</div>
				<div class="tab_item" id="canceled">Отмененные</div>
			</div> -->
		</div>

		<?php foreach ($arResult['ORDERS'] as $ord_item): ?>
		<?php
			$price = 0;
			$quantity = 0; 
			foreach ($ord_item['BASKET_ITEMS'] as $prod_item)//считаем суммарную цену
			{
				$price = $price + $prod_item['PRICE']*$prod_item['QUANTITY'];
				$quantity = $quantity + $prod_item['QUANTITY'];
			}
			$id_plus = $ord_item['ORDER']['ID'].'_1';
			$id_minus = $ord_item['ORDER']['ID'].'_2';
		?>

		<div class="orders_item univ_shadow">

			<div class="title_box">

				<div class="plus_title">

					<div class="plus_min_box">
						<svg class="plus count_butt" width="39" height="35" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M-1.44248e-06 34L28.3519 34C29.9573 34 31.4072 33.0401 32.0342 31.5622L37.3372 19.0622C37.7608 18.0638 37.7608 16.9362 37.3372 15.9378L32.0342 3.4378C31.4072 1.95986 29.9573 1 28.3519 1L0 0.999998" stroke="url(#<?= $id_plus;; ?>)"/>
								<path class="line" d="M18 9.5H20V25.5H18V9.5Z" fill="#121419"/>
								<path class="line" d="M11 18.5L11 16.5L27 16.5V18.5L11 18.5Z" fill="#121419"/>
								<defs>
									<linearGradient id="<?= $id_plus; ?>" x1="38" y1="17" x2="3" y2="17" gradientUnits="userSpaceOnUse">
										<stop class="grad" stop-color="#D0D8E9"/>
										<stop offset="1" stop-color="white"/>
									</linearGradient>
								</defs>
						</svg>

						<svg class="minus hide count_butt" width="39" height="35" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M39 1L10.6481 1C9.04267 1 7.59279 1.95986 6.96578 3.4378L1.66275 15.9378C1.23919 16.9362 1.23919 18.0638 1.66275 19.0622L6.96578 31.5622C7.59278 33.0401 9.04267 34 10.6481 34L39 34" stroke="url(#<?= $id_minus; ?>)"/>
								<path class="line" d="M15 18.5L15 16.5L31 16.5V18.5L15 18.5Z" fill="#121419"/>
								<defs>
									<linearGradient id="<?= $id_minus; ?>" x1="1" y1="18" x2="36" y2="18" gradientUnits="userSpaceOnUse">
										<stop class="grad" stop-color="#D0D8E9"/>
										<stop offset="1" stop-color="white"/>
									</linearGradient>
								</defs>
						</svg>

					</div>

					<div class="status_box">
						<div class="order_name">Заказ №<?= $ord_item['ORDER']['ID']; ?></div>
						<div class="status">
							<!-- Заказ отправлен – ожидаемая дата доставки 12.06.2024 -->
							Заказ оформлен <?= $ord_item['ORDER']['DATE_INSERT_FORMATED']; ?>
						</div>
					</div>
				</div>

				<div class="price_box">
					<!-- <div class="company">ООО «Строительные материалы»_1</div> -->
					<div class="order_price">
						<?= number_format($price, 0, '.', ' ').' ₽'; ?>
					</div>
				</div>
			</div>

			<div class="hide_box" style="display: none;">
				<div class="delimeter"></div>

				<div class="table_box head">

					<div class="left_col hide_for_mob"></div>

					<div class="right_col">
						<div class="flex_box">
							<div class="contact_box">

								<div class="show_for_mob hide mob_title"></div>

								<div class="phone_addr"></div>

								<?php if($phone != ''): ?>
								<a class="phone_box" href="tel:<?= $phone; ?>">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M20 15.5C18.75 15.5 17.55 15.3 16.43 14.93C16.2542 14.874 16.0664 14.8667 15.8868 14.909C15.7072 14.9513 15.5424 15.0415 15.41 15.17L13.21 17.37C10.3739 15.9272 8.06711 13.6239 6.62 10.79L8.82 8.58C9.1 8.31 9.18 7.92 9.07 7.57C8.69065 6.41806 8.49821 5.2128 8.5 4C8.5 3.45 8.05 3 7.5 3H4C3.45 3 3 3.45 3 4C3 13.39 10.61 21 20 21C20.55 21 21 20.55 21 20V16.5C21 15.95 20.55 15.5 20 15.5Z" fill="#121419"/>
										<path d="M12 3V13L15 10H21V3H12Z" fill="#80899B"/>
									</svg>

									<div class="phone_addr"><?= $phone; ?></div>
								</a>
								<?php endif; ?>
							</div>

							<div class="rule_box">
								<!-- <a href="#" class="rule_item">Распечатать чек</a> -->
								<a class="rule_item" href="<?=htmlspecialcharsbx($ord_item["ORDER"]["URL_TO_COPY"])?>">Повторить заказ</a>
							</div>
						</div>
					</div>  
				</div>

				<div class="table_box two">

					<div class="left_col">Состав заказа</div>

					<div class="mobile_delimeter hide"></div>

					<div class="right_col prods">

						<div class="prods_table">

							<div class="table_head">
								<div class="one_col">
									<div class="table_title">Наименование</div>
								</div>

								<div class="two_col">
									<div class="table_title">Код</div>
								</div>

								<div class="three_col">
									<div class="table_title">Марка стали</div>
								</div>

								<div class="four_col">
									<div class="table_title">Цена</div>
								</div>

								<div class="five_col">
									<div class="table_title count_title">Количество</div>
								</div>
							</div>

							<?php foreach ($ord_item['BASKET_ITEMS'] as $prod_item): ?>
							<div class="table_item hover_item">
								<div class="prod_box">
									<div class="one_col name">
										<?= $prod_item['NAME']; ?>
									</div>

									<div class="two_col">
										<div class="cod_item mark_class">
											<svg class="mark_class" width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path class="mark_class" d="M19 5V3C19 1.89543 18.1046 1 17 1H15M19 11V13C19 14.1046 18.1046 15 17 15H15M1 5V3C1 1.89543 1.89543 1 3 1H5M1 11V13C1 14.1046 1.89543 15 3 15H5" stroke="#838FA2" stroke-linecap="round"/>
												<rect class="mark_class" x="5" y="4" width="1" height="8" rx="0.5" fill="#838FA2"/>
												<rect class="mark_class" x="8" y="4" width="1" height="8" rx="0.5" fill="#838FA2"/>
												<rect class="mark_class" x="11" y="4" width="1" height="8" rx="0.5" fill="#838FA2"/>
												<rect class="mark_class" x="14" y="4" width="1" height="8" rx="0.5" fill="#838FA2"/>
											</svg>

											<div class="cod_box univ_shadow hide mark_class">
												<div class="cod_text mark_class">
													<span class="cod_text mark_class">Код товара:</span>
													<span class="prod_cod mark_class"></span>
												</div>

												<svg class="copy_icon mark_class" width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path class="mark_class" d="M12.5263 0H1.78947C0.805263 0 0 0.818182 0 1.81818V14.5455H1.78947V1.81818H12.5263V0ZM15.2105 3.63636H5.36842C4.38421 3.63636 3.57895 4.45455 3.57895 5.45455V18.1818C3.57895 19.1818 4.38421 20 5.36842 20H15.2105C16.1947 20 17 19.1818 17 18.1818V5.45455C17 4.45455 16.1947 3.63636 15.2105 3.63636ZM15.2105 18.1818H5.36842V5.45455H15.2105V18.1818Z" fill="black"/>
												</svg>
											</div>

										</div>
									</div>

									<div class="three_col mark">
										<span>
											<?= Return_Mark($prod_item['PRODUCT_ID'],$all_prods); ?>
										</span>
										<svg class="mark_img hide" width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M13.5758 0L0 4.82192V7.0137C1.48176 6.86323 2.75758 7.23288 2.9697 8.10959V9.86301L0 11.1781V13.589L8.48485 16L21 10.0822V8.10959L8.48485 13.8082C6.97058 13.739 6.40415 13.4189 5.93939 12.274L18.0303 7.0137V5.26027L9.12121 8.9863V7.0137L21 2.19178L13.5758 0Z" fill="#2F2FA1"/>
										</svg>
									</div>

									<div class="four_col price">
										<?= number_format($prod_item['PRICE'], 0, '.', ' ').' ₽'; ?>
									</div>

									<div class="five_col rule">
										<div class="count_prod"><?= $prod_item['QUANTITY']; ?></div>
									</div>
								</div>
								<div class="mobile_delimeter hide"></div>
							</div>
							<?php endforeach; ?>

							<div class="result">
								<div class="one_col">Итого</div>
								<div class="plus_col"><!-- Вес заказа: 7.98 кг --></div>
								<div class="four_col price">
									<?= number_format($price, 0, '.', ' ').' ₽'; ?>
								</div>
								<div class="five_col rule">
									<div class="count_prod"><?= $quantity; ?></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
		
	</div>

	<?
	//echo $arResult["NAV_STRING"];
	?>
</section>

