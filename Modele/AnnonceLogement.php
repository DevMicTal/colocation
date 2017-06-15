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
function insertion_annonce_logement($titre, $description, $adresse, $prix, $surface, $debut_disponibilite, $fin_disponibilite, $nb_personne, $num_personne_ID) 
{
    $conn = connection_BDD();
    $stmt = mysqli_stmt_init($conn);
    $statue = 0;
    if (mysqli_stmt_prepare($stmt, 'INSERT INTO annonce_logement(titre, description, adresse, prix, surface, debut_disponibilite, fin_disponibilite, nb_personne, num_personne_ID) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)'))
    {
         var_dump($titre);
        mysqli_stmt_bind_param($stmt, "sssiissii", $titre, $description, $adresse, $prix, $surface, $debut_disponibilite, $fin_disponibilite, $nb_personne, $num_personne_ID);
        mysqli_stmt_execute($stmt);
        $statue = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
                    

    }
    mysqli_close($conn);
    return $statue;
}

function recuperation_toutes_les_annonces_logements()
{
    $resultat = "";
    $conn = connection_BDD();
    if($req_pre = mysqli_prepare($conn, 'SELECT * FROM annonce_logement'))
    {
        mysqli_stmt_execute($req_pre);
        mysqli_stmt_bind_result($req_pre, $resultat_num_annonce_logement, $resultat_titre, $resultat_description, $resultat_adresse, $resultat_prix, $resultat_surface, $resultat_debut_disponibilite, $resultat_fin_disponibilite, $resultat_nb_presonne, $resultat_num_personneID);
        
        $i = 0;
        while(mysqli_stmt_fetch($req_pre))
        {
            $resultat[$i]['num_annonce_logement'] = $resultat_num_annonce_logement;
            $resultat[$i]['titre'] = $resultat_titre;
            $resultat[$i]['description'] = $resultat_description;
            $resultat[$i]['adresse'] = $resultat_adresse;
            $resultat[$i]['prix'] = $resultat_prix;
            $resultat[$i]['surface'] = $resultat_surface;
            $resultat[$i]['debut_disponibilite'] = $resultat_debut_disponibilite;
            $resultat[$i]['fin_disponibilite'] = $resultat_fin_disponibilite;
            $resultat[$i]['nb_personne'] = $resultat_nb_presonne;
            $resultat[$i]['num_personne_ID'] = $resultat_num_personneID;
            $i++;
        }
    }
    mysqli_close($conn);
    return $resultat;
}

function recuperation_toutes_mes_annonces_logements($id)
{
    $resultat = "";
    $conn = connection_BDD();
    if($req_pre = mysqli_prepare($conn, 'SELECT * FROM annonce_logement WHERE num_personne_ID = ?'))
    {
        mysqli_stmt_bind_param($req_pre, "i", $id);
        mysqli_stmt_execute($req_pre);
        mysqli_stmt_bind_result($req_pre, $resultat_num_annonce_logement, $resultat_titre, $resultat_description, $resultat_adresse, $resultat_prix, $resultat_surface, $resultat_debut_disponibilite, $resultat_fin_disponibilite, $resultat_nb_presonne, $resultat_num_personneID);
        
        $i = 0;
        while(mysqli_stmt_fetch($req_pre))
        {
            $resultat[$i]['num_annonce_logement'] = $resultat_num_annonce_logement;
            $resultat[$i]['titre'] = $resultat_titre;
            $resultat[$i]['description'] = $resultat_description;
            $resultat[$i]['adresse'] = $resultat_adresse;
            $resultat[$i]['prix'] = $resultat_prix;
            $resultat[$i]['surface'] = $resultat_surface;
            $resultat[$i]['debut_disponibilite'] = $resultat_debut_disponibilite;
            $resultat[$i]['fin_disponibilite'] = $resultat_fin_disponibilite;
            $resultat[$i]['nb_personne'] = $resultat_nb_presonne;
            $resultat[$i]['num_personne_ID'] = $resultat_num_personneID;
            $i++;
        }
    }
    mysqli_close($conn);
    return $resultat;
}

function recuperation_annonce_logement($num_annonce_logement)
{
    $resultat = "";
    $conn = connection_BDD();
    if($req_pre = mysqli_prepare($conn, 'SELECT * FROM annonce_logement WHERE num_annonce_logement = ?'))
    {
        mysqli_stmt_bind_param($req_pre, "s", $num_annonce_logement);
        mysqli_stmt_execute($req_pre);
        mysqli_stmt_bind_result($req_pre, $resultat_num_annonce_logement, $resultat_titre, $resultat_description, $resultat_adresse, $resultat_prix, $resultat_surface, $resultat_debut_disponibilite, $resultat_fin_disponibilite, $resultat_nb_presonne, $resultat_num_personneID);
        
        while(mysqli_stmt_fetch($req_pre))
        {
            $resultat['num_annonce_logement'] = $resultat_num_annonce_logement;
            $resultat['titre'] = $resultat_titre;
            $resultat['description'] = $resultat_description;
            $resultat['adresse'] = $resultat_adresse;
            $resultat['prix'] = $resultat_prix;
            $resultat['surface'] = $resultat_surface;
            $resultat['debut_disponibilite'] = $resultat_debut_disponibilite;
            $resultat['fin_disponibilite'] = $resultat_fin_disponibilite;
            $resultat['nb_personne'] = $resultat_nb_presonne;
            $resultat['num_personne_ID'] = $resultat_num_personneID;
        }
    }
    mysqli_close($conn);
    return $resultat;
}

function supprimer_annonce_logement($num_annonce_logement)
{
    $resultat = "";
    $conn = connection_BDD();
    if($req_pre = mysqli_prepare($conn, 'SELECT * FROM annonce_logement WHERE num_annonce_logement = ?'))
    {
        mysqli_stmt_bind_param($req_pre, "s", $num_annonce_logement);
        mysqli_stmt_execute($req_pre);
        mysqli_stmt_bind_result($req_pre, $resultat_annonce_logement);
        
        while(mysqli_stmt_fetch($req_pre))
        {
            $resultat = $resultat_annonce_logement;
        }
    }
    mysqli_close($conn);
    return $resultat;
}
