<?php

session_start();

require_once "lib/functions.inc.php";
require_once 'lib/Smarty/Smarty.class.php';
require_once("lib/phpFlickr/phpFlickr.php");
require_once "lib/settings.php";

$url = $_SERVER["REQUEST_URI"];

if (preg_match('~(.*)\.php(.*)~i', $_SERVER["REQUEST_URI"])) {
    presmeruj404();
}

//odstraneni adr localhostu
$vyraz = "~^$odkaz_rewrite(.*)~i";
if ($odkaz_rewrite AND preg_match($vyraz, $url)) {
    $url = preg_replace($vyraz, '\\1', $url);
}

//odstraneni vsech parametru za ? vcetne (Pristupne pres $_GET)
$vyraz = '~(.*)\?(.*)~i';
if (preg_match($vyraz, $url)) {
    $url = preg_replace($vyraz, '\\1', $url);
}

//odstraneni prvniho a posledniho lomitka
$vyraz = '~^/(.*)/$~i';
$url = preg_replace($vyraz, '\\1', $url);

$request_url = explode('/', $url);
$count = count($request_url);

// pro rozliseni behu webu na localhostu, nebo na webu
$smarty->assign('odkaz_rewrite', "$odkaz_rewrite");

// nastavujeme pro stranky, ktere se nemaji indexovat
$smarty->assign('meta_noindex', false);

// zjistime URL stranky a kontroler
$homepage = true;
$url_stranky = 'uvodni-strana';
if (!empty($request_url[0])) {
    $url_stranky = $request_url[0];
    $homepage = false;
}
$smarty->assign('homepage', $homepage);

// vyzkousime najit URL request jako soubor
if (file_exists("./php/$url_stranky.php")) {
    // nacteme dany soubor
    require_once "./php/$url_stranky.php";

} else {
    // nebo chyba
    header('Location: /404/');
    exit;
}
