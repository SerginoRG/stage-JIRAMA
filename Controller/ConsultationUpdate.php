<?php
require("../Repository/ConsultationRepository.php");

try {
    $id_consultation = $_POST['id_consultation']; 
    $id_demande = $_POST['id_demande'];
    $type_consultation = $_POST['type_consultation'];
    $numero_piece = $_POST['numero_piece'];
    $date_consultation = $_POST['date_consultation'];
    $motif = $_POST['motif'];
    $frais_consultation = $_POST['frais_consultation'];
    $lieu_consultation = $_POST['lieu_consultation'];
    $remarque = $_POST['remarque'];

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    if (empty($id_demande)) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Création de l'entité Consultation
    $i = new ConsultationEntity();
    $i->setIdconsultation($id_consultation);
    $i->setIddemande($id_demande);
    $i->setType_consultation($type_consultation);
    $i->setNumero_piece($numero_piece);
    $i->setDate_consultation($date_consultation);
    $i->setMotif($motif);
    $i->setFrais_consultation($frais_consultation);
    $i->setLieu_consultation($lieu_consultation);
    $i->setRemarque($remarque);

    // Insertion dans la base de données
    $rep = new ConsultationRepository();
    $message = $rep->create_Consultation($i);

    // Redirection avec message
    header('Location: ../PagerUser/Consultation.php?success=1&message=' . urlencode($message));
    exit();
} catch (Exception $e) {
    // Redirection avec message d'erreur
    header('Location: ../PagerUser/Consultation.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
