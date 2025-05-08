<?php
require("../Repository/MedicamentRepo.php");

try {
    $id_medicament = $_POST['id_medicament'];
    $nom_medicament = $_POST['nom_medicament'];
    $type_rembourse = $_POST['type_rembourse'];
   
   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    if (empty($id_medicament) ) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Création de l'employé
    $i = new MedicamentEntity();
    $i->setId_medicament($id_medicament);
    $i->setNom_medicament($nom_medicament);
    $i->setType_rembourse($type_rembourse);
    
   

    // Insertion dans la base de données
    $rep = new MedicamentRepository();
    $rep->update_Medicament($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/LimiteMedicament.php?success=1');
    exit();
} catch (Exception $e) {
    // Redirection avec un message d'erreur en cas d'exception
    header('Location: ../PagerUser/LimiteMedicament.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
