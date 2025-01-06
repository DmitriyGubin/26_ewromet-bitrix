<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Фотогалерея");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss('/gallery/css/styles.css');
Asset::getInstance()->addCss('/gallery/css/media.css');

$sects = Return_All_Sections(
	Array("IBLOCK_ID"=>13, "ACTIVE"=>"Y"),
	Array('ID','NAME','CODE')
);

if($_GET['id'] == '')
{
	$id = $sects[0]['ID'];
}
else
{
	$id = $_GET['id'];
}

$photos = Return_All_Fields_Props(
	Array("IBLOCK_ID"=>13, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID" => $id),
	Array()
);

$j=0;
$page = $APPLICATION->GetCurPage();
//debug($sects);
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

<section class="gallery top_box">
	<div class="tab_buts_box grid wrap">
	<?php foreach ($sects as $sec_item): ?>
	<?php $j++; ?>
	<?php 
		if($j == 1)
		{
			$rull = (($_GET['id'] == '') or ($_GET['id'] == $sec_item['ID']));
		}
		else
		{
			$rull = ($_GET['id'] == $sec_item['ID']);
		}
	?>
		<a href="<?= $page.'?id='.$sec_item['ID']; ?>" class="tab_butt <?= $rull ? 'active' : null; ?>">
			<svg class="img_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M20 5H16.83L15 3H9L7.17 5H4C2.9 5 2 5.9 2 7V19C2 20.1 2.9 21 4 21H20C21.1 21 22 20.1 22 19V7C22 5.9 21.1 5 20 5ZM20 19H4V7H8.05L9.88 5H14.12L15.95 7H20V19Z" fill="#A8A8A8"/>
				<path d="M11.25 16L9 13L6 17H18L14.25 12L11.25 16Z" fill="#A8A8A8"/>
			</svg>

			<div class="tab_name"><?= $sec_item['NAME']; ?></div>
		</a>
	<?php endforeach;?>
	</div>

	<div class="slider_wrap">
		<div class="slider_item">
			<div class="big_slider">
			<?php foreach ($photos as $photo_item): ?>
				<div class="slide_img_box">
					<img class="slide_img" src="<?= CFile::GetPath($photo_item['fields']['DETAIL_PICTURE']); ?>">
					<div class="slide_title">
						<?= $photo_item['fields']['NAME']; ?>
					</div>
				</div>
			<?php endforeach; ?>
			</div>

			<div class="small_slider_box wrap">
				<div class="small_slider">
				<?php foreach ($photos as $photo_item): ?>
					<div class="small_img_box">
						<img class="small_img obj-fit" src="<?= CFile::GetPath($photo_item['fields']['PREVIEW_PICTURE']); ?>">
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="js/script.js" type="text/javascript"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>