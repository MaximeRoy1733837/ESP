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

    function GetLastInsertedInfo()
    {
        $class = new ManagerAjax();
        $resultat = $class->getLastInsertedInfo();
        $resultatFetch = $resultat->fetch();

        echo json_encode(array("epoch" => $resultatFetch["epoch"], "nom_commande" => $resultatFetch["nom_commande"], 
                                "date" => $resultatFetch["date"], "quantite_produire" => $resultatFetch["quantite_produite"], "temperature" => $resultatFetch["temperature"],
                                 "humidite" => $resultatFetch["humidite"], "quantite_bon" => $resultatFetch["quantite_bon"], "quantite_bad" => $resultatFetch["quantite_mauvais"]));
    }
?>