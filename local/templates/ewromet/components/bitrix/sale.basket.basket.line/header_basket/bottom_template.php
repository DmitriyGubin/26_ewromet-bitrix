<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
?>

<div class="rules_box">
	<div onclick="Clear_Small_Basket();" id="clear_small_bask" class="cleare_butt">Очистить</div>
	<a href="/basket/" class="bask_ref">В корзину</a>
	<div id="total_price_small_bask" class="total_price">
		<?= $arResult['TOTAL_PRICE']; ?>
	</div>
</div>

