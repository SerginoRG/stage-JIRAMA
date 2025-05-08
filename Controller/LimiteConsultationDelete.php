<?php
require("../Repository/TypeconsultationRepository.php");


    $id = $_POST['id'];
    
   
   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    

    // Création de l'employé
    $i = new TypeConsultationEntity();
    $i->setId_type_consultation($id);
  
    
    

    // Insertion dans la base de données
    $rep = new TypeConsultRepository();
    $rep->delete_Type_Consultation($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/ConsultationLimite.php');
    exit();

?>
