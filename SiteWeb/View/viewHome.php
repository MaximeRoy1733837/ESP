<?php $titre = 'Home'; ?>

<?php ob_start(); ?>

<div class="contentpacing">

    <div class="row">

        <div class="col-sm-6">
            <div class="card bg-light">
                <div class="card-header">Quantite accepté:</div>
                    <div class="card-body">
                        <h5 class="card-title">Quantite accepté:</h5>
                        <p class="card-text text-center acceptQuantities">55</p>
                    </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card bg-light">
                <div class="card-header">Quantité rejecté:</div>
                    <div class="card-body">
                        <p class="card-text text-center rejectQuantities">12</p>
                    </div>
            </div>
        </div>

    </div>

</div> 

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>