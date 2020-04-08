<?php
    require('Controller/controllerAjax.php');

    if (isset($_GET['event'])) {
		switch ($_GET['event'] ) {
			case 'GetNewInfo':
				session_start();
				if(isset($_SESSION['connecter']))
				{
					getLastInsertedInfo();
				}
				else
				{
					Connexion(); 
				}
				break;
			case 'ValidateLogin':
				if(isset($_POST['nom_utilisateur']) && isset($_POST['mdp']))
				{
					VerificationLogin(htmlentities($_POST['nom_utilisateur']), htmlentities($_POST['mdp']));
				}
				break;
			default :
				throw new Exception('Aucune page spécifique demandée');	
		}
	}	
	else {
		Connexion(); 
	}
?>