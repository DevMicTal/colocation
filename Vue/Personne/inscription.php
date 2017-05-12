<?php  
	$titre_de_page = "S'inscrire"; include(__DIR__.'/../Core/header.php');
?>
<?php if(isset($_SESSION['email']))
	{
?>
	<h1>Vous ête déjà connecter, voulez vous vous <a href="<?php echo lien_vers_deconnexion(); ?>">déconnectez</a> ?</h1>
<?php
      }
      else
      {
?>
		<h1>S'inscrire</h1>
		<?php if(isset($erreur_inscription)) 
		{ ?>
			<h1 class="erreur"><?php echo $erreur_inscription; ?></h1>
		<?php
		} ?>
		
		<form method="post">
			<table border="0" width="500" align="center">
				<tr>
					<td>Email</td>
					<td><input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required /></td>
				</tr>
				<tr>
					<td>Nom</td>
					<td><input type="text" name="nom" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>" required /></td>
				</tr>
				<tr>
					<td>Prénom</td>
					<td><input type="text" name="prenom" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>" required /></td>
				</tr>
				<tr>
					<td>Mot de passe</td>
					<td><input type="password" name="mdp" required /></td>
				</tr>
				<tr>
					<td>Confirmer le mot de passe</td>
					<td><input type="password" name="confirmation_mdp" required /></td>
				</tr>
				<tr>
					<td><input type="submit" name="register_user" value="S'inscrire"></td>
				</tr>
			</table>
			<input type="hidden" name="inscription_personne" value="on" />
		</form>
<?php
	}
?>
<?php
	include(chemin_vers_footer()); 
?>