<?php
// bdd.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur BDD : " . $e->getMessage());
}
?>
