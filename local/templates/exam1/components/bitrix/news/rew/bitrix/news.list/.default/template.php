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
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="review-block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="review-text">
			<div class="review-block-title">
				<span class="review-block-name">
					<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
						<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
							<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
						<?else:?>
							<?echo $arItem["NAME"]?>
						<?endif;?>
					<?endif;?>
				</span>
				<span class="review-block-description">
					<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
						<?echo $arItem["DISPLAY_ACTIVE_FROM"]?> <?=GetMessage('YEAR');?>,
					<?endif?>
		 			<?if(!empty($arItem["PROPERTIES"]["POSITION"]["VALUE"])):?>
						<?echo $arItem["PROPERTIES"]["POSITION"]["VALUE"]?>,
					<?endif?>
					<?if(!empty($arItem["PROPERTIES"]["COMPANY"]["VALUE"])):?>
						<?echo $arItem["PROPERTIES"]["COMPANY"]["VALUE"]?>
					<?endif?>
				</span>
			</div>
			<div class="review-text-cont">
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<?echo $arItem["PREVIEW_TEXT"];?>
				<?endif;?>
			</div>
		</div>
		<div class="review-img-wrap">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["DETAIL_PICTURE"]) || $arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
		<?
			if($arItem["DETAIL_PICTURE"]["ID"]){
				$arPhotoSmall = CFile::ResizeImageGet(
					$arItem["DETAIL_PICTURE"]["ID"],
					array(
					'width'=>68,
					'height'=>50
					),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true
				);
				if(!empty($arPhotoSmall["src"])){
					$arItem["PREVIEW_PICTURE"]["SRC"] = $arPhotoSmall["src"];
					$arItem["PREVIEW_PICTURE"]["WIDTH"] = $arPhotoSmall["width"];
					$arItem["PREVIEW_PICTURE"]["HEIGHT"] = $arPhotoSmall["height"];
				}
			}
			?>

			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style=""
					/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					alt="no photo"
					title="no photo"
					style=""
					/>
			<?endif;?>
			<?else:?>
				<img
				class="preview_picture"
				border="0"
				src="<?=$templateFolder;?>/img/no_photo.jpg"
				alt="no photo"
				title="no photo"
				style=""
				/>
				<?endif;?>
		</div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
