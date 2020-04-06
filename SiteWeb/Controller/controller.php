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

        $user = new Manager;
        $resultat = $user->getUser();

        require('View/viewConnexion.php');
    }

    function Historique()
    {
        $currentPage = "Historique";

        $historique = new Manager;
        $resultat = $historique->getHistory();

        require('view/ViewHistorique.php');
    }

    function Information()
    {
        $info = new Manager;
        $resultat = $info->getInfo();

        require('view/ViewHome.php');
    }
?>