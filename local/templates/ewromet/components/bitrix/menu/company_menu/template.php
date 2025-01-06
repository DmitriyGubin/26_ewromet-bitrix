<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php //debug($arResult); ?>


<?php foreach ($arResult as $arItem): ?>
	<?php if($arItem['DEPTH_LEVEL'] == 2): ?>
	<li>
		<a class="<?= $arItem['SELECTED'] ? 'active' : null; ?>" href="<?= $arItem['LINK']; ?>">
			<?= $arItem['TEXT']; ?>
		</a>
	</li>
	<?php endif; ?>
<?php endforeach; ?>