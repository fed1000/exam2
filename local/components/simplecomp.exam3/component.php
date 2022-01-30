<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if (!Loader::includeModule("iblock")) {
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

// время кеширования
if (!isset($arParams['CACHE_TIME'])) {
    $arParams['CACHE_TIME'] = 3600;
} else {
    $arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']);
}
if($this->startResultCache(false, array($USER->GetGroups()))){
	if (intval($arParams["NEWS_IBLOCK_ID"]) > 0) {
		if ($USER->isAuthorized()) {
			$arUserId = array();
	
			$arResult["USERS"] = array();
			$idUserCurrent = $USER->GetID();
			$strUserType = $USER->GetParam($arParams["PROPERTY_AUTHOR_TYPE"]);
			$rsUsers = CUser::GetList($arOrderUser, $sortOrder, $arFilterUser, array("SELECT" => array($arParams["PROPERTY_AUTHOR_TYPE"]), "FIELDS" => array("ID", "LOGIN"))); // выбираем пользователей
			while ($arUser = $rsUsers->Fetch()) {
				$temp["USERS"][$arUser["ID"]] = $arUser;
			}
	
			foreach ($temp["USERS"] as $key => $value) {
				if ($temp["USERS"][$idUserCurrent][$arParams["PROPERTY_AUTHOR_TYPE"]] == $value[$arParams["PROPERTY_AUTHOR_TYPE"]]) {
					if ($idUserCurrent != $value["ID"]) {
						$arResult["USERS"][$value["ID"]] = $value;
						$arUserId[] = $value["ID"];
					}
				}
			}
			$arResult["COUNT"] = 0;
			//iblock elements
			$arSelectElems = array(
				"ID",
				"IBLOCK_ID",
				"NAME",
				"DATE_ACTIVE_FROM",
				"PROPERTY_" . $arParams["PROPERTY_AUTHOR"],
			);
			$arFilterElems = array(
				"IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
				"ACTIVE" => "Y",
				"PROPERTY_" . $arParams["PROPERTY_AUTHOR"] => $arUserId,
			);
			$arSortElems = array();
			$rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
			while ($arElement = $rsElements->GetNextElement()) {
				$arField =  $arElement->GetFields();
				$arField["PROPERTIES"] = $arElement->GetProperties();
				if (!in_array(intval($idUserCurrent), $arField["PROPERTIES"][$arParams["PROPERTY_AUTHOR"]]["VALUE"])) {
					$arResult["USERS"][$arField["PROPERTY_AUTHOR_VALUE"]]["NEWS"][] = $arField;
					$arResult["COUNT"]++;
				}
			}
			
		}

		$this->SetResultCacheKeys(array("COUNT"));
		$this->EndResultCache();
	}
	$this->includeComponentTemplate();
}
else{
	$this->abortResultCache();
}

$APPLICATION->SetTitle(GetMessage("COUNT_NEWS_TITLE") . $arResult["COUNT"] );

