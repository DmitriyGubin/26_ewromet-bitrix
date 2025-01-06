<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (empty($arResult["CATEGORIES"]) || !$arResult['CATEGORIES_ITEMS_EXISTS'])
	return;
	//debug($arResult['ELEMENTS']);  
//$arResult['SEARCH']

	//debug($arResult['SEARCH']); -- подчеркн $arItem['PREVIEW_TEXT']

	//debug($arResult); 

	// function Make_Cursive_Name($idd)
	// {
	// 	foreach ($arResult['SEARCH'] as $arItemm) 
	// 	{
	// 		if($arItemm['ITEM_ID'] == $idd)
	// 		{
	// 			return $arItemm['ITEM_ID'];
	// 		}
	// 	}
	// }
?>

<style type="text/css">
	
	/*.title-search-result
	{
		display: block !important;
	}*/

</style>

<div class="search_result">
	<div class="title_items">
		<div class="title_search">
			Результаты поиска – <span><?= count($arResult['ELEMENTS']); ?> наименований</span>
		</div>

		<div class="search_items">
		<!-- no_prod -->
		<?php foreach ($arResult['ELEMENTS'] as $arItem): ?>
		<?php $id = $arItem['ID']; ?>
			<div class="search_item <?= (count($arItem['PRICES']) == 0) ? 'no_prod' : null; ?>">
				<div class="serch_wrap">

					<div class="prod_name">
						<?= $arItem['PREVIEW_TEXT']; ?>
					</div>

					<div class="prod_price">
						<?= $arItem['PRICES']['BASE']['PRINT_VALUE_VAT']; ?>
					</div>

					<svg onclick="Add_To_Basket(<?= $id; ?>); Close_Basket_Cabiner_Search(); $(this).addClass('active');" class="serch_basket <?= in_array($id, $GLOBALS['ids_bask_prods']) ? 'active' : null; ?>" width="45" height="22" viewBox="0 0 45 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M29.5 17.3333C28.3083 17.3333 27.3442 18.3083 27.3442 19.5C27.3442 20.6917 28.3083 21.6667 29.5 21.6667C30.6917 21.6667 31.6667 20.6917 31.6667 19.5C31.6667 18.3083 30.6917 17.3333 29.5 17.3333ZM23 0V2.16667H25.1667L29.0667 10.3892L27.6042 13.0433C27.4308 13.3467 27.3333 13.7042 27.3333 14.0833C27.3333 15.275 28.3083 16.25 29.5 16.25H42.5V14.0833H29.955C29.8033 14.0833 29.6842 13.9642 29.6842 13.8125L29.7167 13.6825L30.6917 11.9167H38.7625C39.575 11.9167 40.29 11.4725 40.6583 10.8008L44.5367 3.77C44.626 3.60467 44.671 3.41898 44.6672 3.23107C44.6633 3.04317 44.6108 2.85947 44.5148 2.69792C44.4187 2.53638 44.2824 2.40251 44.1192 2.30939C43.9559 2.21628 43.7713 2.1671 43.5833 2.16667H27.5608L26.5425 0H23ZM40.3333 17.3333C39.1417 17.3333 38.1775 18.3083 38.1775 19.5C38.1775 20.6917 39.1417 21.6667 40.3333 21.6667C41.525 21.6667 42.5 20.6917 42.5 19.5C42.5 18.3083 41.525 17.3333 40.3333 17.3333Z" fill="#121419"/>
						<path class="bask_arrow" d="M0 11H21M21 11L15 5M21 11L15 17" stroke="#121419" stroke-width="1.4"/>
					</svg>

					<div class="no_prod_mark hide">
						Нет в наличии
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>

	<div class="no_serch_items hide">
		<div class="loopa_title">
			<img src="<?= SITE_TEMPLATE_PATH ?>/img/search_big_loopa.svg">
			<div class="no_text">
				К сожалению ничего не найдено
			</div>
		</div>

		<div class="make_order">
			<div class="order_text">Поможем выяснить, что вы ищете и подберем нужное!</div>

			<a class="order_button" href="#">
				<div>Оставить заявку</div>
				<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
				</svg>
			</a>
		</div>
	</div>  
</div>

<script type="text/javascript">
	$('.title-search-result .search_items').niceScroll();
</script>
