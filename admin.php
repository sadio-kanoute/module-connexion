<?php
session_start();
include_once 'bdd.php';
include('header.php');



if (!isset($_SESSION['login']) || $_SESSION['login'] !== 'admin') {
    header("Location: connexion.php");
    exit();
}


$stmt = $bdd->query("SELECT id, login, prenom, nom FROM utilisateurs ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Administration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Page d'administration</h2>
    <p>Bienvenue, admin <strong><?= htmlspecialchars($_SESSION['login']) ?></strong>. Voici la liste des utilisateurs enregistrés :</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Prénom</th>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['id']) ?></td>
                    <td><?= htmlspecialchars($u['login']) ?></td>
                    <td><?= htmlspecialchars($u['prenom']) ?></td>
                    <td><?= htmlspecialchars($u['nom']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a class="logout" href="deconnexion.php">Se déconnecter</a>
</div>

<?php include('footer.php'); ?>
</body>
</html>
