<?php // Contiendra l'accueil des annonces de logement
        $titre_de_page = "Accueil";
        include(__DIR__.'/../Core/header.php');
?>
<br>
<?php
        $annonces = recuperer_toutes_les_annonces_logements();
        if($annonces == "Erreur: Aucune annonce disponible." || $annonces == "")
        {
                echo "Aucun annonce disponible.";
        }
        else
        {
            $annonces_order_by_date = array_reverse($annonces);
            foreach ($annonces_order_by_date as $annonce) {

?>
                <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $annonce['titre']; ?></div>
                        <div class="panel-body"><p class="adresse"><?php echo $annonce['adresse']; ?>");</p>
                        <p class="description"><?php echo substr($annonce['description'], 0, 200); ?> [...]</p>
                        <p class="surface=">Surface : <?php echo $annonce['surface']; ?>m²</p>
                        <p class="prix"><?php echo $annonce['prix']; ?>€</p>
                        <a href="<?php echo lien_vers_annonce_logement($annonce['num_annonce_logement']) ?>">En savoir plus sur l'annonce</a>
                        </div>
                </div>
<?php   
            }
            
        }
        include(chemin_vers_footer());
?>
