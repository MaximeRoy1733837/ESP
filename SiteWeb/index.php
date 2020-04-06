<?php
    require('Controller/controller.php');

    if (isset($_GET['action'])) {
		switch ($_GET['action'] ) {
			case 'Home':
				Homepage();
				break;
			default :
				throw new Exception('Aucune page spécifique demandée');	
		}
	}	
	else {
		//Connexion(); 
		//Historique();
		Homepage();
	}
?>