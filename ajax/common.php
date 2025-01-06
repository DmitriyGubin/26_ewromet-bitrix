<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");
CModule::IncludeModule('iblock');

$mail_adress = 'info@ewromet.ru';//почта евромета
$user_bitrix = new CUser;//класс битрикса

$arResult = array('status' => false);

// function Trimm($post)
// {
//     foreach($post as $key => $value) 
//     {
//         $post[$key] = trim($value);
//     }
//     return $post;
// }

function Init_Basket()
{
    $siteId = 's1'; // ID сайта, к которому будет привязана корзина
    $fuser = \Bitrix\Sale\Fuser::getId();
    //для корзины БЕЗ заказа
    $basket = \Bitrix\Sale\Basket::loadItemsForFUser($fuser, $siteId); //по идентификатор покупателя
    return $basket;
}

function Delete_All_From_Basket()
{
	$basket = Init_Basket();
    $arBasketInfo = $basket->getListOfFormatText(); // все товары
    foreach ($arBasketInfo as $key => $value) 
    {
    	$item = $basket->getItemById($key);
    	$item->delete();
    }
    $basket->save();
}

function Add_Product_To_Basket($id_prod, $quant)
{
    //Добавление позиции
    $fields = [
        'PRODUCT_ID' => $id_prod, // ID товара, обязательно
        'QUANTITY' => $quant, // количество, обязательно
        'PROPS' => '',
    ];

    Bitrix\Catalog\Product\Basket::addProduct($fields);
}

if($_POST['type_of_form'] == 'Оформление заказа без кабинета')
{
    $PROP = array();
    $PROP['COMPANY'] = $_POST['company_name'];
    $PROP['NAME'] = $_POST['pers_name'];
    $PROP['SURNAME'] = $_POST['pers_sername'];
    $PROP['PARTON'] = $_POST['perse_patronymic'];
    $PROP['MAIL'] = $_POST['mail0'];
    $PROP['PHONE'] = $_POST['phone'];
    $PROP['INDEX'] = $_POST['index'];
    $PROP['CITY'] = $_POST['city'];
    $PROP['STREET'] = $_POST['street'];
    $PROP['HOUSE'] = $_POST['house'];
    $PROP['APARTMENT'] = $_POST['apartment'];
    $PROP['PATH_COMMENT'] = $_POST['path_comment'];
    $PROP['ORDER_COMMENT'] = $_POST['order_comment'];
    $PROP['TYPE_OF_PAY'] = $_POST['type_of_pay'];
    $PROP['PRODUCTS'] = $_POST['products'];
    $PROP['INN'] = $_POST['inn'];
    $PROP['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];

	if(CEvent::Send("BUY_NEW_ORDER", "s1", $PROP))
	{
	   $arResult['status'] = true;
	}


	//Delete_All_From_Basket();
}

if($_POST['type_of_form'] == 'Очистка корзины')
{
    Delete_All_From_Basket();
    $arResult['status'] = true;
}

if($_POST['type_of_form'] == 'Добавление в корзину')
{
    Add_Product_To_Basket($_POST['id'], 1);
    $arResult['status'] = true;
}

if($_POST['type_of_form'] == 'Форма консультации футера')
{
    $PROP = array();
    $PROP['NAME'] = $_POST['name'];
    $PROP['MAIL'] = $_POST['mail'];
    $PROP['PHONE'] = $_POST['phone'];
    $PROP['COMMENT'] = $_POST['comment'];
    $PROP['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];

    if(CEvent::Send("FOOTER_CONSULT_FORM", "s1", $PROP))
    {
       $arResult['status'] = true;
    }
}

if($_POST['type_of_form'] == 'Форма резюме')
{
    $PROP = array();
    $PROP['FIO'] = $_POST['name'];
    $PROP['PHONE'] = $_POST['phone'];
    $PROP['MAIL'] = $_POST['mail'];
    $PROP['POSITION'] = $_POST['position'];
    $PROP['LETTER'] = $_POST['letter'];
    $PROP['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];

    //собираем файлы из загрузки в массив
    $files=array();
    foreach ($_FILES as $file)
    {
        if (!empty($file['tmp_name'])) 
        {
            $files[]=CFile::SaveFile($file,'resume');
        }
    }

    if(CEvent::Send("NEW_RESUME", "s1", $PROP, "Y", "", $files))
    {
       $arResult['status'] = true;
    }
}

if($_POST['type_of_form'] == 'Форма резюме старое не на битриксе')
{
    require 'php_mailer/PHPMailer.php';
    require 'php_mailer/SMTP.php';
    require 'php_mailer/Exception.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->CharSet = "UTF-8";
    $mail->From     = 'info@ewromet.ru';
    $mail->AddAddress($mail_adress);

    $mail->IsHTML(true);

    $mail->Subject  =  "Новое резюме для сайта ewromet";
    $mail->Body     =  "ФИО:".$_POST['name']." <br>".
    "Телефон:".$_POST['phone']." <br>".
    "Почта:".$_POST['mail']." <br>".
    "Должность:".$_POST['position']." <br>".
    "Сопроводительное письмо:<br>".$_POST['letter'];

    $mail->addAttachment($_FILES['resume']['tmp_name'], $_FILES['resume']['name']);

    if($mail->send())
    {
       $arResult['status'] = true;
    }
}

if($_POST['type_of_form'] == 'Форма рейтинга')
{
    $PROP = array();
    $PROP['COMPANY'] = $_POST['company'];
    $rating = $_POST['rating'];

    $list_var = Return_List_Variants(10, 'RATING');

    foreach ($list_var as $item) 
    {
        if($item['VALUE'] == $rating)
        {
            $id_rating = $item['ID'];
            break;
        }
    }

    $PROP['RATING'] = $id_rating;
    $PROP['RATING_NAME'] = $_POST['mail'];

    $el = new CIBlockElement;

    $arElem = Array(
        "IBLOCK_SECTION_ID" => false,
        "IBLOCK_ID"      => 10,
        "NAME"           => $_POST['name'],
        "ACTIVE"         => "N",
        "PREVIEW_TEXT"   => $_POST['review'],
        "PROPERTY_VALUES"=> $PROP
    );

    if($comm_id = $el->Add($arElem))
    {
        $arResult['fields'] = $_POST;
        $arResult['status'] = true;
    }
}

if($_POST['type_of_form'] == 'Форма заказать обратный звонок')
{
    $PROP = array();
    $PROP['NAME'] = $_POST['name'];
    $PROP['PHONE'] = $_POST['phone'];
    $PROP['COMPANY'] = $_POST['companyy'];
    $PROP['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];

    if(CEvent::Send("CALL_ORDER", "s1", $PROP))
    {
       $arResult['status'] = true;
    }
}

if($_POST['type_of_form'] == 'Форма помощи')
{
    $PROP = array();
    $PROP['NAME'] = $_POST['name'];
    $PROP['PHONE'] = $_POST['phone'];
    $PROP['MAIL'] = $_POST['mail'];
    $PROP['COMMENT'] = $_POST['comment'];
    $PROP['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];

    if(CEvent::Send("HELP_FORM", "s1", $PROP))
    {
       $arResult['status'] = true;
    }
}

if($_POST['type_of_form'] == 'Выход из личного кабинета')
{
    $USER->Logout();
    $arResult['status'] = true;
}

if($_POST['type_of_form'] == 'Проверка пользователя при авторизации')
{
    $users = Return_All_Users(Array(), Array());

    $flag = false;
    foreach ($users as $user_item) 
    {
        if($user_item['LOGIN'] == $_POST['login'])
        {
            if(Check_Password($_POST['password'], $user_item['PASSWORD']))
            {
                $flag = true;
                break;
            }
        }
    }
    $arResult['status'] = $flag;
}

if($_POST['type_of_form'] == 'Форма изменение данных пользователя')
{
    $mass = [
        'LOGIN' => $_POST['login'], 
        'EMAIL' => $_POST['mail'],
        'PERSONAL_PHONE' => $_POST['phone'],
        'PASSWORD' => $_POST['new_passw']
    ];

    $fields = [];

    foreach ($mass as $key => $value) 
    {
        if($value != '')
        {
            $fields[$key] = trim($value);
        }
    }

    $fields['UF_EXIT_CAB'] = $_POST['exit_cab'];

    if($_POST['old_passw'] != '')
    {
        if(Check_Password($_POST['old_passw'], $_POST['hash']))
        {
            $user_bitrix->Update($_POST['user_id'], $fields);
            $arResult['status'] = true;
        }
    }
    else
    {
        $user_bitrix->Update($_POST['user_id'], $fields);
        $arResult['status'] = true;
    }
}

if($_POST['type_of_form'] == 'Восстановление пароля')
{
    $users = Return_All_Users(Array(), Array());
    $login_or_mail = $_POST['login_mail'];
    $flag = false;

    foreach ($users as $user_item) 
    {
        if(($user_item['LOGIN'] == $login_or_mail) or ($user_item['EMAIL'] == $login_or_mail))
        {
            $flag = true;
            $mail = $user_item['EMAIL'];
            $id_user = $user_item['ID'];
            break;
        }
    }

    if($flag)
    {
        $password = '1Ab@%$'.time().'-'.mt_rand();
        $to      = $mail;
        $subject = 'Информационное сообщение сайта https://ewromet.ru/';
        $headers = 'From: info@ewromet.ru';
        $body = 'Ваш временный пароль для сайта: '.$password;

        $fields = Array(
          "PASSWORD"          => $password
         );

        if(mail( $to, $subject, $body, $headers ))
        {
            $user_bitrix->Update($id_user, $fields);
            $arResult['status'] = true;
        }
    }
    else
    {
        $arResult['status'] = false;
    }
}

echo json_encode($arResult);