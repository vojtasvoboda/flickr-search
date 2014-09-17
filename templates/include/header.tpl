<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="cs" />

<title>{$project.title}</title>

<meta name="copyright" content="Vojtěch Svoboda; mailto:info@vojtasvoboda.cz" />
<meta name="copyright" content="Vojtěch Svoboda; mailto:info@vojtasvoboda.cz" />
<meta name="language" content="Czech" />
<meta name='robots' content='all,follow' />
<meta name="google-site-verification" content="bk3qspKYZHRn5G3BO4JlWT5k1Bv0mrU0qPuzhxrYHf0" />

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="favicon.ico" />

<link rel="stylesheet" href="/css/style.min.css" type="text/css" media="screen,projection,tv" />
<link rel="stylesheet" href="/css/colorbox.min.css" type="text/css" media="screen,projection,tv" />

<!--[if lte IE 7]>
<link rel="stylesheet" href="/css/ie_fixes.css" type="text/css" media="screen" />
<![endif]-->
{literal}
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-30324249-4', 'auto');
    ga('send', 'pageview');
</script>
{/literal}
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="/js/jquery.colorbox-set.js"></script>

</head>

<body>

<div id="paper_left">
<div id="paper_right">
<div id="layout_wrapper">
<div id="layout_container">
<div id="layout_content">

	<div id="site_title">
		<h1><a href="/">Vyhledávání přes Flickr API</a></h1>
		<h2>Metadata-based reranking</h2>
	</div>

	{if $homepage & !$smarty.get.q}<div id="header_image"></div>{/if}

	<div class="navigation">
		<form action="/" method="get" id="search">
			<label for="q">Vyhledávané slovo:</label>
			<input name="q" id="q" value="{$smarty.get.q}" />
			<input type="submit" class="submit" value="Hledat" onclick="$('#load').css('display','block');$('.uvod').hide();" />
		</form>
		<ul id="odkazy">
			<li><a href="/zadani/">zadání</a></li>
			<li><a href="/navrh/">návrh</a></li>
		</ul>
		<div class="clearer">&nbsp;</div>
	</div>

	<div class="clearer">&nbsp;</div>
	{if $pictures OR $out}
	<div class="navigation subnav">
		<form action="/" method="get">
			<input type="hidden" name="q" value="{$smarty.get.q}" />
			<label for="s">Řadit dle:</label>
			<select name="s" id="s" onchange="$('#load').css('display','block');this.form.submit();">
				<option value="relevance"{if $smarty.get.s=="relevance" OR $smarty.get.s==""}selected="selected"{/if}>relevance</option>
				<option value="date-posted-asc"{if $smarty.get.s=="date-posted-asc"}selected="selected"{/if}>data vložení vzestupně</option>
				<option value="date-posted-desc"{if $smarty.get.s=="date-posted-desc"}selected="selected"{/if}>data vložení sestupně</option>
				<option value="date-taken-asc"{if $smarty.get.s=="date-taken-asc"}selected="selected"{/if}>data vyfocení vzestupně</option>
				<option value="date-taken-desc"{if $smarty.get.s=="date-taken-desc"}selected="selected"{/if}>data vyfocení sestupně</option>
				<option value="interestingness-desc"{if $smarty.get.s=="interestingness-desc"}selected="selected"{/if}>zajímavosti vzestupně</option>
				<option value="interestingness-asc"{if $smarty.get.s=="interestingness-asc"}selected="selected"{/if}>zajímavosti sestupně</option>
			</select>
		</form>
		<div id="colorstitle">Filtrovat dle barvy:</div>
		<div id="colors">
			<a href="/{if $smarty.get.q}?q={$smarty.get.q}{if $smarty.get.s}&s={$smarty.get.s}{/if}&c=red{/if}" title="red" id="red" onclick="$('#load').css('display','block');"{if $smarty.get.c=="red"} class="active"{/if}>&nbsp;</a>
			<a href="/{if $smarty.get.q}?q={$smarty.get.q}{if $smarty.get.s}&s={$smarty.get.s}{/if}&c=green{/if}" title="green" id="green" onclick="$('#load').css('display','block');"{if $smarty.get.c=="green"} class="active"{/if}>&nbsp;</a>
			<a href="/{if $smarty.get.q}?q={$smarty.get.q}{if $smarty.get.s}&s={$smarty.get.s}{/if}&c=blue{/if}" title="blue" id="blue" onclick="$('#load').css('display','block');"{if $smarty.get.c=="blue"} class="active"{/if}>&nbsp;</a>
			<a href="/{if $smarty.get.q}?q={$smarty.get.q}{if $smarty.get.s}&s={$smarty.get.s}{/if}&c=bw{/if}" title="blue" id="blue" onclick="$('#load').css('display','block');"{if $smarty.get.c=="bw"} class="active"{/if}>
				<img src="img/bw.gif" alt="bw" />
			</a>
		</div>
		<!-- 
		<div id="authortitle">Řadit dle autora:&nbsp;</div>
		<form action="/" method="get">
			<input type="hidden" name="q" value="{$smarty.get.q}" />
			<input name="a" type="text" value="{$smarty.get.a}" size="12" />
			<input type="submit" value="OK" />
		</form>
		-->
		<div class="clearer">&nbsp;</div>
				
	</div>
	{/if}

	<div id="main">