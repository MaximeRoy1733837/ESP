<?php $titre = 'Home'; ?>

<?php ob_start(); ?>

<div class="contentpacing">

    <h4 class="alert alert-primary" role="alert">Information commande en cours</h4>

    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Nom commande :</h5>
            <p class="card-text text-center infoCard">Test123</p>
        </div>
    </div>

    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Date début production :</h5>
            <p class="card-text text-center infoCard">4 avril 2020 12:45</p>
        </div>
    </div>

    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Quantité à produire :</h5>
            <p class="card-text text-center infoCard">220</p>
        </div>
    </div>

    <br>

    <h4 class="alert alert-primary" role="alert">Mesure</h4>
    <h5 class="lastUpdateDate">Dernière mise à jour : 6 avril 2020 11:16:36</h5>

    <div class="row">

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Température:</h5>
                        <p class="card-text text-center infoCard">23</p>
                    </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Humidité:</h5>
                        <p class="card-text text-center infoCard">16</p>
                    </div>
            </div>
        </div>

    </div>

    <br>

    <h4 class="alert alert-primary" role="alert">Quantité production</h4>
    <h5 class="lastUpdateDate">Dernière mise à jour : 6 avril 2020 11:16:36</h5>

    <div class="row">

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Quantité acceptés:</h5>
                        <p class="card-text text-center acceptQuantities">55</p>
                    </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Quantité rejettés:</h5>
                        <p class="card-text text-center rejectQuantities">12</p>
                    </div>
            </div>
        </div>

    </div>

    <br>

    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
    </div>

    <br>
    <br>
    <br>

</div> 

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>