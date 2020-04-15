<?php
    require('connexion.php');

    class ManagerAjax extends Connexion
    {
        public function getLastInsertedInfo()
        {
            $sql = 'call getLastInsertedInfo';
            $resultat = self::getConnexion()->prepare($sql);
            $resultat->execute();
            return $resultat;
        }

        public function validationLogin($username, $mdp)
        {
           $sql = 'call VerificationLogin(:username, :mdp)';
           $resultat = self::getConnexion()->prepare($sql);
           $resultat->bindParam('username', $username, PDO::PARAM_STR);
           $resultat->bindParam('mdp', $mdp, PDO::PARAM_STR);
           $resultat->execute();
           return $resultat;  
        }

        public function getOrderBasicInfo()
        {
            $sql = 'select nom_commande, quantite_produite from tbl_info where id = (select max(id) from tbl_info)';
            $resultat = self::getConnexion()->query($sql);
            return $resultat;
        }

        public function getOrderQuantities()
        {
            $sql = 'select quantite_bon, quantite_mauvais, quantite_produite from tbl_info where id = (select max(id) from tbl_info)';
            $resultat = self::getConnexion()->query($sql);
            return $resultat;
        }

        public function getOrderMesure()
        {
            $sql = 'select temperature, humidite from tbl_info where id = (select max(id) from tbl_info)';
            $resultat = self::getConnexion()->query($sql);
            return $resultat;
        }
    }

?>