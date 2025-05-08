<?php
require("../Repository/CmsRepository.php");

try {
    // Récupération des données du formulaire
    $matricule_agent = trim($_POST['matricule_agent']);
    $nom_cms = trim($_POST['nom_cms']);
    $role_cms = trim($_POST['role_cms']);

    // Validation des champs requis
    if (empty($matricule_agent) || empty($nom_cms)) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Vérification : Le nom de la société doit être en majuscules
    if ($nom_cms !== strtoupper($nom_cms)) {
        throw new Exception("Le nom de la CMS doit être entièrement en majuscules.");
    }

    // Création de l'objet CMS et insertion
    $rep = new CMSRepository();
    $cms = new Cms();
    $cms->setMatricule_agentCMS($matricule_agent);
    $cms->setNom_cms($nom_cms);
    $cms->setRole_cms($role_cms);

    $rep->create_CMS($cms);

    // Redirection en cas de succès
    header('Location: ../PagerUser/cms.php?success=1');
} catch (Exception $e) {
    // Redirection avec un message d'erreur
    header('Location: ../PagerUser/cms.php?error=' . urlencode($e->getMessage()));
}
exit();

?>
