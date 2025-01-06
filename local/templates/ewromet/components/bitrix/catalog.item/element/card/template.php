<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */


	//debug($item);


//$id_sec = $item['IBLOCK_SECTION_ID']; DIAMETR
//debug($id_sec);

//debug($item['DISPLAY_PROPERTIES']);

//debug($GLOBALS['ids_bask_prods']);

$boll = false;
$id = $item['ID'];

foreach ($GLOBALS['ids_bask_prods'] as $key => $value) 
{
	if($value == $id)
	{
		$boll = true;
		break;
	}
}


?>


	<div class="item_boxx hover_item <?= $actualItem['CAN_BUY'] ? null : null; ?>">

		<div style="display: none;">
		<? if ($itemHasDetailUrl): ?>
			<a class="product-item-image-wrapper" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>"
				data-entity="image-wrapper">
				<? else: ?>
					<span class="product-item-image-wrapper" data-entity="image-wrapper">
					<? endif; ?>
					<span class="product-item-image-slider-slide-container slide" id="<?=$itemIds['PICT_SLIDER']?>"
						<?=($showSlider ? '' : 'style="display: none;"')?>
						data-slider-interval="<?=$arParams['SLIDER_INTERVAL']?>" data-slider-wrap="true">
						<?
						if ($showSlider)
						{
							foreach ($morePhoto as $key => $photo)
							{
								?>
								<span class="product-item-image-slide item <?=($key == 0 ? 'active' : '')?>"
									style="background-image: url('<?=$photo['SRC']?>');">
								</span>
								<?
							}
						}
						?>
					</span>
					<span class="product-item-image-original" id="<?=$itemIds['PICT']?>"
						style="background-image: url('<?=$item['PREVIEW_PICTURE']['SRC']?>'); <?=($showSlider ? 'display: none;' : '')?>">
					</span>
					<?
					if ($item['SECOND_PICT'])
					{
						$bgImage = !empty($item['PREVIEW_PICTURE_SECOND']) ? $item['PREVIEW_PICTURE_SECOND']['SRC'] : $item['PREVIEW_PICTURE']['SRC'];
						?>
						<span class="product-item-image-alternative" id="<?=$itemIds['SECOND_PICT']?>"
							style="background-image: url('<?=$bgImage?>'); <?=($showSlider ? 'display: none;' : '')?>">
						</span>
						<?
					}

					if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
					{
						?>
						<div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DSC_PERC']?>"
							<?=($price['PERCENT'] > 0 ? '' : 'style="display: none;"')?>>
							<span><?=-$price['PERCENT']?>%</span>
						</div>
						<?
					}

					if ($item['LABEL'])
					{
						?>
						<div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>">
							<?
							if (!empty($item['LABEL_ARRAY_VALUE']))
							{
								foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value)
								{
									?>
									<div<?=(!isset($item['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
									<span title="<?=$value?>"><?=$value?></span>
								</div>
								<?
							}
						}
						?>
					</div>
					<?
				}
				?>
				<div class="product-item-image-slider-control-container" id="<?=$itemIds['PICT_SLIDER']?>_indicator"
					<?=($showSlider ? '' : 'style="display: none;"')?>>
					<?
					if ($showSlider)
					{
						foreach ($morePhoto as $key => $photo)
						{
							?>
							<div class="product-item-image-slider-control<?=($key == 0 ? ' active' : '')?>" data-go-to="<?=$key?>"></div>
							<?
						}
					}
					?>
				</div>
				<?
				if ($arParams['SLIDER_PROGRESS'] === 'Y')
				{
					?>
					<div class="product-item-image-slider-progress-bar-container">
						<div class="product-item-image-slider-progress-bar" id="<?=$itemIds['PICT_SLIDER']?>_progress_bar" style="width: 0;"></div>
					</div>
					<?
				}
				?>
				<? if ($itemHasDetailUrl): ?>
				</a>
				<? else: ?>
				</span>
			<? endif; ?>
		</div>

		<?php $prop_cod = $GLOBALS['KEY_PROP']; ?>

		<div class="col prod_name <?= ($prop_cod == '') ? 'no_prop_col' : 'one_col'; ?>">
			<?= $item['NAME']; ?>
		</div>

		<div class="add_col col character <?= ($prop_cod == '') ? 'hide' : null; ?>">
			<span class="show_mobile mob_titlee"><?= $GLOBALS['KEY_TITLE'].': '; ?></span>
			<span>&#160;</span>
			<?= $item['PROPERTIES'][$prop_cod]['VALUE']; ?>
		</div>

		<div class="two_col col">
			<div class="mark">
				<img class="mark_img" src="/catalog/img/mark.svg">
				<div class="mark_name"><?= $item['PROPERTIES']['BREND']['VALUE']; ?></div>
			</div>
		</div>

		<div class="three_col price col">
			<div class="no_prod_remark <?= $actualItem['CAN_BUY'] ? 'hide' : null; ?>">Нет в наличии</div>

			<div data-entity="price-block">
				<?
				if ($arParams['SHOW_OLD_PRICE'] === 'Y')
				{
					?>
					<span class="product-item-price-old main_price" id="<?=$itemIds['PRICE_OLD']?>"
						<?=($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '')?>>
						<?=$price['PRINT_RATIO_BASE_PRICE']?>
					</span>&nbsp;
					<?
				}
				?>
				<span class="main_price" id="<?=$itemIds['PRICE']?>">
					<?
					if (!empty($price))
					{
						if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
						{
							echo Loc::getMessage(
								'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
								array(
									'#PRICE#' => $price['PRINT_RATIO_PRICE'],
									'#VALUE#' => $measureRatio,
									'#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
								)
							);
						}
						else
						{
							echo $price['PRINT_RATIO_PRICE'];
						}
					}
					?>
				</span>
			</div>
		</div>

		<div class="four_col col">

			<div class="count_boxx">
			<!-- кол-во -->
			<?
			if (!$haveOffers)
			{
				if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY'])
				{

					$id_svg_minus = $itemIds['QUANTITY_DOWN'].'_0';
					$id_svg_plus = $itemIds['QUANTITY_UP'].'_0';
					?>
					<div class="product-item-hidden count_boxx" data-entity="quantity-block">
						
						<svg id="<?=$itemIds['QUANTITY_DOWN']?>" class="minus count_butt" width="35" height="39" viewBox="0 0 35 39" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M34 0V28.3519C34 29.9573 33.0401 31.4072 31.5622 32.0342L19.0622 37.3372C18.0638 37.7608 16.9362 37.7608 15.9378 37.3372L3.4378 32.0342C1.95986 31.4072 1 29.9573 1 28.3519V0" stroke="url(#<?= $id_svg_minus; ?>)"></path>
							<path class="line" d="M9.5 20L9.5 18L25.5 18V20L9.5 20Z" fill="#121419"></path>
							<defs>
								<linearGradient id="<?= $id_svg_minus; ?>" x1="17" y1="38" x2="17" y2="3" gradientUnits="userSpaceOnUse">
									<stop class="grad" stop-color="#D0D8E9"></stop>
									<stop offset="1" stop-color="white"></stop>
								</linearGradient>
							</defs>
						</svg>

						<input class="product-item-amount-field count_num" id="<?=$itemIds['QUANTITY']?>" type="number"
						name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
						value="<?=$measureRatio?>">

						<svg id="<?=$itemIds['QUANTITY_UP']?>" class="plus count_butt" width="35" height="39" viewBox="0 0 35 39" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M34 39V10.6481C34 9.04267 33.0401 7.59279 31.5622 6.96578L19.0622 1.66275C18.0638 1.23919 16.9362 1.23919 15.9378 1.66275L3.4378 6.96578C1.95986 7.59278 1 9.04267 1 10.6481V39" stroke="url(#<?= $id_svg_plus; ?>)"></path>
							<path class="line" d="M16.5 12H18.5V28H16.5V12Z" fill="#121419"></path>
							<path class="line" d="M9.5 21L9.5 19L25.5 19V21L9.5 21Z" fill="#121419"></path>
							<defs>
								<linearGradient id="<?= $id_svg_plus; ?>" x1="17" y1="1" x2="17" y2="36" gradientUnits="userSpaceOnUse">
									<stop class="grad" stop-color="#D0D8E9"></stop>
									<stop offset="1" stop-color="white"></stop>
								</linearGradient>
							</defs>
						</svg>
						<span class="hide product-item-amount-description-container">
							<span id="<?=$itemIds['QUANTITY_MEASURE']?>">
								<?=$actualItem['ITEM_MEASURE']['TITLE']?>
							</span>
							<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
						</span>
						
					</div>
					<?
				}
			}
			elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
			{
				if ($arParams['USE_PRODUCT_QUANTITY'])
				{
					?>
					<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
						<div class="product-item-amount">
							<div class="product-item-amount-field-container">
								<span class="product-item-amount-field-btn-minus no-select" id="<?=$itemIds['QUANTITY_DOWN']?>"></span>
								<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="number"
								name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
								value="<?=$measureRatio?>">
								<span class="product-item-amount-field-btn-plus no-select" id="<?=$itemIds['QUANTITY_UP']?>"></span>
								<span class="hide product-item-amount-description-container">
									<span id="<?=$itemIds['QUANTITY_MEASURE']?>"><?=$actualItem['ITEM_MEASURE']['TITLE']?></span>
									<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
								</span>
							</div>
						</div>
					</div>
					<?
				}
			}
			?>

			<!-- корзина -->
			<? if ($actualItem['CAN_BUY'])
			{
				?>
				<div class="" id="<?=$itemIds['BASKET_ACTIONS']?>">
					<a class="" id="<?=$itemIds['BUY_LINK']?>"
						href="javascript:void(0)" rel="nofollow">
						<svg onclick="$(this).addClass('active');" class="item_basket <?= $boll ? 'active' : null; ?>" width="50" height="26" viewBox="0 0 50 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M31.583 19.5C30.3913 19.5 29.4272 20.475 29.4272 21.6667C29.4272 22.8584 30.3913 23.8334 31.583 23.8334C32.7747 23.8334 33.7497 22.8584 33.7497 21.6667C33.7497 20.475 32.7747 19.5 31.583 19.5ZM25.083 2.16669V4.33335H27.2497L31.1497 12.5559L29.6872 15.21C29.5138 15.5134 29.4163 15.8709 29.4163 16.25C29.4163 17.4417 30.3913 18.4167 31.583 18.4167H44.583V16.25H32.038C31.8863 16.25 31.7672 16.1309 31.7672 15.9792L31.7997 15.8492L32.7747 14.0834H40.8455C41.658 14.0834 42.373 13.6392 42.7413 12.9675L46.6197 5.93669C46.7091 5.77136 46.754 5.58567 46.7502 5.39776C46.7464 5.20985 46.6938 5.02615 46.5978 4.86461C46.5017 4.70306 46.3654 4.56919 46.2022 4.47608C46.0389 4.38296 45.8543 4.33379 45.6663 4.33335H29.6438L28.6255 2.16669H25.083ZM42.4163 19.5C41.2247 19.5 40.2605 20.475 40.2605 21.6667C40.2605 22.8584 41.2247 23.8334 42.4163 23.8334C43.608 23.8334 44.583 22.8584 44.583 21.6667C44.583 20.475 43.608 19.5 42.4163 19.5Z" fill="#121419"></path>
                            <path class="arrow" d="M0 12H20M20 12L14 6M20 12L14 18" stroke="#121419" stroke-width="1.4"></path>
                          </svg>
					</a>
				</div>
				<?
			}
			?>
			</div>
		</div>

	</div>