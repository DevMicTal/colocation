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