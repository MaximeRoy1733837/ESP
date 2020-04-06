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

    function verificationConnexion($username, $mdp)
    {
        $class = new Manager();

        $resultat = $class->getUser();

        while ($enregistrement=$resultat->fetch()){ 
            if ($username == $enregistrement['nom_utilisateur'] && $mdp == $enregistrement['motPasse']) {
               $_SESSION['connecter'] = $enregistrement['no_utilisateur'];
               break;		  
            }
            else{ 
               $_SESSION['connecter'] = 0;
            }
         }	
      if($_SESSION['connecter'] != 0)
      { 
        Homepage();
      }
      else {
        Connexion();
        echo "Mauvais login";
      }
    }
?>