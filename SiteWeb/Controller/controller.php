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

    function Deconnexion()
    {
        $currentPage = "Connexion";
        session_destroy();
        require('View/viewConnexion.php');
    }

    function Historique()
    {
        $currentPage = "Historique";

        $historique = new Manager;
        $resultat = $historique->getHistory();

        require('view/ViewHistorique.php');
    }
?>