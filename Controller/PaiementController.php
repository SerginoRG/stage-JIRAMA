<?php
require("../Repository/PaiementRepository.php");

try {
    $id_remboursement = $_POST['id_remboursement'];
    $mode_paiement = $_POST['mode_paiement'];
    $date_paiement = $_POST['date_paiement'];
   
   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    if (empty($id_remboursement) ) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Création de l'employé
    $i = new Paiement();
    $i->setId_remboursement($id_remboursement);
    $i->setMode_paiement($mode_paiement);
    $i->setDate_paiement($date_paiement);
    

    // Insertion dans la base de données
    $rep = new PaiementRepository();
    $rep->create_Paiement($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Paiement.php?success=1');
    exit();
} catch (Exception $e) {
    // Redirection avec un message d'erreur en cas d'exception
    header('Location: ../PagerUser/Paiement.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
