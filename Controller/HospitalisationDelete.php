<?php
require("../Repository/HospitalisationRepository.php");


$id = $_POST['id'];
$demande = $_POST['demande'];
$type = $_POST['type'];
    
   

    // Création de l'employé
    $i = new HospitalisationEntity();
    $i->setIdhospitalisation($id);
    $i->setIddemande($demande);
    $i->setId_type_hospitalisation($type);
    
    // Insertion dans la base de données
    $rep = new HospitalisationRepository();
    $rep->delete_Hospitalisation($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Hospitalisation.php');
    exit();

?>
