<?php
    session_start();
    $prefixeTitrePage = " - Colocation";
    include("configuration.php");

    function connectionBDD()
    {
        $passwordBackEnd = motDePasse();
        $maConfig = recupConfig();
        $host = $maConfig['host'];
        $user = $maConfig['user'];
        $passwd = $maConfig['passwd'];
        $dbname = $maConfig['dbname'];

        $conn = mysqli_connect($host, $user, $passwd, $dbname);

        if ($conn->connect_error) {
            die("Connexion échoué : " . $conn->connect_error);
        } 


        $req = "CREATE TABLE IF NOT EXISTS personne (
            numPersonne INT(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nom TEXT(10000) NOT NULL,
            prenom TEXT(10000) NOT NULL,
            email TEXT(500),
            mdp TEXT(500)
        )";

        if ($conn->query($req) === FALSE) {
            echo "Erreur lors de la creation de la table personnes : " . $conn->error;
        }

        return $conn;
    }

?>
