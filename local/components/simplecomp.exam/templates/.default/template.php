<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?
$url = $APPLICATION->GetCurPage()."?F=Y";
echo GetMessage("FILTER_TITLE")."<a href='".$url."'>".$url."</a>"."<br>";
?>
<?
if(count($arResult["NEWS"]) > 0){?>
  <? $this->AddEditAction("add_element", $arResult["ADD_LINK"], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_ADD"));?>
    <ul>
        <? foreach ($arResult["NEWS"] as $arNews) { ?>
            <li>
                <b>
                    <?=$arNews["NAME"];?>
                </b>
                - <?=$arNews["ACTIVE_FROM"];?>
                (<?=implode(",", $arNews["SECTIONS"]);?>)
            </li>
            <? if(count($arNews["PRODUCTS"]) > 0){ ?>
              
                <ul  id="<?=$this->GetEditAreaId("add_element");?>">
                    <? foreach ($arNews["PRODUCTS"] as $arProduct) {?>
                        <?
                        $this->AddEditAction($arNews["ID"]."_".$arProduct['ID'], $arProduct['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arNews["ID"]."_".$arProduct['ID'], $arProduct['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <li id="<?=$this->GetEditAreaId($arNews["ID"]."_".$arProduct['ID']);?>">
                            <?=$arProduct["NAME"];?> -
                            <?=$arProduct["PROPERTY_PRICE_VALUE"];?> -
                            <?=$arProduct["PROPERTY_MATERIAL_VALUE"];?> -
                            <?=$arProduct["PROPERTY_ARTNUMBER_VALUE"];?> -
                            (<?=$arProduct["DETAIL_PAGE_URL"] . ".php";?>)
                        </li>
                    <? } ?>
                </ul>

            <?}?>
        <? } ?>
    </ul>
    <br>
    ---
    <p>
        <b>
            <?=GetMessage("NAVY");?>
        </b>
    </p>
    <?=$arResult["NAV_STRING"];?>
<?}
?>
