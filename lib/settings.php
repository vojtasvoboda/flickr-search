<?php

// nastaveni projektu
$project = array();
$project['url'] = $_SERVER["HTTP_HOST"];
$project['title'] = "Vyhledávání přes Flickr API";

// nastaveni odkaz_rewrite
$host = $_SERVER["HTTP_HOST"];
if ($host == "127.0.0.1" OR $host == "localhost") {
    //localhost - predpoklada cestu http://localhost/adresar/
    $url = explode("/", $_SERVER["REQUEST_URI"]);
    $odkaz_rewrite = "/" . $url[1];
} else {
    $odkaz_rewrite = false;
}

// Smarty settings
$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir = 'templates';
$smarty->cache_dir = 'cache';
$smarty->compile_dir = 'cache';
$smarty->assign("project", $project);
