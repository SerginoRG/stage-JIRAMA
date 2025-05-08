<?php
require("../Repository/TypeconsultationRepository.php");

try {
    // Récupération des données du formulaire
    $id_type_consultation = trim($_POST['id_type_consultation']);
    $nom_consultation = trim($_POST['nom_consultation']);
    $plafond = trim($_POST['plafond']);

    // Validation des champs requis
    if (empty($id_type_consultation) || empty($nom_consultation)) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Vérification : Le nom de la société doit être en majuscules
    if ($nom_consultation !== strtoupper($nom_consultation)) {
        throw new Exception("Le nom de la Consultation doit être entièrement en majuscules.");
    }

   
    $rep = new TypeConsultRepository();
    $type = new TypeConsultationEntity();
    $type->setId_type_consultation($id_type_consultation);
    $type->setNom_consultation($nom_consultation);
    $type->setPlafond($plafond);

    $rep->update_Type_Consultation($type);

    // Redirection en cas de succès
    header('Location: ../PagerUser/ConsultationLimite.php?success=1');
} catch (Exception $e) {
    // Redirection avec un message d'erreur
    header('Location: ../PagerUser/ConsultationLimite.php?error=' . urlencode($e->getMessage()));
}
exit();

?>
