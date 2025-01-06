<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php //debug($arResult); ?>

<?php foreach ($arResult as $arItem): ?>
	<?php if(($arItem['DEPTH_LEVEL'] == 1) and ($arItem['LINK'] != '/company/')): ?>
		<a class="<?= $arItem['SELECTED'] ? 'active' : null; ?> menu_title" href="<?= $arItem['LINK']; ?>">
			<?= $arItem['TEXT']; ?>
		</a>
	<?php endif; ?>
<?php endforeach; ?>