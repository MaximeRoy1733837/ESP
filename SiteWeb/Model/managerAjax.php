<?php
    require('connexion.php');

    class ManagerAjax extends Connexion
    {
        public function addAnime($name, $genre, $score) { 
            $sql = 'call AjoutAnime(:name, :genre, :score)';
            $resultat = self::getConnexion()->prepare($sql);
            $resultat->bindParam('name', $name, PDO::PARAM_STR);
            $resultat->bindParam('genre', $genre, PDO::PARAM_STR);
            $resultat->bindParam('score', $score, PDO::PARAM_STR);
            $resultat->execute();
            return $resultat;       
         }

         public function verificationConnexion($username, $mdp)
         {
            $sql = 'call VerificationLogin(:username, :mdp)';
            $resultat = self::getConnexion()->prepare($sql);
            $resultat->bindParam('username', $username, PDO::PARAM_STR);
            $resultat->bindParam('mdp', $mdp, PDO::PARAM_STR);
            $resultat->execute();
            return $resultat;  
         }
    }

?>