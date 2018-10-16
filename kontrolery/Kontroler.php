<?php
abstract class Kontroler
{

        public $data = array();
        public $pohled = "";
        public $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

        // trida na zpracovani argumentu, kazdy kontroler musi mit
        abstract function zpracuj($parametry);

        // vypise pohled uzivateli
        public function vypisPohled()
        {
        	//echo ("pohled: " . $this->pohled );
        	if ( $this->pohled ){
        		extract($this->osetri($this->data)); // napr. barva => cerva vytvori promennou $barva
                        // vybalime promene jeste jednou, tentokrat neosetrene s podtrzitkem
                        extract($this->data, EXTR_PREFIX_ALL, "");
        		require("pohledy/" .$this->pohled . ".phtml");
        	}
        }
        public function presmeruj($url)
		{
	        header("Location: /$url");
	        header("Connection: close");
	        exit;
		}

        public function pridejZpravu($zprava, $typ)
        {
                if (isset($_SESSION['zpravy']))
                        $_SESSION['zpravy'][] = $zprava;
                else
                        $_SESSION['zpravy'] = array($zprava);

                $_SESSION[ 'typ_zpravy' ] = $typ;
        }

        public static function vratZpravy()
        {
                if (isset($_SESSION['zpravy']))
                {
                        $zpravy = $_SESSION['zpravy'];
                        unset($_SESSION['zpravy']);
                        return $zpravy;
                }
                else
                        return array();

        }
        public static function vratTypZpravy(){
                if (isset($_SESSION[ 'typ_zpravy' ])){
                        if ( $_SESSION[ 'typ_zpravy' ] == ZPRAVA_OK ){
                                return 'zprava_ok';
                        }
                }
                return 'zprava_ko';
        }

        private function osetri($x = null)
        {
                if (!isset($x))
                        return null;
                elseif (is_string($x))
                        return htmlspecialchars($x, ENT_QUOTES);
                elseif (is_array($x))
                {
                        foreach($x as $k => $v)
                        {
                                $x[$k] = $this->osetri($v);
                        }
                        return $x;
                }
                else
                        return $x;
        }

        public function overUzivatele($admin = false)
        {
                $spravceUzivatelu = new SpravceUzivatelu();
                $uzivatel = $spravceUzivatelu->vratUzivatele();
                if (!$uzivatel || ($admin && !$uzivatel['admin']))
                {
                        $this->pridejZpravu('Nedostatečná oprávnění.', ZPRAVA_ERROR);
                        $this->presmeruj('prihlaseni');
                }
        }

}

?>