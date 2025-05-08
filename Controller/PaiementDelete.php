<?php
require("../Repository/PaiementRepository.php");


    $id_paiement = $_POST['id_paiement'];
    $id_remboursement = $_POST['id_remboursement'];
   
   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    

    // Création de l'employé
    $i = new Paiement();
    $i->setId_paiement($id_paiement);
    $i->setId_remboursement($id_remboursement);
    
    

    // Insertion dans la base de données
    $rep = new PaiementRepository();
    $rep->delete_Paiement($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Paiement.php');
    exit();

?>
