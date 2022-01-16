<?
IncludeModuleLangFile(__FILE__);
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("ElementUpdateProduct", "OnBeforeIBlockElementUpdateHandler"));
class ElementUpdateProduct
{
    // создаем обработчик события "OnBeforeIBlockUpdate"
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        if($arFields["IBLOCK_ID"] == IBLOCK_PRODUCT_ID_NEW){
            if($arFields["ACTIVE"] === "N"){
                $arSelect = Array("ID", "IBLOCK_ID", "NAME", "SHOW_COUNTER");
                $arFilter = Array("IBLOCK_ID"=>IntVal($arFields["IBLOCK_ID"]), "ID" => $arFields["ID"]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                $elementFields = $res->Fetch();

                if($elementFields["SHOW_COUNTER"] > MAX_COUNT){
                    global $APPLICATION;
                    $sText = GetMessage("PRODUCT_COUNT_TEXT", array("#COUNT#" => $elementFields["SHOW_COUNTER"]));
                    $APPLICATION->throwException($sText);
                    return false;
               }
           }
        }
    }
}
//use Bitrix\Main\EventManager;
//$eventManager = EventManager::getInstance();
//$eventManager->addEventHandler("iblock", "OnBeforeIBlockElementUpdate", array("CIBlockHandler", "OnBeforeIBlockElementUpdateHandler"));
/*AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("CIBlockHandler", "OnBeforeIBlockElementUpdateHandler"));

class CIBlockHandler
{
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        if($arFields['IBLOCK_ID'] == IBLOCK_PRODUCT_ID){
	        $db_props = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID'], array("sort" => "asc"), Array("CODE"=>"PRICE"));
			if($ar_props = $db_props->Fetch()){
				if(strlen($arFields['PROPERTY_VALUES'][$ar_props["ID"]][$ar_props["PROPERTY_VALUE_ID"]]['VALUE']) > 0){
					$arFields['PROPERTY_VALUES'][$ar_props["ID"]][$ar_props["PROPERTY_VALUE_ID"]]['VALUE'] = preg_replace("/[^\d]/", "", $arFields['PROPERTY_VALUES'][$ar_props["ID"]][$ar_props["PROPERTY_VALUE_ID"]]['VALUE']);
				}
			}

        }
			var_dump("event");    var_dump($arFields, "2353453");
    }
}

AddEventHandler("main", "OnBeforeEventAdd", array("CMainHandler", "OnBeforeEventAddHandler"));
AddEventHandler("main", "OnBeforeUserAdd", Array("CMainHandler", "OnBeforeUserAddHandler"));
class CMainHandler
{
    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if($event == "FEEDBACK_FORM"){
            if(CModule::IncludeModule("iblock")){
                $el = new CIBlockElement;
                $arLoadProductArray = array(
                    "IBLOCK_ID" => IBLOCK_FEEDBACK_ID,
                    "NAME" => $arFields["AUTHOR"],
                    "DETAIL_TEXT" => $arFields["TEXT"],
                    "DATE_ACTIVE_FROM" => ConvertTimeStamp(false, "FULL"),
                );
                $el->Add($arLoadProductArray);
            }
        }
    }

    // создаем обработчик события "OnBeforeUserAdd"
    function OnBeforeUserAddHandler(&$arFields)
    {
        if($arFields["LAST_NAME"] == $arFields["NAME"])
        {
            global $APPLICATION;
            $APPLICATION->throwException("Имя и фамилия одинаковы !");
            return false;
        }
    }
}
*/