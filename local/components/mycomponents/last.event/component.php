<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 180;

$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);


if($arParams["IBLOCK_ID"] > 0 && $this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups())))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	//SELECT
	$arSelect = array(
		"ID",
		"IBLOCK_ID",
		"CODE",
		"IBLOCK_SECTION_ID",
		"NAME",
		"PREVIEW_TEXT",
		"DETAIL_PAGE_URL",
		"PROPERTY_CITY",
	);
	//WHERE
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE"=>"Y",
		"CHECK_PERMISSIONS"=>"Y",
		">=DATE_ACTIVE_FROM"=>ConvertTimeStamp(false, "SHORT"),
	);
	if($arParams["PARENT_SECTION"]>0)
	{
		$arFilter["SECTION_ID"] = $arParams["PARENT_SECTION"];
		$arFilter["INCLUDE_SUBSECTIONS"] = "Y";
	}
	//ORDER BY
	$arSort = array(
		"DATE_ACTIVE_FROM"=>"ASC",
	);
	//EXECUTE
	$rsIBlockElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
	$rsIBlockElement->SetUrlTemplates($arParams["DETAIL_URL"]);
	if($arResult = $rsIBlockElement->GetNext())
	{
		$this->SetResultCacheKeys(array(
		));
		$this->IncludeComponentTemplate();
	}
	else
	{
		$this->AbortResultCache();
	}
}
?>
