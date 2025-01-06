<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>

<section class="basket wrap univ_table">
	<div class="empty_basket">
		<h2 class="cab_title">Корзина пуста</h2>
		<div class="empty_list">
			<div class="box">
				<img class="emty_img" src="<?= SITE_TEMPLATE_PATH; ?>/img/empty_basket.svg">
				<div class="empty_sub">Вы еще ничего не заказывали</div>
				<a class="go_back" href="/catalog/">Смотерть каталог</a>
			</div>
		</div>
	</div>
</section>