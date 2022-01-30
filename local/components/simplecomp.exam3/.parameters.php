<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"NEWS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
		"PROPERTY_AUTHOR" => array(
			"NAME" => GetMessage("PROPERTY_AUTHOR"),
			"TYPE" => "STRING",
		),
		"PROPERTY_AUTHOR_TYPE" => array(
			"NAME" => GetMessage("PROPERTY_AUTHOR_TYPE"),
			"TYPE" => "STRING",
		),
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);