<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои данные");

if (!$USER->IsAuthorized())
{
	header('Location: /');
	exit();
}

$user_obj = new CUser;
$user_mail = $user_obj -> GetEmail();
$user_login = $user_obj -> GetLogin();
$user_id = $user_obj -> GetID();

$user = Return_All_Users(Array('ID' => $user_id), Array())[0];
$user_passw = $user['PASSWORD'];
// $user_exit = $user['UF_EXIT_CAB'];
?>

<link href="css/styles.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_TEMPLATE_PATH."/includes/sub_menu_cabinet.php"
	)
);?>

<section class="my_data wrap top_box">
	<h1 class="cab_title">Мои данные</h1>

	<form class="my_data_form" id="my_data_form">
		<input type="hidden" name="user_id" value="<?= $user_id; ?>">
		<input name="hash" type="hidden" value="<?= $user_passw; ?>">
		<input type="hidden" name="type_of_form" value="Форма изменение данных пользователя">
		<div class="form_box univ_shadow">
			<div class="form_title">Данные для входа</div>

			<div class="univ_form_box">
				<input name="login" placeholder="Логин" type="text" class="univ_inp required login" value="<?= $user_login; ?>">
				<img class="univ_icon" src="img/inp_name.svg">
			</div>

			<div class="univ_form_box">
				<input name="mail" placeholder="Почта" type="text" class="univ_inp required req_mail" value="<?= $user_mail; ?>">
				<img class="univ_icon" src="img/inp_mail.svg">
			</div>

			<div class="form_title two">Изменение пароля</div>
			<div class="sub_title">
				Используйте пароль не менее 6 символов включая буквы, цифры и символы
			</div>

			<div class="univ_form_box passw">
				<input name="old_passw" placeholder="Старый пароль" type="text" class="univ_inp old_pass required" id="old_pass">
				<img class="univ_icon" src="img/inp_passw.svg">

				<div class="eye_box">
					<img class="inp_visible" src="img/inp_visible.svg">
					<img class="inp_no_visible hide" src="img/inp_no_visible.svg">
				</div>
			</div>

			<div class="univ_form_box passw">
				<input name="new_passw" placeholder="Новый пароль" type="text" class="univ_inp new_passw required">
				<img class="univ_icon" src="img/inp_passw.svg">

				<div class="eye_box">
					<img class="inp_visible" src="img/inp_visible.svg">
					<img class="inp_no_visible hide" src="img/inp_no_visible.svg">
				</div>
			</div>

			<div class="univ_form_box passw">
				<input placeholder="Повторите новый пароль" type="text" class="univ_inp required confirm_passw_my_data">
				<img class="univ_icon" src="img/inp_passw.svg">

				<div class="eye_box">
					<img class="inp_visible" src="img/inp_visible.svg">
					<img class="inp_no_visible hide" src="img/inp_no_visible.svg">
				</div>
			</div>

			<div class="error_mess hide">Ошиблись в заполнении формы</div>

			<button id="save_my_data" class="order_button">
				<div>Сохранить изменения</div>
				<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
				</svg>
			</button>
		</div>

		<div class="form_box univ_shadow two">
			<!-- <div class="form_title">Настройки профилия</div>

			<div class="toggle_box">
				<div class="univ_toggle <?= ($user_exit == 1) ? 'active' : null; ?>">
					<div class="toggle-btn"></div>
				</div>
				<div class="toggle_descr">Не выходить из личного кабинета</div>
				<input class="toggle_inp" type="hidden" name="exit_cab" value="<?= ($user_exit == 1) ? '1' : null; ?>">
			</div> -->

			<!-- <div class="toggle_box">
				<div class="univ_toggle">
					<div class="toggle-btn"></div>
				</div>
				<div class="toggle_descr">Получать уведомления о изменении статуса заказа</div>
			</div> -->

			<!-- <div class="toggle_box">
				<div class="univ_toggle">
					<div class="toggle-btn"></div>
				</div>
				<div class="toggle_descr">Получать новостные предложения и распродажи</div>
			</div> -->

			<div class="form_title">Настройки телефона</div>
			<div class="sub_title">Телефон пригодится для создания компаний</div>

			<div class="univ_form_box">
				<input value="<?= $user['PERSONAL_PHONE']; ?>" name="phone" placeholder="Телефон" type="text" class="univ_inp phone_inp required phone_no_req">
				<img class="univ_icon" src="img/inp_phone.svg">
			</div>

			<!-- <div class="toggle_box">
				<div class="univ_toggle">
					<div class="toggle-btn"></div>
				</div>
				<div class="toggle_descr">Уведомления о изменении статуса заказа на телефон</div>
			</div>

			<div class="toggle_box">
				<div class="univ_toggle">
					<div class="toggle-btn"></div>
				</div>
				<div class="toggle_descr">Предложения о распродажах и новостях</div>
			</div> -->
		</div>
	</form>
</section>

<script src="js/script.js" type="text/javascript"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>