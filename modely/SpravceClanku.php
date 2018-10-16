<?php
class SpravceClanku
{

        // Vrátí článek z databáze podle jeho URL
        public function vratClanek($url)
        {
                return Db::dotazJeden('
                        SELECT `clanky_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`
                        FROM `clanky`
                        WHERE `url` = ?
                ', array($url));
        }

        // Vrátí seznam článků v databázi
        public function vratClanky()
        {
                return Db::dotazVsechny('
                        SELECT `clanky_id`, `titulek`, `url`, `popisek`
                        FROM `clanky`
                        ORDER BY `clanky_id` DESC
                ');
        }
        public function ulozClanek($id, $clanek)
        {
                if (!$id)
                        Db::vloz('clanky', $clanek);
                else
                        Db::zmen('clanky', $clanek, 'WHERE clanky_id = ?', array($id));
        }

        public function odstranClanek($url)
        {
                Db::dotaz('
                        DELETE FROM clanky
                        WHERE url = ?
                ', array($url));
        }
}
?>