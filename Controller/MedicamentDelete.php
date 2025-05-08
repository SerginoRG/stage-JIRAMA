<?php
require("../Repository/MedicamentRepo.php");


    $id = $_POST['id'];
    
   
   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    

    // Création de l'employé
    $i = new MedicamentEntity();
    $i->setId_medicament($id);
  
    
    

    // Insertion dans la base de données
    $rep = new MedicamentRepository();
    $rep->delete_Medicament($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/LimiteMedicament.php');
    exit();

?>
