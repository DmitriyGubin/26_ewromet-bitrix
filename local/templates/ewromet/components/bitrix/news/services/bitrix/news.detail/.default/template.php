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
/** @var CBitrixComponent $component <!--  */
$this->setFrameMode(true);
$name = $arResult['NAME'];


//debug($arResult);

// error_reporting(E_ALL);
// ini_set('display_errors', 'on');
?>

<link rel="stylesheet" type="text/css" href="/local/templates/ewromet/components/bitrix/news/services/bitrix/news.detail/.default/custom.css">
<link rel="stylesheet" type="text/css" href="/local/templates/ewromet/components/bitrix/news/services/bitrix/news.detail/.default/stylee.css">

<section class="serv_top wrap top_box">

	<div class="text_slider">
		<div class="text_box">
			<h1 class="serv_title">
				<?= $name; ?>
			</h1>

			<?php 
				$text = $arResult['PROPERTIES']['TOP_BAN_TEXT']['~VALUE'];
				if($text != '')
				{
					$text = $text['TEXT'];
				}
				else
				{
					$text = $arResult['~PREVIEW_TEXT'];
				}
			?>
	
			<div class="about_servv">
				<?= $text; ?>
			</div>

			<div class="button_box">
				<div class="order_button order">
					<div>Оставить запрос</div>
					<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
					</svg>
				</div>

				<a class="order_button gallery" href="/gallery/">
					<div>Фотогалерея</div>
					<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="white" stroke-width="1.2"/>
					</svg>
				</a>
			</div>
		</div>

		<? 
			$slides = $arResult['PROPERTIES']['SLIDER_GALLERY']['VALUE'];
		?>

		<div class="slider_box">
			<div class="<?= ($slides != '')? 'serv_slider' : null; ?>">
				<?php if($slides != ''): ?>
					<?php foreach ($slides as $slide_id): ?>
					<div class="img_box">
						<img alt="<?= $name; ?>" class="slide_img" src="<?= CFile::GetPath($slide_id); ?>">
					</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="img_box">
						<img alt="<?= $name; ?>" class="slide_img" src="/services/img/default.png">
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php 

$path = $arResult['DETAIL_PICTURE']['SRC'];
if($path == '')
{
	$path = "/services/img/all_pipes.png";
}

?>

<section class="about_serv wrap">
	<img class="right_img" src="<?= $path; ?>">
	<div class="text_box">
		<h2 class="sub_title"><?= $name; ?></h2>
		<div class="all_text">
			<?= $arResult['PREVIEW_TEXT']; ?>
		</div>
	</div>
</section>

<?php 
	$laser_bool = ($arResult['PROPERTIES']['SHOW_LASER']['VALUE'] == 'YES');
	$svar_bool = ($arResult['PROPERTIES']['SHOW_SVAR']['VALUE'] == 'YES');
?>
<?php if($laser_bool or $svar_bool): ?>
<?php
if($laser_bool)
{
	$equip = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID" => 219, "!ID" => 3948),
		Array()
	);
}

if($svar_bool)
{
	$equip = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID" => 220),
		Array()
	);
}
//debug($equip);
?>

<section class="equipm wrap">
<?php foreach ($equip as $eq_item): ?>
	<div class="eq_box">
		<div class="img_box">
			<img class="eq_img" src="<?= CFile::GetPath($eq_item['fields']['PREVIEW_PICTURE']); ?>">
		</div>
		<h2 class="eq_name"><?= $eq_item['fields']['NAME']; ?></h2>
		<div class="eq_about">
			<?= $eq_item['fields']['~PREVIEW_TEXT']; ?>
		</div>
	</div>
<?php endforeach; ?>
</section>
<?php endif; ?>

<?php 
$constr = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID" => 201, '!ID' => $arResult['ID']),
		Array()
	);
//debug($constr);
?>
<section class="metal_serv wrap">

	<h2 class="title" style="margin-top: 80px; font-size: 30px;">
		Конструктору
	</h2>

	<div class="add_serv_box grid">
	<?php foreach ($constr as $con_item): ?>
		<a href="<?= $con_item['fields']['DETAIL_PAGE_URL']; ?>" class="add_serv">
			<div class="img_box">
				<img class="fon_add_img" src="<?= CFile::GetPath($con_item['fields']['PREVIEW_PICTURE']); ?>">
			</div>
			<div class="add_title">
				<?= $con_item['fields']['NAME']; ?>
			</div>
		</a>
	<?php endforeach; ?>
	</div>
</section>

<?php 
	$detail_text = $arResult['~DETAIL_TEXT'];
?>
<?php if($detail_text != ''): ?>
<section class="about_items wrap">
	<h2 class="sub_title">
		<?= $arResult['PROPERTIES']['DETAIL_TITLE']['VALUE']; ?>
	</h2>
	<div class="all_text">
		<?= $detail_text; ?>
	</div>
</section>
<?php endif; ?>

<?php 
	$price_id = $arResult['PROPERTIES']['PRICE_REF']['VALUE'];

	if($price_id != '')
	{
		$sect = Return_All_Sections(
			Array("IBLOCK_ID"=>19, "ACTIVE"=>"Y", "ID" => $price_id),
			Array('ID','NAME', 'UF_PRICE', 'UF_HOW', 'UF_REMARKS', 'UF_PRICE_DOC', 'UF_ACTUAL')
		);

		$elems = Return_All_Fields_Props(
			Array("IBLOCK_ID"=>19, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID" => $price_id),
			Array()
		);
	}

	//debug($elems);
?>

<?php if($price_id != ''): ?>
<section class="serv_price wrap">
	<div class="title_line">
		<div class="color_title">
			<span class="dark_blue">Цены</span>
			<?= $arResult['PROPERTIES']['TITLE_PRICE']['VALUE']; ?>
		</div>

		<div class="doc_date">
			<a target="_blank" class="doc_box" href="<?= CFile::GetPath($sect[0]['UF_PRICE_DOC']); ?>">
				<img src="/services/img/pdf.svg">
				<div class="doc_name">Скачать прайс на услуги</div>
			</a>

			<div class="dat">Актуальные цены с <?= $sect[0]['UF_ACTUAL']; ?></div>
		</div>
	</div>


	<div class="var_box grid">
	<?php $j=0; ?>
	<?php foreach ($elems as $el_item): ?>
	<?php $j++; ?>
		<div class="var_item <?= ($j == 1) ? 'active' : null; ?>" id="<?= $el_item['fields']['CODE']; ?>">
			<div class="item_name">
				<?= $el_item['fields']['NAME']; ?>
			</div>
			<div class="img_box">
				<img class="var_img" src="<?= CFile::GetPath($el_item['fields']['PREVIEW_PICTURE']); ?>">
			</div>
		</div>
	<?php endforeach; ?>
	</div>

	<div class="tables_box">
	<?php $j=0; ?>
	<?php foreach ($elems as $el_item): ?>
	<?php 
		$j++;
		$left = $el_item['props']['LEFT_TABLE']['~VALUE'];
		$right = $el_item['props']['RIGHT_TABLE']['~VALUE'];
	?>
		<div class="tables_wrap <?= ($j>1) ? 'hide' : null; ?> <?= $el_item['fields']['CODE']; ?>">
			<div class="table_item" style="<?= ($right == '') ? 'width: 100%' : null; ?>">
				<?= ($left != '') ? $left['TEXT'] : null; ?>
			</div>

			<div class="table_item two" style="<?= ($right == '') ? 'width: 0%' : null; ?>">
				<?= ($right != '') ? $right['TEXT'] : null; ?>
			</div>
		</div>
	<?php endforeach; ?>
	</div>

	<div class="about_cat">

		<?php if($sect[0]['~UF_PRICE'] != ''): ?>
		<div class="about_item">
			<div class="item_title">Стоимость резки</div>
			<div class="item_text">
				<?= $sect[0]['~UF_PRICE']; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if($sect[0]['~UF_HOW'] != ''): ?>
		<div class="about_item">
			<div class="item_title">Как считаем</div>
			<div class="item_text">
				<?= $sect[0]['~UF_HOW']; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if($sect[0]['~UF_REMARKS'] != ''): ?>
		<div class="about_item">
			<div class="item_title">Нюансы</div>
			<div class="item_text">
				<?= $sect[0]['~UF_REMARKS']; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>

<?php 
$adv = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y"),
		Array()
	);
//debug($adv);

$page = $APPLICATION->GetCurPage();
$url = '/services/spravochnik-konstruktora/osobennosti_gibki/';

?>

<section class="why_box wrap <?= ($page == $url) ? 'top_marg' : null; ?>">
	<div class="color_title">
		Почему стоит
		<span class="dark_blue">сотрудничать с нами</span>
	</div>
<?php foreach ($adv as $adv_item): ?>
	<div class="tab_item">
		<div class="plus_min">
			<svg class="plus count_butt" width="39" height="35" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M-1.44248e-06 34L28.3519 34C29.9573 34 31.4072 33.0401 32.0342 31.5622L37.3372 19.0622C37.7608 18.0638 37.7608 16.9362 37.3372 15.9378L32.0342 3.4378C31.4072 1.95986 29.9573 1 28.3519 1L0 0.999998" stroke="url(#<?= $adv_item['fields']['ID'].'_1'; ?>)"/>
				<path class="line" d="M18 9.5H20V25.5H18V9.5Z" fill="#121419"/>
				<path class="line" d="M11 18.5L11 16.5L27 16.5V18.5L11 18.5Z" fill="#121419"/>
				<defs>
					<linearGradient id="<?= $adv_item['fields']['ID'].'_1'; ?>" x1="38" y1="17" x2="3" y2="17" gradientUnits="userSpaceOnUse">
						<stop class="grad" stop-color="#D0D8E9"/>
						<stop offset="1" stop-color="white"/>
					</linearGradient>
				</defs>
			</svg>

			<svg class="minus count_butt hide" width="39" height="35" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M39 1L10.6481 1C9.04267 1 7.59279 1.95986 6.96578 3.4378L1.66275 15.9378C1.23919 16.9362 1.23919 18.0638 1.66275 19.0622L6.96578 31.5622C7.59278 33.0401 9.04267 34 10.6481 34L39 34" stroke="url(#<?= $adv_item['fields']['ID'].'_2'; ?>)"/>
				<path class="line" d="M15 18.5L15 16.5L31 16.5V18.5L15 18.5Z" fill="#121419"/>
				<defs>
					<linearGradient id="<?= $adv_item['fields']['ID'].'_2'; ?>" x1="1" y1="18" x2="36" y2="18" gradientUnits="userSpaceOnUse">
						<stop class="grad" stop-color="#D0D8E9"/>
						<stop offset="1" stop-color="white"/>
					</linearGradient>
				</defs>
			</svg>
		</div>

		<div class="text_box">
			<div class="tab_title"><?= $adv_item['fields']['NAME']; ?></div>
			<div class="tab_text" style="display: none">
				<?= $adv_item['fields']['~PREVIEW_TEXT']; ?>
			</div>
		</div>   
	</div>
<?php endforeach; ?>
</section>

<?php 
$form_title = $arResult['PROPERTIES']['TITLE_FORM']['VALUE'];
$GLOBALS['hide_products'] = false;
require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/help_form.php");
?>

<section class="metal_serv wrap">
	<h2 class="title sub">Услуги по металлообработке</h2>

	<?php 
		$serv_main = Return_All_Fields_Props(
			Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y", '!ID' => $arResult['ID']),
			Array()
		);
		$main_sect_id = 199;
        require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/services_metal.php");
    ?>
</section>

<script type="text/javascript" src="/services/detail.js"></script>


