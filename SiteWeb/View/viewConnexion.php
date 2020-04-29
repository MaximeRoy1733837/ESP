<?php $titre = 'Connexion'; ?>

<?php ob_start(); ?>

<div class="container text-center">
    <div class="">
        <a href="">
            <img src="Assets/Images/Mecanium.png" alt="Mecanium Logo" class="img-responsive center-block">
        </a>
    </div>

    <br>
    <br>

    <h4 class="alert alert-primary" role="alert">Connection</h4>
    
    <div class="contentSpacing">
        <form id="frm_connexion" name="frm_connexion" method="POST" action="#">

            <div class="form-group">
                <input type="text" class="form-control form-control-lg mb-2" id="txt_utilisateur" name="txt_utilisateur" placeholder="Nom d'utilisateur">
            </div>

            <div class="form-group">
                <input type="password" class="form-control form-control-lg mb-2" id="txt_mdp" name="txt_mdp" placeholder="Mot de passe">
            </div>

            <div id="etat_connexion" style="color:red"></div>

            <br>
            
            <div class="">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>
    </form>
</div> 
</div> 

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>