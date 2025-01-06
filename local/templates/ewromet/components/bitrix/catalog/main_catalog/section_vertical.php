<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

//debug($arResult);
?>


<?if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = $arParams['COMMON_ADD_TO_BASKET_ACTION'] ?? '';
}
else
{
	$basketAction = $arParams['SECTION_ADD_TO_BASKET_ACTION'] ?? '';
}
?>

	<section class="filter_boxx wrap top_box">

        <?
        $sectionListParams = array(
        	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
        	"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
        	"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
        	"CACHE_TIME" => $arParams["CACHE_TIME"],
        	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        	"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        	"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
        	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        	"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
        	"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
        	"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
        	"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
        );
        if ($sectionListParams["COUNT_ELEMENTS"] === "Y")
        {
        	$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
        	if ($arParams["HIDE_NOT_AVAILABLE"] == "Y")
        	{
        		$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
        	}
        }
        $APPLICATION->IncludeComponent(
        	"bitrix:catalog.section.list",
        	"sub_sections",
        	$sectionListParams,
        	$component,
        	array("HIDE_ICONS" => "Y")
        );
        unset($sectionListParams);
        //debug($GLOBALS['hide_products']);
        ?>


        <div class="res_box <?= $GLOBALS['hide_products'] ? 'hide' : null; ?>">
            <div class="left_box">
                <div class="sticky_box">
                    <div class="small_title">Расширенный поиск</div>
                    <?
    					$APPLICATION->IncludeComponent(
    						"bitrix:catalog.smart.filter",
    						"smart_filter",
    						array(
    							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
    							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
    							"SECTION_ID" => $arCurSection['ID'],
    							"FILTER_NAME" => $arParams["FILTER_NAME"],
    							"PRICE_CODE" => $arParams["~PRICE_CODE"],
    							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
    							"CACHE_TIME" => $arParams["CACHE_TIME"],
    							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
    							"SAVE_IN_SESSION" => "N",
    							"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
    							"XML_EXPORT" => "N",
    							"SECTION_TITLE" => "NAME",
    							"SECTION_DESCRIPTION" => "DESCRIPTION",
    							'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
    							"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
    							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
    							'CURRENCY_ID' => $arParams['CURRENCY_ID'],
    							"SEF_MODE" => $arParams["SEF_MODE"],
    							"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
    							"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
    							"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
    							"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
    						),
    						$component,
    						array('HIDE_ICONS' => 'Y')
    					);
    				?>

                    <a target="_blank" href="<?= SITE_TEMPLATE_PATH ?>/docs/Прайс на продукцию.pdf" class="load_price_box">
                        <img class="price_icon" src="/catalog/img/price_icon.svg">
                        <div class="text_box">
                            <div class="title_price">
                                Скачать прайс-лист 
                                всей продукции
                            </div>      
                            
                            <div class="sub_title_price">
                                Обновлен 3 апреля
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="right_box">

              <div class="table_wrap">
                <div class="table_box">
                  <?php $page = $APPLICATION->GetCurPage(); ?>

                  <div class="table_head" style="display: none;">
                    <div class="one_col">
                      <?php $rule = (($_GET["method"] == 'asc') and ($_GET["sort"] == "name")); ?>
                      <div class="sort_box sort <?= ($_GET["sort"] == "name") ? 'active' : null; ?>">
                        <div class="small_title">Наименование</div>
                        <img class="filt_icon <?= $rule ? null : 'active'; ?>" src="/catalog/img/sort.svg">

                        <div class="refs_box hide">
                          <a class="prop_asc" href="<?= $page; ?>?sort=name&method=asc"></a>
                          <a class="prop_desc" href="<?= $page; ?>?sort=name&method=desc"></a>
                        </div>
                      </div>

                    </div>

                    <div class="add_col">
                      <div class="sort_box sort">
                        <div class="small_title">
                            Характеристика 
                        </div>
                        <img class="filt_icon hide" src="/catalog/img/sort.svg">
                      </div>
                    </div>

                    <div class="two_col">
                    <?php $rule = (($_GET["method"] == 'asc') and ($_GET["sort"] == "property_BREND")); ?>

                      <div class="sort_box sort <?= ($_GET["sort"] == "property_BREND") ? 'active' : null; ?>">
                        <div class="small_title">Марка стали</div>
                        <img class="filt_icon <?= $rule ? null : 'active'; ?>" src="/catalog/img/sort.svg">

                        <div class="refs_box hide">
                          <a class="prop_asc" href="<?= $page; ?>?sort=property_BREND&method=asc"></a>
                          <a class="prop_desc" href="<?= $page; ?>?sort=property_BREND&method=desc"></a>
                        </div>
                      </div>
                    </div>

                    <div class="three_col">
                    <?php $rule = (($_GET["method"] == 'asc') and ($_GET["sort"] == "catalog_PRICE_1")); ?>

                      <div class="sort_box sort <?= ($_GET["sort"] == "catalog_PRICE_1") ? 'active' : null; ?>">
                        <div class="small_title">Цена</div>
                        <img class="filt_icon <?= $rule ? null : 'active'; ?>" src="/catalog/img/sort.svg">

                        <div class="refs_box hide">
                          <a class="prop_asc" href="<?= $page; ?>?sort=catalog_PRICE_1&method=asc"></a>
                          <a class="prop_desc" href="<?= $page; ?>?sort=catalog_PRICE_1&method=desc"></a>
                        </div>
                      </div>
                    </div>

                    <div class="four_col count_box">
                      <div class="sort_box count_box">
                        <div class="small_title">Количество</div>
                      </div>
                    </div>
                  </div>

                  <?

                  // сортировка
                  $sortField = 'name'; // поле сортировки по умолчанию
                  $sortOrder = 'desc'; // направление сортировки по умолчанию ASC desc

                  if (isset($_GET["sort"]) && isset($_GET["method"]))
                  {
                    $sortField = $_GET["sort"];
                    $sortOrder = $_GET["method"];
                  }


                  $APPLICATION->IncludeComponent(
                   "bitrix:catalog.section",
                   "products",
                   array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "ELEMENT_SORT_FIELD" => $sortField,
                    "ELEMENT_SORT_ORDER" => $sortOrder,
                    "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                    "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                    "PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
                    "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                    "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                    "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                    "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                    "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                    "BASKET_URL" => $arParams["BASKET_URL"],
                    "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                    "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                    "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                    "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                    "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "SET_TITLE" => $arParams["SET_TITLE"],
                    "MESSAGE_404" => $arParams["~MESSAGE_404"],
                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                    "SHOW_404" => $arParams["SHOW_404"],
                    "FILE_404" => $arParams["FILE_404"],
                    "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                    "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                    "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                    "PRICE_CODE" => $arParams["~PRICE_CODE"],
                    "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                    "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                    "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                    "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                    "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                    "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                    "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

                    "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                    "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                    "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                    "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                    "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                    "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                    "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                    "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                    "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                    "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                    "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
                    "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                    "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
                    "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                    "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                    "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                    "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                    "OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

                    "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                    "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                    'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                    'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                    'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                    'LABEL_PROP' => $arParams['LABEL_PROP'],
                    'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                    'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'] ?? '',
                    'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                    'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                    'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                    'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                    'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                    'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                    'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                    'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                    'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                    'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                    'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                    'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                    'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                    'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                    'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                    'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                    'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                    'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                    'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                    'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                    'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                    'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                    'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                    'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                    'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
                    'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
                    'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                    'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                    'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                    'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                    'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                    "ADD_SECTIONS_CHAIN" => "N",
                    'ADD_TO_BASKET_ACTION' => $basketAction,
                    'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                    'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                    'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                    'USE_COMPARE_LIST' => 'Y',
                    'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                    'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                    'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
                  ),
                  $component
                  );
                  ?>
                </div>
              </div>

            </div>
        </div>
    </section>

    <?php 
        $form_title = "Поможем собрать или определиться с заказом";
        require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/help_form.php");
    ?>

    <?php
    /***описание для раздела***/ 
    $this_sec = Return_All_Sections(
        Array("IBLOCK_ID"=>18, "ACTIVE"=>"Y", "ID" => $arCurSection['ID']),
        Array('UF_LEFT_DESCR', 'UF_RIGHT_DESCR')
    );

            //debug($this_sec);

    $num_letters = 320;
    $all_text = $this_sec[0]['~DESCRIPTION'];
    $str_len = strlen($all_text);

    $id_pic = $this_sec[0]['DETAIL_PICTURE'];
    $path = CFile::GetPath($id_pic);

    if($id_pic != '')
    {
        $path_one = $path;
        $path_two = $path;
    }
    else
    {
        $path_one = '/catalog/img/sub_img.png';
        $path_two = '/catalog/img/all_pipes.png';
    }

    $left_arr = explode('%%%', $this_sec[0]['UF_LEFT_DESCR']);
    $right_arr = explode('%%%', $this_sec[0]['UF_RIGHT_DESCR']);
    //debug(count($left_arr));
    //UF_RIGHT_DESCR
    /***описание для раздела***/
    ?>

    <section class="about_sect wrap <?= $GLOBALS['hide_products'] ? 'hide' : null; ?>">
      <div class="text_box">
        <h2 class="sub_title"><?= $this_sec[0]['NAME']; ?></h2>
        <div class="all_text">
          <?= $all_text; ?>
        </div>
      </div>
      <img class="right_img" src="<?= $path_two; ?>">
    </section>

    <section class="about_sub_cat wrap <?= !$GLOBALS['hide_products'] ? 'hide' : null; ?>">
        <div class="img_text">
            <img class="sub_img" src="<?= $path_one; ?>">
            <div class="text_box">
                <h2 class="sub_title"><?= $this_sec[0]['NAME']; ?></h2>
                <?php if($str_len > $num_letters): ?>
                <div class="sub_text">
                    <?= mb_substr($all_text, 0, $num_letters); ?>
                    <div class="show_mobile more_text">Читать еще ...</div>
                    <span class="hide_text">
                    <?= mb_substr($all_text, $num_letters); ?>
                    </span>
                </div>
                <?php else: ?>
                    <?= $all_text; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="two_col">
            <?php if(count($left_arr) == 2): ?>
            <div class="col">
                <div class="col_title"><?= $left_arr[0]; ?></div>
                <div class="sub_text">
                    <?= $left_arr[1]; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if(count($right_arr) == 2): ?>
            <div class="col">
                <div class="col_title"><?= $right_arr[0]; ?></div>
                <div class="sub_text">
                    <?= $right_arr[1]; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <script type="text/javascript">
        $('.about_sub_cat .more_text').on('click', function(){
            $(this).remove();
            $('.about_sub_cat .hide_text').slideToggle(600);
        });
    </script>


