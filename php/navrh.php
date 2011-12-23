<?php
  if (!defined('IN_CODE')){
    require_once "lib/functions.inc.php";
    presmeruj404();
  }


  
display_all($request_url[0]);

?>
