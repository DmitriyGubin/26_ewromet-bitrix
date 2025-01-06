<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

//debug($arResult);

$date = strtolower(FormatDate("d F Y", MakeTimeStamp($arResult['DATE_ACTIVE_FROM'])));

$date = explode(' ', $date);

//debug($date);

?>

<section class="news_detail wrap">
    <div class="date_box">
      <div class="day"><?= $date[0]; ?></div>
      <div class="month"><?= $date[1].' '.$date[2]; ?></div>
    </div>

    <div class="text_box">
      <div class="news_wrap">
      <h1 class="news_title"><?= $arResult['NAME']; ?></h1>

      <div class="all_text">
        <?= $arResult['~DETAIL_TEXT']; ?>
      </div>
      </div>
    </div>
</section>