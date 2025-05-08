<?php
require("../Repository/RemboursementRepository.php");


    $id = $_POST['id_remboursement'];
    $id_cms = $_POST['id_cms'];
    $matricule_agent = $_POST['matricule_agent'];
    
   

   

    // Création de l'employé
    $i = new Remboursement();
    
    $i->setIdRemboursement($id);
    $i->setid_cmsDemande($id_cms);
    $i->setMatricule_agent($matricule_agent);
    
   

    // Insertion dans la base de données
    $rep = new RemboursementRepository();
    $rep->delete_Remboursement($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Remboursement.php');
    exit();

?>
