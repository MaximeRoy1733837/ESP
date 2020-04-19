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
            session_start();
            $_SESSION['connecter'] = 1;

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
                                 "humidite" => $resultatFetch["humidite"], "quantite_bon" => $resultatFetch["quantite_bon"], "quantite_bad" => $resultatFetch["quantite_mauvais"],
                                "bloque" => $resultatFetch["bloque"]));
    }

    function Connexion()
    {
        $currentPage = "Connexion";
        require('View/viewConnexion.php');
    }

    function GetBasicInfo()
    {
        $class = new ManagerAjax();
        $resultat = $class->getOrderBasicInfo();
        $resultatFetch = $resultat->fetch();

        echo json_encode(array("nom_commande" => $resultatFetch["nom_commande"], "quantite_a_produire" => $resultatFetch["quantite_a_produire"]));
    }

    function GetQuantities()
    {
        $class = new ManagerAjax();
        $resultat = $class->getOrderQuantities();
        $data = array();

        while($resultatFetch = $resultat->fetch())
        {
           array_push($data, $resultatFetch["valeur_capteur"], $resultatFetch["quantite_a_produire"], $resultatFetch["date"] );
        }

        $resultat->closeCursor();
        echo json_encode($data);
    }

    function GetMesure()
    {
        $class = new ManagerAjax();
        $resultat = $class->getOrderMesure();
        $data = array();

        while($resultatFetch = $resultat->fetch())
        {
           array_push($data, $resultatFetch["valeur_capteur"], $resultatFetch["date"]);
        }

        $resultat->closeCursor();
        echo json_encode($data);
    }
?>