<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?>

<h2 class="wrap" style="font-size: 50px; text-align: center;">Страница не найдена или в разработке</h2>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>