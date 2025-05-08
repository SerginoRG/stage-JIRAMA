<?php

require("../Repository/SocieteRepository.php");


$id_societe = $_POST['id_societe'];

    // Création de l'employé
    $i = new Societe();
    $i->setId_societe($id_societe);
   
   

    // Insertion dans la base de données
    $rep = new SocieteRepository();
    $rep->delete_Societe($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Societe.php');
    exit();

?>
