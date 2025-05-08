<?php
require_once("../Config/serveur.php");

$db = new Db(); 
$pdo = $db->connexion();

try {
    // Récupération des données d'entrée
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des champs vides
    if (empty($username) || empty($password)) {
        throw new Exception("Veuillez remplir tous les champs.");
    }

    // Préparation de la requête SQL pour récupérer les informations de l'utilisateur
    $sql = $pdo->prepare("SELECT * FROM login WHERE username = :username");
    $sql->execute(['username' => $username]);

    if ($sql->rowCount() === 0) {
        throw new Exception("Nom d'utilisateur  incorrect.");
    }

    $row = $sql->fetch(PDO::FETCH_ASSOC);

    if ($row['statut'] === 'Bloquer') {
        throw new Exception("Votre compte est bloqué. Veuillez contacter l'administrateur.");
    }
    

    // Vérification du mot de passe avec password_verify
    if (!password_verify($password, $row['password'])) {
        throw new Exception(" Mot de passe incorrect.");
    }

    // Démarrage de la session et enregistrement des informations
    session_start();
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role']; // Enregistrer le rôle pour une gestion future

    // Redirection en fonction du rôle
    if ($row['role'] === 'Admin') {
        header("Location: ../PageAdiminstrateur/Admin.php");
    } elseif ($row['role'] === 'Utilisateur') {
        header("Location: ../PagerUser/Acceuiller.php");
    } else {
        throw new Exception("Rôle inconnu. Veuillez contacter l'administrateur.");
    }
} catch (Exception $e) {
    // Redirection en cas d'erreur avec le message d'erreur
    header("Location: ../index.php?error=" . urlencode($e->getMessage()));
    exit();
}

?>
