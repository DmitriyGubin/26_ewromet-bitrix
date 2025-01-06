<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список заказов");

if (!$USER->IsAuthorized())
{
	header('Location: /');
	exit();
}


$count = Return_Count_Orders();

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

<?php if($count == 0): ?>
	<section class="my_orders wrap top_box univ_table">
		<div class="empty_basket">
			<div class="empty_list">
				<div class="box">
					<img class="emty_img" src="img/empty_basket.svg">
					<div class="empty_sub">Вы еще ничего не заказывали</div>
					<a class="go_back" href="/catalog/">Смотерть каталог</a>
				</div>
			</div>
		</div>
	</section>
<?php else: ?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:sale.personal.order.list", 
		"orders_list", 
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "3600",
			"CACHE_TYPE" => "A",
			"DEFAULT_SORT" => "STATUS",
			"DISALLOW_CANCEL" => "N",
			"HISTORIC_STATUSES" => array(
				0 => "F",
			),
			"ID" => $ID,
			"NAV_TEMPLATE" => "main-pagination",
			"ORDERS_PER_PAGE" => "1000",
			"PATH_TO_BASKET" => "/basket/",
			"PATH_TO_CANCEL" => "",
			"PATH_TO_CATALOG" => "/catalog/",
			"PATH_TO_COPY" => "",
			"PATH_TO_DETAIL" => "",
			"PATH_TO_PAYMENT" => "payment.php",
			"REFRESH_PRICES" => "N",
			"RESTRICT_CHANGE_PAYSYSTEM" => array(
				0 => "0",
			),
			"SAVE_IN_SESSION" => "Y",
			"SET_TITLE" => "Y",
			"STATUS_COLOR_F" => "gray",
			"STATUS_COLOR_N" => "green",
			"STATUS_COLOR_P" => "yellow",
			"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
			"COMPONENT_TEMPLATE" => "orders_list"
		),
		false
	);?>
<?php endif; ?>

<script type="text/javascript" src="js/script.js"></script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>