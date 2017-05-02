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


        $req = "CREATE TABLE IF NOT EXISTS news (
            ID INT(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            titre TEXT(10000) NOT NULL,
            contenu TEXT(10000) NOT NULL,
            lien_vers_img TEXT(500),
            date_ajout TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        )";

        if ($conn->query($req) === FALSE) {
            echo "Erreur lors de la creation de la table news : " . $conn->error;
        }

        return $conn;
    }

?>
