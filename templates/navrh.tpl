		<div class="post">

			<div class="post_top">
				<div class="post_title">
					<h2>Návrh řešení</h2>
				</div>
			</div>

			<div class="post_body">

				<h3>Před implementací:</h3>
				
				<ul>
					<li>Vytvořit si Flickr účet a vygenerovat si KEY, se kterým budeme přistupovat přes API</li>
					<li>Zajistit, aby požadavky na API byly pouze v UTF-8 kódování</li>
					<li>Podle toho, jestli budeme ukládat dočasné soubory na disk, nebo do databáze, je potřeba zajistit povolený fopen() na hostingu, nebo zřízenou databázi</li>
				</ul>
				
				<h3>Implementace:</h3>
				
				<p>Vzhledem k tomu, že klientskou část implementujeme v jazyku PHP, budeme využívat třídu <a href="http://phpflickr.com/" rel="nofollow">phpFlickr</a>.</p>
				
				<code>
					Project Homepage: <a href="http://phpflickr.com/" rel="nofollow">phpFlickr</a><br />
					Google Code Project Page: <a href="http://code.google.com/p/phpflickr/" rel="nofollow">http://code.google.com/p/phpflickr/</a><br />
					Direct Download: <a href="/files/phpflickr-3.0.zip">phpflickr-3.0.zip</a> [19,6 kB] 
				</code>
				
				<p>Tato třída poskytuje abstraktní vrstvu nad API, takže voláme přímo metody API. phpFlickr se nám postará o sestavení korektního XML dotazu a zpracování odpovědi. Takto lze volat všechny metody API, my však využijeme pouze některé z nich:</p>
				<code>
					<strong>enableCache</strong> - touto funkcí si nastavíme lokální cache, abychom při řazení nemuseli fotky opakovaně načítat<br />
					<strong>photos_search()</strong> - volá flickr.photos.search - tato funkce nám vrátí kolekci fotek dle zadaného klíčového slova<br />
					<strong>buildPhotoURL()</strong> - tato funkce nám zjistí korektní URL adresu obrázku<br />
					<strong>getErrorMsg()</strong> - zajistí nám chybovou hlášku v případě nějaké chyby<br />
					<strong>photos_getInfo()</strong> - funkce vrátí informace o obrázku dle zadaného id
				</code>
				
				<h3>Postup zpracování načtených obrázků</h3>
				<p>Pomocí funkcí <strong>photos_search()</strong> a <strong>photos_getInfo()</strong> získáme kolekci obrázků a informace k nim. 
				Počet načtených obrázků jsme omezili na 24 s tím, že další obrázky jsou dostupně pomocí stránkování, které nám poskytuje přímo API Flickru. 
				Dále musíme obrázky seřadit, což provedeme pomocí PHP funkce <strong>usort</strong>, která má dva parametry. Jedním je pole obrázků, 
				které chceme seřadit, druhý parametr je porovnávací funkce, která nám vrátí, jestli je jeden prvek menší, nebo větší než druhý. 
				Tuto porovnávací funkci musíme implementovat samostatně, ale vzhledem k tomu, že vždy porovnáváme řetězce, nebo čísla 
				vystačíme si se základními funkcemi PHP.</p>
				
				<h3>Filtrování pomocí barvy</h3>
				<p>Pro filtrování pomocí barvy nejdříve potřebujeme získat barevné spektrum z obrázku. Na to použijeme funkci z tohoto zdroje:</p>
				<code>
					<a href="http://www.brandnoo.com/2007/06/26/image-color-analysis-php-code/" rel="nofollow">http://www.brandnoo.com/2007/06/26/image-color-analysis-php-code/</a>
				</code>
				<p>Tato funkce nám umožňuje rozdělit obrázek do pomyslné matice, např. 3x3 a pro každý prvek matice vypočte průměrnou barvu, jako trojici čísel R (Red), G (Green), B (Blue).</p>
				<p>Nyní je potřeba vymyslet algoritmus, který projde všechny obrázky a určí, který vyhovuje vyhledávané barvě nebo nikoli. <br />Pokud nastavíme 
				výše uvedenou funkci tak, aby vrátila pouze jeden bod (tj. nastavení matice 1x1) dostaneme pouze jednu trojici RGB a již můžeme pomocí jednoduché funkce, 
				určit jestli obrázek vyhovuje nebo ne, například pro červenou:</p>
				<code>if ( ($red > $green) & ($red > $blue) ) &#123;<br />&nbsp;&nbsp;&nbsp;return true;<br />&#125;
				</code>
				<p>Po trošce experimentování jsme algoritmus ještě mírně upravili, aby hledaná barvy opravdu převažovala:</p>
				<code>if ( ($red > (1.3*$green)) & ($red > (1.3*$blue)) ) &#123;<br />&nbsp;&nbsp;&nbsp;return true;<br />&#125;
				</code>
				<p>Takto algoritmus již vrací celkem přijatelné výsledky a nejlépe funguje u obrázků, kde hledaná barva převažuje po celé ploše, 
				např. vyhledávání fráze <a href="/?q=one+color">one color</a></p>
			</div>
		</div>