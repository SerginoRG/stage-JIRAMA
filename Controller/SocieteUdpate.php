<?php
require("../Repository/SocieteRepository.php");

try {
    // Récupération des données du formulaire
    $id_societe = trim($_POST['id_societe']);
    $nom_societe = trim($_POST['nom_societe']);

    // Validation des champs requis
    if (empty($id_societe) || empty($nom_societe)) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Vérification : Le nom de la société doit être en majuscules
    if ($nom_societe !== strtoupper($nom_societe)) {
        throw new Exception("Le nom de la société doit être entièrement en majuscules.");
    }

    // Création de l'objet Société
    $i = new Societe();
    $i->setId_societe($id_societe);
    $i->setNom_societe($nom_societe);

    // Insertion dans la base de données via le repository
    $rep = new SocieteRepository();
    $rep->update_Societe($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Societe.php?success=1');
    exit();
} catch (Exception $e) {
    // Redirection avec un message d'erreur en cas d'exception
    header('Location: ../PagerUser/Societe.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
