<?php
    require('Controller/controllerAjax.php');

    if (isset($_GET['event'])) {

		if($_GET['event'] == 'ValidateLogin')
		{
			if(isset($_POST['nom_utilisateur']) && isset($_POST['mdp']))
			{
				VerificationLogin(htmlentities($_POST['nom_utilisateur']), htmlentities($_POST['mdp']));
			}
		}
		else {
			session_start();
			if(isset($_SESSION['connecter']))
			{
				switch ($_GET['event']) {
					case 'GetBasicInfo':
						GetBasicInfo();
						break;
					case 'GetQuantities':
						GetQuantities();
						break;
					case 'GetMesure':
						GetMesure();
						break;
					case 'GetVariationMesure':
						GetVariationMesure();
						break;
					case 'GetLatestEvent':
						GetLatestEvent();
						break;
					case 'SetNotifierToTrue':
						SetNotifierToTrue();
						break;
					default :
						throw new Exception('Aucune page spécifique demandée');	
				}
			}
			else
			{
				Connexion(); 
			}
		}
	}	
	else {
		Connexion(); 
	}
?>