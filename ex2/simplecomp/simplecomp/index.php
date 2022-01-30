<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 2(ex2-71)");
?><?$APPLICATION->IncludeComponent(
	"simplecomp.exam2", 
	".default", 
	array(
		"CODE_LINK_PRODUCT_IN_CLASS" => "FIRMA",
		"COMPONENT_TEMPLATE" => ".default",
		"KLASSIF_IBLOCK_ID" => "10",
		"KLASS_IBLOCK_ID" => "10",
		"PRODUCTS_IBLOCK_ID" => "4",
		"TEMPLATE_DETAIL_LINK" => "#SITE_DIR#/products/#SECTION_ID#/#ID#/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>