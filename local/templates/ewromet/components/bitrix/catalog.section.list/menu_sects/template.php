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
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//debug($arResult['SECTIONS']);

$id_list = 403;

?>

<?php foreach ($arResult['SECTIONS'] as $secItem): ?>
	<?php if($secItem['DEPTH_LEVEL'] == 1): ?>
	<?php 
		$id_sec = $secItem['ID'];
		$main_img_path = $secItem['PICTURE']['SRC'];
	?>
		<?php if($id_sec == $id_list): ?>
			<?php 
				$decor_count = $secItem['ELEMENT_CNT'];
				$decor_url = $secItem['SECTION_PAGE_URL'];

				$imgs = Return_All_Sections(
					Array("IBLOCK_ID"=>18, "ACTIVE"=>"Y", "ID" => $id_list),
					Array("UF_IMG_EXAMPLES")
				)[0]["UF_IMG_EXAMPLES"];
				$counter = 0;
				//debug($imgs);
			?>
			<div class="<?= $secItem['CODE']; ?> sub_cat_box hide">
				<div class="cat_sub_box">
					<svg class="go_main_catalor_arrow show_mobile" width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M33 7H1M1 7L7 1M1 7L7 13" stroke="#121419" stroke-width="1.4"/>
					</svg>

					<a class="name_boxx" href="<?= $decor_url; ?>">
						<h2 class="cat_sub_title"><?= $secItem['NAME']; ?></h2>
						<div class="count_prod"><?= $decor_count; ?></div>
					</a>
				</div>

				<div class="var_box grid">
					<?php foreach($imgs as $img_item): ?>
					<?php 
						$counter++;
						if($counter == 9) break;
						$img_path = CFile::GetPath($img_item);
					?>
					<?php if($counter == 8): ?>
						<div class="var_item">
							<img class="texture obj-fit" src="<?= $img_path; ?>">
							<a class="more_texture" href="<?= $decor_url; ?>">
								<div>Больше</div>
								<svg width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 7H27M27 7L21 1M27 7L21 13" stroke="white" stroke-width="1.4"/>
								</svg>
							</a>
						</div>
					<?php else: ?>
						<div class="var_item">
							<img class="texture obj-fit" src="<?= $img_path; ?>">
						</div>
					<?php endif; ?>
					<?php endforeach; ?>
				</div>

				<div class="about_cat_box">
					<div class="left_box">
						<div>
							<div class="in_sale">В продаже</div>
							<div class="blue_count"><?= $decor_count ?> видов</div>
						</div>

						<a class="order_button" href="<?= $decor_url; ?>">
							<div>Смотреть все</div>
							<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
							</svg>
						</a>
					</div>

					<div class="right_text">
						<div class="text_wrap">
							<?= $secItem['~DESCRIPTION']; ?>
						</div>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="<?= $secItem['CODE']; ?> another_one sub_cat_box hide">
				<div class="cat_sub_box">
					<svg class="go_main_catalor_arrow show_mobile" width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M33 7H1M1 7L7 1M1 7L7 13" stroke="#121419" stroke-width="1.4"/>
					</svg>

					<a href="<?= $secItem['SECTION_PAGE_URL']; ?>" class="name_boxx">
						<h2 class="cat_sub_title"><?= $secItem['NAME']; ?></h2>
						<div class="count_prod"><?= $secItem['ELEMENT_CNT']; ?></div>
					</a>
				</div>

				<div class="var_box_anoth grid">
				<?php foreach ($arResult['SECTIONS'] as $subItem): ?>
				<?php if($subItem['IBLOCK_SECTION_ID'] == $id_sec): ?>
				<?php
					if($subItem['PICTURE'] != '')
					{
						$path = $subItem['PICTURE']['SRC'];
					}
					else if($main_img_path != '')
					{
						$path = $main_img_path;
					}
					else
					{
						$path = SITE_TEMPLATE_PATH.'/img/no_photo.png';
					}
				?>
					<a href="<?= $subItem['SECTION_PAGE_URL'] ?>" class="var_anoth_item">
						<img class="anoth_img" src="<?= $path; ?>">
						<h2 class="anoth_name">
							<?= $subItem['NAME']; ?>
						</h2>
						<div class="anoth_count"><?= $subItem['ELEMENT_CNT']; ?></div>
					</a>
				<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</div>   
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; ?>