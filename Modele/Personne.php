<?php /* Ce modèle gère la table personne */

    /*---------------------------------------------------------------
     						insertion_personne
    -----------------------------------------------------------------
    Entrée: -Nom de la personne, prenom, email et mot de passe saisie.
    Retour: VRAI si insertion correctement effectuer.
            FAUX si erreur lors de l'insertion.
    -----------------------------------------------------------------
     Cette fonction insert en base de donnée une personne (lors
     de son inscription).
    ---------------------------------------------------------------*/
function insertion_personne($nom_personne, $prenom, $email, $mdp)
{
    $conn = connection_BDD();
    $stmt = mysqli_stmt_init($conn);
    $statue = false;
    if (mysqli_stmt_prepare($stmt, 'INSERT INTO personne(nom, prenom, email, mdp) VALUES(?, ?, ?, ?)'))
    {
        mysqli_stmt_bind_param($stmt, "ssss", $nom_personne, $prenom, $email, $mdp);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $statue = true;
    }
    mysqli_close($conn);
    return statue;
}

    /*---------------------------------------------------------------
     						modification_personne
    -----------------------------------------------------------------
    Entrée: -Nom de la personne, prenom, email et mot de passe saisie.
    Retour: VRAI si modification correctement effectuer.
            FAUX si erreur lors de la modification.
    -----------------------------------------------------------------
     Cette fonction modifie en base de donnée une personne.
    ---------------------------------------------------------------*/
function modification_personne_avec_mot_de_passe($nom_personne, $prenom, $email, $mdp, $ancien_email)
{
    $conn = connection_BDD();
    $stmt = mysqli_stmt_init($conn);
    $statue = false;
    if (mysqli_stmt_prepare($stmt, 'UPDATE personne SET nom = ?, prenom = ?, email = ?, mdp = ? WHERE email = ?'))
    {
        mysqli_stmt_bind_param($stmt, "sssss", $nom_personne, $prenom, $email, $mdp, $ancien_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $statue = true;
    }
    mysqli_close($conn);
    return statue;
}

function modification_personne($nom_personne, $prenom, $email, $ancien_email)
{
    $conn = connection_BDD();
    $stmt = mysqli_stmt_init($conn);
    $statue = false;
    if (mysqli_stmt_prepare($stmt, 'UPDATE personne SET nom = ?, prenom = ?, email = ? WHERE email = ?'))
    {
        mysqli_stmt_bind_param($stmt, "ssss", $nom_personne, $prenom, $email, $ancien_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $statue = true;
    }
    mysqli_close($conn);
    return statue;
}


function recuperation_utilisateur_avec_email($email)
{
    $resultat = array();
    $conn = connection_BDD();
    
    if($req_pre = mysqli_prepare($conn, 'SELECT num_personne, nom, prenom, email FROM personne WHERE email = ?'))
    {
        mysqli_stmt_bind_param($req_pre, "s", $email);
        mysqli_stmt_execute($req_pre);
        mysqli_stmt_bind_result($req_pre, $resultat_num_personne, $resultat_nom , $resultat_prenom, $resultat_email);
        
        while(mysqli_stmt_fetch($req_pre))
        {
            $resultat['num_personne'] = $resultat_num_personne;
            $resultat['nom'] = $resultat_nom;
            $resultat['prenom'] = $resultat_prenom;
            $resultat['email'] = $resultat_email;
        }
    }
    mysqli_close($conn);
    return $resultat;
}

function recuperation_utilisateur($id)
{
    $resultat = array();
    $conn = connection_BDD();
    
    if($req_pre = mysqli_prepare($conn, 'SELECT num_personne, nom, prenom, email FROM personne WHERE num_personne = ?'))
    {
        mysqli_stmt_bind_param($req_pre, "i", $id);
        mysqli_stmt_execute($req_pre);
        mysqli_stmt_bind_result($req_pre, $resultat_num_personne, $resultat_nom , $resultat_prenom, $resultat_email);
        
        while(mysqli_stmt_fetch($req_pre))
        {
            $resultat['num_personne'] = $resultat_num_personne;
            $resultat['nom'] = $resultat_nom;
            $resultat['prenom'] = $resultat_prenom;
            $resultat['email'] = $resultat_email;
        }
    }
    mysqli_close($conn);
    return $resultat;
}

function recuperation_mdp_crypte($email)
{
    $resultat = "";
    $conn = connection_BDD();
    if($req_pre = mysqli_prepare($conn, 'SELECT mdp FROM personne WHERE email = ?'))
    {
        mysqli_stmt_bind_param($req_pre, "s", $email);
        mysqli_stmt_execute($req_pre);
        mysqli_stmt_bind_result($req_pre, $resultat_mdp_crypte);
        
        while(mysqli_stmt_fetch($req_pre))
        {
            $resultat = $resultat_mdp_crypte;
        }
    }
    mysqli_close($conn);
    return $resultat;
}

function email_exist($email)
{
    $conn = connection_BDD();
    $resultat = "";
    
    if($req_pre = mysqli_prepare($conn, 'SELECT email FROM personne WHERE email = ?'))
    {
        mysqli_stmt_bind_param($req_pre, "s", $email);
        mysqli_stmt_execute($req_pre);
        mysqli_stmt_bind_result($req_pre, $resultat_email_recherche);
        
        while(mysqli_stmt_fetch($req_pre))
        {
            $resultat = $resultat_email_recherche;
        }
    }
    
    mysqli_close($conn);
    return $resultat != "";
}