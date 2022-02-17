<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
$arTemplateParameters = array(
	"LIST_DISPLAY_SPECIALDATE" => Array(
		"NAME" => Loc::getMessage("T_IBLOCK_DISPLAY_SPECIALDATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"DETAIL_DISPLAY_LINK_CAN_ID" => Array(
		"NAME" => Loc::getMessage("DETAIL_DISPLAY_LINK_CAN_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"REPORT_AJAX" => Array(
		"NAME" => Loc::getMessage("REPORT_AJAX"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "",
	),
	
);
?>
