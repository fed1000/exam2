<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?></b></p>
<? if (count($arResult["CLASSIF"]) > 0) { ?>
    <ul>
        <? foreach ($arResult["CLASSIF"] as $arClassificator) { ?>
            <li>
                <b>
                    <?=$arClassificator["NAME"];?>
                </b>
                <? if(count($arClassificator["ELEMENTS"]) > 0){ ?>
                    <? foreach ($arClassificator["ELEMENTS"] as $arItems) { //echo "<pre>"; var_dump($arItems); echo "</pre>";?>
                        <li>
                            <?=$arItems["NAME"];?> -
                            <?=$arItems["PROPERTIES"]["PRICE"]["VALUE"];?> -
                            <?=$arItems["PROPERTIES"]["MATERIAL"]["VALUE"];?> -
                            <?=$arItems["PROPERTIES"]["ARTNUMBER"]["VALUE"];?>
                            <a href="<?=$arItems["DETAIL_PAGE_URL"]?>">Ссылка на детальный просмотр</a>
                        </li>
                    <? } ?>
                <? } ?>
            </li>
        <? } ?>
    </ul>
<? } ?>