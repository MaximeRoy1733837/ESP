<?php
	session_start();
    require('Controller/controller.php');

    if (isset($_GET['action'])) {
		if(isset($_SESSION['connecter']))
		{
			switch ($_GET['action']){
			case 'Home':
				Homepage();
				break;
			case 'Historique':
				Historique();
				break;
			case 'Connexion':
				Connexion();
				break;
			case 'Deconnexion':
				Deconnexion();
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
	else {
		Connexion(); 
	}
?>