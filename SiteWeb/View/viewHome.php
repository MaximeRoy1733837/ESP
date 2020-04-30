<?php $titre = 'Home'; ?>

<?php ob_start(); ?>

<div class="contentpacing">

    <h4 class="alert alert-primary" role="alert">Information commande en cours</h4>

    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Nom commande :</h5>
            <h6 id="nom_commande" class="card-text text-center infoCard"></h6>
        </div>
    </div>

    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Quantité à produire :</h5>
            <h6 id="quantite_produire" class="card-text text-center infoCard"></h6>
        </div>
    </div>

    <br>

    <h4 class="alert alert-primary" role="alert">Mesure</h4>

    <div class="row">

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Température:</h5>
                        <h6 id="temperature" class="card-text text-center infoCard"></h6>
                    </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Humidité:</h5>
                        <h6 id="humidite" class="card-text text-center infoCard"></h6>
                    </div>
            </div>
        </div>

    </div>

    <br>
    <br>

    <div class="container">
        <canvas  id="diagrammeMesure" style="position: relative";></canvas>
    </div>

    <br>



    <br>

    <h4 class="alert alert-primary" role="alert">Quantité production</h4>
    <h5 class="lastUpdateDate" id="lastUpdateQuantities"></h5>

    <div class="row">

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Quantité acceptés:</h5>
                        <h6 id="quantite_bon" class="card-text text-center acceptQuantities"></h6>
                    </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Quantité rejettés:</h5>
                        <h6 id="quantite_bad" class="card-text text-center rejectQuantities"></h6>
                    </div>
            </div>
        </div>

    </div>

    <br>

    <div class="progress" style="height: 30px;">
        <div id="progression" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <br>

    <h4 id="mg_erreur" class="alert alert-danger d-none" role="alert"></h4>

    <br>
    <br>

</div> 


<script type="text/javascript" src="Assets/JS/gestion_diagramme.js"></script>
<script type="text/javascript" src="Assets/JS/gestion_accueil.js"></script>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>