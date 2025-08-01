<?php
include_once 'bdd.php';

$erreur = '';

if (isset($_POST['submit'])) {
    $login = htmlspecialchars(trim($_POST['login']));
    $password = $_POST['password'];

    if (!empty($login) && !empty($password)) {
        $checkUser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $checkUser->execute([$login]);
        $user = $checkUser->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['nom'] = $user['nom'];

            header("Location: profil.php");
            exit();
        } else {
            $erreur = "Login ou mot de passe incorrect.";
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
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST" action="">
    <h2>Connexion</h2>
    <input type="text" name="login" placeholder="Login" required value="<?= isset($login) ? htmlspecialchars($login) : '' ?>">
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="submit" name="submit" value="Se connecter">

    <?php if ($erreur): ?>
        <p class="error"><?= $erreur ?></p>
    <?php endif; ?>

    <a href="inscription.php">Pas encore inscrit ? Crée un compte</a>
</form>

</body>
</html>
