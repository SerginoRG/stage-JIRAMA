<?php
require('../Config/serveur.php'); // Connexion à la base de données
require('../Entity/LoginEntity.php');
require('../Repository/LoginRepository.php');


$loginRepo = new LoginRepository($db); // Injection de dépendance

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $matricule_agent = $_POST['matricule_agent'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Sécurisation du mot de passe
        $role = $_POST['role'];
        $statut = $_POST['statut'];
        $date_creation = $_POST['date_creation'];

        // Validation des champs
        if (empty($matricule_agent) || empty($username) || empty($password) || empty($role)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // Vérification si l'agent est déjà inscrit
        if ($loginRepo->isAgentExists($matricule_agent)) {
            throw new Exception("Cet agent est déjà inscrit.");
        }

        // Vérification qu'il n'y a qu'un seul administrateur
        if ($role === 'admin' && $loginRepo->countAdmins() > 0) {
            throw new Exception("Un administrateur existe déjà.");
        } 

        // Vérification qu'il y a au maximum 3 utilisateurs
        if ($role === 'user' && $loginRepo->countUsers() >= 3) {
            throw new Exception("Le nombre maximum de 3 utilisateurs est atteint.");
        }

        // Création de l'entité LoginEntity
        $login = new LoginEntity();
        $login->setId_login($matricule_agent);
        $login->setMatricule_agent($username);
        $login->setPassword($password);
        $login->setRole($role);
        $login->setStatut($statut);
        $login->setDate_creation($date_creation);

        // Insertion dans la base de données
        $loginRepo->create_login($login);

        // Redirection en cas de succès
        header("Location: ../PagerAdiminstrateur/Admin.php?success=1");
    } catch (Exception $e) {
        // Redirection en cas d'erreur avec message
        header("Location: ../PagerAdiminstrateur/Admin.php?error=" . urlencode($e->getMessage()));
    }
}
?>
