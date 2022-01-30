<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
		"KLASSIF_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_KLASS_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
		"TEMPLATE_DETAIL_LINK" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_TEMPLATE_DETAIL_LINK"),
			"TYPE" => "STRING",
		),
		"CODE_LINK_PRODUCT_IN_CLASS" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CODE_LINK_PRODUCT_IN_CLASS"),
			"TYPE" => "STRING",
		),
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);