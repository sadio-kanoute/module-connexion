<?php
// bdd.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=sadio-kanoute_moduleconnexion;charset=utf8', 'sadio-kanoute', 'Adama@1974@');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur BDD : " . $e->getMessage());
}
?>
