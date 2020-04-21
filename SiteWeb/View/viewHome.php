<?php $titre = 'Home'; ?>

<?php ob_start(); ?>

<div class="contentpacing">

    <h4 class="alert alert-primary" role="alert">Information commande en cours</h4>

    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Nom commande :</h5>
            <p id="nom_commande" class="card-text text-center infoCard"></p>
        </div>
    </div>

    <!-- <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Date début production :</h5>
            <p id="date_debut" class="card-text text-center infoCard">4 avril 2020 12:45</p>
        </div>
    </div> -->

    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Quantité à produire :</h5>
            <p id="quantite_produire" class="card-text text-center infoCard"></p>
        </div>
    </div>

    <br>

    <h4 class="alert alert-primary" role="alert">Mesure</h4>
    <h5 class="lastUpdateDate" id="lastUpdateMesure"></h5>

    <div class="row">

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Température:</h5>
                        <p id="temperature" class="card-text text-center infoCard"></p>
                    </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Humidité:</h5>
                        <p id="humidite" class="card-text text-center infoCard"></p>
                    </div>
            </div>
        </div>

    </div>

    <br>
    <div class="container">
        <canvas  id="diagrammeTemperature"></canvas>
    </div>
    <br>

    <br>
    <div class="container">
        <canvas  id="diagrammeHumidite"></canvas>
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
                        <p id="quantite_bon" class="card-text text-center acceptQuantities"></p>
                    </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Quantité rejettés:</h5>
                        <p id="quantite_bad" class="card-text text-center rejectQuantities"></p>
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

<script type="text/javascript" src="Assets/JS/gestion_accueil.js"></script>
<script type="text/javascript" src="Assets/JS/gestion_diagramme.js"></script>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>