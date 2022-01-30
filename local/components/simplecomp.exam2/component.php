<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

if(!isset($arParams["CACHE_TIME"])){
	$arParams["CACHE_TIME"] = 36000000;
}

if(!isset($arParams["PRODUCTS_IBLOCK_ID"])){
	$arParams["PRODUCTS_IBLOCK_ID"] = 0;
}

if(!isset($arParams["KLASSIF_IBLOCK_ID"])){
	$arParams["KLASSIF_IBLOCK_ID"] = 0;
}

$arParams["CODE_LINK_PRODUCT_IN_CLASS"] = trim($arParams["CODE_LINK_PRODUCT_IN_CLASS"]);
global $USER;
if($this->startResultCache(false, array($USER->GetGroups()))){
	//получаем список классификаторов
	$arClassif = array();
	$arClassifID = array();
	$arResult["COUNT"] = 0;
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
	);
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["KLASSIF_IBLOCK_ID"],
		"CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"],
		"ACTIVE" => "Y"
	);
	$arSortElems = array ();
	$rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($arElement = $rsElements->Fetch())
	{
		$arClassif[$arElement["ID"]] = $arElement;
		$arClassifID[] = $arElement["ID"];
	}
	$arResult["COUNT"] = count($arClassifID);
	//получаем список элементов с привязками к классификатору
	$arSelectElemsProducts = array (
		"ID",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"NAME",
		"DETAIL_PAGE_URL",
	);
	$arFilterElemsProducts = array (
		"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
		"CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"],
		"PROPERTY_" . $arParams["CODE_LINK_PRODUCT_IN_CLASS"] => $arClassifID,
		"ACTIVE" => "Y"
	);
	$arSortElems = array ();
	$rsElements = CIBlockElement::GetList($arSortElems, $arFilterElemsProducts, false, false, $arSelectElemsProducts);
	$rsElements->SetUrlTemplates($arParams["TEMPLATE_DETAIL_LINK"]);
	while($arElementProducts = $rsElements->GetNextElement())
	{
		$arField = $arElementProducts->GetFields();
		$arField["PROPERTIES"] = $arElementProducts->GetProperties();
		foreach ($arField["PROPERTIES"][$arParams["CODE_LINK_PRODUCT_IN_CLASS"]]["VALUE"] as $value) {
			$arClassif[$value]["ELEMENTS"][$arField["ID"]] = $arField;
		}
	}
	$arResult["CLASSIF"] = $arClassif;
	$this->SetResultCacheKeys(array("COUNT"));
	$this->includeComponentTemplate();
}else{
	$this->abortResultCache();
}
$APPLICATION->SetTitle(GetMessage("COUNT_SECTION_TITLE") . $arResult["COUNT"]);


?>