<?php
	session_start();
    require('Controller/controller.php');

    if (isset($_GET['action'])) {
		switch ($_GET['action'] ) {
			case 'Home':
				Homepage();
				break;
			case 'Historique':
				Historique();
				break;
			case 'Connexion':
				$_SESSION['connecter'] = 0;
				Connexion();
				break;
			case 'Verifier':
				verificationConnexion(htmlentities($_POST['txt_username']),htmlentities($_POST['txt_mdp']));
				break;
			default :
				throw new Exception('Aucune page spécifique demandée');	
		}
	}	
	else {
		//Connexion(); 
		Homepage();
	}
?>