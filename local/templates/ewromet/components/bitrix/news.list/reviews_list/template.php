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
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//debug($arResult['ITEMS']);
$conter = 0;

$page = $APPLICATION->GetCurPage();

?>

<div class="rew_box grid">
<?php foreach ($arResult['ITEMS'] as $arItem): ?>
<?php 
	$name = $arItem['NAME'];

	if($page != '/company/reviews/')
	{
		$conter++;
		if($conter > 4) break;
	}

	$path = $arItem['PREVIEW_PICTURE']['SRC'];
	if($path == '')
	{
		$path = SITE_TEMPLATE_PATH.'/img/no_photo.png';
	}
?>
	<div class="rew_item">
		<div class="ava_rating">
			<div class="ava_box bord_rad">
				<img alt="<?= $name; ?>" class="ava_img obj-fit bord_rad" src="<?= $path; ?>">
			</div>
			<div class="star_box">
			<?php $rating = $arItem['PROPERTIES']['RATING']['VALUE']; ?>
			<?php for ($i=1; $i <= 5; $i++): ?>
				<img class="star <?= ($i > $rating) ? 'no_active' : null; ?>" src="<?= SITE_TEMPLATE_PATH ?>/img/star.svg">
			<?php endfor; ?>
			</div>
		</div>

		<?php 

			$position = $arItem['PROPERTIES']['POSITION']['VALUE'];
			$company = $arItem['PROPERTIES']['COMPANY']['VALUE'];

		?>

		<div class="rating_text">
			<div class="ath_name"><?= $name; ?></div>
			<div class="text_box">
				<?= $arItem['~PREVIEW_TEXT']; ?>
			</div>

			<?php if($position != ''): ?>
			<div class="position bott_text">
				<?= $position ?>
			</div>
			<?php endif; ?>

			<?php if($company != ''): ?>
			<div class="company bott_text">
				<?= $company ?>
			</div>
			<?php endif; ?>
		</div> 
	</div>
<?php endforeach; ?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
