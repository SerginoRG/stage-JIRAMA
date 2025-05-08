<?php
require("../Repository/RemboursementRepository.php");

try {
    
    $id = $_POST['id_remboursement'];
    $matricule_remboursement = $_POST['matricule_agent'];
    $id_cms = $_POST['id_cms'];

    $date = $_POST['date_demande'];
    
   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    if (empty($matricule_remboursement) ) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Création de l'employé
    $i = new Remboursement();

    $i->setIdRemboursement($id);
    $i->setMatricule_agent($matricule_remboursement);

    $i->setid_cmsDemande($id_cms);

    $i->setDate_demande($date);
   

    // Insertion dans la base de données
    $rep = new RemboursementRepository();
    $rep->update_Remboursement($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Remboursement.php?success=1');
    exit();
} catch (Exception $e) {
    // Redirection avec un message d'erreur en cas d'exception
    header('Location: ../PagerUser/Remboursement.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
