<?php
session_start();
include_once 'bdd.php';
include('header.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accueil - Module Connexion</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
</head>
<body>

<header>
    <h1>Bienvenue sur le projet : Module Connexion</h1>
</header>

<main>
    <section class="presentation">
        <h2>À propos du projet</h2>
        <p>Ce site a été développé en PHP avec une base de données MySQL.</p>
        <p>Fonctionnalités principales :</p>
        <ul>
            <li>Inscription et connexion sécurisée avec mot de passe hashé</li>
            <li>Espace utilisateur personnalisé</li>
            <li>Espace administrateur pour gérer tous les utilisateurs</li>
            <li>Navigation dynamique selon le statut connecté ou non</li>
        </ul>
        <p>Ce module est un projet d'entraînement pour maîtriser l'authentification en PHP + gestion MySQL.</p>
    </section>

    <nav class="btn-accueil">
        <?php if (!isset($_SESSION['login'])): ?>
            <a href="inscription.php" class="btn-inscription">Inscription</a>
            <a href="connexion.php" class="btn-connexion">Connexion</a>
        <?php else: ?>
            <a href="profil.php" class="btn-profil">Mon Profil (<?= htmlspecialchars($_SESSION['prenom']) ?>)</a>
            <?php if ($_SESSION['login'] === 'admin'): ?>
                <a href="admin.php" class="btn-admin">Espace Admin</a>
            <?php endif; ?>
            <a href="deconnexion.php" class="logout">Déconnexion</a>
        <?php endif; ?>
    </nav>
</main>

<?php include('footer.php'); ?>

</body>
</html>
