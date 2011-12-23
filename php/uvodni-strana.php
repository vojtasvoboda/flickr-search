<?php
  if (!defined('IN_CODE')){
    require_once "lib/functions.inc.php";
    presmeruj404();
  }

  $out = "";
  $error = false;
  $error1 = false;
  $p = 1;
  $per_page = 24;
  $pages = false;
  $picturesout = false;
  $photo_count = -1;
  
  // pokud je neco hledano
  if ( !empty($_GET["q"])) {
  	
  	/* nastaveni API */
  	$key = "YOUR_KEY";
  	$secret = "YOUR_SECRET";
  	$perm = "read";
  	
    /* keyword */
  	$keyword = stripslashes(htmlspecialchars($_GET["q"]));
  	
  	/* radici funkce */
  	include "lib/Pictures.php";
  	
    /* sort; possible value: */
  	/* date-posted-asc, date-posted-desc, date-taken-asc, date-taken-desc, interestingness-desc, interestingness-asc, relevance */
  	$sort = "relevance";
  	$sorts = array("date-posted-asc", "date-posted-desc", 
  				   "date-taken-asc", "date-taken-desc", 
  				   "interestingness-desc", "interestingness-asc", 
  				   "relevance");
  	if ( !empty($_GET["s"])) {
  		if ( in_array($_GET["s"],$sorts) ) {
  			$sort = $_GET["s"];
  		}
  	}

  	/* filtrovaci funkce */
  	include "lib/ColorExtraction.php";  	
  	
  	/* color */
  	$color = false;
  	$colors = array("red","blue","green","bw","test");
  	if ( !empty($_GET["c"])) {
  		if ( in_array($_GET["c"],$colors) ) {
  			$color = $_GET["c"];
  			// musime zvysit pocet, protoze se to protridi, tak aby vubec neco zustalo
  			$per_page = 50;
  		}
  	}

    /* trideni podle autora */
  	/*
  	$author = "";
  	if ( !empty($_GET["a"])) {
  		$author = $_GET["a"];
  	}
  	*/
  	
    /* next page */
  	if ( !empty($_GET["p"])) {
  		if ( is_numeric($_GET["p"]) ) {
  			$p = $_GET["p"];
  		}
  	}  	
  	
	/* zavolame knihovnu flickr */
  	$f = new phpFlickr($key,$secret);
	
  	// cache na filesystem
  	// $f->enableCache("fs", "cache");
  	
  	// cache do databaze	
	$f->enableCache("db", "mysql://USERNAME:PASSWORD@localhost/DB_NAME", 3600);

	// $recent = $f->photos_getRecent(false, "24", "1");
	$recent = $f->photos_search(array("tags"=>$keyword, "sort"=>$sort, "per_page"=>$per_page, "page"=>$p));
	$photo_count = $recent['total'];
	$photo_count_out = 0;
	$error = $f->getErrorMsg();
	$error1 = $f->getErrorCode();	
	$pics = array();
	
	// projedeme vsechny fotky
	foreach ((array)$recent['photo'] as $photo) {
	    // id fotky
		$id = $photo['id'];
		// udelame odkaz na nahled
		$url = $f->buildPhotoURL($photo,"50");
		// udelame odkaz na velkou fotku
	  	$thumb = $f->buildPhotoURL($photo,"Square");
		// pokud nefiltrujeme podle barvy
		$extract = false;
	    if( $color ) {
		    // projet filtrem na barvu a priradit hash barvy
			$extract = analyzeImageColors(imagecreatefromjpeg($thumb), 1, 1);
	    }
	    // ziskame detaily o fotce
    	$title = $photo['title'];
    	$owner = $photo['owner'];
		
    	// vytvorime z toho objekt obrazku
		if ($color) {
			if ( isPictureColored($extract, $color) ) {
		    	// $pics[] = new Picture($id, $owner, $title, $url, $thumb, $extract);
		    	// klasicky vypis
	    		$out .= "<a href=\"".$url."\" rel=\"lightbox\" title=\"".$title."\"><img src=\"".$thumb."\" alt=\"".$title."\" /></a>";
	    		$photo_count_out++;
			}
		} else {
			// $pics[] = new Picture($id, $owner, $title, $url, $thumb, $extract);
		    // klasicky vypis
		    $out .= "<a href=\"".$url."\" rel=\"lightbox\" title=\"".$title."\"><img src=\"".$thumb."\" alt=\"".$title."\" /></a>";
		    $photo_count_out++;
		}
	}
	
	// pridame obrazky do kolekce
	/*
	$pictures = new Pictures();
	$pictures->addPictures($pics);
	*/
	
	// seradime obrazky
	/*
	switch($sort){
	    case 'titleup':
	        $pictures->sortByTitle();
	        break;
	    case 'titledown':
	        $pictures->sortByTitle(true);
	        break;
	    case 'ownerup':
	        $pictures->sortByOwner();
	        break;
	    case 'ownerdown':
	        $pictures->sortByOwner(true);
	        break;
	    case 'idup':
	        $pictures->sortById();
	        break;
	    case 'iddown':
	        $pictures->sortById(true);
	        break;
	    case 'relevance':
	    default:
	}
	*/
	
	// seradime dle autora
	/*
	if ( $author != "" ) {
		$pictures->sortBySimilarAuthor($author);
	}
	*/
	
	// ziskame fotky
	// $picturesout = $pictures->getPictures();
	
	/*
	echo "<pre>";
	print_r($picturesout);
	echo "</pre>";
	*/
	
    /* create pages */
	$pages = $photo_count / $per_page;
	$pages = intval($pages);
	if ($p > $pages) $p = $pages;
	if ($p < 1) $p = 1;
  }
  
  $smarty->assign("out",$out);
  $smarty->assign("pages",$pages);
  $smarty->assign("p",$p);
  $smarty->assign("photocount",$photo_count);
  $smarty->assign("photocountout",$photo_count_out);
  $smarty->assign("pictures",$picturesout);
  $smarty->assign("error",$error);
  $smarty->assign("error1",$error1);
  
display_all('uvodni-strana');

?>
