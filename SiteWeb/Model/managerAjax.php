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
    }

?>