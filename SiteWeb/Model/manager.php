<?php
    require('connexion.php');

    class Manager extends Connexion
    {
        public function getAnimelist() { 
            $sql = 'SELECT * FROM anime_list order by score_anime DESC'; 
            $animes = self::getConnexion()->query($sql); 
            return $animes;        
         } 
    }

?>