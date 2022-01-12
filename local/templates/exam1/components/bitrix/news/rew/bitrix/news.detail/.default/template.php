<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="review-block">
	<div class="review-text">
		<div class="review-text-cont">
			<?if(!empty($arResult["DETAIL_TEXT"])):?>
				<?echo $arResult["DETAIL_TEXT"];?>
			<?elseif(!empty($arResult["PREVIEW_TEXT"])):?>
				<?echo $arResult["PREVIEW_TEXT"];?>
			<?endif?>
		</div>
		<div class="review-autor">
			<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
				<?=$arResult["NAME"]?>,
			<?endif;?>
			<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
				<?=$arResult["DISPLAY_ACTIVE_FROM"]?> <?=GetMessage('YEAR');?>,
			<?endif;?>
			<?if(!empty($arResult["PROPERTIES"]["POSITION"]["VALUE"])):?>
				<?echo $arResult["PROPERTIES"]["POSITION"]["VALUE"]?>,
			<?endif?>
			<?if(!empty($arResult["PROPERTIES"]["COMPANY"]["VALUE"])):?>
				<?echo $arResult["PROPERTIES"]["COMPANY"]["VALUE"]?>
			<?endif?>
		</div>
	</div>
	<div style="clear: both;" class="review-img-wrap">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
			<img
				class="detail_picture"
				border="0"
				src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
				width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
				height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
				alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
				title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
				/>
		<?else:?>
			<img
				class="preview_picture"
				border="0"
				src="<?=$templateFolder;?>/img/no_photo.jpg"
				alt="no photo"
				title="no photo"
				style=""
				/>
		<?endif?>
	</div>
</div>
<?if(!empty($arResult["PROPERTIES"]["FILE"]["VALUE"])){?>
	<div class="exam-review-doc">
		<p><?=GetMessage("DOCUMENTS_TITLE");?></p>
		<?
		if (!empty($arResult["PROPERTIES"]["FILE"]["VALUE"])){?>
			<? foreach ($arResult["PROPERTIES"]["FILE"]["VALUE"] as $key => $value) {?>
				<?$arFile = CFile::GetFileArray($value);?>
				<div  class="exam-review-item-doc"><img class="rew-doc-ico" src="<?=SITE_TEMPLATE_PATH;?>/img/icons/pdf_ico_40.png">
						<a download href="<?=$arFile['SRC']?>">
							<?=$arFile['ORIGINAL_NAME'];?>
						</a>
				</div>
			<?}?>
		<?}?>
	</div>
<?}?>
<hr>

