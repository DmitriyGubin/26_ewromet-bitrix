<div class="serv_box grid">
	<?php foreach ($serv_main as $serv_item): ?>
		<?php if($serv_item['fields']['IBLOCK_SECTION_ID'] == $main_sect_id): ?>
			<a href="<?= $serv_item['fields']['DETAIL_PAGE_URL']; ?>" class="serv_item">
				<div class="title_box">
					<div class="icon_title">
						<img src="<?= SITE_TEMPLATE_PATH ?>/img/icon_arr.svg">
						<h2 class="serv_title">
							<?= $serv_item['fields']['NAME']; ?>
						</h2>
					</div>

					<img src="<?= CFile::GetPath($serv_item['fields']['PREVIEW_PICTURE']); ?>" class="fon_img">
				</div>

				<div class="text_arrow">
					<div class="serv_text">
						<?= Сut_Text($serv_item['fields']['~PREVIEW_TEXT'], 100); ?>
					</div>
					<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.4"/>
					</svg>
				</div>
			</a>
		<?php endif; ?>
	<?php endforeach; ?>
</div> 