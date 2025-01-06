<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

use Bitrix\Main\Page\Asset;

 Asset::getInstance()->addCss('/company/vacancies/css/styles.css');
 Asset::getInstance()->addCss('/company/vacancies/css/media.css');
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

	$vacancy = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>11, "ACTIVE"=>"Y"),
		Array()
	);

	$sects = Return_All_Sections(
		Array("IBLOCK_ID"=>11, "ACTIVE"=>"Y"),
		Array('ID','NAME')
	);

	//debug(Counter_Section_Elements(204, $vacancy));
?>

<section class="vacancy wrap">
<?php foreach ($sects as $sec_item): ?>
	<?php $id_sec = $sec_item['ID']; ?>
	<?php if(Counter_Section_Elements($id_sec, $vacancy) != 0): ?>
		<h1 class="titlee">
			Вакансии в <span class="dark_blue"><?= mb_strtolower($sec_item['NAME']); ?></span>
		</h1>

		<?php foreach ($vacancy as $vac_item): ?>
		<?php if($vac_item['fields']['IBLOCK_SECTION_ID'] == $id_sec): ?>
			<?php 
				$props = $vac_item['props'];
				$id_item = $vac_item['fields']['ID'];
				$plus_id = $id_item.'_1';
				$minus_id = $id_item.'_2';
			?>
			<div class="tab_item">
				<div class="prevew">
					<svg class="count_butt plus" width="39" height="35" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
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

					<svg class="count_butt minus hide" width="39" height="35" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M39 1L10.6481 1C9.04267 1 7.59279 1.95986 6.96578 3.4378L1.66275 15.9378C1.23919 16.9362 1.23919 18.0638 1.66275 19.0622L6.96578 31.5622C7.59278 33.0401 9.04267 34 10.6481 34L39 34" stroke="url(#<?= $minus_id; ?>)"/>
						<path d="M15 18.5L15 16.5L31 16.5V18.5L15 18.5Z" fill="#121419"/>
						<defs>
							<linearGradient id="<?= $minus_id; ?>" x1="1" y1="18" x2="36" y2="18" gradientUnits="userSpaceOnUse">
								<stop stop-color="#D0D8E9"/>
								<stop offset="1" stop-color="white"/>
							</linearGradient>
						</defs>
					</svg>


					<div class="right_box">
						<div class="left_box">
							<div class="position tab_title">
								<?= $vac_item['fields']['NAME']; ?>
							</div>
							<div class="props">
								<div class="prop_item">
									<?= $props['CITY']['VALUE']; ?>
								</div>
								<div class="prop_item middle">
									<?= $props['EXPERIENCE']['VALUE']; ?>
								</div>
								<div class="prop_item">
									<?= $props['EMPLOYMENT_TYPE']['VALUE']; ?>
								</div>
							</div>

							<?php 
							$remark = $props['REMARK']['VALUE'];
							if($remark != ''):
							?>
								<div class="add_line">
									<?= $remark ?>
								</div>
							<?php endif; ?>
						</div>

						<div class="salary_box">
							<div class="salary_title">Заработная плата</div>
							<div class="price">
								<?= $props['WAGE']['VALUE']; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="descr" style="display: none;">
					<div class="delimeter"></div>

					<div class="descr_item">
						<div class="name">Обязанности</div>
						<div class="descr_text">
							<div class="text_wrap">
								<?= $props['RESPONS']['~VALUE']['TEXT']; ?>
							</div>
						</div>
					</div>

					<div class="descr_item">
						<div class="name">Требования</div>
						<div class="descr_text">
							<div class="text_wrap">
								<?= $props['REQUIRE']['~VALUE']['TEXT']; ?>
							</div>
						</div>
					</div>

					<div class="descr_item last">
						<div class="name">Условия</div>
						<div class="descr_text">
							<div class="text_wrap">
								<?= $props['CONDITIONS']['~VALUE']['TEXT']; ?>
							</div>

							<a class="order_button" data-fancybox="<?= $plus_id; ?>" data-src="#resume_popup" href="javascript:;">
		                <div>Отравить резюме</div>
		                <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
		                    <path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
		                </svg>
		            </a>
						</div>
					</div>



				</div>
			</div>
		<?php endif; ?>
		<?php endforeach; ?>

	<?php endif; ?>
<?php endforeach; ?>
</section>

<div style="display: none;" id="resume_popup">

	<svg id="close_resume_popup" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M1 1L25 25M1 25L25 1" stroke="#2D339D"/>
	</svg>

	<div class="form_only">
		<div class="pop_title">
			<div class="text">
				Резюме на должность – <span class="dark_blue title_pos">Инженер по технике безопасности</span>
			</div>
		</div>

		<form id="resume_form">

			<input type="hidden" name="position" id="type_of_vacancy">
			<input type="hidden" name="type_of_form" value="Форма резюме">

			<div class="grid form_grid">

				<div class="grid_item input">
					<input class="form_field required" placeholder="ФИО" type="text" name="name">
					<img class="field_img" src="img/inp_name.svg">
				</div>

				<div class="grid_item input">
					<input class="form_field phone_inp required phone" placeholder="Телефон" type="text" name="phone">
					<img class="field_img" src="img/inp_phone.svg">
				</div>

				<div class="grid_item input">
					<input class="form_field required mail" placeholder="Электронная почта" type="text" name="mail">
					<img class="field_img" src="img/inp_mail.svg">
				</div>

				<div class="grid_item resum_butt">
					<div class="resume_title">Прикрепить резюме</div>
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14 2H6C4.9 2 4.01 2.9 4.01 4L4 20C4 21.1 4.89 22 5.99 22H18C19.1 22 20 21.1 20 20V8L14 2ZM6 20V4H13V9H18V20H6Z" fill="#121419"/>
					</svg>
				</div>

				<div class="grid_item textarea">
					<textarea id="big_message" name="letter" maxlength='3000' class="form_field" placeholder="Сопроводительное письмо"></textarea>
					<img class="field_img" src="img/inp_comm.svg">
					<div class="lett_count"><span id="text_length">0</span> / 3000</div>
				</div>
			</div>

			<input class="hide required file" id="resume_input" type="file" name="resume">

			<div class="polite_butt">

				<div class="check_text">
					<div class="my-checkbox">
						<div class="galka"></div>
					</div>

					<div class="polite_text">
						Я согласен(а) на <a href="#">обработку персональных данных</a> <br>
						Ваши данные надежно хранятся с соотвествии с политикой конфиденциальности
					</div>  
				</div>



				<a class="order_button" href="#">
					<div>Отправить заявку</div>
					<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#51607E" stroke-width="1.2"/>
					</svg>
				</a>

			</div>

		</form>
	</div>

	<div class="success hide">
		<img class="succ_img" src="/local/templates/ewromet/img/success_img.svg">
		<div class="succ_title">Резюме отправлено</div>
		<div class="succ_text">
			Спасибо, что выбрали компанию Евромет. Наши специалисты  уже изучают ваше резюме и ответят в ближайшее время
		</div>
	</div>
</div>



<script type="text/javascript" src="js/script.js"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>