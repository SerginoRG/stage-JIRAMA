<?php
require_once("../Config/serveur.php");

$db = new Db(); 
$pdo = $db->connexion();

try {
   

    // Récupérer et valider les entrées utilisateur
    $matricule_agent = $_POST['matricule_agent'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $statut = $_POST['statut'];
    $date_creation = $_POST['date_creation'];
    $password = $_POST['password']; // Laisser tel quel pour hashage ultérieur
    $passwordConfirmation = $_POST['passwordConfirmation'];

    // Vérifiez que tous les champs requis sont remplis
    if (empty($matricule_agent) || empty($username) || empty($password) || empty($role) || empty($statut) || empty($date_creation)) {
        throw new Exception("Tous les champs sont obligatoires !");
    }

    // Vérifiez que l'agent n'existe pas déjà
    $checkAgent = $pdo->prepare("SELECT COUNT(*) FROM login WHERE matricule_agent = :matricule_agent");
    $checkAgent->execute(['matricule_agent' => $matricule_agent]);

    if ($checkAgent->fetchColumn() > 0) {
        throw new Exception("Cet agent est déjà inscrit !");
    }

    // Vérification qu'il n'y a qu'un seul administrateur
    if ($role === 'Admin') {
        $stmt = $pdo->query("SELECT COUNT(*) FROM login WHERE role = 'Admin'");
        $adminCount = $stmt->fetchColumn();

        if ($adminCount > 0) {
            throw new Exception("Un administrateur existe déjà. Impossible d'en créer un autre.");
        }
    }

    // Vérification qu'il n'y a qu'un trois Utilisateur

    if ($role === 'Utilisateur') {
        $stmt = $pdo->query(" COUNT(*) FROM login WHERE role = 'Utilisateur'");
        $utilisateurCount = $stmt->fetchColumn();

        if ($utilisateurCount >= 3) {
            throw new Exception("Le nombre maximum de 3 utilisateurs est atteint.");
        }
    }

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        throw new Exception("Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.");
    }
    

    // Vérification de la correspondance des mots de passe
    if ($password !== $passwordConfirmation) {
        throw new Exception("Les mots de passe ne correspondent pas !");
    }



    // Insérez le nouvel utilisateur
    $insertQuery = $pdo->prepare("
        INSERT INTO login (matricule_agent, username, password, role, statut, date_creation) 
        VALUES (:matricule_agent, :username, :password, :role, :statut, :date_creation)
    ");
    $insertResult = $insertQuery->execute([
        'matricule_agent' => $matricule_agent,
        'username' => $username,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'role' => $role,
        'statut' => $statut,
        'date_creation' => $date_creation,
    ]);

    if ($insertResult) {
        // Succès : Redirection avec un message de succès
        header("Location: ../PageAdiminstrateur/Admin.php?success=1");
        exit;
    } else {
        throw new Exception("Erreur : Impossible de créer le compte.");
    }
} catch (Exception $e) {
    // Erreur : Redirection avec le message d'erreur encodé
    header("Location: ../PageAdiminstrateur/Admin.php?error=" . urlencode($e->getMessage()));
    exit;
}
?>
