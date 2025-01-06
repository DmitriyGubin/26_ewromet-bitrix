<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(__DIR__).'/top_template.php');

if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
{
?>
	<div data-role="basket-item-list" class="bass_prods">

		<div id="<?=$cartId?>products">
			<?foreach ($arResult["CATEGORIES"] as $category => $items):
				if (empty($items))
					continue;
				?>
				<?foreach ($items as $v):?>
				<div class="prod_item">
					<div class="prod_wrap">

						<div class="prod_name">
							<?=$v["NAME"]?>
						</div>

						<div class="prod_price"><?=$v["SUM"]?></div>

						<svg onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>); Close_Basket_Cabiner_Search(); Check_Reload_Basket(); BX.onCustomEvent('OnBasketChange');" class="delete_prod" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 1L13.2635 13.2635" stroke="#808DA5" stroke-width="1.4" stroke-linecap="round"/>
							<path d="M1 13.2637L13.2635 1.00022" stroke="#808DA5" stroke-width="1.4" stroke-linecap="round"/>
						</svg>
					</div>
				</div>
				<?endforeach?>
			<?endforeach?>
		</div>
	</div>

	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?

require(realpath(__DIR__).'/bottom_template.php');
}