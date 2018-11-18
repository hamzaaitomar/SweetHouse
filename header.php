	<?php
  if(!isset($_SESSION["email"]))
  {
  ?>
  <ul>
  <li id="logo-li"><img id="logo" src="logo.png"></li>
  <li><a href="#accueil"><p>Accueil</p></a></li>
  <li><a href="inscription.php"><p>Inscription</p></a></li>
  <li><a href="connexion.php"><p>Connexion</p></a></li>
  <li><a href="#aide"><p>Aide</p></a></li>
  <li><a href="#contact"><p>Contactez-nous !</p></a></li>
	</ul>
  <?php
}
else
{
  ?>
    <ul>
  <li id="logo-li"><img id="logo" src="logo.png"></li>
  <li><a href="#accueil"><p>Accueil</p></a></li>
  <li><a href="#inscription"><p>Gestion Profil</p></a></li>
  <li><a href="#connexion"><p>Gestion Maison</p></a></li>
  <li><a href="deconnexion.php"><p>Déconnexion</p></a></li>
  <li><a href="#contact"><p>Contactez-nous !</p></a></li>
  </ul>
  <?php
}
  ?>