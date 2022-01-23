<?
IncludeModuleLangFile(__FILE__);
///[ex2-50] Проверка при деактивации товара 
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", array("ElementUpdateProduct", "OnBeforeIBlockElementUpdateHandler"));
class ElementUpdateProduct
{
    // создаем обработчик события "OnBeforeIBlockUpdate"
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        if ($arFields["IBLOCK_ID"] == IBLOCK_PRODUCT_ID_NEW) {
            if ($arFields["ACTIVE"] === "N") {
                $arSelect = array("ID", "IBLOCK_ID", "NAME", "SHOW_COUNTER");
                $arFilter = array("IBLOCK_ID" => IntVal($arFields["IBLOCK_ID"]), "ID" => $arFields["ID"]);
                $res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
                $elementFields = $res->Fetch();

                if ($elementFields["SHOW_COUNTER"] > MAX_COUNT) {
                    global $APPLICATION;
                    $sText = GetMessage("PRODUCT_COUNT_TEXT", array("#COUNT#" => $elementFields["SHOW_COUNTER"]));
                    $APPLICATION->throwException($sText);
                    return false;
                }
            }
        }
    }
}
///[ex2-93] Записывать в Журнал событий открытие не существующих страниц сайта
AddEventHandler("main", "OnEpilog", "error_page");
function error_page()
{
    global $APPLICATION;
    $page = $APPLICATION->GetCurUri();
    $page_404 = "/404.php";
    if (strpos($APPLICATION->GetCurPage(), $page_404) === false && defined("ERROR_404") && ERROR_404 == "Y") {
        $APPLICATION->RestartBuffer();
        // подключаем файлы для отображения страницы 404
        include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/header.php";
        include $_SERVER["DOCUMENT_ROOT"] . $page_404;
        include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/footer.php";
        //запись в журнал событий
        CEventLog::Add(array(
            "SEVERITY" => "INFO",
            "AUDIT_TYPE_ID" => "ERROR_404",
            "MODULE_ID" => "main",
            "DESCRIPTION" => $page,
        ));
    }
}
//[ex2-51] Изменение данных в письме
AddEventHandler("main", "OnBeforeEventAdd", array("CMainHandler", "OnBeforeEventAddHandler"));
AddEventHandler("main", "OnBuildGlobalMenu", array("CMainHandler", "globalMenuContentManager"));
class CMainHandler
{
    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if ($event == "FEEDBACK_FORM") {
            global $USER;
            if ($USER->isAuthorized()) {
                $sTextAuthorAuthorized = GetMessage(
                    'FEEDBACK_USER_AUTH',
                    array(
                        '#USER_ID#' => $USER->GetID(),
                        '#USER_LOGIN#' => $USER->GetLogin(),
                        '#USER_NAME#' => $USER->GetFullName(),
                        '#AUTHOR#' => $arFields["AUTHOR"]
                    )
                );
                $arFields["AUTHOR"] =  $sTextAuthorAuthorized;
            } else {
                $sTextAuthorNoAuthorized = GetMessage('FEEDBACK_USER_NOAUTH', array('#AUTHOR#' => $arFields["AUTHOR"]));
                $arFields["AUTHOR"] =  $sTextAuthorNoAuthorized;
            }
            CEventLog::Add(array(
                "SEVERITY" => "SECURITY",
                "AUDIT_TYPE_ID" => $event,
                "MODULE_ID" => "main",
                "DESCRIPTION" => GetMessage('FEEDBACK_USER_EVENT_REPLACEMENT', array('#AUTHOR#' => $arFields["AUTHOR"])),
            ));
        }
    }
    //[ex2-95] Упростить меню в адмистративном разделе для контент-менеджера
    function globalMenuContentManager(&$aGlobalMenu, &$aModuleMenu)
    {
        global $USER;
        $userGroup = CUSER::GetUserGroupList($USER->GetID());
        $contentGroupID = CGroup::GetList(
            $by = "c_sort",
            $order = "asc",
            array(
                "STRING_ID" => "content_editor"
            )
        )->Fetch()["ID"];
        //перебираем группы пользователя
        while ($group  = $userGroup->Fetch()) {
            if ($group["GROUP_ID"] == 1) {
                $isAdmin = true;
            }
            if ($group["GROUP_ID"] == $contentGroupID) {
                $isManager = true;
            }
            if (!$isAdmin && $isManager) {
                foreach ($aModuleMenu as $key => $item) {
                    if ($item["items_id"] == "menu_iblock_/news") {
                        $aModuleMenu = [$item];
                        foreach ($item["items"] as $childItem) {
                            if ($childItem["items_id"] == "menu_iblock_/news/1") {
                                $aModuleMenu[0]["items"] = [$childItem];
                                break;
                            }
                        }
                        break;
                    }
                }
                $aGlobalMenu = ["global_menu_content" => $aGlobalMenu["global_menu_content"]];
            }
        }
    }
}
//[ex2-94] Супер инструмент SEO специалиста
AddEventHandler("main", "OnBeforeProlog", array("CIblockElementProperty", "OnBeforeIBlockUpdateProperty"));
class CIblockElementProperty
{
    function OnBeforeIBlockUpdateProperty()
    {
        global $APPLICATION;
        $curPage = $APPLICATION->GetCurDir();

        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            $arFilter = array(
                "IBLOCK_ID" => IBLOCK_META,
                "NAME" => $curPage
            );
            $arSelect = array(
                "IBLOCK_ID",
                "ID",
                "PROPERTY_TITLE",
                "PROPERTY_DESCRIPTION",
            );
            $ob = CIblockElement::Getlist(
                array(),
                $arFilter,
                false,
                false,
                $arSelect
            );
            if ($arRes = $ob->Fetch()) {
                $APPLICATION->SetPageProperty('title', $arRes['PROPERTY_TITLE_VALUE']);
                $APPLICATION->SetPageProperty('description', $arRes['PROPERTY_DESCRIPTION_VALUE']);
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