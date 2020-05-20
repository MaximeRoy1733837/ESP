<?php
    require('connexion.php');

    class Manager extends Connexion
    {
        public function getHistory() { 
            $sql = 'call getHistorique';
            $resultat = self::getConnexion()->prepare($sql);
            $resultat->execute();
            return $resultat;       
        }
    }

?>