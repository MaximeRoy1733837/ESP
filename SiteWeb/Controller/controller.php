<?php
    require('Model/manager.php');

    function Homepage()
    {
        $currentPage = "Home";
        require('View/viewHome.php');
    }

    function Connexion()
    {
        $currentPage = "Connexion";
        require('View/viewConnexion.php');
    }
?>