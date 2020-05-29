<!DOCTYPE html>
<?php
include('../includes/debut_page.php')
?>

<html lang="fr-FR">
    <head>
        <title>Casques Nolark : Sécurité et confort, nos priorités !</title>
        <meta charset="UTF-8">
        <meta name="author" content="José GIL">
        <meta name="description" content="Découvrez des casques moto dépassant même les exigences des tests de sécurité. Tous les casques Nolark au meilleur prix et avec en prime la livraison gratuite !">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/styles.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="../favicon.ico">
    </head>
    <body>
        <?php
        include('../includes/header.html.inc.php');
        //Si l'utilisateur n'est ni connecté ni vient juste de créer son compte 
        //affiche le formulaire de création de compte
        if (!filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING) && !isset($_SESSION['pseudo'])) {
            echo '<form method="post" action="inscription.php">
	<fieldset>
	<legend>Connexion</legend>
	<p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
        <label for="password">Confirmer le mot de passe :</label><input type="password" name="password2" id="password2" />
	</p>
	</fieldset>
	<p><input type="submit" value="S\'inscrire" /></p></form>
	<a href="./inscription.php">Pas encore inscrit ?</a>
	 
	</div>';
        } else {
            $message = '';
            //Si l'utilisateur est déjà connecté
            if (isset($_SESSION['pseudo'])) {
                $message = '<p>Page inaccessible car vous êtes déjà connecté </p>'
                        . '<p>Cliquez <a href="../index.php">ici</a> pour revenir à l\'accueil</p>';
                //On vérifie que tous les champs necessaires sont bien remplis
            } elseif (!filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING) || !filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) || !filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING)) { //Oublie d'un champ
                $message = '<p>Une erreur s\'est produite pendant l\'inscription.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./inscription.php">ici</a> pour revenir</p>';
                //On vérifie que les deux mots de passe sont bien identiques
            } elseif (filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) != filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING)) {
                $message = '<p>Les mots de passe ne sont pas identiques.</p>
                    <p>Cliquez <a href="./insciption.php">ici</a> pour revenir</p>';
                //Si tout va bien, création du compte sur la bd
            } else {
                $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                $db = new PDO('mysql:host=127.0.0.1;dbname=nolark', 'nolarkinsert', 'nolarkpwd');
                $query = $db->prepare("insert into utilisateur (login, password, niveau) values ('" . $pseudo . "','" . $password . "', 2)");
                $query->execute();
                $message = '<p>Création du compte réalisée avec succès</p>' . $pseudo
                        . '<p>Cliquez <a href="./connexion.php">ici</a> pour revenir à la page de connexion</p>';
            }
            echo $message;
        }
        include('../includes/footer.inc.php');
        ?>
    </body>
</html>

