<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<div data-entity="basket-checkout-aligner">
		<div class="line prop">
			<div class="no_wheigt col left">Цена</div>
			<div data-entity="basket-total-price" id="price_no_nds" class="wheigt col right">{{{PRICE_FORMATED}}}</div>
		</div>

		<!-- <div class="line prop">
			<div class="no_wheigt col left">НДС</div>
			<div class="wheigt col right">0 ₽</div>
		</div> -->

		<!-- <div class="line prop">
			<div class="no_wheigt col left">Скидка</div>
			<div class="wheigt col red right">0 ₽</div>
		</div> -->

		<div class="delimeter"></div>

		<div class="tab_box hide">
			<div class="tab_quest" onclick="$('.left_box_order .inp_butt').slideToggle(300);">
				<div class="no_wheigt blue">
					<div class="blue">Есть код на скидку?</div>
					<div class="cod hide">Введите код</div>
				</div>

				<svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 5.5L5.5 1L10 5.5" stroke="#121419" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>

			<div class="inp_butt" style="display: none;">
				<!-- Код на скидку -->
				<input data-entity="basket-coupon-input" placeholder="X000000000" class="cod_inp" type="text">

				<button id="cod_butt">
					<svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 6L7 12L18 1" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
					</svg>
				</button>
			</div>

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

		<div class="delimeter hide"></div>

		<div class="line prop">
			<div class="total_price wheigt col left">Итоговая цена</div>
			<div id="result_price" class="wheigt col right" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</div>
		</div>

		<button data-entity="basket-checkout-button" class="hide hide_order_butt">Оформить заказ</button>
	</div>
</script>