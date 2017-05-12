<?php
  $titre_de_page = "Se connecter"; include(__DIR__.'/../Core/header.php');
?>
<?php 
  if(isset($_SESSION['email']))
  {
?>
    <h1>Vous ête déjà connecter, voulez vous vous <a href="<?php echo lien_vers_deconnexion(); ?>">déconnectez</a> ?</h1>
<?php
  }
  else
  {
?>
    <form method='post'>
    
      <div class="wrapper">
        <form class="form-signin" method="post">       
          <h1>Se connecter</h1>
          
          <?php if(isset($erreur_connexion)) 
          { ?>
          	<h1 class="erreur"><?php echo $erreur_connexion; ?></h1>
          <?php
          } ?>
          
          <input type="text" class="form-control email-login-colocation" name="email" placeholder="Adresse email" required autofocus="" /><br>
          <input type="password" class="form-control password-login-colocation" name="mdp" placeholder="Mot de passe" required/>      
          <input type="hidden" name="connexion_personne" value="on" />
          <label class="checkbox">
          </label>
          <button class="btn btn-primary" type="submit">Se connecter</button>
        </form>
      </div>
    
    <br><p class="text--center">Pas inscrit ? <a href="<?php echo lien_vers_inscription() ?>">S'inscrire maintenant</a> </use></p>
<?php
  }
?>
<?php
  include(chemin_vers_footer());
?>