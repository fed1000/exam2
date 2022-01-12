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
	<div class="item-wrap">
		<div class="rew-footer-carousel">
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?><br />
		<?endif;?>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="item"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="side-block side-opin">
					<div class="inner-block">
						<div class="title">
							<div class="photo-block">
								<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
									<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
										<?$arPhotoSmall = CFile::ResizeImageGet(
											$arItem["PREVIEW_PICTURE"]["ID"], 
											array(
												'width'=>49,
												'height'=>49
											), 
											BX_RESIZE_IMAGE_PROPORTIONAL,/// BX_RESIZE_IMAGE_EXACT,
											Array(
												"name" => "sharpen", 
												"precision" => 0
											)
										);?>
										<img
											class="preview_picture"
											border="0"
											src="<?=$arPhotoSmall['src']?>"
											width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
											height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
											alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
											title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
											style=""
											/>
									<?else:?>
										<img
											class="preview_picture"
											border="0"
											src="<?=$arPhotoSmall['src']?>"
											alt="no photo"
											title="no photo"
											style=""
											/>
									<?endif;?>
									<?else:?>
										<img
										class="preview_picture"
										border="0"
										src="<?=$templateFolder;?>/img/no_photo_left_block.jpg"
										alt="no photo"
										title="no photo"
										style=""
										/>
								<?endif;?>
							</div>
							<div class="name-block">
								<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
									<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
										<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
									<?else:?>
										<?echo $arItem["NAME"]?>
									<?endif;?>
								<?endif;?>
							</div>
							<div class="pos-block">
								<?if(!empty($arItem["PROPERTIES"]["POSITION"]["VALUE"])):?>
									<?echo $arItem["PROPERTIES"]["POSITION"]["VALUE"]?>,
								<?endif?>
								<?if(!empty($arItem["PROPERTIES"]["COMPANY"]["VALUE"])):?>
									<?echo $arItem["PROPERTIES"]["COMPANY"]["VALUE"]?>
								<?endif?>
							</div>
						</div>
						<div class="text-block">
							<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
								<?$obParser = new CTextParser; //TruncateText($arItem["PREVIEW_TEXT"], $arParams["PREVIEW_TRUNCATE_LEN"])
								if($arParams["PREVIEW_TRUNCATE_LEN"] > 0)
								$arItem["PREVIEW_TEXT"] = $obParser->html_cut($arItem["PREVIEW_TEXT"], $arParams["PREVIEW_TRUNCATE_LEN"]);?>
								<?echo $arItem["PREVIEW_TEXT"];?>
							<?endif;?>
						</div>
					</div>
				</div>
			</div>
		<?endforeach;?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<br /><?=$arResult["NAV_STRING"]?>
		<?endif;?>
		</div>
	</div>
</div>
