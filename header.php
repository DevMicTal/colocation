<?php
// A simple web site in Cloud9 that runs through Apache
// Press the 'Run' button on the top to start the web server,
// then click the URL that is emitted to the Output tab of the console
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?php if(isset($titreDePage)) echo $titreDePage . $prefixeTitrePage; ?></title>
        <link href="style.css" rel="stylesheet" media="all" type="text/css"> 
    </head>
    <body>
