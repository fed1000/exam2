<?
function AgentCheckAction(){
	if(CModule::IncludeModule("iblock")){
		$arSelect = Array("ID", "NAME", "DATE_ACTIVE_TO");
		$arFilter = Array("IBLOCK_ID" =>IBLOCK_ACTION_ID, "ACTIVE" => "Y", "<DATE_ACTIVE_TO" => date("d.m.Y H:i:s") );
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
		echo "1";
		while($ob = $res->GetNextElement()){
			$arFields = $ob->GetFields();
			$arItems[] = $arFields;
		}

		CEventLog::Add(array(
			"SEVERITY" => "SECURITY",
			"AUDIT_TYPE_ID" => "CHECK_ACTION",
			"MODULE_ID" => "iblock",
			"ITEM_ID" => "",
			"DESCRIPTION" => "Проверка акций истекших -  " . count($arItems) . " элементов",
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
				CEvent::Send("CHECK_ACTION", SITE_ID, $arEventFields);
			}
		}

		return "AgentCheckAction();";

	}
}
?>