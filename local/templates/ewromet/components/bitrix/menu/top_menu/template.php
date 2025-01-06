<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php //debug($arResult); ?>


<?php foreach ($arResult as $arItem): ?>
	<?php if($arItem['DEPTH_LEVEL'] == 1): ?>
		<?php if($arItem['LINK'] == "/company/"): ?>
			<li class="sub_menu_point">
				<div class="link_arrow">
					<a class="<?= $arItem['SELECTED'] ? 'active' : null; ?>" href="<?= $arItem['LINK']; ?>"><?= $arItem['TEXT']; ?></a>

					<svg class="arrow_menue show_mobile" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 6.5L6.5 1L12 6.5" stroke="#121419" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

				<div class="sub_menu_box hide">
					<ul class="sub_menu">
						<?php foreach ($arResult as $subItem): ?>
							<?php if($subItem['DEPTH_LEVEL'] == 2): ?>
							<li>
								<a class="<?= $subItem['SELECTED'] ? 'active' : null; ?>" href="<?= $subItem['LINK']; ?>">
									<?= $subItem['TEXT']; ?>
								</a>
							</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
			</li>
		<?php else: ?>
			<li>
				<a class="<?= $arItem['SELECTED'] ? 'active' : null; ?>" href="<?= $arItem['LINK']; ?>">
					<?= $arItem['TEXT']; ?>
				</a>
			</li>
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; ?>