<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams["LIST_DISPLAY_SPECIALDATE"]==="Y"){
    $cp = $this->__component;
    $arResult["DATE_ONE_NEWS"] = $arResult["ITEMS"][0]["DISPLAY_ACTIVE_FROM"];
    $cp->SetResultCacheKeys(array("DATE_ONE_NEWS"));
}