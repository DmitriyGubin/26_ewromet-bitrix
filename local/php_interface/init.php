<?php 
// file_put_contents($_SERVER['DOCUMENT_ROOT']."/file_bag.log",print_r($_SERVER,true),FILE_APPEND);
//CFile::GetPath

function debug($data)
{
	echo '<pre>'.print_r($data, 1).'</pre>';
}

function Return_All_Fields_Props($Filter,$Select)
{
	if(CModule::IncludeModule("iblock"))
	{ 
		$res = CIBlockElement::GetList(
	            Array("SORT"=>"ASC"), //сортировка данных
	            $Filter, //фильтр данных
	            false, //группировка данных
	            false, // постраничная навигация
	            $Select
	        );

		$result = [];
		$j=0;
		while($ob = $res->GetNextElement())
		{
			$result[$j]['fields'] = $ob->GetFields();
			$result[$j]['props'] = $ob->GetProperties();
			$j++;
		}
		return $result;
	}
	else
	{
		return 'Error';
	}
}

function Return_All_Sections($Filter,$Select)
{
	if(CModule::IncludeModule("iblock"))
	{ 
		$res = CIBlockSection::GetList(
                Array("SORT"=>"ASC"),
                $Filter,
                false,
                $Select,
                false
            );

		$result = [];
		while($ob = $res->GetNextElement())
		{
			$result[] = $ob->GetFields();
		}
		return $result;
	}
	else
	{
		return 'Error';
	}
}

/*$catalog = Return_All_Sections(
		Array("IBLOCK_ID"=>6, "ACTIVE"=>"Y"),
		Array('ID','NAME', 'PICTURE', 'SECTION_PAGE_URL')
	);*/

function Return_Section_Ref($id, $secs_arr)
{
	$sec = [];
	foreach ($secs_arr as $arSec) 
	{
		if($arSec['ID'] == $id)
		{
			$sec = $arSec;
			break;
		}
	}

	return $sec;
}

function Сut_Text($text, $number_letters)
{
	if(mb_strlen($text,"UTF-8") > $number_letters)
	{
		return mb_substr($text, 0, $number_letters, "UTF-8").'...';
	}
	else
	{
		return $text;
	}
}

function Counter_Section_Elements($sec_id, $elements)
{
	$j = 0;
	foreach ($elements as $item) 
	{
		if($item['fields']['IBLOCK_SECTION_ID'] == $sec_id)
		{
			$j++;
		}
	}

	return $j;
}

function Return_List_Variants($iblock_id, $prop_code)
{
    if(CModule::IncludeModule("iblock"))
    {
        $property_enums = CIBlockPropertyEnum::GetList(
            Array(), 
            Array("IBLOCK_ID"=>$iblock_id, "CODE"=>$prop_code)
        );

      $props = [];//получаем список возможных свойств
      while($enum_fields = $property_enums->GetNext())
      {
        $props[] = $enum_fields;
      }
      return $props;
    }
    else
    {
        return 'Error';
    }
}

function Return_Products_Id_In_Basket()
{
	$res_id = [];

	$siteId = 's1'; // ID сайта, к которому будет привязана корзина
    $fuser = \Bitrix\Sale\Fuser::getId();
    //для корзины БЕЗ заказа
    $basket = \Bitrix\Sale\Basket::loadItemsForFUser($fuser, $siteId); //по идентификатор покупателя

    $arBasketInfo = $basket->getListOfFormatText(); // все товары

    if($arBasketInfo != '')
    {
    	foreach ($arBasketInfo as $key => $value) 
	    {
	    	$item = $basket->getItemById($key);
	    	$res_id[] = $item->getProductId();
	    }
    }

    return $res_id;
}

// $users = Return_All_Users(Array(), Array());
function Return_All_Users($Filter,$Additional_opts)
{
	$res = CUser::GetList(
		            ($by="id"),//поле для сортировки
		            ($order="desc"),
		            $Filter,
		            $Additional_opts
		        );

	$result = [];
	while($line = $res->Fetch())
	{
		$result[] = $line;
	}
	return $result;
}

function Check_Password($pass, $hash)
{
	if(\Bitrix\Main\Security\Password::equals($hash, $pass))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function Return_Count_Orders()
{
	$user_obj = new CUser;
	$user_id = $user_obj -> GetID();
	$arFilter = Array(
    	"USER_ID" => $user_id,
	);
	$db_sales = CSaleOrder::GetList(array(), $arFilter);
	return count($db_sales->arResult);
}


//define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
// AddMessage2Log("Еще");
//file_put_contents($_SERVER['DOCUMENT_ROOT']."/log.txt", print_r($arFields,true), FILE_APPEND);

// AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "AfterElemUpdate");
// function AfterElemUpdate($arFields){
//     if($arFields['IBLOCK_ID'] == 21)// проверка на изменение записи в нужном инфоблоке
//     {
//         if(isset($arFields["ID"]))
//         {
//             AddMessage2Log("Изменили");             
//         }
//     }
// }


?>