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

$sects = Return_All_Sections(
	Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y"),
	Array('ID','NAME')
);

$construct_id = 201;//id раздела конструктору

?>

<section class="metal_serv detail wrap top_box">
	<?php foreach ($sects as $sec_item): ?>
	<?php $sec_id = $sec_item['ID']; ?>
		<h2 class="title sub" id="<?= ($sec_id == $construct_id) ? 'constr_title' : null; ?>"><?= $sec_item['NAME']; ?></h2>

		<?php if($sec_id == $construct_id): ?>
			<div class="add_serv_box grid">
			<?php foreach ($arResult['ITEMS'] as $arItem): ?>
			<?php if($arItem['IBLOCK_SECTION_ID'] == $sec_id): ?>
			<?php $name = $arItem['NAME']; ?>
				<a class="add_serv" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
					<div class="img_box">
						<img alt="<?= $name; ?>" class="fon_add_img" src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>">
					</div>
					<div class="add_title"><?= $name; ?></div>
				</a>
			<?php endif; ?>
			<?php endforeach; ?>
			</div>
		<?php else: ?>
			<div class="serv_box grid">
			<?php foreach ($arResult['ITEMS'] as $arItem): ?>
			<?php if($arItem['IBLOCK_SECTION_ID'] == $sec_id): ?>
			<?php $name = $arItem['NAME']; ?>
				<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="serv_item">
					<div class="title_box">
						<div class="icon_title">
							<img src="<?= SITE_TEMPLATE_PATH; ?>/img/icon_arr.svg">
							<h2 class="serv_title">
								<?= $name ?>	
							</h2>
						</div>

						<img alt="<?= $name; ?>" src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" class="fon_img">
					</div>

					<div class="text_arrow">
						<div class="serv_text">
							<?= Сut_Text($arItem['~PREVIEW_TEXT'], 100); ?>      
						</div>
						<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.4"></path>
						</svg>
					</div>
				</a>
			<?php endif; ?>
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</section>

<script type="text/javascript">

	if(screen.width < 1000)
	{
		$('.metal_serv .add_serv_box').slick({
			dots: false,
			infinite: true,
			slidesToScroll: 1,
			slidesToShow: 1,
			arrows: false,
			variableWidth: true
		});
	}

</script>
