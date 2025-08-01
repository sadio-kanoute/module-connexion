<?php
include_once 'bdd.php';
?>

<header>
  <div class="top-nav">
    <button class="btn-retour-accueil" onclick="window.location.href='index.php'">🏠 Accueil</button>
  </div>
</header>

<nav class="main-nav">
  <ul>
    <li><a href="index.php">Accueil</a></li>
    <?php if (!isset($_SESSION['login'])): ?>
      <li><a href="inscription.php">Inscription</a></li>
      <li><a href="connexion.php">Connexion</a></li>
    <?php else: ?>
      <li><a href="profil.php">Mon Profil (<?= htmlspecialchars($_SESSION['prenom']) ?>)</a></li>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <li><a href="admin.php">Admin</a></li>
      <?php endif; ?>
      <li><a href="deconnexion.php">Déconnexion</a></li>
    <?php endif; ?>
  </ul>
</nav>
