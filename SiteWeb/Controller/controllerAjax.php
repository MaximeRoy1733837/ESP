<?php
    require('Model/managerAjax.php');

    function VerificationLogin($username, $mdp)
    {
        $class = new ManagerAjax();

        $resultat = $class->validationLogin($username, $mdp);
        $resultatFetch = $resultat->fetch();
        
        if($resultatFetch == "")
        {
            echo json_encode(array("etatLogin" => "bad"));
        }
        else
        {
            echo json_encode(array("etatLogin" => "good"));
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