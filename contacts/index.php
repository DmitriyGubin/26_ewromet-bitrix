<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss('/contacts/css/styles.css');
Asset::getInstance()->addCss('/contacts/css/media.css');

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

<?php 
	
	$address = $GLOBALS['all_contacts']['ADRESS']['~VALUE']['TEXT'];
	$mail = $GLOBALS['all_contacts']['MAIL']['VALUE'];
	$main_phone = $GLOBALS['all_contacts']['PHONE']['VALUE'];
	$ofice_phone = $GLOBALS['all_contacts']['OFICE_PHONE']['VALUE'];

?>

<div style="display: none;">
	<div id="lat"><?= $GLOBALS['all_contacts']['LAT']['VALUE']; ?></div>
	<div id="long"><?= $GLOBALS['all_contacts']['LONG']['VALUE']; ?></div>
	<div id="address"><?= $address; ?></div>
</div>

<section class="map_box wrap">
	<h1 class="title">Контакты</h1>

	<div id="y_map"></div>

	<div class="cont_line grid">

		<div class="contact_item">
			<div class="cont_title">Местоположение</div>
			<div class="cont_text"><?= $address; ?></div>
		</div>

		<div class="contact_item">
			<div class="cont_title">Электронная почта</div>
			<a class="cont_text" href="mailto:<?= $mail; ?>"><?= $mail; ?></a>
		</div>

		<div class="contact_item">
			<div class="cont_title">Телефон</div>
			<a class="cont_text" href="tel:<?= $main_phone; ?>"><?= $main_phone; ?></a>
		</div>

		<div class="contact_item">
			<div class="cont_title">Время работы, ПН-ПТ</div>
			<div class="cont_text"><?= $GLOBALS['all_contacts']['WORK_HOURS']['VALUE']; ?></div>
		</div>

	</div>
</section>

<?php 

	$contacts = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>12, "ACTIVE"=>"Y"),
		Array()
	);

	$sects = Return_All_Sections(
		Array("IBLOCK_ID"=>12, "ACTIVE"=>"Y"),
		Array('ID','NAME', 'DESCRIPTION')
	);

	//debug($sects);
?>

<section class="employees wrap">

<?php foreach ($sects as $sec_item): ?>
<?php 
	$id_sec = $sec_item['ID'];
	$plus_id = $id_sec.'_1';
	$min_id = $id_sec.'_2';
?>
	<?php if(Counter_Section_Elements($id_sec, $contacts) != 0): ?>
	<div class="tab_item">

		<div class="sect">
			<div class="butt_box">
				<svg class="plus count_butt" width="39" height="35" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M-1.44248e-06 34L28.3519 34C29.9573 34 31.4072 33.0401 32.0342 31.5622L37.3372 19.0622C37.7608 18.0638 37.7608 16.9362 37.3372 15.9378L32.0342 3.4378C31.4072 1.95986 29.9573 1 28.3519 1L0 0.999998" stroke="url(#<?= $plus_id; ?>)"/>
					<path class="line" d="M18 9.5H20V25.5H18V9.5Z" fill="#121419"/>
					<path class="line" d="M11 18.5L11 16.5L27 16.5V18.5L11 18.5Z" fill="#121419"/>
					<defs>
						<linearGradient id="<?= $plus_id; ?>" x1="38" y1="17" x2="3" y2="17" gradientUnits="userSpaceOnUse">
							<stop class="grad" stop-color="#D0D8E9"/>
							<stop offset="1" stop-color="white"/>
						</linearGradient>
					</defs>
				</svg>

				<svg class="minus hide count_butt" width="39" height="35" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M39 1L10.6481 1C9.04267 1 7.59279 1.95986 6.96578 3.4378L1.66275 15.9378C1.23919 16.9362 1.23919 18.0638 1.66275 19.0622L6.96578 31.5622C7.59278 33.0401 9.04267 34 10.6481 34L39 34" stroke="url(#<?= $min_id; ?>)"/>
					<path class="line" d="M15 18.5L15 16.5L31 16.5V18.5L15 18.5Z" fill="#121419"/>
					<defs>
						<linearGradient id="<?= $min_id; ?>" x1="1" y1="18" x2="36" y2="18" gradientUnits="userSpaceOnUse">
							<stop class="grad" stop-color="#D0D8E9"/>
							<stop offset="1" stop-color="white"/>
						</linearGradient>
					</defs>
				</svg>
			</div>

			<div class="title_text">
				<div class="tab_title"><?= $sec_item['NAME']; ?></div>
				<div class="tab_prev">
					 <?= $sec_item['~DESCRIPTION']; ?>
				</div>
			</div>
		</div>

		<div class="hide_box" style="display: none;">
			<div class="delimeter"></div>
			<div class="grid_box grid">
			<?php foreach ($contacts as $cont_item): ?>
			<?php if($cont_item['fields']['IBLOCK_SECTION_ID'] == $id_sec): ?>
				<?php 
					$props = $cont_item['props'];
					$mob_phone = $props['PHONE']['VALUE'];
					$inner_phone = $props['PHONE_INNER']['VALUE'];
					$mail = $props['EMAIL']['VALUE'];
				?>
				<div class="perse_item">
					<div class="perse_name"><?= $props['NAME']['VALUE']; ?></div>
					<a class="cont_item" href="tel:<?= $mob_phone; ?>">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M20 15.5C18.75 15.5 17.55 15.3 16.43 14.93C16.2542 14.874 16.0664 14.8667 15.8868 14.909C15.7072 14.9513 15.5424 15.0415 15.41 15.17L13.21 17.37C10.3739 15.9272 8.06711 13.6239 6.62 10.79L8.82 8.58C9.1 8.31 9.18 7.92 9.07 7.57C8.69065 6.41806 8.49821 5.2128 8.5 4C8.5 3.45 8.05 3 7.5 3H4C3.45 3 3 3.45 3 4C3 13.39 10.61 21 20 21C20.55 21 21 20.55 21 20V16.5C21 15.95 20.55 15.5 20 15.5Z" fill="#121419"/>
							<path d="M12 3V13L15 10H21V3H12Z" fill="#80899B"/>
						</svg>
						<div class="cont_text phone"><?= $mob_phone; ?></div>
					</a>

					<a class="cont_item" href="tel:<?= $inner_phone; ?>">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M20 15.5C18.75 15.5 17.55 15.3 16.43 14.93C16.2542 14.874 16.0664 14.8667 15.8868 14.909C15.7072 14.9513 15.5424 15.0415 15.41 15.17L13.21 17.37C10.3739 15.9272 8.06711 13.6239 6.62 10.79L8.82 8.58C9.1 8.31 9.18 7.92 9.07 7.57C8.69065 6.41806 8.49821 5.2128 8.5 4C8.5 3.45 8.05 3 7.5 3H4C3.45 3 3 3.45 3 4C3 13.39 10.61 21 20 21C20.55 21 21 20.55 21 20V16.5C21 15.95 20.55 15.5 20 15.5Z" fill="#121419"/>
							<path d="M12 3V13L15 10H21V3H12Z" fill="#80899B"/>
						</svg>
						<div class="cont_text">Внутренний: <?= $inner_phone; ?></div>
					</a>

					<a class="cont_item" href="mailto:<?= $mail; ?>">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 1.94922C6.48 1.94922 2 6.42922 2 11.9492C2 17.4692 6.48 21.9492 12 21.9492H17V19.9492H12C7.66 19.9492 4 16.2892 4 11.9492C4 7.60922 7.66 3.94922 12 3.94922C16.34 3.94922 20 7.60922 20 11.9492V13.3792C20 14.1692 19.29 14.9492 18.5 14.9492C17.71 14.9492 17 14.1692 17 13.3792V11.9492C17 9.18922 14.76 6.94922 12 6.94922C9.24 6.94922 7 9.18922 7 11.9492C7 14.7092 9.24 16.9492 12 16.9492C13.38 16.9492 14.64 16.3892 15.54 15.4792C16.19 16.3692 17.31 16.9492 18.5 16.9492C20.47 16.9492 22 15.3492 22 13.3792V11.9492C22 6.42922 17.52 1.94922 12 1.94922ZM12 14.9492C10.34 14.9492 9 13.6092 9 11.9492C9 10.2892 10.34 8.94922 12 8.94922C13.66 8.94922 15 10.2892 15 11.9492C15 13.6092 13.66 14.9492 12 14.9492Z" fill="black"/>
						</svg>

						<div class="cont_text"><?= $mail; ?></div>
					</a>
				</div>
			<?php endif; ?>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php endforeach; ?>

</section>

<section class="requisites wrap">
	<h2 class="req_title">Реквизиты: Общество с ограниченной отвественностью «ЕВРОМЕТ»</h2>

	<div class="req_box">

		<div class="req_item">
			Юридический и фактический адрес:<br>
			<?= $GLOBALS['all_contacts']['UR_FACT_ADRESS']['~VALUE']['TEXT']; ?> 
			Почтовый адрес:<br> 
			<?= $GLOBALS['all_contacts']['POST_ADRESS']['~VALUE']['TEXT']; ?>
		</div>

		<div class="req_item">
			<div class="prop_item">
				<span class="prop_name"> Р/СЧ </span>
				<?= $GLOBALS['all_contacts']['RSCH']['~VALUE']['TEXT'] ?>
			</div>

			<div class="prop_item">
				<span class="prop_name"> К/СЧ </span>
				<?= $GLOBALS['all_contacts']['KSCH']['VALUE']; ?>
				<br>
				<span class="prop_name">БИК </span> 
				<?= $GLOBALS['all_contacts']['BIK']['VALUE']; ?>
			</div>

			<div class="prop_item">
				<span class="prop_name"> ОКПО </span>
				<?= $GLOBALS['all_contacts']['OKPO']['VALUE']; ?>
			</div>

			<div class="prop_item">
				<span class="prop_name"> ИНН </span>
				<?= $GLOBALS['all_contacts']['INN']['VALUE']; ?>
			</div>

			<div class="prop_item">
				<span class="prop_name"> КПП </span>
				<?= $GLOBALS['all_contacts']['KPP']['VALUE'] ?>
			</div>

			<div class="prop_item">
				<span class="prop_name"> ОГРН </span>
				<?= $GLOBALS['all_contacts']['OGRN']['VALUE']; ?>
			</div>
		</div>

		<div class="req_item">
			<div>
				Электронный документооборот:<br>
				Сбис и Контур.Диадок
			</div>

			<div class="icon_box">
				<img src="img/sbis.svg">
				<img src="img/contur.svg">
			</div>

			<div>
				Директор:<br><?= $GLOBALS['all_contacts']['FIO_DIRECTOR']['VALUE']; ?> на основании Устава
			</div>

			<div class="ref">
				<a href="#">
					www.ewromet.ru 
				</a>
			</div>

			<div>
				<a href="tel:<?= $ofice_phone; ?>">тел. <?= $ofice_phone; ?></a>
			</div>
		</div>
	</div>
</section>

<div class="wrap">
<section class="call_order">
	<div class="form_box">
		<div class="form_title_line">
			<div class="form_title">Заказать обратный звонок</div>

			<div class="polite hide_mobile">
				Нажимая Отправить мы руководствуемся <a target="_blank" href="<?= SITE_TEMPLATE_PATH ?>/docs/Политика конфиденциальности.pdf">Политикой конфиденциальности</a> и бережно храним данные
			</div>
		</div>

		<form id="call_order_form" class="grid">
			<input type="hidden" name="type_of_form" value="Форма заказать обратный звонок">
			<div class="grid_item">
				<input class="form_field required" placeholder="Как звать" type="text" name="name">
				<img class="field_img" src="img/inp_name.svg">
			</div>

			<div class="grid_item">
				<input class="form_field required phone" placeholder="Телефон" type="text" name="phone">
				<img class="field_img" src="img/inp_phone.svg">
			</div>

			<div class="grid_item">
				<input class="form_field" placeholder="Название компании" type="text" name="companyy">
				<img class="field_img" src="img/inp_houses.svg">
			</div>

			<div class="polite show_mobile">
				Нажимая Отправить мы руководствуемся <a target="_blank" href="<?= SITE_TEMPLATE_PATH ?>/docs/Политика конфиденциальности.pdf">Политикой конфиденциальности</a>
			</div>

			<a class="grid_item order_button" href="#">
				<div class="hide_mobile">Отправить</div>
				<div class="show_mobile">Заказать звонок</div>
				<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"/>
				</svg>
			</a>
		</form>
	</div>

	<div class="success hide">
		<img class="succ_img" src="/local/templates/ewromet/img/success_img.svg">
		<div class="succ_title">Заявка уже в пути!</div>
		<div class="succ_text">
			Спасибо, что выбрали компанию Евромет. Наши специалисты уже изучают ваши пожелания и ответят в рабочее время
		</div>
		<button class="one_more">Отправить еще</button>
	</div>
</section>
</div>

<script src="https://api-maps.yandex.ru/2.1/?apikey=e5df13fe-7b6a-4037-9699-cddff13aa624&amp;lang=ru_RU" type="text/javascript"></script>

<script type="text/javascript" src="js/script.js"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>