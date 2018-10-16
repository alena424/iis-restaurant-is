<?php

class SmerovacKontroler extends Kontroler
{
	protected $kontroler;


	public function zpracuj($parametry){
		$naparsovanaURL = $this->parsujURL($parametry[0]);
		define("ZPRAVA_CHYBA", -1);
                define("ZPRAVA_OK", 1);

		// nemame zadne parametry, presmerujeme na uvodni stranku
		if (empty($naparsovanaURL[0]))
                $this->presmeruj('restaurace/uvod');

		//print_r($naparsovanaURL);
		//array_shift = 1. parametr
		$tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';


		if (file_exists('kontrolery/' . $tridaKontroleru . '.php'))
        	$this->kontroler = new $tridaKontroleru;
		else
			$this->presmeruj('chyba');

		$this->kontroler->zpracuj($naparsovanaURL);

		$this->data['titulek'] = $this->kontroler->hlavicka['titulek'];
		$this->data['popis'] = $this->kontroler->hlavicka['popis'];
		$this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'];
		$this->data['zpravy'] = $this->vratZpravy();
		$this->data['typ'] = $this->vratTypZpravy();
		
		$this->pohled = 'rozlozeni';

	}

	// vraci pole parametru v url
	private function parsujURL($url){
		$naparsovanaURL = parse_url($url);
		$naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
		$naparsovanaURL["path"] = trim($naparsovanaURL["path"]);

		$rozdelenaCesta = explode("/", $naparsovanaURL["path"]);
		return $rozdelenaCesta;
	}

	// prevede vypis-uzivatele na VypisUzivatelu -- nazev kontroleru
	private function pomlckyDoVelbloudiNotace($text)
	{
		$veta = str_replace('-', ' ', $text);
		$veta = ucwords($veta);
		$veta = str_replace(' ', '', $veta);
		return $veta;
	}
}

?>