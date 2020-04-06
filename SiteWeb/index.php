<?php
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
				Connexion();
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