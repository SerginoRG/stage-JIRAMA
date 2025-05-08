<?php
require("../Repository/FactureRepository.php");


    $id_facture = $_POST['id_facture'];
    $id_remboursement = $_POST['id_remboursement'];
    $id_analytique = $_POST['id_analytique'];
    $id_medica = $_POST['id_medica'];

   
    
   
   


    // Création de l'employé
    $i = new Facture();
    $i->setId_facture($id_facture);


    $i->setId_remboursement($id_remboursement);


    $i->setId_analytique($id_analytique);

    $i->setId_medicament($id_medica);


    

    
    
   

    // Insertion dans la base de données
    $rep = new FactureRepository();
    $rep->delete_Facture($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/FactureTableau.php');
    exit();

?>
