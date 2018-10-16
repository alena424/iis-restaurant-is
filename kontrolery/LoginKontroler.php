<?php

class LoginKontroler extends Kontroler
{

        public function zpracuj($parametry)
        {
               
                $this->data['titulek'] = "titulek";
                $this->data['clanky'] = "pujee";
                $this->pohled = 'prihlaseni';
                
        }

}

?>