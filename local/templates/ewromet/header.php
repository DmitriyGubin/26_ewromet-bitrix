<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
    use Bitrix\Main\Page\Asset;

    Bitrix\Main\Loader::includeModule("sale");
    Bitrix\Main\Loader::includeModule("catalog");

    $GLOBALS['ids_bask_prods'] = Return_Products_Id_In_Basket();//id товаров в корзине, важно
    $page = $APPLICATION->GetCurPage();
?>

<!DOCTYPE html> 
<html lang="ru">
<head>
	<?php $APPLICATION->ShowHead() ?>
	<title><?php $APPLICATION->ShowTitle() ?></title>
	<?php
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/styles.css');
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1">');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/libraries/jquery-3.6.0.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/libraries/jquery.mask.min.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/libraries/jquery.nicescroll.min.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/functions.js');

        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/libraries/fancybox/jquery.fancybox.min.css');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/libraries/fancybox/jquery.fancybox.min.js');

        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/libraries/slick/slick.min.js');
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/libraries/slick/slick.css');
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/libraries/slick/slick-theme.css');
    ?>
</head>
<body>
    <?php 

       $GLOBALS['all_contacts'] = Return_All_Fields_Props(
            Array("IBLOCK_ID"=>21, "ACTIVE"=>"Y"),
            Array()
        )[0]['props'];

       //debug($GLOBALS['all_contacts']);

    ?>

    <div class="menu_shade" style="display: none;"></div>

    <div class="cabinet_shade" style="display: none;"></div>

    <div class="main_wrapper">
    <div class="header_content">
    <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>

    <div class="header_delimeter"></div>

    <header class="">
        <div class="top_menu hide_scroll">
            <div class="wrap">

            	<?
            	$class = "show_mobilee";
            	$price_name = "На услуги";
            	require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/price_docs_box.php");
            	?>

            	<!-- Меню каталога -->

            	<?php

                $sects = Return_All_Sections(
                    Array("IBLOCK_ID"=>18, "ACTIVE"=>"Y"),
                    Array()
                );

            	//debug($sects_mob);

            	$serv_main = Return_All_Fields_Props(
            		Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>199),
            		Array()
            	);

                //debug($serv_main);

            	?>

            	<?php foreach ($sects as $sec_item): ?>
            	<?php if($sec_item['DEPTH_LEVEL'] == 1): ?>
            	<?php 
            		$img_path = SITE_TEMPLATE_PATH.'/img/no_photo.png';
            		$file_id = $sec_item['PICTURE'];
            		if($file_id != '')
            		{
            			$img_path = CFile::GetPath($file_id);
            		}
            	?>
            	<div class="univ_shadow cat_item sects show_mobile" id="<?= $sec_item['CODE'].'_888'; ?>">
            		<div class="cat_name"><?= $sec_item['NAME']; ?></div>
            		<div class="img_box">
            			<img class="cat_img" src="<?= $img_path; ?>">
            		</div>
            	</div>
            	<?php endif; ?>
            	<?php endforeach; ?>

            	<div class="univ_shadow cat_item serv show_mobile">
            		<div class="name_arrow">
	            		<div class="cat_name">Услуги металлопроката</div>
	            		<svg class="serv_arrow" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
	            			<path d="M1 7L6.5 1.5L12 7" stroke="#121419" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
	            		</svg>
            		</div>

            		<div class="var_box" style="display: none;">
            			<?php foreach ($serv_main as $serv_item): ?>
            				<a class="var_item" href="<?= $serv_item['fields']['DETAIL_PAGE_URL']; ?>">
            					<?= $serv_item['fields']['NAME']; ?>
            				</a>
            			<?php endforeach; ?>
            		</div>

            	</div>

                <ul class="menu_box">
                    
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top_menu",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "section",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "N"
                        )
                    );?>
                </ul>

                <?php 
                    $phone = $GLOBALS['all_contacts']['PHONE']['VALUE'];
                    $mail = $GLOBALS['all_contacts']['MAIL']['VALUE'];
                    $addres = $GLOBALS['all_contacts']['ADRESS']['~VALUE']['TEXT'];
                ?>

                <div class="phone_box sub_menu_point">
                    <img class="hide_mobile" src="<?= SITE_TEMPLATE_PATH ?>/img/phone_icon.svg">
                    <a class="phone hide_mobile" href="tel:<?= $phone; ?>">
                        <?= $phone; ?>
                    </a>
                    <svg class="hide_mobile" width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5.5 5.5L10 1" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <div class="contacts sub_menu_box hide">
                        <div class="sub_menu">
                            <div class="cont_remark">По всем вопросам</div>
                            
                            <a class="cont_item" href="tel:<?= $phone; ?>">
                            	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            		<path class="change_color_svg" d="M20 15.5C18.75 15.5 17.55 15.3 16.43 14.93C16.2542 14.874 16.0664 14.8667 15.8868 14.909C15.7072 14.9513 15.5424 15.0415 15.41 15.17L13.21 17.37C10.3739 15.9272 8.06711 13.6239 6.62 10.79L8.82 8.58C9.1 8.31 9.18 7.92 9.07 7.57C8.69065 6.41806 8.49821 5.2128 8.5 4C8.5 3.45 8.05 3 7.5 3H4C3.45 3 3 3.45 3 4C3 13.39 10.61 21 20 21C20.55 21 21 20.55 21 20V16.5C21 15.95 20.55 15.5 20 15.5Z" fill="white"/>
                            		<path d="M12 3V13L15 10H21V3H12Z" fill="#80899B"/>
                            	</svg>
                                <div class="item_text phone"><?= $phone; ?></div>
                            </a>

                            <a class="cont_item" href="mailto:<?= $mail; ?>">
                            	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            		<path class="change_color_svg" d="M12 1.94995C6.48 1.94995 2 6.42995 2 11.95C2 17.47 6.48 21.95 12 21.95H17V19.95H12C7.66 19.95 4 16.29 4 11.95C4 7.60995 7.66 3.94995 12 3.94995C16.34 3.94995 20 7.60995 20 11.95V13.38C20 14.17 19.29 14.95 18.5 14.95C17.71 14.95 17 14.17 17 13.38V11.95C17 9.18995 14.76 6.94995 12 6.94995C9.24 6.94995 7 9.18995 7 11.95C7 14.71 9.24 16.95 12 16.95C13.38 16.95 14.64 16.39 15.54 15.48C16.19 16.37 17.31 16.95 18.5 16.95C20.47 16.95 22 15.35 22 13.38V11.95C22 6.42995 17.52 1.94995 12 1.94995ZM12 14.95C10.34 14.95 9 13.61 9 11.95C9 10.29 10.34 8.94995 12 8.94995C13.66 8.94995 15 10.29 15 11.95C15 13.61 13.66 14.95 12 14.95Z" fill="white"/>
                            	</svg>
                                <div class="item_text"><?= $mail; ?></div>
                            </a>

                            <div class="cont_item">
                            	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            		<path class="change_color_svg" d="M18.9998 2H8.99979C7.89679 2 6.99979 2.897 6.99979 4V9.586L2.29279 14.293C2.15298 14.4329 2.05777 14.611 2.0192 14.805C1.98064 14.9989 2.00044 15.2 2.07611 15.3827C2.15178 15.5654 2.27992 15.7215 2.44433 15.8314C2.60874 15.9413 2.80204 16 2.99979 16V21C2.99979 21.2652 3.10514 21.5196 3.29268 21.7071C3.48022 21.8946 3.73457 22 3.99979 22H19.9998C20.265 22 20.5194 21.8946 20.7069 21.7071C20.8944 21.5196 20.9998 21.2652 20.9998 21V4C20.9998 2.897 20.1028 2 18.9998 2ZM10.9998 20H4.99979V14.414L7.99979 11.414L10.9998 14.414V20ZM18.9998 20H12.9998V16C13.1978 16.0004 13.3914 15.942 13.5561 15.8322C13.7208 15.7224 13.8492 15.5662 13.925 15.3833C14.0007 15.2004 14.0204 14.9991 13.9816 14.805C13.9427 14.6109 13.8471 14.4327 13.7068 14.293L8.99979 9.586V4H18.9998V20Z" fill="white"/>
                            		<path class="change_color_svg" d="M11 6H13V8H11V6ZM15 6H17V8H15V6ZM15 10.031H17V12H15V10.031ZM15 14H17V16H15V14ZM7 15H9V17H7V15Z" fill="white"/>
                            	</svg>

                                <div class="item_text"><?= $addres; ?></div>
                            </div>

                            <div class="cont_remark">ПН–ПТ с <?= $GLOBALS['all_contacts']['WORK_HOURS']['VALUE']; ?></div>

                            <a href="/contacts/" class="all_cont_ref hide_mobile">
                                <div class="item_text">Все контакты</div>
                                <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="white" stroke-width="1.4"/>
                                </svg>
                            </a> 
                        </div>
                    </div>
                </div>

                <?
                	$class = "show_mobile";
                    $title = "Социальные сети";
                	require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/social_box.php");
                ?>

                <div class="button_line show_mobile">
                	<button id="go_to_cab_mob">Кабинет</button>
                	<button id="call_order_mob_menu">Заказать звонок</button>
                </div>
            </div>
        </div>
        
        <div class="wrap">
            <!-- active_serch -->
            <div class="middle">
                <div class="show_mobile burger_loopa">
                    <div class="burger">
                        <div class="top_line"></div>
                        <div class="middle_line"></div>
                        <div class="bottom_line"></div>
                    </div>

                    <svg id="mobile_search_loopa" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.6713 18.0877L14.9812 13.3961C16.2618 11.7124 16.8551 9.605 16.6412 7.50032C16.4273 5.39563 15.4222 3.45078 13.8292 2.05923C12.2361 0.667687 10.1741 -0.0666606 8.06036 0.00476101C5.94658 0.0761827 3.93883 0.948041 2.44332 2.44395C0.947796 3.93985 0.076163 5.94811 0.00475978 8.06244C-0.0666435 10.1768 0.667514 12.2393 2.0587 13.8327C3.44989 15.4262 5.39424 16.4316 7.49838 16.6455C9.60252 16.8594 11.7094 16.266 13.3926 14.9851L18.0827 19.6767C18.2952 19.884 18.5802 20 18.877 20C19.1738 20 19.4588 19.884 19.6713 19.6767C19.8818 19.4659 20 19.1801 20 18.8822C20 18.5842 19.8818 18.2985 19.6713 18.0877ZM2.30743 8.37199C2.30743 7.17212 2.66314 5.99919 3.32958 5.00153C3.99602 4.00388 4.94326 3.2263 6.05152 2.76712C7.15977 2.30795 8.37926 2.18781 9.55577 2.4219C10.7323 2.65598 11.813 3.23377 12.6612 4.08221C13.5094 4.93065 14.0871 6.01163 14.3211 7.18845C14.5551 8.36526 14.435 9.58507 13.976 10.6936C13.5169 11.8021 12.7395 12.7496 11.7421 13.4162C10.7447 14.0829 9.57209 14.4387 8.37253 14.4387C6.76455 14.4368 5.22297 13.797 4.08596 12.6597C2.94894 11.5224 2.30933 9.98039 2.30743 8.37199Z" fill="#121419"/>
                    </svg>
                </div>

                <a href="/" class="show_mobile">
                    <svg width="44" height="26" viewBox="0 0 44 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.77777 8.68283H20.2222V5.79395H5.77777V8.68283Z" fill="#2F2FA1"/>
                        <path d="M14.4444 11.5718H5.77777V14.4607H14.4444V11.5718Z" fill="#2F2FA1"/>
                        <path d="M5.77777 20.2385H20.2222V17.3496H5.77777V20.2385Z" fill="#2F2FA1"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M43.3333 0V26H0V0H43.3333ZM40.4444 23.1111V2.88889H2.88889V23.1111H40.4444Z" fill="#2F2FA1"/>
                        <path d="M34.6667 5.79395V20.2384H37.5556V5.79395H34.6667Z" fill="#2F2FA1"/>
                        <path d="M28.8889 20.2384H31.7778V11.5557H28.8889V20.2384Z" fill="#2F2FA1"/>
                        <path d="M23.1111 20.2223H26V5.79395H23.1111V20.2223Z" fill="#2F2FA1"/>
                    </svg>
                </a>

                <div class="for_mobile">
                    <a class="hide_scroll logo_desctop" href="/">
                        <img class="top_logo" src="<?= SITE_TEMPLATE_PATH ?>/img/logo.svg">
                    </a>

                    <?php
                    /**важно**/ 
                    $GLOBALS['hide_scroll'] = 'hide_scroll'; 
                    $GLOBALS['hide_inp'] = ''; 
                    ?>

                    <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"serch_box", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_1c_catalog",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_1c_catalog" => array(
			0 => "18",
		),
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "rank",
		"PAGE" => "",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5000",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "serch_box",
		"TEMPLATE_THEME" => "blue",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "N",
		"CONVERT_CURRENCY" => "N",
		"CATEGORY_1_TITLE" => "",
		"CATEGORY_1" => "",
		"CATEGORY_2_TITLE" => "",
		"CATEGORY_2" => "",
		"CATEGORY_3_TITLE" => "",
		"CATEGORY_3" => "",
		"CATEGORY_4_TITLE" => "",
		"CATEGORY_4" => ""
	),
	false
);?>

                    <?
                    	$class = "hide_mobile";
                    	$price_name = "Прайс на услуги";
                    	require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/price_docs_box.php");
                    ?>

                    <a class="show_scroll" href="/">
                        <img class="top_logo_scroll" src="<?= SITE_TEMPLATE_PATH ?>/img/scroll_logo.svg">
                    </a>

                    <ul class="catalog_nav show_scroll">
                        <?php foreach ($sects as $secItem): ?>
                            <?php if($secItem['DEPTH_LEVEL'] == 1): ?>
                                <li id="<?= $secItem['CODE']; ?>"><a><?= $secItem['NAME']; ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>

                    <div class="delimeter show_scroll"></div>

                    <div class="butt_box">

                        <svg class="show_scroll" id="show_scroll_sub_menu" width="26" height="6" viewBox="0 0 26 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="3" cy="3" r="3" fill="#121419"/>
                            <circle cx="13" cy="3" r="3" fill="#121419"/>
                            <circle cx="23" cy="3" r="3" fill="#121419"/>
                        </svg>

                        <div class="indicator hide"></div>
                    </div>

                    <div class="person_box">

                        <svg class="" id="person_cabinet_butt" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24 13C24 15.9174 22.8411 18.7153 20.7782 20.7782C18.7153 22.8411 15.9174 24 13 24C10.0826 24 7.28473 22.8411 5.22183 20.7782C3.15893 18.7153 2 15.9174 2 13C2 10.0826 3.15893 7.28473 5.22183 5.22183C7.28473 3.15893 10.0826 2 13 2C15.9174 2 18.7153 3.15893 20.7782 5.22183C22.8411 7.28473 24 10.0826 24 13ZM15.75 8.875C15.75 9.60435 15.4603 10.3038 14.9445 10.8195C14.4288 11.3353 13.7293 11.625 13 11.625C12.2707 11.625 11.5712 11.3353 11.0555 10.8195C10.5397 10.3038 10.25 9.60435 10.25 8.875C10.25 8.14565 10.5397 7.44618 11.0555 6.93046C11.5712 6.41473 12.2707 6.125 13 6.125C13.7293 6.125 14.4288 6.41473 14.9445 6.93046C15.4603 7.44618 15.75 8.14565 15.75 8.875ZM13 14.375C11.6836 14.3747 10.3948 14.7524 9.2867 15.4632C8.17864 16.1739 7.29793 17.1879 6.74925 18.3845C7.52293 19.2846 8.48212 20.0067 9.56105 20.5013C10.64 20.9959 11.8131 21.2513 13 21.25C14.1869 21.2513 15.36 20.9959 16.439 20.5013C17.5179 20.0067 18.4771 19.2846 19.2507 18.3845C18.7021 17.1879 17.8214 16.1739 16.7133 15.4632C15.6052 14.7524 14.3164 14.3747 13 14.375Z" fill="#121419"/>
                        </svg>

                        <div class="forms_box" style="display: none;">
                        <?php $check_auth = $USER->IsAuthorized(); ?>
                            <div class="no_auth <?= $check_auth ? 'hide' : null; ?>">
                                <div class="all_form">
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:system.auth.form", 
                                        "auth_form", 
                                        Array(
                                        "FORGOT_PASSWORD_URL" => "",    
                                            "PROFILE_URL" => "",    
                                            "REGISTER_URL" => "",   
                                            "SHOW_ERRORS" => "Y"
                                        ),
                                        false
                                    );?>

                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:main.register",
                                        "register_form",
                                        Array(
                                            "AUTH" => "Y",
                                            "REQUIRED_FIELDS" => array(),
                                            "SET_TITLE" => "Y",
                                            "SHOW_FIELDS" => array("EMAIL"),
                                            "SUCCESS_PAGE" => "",
                                            "USER_PROPERTY" => array(),
                                            "USER_PROPERTY_NAME" => "",
                                            "AJAX_MODE" => "Y",
                                            "USE_BACKURL" => "Y"
                                        )
                                    );?>

                                    <form id="restore_passw" class="cabinet_form hide">
                                        <div class="form_title">Восстановить пароль</div>
                                        <div class="form_box">
                                            <input id="restore_login_mail" placeholder="Логин или почта" class="form_inp required" type="text" name="login_mail">
                                            <div class="error_mess hide">Проверьте форму на наличие ошибок</div>
                                            <button id="restore_passw_butt" class="form_button">Восстановить пароль</button>
                                        </div>

                                        <div class="succes_box hide">
                                            <div class="about_pass">
                                                На ваш почтовый ящик выслан  временный пароль, с которым  вы сможете войти на сайт
                                            </div>

                                            <div class="remind">
                                                Не забудьте поменять его после входа!
                                            </div>
                                        </div>

                                        <div class="rule_line">
                                            <div class="rule_item come_in_butt">Войти</div>
                                            <div class="delimeter"></div>
                                            <div class="rule_item register_butt">Регистрация</div>
                                        </div>
                                    </form>
                                </div>

                                <div class="social_line">
                                    <div class="social_title">Войти с социальной сетью</div>
                                    <div class="icon_box">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/ok_form.svg">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/vk_form.svg">
                                    </div>
                                </div>
                            </div>



                            <div class="auth <?= $check_auth ? null : 'hide'; ?>">
                                <div class="refs_box">
                                    <div class="form_title">Кабинет</div>
                                    <a class="ref_line" href="/orders_list/">
                                        <div class="ref_title">Мои заказы</div>
                                        <div class="ref_descr">
                                            <?= Return_Count_Orders(); ?>
                                        </div>
                                    </a>

                                    <a class="ref_line" href="/my_data/">
                                        <div class="ref_title">Мои данные</div>
                                    </a>

                                    <!-- <a class="ref_line" href="#">
                                        <div class="ref_title">Мои компании</div>
                                        <div class="ref_descr hide">4</div>
                                    </a> -->
                                </div>

                                <div class="go_out" id="go_out_cabinet">Выйти из кабинета</div>
                            </div>
                        </div>
                    </div>

                    <div class="basket_box <?= ($page == '/basket/') ? 'hide' : null; ?>">
                        <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"icon_count", 
	array(
		"COMPONENT_TEMPLATE" => "icon_count",
		"HIDE_ON_BASKET_PAGES" => "N",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."basket//",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_DELAY" => "N",
		"SHOW_EMPTY_VALUES" => "N",
		"SHOW_IMAGE" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRICE" => "Y",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_REGISTRATION" => "N",
		"SHOW_SUMMARY" => "Y",
		"SHOW_TOTAL_PRICE" => "Y"
	),
	false
);?>

                        <div class="small_basket" style="display: none;">

                            <?$APPLICATION->IncludeComponent(
                                "bitrix:sale.basket.basket.line",
                                "header_basket",
                                Array(
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "HIDE_ON_BASKET_PAGES" => "N",
                                    "PATH_TO_AUTHORIZE" => "",
                                    "PATH_TO_BASKET" => SITE_DIR."basket//",
                                    "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                                    "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                                    "PATH_TO_PROFILE" => SITE_DIR."personal/",
                                    "PATH_TO_REGISTER" => SITE_DIR."login/",
                                    "POSITION_FIXED" => "N",
                                    "SHOW_AUTHOR" => "N",
                                    "SHOW_DELAY" => "N",
                                    "SHOW_EMPTY_VALUES" => "N",
                                    "SHOW_IMAGE" => "N",
                                    "SHOW_NOTAVAIL" => "N",
                                    "SHOW_NUM_PRODUCTS" => "Y",
                                    "SHOW_PERSONAL_LINK" => "N",
                                    "SHOW_PRICE" => "Y",
                                    "SHOW_PRODUCTS" => "Y",
                                    "SHOW_REGISTRATION" => "N",
                                    "SHOW_SUMMARY" => "Y",
                                    "SHOW_TOTAL_PRICE" => "Y"
                                )
                            );?>
                        </div>

                    </div>
                </div>
            </div>

            <ul class="catalog_nav hide_scroll">
                <?php foreach ($sects as $secItem): ?>
                    <?php if($secItem['DEPTH_LEVEL'] == 1): ?>
                    <li id="<?= $secItem['CODE'].'_777'; ?>"><a><?= $secItem['NAME']; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

        </div>

        <div class="scroll_menu_box" style="display: none;">
            <div class="wrap">
                <div class="search_price">
                    <div class="search_title">Поиск по сайту</div>

                    <?php
                    /**важно**/ 
                        $GLOBALS['hide_scroll'] = ''; 
                        $GLOBALS['hide_inp'] = 'hide_inp'; 
                    ?>

                    <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"serch_box", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_1c_catalog",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_1c_catalog" => array(
			0 => "18",
		),
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search-two",
		"INPUT_ID" => "title-search-input-two",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "rank",
		"PAGE" => "",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5000",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "serch_box",
		"TEMPLATE_THEME" => "blue",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "N",
		"CONVERT_CURRENCY" => "N",
		"CATEGORY_1_TITLE" => "",
		"CATEGORY_1" => "",
		"CATEGORY_2_TITLE" => "",
		"CATEGORY_2" => "",
		"CATEGORY_3_TITLE" => "",
		"CATEGORY_3" => "",
		"CATEGORY_4_TITLE" => "",
		"CATEGORY_4" => ""
	),
	false
);?>

                    <?
                    $class = "";
                    $price_name = "Прайс на услуги";
                    require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/price_docs_box.php");
                    ?>
                </div>

                <div class="scroll_menu grid">

                    <div class="menu_item butt">
                        <div>
                            <a href="/company/" class="menu_title">Компания</a>
                            <ul class="scroll_sub_menu">
                                <!-- <li><a href="#">О компании</a></li> -->
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "company_menu",
                                    Array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "section",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "2",
                                        "MENU_CACHE_GET_VARS" => array(""),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "top",
                                        "USE_EXT" => "N"
                                    )
                                );?>
                            </ul>
                        </div>

                        <div class="cabinet_butt">
                            <div>Мой кабинет</div>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/pers_icon.svg">
                        </div>
                    </div>

                    <div class="menu_item butt">
                        <div>
                            <a href="/contacts/" class="menu_title">Контакты</a>
                            <a class="cont_item" href="tel:<?= $phone; ?>">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon_phone_black.svg">
                                <div class="item_text phone"><?= $phone; ?></div>
                            </a>

                            <a class="cont_item" href="mailto:<?= $mail; ?>">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon_email_black.svg">
                                <div class="item_text"><?= $mail; ?></div>
                            </a>

                            <div class="cont_item">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon_house_black.svg">
                                <div class="item_text"><?= $addres; ?></div>
                            </div>

                             <?
			                	$class = "";
                                $title = "Социальные сети";
			                	require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/social_box.php");
			                ?>
                        </div>

                        <div class="phone_order_butt">
                            Заказать звонок
                        </div>
                    </div>

                    <div class="menu_item">
                        <a href="/services/" class="menu_title">Металлообработка</a>
                        <ul class="scroll_sub_menu">
                            <?php foreach ($serv_main as $serv_item): ?>
                                <li>
                                    <a href="<?= $serv_item['fields']['DETAIL_PAGE_URL'] ?>">
                                        <?= $serv_item['fields']['NAME']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>

                            <li><a href="/services/#constr_title">Конструктору</a></li>
                        </ul>
                    </div>

                    <div class="menu_item big">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "not_company_menu",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "section",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "top",
                                "USE_EXT" => "N"
                            )
                        );?>

                        <?php  
                        $serv_add = Return_All_Fields_Props(
                            Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>200),
                            Array()
                        );
                        ?>

                        <ul class="scroll_sub_menu">
                            <?php foreach ($serv_add as $serv_item): ?>
                                <li>
                                    <a href="<?= $serv_item['fields']['DETAIL_PAGE_URL'] ?>">
                                        <?= $serv_item['fields']['NAME']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                </div>

            </div>
        </div>

        <div class="scroll_cat_box" style="display: none;">
            <div class="wrap">

                <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"menu_sects", 
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
		"COMPONENT_TEMPLATE" => "menu_sects",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
		"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "Y",
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

            </div>
        </div>
    </header>

	