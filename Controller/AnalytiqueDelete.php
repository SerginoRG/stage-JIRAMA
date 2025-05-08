<?php
require("../Repository/AnalytiqueRepository.php");


    $id_analytique = $_POST['id_analytique'];
   
    // Création de l'employé
    $i = new Analytique();
    $i->setId_analytique($id_analytique);
   
   

    // Insertion dans la base de données
    $rep = new AnalytiqueRepository();
    $rep->delete_Analytique($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Analytique.php');
    exit();

?>
