<?php /* Fonction comunne à tous les modéles */
    
    function connection_BDD()
    {
        //$passwordBackEnd = motDePasse();
        $ma_config = recup_config();
        $host = $ma_config['host'];
        $user = $ma_config['user'];
        $passwd = $ma_config['passwd'];
        $dbname = $ma_config['dbname'];

        $conn = mysqli_connect($host, $user, $passwd, $dbname);
        $conn->set_charset("utf8");
        if ($conn->connect_error)
        {
            die("Connexion échoué : " . $conn->connect_error);
        } 

        /* La création de table à étais faite, je met donc cette portion de code en commentaire */
        
        $req = "CREATE TABLE IF NOT EXISTS personne
        (
            num_personne INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nom TEXT(10000) NOT NULL,
            prenom TEXT(10000) NOT NULL,
            email VARCHAR(200) NOT NULL UNIQUE,
            mdp TEXT(500) NOT NULL
        )";

        if ($conn->query($req) === FALSE)
        {
            echo "Erreur lors de la creation de la table personnes : " . $conn->error;
        }

        $req = "CREATE TABLE IF NOT EXISTS annonce_logement
        (
            num_annonce_logement INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            titre TEXT(255) NOT NULL,
            description TEXT(10000) NOT NULL,
            adresse TEXT(1000) NOT NULL,
            prix INT NOT NULL,
            surface INT NOT NULL,
            debut_disponibilite DATE NOT NULL,
            fin_disponibilite DATE NOT NULL,
            nb_personne INT NOT NULL,
            num_personne_ID INT,
            FOREIGN KEY (num_personne_ID) REFERENCES personne(num_personne)
        )";

        if ($conn->query($req) === FALSE)
        {
            echo '<div classe="erreur">';
            echo "Erreur lors de la creation de la table annonce_logement : " . $conn->error;
            echo '</div>';
        }
        
        return $conn;
    }

?>