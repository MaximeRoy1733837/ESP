<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $titre ?></title>

	<script type="text/javascript" src="Plugin/jquery-validate-1.19.1/lib/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="Plugin/jquery-validate-1.19.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="Plugin/jquery-validate-1.19.1/dist/localization/messages_fr.js"></script>
    <script type="text/javascript" src="Plugin/Chart.bundle.min.js"></script>

	<link rel="stylesheet" href="Plugin/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="Plugin/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Plugin/sweetalert2/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="Assets/CSS/style.css">

</head>
<body>
    <div class="">
        <div class="" name="menu">
            <?php if($currentPage != "Connexion") require("View/viewMenu.php") ?>
        </div>

        <div class=""> 
            <?= $contenu ?>
        </div> 
    </div>  

</body>

<script type="text/javascript" src="Assets/JS/gestion_connexion.js"></script>


</html>