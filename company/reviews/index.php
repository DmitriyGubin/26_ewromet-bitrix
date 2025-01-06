<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");

use Bitrix\Main\Page\Asset;

 Asset::getInstance()->addCss('/company/reviews/css/styles.css');
 Asset::getInstance()->addCss('/company/reviews/css/media.css');

 $rating = Return_All_Fields_Props(
		Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y"),
		Array()
	)[0]['props']['RATING_GIS_NUM']['VALUE'];

 //debug($rating);
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

<section class="reviews wrap">

	<div class="title_line">
		<h2 class="title">
			<div>
				<span class="dark_blue">Отзывы</span> клиентов
			</div>

			<div class="show_mobile all_rew write_rew">Написать отзыв</div>
		</h2>

		<div class="gis_ref">
			<div class="gis">
				<div class="gis_text">Честный рейтинг в</div>
				<img class="gis_img" src="/local/templates/ewromet/img/2_gis.svg">
				<div class="rating">
					<img src="/local/templates/ewromet/img/star.svg">
					<div class="rating_num"><?= $rating; ?></div>
				</div>
			</div>

			<div class="order_button write_rew">
				<div>Написать отзыв</div>
				<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
				</svg>
			</div>
		</div>
	</div>

	<div style="display: none;" class="reviews_form">

		<svg class="show_mobile write_rew mobile_cross" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M1 1L13 13M1 13L13 1" stroke="#B9B9F5"/>
		</svg>


		<div class="dark_blue form_title">
			Расскажите об опыте работы с нашей компанией
		</div>

		<form id="reviews_form">

			<input type="hidden" name="type_of_form" value="Форма рейтинга">

			<div class="grid form_grid">

				<div class="grid_item input">
					<input class="form_field required" placeholder="Как звать" type="text" name="name">
					<img class="field_img" src="img/inp_name.svg">
				</div>

				<div class="grid_item input">
					<input class="form_field required mail" placeholder="Электронная почта" type="text" name="mail">
					<img class="field_img" src="img/inp_mail.svg">
				</div>

				<div class="grid_item input">
					<input class="form_field" placeholder="Название компании" type="text" name="company">
					<img class="field_img" src="img/inp_houses.svg">
				</div>



				<div class="grid_item stars">
					<input type="hidden" name="rating" value="1" id="rating_inp">
					<div class="rew_title">Оценка</div>
					<div class="star_box">
						<svg class="form_star first" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14.5851 1.07381C14.9359 0.278667 16.0641 0.278664 16.4149 1.07381L20.0688 9.35594C20.214 9.68503 20.5247 9.91078 20.8826 9.94717L29.8885 10.8629C30.7531 10.9508 31.1017 12.0238 30.4539 12.6032L23.7062 18.6376C23.4381 18.8773 23.3194 19.2426 23.3954 19.5942L25.3075 28.4423C25.491 29.2918 24.5783 29.9549 23.8271 29.5178L16.0029 24.9651C15.692 24.7842 15.308 24.7842 14.9971 24.9651L7.17289 29.5178C6.42172 29.9549 5.50896 29.2918 5.69253 28.4423L7.60459 19.5942C7.68056 19.2426 7.56187 18.8773 7.29376 18.6376L0.546093 12.6032C-0.101732 12.0238 0.246913 10.9508 1.11154 10.8629L10.1174 9.94717C10.4753 9.91078 10.786 9.68503 10.9312 9.35594L14.5851 1.07381Z" fill="#C8D5EF"/>
						</svg>

						<svg class="form_star var" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14.5851 1.07381C14.9359 0.278667 16.0641 0.278664 16.4149 1.07381L20.0688 9.35594C20.214 9.68503 20.5247 9.91078 20.8826 9.94717L29.8885 10.8629C30.7531 10.9508 31.1017 12.0238 30.4539 12.6032L23.7062 18.6376C23.4381 18.8773 23.3194 19.2426 23.3954 19.5942L25.3075 28.4423C25.491 29.2918 24.5783 29.9549 23.8271 29.5178L16.0029 24.9651C15.692 24.7842 15.308 24.7842 14.9971 24.9651L7.17289 29.5178C6.42172 29.9549 5.50896 29.2918 5.69253 28.4423L7.60459 19.5942C7.68056 19.2426 7.56187 18.8773 7.29376 18.6376L0.546093 12.6032C-0.101732 12.0238 0.246913 10.9508 1.11154 10.8629L10.1174 9.94717C10.4753 9.91078 10.786 9.68503 10.9312 9.35594L14.5851 1.07381Z" fill="#C8D5EF"/>
						</svg>

						<svg class="form_star var" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14.5851 1.07381C14.9359 0.278667 16.0641 0.278664 16.4149 1.07381L20.0688 9.35594C20.214 9.68503 20.5247 9.91078 20.8826 9.94717L29.8885 10.8629C30.7531 10.9508 31.1017 12.0238 30.4539 12.6032L23.7062 18.6376C23.4381 18.8773 23.3194 19.2426 23.3954 19.5942L25.3075 28.4423C25.491 29.2918 24.5783 29.9549 23.8271 29.5178L16.0029 24.9651C15.692 24.7842 15.308 24.7842 14.9971 24.9651L7.17289 29.5178C6.42172 29.9549 5.50896 29.2918 5.69253 28.4423L7.60459 19.5942C7.68056 19.2426 7.56187 18.8773 7.29376 18.6376L0.546093 12.6032C-0.101732 12.0238 0.246913 10.9508 1.11154 10.8629L10.1174 9.94717C10.4753 9.91078 10.786 9.68503 10.9312 9.35594L14.5851 1.07381Z" fill="#C8D5EF"/>
						</svg>

						<svg class="form_star var" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14.5851 1.07381C14.9359 0.278667 16.0641 0.278664 16.4149 1.07381L20.0688 9.35594C20.214 9.68503 20.5247 9.91078 20.8826 9.94717L29.8885 10.8629C30.7531 10.9508 31.1017 12.0238 30.4539 12.6032L23.7062 18.6376C23.4381 18.8773 23.3194 19.2426 23.3954 19.5942L25.3075 28.4423C25.491 29.2918 24.5783 29.9549 23.8271 29.5178L16.0029 24.9651C15.692 24.7842 15.308 24.7842 14.9971 24.9651L7.17289 29.5178C6.42172 29.9549 5.50896 29.2918 5.69253 28.4423L7.60459 19.5942C7.68056 19.2426 7.56187 18.8773 7.29376 18.6376L0.546093 12.6032C-0.101732 12.0238 0.246913 10.9508 1.11154 10.8629L10.1174 9.94717C10.4753 9.91078 10.786 9.68503 10.9312 9.35594L14.5851 1.07381Z" fill="#C8D5EF"/>
						</svg>

						<svg class="form_star var" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14.5851 1.07381C14.9359 0.278667 16.0641 0.278664 16.4149 1.07381L20.0688 9.35594C20.214 9.68503 20.5247 9.91078 20.8826 9.94717L29.8885 10.8629C30.7531 10.9508 31.1017 12.0238 30.4539 12.6032L23.7062 18.6376C23.4381 18.8773 23.3194 19.2426 23.3954 19.5942L25.3075 28.4423C25.491 29.2918 24.5783 29.9549 23.8271 29.5178L16.0029 24.9651C15.692 24.7842 15.308 24.7842 14.9971 24.9651L7.17289 29.5178C6.42172 29.9549 5.50896 29.2918 5.69253 28.4423L7.60459 19.5942C7.68056 19.2426 7.56187 18.8773 7.29376 18.6376L0.546093 12.6032C-0.101732 12.0238 0.246913 10.9508 1.11154 10.8629L10.1174 9.94717C10.4753 9.91078 10.786 9.68503 10.9312 9.35594L14.5851 1.07381Z" fill="#C8D5EF"/>
						</svg>
					</div>
				</div>

				<div class="grid_item textarea">
					<textarea name="review" maxlength='300' class="form_field required" placeholder="Ваш приятный отзыв ..."></textarea>
					<img class="field_img" src="img/inp_comm.svg">
				</div>
			</div>

			<div class="last_line">

				<div class="text_box">
					<div class="polite col">
						Нажимая Отправить заявку мы руководствуемся <br> <a href="#">Политикой конфиденциальности</a>
						<span class="hide_mobile">и бережно храним данные</span>
					</div>

					<div class="negative col">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z" fill="#95A6C6"/>
							<path d="M8.5 12C9.32843 12 10 11.3284 10 10.5C10 9.67157 9.32843 9 8.5 9C7.67157 9 7 9.67157 7 10.5C7 11.3284 7.67157 12 8.5 12Z" fill="#95A6C6"/>
							<path d="M15.493 11.986C16.3176 11.986 16.986 11.3176 16.986 10.493C16.986 9.66844 16.3176 9 15.493 9C14.6684 9 14 9.66844 14 10.493C14 11.3176 14.6684 11.986 15.493 11.986Z" fill="#95A6C6"/>
							<path d="M12 14C9 14 8 17 8 17H16C16 17 15 14 12 14Z" fill="#95A6C6"/>
						</svg>

						<div class="neg_text">
							Если у вас есть негативный отзыв или вас не устроило качество
							сотрудничества – сообщите нам и мы примем меры!
						</div>
					</div>
				</div>

				<a class="order_button send" href="#">
					<div>Отправить заявку</div>
					<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#51607E" stroke-width="1.2"/>
					</svg>
				</a>

			</div>

		</form>
	</div>

	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"reviews_list", 
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "10",
			"IBLOCK_TYPE" => "ALL_CONTENT",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "N",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "8",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "main-pagination",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(
				0 => "POSITION",
				1 => "COMPANY",
				2 => "RATING",
				3 => "",
			),
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "Y",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"COMPONENT_TEMPLATE" => "reviews_list"
		),
		false
	);?>
</section>

<script type="text/javascript" src="js/script.js"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>