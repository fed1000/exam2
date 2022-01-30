<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 2(ex2-71)");
?><?$APPLICATION->IncludeComponent(
	"simplecomp.exam2",
	".default",
	Array(
		"CODE_LINK_PRODUCT_IN_CLASS" => "FIRMA",
		"COMPONENT_TEMPLATE" => ".default",
		"KLASSIF_IBLOCK_ID" => "10",
		"KLASS_IBLOCK_ID" => "10",
		"PRODUCTS_IBLOCK_ID" => "4",
		"TEMPLATE_DETAIL_LINK" => "/#SECTION_CODE#/#ELEMENT_ID#/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>