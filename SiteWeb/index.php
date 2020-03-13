<?php
    require('controller/controller.php');

    if (isset($_GET['action'])) {
		switch ($_GET['action'] ) {
			case 'Home':
				Homepage();
				break;
			case 'Anime':	
				ListeAnimes();
                break;
            case 'Manga':	
				ListeMangas();
				break;
			case 'Connexion':	
				PageConnexion();
			case 'Compte':
					Compte();
				break;
			default :
				throw new Exception('Aucune page spécifique demandée');	
		}
	}	
	else {
		Homepage(); 
	}
?>