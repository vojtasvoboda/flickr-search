<div class="post">

    {if $photocount < 0}
    <div class="post_top">
        <div class="post_title">
            <h2>Vítejte ve vyhledávání obrázků přes Flickr API.</h2>
        </div>
    </div>
    {/if}

    <div class="post_body">

        <div id="load">
            <img src="img/load.gif" alt="load" /><br /><br />
        </div>

        {if $error OR $error1}
        <p>Pozor chyba č.{$error1}: {$error}</p><br />
        {/if}

        <div class="clearer">&nbsp;</div>

        {* pokud nic nehledame *}
        {if $photocount < 0}

        <div class="uvod">

        <h3>Kde to jsem?</h3>
        <p>Tato aplikace slouží k vyhledávání obrázků přes API webové databáze obrázků Flickr. Vyhledané obrázky lze seřadit dle několika kritérií a nebo vyhledat určitou barvu.</p>

        <h3>Jak začít?</h3>
        <p>Začněte zadáním klíčového slova do políčka výše. Pokud bude něco nalezeno, zobrazí se vám matice fotek. Informace o fotografii se zobrazí po najetí myší nad fotku, nebo kliknutí a ní. Poté můžete výsledky seřadit dle nějakého parametru.</p>
        </div>

        {* pokud nebylo nic nalezeno *}
        {elseif $photocount == 0 OR $photocountout == 0}

        <div class="uvod">
        <br />
        <h3>Nepodařilo se najít žádný obrázek.</h3>
        <p>Zkuste prosím opakovat hledání s obecnější vyhledávanou frází... (např. sun)</p>
        <br />

        {else}
            <div id="fotogalerie">
            {$out}
            {* vypiseme fotky *}
            {* foreach from=$pictures item=picture *}
            {* <a href=" picture->getUrl() " rel="lightbox" title=" picture->getTitle() "> *}
            {* <img src=" picture->getThumb() " alt=" picture->getTitle() " /> *}
            {* </a>
            {* /foreach *}
            </div>
            <div class="clearer"></div>
            <div id="paginator">
            {assign var='actual' value=$p|default:1}
            <p>
            {if $actual=="1"}&lt; předchozí
            {else}<a href="/?q={$smarty.get.q}&amp;p={$actual-1}&amp;c={$smarty.get.c}">&lt; předchozí</a>
            {/if}
            ( - {$actual} - )
            {if $actual>=$pages} další &gt;
            {else}<a href="/?q={$smarty.get.q}&amp;p={$actual+1}&amp;c={$smarty.get.c}">další &gt;</a>
            {/if}
            </p>
            <p>celkem stran {$pages}</p>
            </div>
        {/if}

        <div class="clearer">&nbsp;</div>

    </div>

</div>