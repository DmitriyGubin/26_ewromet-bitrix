<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component $arResult['SECTIONS']*/
$this->setFrameMode(true);

//debug($arResult['SECTIONS']);

$page = $APPLICATION->GetCurPage();

?>

<div class="title_line">
	<h1 class="titlee">Новости</h1>

	<div class="year_box">
		<div class="sort_butt" onclick="Sort_News();">
			<div>Сортировать по дате</div>
			<img class="sort_icon <?= ($_GET["method"] == 'desc' or $_GET["method"] == '') ? null : 'active'; ?>" src="/catalog/img/sort.svg">

			<div class="refs_box hide">
				<a class="prop_asc" href="<?= $page; ?>?method=asc"></a>
				<a class="prop_desc" href="<?= $page; ?>?method=desc"></a>
			</div>
		</div>
		<a href="/company/news/" class="year_item <?= ($page == '/company/news/') ? 'active' : null;  ?>">Все</a>

		<?php foreach ($arResult['SECTIONS'] as $sec_item): ?>
		<?php if($sec_item['ELEMENT_CNT'] != 0): ?>
		<?php $url = $sec_item['SECTION_PAGE_URL']; ?>
			<a href="<?= $url; ?>" class="year_item <?= ($page == $url) ? 'active' : null;  ?>">
				<?= $sec_item['NAME']; ?>
			</a>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
