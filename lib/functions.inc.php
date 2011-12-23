<?php

  // presmeruje na /404/
  function presmeruj404() {
    header("Location: /404/", TRUE, 404);
    exit;
  }
  
  // presmeruje na /301/
  function presmeruj301() {
    header("Location: /", TRUE, 301);
    exit;
  }  
  
  // vypise datum v normalnim formatu
  function vypis_datum ($datum, $extra=false) {
    if ( !ereg ("^([0-9]+)-([0-9]+)-([0-9]+) ([0-9]+):([0-9]+):([0-9]+)", $datum, $arr) ) {
      $pouze_datum = true;
      if ( !ereg ("^([0-9]+)-([0-9]+)-([0-9]+)", $datum, $arr) )
        return false;
    }   
    
    if ($extra) {
      if ( !empty($pouze_datum) )
        $datum = "$arr[3].$arr[2].$arr[1]";
      else
        $datum = "$arr[3].$arr[2].$arr[1] v $arr[4]:$arr[5]";
    }
    
    else
      if ( !empty($pouze_datum) )
        $datum = "$arr[3].$arr[2].$arr[1]";
      else
        $datum = "$arr[3].$arr[2].$arr[1] $arr[4]:$arr[5]";
      
    return $datum;
  }
  
  // provede kontrolu emailu
  function kontrola_emailu ($addres) {
        // preg pattern for user name
        // http://tools.ietf.org/html/rfc2822#section-3.2.4
        $atext = "[a-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~]";
        $atom = "$atext+(\.$atext+)*";

        // preg pattern for domain
        // http://tools.ietf.org/html/rfc1034#section-3.5
        $dtext = "[a-z0-9]";
        $dpart = "$dtext+(-$dtext+)*";
        $domain = "$dpart+(\.$dpart+)+";

        if(preg_match("/^$atom@$domain$/i", $addres)) {
            list($username, $host) = @split('@', $addres);
            if(checkdnsrr($host,'MX')) {
                return TRUE;
            }
        }
        return FALSE;
  }

  // zobrazime vsechny sablony
  function display_all($template) {
    
    $smarty = $GLOBALS["smarty"];
    
    if ($GLOBALS["odkaz_rewrite"]) {
      $smarty->register_outputfilter('odkaz_rewrite');
    }
    
    $smarty->display('include/header.tpl');
    $smarty->display($template.'.tpl');
    $smarty->display('include/footer.tpl');
  }
  
  // odkazy pro beh na localhostu
  function odkaz_rewrite($tpl_source, &$smarty) {
    
    $nahrada = $GLOBALS["odkaz_rewrite"] . "/";
    
    $vyrazy = array (
      '~<(img)( [^>]*)? (src)="/([^"]+)"([^>]*)>~i',
      '~<(a)( [^>]*)? (href)="/([^"]+)?"([^>]*)>~i',
      '~<(link)( [^>]*)? (href)="/([^"]+)"([^>]*)>~i',
      '~<(script)( [^>]*)? (src)="/([^"]+)"([^>]*)>~i',
      '~<(form)( [^>]*)? (action)="/([^"]+)"([^>]*)>~i',
      '~<(input)( [^>]*)? (src)="/([^"]+)"([^>]*)>~i'
    );
    
    foreach ( $vyrazy as $key=>$vyraz) {
    	$tpl_source = preg_replace($vyraz, "<\\1\\2 \\3=\"$nahrada\\4\"\\5>", $tpl_source);
    }
    
    return $tpl_source;    
  }

?>
