<?php   $titre_de_page = "Accueil";
        include(__DIR__.'/../Core/header.php');
?>
<?php if(!isset($_SESSION['email']))
	{
?>
	<h4 class="alert alert-info">Vous devez être connecté pour déposer une annonce, voulez-vous vous <a href="<?php echo lien_vers_connexion(); ?>">connecter</a> ? Pas encore inscrit ? <a href="<?php echo lien_vers_inscription(); ?>">Inscrivez-vous maintenant</a></h4>
<?php
      }
      else
      {
?>

<?php if(isset($erreur_ajout_annonce_logement) && $erreur_ajout_annonce_logement != "") 
{ ?>
    <h4 class="alert alert-danger"><?php echo $erreur_ajout_annonce_logement; ?></h4>
<?php
} ?>

<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <h2 class="display-2">Déposer une annonce</h2>
            <br>
            <form method="post">
                <div class="row">
                    <div class="form-group">
                        <input type="text" maxlength="255" class="form-control input-lg" name="titre" placeholder="Titre" value="" required />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control input-lg" id="description" name="description" maxlength="10000" placeholder="Description" onkeyup="reste(this.value);" rows="5"></textarea>
                        <span id="caracteres" class="compteur_char">10000</span> <span class="compteur_char">caractères restants.</span>

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-lg" name="adresse" placeholder="Adresse" value="" required />
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="input-group">
                                <input type="number" class="form-control input-lg" name="prix" placeholder="Prix" value="" required />
                                <span class="input-group-addon">€</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="input-group">
                                <input type="number" class="form-control input-lg" name="surface" placeholder="Surface" value="" required />
                                <span class="input-group-addon">m²</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="label_logement" for="debut_disponibilite">Début de la disponibilité</label>
                                <input type="date" class="form-control input-lg" id="debut_disponibilite" name="debut_disponibilite" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="label_logement" for="fin_disponibilite">Fin de la disponibilité</label>
                                <input type="date" class="form-control input-lg" id="fin_disponibilite" name="fin_disponibilite" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="label_logement" for="fin_disponibilite">Pouvant être accueilli(s)</label>
                                <input type="text" class="form-control input-lg" name="nb_personne" placeholder="Personne(s)" value="" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 .col-md-4">
                            <input type="submit" class="btn btn-primary btn-block btn-lg" name="ajoutAnnonceLogement" value="Valider">
                            <input type="hidden" name="ajouter_annonce_logement" value="on" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/bts-sio/colocation/Contenu/js/compteur_char.js"></script>
<?php
	}
?>
<?php include(chemin_vers_footer()); ?>
