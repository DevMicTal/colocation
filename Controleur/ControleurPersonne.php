<?php
    if(isset($_POST['inscription_personne']))
    {
        $erreur_inscription = inscription($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['confirmation_mdp']);
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
        $mdp = htmlspecialchars($mdp);
        $confirmation_mdp = htmlspecialchars($confirmation_mdp);
        $insertion = true;
        $erreur_inscription = "";
        
        /* Multiples testes, si un teste echoue, l'insertion devient fausse est donc devient impossible */
        if(strlen($nom) < 2 || strlen($nom) > 100)
        {
            $erreur_inscription = "Erreur: Nom '$nom' incorrect";
            $insertion = false;
        }
        if(strlen($prenom) < 2 || strlen($prenom) > 100)
        {
            $erreur_inscription = "Erreur: Prenom '$prenom' incorrect";
            $insertion = false;
        }
        if(strlen($mdp) < 6 || strlen($mdp) > 30)
        {
            $erreur_inscription = "Erreur: Le mot de passe doit être compris entre 6 et 30 caractère.";
            $insertion = false;
        }
        if($mdp != $confirmation_mdp)
        {
            $erreur_inscription = "Erreur: Les mots de passe ne sont pas identique.";
            $insertion = false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreur_inscription = "Erreur: Email incorrect";
            $insertion = false;
        }
        
        if(email_exist($email)) {
            $erreur_inscription = "Erreur: L'email est déjà utilisé";
            $insertion = false;
        }
        
        if($insertion) {
            $mdp = crypter_mdp($mdp);
            $req_correctement_execute = insertion_personne($nom, $prenom, $email, $mdp);
            if($req_correctement_execute)
            {
                session_start();
                $_SESSION['email'] = $email;
                $inscription_reussi = "oui";
                header('Location: '.lien_vers_dashboard().'');
            }
            else
            {
                $erreur_inscription = "Erreur: Erreur lors de l'ajout en base de donnée (erreur interne)";
            }
        }
        
        return $erreur_inscription;
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
            return "Erreur: Email incorrect";
        }
        
        if(email_exist($email))
        {
            $mdp_utilisateur_crypte = recuperation_mdp_crypte($email);
            if($mdp_utilisateur_crypte == "")
            {
                $erreur_connexion = "Erreur: Erreur Interne lors de la récuperation du mot de passe.";
            }
            
            if(password_verify($mdp_saisie, $mdp_utilisateur_crypte))
            {
                //Création de la sessions
                session_start();
                $_SESSION['email'] = $email;
                $connexion_reussi = "oui";
                header('Location: '.lien_vers_dashboard().'');
            }
            else
            {
                $erreur_connexion = "Erreur: Mot de passe incorrect";
            }
        }
        else
        {
            $erreur_connexion = "Erreur: cette adresse mail n'appartient à aucun compte.";
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
