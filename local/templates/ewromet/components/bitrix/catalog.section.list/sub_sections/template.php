<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component  IBLOCK_SECTION_ID*/
$this->setFrameMode(true);

$sec_id = $arResult['SECTION']['ID'];
$pic_id = $arResult['SECTION']['PICTURE'];

$GLOBALS['hide_products'] = (($arResult['SECTION']['DEPTH_LEVEL'] == 1) and (count($arResult['SECTIONS']) != 0));

//debug($arResult['SECTIONS']);

?>

<div class="title_line">
	<div class="title_box">
		<h1 class="sect_title">
			<?=  
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
				? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
				: $arResult['SECTION']['NAME']
			?>
		</h1>

		<div class="count_prod"><?= $arResult['SECTION']['ELEMENT_CNT']; ?></div>
	</div>


	<div class="hide_box <?= count($arResult['SECTIONS']) == 0 ? 'hide' : null; ?>">
		<div class="descr">Спрятать разделы</div>
		<div class="descr hide">Показать разделы</div>
		<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M18 2H10L8 0H2C0.89 0 0.00999999 0.89 0.00999999 2L0 14C0 15.11 0.89 16 2 16H18C19.11 16 20 15.11 20 14V4C20 2.89 19.11 2 18 2ZM17 10H14H12H9V8H13H17V10Z" fill="black"/>
		</svg>
	</div>
</div>

<div class="hide mobile_rules">
	<button class="mob_butt univ_shadow <?= $GLOBALS['hide_products'] ? 'hide' : null; ?>" id="mob_filters">
		<div class="mob_title">Фильтры</div>
	</button>

	<button class="mob_butt univ_shadow <?= count($arResult['SECTIONS']) == 0 ? 'hide' : null; ?>" id="mob_sects">
		<div class="mob_title">Показать разделы</div>
		<svg class="mob_icon" width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M18 2H10L8 0H2C0.89 0 0.00999999 0.89 0.00999999 2L0 14C0 15.11 0.89 16 2 16H18C19.11 16 20 15.11 20 14V4C20 2.89 19.11 2 18 2ZM17 10H14V13H12V10H9V8H12V5H14V8H17V10Z" fill="black"/>
		</svg>

		<div class="mob_title hide">Спрятать разделы</div>
		
		<svg class="mob_icon hide" width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M18 2H10L8 0H2C0.89 0 0.00999999 0.89 0.00999999 2L0 14C0 15.11 0.89 16 2 16H18C19.11 16 20 15.11 20 14V4C20 2.89 19.11 2 18 2ZM17 10H14H12H9V8H13H17V10Z" fill="white"/>
		</svg>
	</button>
</div>

<div class="sub_cat_box">
	<div class="var_box_anoth grid">
	<?php foreach ($arResult['SECTIONS'] as $arItem): ?>
	<?php if(($arItem['IBLOCK_SECTION_ID'] == $sec_id) and ($arItem['ELEMENT_CNT'] != 0)): ?>
		<a href="<?= $arItem['SECTION_PAGE_URL']; ?>" class="var_anoth_item">
			<?php
				$pict_path = $arItem['PICTURE']['SRC'];
				if($pict_path != '')
				{
					$path = $pict_path;
				}
				else if($pic_id != '')
				{
					$path = CFile::GetPath($pic_id);
				}
				else
				{
					$path = SITE_TEMPLATE_PATH.'/img/no_photo.png';
				}
			?>
			<img class="anoth_img" src="<?= $path; ?>">
			<h2 class="anoth_name">
				<?= $arItem['NAME']; ?>
			</h2>
			<div class="anoth_count"><?= $arItem['ELEMENT_CNT']; ?></div>
		</a>
	<?php endif; ?>
	<?php endforeach; ?>
	</div>
</div>