<?php
  $titre_de_page = "Se connecter"; include(__DIR__.'/../Core/header.php');
?>
<?php 
  if(isset($_SESSION['email']))
  {
?>
    <h4 class="alert alert-info">Vous êtes déjà connecté, voulez-vous vous <a href="<?php echo lien_vers_deconnexion(); ?>">déconnecter</a> ?</h4>
<?php
  }
  else
  {
?>
<form method='post'>

    <div class="container">
        <div class="row" style="margin-top:20px">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form role="form">
                    <form class="form-signin" method="post">
                        <fieldset>
                            <h2>Se connecter</h2>

                            <?php if(isset($erreur_connexion)) { ?>
                            <h4 class="alert alert-danger"><?php echo $erreur_connexion; ?></h4>
                            <?php } ?>
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" name="email" placeholder="Adresse email" required autofocus="" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control input-lg" name="mdp" placeholder="Mot de passe" required/>
                            </div>
                            <input type="hidden" name="connexion_personne" value="on" />

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <button class="btn btn-lg btn-success btn-block" type="submit">Se connecter</button>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">

                                </div>
                                <a href="" class="btn btn-link pull-right">Mot de passe oublié ?</a>
                            </div>
                            <br>
                            <p class="text--center">Pas inscrit ? <a href="<?php echo lien_vers_inscription() ?>">S'inscrire maintenant</a> </use>
                            </p>
                        </fieldset>
                    </form>
            </div>
        </div>
    </div>

<?php
  }
?>
<?php
  include(chemin_vers_footer());
?>