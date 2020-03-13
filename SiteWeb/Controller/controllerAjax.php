<?php
    require('Model/managerAjax.php');

    function verificationConnexion($username, $mdp)
    {
        $class = new ManagerAjax();

        $resultat = $class->verificationConnexion($username, $mdp);
        $resultatFetch = $resultat->fetch();
        
        if($resultatFetch == "")
        {
            echo json_encode(array("etat" => "bad"));
        }
        else
        {
            echo json_encode(array("etat" => "good"));
        }
    }
?>