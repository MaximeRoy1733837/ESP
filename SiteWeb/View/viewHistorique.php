<?php $titre = 'Historique'; ?>

<?php 
    ob_start(); 
    $cpt = 0;
    $commandeActuel = "";
?>

</br>
</br>
<h4 class="alert alert-primary" role="alert">Historique</h4>
<div class="accordion" id="accordionExample">

        <?php 
            while ($enregistrement=$resultat->fetch()){ 
                if($commandeActuel != $enregistrement["nom_commande"])
                {
                    $commandeActuel = $enregistrement["nom_commande"];
        ?>  <div class="card">
                <div class="card-header" id="heading<?php echo $cpt ?>">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $cpt ?>" aria-expanded="false" aria-controls="collapse<?php echo $cpt ?>">
                            <h5 class="cardH5"><p class="cardInfo"> Commande: <?php echo $enregistrement['nom_commande'] ?></p> </br>
                            <p class="cardInfo"> Date : <?php  echo $enregistrement['date_historique']; ?></p> </h5>
                        </button>
                    </h2>
                </div>

                <div id="collapse<?php echo $cpt ?>" class="collapse" aria-labelledby="heading<?php echo $cpt ?>" data-parent="#accordionExample">
                    <div class="card-body">
                    <?php   }
                         switch ($enregistrement['nom_capteur']) {
                            case 'bon': ?>
                               <p> Quantité de bon: <?php echo $enregistrement['valeur_capteur']; ?> </p>
                                <?php break;
                            case 'mauvais': ?>
                                <p> Quantité de mauvais: <?php echo $enregistrement['valeur_capteur']; ?> </p>
                                </div>
                                </div>
                                <?php break;
                            case 'temperature': ?>
                                <p> Température: <?php echo $enregistrement['valeur_capteur']; ?> °C </p>
                                <?php break;
                            case 'humidite': ?>
                                <p> Humidité: <?php echo $enregistrement['valeur_capteur']; ?> % </p>
                                <?php break;
                            default: 
                                break; 
                            }?> 
        <?php   $cpt++;
                }       
                $resultat->closeCursor(); ?>
</div>


 

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>