<?php
require("../Repository/HospitalisationRepository.php");

try {
    $id_hospitalisation = $_POST['id_hospitalisation'];
    $id_demande = $_POST['id_demande'];
    $id_type_hospitalisation = $_POST['id_type_hospitalisation'];
    $numero_piece = $_POST['numero_piece'];
    $date_entree = $_POST['date_entree'];
    $date_sortie = $_POST['date_sortie'];
    $frais_hospitalisation = $_POST['frais_hospitalisation'];
    $remarque = $_POST['remarque'];
    $lieu_hospitalisation = $_POST['lieu_hospitalisation'];

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    if (empty($id_demande)) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Création de l'entité Consultation
    $i = new HospitalisationEntity();
     
    $i->setIdhospitalisation($id_hospitalisation);
    $i->setIddemande($id_demande);
    $i->setId_type_hospitalisation($id_type_hospitalisation);
    $i->setNumero_piece($numero_piece);
    $i->setDate_admission($date_entree);
    $i->setDate_sortie($date_sortie);
    $i->setFrais_hospitalisation($frais_hospitalisation);
    $i->setRemarque($remarque);
     $i->setLieu_hospitalisation($lieu_hospitalisation);


    // Insertion dans la base de données
    $rep = new HospitalisationRepository();
    $message = $rep->update_Hospitalisation($i);

    // Redirection avec message
    header('Location: ../PagerUser/Hospitalisation.php?success=1&message=' . urlencode($message));
    exit();
} catch (Exception $e) {
    // Redirection avec message d'erreur
    header('Location: ../PagerUser/Hospitalisation.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
