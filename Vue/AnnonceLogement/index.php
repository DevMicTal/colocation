<?php // Contiendra l'accueil des annonces de logement
        $titre_de_page = "Accueil";
        include(__DIR__.'/../Core/header.php');
        $annonce = recupere_annonce_logement($_GET['num_annonce_logement']);
        if($annonce == "Erreur: Aucune annonce ne correspond." || $annonce == "")
        {
                ?>
                <h4 class="alert alert-info">L'annonce n'existe pas ou n'est plus disponible.</h4>
                <?php
        }
        else
        {
                if(isset($_GET['ajout_annonce_logement_reussi']) && $_GET['ajout_annonce_logement_reussi'] == "oui")
                {
                 
                ?>
                <h4 class="alert alert-info">Ajout de l'annonce réussie ! Voici votre annonce </h4>"
                <?php
                }
                $proprietaire_de_l_annonce = recupere_utilisateur($annonce['num_personne_ID'])
?>
                <div class="jumbotron">
                        <h1><?php echo $annonce['titre']; ?></h1>
                        <p class="description_full"><?php echo $annonce['description']; ?></p>
                        <div class="email_full">Contactez-moi : <a href="mailto:<?php echo $proprietaire_de_l_annonce['email']; ?>"><?php echo $proprietaire_de_l_annonce['email']; ?></a></div>
                </div>
                
                

<table class="table table"> 
         <tbody>
                 <tr> 
                 <th>Prix</th> 
                 <td><div class="prix_full"><?php echo $annonce['prix']; ?>€</div></td> 
                 </tr>
                 <tr> 
                 <th>Adresse</th> 
                 <td><div class="adresse_full">Adresse : <?php echo $annonce['adresse']; ?></div></td> 
                 </tr> 
                 <tr> 
                 <th>Surface</th> 
                 <td><div class="surface_full"><?php echo $annonce['surface']; ?>m²</div></td> 
                 </tr>
                 <tr>
                <th>Personne(s) pouvant être accueilli(s)</th>
                <td><div class="nbpersonne_full"><?php echo $annonce['nb_personne']; ?></div></td> 
                 </tr>
                 <tr> 
                 <th>Début de la disponibilité</th> 
                 <td><div class="debutdispo_full"><?php echo $annonce['debut_disponibilite']; ?></div></td> 
                 </tr> 
		 <tr> 
                 <th>Fin de la disponibilité</th> 
                 <td><div class="findispo_full"><?php echo $annonce['fin_disponibilite']; ?></div></td> 
                 </tr> 
        </tbody> 
</table>
                
                
                
<?php   }
        include(chemin_vers_footer()); 
?>
