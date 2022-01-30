<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Разработать простой компонент «Новости по интересам» [ex2-97] ");
?><?$APPLICATION->IncludeComponent(
	"simplecomp.exam3", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PRODUCTS_IBLOCK_ID" => "3",
		"PROPERTY_AUTHOR" => "AUTHOR",
		"NEWS_IBLOCK_ID" => "3",
		"PROPERTY_AUTHOR_TYPE" => "UF_AUTHOR_TYPE"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>