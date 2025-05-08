<?php
require("../Repository/CmsRepository.php");


    $id_cms = $_POST['id_cms'];
    $matricule = $_POST['matricule'];
    
   

    // Création de l'employé
    $i = new Cms();
    $i->setId_cms($id_cms);
    $i->setMatricule_agentCMS($matricule);
    
    // Insertion dans la base de données
    $rep = new CMSRepository();
    $rep->delete_CMS($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/cmsTableau.php');
    exit();

?>
