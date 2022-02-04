<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult["NEWS"] as $key => $arNews) {
    foreach ($arNews["PRODUCTS"] as $arProduct) {
        if(!empty($arProduct["PROPERTY_PRICE_VALUE"])){
            $arPrice[] = $arProduct["PROPERTY_PRICE_VALUE"];
        }
    }
}

$arResult["MIN_PRICE"] = min($arPrice);
$arResult["MAX_PRICE"] = max($arPrice);
$this->__component->SetResultCacheKeys("MIN_PRICE", "MAX_PRICE");