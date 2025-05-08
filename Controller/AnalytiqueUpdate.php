<?php
require("../Repository/AnalytiqueRepository.php");

try {
    $id_analytique = $_POST['id_analytique'];
    $nom_analytique = $_POST['nom_analytique'];
   
   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    if (empty($id_analytique) ) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Création de l'employé
    $i = new Analytique();
    $i->setId_analytique($id_analytique);
    $i->setNom_analytique($nom_analytique);
    
   

    // Insertion dans la base de données
    $rep = new AnalytiqueRepository();
    $rep->update_Analytique($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Analytique.php?success=1');
    exit();
} catch (Exception $e) {
    // Redirection avec un message d'erreur en cas d'exception
    header('Location: ../PagerUser/Analytique.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
