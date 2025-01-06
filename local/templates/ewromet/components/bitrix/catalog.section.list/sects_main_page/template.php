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
/** @var CBitrixComponent $component  $arResult['SECTION']*/ 
$this->setFrameMode(true);

//debug($arResult['SECTIONS']);
?>

<section class="metal wrap">

	<div class="title_line">
		<h2 class="title">
			Широкий выбор 
			<span class="dark_blue hide_mob">металлопроката</span>
			<span class="dark_blue hide">&nbsp;металлов</span>
		</h2>

		<div class="order_button">
			<div>Оставить запрос</div>
			<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
			</svg>
		</div>
	</div>

	<?php 

		$id = 403;//Декоративный лист
		$sec = Return_Section_Ref($id, $arResult['SECTIONS']);
		$href = $sec['SECTION_PAGE_URL'];

	?>

	<div class="metal_box">
		<div class="metal_item decor">
			<img class="decor_img" src="<?= SITE_TEMPLATE_PATH ?>/img/decor_list.svg">
			<a href="<?= $href; ?>" class="metal_title">Декоративный лист</a>

			<div class="metal_text">
				Идеальный материал для воплощения самых смелых дизайнерских идей в строительстве, архитектуре, отделке помещений
			</div>
			<a class="more_decore" href="<?= $href; ?>">
				<div>Смотреть все листы</div>
				<svg width="43" height="14" viewBox="0 0 43 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 7H42M42 7L36 1M42 7L36 13" stroke="#121419" stroke-width="1.4"/>
				</svg>
			</a>
		</div>

		<?php 
			$id = 384;//Алюминий и дюраль
			$sec = Return_Section_Ref($id, $arResult['SECTIONS']);
			$href = $sec['SECTION_PAGE_URL'];
			$count = $sec['ELEMENT_CNT'];
			$img = $sec['PICTURE']['SRC'];
		?>

		<div class="metal_item">
			<div class="title_img">
				<a href="<?= $href; ?>" class="metal_title">Алюминий и дюраль</a>
				<img class="sec_img show_mobile" src="<?= $img; ?>">
			</div>
			<div class="show_mobile more_items">
				<div class="count_title"><?= $count; ?> наименований</div>
				<svg class="arrow" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 7L6.5 1.5L12 7" stroke="#121419" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>
			<div class="ref_box">
				<?php foreach ($arResult['SECTIONS'] as $arSec): ?>
				<?php if(($arSec['IBLOCK_SECTION_ID'] == $id) or ($arSec['ID'] == $id_plus)): ?>
					<a class="sub_metal_ref" href="<?= $arSec['SECTION_PAGE_URL']; ?>">
						<?= $arSec['NAME']; ?>
					</a>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>

		<?php 
			$id = 427;// Нержавеющий металлопрокат
			$id_plus = 443;// Сетка нержавеющая

			$sec = Return_Section_Ref($id, $arResult['SECTIONS']);
			$count = $sec['ELEMENT_CNT'] + Return_Section_Ref($id_plus, $arResult['SECTIONS'])['ELEMENT_CNT'];
			$img = $sec['PICTURE']['SRC'];
			$href = $sec['SECTION_PAGE_URL'];
		?>

		<div class="metal_item">
			
			<div class="title_img">
				<a href="<?= $href; ?>" class="metal_title">Нержавеющая сталь</a>
				<img class="sec_img show_mobile" src="<?= $img; ?>">
			</div>

			<div class="show_mobile more_items">
				<div class="count_title"><?= $count; ?> наименований</div>
				<svg class="arrow" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 7L6.5 1.5L12 7" stroke="#121419" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>

			<div class="ref_box">
				<?php foreach ($arResult['SECTIONS'] as $arSec): ?>
				<?php if(($arSec['IBLOCK_SECTION_ID'] == $id) or ($arSec['IBLOCK_SECTION_ID'] == $id_plus)): ?>
					<a class="sub_metal_ref" href="<?= $arSec['SECTION_PAGE_URL']; ?>">
						<?= $arSec['NAME']; ?>
					</a>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>

		<?php
			$id = 404;// Медь, бронза, латунь
			$id_plus = 472;// Нихром, Никель, Титан
			$id_plus_two = 476;// электроды

			$sec = Return_Section_Ref($id, $arResult['SECTIONS']);
			$count = $sec['ELEMENT_CNT'] + Return_Section_Ref($id_plus, $arResult['SECTIONS'])['ELEMENT_CNT'] + Return_Section_Ref($id_plus_two, $arResult['SECTIONS'])['ELEMENT_CNT'];
			$img = $sec['PICTURE']['SRC'];
			$href = $sec['SECTION_PAGE_URL'];
		?>

		<div class="metal_item">

			<div class="title_img">
				<a href="<?= $href; ?>" class="metal_title">Цветной прокат</a>
				<img class="sec_img show_mobile" src="<?= $img; ?>">
			</div>

			<div class="show_mobile more_items">
				<div class="count_title"><?= $count; ?> наименований</div>
				<svg class="arrow" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 7L6.5 1.5L12 7" stroke="#121419" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>

			<div class="ref_box two_col">
				<?php foreach ($arResult['SECTIONS'] as $arSec): ?>
				<?php $sec_id = $arSec['IBLOCK_SECTION_ID']; ?>
				<?php if(($sec_id == $id) or ($sec_id == $id_plus_two) or ($sec_id == $id_plus)): ?>
					<a class="sub_metal_ref" href="<?= $arSec['SECTION_PAGE_URL']; ?>">
						<?= $arSec['NAME']; ?>
					</a>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<img class="colour_img" src="<?= SITE_TEMPLATE_PATH ?>/img/colour_met.png">
		</div>

		<?php 
			$id = 460;// Черный прокат
			$sec = Return_Section_Ref($id, $arResult['SECTIONS']);
			$href = $sec['SECTION_PAGE_URL'];
			$count = $sec['ELEMENT_CNT'];
			$img = $sec['PICTURE']['SRC'];
		?>
		<div class="metal_item black">
			<img src="<?= SITE_TEMPLATE_PATH ?>/img/black_met.png" class="fon_img">

			<div class="title_img">
				<a href="<?= $href; ?>" class="metal_title">Черный прокат</a>
				<img class="sec_img show_mobile" src="<?= $img; ?>">
			</div>

			<div class="show_mobile more_items">
				<div class="count_title"><?= $count; ?> наименований</div>
				<svg class="arrow" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 7L6.5 1.5L12 7" stroke="#121419" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>
			<div class="ref_box">
				<?php foreach ($arResult['SECTIONS'] as $arSec): ?>
				<?php if($arSec['IBLOCK_SECTION_ID'] == $id): ?>
					<a class="sub_metal_ref" href="<?= $arSec['SECTION_PAGE_URL']; ?>">
						<?= $arSec['NAME']; ?>
					</a>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>


		<?php 
			$id = 454;// Трупоброводная арматура
			$sec = Return_Section_Ref($id, $arResult['SECTIONS']);
			$href = $sec['SECTION_PAGE_URL'];
			$count = $sec['ELEMENT_CNT'];
			$img = $sec['PICTURE']['SRC'];
		?>
		<div class="metal_item pipes">
			<img src="<?= SITE_TEMPLATE_PATH ?>/img/krans.png" class="fon_img">

			<div class="title_img">
				<a href="<?= $href; ?>" class="metal_title">Трупоброводная арматура</a>
				<img class="sec_img show_mobile" src="<?= $img; ?>">
			</div>

			<div class="show_mobile more_items">
				<div class="count_title"><?= $count; ?> наименований</div>
				<svg class="arrow" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 7L6.5 1.5L12 7" stroke="#121419" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>
			<div class="ref_box">
				<?php foreach ($arResult['SECTIONS'] as $arSec): ?>
				<?php if($arSec['IBLOCK_SECTION_ID'] == $id): ?>
					<a class="sub_metal_ref" href="<?= $arSec['SECTION_PAGE_URL']; ?>">
						<?= $arSec['NAME']; ?>
					</a>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>

		<a target="_blank" href="<?= SITE_TEMPLATE_PATH ?>/docs/Прайс на продукцию.pdf" class="metal_item price">
			<div class="img_title_price">
				<img class="doc_img" src="<?= SITE_TEMPLATE_PATH ?>/img/price_icon.svg">
				<div class="price_title">
					Скачать <br>
					прайс-лист всей <br>
					продукции
				</div>
			</div>
			<div class="update">Обновлен 3 апреля</div>
		</a>
	</div>
</section>
