<?php
    require('model/managerAjax.php');

    function addingAnime($name, $genre, $score)
    {
        $class = new ManagerAjax();
        $resultat = $class->addAnime($name, $genre, $score);
        
        echo json_encode(array("name" => $name, "genre" => $genre, "score" => $score));

    }

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