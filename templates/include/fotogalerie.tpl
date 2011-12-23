{* vsechny fotogalerie *}
{foreach from=$foto key=klic item=polozka}

  <div class="fotogalerie">
  {* $polozka.popis *}

  {* jednotlive fotogalerie *}
  {foreach from=$polozka.fotky key=klic2 item=polozka2}
  <div class="foto">
  <a href="/upload/image/fotogalerie/big/{$polozka2.fotka}" title="{$polozka2.popis}" rel="lightbox">
  <img src="/upload/image/fotogalerie/{$polozka2.fotka}"
       alt="{bezpecnost text=$polozka2.alt}" 
       title="{bezpecnost text=$polozka2.alt}" />
  </a>
  <p>{$polozka2.popis}</p>
  </div>
  {/foreach}
  </div><!-- !.fotogalerie -->

  <div class="reseter"></div>

{/foreach}
