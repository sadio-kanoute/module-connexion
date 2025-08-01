<?php
include_once 'bdd.php';
include('header.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Accueil - Mon Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Bienvenue sur Mon Site</h1>
</header>

<main>
    <p>Ce site te permet de t’inscrire, te connecter, gérer ton profil et, si t’es admin, voir tous les utilisateurs.</p>

    <nav>
        <?php if (!isset($_SESSION['login'])): ?>
            <a href="inscription.php">Inscription</a>
            <a href="connexion.php">Connexion</a>
        <?php else: ?>
            <a href="profil.php">Mon Profil (<?= htmlspecialchars($_SESSION['prenom']) ?>)</a>
            <?php if ($_SESSION['login'] === 'admin'): ?>
                <a href="admin.php">Admin</a>
            <?php endif; ?>
            <a href="deconnexion.php">Déconnexion</a>
        <?php endif; ?>
    </nav>
</main>

</body>
</html>
