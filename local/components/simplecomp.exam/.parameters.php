<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("EXAM2_CAT_IBLOCK_ID"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"NEWS_IBLOCK_ID" => array(
			"NAME" => GetMessage("EXAM2_NEWS_IBLOCK_ID"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"PRODUCTS_IBLOCK_ID_PROPERTY" => array(
			"NAME" => GetMessage("EXAM2_CAT_PROPERTY"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"TEMPLATE_DETAIL_URL" => array(
			"NAME" => GetMessage("EXAM2_TEMPLATE_81"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
			"DEFAULT" => "catalog_exam/#SECTION_ID#/#ELEMENT_CODE#"
		),
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);