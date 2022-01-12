<?
function AgentCheckPrice(){
	if(CModule::IncludeModule("iblock")){
		$arSelect = Array("ID", "NAME", "PROPERTY_PRICE");
		$arFilter = Array("IBLOCK_ID" =>IBLOCK_PRODUCT_ID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_PRICE" => false);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
		echo "1";
		while($ob = $res->GetNextElement()){
			$arFields = $ob->GetFields();
			$arItems[] = $arFields;
		}

		CEventLog::Add(array(
			"SEVERITY" => "SECURITY",
			"AUDIT_TYPE_ID" => "CHECK_PRICE",
			"MODULE_ID" => "iblock",
			"ITEM_ID" => "",
			"DESCRIPTION" => "Проверка цен, нет цен для " . count($arItems) . " элементов",
		));

		if(count($arItems) > 0){
			$filter = array("GROUPS_ID" => array(GROUPS_ID_ADMIN));
			$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); 
			while($arUser = $rsUsers->GetNext()){
				$arEmail[] = $arUser["EMAIL"];
			}
			if(count($arEmail) > 0){
				$arEventFields = array(
					"TEXT" => count($arItems),
					"EMAIL" => implode(", ", $arEmail),
				);
				CEvent::Send("CHECK_CATALOG", SITE_ID, $arEventFields);
			}
		}

		return "AgentCheckPrice();";

	}
}
?>