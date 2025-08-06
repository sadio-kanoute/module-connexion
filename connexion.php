<?php
session_start();
include_once 'bdd.php';
include('header.php');

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
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: profil.php");
            }
            exit();
        } else {
            $erreur = "Login ou mot de passe incorrect";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

<main class="container small">
    <h2>Connexion</h2>

    <?php if (!empty($erreur)): ?>
        <p class="error"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="POST" action="connexion.php" class="form-auth">
        <label for="login">Login :</label>
        <input type="text" name="login" id="login" required placeholder="Ton login">

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required placeholder="Ton mot de passe">

        <input type="submit" name="submit" value="Se connecter" class="btn primary">

        <p class="small-text">
            Pas encore inscrit ? <a href="inscription.php">Inscris-toi ici</a>
        </p>
    </form>
</main>

<?php include('footer.php'); ?>

</body>
</html>
