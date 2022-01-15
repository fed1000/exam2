<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(!empty($arResult['PROPERTY_LINK_REL_NEWS'])){
    $APPLICATION->SetPageProperty("canonical", $arResult['PROPERTY_LINK_REL_NEWS']);
}