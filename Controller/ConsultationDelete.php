<?php
require("../Repository/ConsultationRepository.php");


$id_consultation = $_POST['id_consultation'];
$id_demande = $_POST['id_demande'];
$type_consultation = $_POST['type_consultation'];
    
   

    // Création de l'employé
    $i = new ConsultationEntity();
    $i->setIdconsultation($id_consultation);
    $i->setIddemande($id_demande);
    $i->setType_consultation($type_consultation);
    
    // Insertion dans la base de données
    $rep = new ConsultationRepository();
    $rep->delete_Consultation($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Consultation.php');
    exit();

?>
