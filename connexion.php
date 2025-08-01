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
            $erreur = "Login ou mot de passe incorrect.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>
