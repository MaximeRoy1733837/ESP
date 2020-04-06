<?php $titre = 'Historique'; ?>

<?php ob_start(); 
$cpt = 0;?>
<div class="accordion" id="accordionExample">
    
        <?php while ($enregistrement=$resultat->fetch()){ ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo $cpt ?>">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $cpt ?>" aria-expanded="false" aria-controls="collapse<?php echo $cpt ?>">
                            Commande: <?php echo $enregistrement['nom_commande'] ?> 
                            Date: <?php echo $enregistrement['date_historique'] ?>
                        </button>
                    </h2>
                </div>

                <div id="collapse<?php echo $cpt ?>" class="collapse" aria-labelledby="heading<?php echo $cpt ?>" data-parent="#accordionExample">
                    <div class="card-body">
                        Quantité de bon: <?php echo $enregistrement['quantite_bon'] ?> </br>
                        Quantité de mauvais: <?php echo $enregistrement['quantite_mauvais'] ?> </br>
                        Température: <?php echo $enregistrement['temperature'] ?> °C </br>
                        Humidité: <?php echo $enregistrement['humidite'] ?> % </br>
                    </div>
                </div>
            </div>
            
        <?php   $cpt++;
                }       
                $resultat->closeCursor(); ?>
</div>


 

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>