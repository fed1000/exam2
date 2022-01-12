<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("color_menu_style", "green");
$APPLICATION->SetTitle("Просмотр и редактирование профиля");
?><?
global $USER;
	// получаем поля пользователя по его id.
	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
	$id = $arUser['ID'];

	$APPLICATION->IncludeComponent(
		"bitrix:blog.user",
		"",
		Array(
			"BLOG_VAR" => "",
			"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
			"ID" => $id,
			"PAGE_VAR" => "",
			"PATH_TO_BLOG" => "",
			"PATH_TO_SEARCH" => "",
			"PATH_TO_USER" => "",
			"PATH_TO_USER_EDIT" => "",
			"SET_TITLE" => "Y",
			"USER_CONSENT" => "N",
			"USER_CONSENT_ID" => "0",
			"USER_CONSENT_IS_CHECKED" => "Y",
			"USER_CONSENT_IS_LOADED" => "N",
			"USER_PROPERTY" => array(),
			"USER_VAR" => ""
		)
	);
?><br><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>