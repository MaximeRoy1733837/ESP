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
            $sql = 'call getBasicInfo';
            $resultat = self::getConnexion()->prepare($sql);
            $resultat->execute();
            return $resultat;
        }

        public function getOrderQuantities()
        {
            $sql = 'call getQuantities';
            $resultat = self::getConnexion()->prepare($sql);
            $resultat->execute();
            return $resultat;
        }

        public function getOrderMesure()
        {
            $sql = 'call getMesure';
            $resultat = self::getConnexion()->prepare($sql);
            $resultat->execute();
            return $resultat;
        }
    }

?>