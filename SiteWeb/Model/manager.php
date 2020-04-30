<?php
    require('connexion.php');

    class Manager extends Connexion
    {
        public function getInfo() { 
            $sql = 'SELECT id, epoch, nom_commande, date, quantite_produite, temperature, humidite, quantite_bon, quantite_mauvais FROM tbl_info';
            $resultat = self::getConnexion()->query($sql);
            return $resultat;        
        }

        public function getHistory() { 
            $sql = 'call getHistorique';
            $resultat = self::getConnexion()->prepare($sql);
            $resultat->execute();
            return $resultat;       
        }
    }

?>