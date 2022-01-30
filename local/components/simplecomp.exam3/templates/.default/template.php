<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?if(!empty($arResult["USERS"])){?>
    <ul>
        <? foreach ($arResult["USERS"] as $key => $arUser) {?>
            <li>
            [<?=$arUser["ID"]?>] - <?=$arUser["LOGIN"]?>
            <? if(count($arUser["NEWS"]) > 0){?>
                <? foreach ($arUser["NEWS"] as $k => $arNews) {?>
                    <li><?=$arNews["NAME"];?></li>
                <?} ?>
            <?} ?>
            </li>
        <?} ?>
    </ul>
 <?   }?>