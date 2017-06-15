<?php
    if(isset($_POST['inscription_personne']))
    {
        $erreur_inscription = inscription($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['confirmation_mdp']);
    }
    if(isset($_POST['modification_personne']))
    {
        if(isset($_POST['mdp']) && $_POST['mdp'] != "")
        {
            $erreur_modification_personne = modifier_personne($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['confirmation_mdp']);
        }
        else
        {
            $erreur_modification_personne = modifier_personne($_POST['nom'], $_POST['prenom'], $_POST['email']);
        }
        var_dump($_POST['mdp']);
    }
    if(isset($_POST["connexion_personne"]))
    {
        $erreur_connexion = connexion($_POST['email'], $_POST['mdp']);
    }
   
    /*---------------------------------------------------------------
     						inscription
    -----------------------------------------------------------------
    Entrée: -Nom, Prenom, Email, Mdp, Confirmation du mot de passe.
    Sortie: -Variable de session de l'utilisateur connecté.
    -----------------------------------------------------------------
     Cette procèdure sert à s'incrire sur le site.
    ---------------------------------------------------------------*/
   function inscription($nom, $prenom, $email, $mdp, $confirmation_mdp)
   {
        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);
        $email = htmlspecialchars($email);
        $insertion = true;
        $erreur_inscription = "";
        
        /* Test multiples, si un teste échoue, l'insertion est fausse est donc devient impossible */
        if(strlen($nom) < 2 || strlen($nom) > 100)
        {
            $erreur_inscription = "<b>Erreur :</b> Nom '$nom' incorrect.";
            $insertion = false;
        }
        if(strlen($prenom) < 2 || strlen($prenom) > 100)
        {
            $erreur_inscription = "<b>Erreur :</b> Prénom '$prenom' incorrect.";
            $insertion = false;
        }
        if(strlen($mdp) < 6 || strlen($mdp) > 30)
        {
            $erreur_inscription = "<b>Erreur :</b> Le mot de passe doit être compris entre 6 et 30 caractères.";
            $insertion = false;
        }
        if($mdp != $confirmation_mdp)
        {
            $erreur_inscription = "<b>Erreur :</b> Les mots de passe saisis ne sont pas identiques.";
            $insertion = false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreur_inscription = "<b>Erreur :</b> Email incorrect.";
            $insertion = false;
        }
        
        if(email_exist($email)) {
            $erreur_inscription = "<b>Erreur :</b> L'email est déjà utilisé.";
            $insertion = false;
        }
        
        if($insertion) {
            $mdp = crypter_mdp($mdp);
            $req_correctement_execute = insertion_personne($nom, $prenom, $email, $mdp);
            if($req_correctement_execute)
            {
                $personne = recuperation_utilisateur_avec_email($email);
                //Création de la sessions
                session_start();
                $_SESSION['email'] = $personne['email'];
                $_SESSION['prenom'] = $personne['prenom'];
                $_SESSION['nom'] = $personne['nom'];
                header('Location: '.lien_vers_dashboard().'?inscription_reussi=oui');
            }
            else
            {
                $erreur_inscription = "Erreur lors de l'ajout en base de données (erreur interne).";
            }
        }
        
        return $erreur_inscription;
   }
   
       /*---------------------------------------------------------------
     						modifier_personne
    -----------------------------------------------------------------
    Entrée: -Nom, Prenom, Email, Mdp, Confirmation du mot de passe.
             Les mot de passe sont facultatifs.
    Sortie: -Variable de session de l'utilisateur connecté.
    -----------------------------------------------------------------
     Cette procèdure sert à modifier les information d'une personne.
    ---------------------------------------------------------------*/
   function modifier_personne($nom, $prenom, $email, $mdp = null, $confirmation_mdp = null)
   {
        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);
        $email = htmlspecialchars($email);
        $insertion = true;
        $erreur_modification_personne = "";
        
        /* Test multiples, si un teste échoue, l'insertion est fausse est donc devient impossible */
        if(strlen($nom) < 2 || strlen($nom) > 100)
        {
            $erreur_modification_personne = "<b>Erreur :</b> Nom '$nom' incorrect.";
            $insertion = false;
        }
        if(strlen($prenom) < 2 || strlen($prenom) > 100)
        {
            $erreur_modification_personne = "<b>Erreur :</b> Prénom '$prenom' incorrect.";
            $insertion = false;
        }
        if(isset($mdp) && strlen($mdp) < 6 || strlen($mdp) > 30)
        {
            $erreur_modification_personne = "<b>Erreur :</b> Le mot de passe doit être compris entre 6 et 30 caractères.";
            $insertion = false;
        }
        if(isset($mdp) && isset($mdp) != $confirmation_mdp)
        {
            $erreur_modification_personne = "<b>Erreur :</b> Les mots de passe saisis ne sont pas identiques.";
            $insertion = false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreur_modification_personne = "<b>Erreur :</b> Email incorrect.";
            $insertion = false;
        }
        if($email != $_SESSION['email'])
        {
            if(email_exist($email)) {
                $erreur_modification_personne = "<b>Erreur :</b> L'email est déjà utilisé.";
                $insertion = false;
            }
        }
        if($insertion) {
            if(isset($mdp))
            {
                $mdp = crypter_mdp($mdp);
                $req_correctement_execute = modification_personne_avec_mot_de_passe($nom, $prenom, $email, $mdp, $_SESSION['email']);
            }
            else
            {
                $req_correctement_execute = modification_personne($nom, $prenom, $email, $_SESSION['email']);
            }
            if($req_correctement_execute)
            {
                $personne = recuperation_utilisateur_avec_email($email);
                $_SESSION['email'] = $personne['email'];
                $_SESSION['prenom'] = $personne['prenom'];
                $_SESSION['nom'] = $personne['nom'];
                header('Location: '.lien_vers_parametre().'?modification_reussi=oui');

            }
            else
            {
                $erreur_modification_personne = "Erreur lors de la modification en base de données (erreur interne).";
            }
        }
        
        return $erreur_modification_personne;
   }
   
   function recupere_utilisateur_avec_email($email)
   {
        $email = htmlspecialchars($email);
        $utilisateur = recuperation_utilisateur_avec_email($email);
        
        if($utilisateur != "") {
            return $utilisateur;
        }
        
        return "Erreur: Aucune utilisateur ne correspond.";
   }
   
   function recupere_utilisateur($id)
   {
        $id = htmlspecialchars($id);
        $utilisateur = recuperation_utilisateur($id);
        
        if($utilisateur != "") {
            return $utilisateur;
        }
        
        return "Erreur: Aucune utilisateur ne correspond.";
   }
   
    /*---------------------------------------------------------------
     						connexion
    -----------------------------------------------------------------
    Entrée: -Email.
            -Mot de passe saisie.
    Sortie: -Variable de session de l'utilisateur connecté.
    -----------------------------------------------------------------
     Cette procèdure sert à ce connecter.
    ---------------------------------------------------------------*/
    function connexion($email, $mdp_saisie)
    {
        $email = htmlspecialchars($email);
        $mdp_saisie = $mdp_saisie;
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "<b>Erreur :</b> Email incorrect";
        }
        
        if(email_exist($email))
        {
            $mdp_utilisateur_crypte = recuperation_mdp_crypte($email);
            if($mdp_utilisateur_crypte == "")
            {
                $erreur_connexion = "Erreur interne lors de la récupération de mot de passe.";
            }
            
            if(password_verify($mdp_saisie, $mdp_utilisateur_crypte))
            {
                $personne = recuperation_utilisateur_avec_email($email);
                //Création de la sessions
                session_start();
                $_SESSION['email'] = $personne['email'];
                $_SESSION['prenom'] = $personne['prenom'];
                $_SESSION['nom'] = $personne['nom'];
                header('Location: '.lien_vers_dashboard().'?connexion_reussi=oui');
            }
            else
            {
                $erreur_connexion = "<b>Erreur :</b> Mot de passe incorrect.";
            }
        }
        else
        {
            $erreur_connexion = "<b>Erreur :</b> Cette adresse email n'appartient à aucun compte.";
        }
        return $erreur_connexion;
    }

    /*---------------------------------------------------------------
     						deconnexion
    -----------------------------------------------------------------
    Sortie: -Variable de session de l'utilisateur connecté.
            -Cookie de connexion automatique
    -----------------------------------------------------------------
     Cette procèdure sert à ce déconnecter.
    ---------------------------------------------------------------*/
    function deconnexion()
    {
        session_start();
        // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();
        
        // Suppression des cookies de connexion automatique
        setcookie('login', '');
        setcookie('pass_hache', '');
        
        header('Location: '.lien_vers_accueil().'');
    }
    
    /*---------------------------------------------------------------
     						crypter_mdp
    -----------------------------------------------------------------
    Entrée/Sorties: -Mot de passe crypter.
    -----------------------------------------------------------------
     Cette fonction sert à crypter un mot de passe.
    ---------------------------------------------------------------*/
    function crypter_mdp($mdp)
    {
        return password_hash($mdp, PASSWORD_BCRYPT,['cost' => 13]) ;
    }


?>
