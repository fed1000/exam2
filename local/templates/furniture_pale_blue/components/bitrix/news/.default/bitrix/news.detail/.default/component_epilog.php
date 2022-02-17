<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult['PROPERTY_LINK_REL_NEWS'])) {
    $APPLICATION->SetPageProperty("canonical", $arResult['PROPERTY_LINK_REL_NEWS']);
}

//ex2-104
CJSCore::Init();
if ($_GET["TYPE"] == "REPORT_RESULT") {
    if ($_GET["ID"]) {
        echo '
            <script>
                var textElem = document.getElementById("ajax-report-text");
                textElem.innerText = "Ваше мнение учтено, №' . $_GET["ID"] . '";
                window.history.pushState(null, null, "' . $APPLICATION->GetCurPage() . '");
            </script>
            ';
    } else {
        echo '
            <script>
                var textElem = document.getElementById("ajax-report-text");
                textElem.innerText = "Ошибка!";
                window.history.pushState(null, null, "' . $APPLICATION->GetCurPage() . '");
            </script>
            ';
    }
} else if (isset($_GET["ID"])) {
    $jsonObject = array();
    if (CModule::IncludeModule("iblock")) {
        $arUser = "";
        if ($USER->isAuthorized()) {
            $arUser = $USER->GetID()." (" . $USER->GetLogin() . ") " . $USER->GetFullName();
        } else {
            $arUser = "Не авторизован";
        }
        $arField = array(
            "IBLOCK_ID" => 11,
            "NAME" => "Новость" . $_GET["ID"],
            "ACTIVE_FROM" => \Bitrix\Main\Type\DateTime::createFromTimestamp(time()),
            "PROPERTY_VALUES" => array(
                "USER" => $arUser,
                "NEWS" => $_GET["ID"],
            )
        );
        $element = new CIBlockElement(false);
        if ($elId = $element->Add($arField)) {
            $jsonObject["ID"] = $elId;
            if ($_GET["TYPE"] == "REPORT_AJAX") {
                $APPLICATION->RestartBuffer();
                echo json_encode($jsonObject);
                die();
            } else if ($_GET["TYPE"] == "REPORT_GET") {
                LocalRedirect($APPLICATION->GetCurPage() . "?TYPE=REPORT_RESULT&ID=" . $jsonObject["ID"]);
            }
        } else {
            LocalRedirect($APPLICATION->GetCurPage() . "?TYPE=REPORT_RESULT");
        }
    }
}
