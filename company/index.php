<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Компания");

use Bitrix\Main\Page\Asset;

 Asset::getInstance()->addCss('/company/css/styles.css');
 Asset::getInstance()->addCss('/company/css/media.css');

 $inserts = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y"),
		Array()
	)[0]['props'];

//debug($inserts);

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

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_TEMPLATE_PATH."/includes/sub_menu_company.php"
	)
);?>

<section class="comp_top wrap">

	<div class="text_slider">
		<div class="text_box">
			<h1 class="serv_title">
				Евромет – это оптовая
				компания нержавеющего
				и цветного металлопроката
			</h1>

			<div class="about_serv">
				<?= $inserts['ABOUT_TOP_TEXT']['~VALUE']['TEXT']; ?>
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

	<div class="two_col_text">
		<div class="col_item">
			<?= $inserts['ABOUT_LEFT_TEXT']['~VALUE']['TEXT']; ?>
		</div>

		<div class="col_item">
			<?= $inserts['ABOUT_RIGHT_TEXT']['~VALUE']['TEXT']; ?>
		</div>
	</div>
</section>

<section class="about wrap">

	<?php 

		$class = 'hide';
		require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/num_year_cat.php");

	?>

	<div class="delimeter hide"></div>

	<div class="num_box">
		<?php 

			$class = 'hide';
			require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/all_numbers.php");

		?>
	</div>

	<div class="partners_title hide">
          Наши партнеры и клиенты
    </div>

	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_TEMPLATE_PATH."/includes/companies_box.php"
		)
	);?>
</section>

<section class="docs wrap">
	<div class="text_doc">
		<div class="text_box">
			<div class="docs_title">
				Сертификаты <span class="dark_blue">ИСО</span>
			</div>

			<div class="sub_title">
				<?= $inserts['SERT_PREV']['~VALUE']['TEXT']; ?>
			</div>

			<div class="docs_title">
				Работаем в рамках <span class="dark_blue"> 44-ФЗ, 223-ФЗ, 275-ФЗ</span>
			</div>

			<div class="all_text">
				<?= $inserts['SERT_DETAIL']['~VALUE']['TEXT']; ?>
			</div>
		</div>

		<?php $path = CFile::GetPath($inserts['DOC_IMG']['VALUE']); ?>

		<a href="<?= $path; ?>" class="docs_box" data-fancybox="gallery">
			<img class="doc_img" src="<?= $path; ?>">
		</a>
	</div>

	<div class="num_box grid">
	<?php foreach ($inserts['FZ_iITEMS']['~VALUE'] as $item): ?>
	<?php $arr = explode('%%%', $item['TEXT']); ?>
		<div class="num_item">
			<div class="num_title"><?= $arr[0]; ?></div>
			<div class="num_text">
				<?= $arr[1]; ?>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</section>

<div class="wrap">
<section class="director">
	<div class="img_box">
		<div class="photo_box">
			<img class="photo obj-fit" src="<?= CFile::GetPath($inserts['DIRECTOR_PHOTO']['VALUE']); ?>">
		</div>

		<div class="fio">
			<?= $GLOBALS['all_contacts']['FIO_DIRECTOR']['VALUE']; ?>
		</div>
	</div>

	<div class="text_box">
		<div class="hello_box">
			Уважаемые партнеры, друзья! <br>
			Рада приветствовать Вас на нашем сайте.
		</div> 

		<div class="all_text">
			<?= $inserts['DIRECTOR_SPEECH']['~VALUE']['TEXT']; ?>
		</div>

		<?php $mail = $inserts['DIRECTOR_MAIL']['VALUE']; ?>

		<a class="mail" href="mailto:<?= $mail; ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 1.94995C6.48 1.94995 2 6.42995 2 11.95C2 17.47 6.48 21.95 12 21.95H17V19.95H12C7.66 19.95 4 16.29 4 11.95C4 7.60995 7.66 3.94995 12 3.94995C16.34 3.94995 20 7.60995 20 11.95V13.38C20 14.17 19.29 14.95 18.5 14.95C17.71 14.95 17 14.17 17 13.38V11.95C17 9.18995 14.76 6.94995 12 6.94995C9.24 6.94995 7 9.18995 7 11.95C7 14.71 9.24 16.95 12 16.95C13.38 16.95 14.64 16.39 15.54 15.48C16.19 16.37 17.31 16.95 18.5 16.95C20.47 16.95 22 15.35 22 13.38V11.95C22 6.42995 17.52 1.94995 12 1.94995ZM12 14.95C10.34 14.95 9 13.61 9 11.95C9 10.29 10.34 8.94995 12 8.94995C13.66 8.94995 15 10.29 15 11.95C15 13.61 13.66 14.95 12 14.95Z" fill="#2F2FA1"/>
			</svg>

			<span class="mail_text"><?= $mail; ?></span>
		</a>

	</div>
</section>
</div>

<script type="text/javascript">
	$('.comp_top .order_button.order').on('click', Scroll_To_Form);
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>