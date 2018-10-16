<?php
// Správce uživatelů redakčního systému
class SpravceUzivatelu
{

        // Vrátí otisk hesla
        public function vratOtisk($heslo)
        {
                return password_hash($heslo, PASSWORD_DEFAULT);
        }

        // Registruje nového uživatele do systému
        public function registruj($jmeno, $heslo, $hesloZnovu, $rok)
        {
                if ($rok != date('Y'))
                        throw new ChybaUzivatele('Chybně vyplněný antispam.');
                if ($heslo != $hesloZnovu)
                        throw new ChybaUzivatele('Hesla nesouhlasí.');
                $uzivatel = array(
                        'jmeno' => $jmeno,
                        'heslo' => $this->vratOtisk($heslo),
                );
                try
                {
                        Db::vloz('uzivatele', $uzivatel);
                }
                catch (PDOException $chyba)
                {
                        throw new ChybaUzivatele('Uživatel s tímto jménem je již zaregistrovaný.');
                }
        }

        // Přihlásí uživatele do systému
        public function prihlas($jmeno, $heslo)
        {
                $uzivatel = Db::dotazJeden('
                        SELECT uzivatele_id, jmeno, admin, heslo
                        FROM uzivatele
                        WHERE jmeno = ?
                ', array($jmeno));
                if (!$uzivatel || !password_verify($heslo, $uzivatel['heslo']))
                        throw new ChybaUzivatele('Neplatné jméno nebo heslo.');
                $_SESSION['uzivatel'] = $uzivatel;
        }

        // Odhlásí uživatele
        public function odhlas()
        {
                unset($_SESSION['uzivatel']);
        }

        // Zjistí, zda je přihlášený uživatel administrátor
        public function vratUzivatele()
        {
                if (isset($_SESSION['uzivatel']))
                        return $_SESSION['uzivatel'];
                return null;
        }

}
?>