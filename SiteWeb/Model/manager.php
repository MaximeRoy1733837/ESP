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
            $sql = 'SELECT id, nom_commande, date_historique, quantite_produite, temperature, humidite, quantite_bon, quantite_mauvais FROM tbl_historique ORDER BY  id DESC';
            $resultat = self::getConnexion()->query($sql);
            return $resultat;        
        }

        public function getUser() { 
            $sql = 'SELECT no_utilisateur, nom, prenom, nom_utilisateur, motPasse FROM tbl_utilisateur';
            $resultat = self::getConnexion()->query($sql);
            return $resultat;        
        }

    }

?>