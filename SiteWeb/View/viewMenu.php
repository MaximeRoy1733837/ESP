<nav class="navbar navbar-expand-lg navbar navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="#">Siemens S7-1200</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link <?php if($currentPage == "Home"){?>  active <?php } ?>" href="index.php?action=Home">Home</a>
      <a class="nav-item nav-link <?php if($currentPage == "Historique"){?>  active <?php } ?>" href="index.php?action=Historique">Historique</a>
      <a class="nav-item nav-link" href="index.php?action=Connexion">Se déconnecter</a>
    </div>
  </div>
</nav>
<br>
<br>
<br>
<div class="container text-center">
    <a href="index.php?action=Home">
        <img src="Assets/Images/Mecanium.png" alt="Mecanium Logo" class="img-responsive center-block">
    </a>
</div>