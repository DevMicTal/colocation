<?php
    if(isset($_POST['ajouter_annonce_logement']) && isset($_SESSION['email']))
    {
        //Normalement je devrais faire un isset sur tout les champs avant d'appeler la fonction et afficher les erreurs ...
        $erreur_ajout_annonce_logement = ajout_annonce_logement($_POST['titre'], $_POST['description'], $_POST['adresse'], $_POST['prix'], $_POST['surface'], $_POST['debut_disponibilite'], $_POST['fin_disponibilite'], $_POST['nb_personne'], $_SESSION['email']);
    }
    
    if(isset($_POST["recherche_logement"]))
    {
        $reponse_recherche_logement = recherche_logement($_POST['contenu']);
    }
   
    /*---------------------------------------------------------------
     						ajout_annonce_logement
    -----------------------------------------------------------------
    Entrée: -Titre, description, prix, surface, debut disponibilité,
    fin disponibilité, nombre de personnes, email.
    Sortie: -Etat de l'insertion (réussi ou échoué).
    -----------------------------------------------------------------
     Cette procèdure sert à s'incrire sur le site.
    ---------------------------------------------------------------*/
   function ajout_annonce_logement($titre, $description, $adresse, $prix, $surface, $debut_disponibilite, $fin_disponibilite, $nb_personne, $email)
   {
       var_dump($titre);
        $titre = htmlspecialchars($titre);
         var_dump($titre);
        $description = htmlspecialchars($description);
        $adresse = htmlspecialchars($adresse);
        $prix = htmlspecialchars($prix);
        $surface = htmlspecialchars($surface);
        $debut_disponibilite = htmlspecialchars($debut_disponibilite);
        $fin_disponibilite = htmlspecialchars($fin_disponibilite);

        $insertion = true;
        $erreur_ajout_annonce_logement = "";
        
        /* Test multiples, si un teste échoue, l'insertion est fausse est donc devient impossible */
        if(strlen($titre) < 2 || strlen($titre) > 255)
        {
            $erreur_ajout_annonce_logement = "Erreur: titre '$nom' incorrect.";
            $insertion = false;
        }
        if(strlen($description) < 10 || strlen($description) > 10000)
        {
            $erreur_ajout_annonce_logement = "Erreur: description '$description' incorrect.";
            $insertion = false;
        }
        if(strlen($adresse) < 5 || strlen($adresse) > 1000)
        {
            $erreur_ajout_annonce_logement = "Erreur: Adresse '$adresse' incorrect.";
            $insertion = false;
        }
        if($prix < 25 || $prix > 10000)
        {
            $erreur_ajout_annonce_logement = "Erreur : Le prix doit être compris entre 25 € et 10000 €.";
            $insertion = false;
        }
        if($surface < 9 || $prix > 10000)
        {
            $erreur_ajout_annonce_logement = "Erreur : La surface doit être compris entre 9 m2 et 10000 m2.";
            $insertion = false;
        }
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $debut_disponibilite) ) {
            $erreur_ajout_annonce_logement = "Erreur : Date de début de disponibilité incorrect.";
            $insertion = false;
        }
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fin_disponibilite) ) {
            $erreur_ajout_annonce_logement = "Erreur : Date de fin de disponibilité incorrect.";
            $insertion = false;
        }
        if($nb_personne < 2 || $nb_personne > 100)
        {
            $erreur_ajout_annonce_logement = "Erreur : Nombre de personne.";
            $insertion = false;
        }
        
        if($insertion) {
            $infos_personne_deposant_annonce = recuperation_utilisateur_avec_email($email);
            $req_correctement_execute = insertion_annonce_logement($titre, $description, $adresse, $prix, $surface, $debut_disponibilite, $fin_disponibilite, $nb_personne, $infos_personne_deposant_annonce['num_personne']);
            if($req_correctement_execute)
            {
                header('Location: '.lien_vers_annonce_logement($req_correctement_execute).'&ajout_annonce_logement_reussi=oui');
            }
            else
            {
                $erreur_ajout_annonce_logement = "Erreur lors de l'ajout en base de données (erreur interne).";
            }
        }
        
        return $erreur_ajout_annonce_logement;
   }
   
    function recuperer_toutes_les_annonces_logements() {
        
        $annonces_logements = recuperation_toutes_les_annonces_logements();
        
        if($annonces_logements != "") {
            return $annonces_logements;
        }
        
        return "Erreur: Aucune annonce disponible.";
    }
    
     function recuperer_toutes_mes_annonces_logements() {
        $personne = recuperation_utilisateur_avec_email($_SESSION['email']);
        $annonces_logements = recuperation_toutes_mes_annonces_logements($personne['num_personne']);
        
        if($annonces_logements != "") {
            return $annonces_logements;
        }
        
        return "Erreur: Aucune annonce disponible.";
    }
    
    function recupere_annonce_logement($num_annonce_logement) {
        
        $num_annonce_logement = htmlspecialchars($num_annonce_logement);
        $annonce_logement = recuperation_annonce_logement($num_annonce_logement);
        
        if($annonce_logement != "") {
            return $annonce_logement;
        }
        
        return "Erreur: Aucune annonce ne correspond.";
    }