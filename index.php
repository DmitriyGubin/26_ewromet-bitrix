<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Евромет");

$banners = Return_All_Fields_Props(
    Array("IBLOCK_ID"=>20, "ACTIVE"=>"Y"),
    Array()
);

$inserts = Return_All_Fields_Props(
    Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y"),
    Array()
)[0]['props'];

//debug($inserts);
?>

 	<section class="top_banner wrap test">
        <div class="banner_slider">
        <?php foreach ($banners as $ban_item): ?>
            <div class="slide_item">
                <div class="del_text">
                    <div class="del">
                      <img class="slide_img" data-lazy="<?= CFile::GetPath($ban_item['fields']['PREVIEW_PICTURE']); ?>">
                    </div>
                    <div class="slide_text">
                        <h2 class="slide_title">
                            <?= $ban_item['fields']['NAME']; ?>
                        </h2>

                        <div class="text_button">
                            <div class="prew_text">
                                <?= $ban_item['fields']['~PREVIEW_TEXT']; ?>
                            </div>

                          <?php if($ban_item['props']['LEAVE_REQ']['VALUE'] == 'YES'): ?>
                            <div class="order_button">
                              <div>Оставить запрос</div>
                              <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
                              </svg>
                            </div>
                          <?php else: ?>
                            <div class="delimeter">
                            </div>

                            <a class="wats_box" target="_blank" href="<?= $GLOBALS['all_contacts']['WOTS']['VALUE']; ?>">
                                <img data-lazy="<?= SITE_TEMPLATE_PATH ?>/img/wats_white.svg">
                                <div class="whats_text">
                                    Мы на связи онлайн в <span>WhatsApp</span>
                                </div>
                            </a>
                          <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
  </section>

    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"sects_main_page", 
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "18",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "2",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/",
		"VIEW_MODE" => "LIST",
		"SHOW_PARENT_NAME" => "Y",
		"HIDE_SECTION_NAME" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"COMPONENT_TEMPLATE" => "sects_main_page",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
		"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "sectionsFilter",
		"CACHE_FILTER" => "N"
	),
	false
);?>


    <section class="metal_serv main wrap">
        <div class="title_line">
            <h2 class="title">
                Услуги по <span class="dark_blue">металлообработке</span>
            </h2>
            
            <div class="order_button">
                <div>Оставить заявку</div>
                <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"/>
                </svg>
            </div>
        </div>

        <?php 

          $serv_main = Return_All_Fields_Props(
           Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y"),
           Array()
         );

          $main_sect_id = 199;
          $add_sect_id = 200;

          require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/services_metal.php");
        ?>

        <div class="add_serv_box grid">
            <a target="_blank" href="<?= SITE_TEMPLATE_PATH ?>/docs/Прайс на услуги.pdf" class="add_serv price">
              <div class="img_title">
                <img class="price_img" src="<?= SITE_TEMPLATE_PATH ?>/img/serv_price.svg">
                <div class="add_title">Скачать прайс-лист на услуги</div>
              </div>

              <div class="update hide">Обновлен 3 апреля</div>
            </a>


            <?php foreach ($serv_main as $serv_item): ?>
            <?php if($serv_item['fields']['IBLOCK_SECTION_ID'] == $add_sect_id): ?>
            <a class="add_serv serv" href="<?= $serv_item['fields']['DETAIL_PAGE_URL']; ?>">
                <img class="fon_add_img" src="<?= CFile::GetPath($serv_item['fields']['PREVIEW_PICTURE']); ?>">
                <div class="add_title"><?= $serv_item['fields']['NAME']; ?></div>
            </a>
            <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </section>

    <section class="about wrap">
        <h2 class="title">
            Оптовая <span class="dark_blue">компания</span>
        </h2>

        <div class="about_text">
            <div class="text_boxx">
                <?= $inserts['OPT_TEXT']['~VALUE']['TEXT']; ?>
            </div>
            
            <?php 

              $class = '';
              require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/num_year_cat.php");

            ?>
        </div>

        <div class="blue_about_box">
            <div class="left_text">
                <div class="sub_title">
                    Евромет – это широкий выбор металла
                </div>
                <div class="box_text">
                    <?= $inserts['BLUE_BOX_TEXT']['~VALUE']['TEXT']; ?>
                </div>

                <div class="butt_wats">
                    <a class="order_button" href="/catalog/">
                        <div>Смотреть каталог</div>
                        <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
                        </svg>
                    </a>

                    <a class="wats_box" target="_blank" href="<?= $GLOBALS['all_contacts']['WOTS']['VALUE']; ?>">
                        <img class="wats_img" src="<?= SITE_TEMPLATE_PATH ?>/img/whats_white.svg">
                        <div class="whats_text">
                            Связаться <br>
                            с нами в <span>WhatsApp</span>
                        </div>              
                    </a>
                </div>
            </div>

            <img class="pipes" src="<?= SITE_TEMPLATE_PATH ?>/img/pipes.svg">
        </div>

        <div class="num_box">
            <div class="num_item logo">
                 <img class="logo" src="<?= SITE_TEMPLATE_PATH ?>/img/logo_num.svg">
            </div>

            <?php 

              $class = 'hide';
              require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/all_numbers.php");

            ?>
        </div>

        <div class="partners_title hide">
          Наши партнеры и клиенты
        </div>

        <?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => SITE_TEMPLATE_PATH."/includes/companies_box.php"
			)
		);?>

    <?php 

      $num_letters = 245;
      $all_text = $inserts['FORCE_TEXT']['~VALUE']['TEXT'];
      $str_len = strlen($all_text);

    ?>

        <div class="img_text_box">
            <img class="stanok_img" src="<?= SITE_TEMPLATE_PATH ?>/img/stanok.png">
            <div class="text_box">
                <h2 class="title">
                    Наша сильная сторона <span class="dark_blue"> <br> в металлообработке</span>
                </h2>

                <div class="text">
                <?php if($str_len > $num_letters): ?>
                    <span><?= mb_substr($all_text, 0, $num_letters); ?></span>
                    <span class="more_text hide">&nbsp;Показать все ... </span>
                    <span class="hide_text"><?= mb_substr($all_text, $num_letters); ?></span>
                <?php else: ?>
                    <span><?= $all_text; ?></span>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="reviews wrap">
        <div class="title_line">
            <h2 class="title">
            	<div>
            		 <span class="dark_blue">Отзывы</span> клиентов
            	</div>
               
               <a href="/company/reviews/" class="show_mobile all_rew">Все отзывы</a>
            </h2>
            
            <div class="gis_ref">
                <div class="gis">
                    <div class="gis_text">Честный рейтинг в</div>
                    <img class="gis_img" src="<?= SITE_TEMPLATE_PATH ?>/img/2_gis.svg">
                    <div class="rating">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/star.svg">
                        <div class="rating_num"><?= $inserts['RATING_GIS_NUM']['VALUE']; ?></div>
                    </div>
                </div>

                <a class="order_button" href="/company/reviews/">
                    <div>Написать отзыв</div>
                    <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
                    </svg>
                </a>
            </div>
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

        <a class="order_button hide" href="/company/reviews/">
        	<div>Написать отзыв</div>
        	<svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        		<path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
        	</svg>
        </a>
    </section>

 	<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/main_page.js"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>