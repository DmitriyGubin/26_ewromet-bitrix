<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

</div><!-- важно -->

<div class="consult_form_footer">

	<section class="consult_box wrap">
        <div class="blue_box">
            <div class="top_line">
                <div class="quest_text">
                    <div class="quest_box">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/quest.svg">
                        <div>
                            <div class="quest_title">Нужна консультация?</div>
                            <div class="text_box show_mobile">
                                Подробно ответим на любой <br> интересующий вопрос!
                            </div>
                        </div>
                    </div>

                    <div class="text_box hide_mobile">
                        Подробно расскажем о нашей продукции и услугах, рассчитаем стоимость и подготовим индивидуальное предложение!
                    </div>
                </div>

                <div class="rule_box">
                    <div class="order_button">
                        <div>Получить консультацию</div>
                        <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"></path>
                        </svg>
                    </div>

                    <svg class="close_cross hide" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L25 25M1 25L25 1" stroke="#B9B9F5"/>
                    </svg>
                </div>
            </div>

            <div class="consult_form" style="display: none;">
                <div class="form_box">
                    <form class="only_form" id="footer_consult_form">
                        <input type="hidden" name="type_of_form" value="Форма консультации футера">
                        <div class="grid form_grid">
                            <div class="grid_item input">
                                <input class="form_field required" placeholder="Ваше имя" type="text" name="name">
                                <img class="field_img" src="<?= SITE_TEMPLATE_PATH ?>/img/inp_name.svg">
                            </div>

                            <div class="grid_item input">
                                <input class="form_field phone required" placeholder="Телефон" type="text" name="phone">
                                <img class="field_img" src="<?= SITE_TEMPLATE_PATH ?>/img/inp_phone.svg">
                            </div>

                            <div class="grid_item input">
                                <input class="form_field mail required" placeholder="Электронная почта" type="text" name="mail">
                                <img class="field_img" src="<?= SITE_TEMPLATE_PATH ?>/img/inp_mail.svg">
                            </div>

                            <div class="grid_item textarea">
                                <textarea name="comment" class="form_field" placeholder="Комментарий или пожелание к заказу ..."></textarea>
                                <img class="field_img" src="<?= SITE_TEMPLATE_PATH ?>/img/inp_comm.svg">
                            </div>
                        </div>

                        <div class="order_line">
                            <div class="order_text hide_mobile">
                                Нажимая Отправить заявку мы руководствуемся <br>
                                <a href="<?= SITE_TEMPLATE_PATH ?>/docs/Политика конфиденциальности.pdf">Политикой конфиденциальности</a> и бережно храним данные
                            </div>

                            <div class="order_text show_mobile">
                                Нажимая Отправить мы руководствуемся <a href="<?= SITE_TEMPLATE_PATH ?>/docs/Политика конфиденциальности.pdf"> Политикой конфиденциальности</a>
                            </div>

                            <a class="order_button" href="#">
                                <div>Отправить заявку</div>
                                <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 7H32M32 7L26 1M32 7L26 13" stroke="#121419" stroke-width="1.2"/>
                                </svg>
                            </a>
                        </div>
                    </form>

                    <div class="success hide">
                       <img class="succ_img" src="<?= SITE_TEMPLATE_PATH ?>/img/success_img.svg">
                       <div class="succ_title">Заявка уже в пути!</div>
                       <div class="succ_text">
                           Спасибо, что выбрали компанию Евромет. Наши специалисты уже изучают ваши пожелания и ответят в рабочее время
                       </div>
                       <button class="one_more">Отправить еще</button>
                    </div>
                </div>

                 <img class="form_img" src="<?= SITE_TEMPLATE_PATH ?>/img/big_logo.svg">

                 <img class="girl_img" src="<?= SITE_TEMPLATE_PATH ?>/img/girl.png">
            </div>
            
        </div>
    </section>

    <footer class="wrap">
        <div class="menu">
            <div class="box_item hide_mobile">
                <a class="item_title" href="/company/">Компания</a>
                <ul>
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

            <?php 
                $sects = Return_All_Sections(
                    Array("IBLOCK_ID"=>18, "ACTIVE"=>"Y"),
                    Array()
                );
               //debug($sects);
            ?>

            <div class="box_item hide_mobile">
                <a href="/catalog/" class="item_title">Каталог металлопроката</a>
                <ul>
                    <?php foreach ($sects as $sec_item): ?>
                        <?php if($sec_item['DEPTH_LEVEL'] == 1): ?>
                        <li>
                            <a href="<?= $sec_item['SECTION_PAGE_URL']; ?>">
                                <?= $sec_item['NAME']; ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php  
                $serv_main = Return_All_Fields_Props(
                    Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>199),
                    Array()
                );
                //debug($serv);
                $j=0;
                $limit = 100;
            ?>

            <div class="box_item hide_mobile">
                <a href="/services/" class="item_title">Услуги</a>
                <ul>
                    <?php foreach ($serv_main as $serv_item): ?>
                    <?php $j++; if($j == ($limit+1)) break; ?>
                        <li>
                            <a href="<?= $serv_item['fields']['DETAIL_PAGE_URL'] ?>">
                                <?= $serv_item['fields']['NAME']; ?>
                            </a>
                            <?php if($j == $limit): ?>
                                <a class="more_info" href="/services/">Еще...</a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="box_item">
                <!-- <div class="search_box">
                    <input id="serch_input_footer" type="text" placeholder="Поиск на сайте">
                    <img class="loopa" src="<?= SITE_TEMPLATE_PATH ?>/img/loopa.svg">
                </div> -->

                <?php 
                    $phone = $GLOBALS['all_contacts']['OFICE_PHONE']['VALUE'];
                    $mail = $GLOBALS['all_contacts']['MAIL']['VALUE'];
                ?>

                <div class="phone_box">
                    <div class="cont_item">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/phone.svg">
                        <a class="phone cont_text" href="tel:<?= $phone; ?>">
                            <?= $phone; ?>
                        </a>
                        <svg class="hide_mobile" width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5.5 5.5L10 1" stroke="#1D1D1D" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    
                    <div class="call_order">Заказать звонок</div>
                </div>

                <a class="cont_item mail" href="mailto:<?= $mail; ?>">
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 0.950195C4.48 0.950195 0 5.4302 0 10.9502C0 16.4702 4.48 20.9502 10 20.9502H15V18.9502H10C5.66 18.9502 2 15.2902 2 10.9502C2 6.6102 5.66 2.9502 10 2.9502C14.34 2.9502 18 6.6102 18 10.9502V12.3802C18 13.1702 17.29 13.9502 16.5 13.9502C15.71 13.9502 15 13.1702 15 12.3802V10.9502C15 8.1902 12.76 5.9502 10 5.9502C7.24 5.9502 5 8.1902 5 10.9502C5 13.7102 7.24 15.9502 10 15.9502C11.38 15.9502 12.64 15.3902 13.54 14.4802C14.19 15.3702 15.31 15.9502 16.5 15.9502C18.47 15.9502 20 14.3502 20 12.3802V10.9502C20 5.4302 15.52 0.950195 10 0.950195ZM10 13.9502C8.34 13.9502 7 12.6102 7 10.9502C7 9.2902 8.34 7.9502 10 7.9502C11.66 7.9502 13 9.2902 13 10.9502C13 12.6102 11.66 13.9502 10 13.9502Z" fill="black"/>
                    </svg>
                    <span class="cont_text"><?= $mail; ?></span>
                </a>

                <div class="cont_item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 2H9.00003C7.89703 2 7.00003 2.897 7.00003 4V9.586L2.29303 14.293C2.15322 14.4329 2.05802 14.611 2.01945 14.805C1.98088 14.9989 2.00068 15.2 2.07635 15.3827C2.15202 15.5654 2.28016 15.7215 2.44457 15.8314C2.60898 15.9413 2.80228 16 3.00003 16V21C3.00003 21.2652 3.10539 21.5196 3.29292 21.7071C3.48046 21.8946 3.73481 22 4.00003 22H20C20.2652 22 20.5196 21.8946 20.7071 21.7071C20.8947 21.5196 21 21.2652 21 21V4C21 2.897 20.103 2 19 2ZM11 20H5.00003V14.414L8.00003 11.414L11 14.414V20ZM19 20H13V16C13.198 16.0004 13.3916 15.942 13.5563 15.8322C13.7211 15.7224 13.8495 15.5662 13.9252 15.3833C14.001 15.2004 14.0207 14.9991 13.9818 14.805C13.943 14.6109 13.8473 14.4327 13.707 14.293L9.00003 9.586V4H19V20Z" fill="black"/>
                        <path d="M11 6H13V8H11V6ZM15 6H17V8H15V6ZM15 10.031H17V12H15V10.031ZM15 14H17V16H15V14ZM7 15H9V17H7V15Z" fill="black"/>
                    </svg>
                    <span class="cont_text"><?= $GLOBALS['all_contacts']['ADRESS']['~VALUE']['TEXT']; ?></span>
                </div>

                <?
                    $class = "";
                    $title = "Наши социальные сети";
                    require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/social_box.php");
                ?>
            </div>
        </div>

        <div class="last_line">
            <div class="year">ООО «Евромет» © 2000 – 2024</div>

            <div class="logos">
                <img class="bitrix_logo" src="<?= SITE_TEMPLATE_PATH ?>/img/bitrix_logo.svg">
                <div class="plus">+</div>
                <a href="https://novoe.online/">
                    <img class="newag_logo" src="<?= SITE_TEMPLATE_PATH ?>/img/new_agency.svg">
                </a>
            </div>

            <a target="_blank" class="polite ref" href="<?= SITE_TEMPLATE_PATH ?>/docs/Политика конфиденциальности.pdf">Политика конфиденциальности</a>
            <div class="polite show_mobile full">Полная версия сайта</div>
        </div>
    </footer>
</div>
</div><!-- main_wrapper -->

<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/main.js"></script>

</body>
</html> 