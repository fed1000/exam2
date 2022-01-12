<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= LANGUAGE_ID;?>" lang="<?= LANGUAGE_ID;?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?$APPLICATION->ShowHead();?>

    <?
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH ."/css/normalize.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH ."/css/styles.css");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH ."/js/jquery-3.6.0.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH ."/js/script.js");
    ?>
<meta name="apple-mobile-web-app-title" content="CodePen">
	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<?$APPLICATION->ShowPanel();?>
<nav class="animenu" role="navigation" aria-label="Menu">
  <button class="animenu__btn" type="button">
    <span class="animenu__btn__bar"></span>
    <span class="animenu__btn__bar"></span>
    <span class="animenu__btn__bar"></span>
  </button>

  <ul class="animenu__nav">
    <li><a href="#">Home</a></li>
    <li>
      <a href="#" class="animenu__nav__hasDropdown" aria-haspopup="true">Archive</a>
      <ul class="animenu__nav__dropdown" aria-label="submenu" role="menu">
        <li><a href="#" role="menuitem">Sub Item 1</a></li>
        <li><a href="#" role="menuitem">Sub Item 2</a></li>
        <li><a href="#" role="menuitem">Sub Item 3</a></li>
      </ul>
    </li>
    <li>
      <a href="#" class="animenu__nav__hasDropdown" aria-haspopup="true">Categories</a>
      <ul class="animenu__nav__dropdown" aria-label="submenu" role="menu">
        <li><a href="#" role="menuitem">Sub Item 1</a></li>
        <li><a href="#" role="menuitem">Sub Item 2</a></li>
        <li><a href="#" role="menuitem">Sub Item 3</a></li>
      </ul>
    </li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
</nav>