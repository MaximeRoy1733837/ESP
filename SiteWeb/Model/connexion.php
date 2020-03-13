<?php
class Connexion
{
    protected function getConnexion()
    {
        $connexion = new \PDO('mysql:host=localhost;dbname=bd_esp;charset=utf8', 'root', '',array( 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ,
        PDO::ATTR_EMULATE_PREPARES=>false));
        return $connexion;
    }
}

?>