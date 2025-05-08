<?php
require("../Repository/LoginControle.php");

try {
    $matricule_agent = $_POST['matricule_agent'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $statut = $_POST['statut'];
   
   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    if (empty($matricule_agent) ) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Création de l'employé
    $i = new LoginEntity();
    $i->setMatricule_agent($matricule_agent);
    $i->setUsername($username);
    $i->setRole($role);
    $i->setStatut($statut);

    
   

    // Insertion dans la base de données
    $rep = new loginControle_Affiche();
    $rep->update_controle_Affiche($i);

    // Redirection en cas de succès
    header('Location: ../PageAdiminstrateur/Afficher.php?success=1');
    exit();
} catch (Exception $e) {
    // Redirection avec un message d'erreur en cas d'exception
    header('Location: ../PageAdiminstrateur/Afficher.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
