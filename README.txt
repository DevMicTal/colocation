# colocation

Pour faire marcher le site web, il faut creer un fichier de configuration dans le dossier Framework/ nommé : configuration.php
Qui contient les accès et configurations du site et de la BDD.

Exemple de fichier configuration.php :

<?php /* Toutes les configuration (fichier exclu du git) */

	$prefixe_titre_page = " - Colocation";

	function recup_config() 
	{
		$ma_config = array();
		$ma_config['host'] = "localhost";
		$ma_config['user'] = "userDB";
		$ma_config['dbname'] = "nameOfDB";
		$ma_config['passwd'] = "passwordOfDB";
		return $ma_config;
	}

?>
