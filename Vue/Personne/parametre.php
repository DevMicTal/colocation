<?php   $titre_de_page = "Accueil";
        include(__DIR__.'/../Core/header.php');
?>
<?php if(!isset($_SESSION['email']))
	{
?>
	<h4 class="alert alert-info">Vous devez être connecté pour accèder à vos paramètres, voulez-vous vous <a href="<?php echo lien_vers_connexion(); ?>">connecter</a> ? Pas encore inscrit ? <a href="<?php echo lien_vers_inscription(); ?>">Inscrivez-vous maintenant</a></h4>
<?php
      }
      else
      {
?>
	    <?php if(isset($erreur_modification_personne) && $erreur_modification_personne != "") 
		{ ?>
            <h4 class="alert alert-danger"><?php echo $erreur_modification_personne; ?></h4>
		<?php
		} ?>
	    <?php if(isset($_GET['modification_reussi']) && $_GET['modification_reussi'] == "oui") 
		{ ?>
            <h3 class="alert alert-info">Modification bien prise en compte.</h3>
		<?php
		} ?>
<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <h2>Modifier mes informations</h2>
            <form method="post">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="prenom" placeholder="Prénom" value="<?php if(isset($_SESSION['prenom'])) echo $_SESSION['prenom']; ?>" required />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="nom" placeholder="Nom de famille" value="<?php if(isset($_SESSION['nom'])) echo $_SESSION['nom']; ?>" required />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="email" placeholder="Adresse email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>" required />
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" name="mdp" placeholder="Nouveau mot de passe" />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" name="confirmation_mdp" placeholder="Confirmer le mot de passe" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 .col-md-4">
                        <input type="submit" class="btn btn-primary btn-block btn-lg" name="update_user" value="Enregistrer" tabindex="7">
                    </div>
                </div>
                <input type="hidden" class="form-control" name="modification_personne" value="on" />
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