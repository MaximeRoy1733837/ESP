<?php
    require('Controller/controllerAjax.php');

    if (isset($_GET['event'])) {
		switch ($_GET['event'] ) {
			case 'GetNewInfo':
				getLastInsertedInfo();
				break;
			default :
				throw new Exception('Aucune page spécifique demandée');	
		}
	}	
	else {
		Homepage(); 
	}
?>