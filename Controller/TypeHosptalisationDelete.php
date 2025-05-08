<?php
require("../Repository/TypeHospitalistionRepo.php");


    $id = $_POST['id'];
    
   
   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    

    // Création de l'employé
    $i = new TypeHospitalisationEntity();
    $i->setId_type_hospitalisation($id);
  
    
    

    // Insertion dans la base de données
    $rep = new TypeHopistalRepository();
    $rep->delete_Type_Hospitalisation($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/TypeHospitalisation.php');
    exit();

?>
