<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?
$email = COption::GetOptionString("main", "email_from");
echo "admin email - " . $email . "<br/>";

COption::SetOptionString("main", "MY_PARAMETER", "Y");
$parameter = COption::GetOptionString("main", "MY_PARAMETER");
echo "MY_PARAMETER - " . $parameter;

if(CModule::IncludeModule("iblock")){
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_TO");
	$arFilter = Array("IBLOCK_ID" =>IBLOCK_ACTION_ID, "ACTIVE" => "Y", "<DATE_ACTIVE_TO" => date("d.m.Y H:i:s") );
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
	echo "1";
	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$arItems[] = $arFields;
	}
	echo "<pre>";
		print_r($arItems);
		$today = date("d.m.Y H:i:s");
	echo $today;
	echo "</pre>";

	/*CEventLog::Add(array(
		"SEVERITY" => "SECURITY",
		"AUDIT_TYPE_ID" => "CHECK_PRICE",
		"MODULE_ID" => "iblock",
		"ITEM_ID" => "",
		"DESCRIPTION" => "Проверка цен, нет цен для " . count($arItems) . " элементов",
	));*/

	/*if(count($arItems) > 0){
		$filter = array("GROUPS_ID" => array(1));
		$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); 
		while($arUser = $rsUsers->GetNext()){
			$arEmail[] = $arUser["EMAIL"];
			var_dump($arUser);
		}
		if(count($arEmail) > 0){
			$arEventFields = array(
				"TEXT" => count($arItems),
				"EMAIL" => implode(", ", $arEmail),
			);
			CEvent::Send("CHECK_CATALOG", SITE_ID, $arEventFields);
		}
	}*/

}
?><?$APPLICATION->IncludeComponent("mycomponents:photo.random", "main", Array(
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "180",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
		"IBLOCKS" => array(
			0 => "4",
		),
		"IBLOCK_ID" => "4",	// Инфоблок
		"IBLOCK_PROP" => "11",	// C каким свойством показывать
		"IBLOCK_TYPE" => "products",	// Тип инфоблока
		"IMG_HEIGHT" => "96",	// Высота изображения
		"IMG_WIDTH" => "130",	// Ширина изображения
		"PARENT_SECTION" => "",	// ID раздела
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>