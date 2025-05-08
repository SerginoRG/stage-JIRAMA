<?php
require("../Repository/AgentRepository.php");


    $Matricule = $_POST['matricule_agent'];
    
   

    // Création de l'employé
    $i = new Agent();
    $i->setMatriculeAgent($Matricule);
    
    // Insertion dans la base de données
    $rep = new AgentRepository();
    $rep->delete_Agent($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Agent.php');
    exit();

?>
