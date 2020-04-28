<?php
    require('Model/managerAjax.php');
    
    date_default_timezone_set("America/Toronto");

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
        $DateTime = new DateTime();

        while($resultatFetch = $resultat->fetch())
        {
            $DateTime->setTimestamp(floatval($resultatFetch["epoch"]));           
            array_push($data, $resultatFetch["valeur_capteur"], $DateTime->format('H:i:s'));
        }

        $resultat->closeCursor();
        echo json_encode($data);
    }

    function GetLatestEvent()
    {
        $class = new ManagerAjax();
        $resultat = $class->getLatestEvent();

        $resultatFetch = $resultat->fetch();

        echo json_encode(array("nom_evenement" => $resultatFetch["nom_evenement"],  "notifier" => (bool)$resultatFetch["notifier"]));
    }

    function SetNotifierToTrue()
    {
        $class = new ManagerAjax();
        $resultat = $class->setNotifierToTrue();

        $resultatFetch = $resultat->fetch();

        echo $resultatFetch;
    }

    function GetVariationMesure(){
        $class = new ManagerAjax();
        $resultat = $class->getVariationMesure();

        $arrayTemperature = array();
        $arrayHumidite = array();
        $arrayDate = array();
        $DateTime = new DateTime();
        $cpt = 0;
        

        while($resultatFetch = $resultat->fetch())
        {
            switch($resultatFetch["nom_capteur"])
            {
                case 'temperature':
                    array_push($arrayTemperature, $resultatFetch["valeur_capteur"]);
                    break;
                case 'humidite':
                    $DateTime->setTimestamp(floatval($resultatFetch["epoch"]));
                    array_push($arrayDate, $DateTime->format('H:i:s'));
                    array_push($arrayHumidite, $resultatFetch["valeur_capteur"]);        
                    break;
                default:
                    break;
            }  
        }

        $resultat->closeCursor();
        echo json_encode(array("temperature" => $arrayTemperature, "humidite" => $arrayHumidite, "date" => $arrayDate));
    }
?>