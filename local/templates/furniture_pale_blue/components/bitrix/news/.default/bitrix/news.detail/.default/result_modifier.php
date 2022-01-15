<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (isset($arParams['DETAIL_DISPLAY_LINK_CAN_ID'])) {
    $res = CIBlockElement::GetList(
        array(),
        array(
            'IBLOCK_ID' => intval($arParams['DETAIL_DISPLAY_LINK_CAN_ID']),
            'SITE_ID' => SITE_ID,
            'ACTIVE' => 'Y',
            'PROPERTY_LINK_REL_NEWS' => $arResult["ID"],
        ),
        false,
        false,
        array('IBLOCK_ID', 'ID','NAME', 'PROPERTY_LINK_REL_NEWS')
    );
    while ($ar_res = $res->Fetch()) {
        if(!empty($ar_res["NAME"])){
            $arResult['PROPERTY_LINK_REL_NEWS'] = $ar_res['NAME'];
        }
    }
    if(isset($arResult['PROPERTY_LINK_REL_NEWS'])){
        $cp = $this->__component;
        $cp->SetResultCacheKeys(array('PROPERTY_LINK_REL_NEWS'));
    }
}

