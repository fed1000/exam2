<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<a href="" class="btn-menu btn-toggle"></a>
                    <div class="menu popup-block">
<ul >
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
	<?if(!empty($arItem["PARAMS"]["COLOR"])):?>
		<?$colorMenu = $arItem["PARAMS"]["COLOR"];?>
	<?else:?>
		<?$colorMenu = "";?>
	<?endif;?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<? //<Текст перед пунктами под-меню> ?>
			
			<li><a href="<?=$arItem["LINK"]?>" class="<?=$colorMenu;?> <?if ($arItem["SELECTED"]):?><?else:?><?endif?>"><?=$arItem["TEXT"]?></a>
				<ul>
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class=""<?endif?>><a href="<?=$arItem["LINK"]?>" class=""><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>
		
		<? if ($arItem["PARAMS"]["DESCRIPTION"]):?>
            <div class="menu-text">
                <?= $arItem["PARAMS"]["DESCRIPTION"] ?>
            </div>
        <? endif; ?>

	<?else:?>
		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>" class="<?=$colorMenu;?> <?if ($arItem["SELECTED"]):?><?else:?><?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li<?if ($arItem["SELECTED"]):?> class=""<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?><?else:?><?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<a href="" class="btn-close"></a>
                    </div>
<?endif?>