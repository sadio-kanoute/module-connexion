<?php
include_once 'bdd.php';
include('header.php');

$erreur = '';

if (isset($_POST['submit'])) {
    $login = htmlspecialchars(trim($_POST['login']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];

    if (!empty($login) && !empty($prenom) && !empty($nom) && !empty($password) && !empty($conf_password)) {

        if ($password === $conf_password) {
            $checkLogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
            $checkLogin->execute([$login]);

            if ($checkLogin->rowCount() === 0) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $insert = $bdd->prepare("INSERT INTO utilisateurs (login, prenom, nom, password) VALUES (?, ?, ?, ?)");
                $insert->execute([$login, $prenom, $nom, $hashedPassword]);

                header("Location: connexion.php");
                exit();
            } else {
                $erreur = "Ce login est déjà utilisé.";
            }
        } else {
            $erreur = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>
    <form method="POST" action="">
        <h2>Inscription</h2>

        <input type="text" name="login" placeholder="Login" required value="<?= isset($login) ? htmlspecialchars($login) : '' ?>">
        <input type="text" name="prenom" placeholder="Prénom" required value="<?= isset($prenom) ? htmlspecialchars($prenom) : '' ?>">
        <input type="text" name="nom" placeholder="Nom" required value="<?= isset($nom) ? htmlspecialchars($nom) : '' ?>">
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="password" name="conf_password" placeholder="Confirmer mot de passe" required>
        <input type="submit" name="submit" value="S'inscrire">

        <?php if ($erreur): ?>
            <p class="error"><?= $erreur ?></p>
        <?php endif; ?>

        <a href="connexion.php" class="btn-retour-accueil">Déjà inscrit ? Connecte-toi</a>
    </form>
</main>
<?php include('footer.php'); ?>

</body>
</html>
