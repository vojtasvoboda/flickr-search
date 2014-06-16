# Vyhledávání obrázků přes Flickr API

## Cíle projektu

Vytvořte aplikaci pro vyhledávání obrázků a jejich reranking. Jako zdroj obrázků použijte API Flickr. Extrakci vlastností lze svěřit externí knihovně, případně programu, který předem vyextrahuje vlastnosti a uloží je, nicméně vlastní modelování podobnosti je třeba naprogramovat. Programovat můžete v libovolném jazyce, nicméně platforma pro vizualizaci výsledků vyhledávání musí být webový prohlížeč.

## Seznam požadavků

- Keyword search
- Get set of results containing or similar to given keyword
- Rerank according to GPS, size, author, ...
- Visualisation (ala Flickr advanced search)

## Externí odkazy

Flickr: [http://www.flickr.com/](http://www.flickr.com/)
Flickr API: [http://www.flickr.com/services/api/](http://www.flickr.com/services/api/)

Příslušný článek: [http://blog.vojtasvoboda.cz/vyhledavani-obrazku-pres-flickr-api-v-php](http://blog.vojtasvoboda.cz/vyhledavani-obrazku-pres-flickr-api-v-php)
Běžící aplikace: [http://flickr.7ka.cz/](http://flickr.7ka.cz/)

## Instalace

1) Nahrajeme aplikaci na webový server s podporou PHP 5
2) Pro cache potřebujeme databázi (přístupy nastavíme v uvodni-strana.php, řádku 80)
3) Pro běh na produkci odkomentujeme řádek 16 v .htaccess
