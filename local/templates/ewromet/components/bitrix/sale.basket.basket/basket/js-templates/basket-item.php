<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

//debug($arResult['BASKET_ITEM_RENDER_DATA']);

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>

<script id="basket-item-template" type="text/html">
	<div data-mesure="{{MEASURE_TEXT}}" class="table_item hover_item basket-items-list-item-container{{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}}"
		id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
		{{#SHOW_RESTORE}}
			
				<div id="basket-item-height-aligner-{{ID}}">
					<!-- Восстановить товар -->
					<div class="delete_box">
						<div class="name_box">
							<span>Товар</span> {{NAME}} <span>был удален из корзины</span>
						</div>

						<div class="delete_rule">
							<a onclick="Plus_Product(); Set_All_Weight_After_Ajax();" class="restore" href="javascript:void(0)" data-entity="basket-item-restore-button">
								Восстановить
							</a>
							<!-- <div class="restore">Восстановить</div> -->

							<svg data-entity="basket-item-close-restore-button" class="delite_finish" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 1L13.2635 13.2635" stroke="#808DA5" stroke-width="1.4" stroke-linecap="round"></path>
								<path d="M1 13.2634L13.2635 0.999976" stroke="#808DA5" stroke-width="1.4" stroke-linecap="round"></path>
							</svg>
						</div>
					</div>
				</div>
			
		{{/SHOW_RESTORE}}
		{{^SHOW_RESTORE}}
			
				<div class="prod_box" id="basket-item-height-aligner-{{ID}}">

					<div class="one_col name" style="transition: all 0.3s ease;">
						{{NAME}}
					</div>
						
					<!-- Свойства -->

					<div class="two_col">
						<div class="cod_item mark_class" onclick="Show_Cod_Box($(this));">
							<svg class="mark_class" width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M19 5V3C19 1.89543 18.1046 1 17 1H15M19 11V13C19 14.1046 18.1046 15 17 15H15M1 5V3C1 1.89543 1.89543 1 3 1H5M1 11V13C1 14.1046 1.89543 15 3 15H5" stroke="#838FA2" stroke-linecap="round"/>
								<rect x="5" y="4" width="1" height="8" rx="0.5" fill="#838FA2"/>
								<rect x="8" y="4" width="1" height="8" rx="0.5" fill="#838FA2"/>
								<rect x="11" y="4" width="1" height="8" rx="0.5" fill="#838FA2"/>
								<rect x="14" y="4" width="1" height="8" rx="0.5" fill="#838FA2"/>
							</svg>

							<div class="cod_box univ_shadow hide mark_class">
								<div class="cod_text mark_class">
									<span class="mark_class">Код товара:</span>
									<span class="prod_cod"></span>
								</div>

								<svg class="copy_icon mark_class" width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12.5263 0H1.78947C0.805263 0 0 0.818182 0 1.81818V14.5455H1.78947V1.81818H12.5263V0ZM15.2105 3.63636H5.36842C4.38421 3.63636 3.57895 4.45455 3.57895 5.45455V18.1818C3.57895 19.1818 4.38421 20 5.36842 20H15.2105C16.1947 20 17 19.1818 17 18.1818V5.45455C17 4.45455 16.1947 3.63636 15.2105 3.63636ZM15.2105 18.1818H5.36842V5.45455H15.2105V18.1818Z" fill="black"/>
								</svg>
							</div>

						</div>
					</div>

					<div class="three_col mark">
						<span>{{COLUMN_LIST.0.VALUE}}</span>
						<img class="show_mobile mark_img" src="/catalog/img/mark.svg">
					</div>

					<!-- Цена -->		
					<div class="four_col price" id="basket-item-sum-price-{{ID}}">
						{{{SUM_PRICE_FORMATED}}}
					</div>
						
					<div class="five_col rule" data-entity="basket-item-quantity-block">
						<!-- Количество -->
						<svg data-mesure="{{MEASURE_TEXT}}" onclick="Set_All_Weight_After_Ajax();" data-entity="basket-item-quantity-minus" class="minus count_butt" width="35" height="39" viewBox="0 0 35 39" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M34 0V28.3519C34 29.9573 33.0401 31.4072 31.5622 32.0342L19.0622 37.3372C18.0638 37.7608 16.9362 37.7608 15.9378 37.3372L3.4378 32.0342C1.95986 31.4072 1 29.9573 1 28.3519V0" stroke="url(#{{ID}}min)"/>
							<path class="line" d="M9.5 20L9.5 18L25.5 18V20L9.5 20Z" fill="#121419"/>
							<defs>
								<linearGradient id="{{ID}}min" x1="17" y1="38" x2="17" y2="3" gradientUnits="userSpaceOnUse">
									<stop stop-color="#D0D8E9"/>
									<stop class="grad" offset="1" stop-color="white"/>
								</linearGradient>
							</defs>
						</svg>

						<input onblur="Set_All_Weight_After_Ajax();" data-weight="{{COLUMN_LIST.1.VALUE}}" data-mesure="{{MEASURE_TEXT}}" class="count_prod" type="text" value="{{QUANTITY}}"
							{{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
							data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
							id="basket-item-quantity-{{ID}}">

						<svg data-mesure="{{MEASURE_TEXT}}" onclick="Set_All_Weight_After_Ajax();" data-entity="basket-item-quantity-plus" class="plus count_butt" width="35" height="39" viewBox="0 0 35 39" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path class="line" d="M16.5 12H18.5V28H16.5V12Z" fill="#121419"/>
							<path class="line" d="M9.5 21L9.5 19L25.5 19V21L9.5 21Z" fill="#121419"/>
							<path d="M34 39V10.6481C34 9.04267 33.0401 7.59279 31.5622 6.96578L19.0622 1.66275C18.0638 1.23919 16.9362 1.23919 15.9378 1.66275L3.4378 6.96578C1.95986 7.59278 1 9.04267 1 10.6481V39" stroke="url(#{{ID}}plus)"/>
							<defs>
								<linearGradient id="{{ID}}plus" x1="17" y1="1" x2="17" y2="36" gradientUnits="userSpaceOnUse">
									<stop class="grad" stop-color="#D0D8E9"/>
									<stop offset="1" stop-color="white"/>
								</linearGradient>
							</defs>
						</svg>

						<!-- Удалить запись -->
						<svg onclick="Minus_Product(); Set_All_Weight_After_Ajax();" data-entity="basket-item-delete" class="delete_item" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 1L13.2635 13.2635" stroke="#808DA5" stroke-width="1.4" stroke-linecap="round"/>
							<path d="M1 13.2635L13.2635 1.00001" stroke="#808DA5" stroke-width="1.4" stroke-linecap="round"/>
						</svg>
					</div>
				
		{{/SHOW_RESTORE}}
	</div>
</script>