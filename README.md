# Informační systém pro restauraci
<dl>

<dt>Autoři</dt>

Alena Tesařová [xtesar36@stud.fit.vutbr.cz](mailto:xtesar36@stud.fit.vutbr.cz) - správa uživatelů a uživatelské rozhraní

Jan Šorm [xsormj00@stud.fit.vutbr.cz](mailto:xsormj00@stud.fit.vutbr.cz) - databázový subsystém

<dt>URL aplikace</dt>

[http://www.latanesa.cz](http://www.latanesa.cz) (expired)

</dl>

## Uživatelé systému pro testování

<table>

<tbody>

<tr>

<th>Login</th>

<th>Heslo</th>

<th>Role</th>

</tr>

<tr>

<td>admin</td>

<td>admin</td>

<td>Spolumajitel</td>

</tr>

<tr>

<td>matej</td>

<td>sefkuchar</td>

<td>Šéfkuchař</td>

</tr>

<tr>

<td>zdenka</td>

<td>kuchar</td>

<td>Kuchař</td>

</tr>

<tr>

<td>radek</td>

<td>servirka</td>

<td>Servírka</td>

</tr>

</tbody>

</table>

## Implementace

Projekt jsme implementovali v jazyku PHP, nepoužívali jsme žádny PHP framework, pouze CSS kniovny jako je bootstrap a google font Roboto. Jedná se o klasickou MVC architekturu, kde máme scripty rozdělené do 3 hlavních složek: kontrolery, pohledy a modely. Model vždy pracuje s databází a vrací kontrolerovi data, který je zpracuje a posílá je do pohledu. Pohled pak obsahuje šablony jednotlivých stránek aplikace.

### Naimplementované funkce

*   **Správa rezervací** - servírka, spolumajitel
    *   Kompletně vyřešena správa rezervací do restaurace na daný stůl či více stolů společně s přidáním objednávky
    *   Nabídka stolů podle vybraného času rezervace a orientační doby návštěvy restaurace
    *   Javascriptové řešení přidávání jídel a pití (plusem vedle jídla)
*   **Správa objednávek** - servírka, spolumajitel

*   Pro servírky, které vkládají objednávky k danému stolu
*   Nezaúčtované objednávky - jedná se o objednávky, u kterých zatím neexistuje účtenka, po vystavení účtenky se objednávka zařadí mezi vyúčtované a spolumajitel si je může prohlídnout v historii objednávek
*   Javascriptové řešení odstraňování, zvyšování a snižování množství jídel a pití (ajaxové)
*   Přidání jídla a pití k objednávce - nelze zde přidat jídlo a pití, které je již evidované u objednávky, jelikož je zde evidované množství

*   **Správa jídla, potravin a stolů** - šéfkuchař, kuchař, spolumajitel (podrobně práva na Obrázku 1)
    *   Přidávání surovin k jídlu přes modální box u daného jídla (po kliknutí na ikonu s hamburgerem), nelze přidat stejnou surovinu vícekrát, lze ajaxově přidávat a snižovat množství v gramech, anebo odstraňovat surovinu z daného jídla
    *   Editace jídla a pití v záložce Jídelní lístek přes ikonu s uložením na daném řádku (ajaxově)
    *   Editace surovin v záložce Suroviny
    *   Editace stolů v záložce Stoly
*   **Statistiky** - spolumajitel
    *   Umožňuje majiteli vyjet si vybrané statistiky za zvolené období
    *   Statistika Tržby dle servírek bere servírku podle té, která založila objednávku (ne která vytiskla účtenku)
*   **Správa zaměstnanců** - spolumajitel
    *   Přidávání nového uživatele
    *   Editace osobních údajů zaměstnanců (i hesel)

### Technické detaily

*   připojování k databázi pomocí ovladače PDO
*   heslo se ukladá šifrovaně
*   ochrana proti XSS útokem
*   žádné SQL injection
*   přes 4000 řádků kódu
*   naimplementované komplet funkce pro práci s formulářem
*   žádný PHP framework
*   responzivní web

![Strana po přihlášení](doc_img/hlavni_strana.jpg)

[![Správa rezervací](doc_img/rezervace.jpg)](doc_img/rezervace.jpg)

[![Správa objednávek](doc_img/objednavky.jpg)](doc_img/objednavky.jpg)

[![Správa jídel](doc_img/jidelni-listek.jpg)](doc_img/jidelni-listek.jpg)

[![Zaúčtované objednávky](doc_img/zauctovane.jpg)](doc_img/zauctovane.jpg)

<figcaption>Obrázek 5: Zaúčtované objednávky - vidí a může změnit pouze spolumajitel</figcaption>

[![Statistiky](doc_img/statistiky.jpg)](doc_img/statistiky.jpg)

<figcaption>Obrázek 6: Statistiky</figcaption>

</figure>

## Databáze

Oproti návrhu databáze z IDS jsme museli pozměnili:

*   přidali jsme id_obsajuje_potravina do obsahuje_potravina - důvodem byla snazší identifikace záznamu pro úpravu množství k potravině ve správě objednvek
*   odstranili jsme tabulku uživatelé - teď jsou naši uživatelé zaměstnanci
*   odstranili jsme sloupec suma z objednavka - suma se dá počítat dynamicky z jídel patřící dané objednávce
*   přidali jsme další sloupce k rezervaci a k zaměstnanci (např. login, heslo, kontakt_zakaznika, identifikator)
*   vytvořili jsme novou tabulku pozice - podle daných pozic určujeme práva vstupu do záložek
*   přidali jsme nový sloupec cislo to tabulky stul

[![Schéma databáze](doc_img/IIS.png)](doc_img/IIS.png)

<figcaption style="text-align: left">Obrázek 7: Finální schéma databáze</figcaption>

## Instalace

*   rozbalit archiv se zdrojovými soubory
*   na daném serveru musíte mít právo upravovat soubor .htaccess
*   otevřít index.php
*   není potřeba žádná dodatečná instalace (fonty, bootstrap se natahují z webu - soubor pohledy/headers.php)

## Známé problémy

Vzhledem k rozsahu projektu jsme se rozhodli neimplementovat dětské porce, ale nebylo by složité toto rozšíření přidat.
