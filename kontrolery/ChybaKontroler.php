<?php

class ChybaKontroler extends Kontroler
{
	public function zpracuj($parametry){
		// Hlavička požadavku
        header("HTTP/1.0 404 Not Found");
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Chyba 404';
         $this->hlavicka['popis'] = 'Chyba 404';
        // Nastavení šablony
        $this->pohled = 'chyba';

	}

}

?>