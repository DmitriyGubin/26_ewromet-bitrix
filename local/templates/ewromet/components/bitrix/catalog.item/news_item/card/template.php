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

//debug($GLOBALS['news_secs']);

$id_sec = $item['IBLOCK_SECTION_ID'];

foreach ($GLOBALS['news_secs'] as $sec_item) 
{
	if($sec_item['ID'] == $id_sec)
	{
		$sec_code = $sec_item['CODE'];
		break;
	}
}

$url = '/company/news/'.$sec_code.'/'.$item['CODE'].'/';

?>

<a href="<?= $url; ?>" class="news_item">
	<h2 class="news_title"><?= $item['NAME']; ?></h2>
	<div class="news_text">
		<?= $item['~PREVIEW_TEXT']; ?>
	</div>
</a>