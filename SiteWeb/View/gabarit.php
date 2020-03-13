<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $titre ?></title>

	<script type="text/javascript" src="plugins/jquery-validate-1.19.1/lib/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="plugins/jquery-validate-1.19.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="plugins/jquery-validate-1.19.1/dist/localization/messages_fr.js"></script>

	<link rel="stylesheet" href="plugins/bootstrapV4.41/css/bootstrap.min.css">
	<script type="text/javascript" src="plugins/bootstrapV4.41/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <div class="">
        <div class="" name="menu">
            <?php require('viewMenu.php'); ?>
        </div>

        <div class=""> 
            <?= $contenu ?>
        </div> 
    </div>  

</body>

<script type="text/javascript" src="assets/js/gestion_animes.js"></script>
</html>