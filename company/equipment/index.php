<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оборудование");

use Bitrix\Main\Page\Asset;

 Asset::getInstance()->addCss('/company/equipment/css/styles.css');
 Asset::getInstance()->addCss('/company/equipment/css/media.css');

 $inserts = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y"),
		Array()
	)[0]['props'];
?>

<!-- <link href="css/styles.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet"> -->

<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"nav_chain",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>

<section class="comp_top wrap">

	<div class="text_slider">
		<div class="text_box">
			<h1 class="serv_title">
				Новое оборудование
				позволяет делать
				ювелирную резку
			</h1>

			<div class="about_serv">
				<?= $inserts['EQUIP_TOP_TEXT']['~VALUE']['TEXT']; ?>
			</div>

			<div class="button_box">
				<div class="order_button order">
					<div>Оставить запрос</div>
					<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
					</svg>
				</div>
			</div>
		</div>

		<div class="slider_box">
			<div class="img_box">
				<img class="slide_img" src="img/stanok.png">
			</div>
		</div>
	</div>
</section>

<?php 

	$equip = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y"),
		Array()
	);

	$sects = Return_All_Sections(
		Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y"),
		Array('ID','NAME')
	);

	//debug($sects);
	$id_lazer = 219;
	$id_svar = 220;
	$id_color = 221;

	function Id_To_Name($id, $sects)
	{
		foreach ($sects as $sec_item) 
		{
			if($sec_item['ID'] == $id)
			{
				return $sec_item['NAME'];
			}
		}
	}

?>

<section class="wrap">
	<h2 class="title dark_blue">
		<?= Id_To_Name($id_lazer, $sects); ?>
	</h2>
	<div class="equipm">
	<?php foreach ($equip as $eq_item): ?>
	<?php if($eq_item['fields']['IBLOCK_SECTION_ID'] == $id_lazer): ?>
		<div class="eq_box">
			<div class="img_box">
				<img class="eq_img" src="<?= CFile::GetPath($eq_item['fields']['PREVIEW_PICTURE']); ?>">
			</div>
			<h2 class="eq_name"><?= $eq_item['fields']['NAME']; ?></h2>
			<div class="eq_about">
				<?= $eq_item['fields']['~PREVIEW_TEXT']; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php endforeach; ?>
	</div>
</section>

<section class="welding wrap">
	<h2 class="title dark_blue">
		<?= Id_To_Name($id_svar, $sects); ?>
	</h2>

	<?php foreach ($equip as $eq_item): ?>
	<?php if($eq_item['fields']['IBLOCK_SECTION_ID'] == $id_svar): ?>
	<div class="weld_item">
		<img class="equip_img" src="<?= CFile::GetPath($eq_item['fields']['PREVIEW_PICTURE']); ?>">
		<div class="text_box">
			<h2 class="equip_title"><?= $eq_item['fields']['NAME']; ?></h2>
			<div class="equip_text">
				<?= $eq_item['fields']['~PREVIEW_TEXT']; ?>
			</div>

			<a class="order_button" href="/services/uslugi_po_metalloobrabotke/poluavtomaticheskaya_i_tochechnaya_svarka_metallov/">
				<div>Сварочные работы</div>
				<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
				</svg>
			</a>
		</div>
	</div>
	<?php endif; ?>
	<?php endforeach; ?>

</section>

<section class="gild wrap">
	<h2 class="title dark_blue">
		<?= Id_To_Name($id_color, $sects); ?>
	</h2>

	<?php foreach ($equip as $eq_item): ?>
	<?php if($eq_item['fields']['IBLOCK_SECTION_ID'] == $id_color): ?>
	<div class="gild_item">
		<img class="gild_img" src="<?= CFile::GetPath($eq_item['fields']['PREVIEW_PICTURE']); ?>">

		<div class="text_box">
			<h2 class="gild_title">
				<?= $eq_item['fields']['NAME']; ?>
			</h2>

			<div class="gild_text">
				<?= $eq_item['fields']['~PREVIEW_TEXT']; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php endforeach; ?>

</section>

<script type="text/javascript">
	$('.comp_top .order_button.order').on('click', Scroll_To_Form);
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
