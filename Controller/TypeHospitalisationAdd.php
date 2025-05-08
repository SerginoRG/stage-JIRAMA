<?php
require("../Repository/TypeHospitalistionRepo.php");

try {
    // Récupération des données du formulaire
    $id_type_hospitalisation = trim($_POST['id_type_hospitalisation']);
    $nom_hospitalisation = trim($_POST['nom_hospitalisation']);
    $plafond = trim($_POST['plafond']);

    // Validation des champs requis
    if (empty($id_type_hospitalisation) || empty($nom_hospitalisation)) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Vérification : Le nom de la société doit être en majuscules
    if ($nom_hospitalisation !== strtoupper($nom_hospitalisation)) {
        throw new Exception("Le nom de la hospitalisation doit être entièrement en majuscules.");
    }

   
    $rep = new TypeHopistalRepository();
    $type = new TypeHospitalisationEntity();
    $type->setId_type_hospitalisation($id_type_hospitalisation);
    $type->setNom_hospitalisation($nom_hospitalisation);
    $type->setPlafond($plafond);

    $rep->create_Type_Hospitalisation($type);

    // Redirection en cas de succès
    header('Location: ../PagerUser/TypeHospitalisation.php?success=1');
} catch (Exception $e) {
    // Redirection avec un message d'erreur
    header('Location: ../PagerUser/TypeHospitalisation.php?error=' . urlencode($e->getMessage()));
}
exit();

?>
