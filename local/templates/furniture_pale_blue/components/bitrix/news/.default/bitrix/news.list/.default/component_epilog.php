<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult["DATE_ONE_NEWS"])){
    $APPLICATION->SetPageProperty("specialdate", $arResult["DATE_ONE_NEWS"]);
}