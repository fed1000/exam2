<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница 2");
?><?$APPLICATION->IncludeComponent(
	"mycomponents:last.event",
	"",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "180",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "vacancies",
		"PARENT_SECTION" => ""
	)
);?><br><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>