<?php $titre = 'Connexion'; ?>

<?php ob_start(); ?>

<div class="">
    

    <div class="contentSpacing">
        <form id="frm_connexion" name="frm_connexion" method="POST" action="#">

            <div class="form-group">
                <label for="txt_username">Username</label>
                <input type="text" class="form-control" id="txt_username" name="txt_username" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="txt_mdp">Password</label>
                <input type="password" class="form-control" id="txt_mdp" name="txt_mdp" placeholder="Password">
            </div>

            <div id="etat_connexion" style="color:red"></div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div> 
</div> 

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>