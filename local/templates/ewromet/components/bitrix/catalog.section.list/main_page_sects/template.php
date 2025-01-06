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

$list_id = 403;

//debug($arResult['SECTIONS']);

?>

<style type="text/css">
	.catalog .about_decorate_list
	{
	  font-size: 17px;
	  line-height: 1.5;
	  width: 100%;
	  max-width: 1100px;
	}

	.catalog .sub_cat_box .var_box.grid
	{
	  margin: 30px 0;
	}

	.catalog .sub_cat_box
	{
	  margin-bottom: 50px;
	}

</style>


<?php

	$list_arr = [];
	foreach ($arResult['SECTIONS'] as $arItem)
	{
		if($arItem['ID'] == $list_id)
		{
			$list_arr[] = $arItem;
			break;
		}
	}

	//debug($list_arr);
	$descr = $list_arr[0]['~DESCRIPTION'];
	$href = $list_arr[0]['SECTION_PAGE_URL'];
	//$img_path = $list_arr[0]['PICTURE']['SRC'];

	$imgs = Return_All_Sections(
		Array("IBLOCK_ID"=>18, "ACTIVE"=>"Y", "ID" => 403),
		Array("UF_IMG_EXAMPLES")
	)[0]["UF_IMG_EXAMPLES"];
	$counter = 0;
?>

<section class="catalog wrap top_box">
	<div class="decorate_list sub_cat_box">
		<div class="cat_sub_box">
			<a href="<?= $href; ?>" class="name_boxx">
				<h2 class="cat_sub_title hide_mobile"><?= $list_arr[0]['NAME']; ?></h2>
				<h2 class="cat_sub_title show_mobile">Декоративный лист</h2>
				<div class="count_prod"><?= $list_arr[0]['ELEMENT_CNT']; ?></div>
			</a>
		</div>

		<div class="var_box grid">
			<?php foreach($imgs as $img_item): ?>
			<?php 
				$counter++;
				if($counter == 9) break;
				$img_path = CFile::GetPath($img_item);
			?>
			<div class="var_item">
				<img class="texture obj-fit" src="<?= $img_path; ?>">
				<?php if($counter == 8): ?>
				<a class="more_texture" href="<?= $href; ?>">
					<div class="hide_mobile">Больше</div>
					<div class="show_mobile">Все</div>
					<svg class="hide_mobile" width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7H27M27 7L21 1M27 7L21 13" stroke="white" stroke-width="1.4"></path>
					</svg>
				</a>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="about_decorate_list">
			<?= $descr; ?> 
		</div>
	</div>

	<?php foreach ($arResult['SECTIONS'] as $arItem): ?>
	<?php if(($arItem['ID'] != $list_id) and ($arItem['DEPTH_LEVEL'] == 1)): ?>
	<?php 
		$head_sec_id = $arItem['ID'];
		$main_img_path = $arItem['PICTURE']['SRC'];
	?>
	<div class="another_one sub_cat_box">
		<div class="cat_sub_box">
			<div class="name_boxx">
				<a href="<?= $arItem['SECTION_PAGE_URL']; ?>" class="cat_sub_title"><?= $arItem['NAME']; ?></a>
				<div class="count_prod"><?= $arItem['ELEMENT_CNT']; ?></div>
			</div>
		</div>

		<div class="var_box_anoth grid">
		<?php foreach ($arResult['SECTIONS'] as $arSub): ?>
		<?php if(($arSub['IBLOCK_SECTION_ID'] == $head_sec_id) and ($arSub['DEPTH_LEVEL'] == 2) and ($arSub['ELEMENT_CNT'] != 0)): ?>
			<a href="<?= $arSub['SECTION_PAGE_URL']; ?>" class="var_anoth_item">
			<?php
				if($arSub['PICTURE'] != '')
				{
					$path = $arSub['PICTURE']['SRC'];
				}
				else if($main_img_path != '')
				{
					$path = $main_img_path;
				}
				else
				{
					$path = SITE_TEMPLATE_PATH.'/img/no_photo.png';
				}
				$name = $arSub['NAME'];
			?>
				<img alt="<?= $name; ?>" class="anoth_img" src="<?= $path; ?>">
				<h2 class="anoth_name">
					<?= $name; ?>
				</h2>
				<div class="anoth_count"><?= $arSub['ELEMENT_CNT']; ?></div>
			</a>
		<?php endif; ?>
		<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
	<?php endforeach; ?>
</section>






