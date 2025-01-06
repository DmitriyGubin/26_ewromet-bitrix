<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

$bool_mobile = preg_match("/(ipad|iphone|android|operamobi|blackberry)/i",$_SERVER['HTTP_USER_AGENT']);

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//debug($arResult);

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))
{
	$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}

$strReturn .= '
	<div class="wrap nav_chain_wrap">
	<section class="nav_chain top_box">
	<div class="nav_item hide_this"> 
			<a class="main_ref" href="/">
				<svg class="house" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M18.4864 9.86328L10.9395 2.32032L10.4337 1.81446C10.3184 1.69996 10.1625 1.6357 10.0001 1.6357C9.83762 1.6357 9.68175 1.69996 9.56649 1.81446L1.51375 9.86328C1.39565 9.98093 1.30231 10.121 1.23925 10.2753C1.17618 10.4297 1.14467 10.595 1.14657 10.7617C1.15438 11.4492 1.72664 11.998 2.41414 11.998H3.24422V18.3594H16.7559V11.998H17.6036C17.9376 11.998 18.252 11.8672 18.4884 11.6309C18.6047 11.5149 18.6969 11.3769 18.7596 11.2251C18.8223 11.0732 18.8543 10.9104 18.8536 10.7461C18.8536 10.4141 18.7227 10.0996 18.4864 9.86328ZM11.0938 16.9531H8.90633V12.9688H11.0938V16.9531ZM15.3497 10.5918V16.9531H12.3438V12.5C12.3438 12.0684 11.9942 11.7188 11.5626 11.7188H8.43758C8.00594 11.7188 7.65633 12.0684 7.65633 12.5V16.9531H4.65047V10.5918H2.77547L10.002 3.3711L10.4532 3.82227L17.2266 10.5918H15.3497Z" fill="#6A7C9F"></path>
				</svg>

				<div class="hide_this main_page">Главная</div>
			</a>
			<svg class="arrow" width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path opacity="0.6" d="M1 10L5.5 5.5L1 1" stroke="#6A7C9F" stroke-linecap="round" stroke-linejoin="round"></path>
			</svg>
	</div>
	';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	
	if($index == ($itemSize-1))
	{
		$strReturn .= '
			<div class="hide open_box mobile">
				<div class="shaw_all">...</div>
				<svg class="arrow mobile" width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path opacity="0.6" d="M1 10L5.5 5.5L1 1" stroke="#6A7C9F" stroke-linecap="round" stroke-linejoin="round"></path>
				</svg>
			</div>
			<div class="nav_item"> 
				<div class="nav_title last">'.$title.'</div>
			</div>
			';
	}
	else
	{
		$strReturn .= '
		<div class="nav_item  hide_this"> 
			<a class="nav_title" href="'.$arResult[$index]["LINK"].'">'.$title.'</a>
			
			<svg class="arrow" width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path opacity="0.6" d="M1 10L5.5 5.5L1 1" stroke="#6A7C9F" stroke-linecap="round" stroke-linejoin="round"></path>
			</svg>
		</div>
			';
	}
	
}

$strReturn .= '</section></div>';

return $strReturn;


?>


