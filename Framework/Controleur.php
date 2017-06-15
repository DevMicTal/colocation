<?php /* Fonction comune à tous les controleurs */

    session_start();
    include("configuration.php");
    include("Modele.php");
    /* Voir si je met cette include dans le ControleurPersonne */
    include(__DIR__."/../Modele/Personne.php");
    include(__DIR__."/../Modele/AnnonceLogement.php");

    include(__DIR__."/../Controleur/ControleurAccueil.php");
    include(__DIR__."/../Controleur/ControleurAnnonceLogement.php");
    include(__DIR__."/../Controleur/ControleurPersonne.php");

    function chemin_vers_header()
    {
        return __DIR__."/..Vue/Core/header.php";
    }
    
    function chemin_vers_footer()
    {
        return __DIR__."/../Vue/Core/footer.php";
    }

    function lien_vers_accueil()
    {
        return "/bts-sio/colocation/Vue/Accueil/index.php";
    }
    
    function lien_vers_connexion()
    {
        return "/bts-sio/colocation/Vue/Personne/connexion.php";
    }
    
    function lien_vers_inscription()
    {
        return "/bts-sio/colocation/Vue/Personne/inscription.php";
    }

    function lien_vers_credits()
    {
        return "/bts-sio/colocation/Vue/Accueil/credits.php";
    }
    
    function lien_vers_deconnexion()
    {
        return "/bts-sio/colocation/Vue/Personne/deconnexion.php";
    }
    
    function lien_vers_dashboard()
    {
        return "/bts-sio/colocation/Vue/Personne/dashboard.php";
    }
    
    function lien_vers_parametre()
    {
        return "/bts-sio/colocation/Vue/Personne/parametre.php";
    }
    
    function lien_vers_ajout_annonce_logement()
    {
        return "/bts-sio/colocation/Vue/AnnonceLogement/ajoutAnnonceLogement.php";
    }
    
    function lien_vers_annonce_logement($num_annonce_logement)
    {
        return "/bts-sio/colocation/Vue/AnnonceLogement/index.php?num_annonce_logement=$num_annonce_logement";
    }
?>