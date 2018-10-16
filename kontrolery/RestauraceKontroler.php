<?php

class RestauraceKontroler extends Kontroler
{
        public function zpracuj($parametry)
        {
                // Vytvoření instance modelu, který nám umožní pracovat s články

                // Není zadáno URL článku, vypíšeme všechny
                 $this->data['titulek'] = "titulek";
                $this->data['clanky'] = "pujee";
                $this->pohled = 'hlavni_strana';
                
        }
}

?>