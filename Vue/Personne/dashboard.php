<?php  $titre_de_page = "Tableau de bord : Mon compte"; include(__DIR__.'/../Core/header.php'); ?>

<?php

if(isset($_GET['inscription_reussi']) && $_GET['inscription_reussi'] == "oui")
{
    echo "Inscription réussie ! Bienvenue sur votre compte (tu pourra mettre du html à la place val)";
}
if(isset($_GET['connexion_reussi']) && $_GET['connexion_reussi'] == "oui")
{
    echo "<h1>";
    echo $_SESSION['email'];
    echo $_SESSION['nom'];
    echo $_SESSION['prenom'];
    echo "</h1>";
}
if(isset($_SESSION['email']))
{
    echo "Voici votre tableau de bord, vous y trouverais vos dernieres annonces déposé.";
    echo "<h3>Vos annonces : </h3>";
    $annonces = recuperer_toutes_mes_annonces_logements();
    if($annonces == "Erreur: Aucune annonce disponible." || $annonces == "")
    {
            echo "Aucun annonce publié.";
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
}
else
{
    echo "Veuillez vous connecter avant d'acceder a votre tableau de bord";
}
?>
<?php include(chemin_vers_footer()); ?>