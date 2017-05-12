<?php  $titre_de_page = "Tableau de bord : Mon Compte"; include(__DIR__.'/../Core/header.php'); ?>

<?php

if(isset($inscription_reussi) && $inscription_reussi == "oui")
{
    echo "Inscription réussie ! Bienvenue sur votre compte (tu pourra mettre du html à la place val)";
}
if(isset($connexion_reussi) && $connexion_reussi == "oui")
{
    echo "Mettre un texte de bienvenue lors de la connection";
}
?>

<?php include(chemin_vers_footer()); ?>