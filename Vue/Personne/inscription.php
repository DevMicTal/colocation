<?php  
	$titre_de_page = "S'inscrire"; include(__DIR__.'/../Core/header.php');
?>
<?php if(isset($_SESSION['email']))
	{
?>
	<h2>Vous êtes déjà connecté, voulez-vous vous <a href="<?php echo lien_vers_deconnexion(); ?>">déconnecter</a> ?</h2>
<?php
      }
      else
      {
?>
		<?php if(isset($erreur_inscription) && $erreur_inscription != "") 
		{ ?>
            <h4 class="alert alert-danger"><?php echo $erreur_inscription; ?></h4>
		<?php
		} ?>
		
<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <h2>S'inscrire</h2>
            <form method="post">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="prenom" placeholder="Prénom" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>" required />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="nom" placeholder="Nom de famille" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>" required />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="email" placeholder="Adresse email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required />
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" name="mdp" placeholder="Mot de passe" required />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" name="confirmation_mdp" placeholder="Confirmer le mot de passe" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 .col-md-4">
                        <input type="submit" class="btn btn-primary btn-block btn-lg" name="register_user" value="S'inscrire" tabindex="7">
                    </div>
                </div>
                <input type="hidden" class="form-control" name="inscription_personne" value="on" />
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