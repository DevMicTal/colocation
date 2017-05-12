<?php include(__DIR__.'/../../Framework/Controleur.php'); if(!isset($titre_de_page)) { $titre_de_page = "Accueil"; } ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        
        <title><?php if(isset($titre_de_page)) echo $titre_de_page . $prefixe_titre_page; ?></title>
        
        <!-- Bootstrap -->
        <link href="/bts-sio/colocation/Contenu/css/bootstrap.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="/bts-sio/colocation/Contenu/css/sb-admin.css" rel="stylesheet">
        <link href="/bts-sio/colocation/Contenu/css/plugins/morris.css" rel="stylesheet">
        <link href="/bts-sio/colocation/Contenu/css/style-custom.css" rel="stylesheet"> 

        <!-- Polices -->
        <link href="/bts-sio/colocation/Contenu/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <div id="wrapper">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo lien_vers_accueil() ?>">Colocations</a>
            </div>

            <ul class="nav navbar-right top-nav">


                <li class="dropdown">
                    <?php // Je vais faire ici une condition si on est connecter ou pas pour caché ou afficher se connecter ou tableau de bord ... */ ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                        <?php if(!isset($_SESSION['email'])) { ?> Connection/Inscription <?php } else { ?> Mon compte (<?php echo $_SESSION['email']; ?>)<?php } ?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        
                        <?php if(!isset($_SESSION['email']))
                        { ?>
                            <li>
                                <a href="<?php echo lien_vers_connexion() ?>"><i class="fa fa-fw fa-user"></i> Se connecter</a>
                            </li>
                            <li>
                                <a href="<?php echo lien_vers_inscription() ?>"><i class="fa fa-fw fa-user"></i> S'inscrire</a>
                            </li>
                        <?php 
                        }
                        
                        else
                        { ?>
                            <li>
                                <a href="<?php echo lien_vers_dashboard(); ?>"><i class="fa fa-fw fa-envelope"></i> Tableau de bord</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Paramètres</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo lien_vers_deconnexion() ?>"><i class="fa fa-fw fa-power-off"></i> Se déconnecter</a>
                            </li>
                        <?php 
                        } ?>
                        
                    </ul>
                </li>
            </ul>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="<?php echo lien_vers_accueil() ?>"><i class="fa fa-fw fa-dashboard"></i> Accueil</a>
                    </li>
                    
                    <?php if(!isset($_SESSION['email']))
                    { ?>
                        <li>
                            <a href="<?php echo lien_vers_inscription() ?>"><i class="fa fa-fw fa-bar-chart-o"></i> S'inscrire</a>
                        </li>
                    <?php 
                    } ?>
                    
                    <li>
                        <a href="<?php echo lien_vers_credits() ?>"><i class="fa fa-fw fa-dashboard"></i> Crédits</a>
                    </li>
                </ul>
            </div>


        </nav>
        
    </head>
    <body>
